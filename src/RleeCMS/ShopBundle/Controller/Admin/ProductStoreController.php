<?php

namespace RleeCMS\ShopBundle\Controller\Admin;

use RleeCMS\ShopBundle\Entity\ProductStore;
use RleeCMS\ShopBundle\Entity\Store;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RleeCMS\ShopBundle\Entity\Product;
use RleeCMS\ShopBundle\Form\ProductType;

/**
 * Product controller.
 *
 * @Route("/product/store")
 */
class ProductStoreController extends Controller
{
    /**
     * Lists all Product entities.
     *
     * @Route("/{id}", name="admin_shop_product_store")
     * @Template()
     */
    public function indexAction(Request $request, Product $product)
    {
        if($request->getMethod() == "POST"){

            if ($request->request->get('store_id')) {
                $id = intval($request->get('store')) == 0 ? 1 : intval($request->get('store'));
                $em = $this->getDoctrine()->getManager();
//            dump($request->request->get('store', array()));die;
                foreach ($request->request->get('store', array()) as $color => $sizes) {
                    foreach ($sizes as $size => $count) {
                        $productStore = $em->getRepository('RleeCMSShopBundle:ProductStore')
                            ->findOneBy(array(
                                'size' => $size,
                                'color' => $color,
                                'product' => $product->getId(),
                                'store' => $request->request->get('store_id')
                            ));
                        if (!$productStore) {
                            $productStore = new ProductStore();
                        }
                        $color = $em->getRepository('RleeCMSShopBundle:Color')->find($color);
                        $productStore->setColor($color);
                        $productStore->setProduct($product);

                        $size = $em->getRepository('RleeCMSShopBundle:Size')->find($size);
                        $productStore->setSize($size);

                        $store = $em->getRepository('RleeCMSShopBundle:Store')->find($request->request->get('store_id'));
                        $productStore->setStore($store);
                        $productStore->setCount($count);
//                    var_dump($count);die;
                        $em->persist($productStore);
                        $em->flush();
                    }

                }
            }
            return $this->redirect($this->generateUrl('admin_shop_product_store', array('id' => $product->getId())).'?store='.$id);
        }

        return array(
            'product' => $product,
            'stores' => $this->getDoctrine()->getRepository('RleeCMSShopBundle:Store')->findAll(),
        );
    }

    /**
     * Lists all Product entities.
     *
     * @Route("/content/{id}", name="admin_shop_product_store_content")
     * @Method("GET")
     * @Template()
     */
    public function contentAction(Request $request, Product $product){
        $id = intval($request->get('store')) == 0 ? 1 : intval($request->get('store'));
        $rp = $this->getDoctrine()
            ->getRepository('RleeCMSShopBundle:ProductStore');
        return array(
            'product' => $product,
            'store' => $this->getDoctrine()->getRepository('RleeCMSShopBundle:Store')->find($id),
            'rp' => $rp
        );
    }

    /**
     *
     * @Route("/list/{id}", name="admin_shop_product_store_list")
     * @Template()
     */
    public function listAction(Request $request, Store $store){

        /** qb для дальнейшего внедрения пагинации */
        $repository = $this->getDoctrine()->getRepository('RleeCMSShopBundle:ProductStore');
        $productStores = $repository->createQueryBuilder('ps')
            ->where('ps.store = :storeId')
            ->andWhere('ps.count > 0')
            ->setParameter('storeId',$store->getId())
            ->getQuery()->getResult();

        return array(
            'productStores' => $productStores,
            'store' => $store,
        );

    }

}
