<?php

namespace RleeCMS\ShopBundle\Core;

use Doctrine\ORM\EntityManager;
use EasyCMS\ShopBundle\Entity\Product;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;
use EasyCMS\ShopBundle\Entity\OrderStatus;
use EasyCMS\ShopBundle\Entity\OrderHistory;

class Shop
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var EntityManager
     */
    protected $em;

    protected $mainCurrency;

    /**
     * Constructor
     *
     * @param ContainerInterface $container
     * @param EntityManager $em
     */
    public function __construct(ContainerInterface $container, EntityManager $em)
    {
        $this->container = $container;
        $this->em = $em;
    }

    public function countProductsCategory($catId)
    {
        $em = $this->em;
        $repo = $em->getRepository('EasyCMSShopBundle:Category')->findOneById($catId);
        $count = count($repo->getAllProducts());

        return $count;
    }

    public function deleteProductPhoto($file)
    {
        $path_original = $this->container->get('kernel')->getRootdir() . '/../web/uploads/shop/original/' . $file;
        $path_catalog = $this->container->get('kernel')->getRootdir() . '/../web/uploads/shop/catalog/' . $file . '.png';
        $path_thumb = $this->container->get('kernel')->getRootdir() . '/../web/uploads/shop/thumb/' . $file . '.png';
        $fs = new Filesystem();
        try {
            $fs->remove($path_original);
            $fs->remove($path_catalog);
            $fs->remove($path_thumb);
            return true;
        } catch (IOException $e) {
            return false;
        }
    }

    /**
     * Возвращает сумму прописью
     * @author runcore
     * @uses morph(...)
     */
    public function num2str($num, $request)
    {
        $nul = 'ноль';
        $ten = array(
            array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
            array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
        );
        $a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
        $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
        $hundred = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');

        $em = $this->em;
        $currency = ($request->getSession()->get('_currency'))
            ? $em->getRepository('EasyCMSShopBundle:Currency')->findOneBy(array('isoName' => $request->getSession()->get('_currency')))
            : $em->getRepository('EasyCMSShopBundle:Currency')->findOneBy(array('statusMain' => 1));

        $units = array( // Units
            array($currency->getSubunitMorph1(), $currency->getSubunitMorph2(), $currency->getSubunitMorph5(), 1),
            array($currency->getMorph1(), $currency->getMorph2(), $currency->getMorph5(), 0),
            array('тысяча', 'тысячи', 'тысяч', 1),
            array('миллион', 'миллиона', 'миллионов', 0),
            array('миллиард', 'милиарда', 'миллиардов', 0),
        );
        $unit = $units;
        //
        list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub) > 0) {
            foreach (str_split($rub, 3) as $uk => $v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit) - $uk - 1; // unit key
                $gender = $unit[$uk][3];
                list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2 > 1) $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; # 20-99
                else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                // units without rub & kop
                if ($uk > 1) $out[] = $this->morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
            } //foreach
        } else $out[] = $nul;
        $out[] = $this->morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub

// после запятой
        if (intval($kop) > 0) {
            $kop = str_pad($kop, 12, '0', STR_PAD_LEFT);
            foreach (str_split($kop, 3) as $uk => $v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit) - $uk - 1; // unit key
                $gender = $unit[$uk][3];
                list($k1, $k2, $k3) = array_map('intval', str_split($v, 1));
                // mega-logic
                $out[] = $hundred[$k1]; # 1xx-9xx
                if ($k2 > 1) $out[] = $tens[$k2] . ' ' . $ten[$gender][$k3]; # 20-99
                else $out[] = $k2 > 0 ? $a20[$k3] : $ten[$gender][$k3]; # 10-19 | 1-9
                // units without rub & kop
                if ($uk > 1) $out[] = $this->morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
            } //foreach
        } else $out[] = $nul;

        $out[] = $this->morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
        return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
    }

    /**
     * Склоняем словоформу
     */
    public function morph($n, $f1, $f2, $f5)
    {
        $n = abs(intval($n)) % 100;
        if ($n > 10 && $n < 20) return $f5;
        $n = $n % 10;
        if ($n > 1 && $n < 5) return $f2;
        if ($n == 1) return $f1;
        return $f5;
    }

    public function checkCartTime($cartTime)
    {
        $curTime = time();
        $diff = $curTime - $cartTime;
        // 1200 с - 20 минут
        if ($diff >= 3600) {
            return false;
        }
        return true;
    }

    public function changeOrderStatus(OrderStatus $status)
    {
        $orderHistory = new OrderHistory();
        $orderHistory->setStatus($status);

        return $orderHistory;
    }

    public function getMainCurrency()
    {
        if (!$this->mainCurrency) {
            $em = $this->em;
            $this->mainCurrency = $em->getRepository('RleeCMSShopBundle:Currency')
                ->findOneBy(array('main' => true));
        }
        return $this->mainCurrency;


    }

    public function getInterfaceCurrency($session)
    {
        $em = $this->em;
        $currency = $session->get('_currency');
        if ($currency) {
            return $em->getRepository('EasyCMSShopBundle:Currency')
                ->findOneBy(array('isoName' => $currency));
        } else {
            return 0;
        }
    }
}