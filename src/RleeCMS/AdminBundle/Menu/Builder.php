<?php
namespace RleeCMS\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Builder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $request = $requestStack->getCurrentRequest();
        $menu = $this->factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'sidebar-menu',
            ),
        ));
        $menu->addChild('Главная', array(
                'route' => 'admin',
                'icon' => 'dashboard',)
        );

        $dropdown = $menu->addChild('CMS', array(
            'uri'=>'#',
            'caret' => true,
            'attributes'=>array('class'=>'treeview'),
            'childrenAttributes' => array(
                'class' => 'treeview-menu',
            )
        ));
        $dropdown->addChild('Типы меню', array('route' => 'admin_cms_menutype',));
        $dropdown->addChild('Меню', array('route' => 'admin_cms_menu',));
        $dropdown->addChild('Страницы', array('route' => 'admin_cms_pages',));
        $dropdown->addChild('Виджеты', array('route' => 'admin_cms_widget',));

        if (strrpos($request->get('_route'), 'admin_cms_menutype_') !== false) {
            $dropdown['Типы меню']->setCurrent(true);
        }
        if (strrpos($request->get('_route'), 'admin_cms_menu_') !== false) {
            $dropdown['Меню']->setCurrent(true);
        }
        if (strrpos($request->get('_route'), 'admin_cms_pages_') !== false) {
            $dropdown['Страницы']->setCurrent(true);
        }
        if (strrpos($request->get('_route'), 'admin_cms_widget_') !== false) {
            $dropdown['Виджеты']->setCurrent(true);
        }

        $dropdown = $menu->addChild('Справочники', array(
            'uri'=>'#',
            'caret' => true,
            'attributes'=>array('class'=>'treeview'),
            'icon' => 'book',
            'childrenAttributes' => array(
                'class' => 'treeview-menu',
            )
        ));
        $dropdown->addChild('Статус', array('route' => 'admin_ref_status',));
        $dropdown->addChild('Методы доставки', array('route' => 'admin_ref_shipping_methods',));
        $dropdown->addChild('Статусы заказа', array('route' => 'admin_ref_order_status',));
        if (strrpos($request->get('_route'), 'admin_ref_status_') !== false) {
            $dropdown['Статус']->setCurrent(true);
        }

        $dropdown = $menu->addChild('Каталог', array(
            'uri'=>'#',
            'caret' => true,
            'attributes'=>array('class'=>'treeview'),
            'icon' => 'shopping-cart',
            'childrenAttributes' => array(
                'class' => 'treeview-menu',
            )
        ));
        $dropdown->addChild('Категории', array('route' => 'admin_shop_category',));
        $dropdown->addChild('Товары', array('route' => 'admin_shop_product',));
        $dropdown->addChild('Размеры', array('route' => 'admin_shop_size',));
        $dropdown->addChild('Фильтры', array('route' => 'admin_shop_settings_filter',));

        $dropdown->addChild('Склады', array('route' => 'admin_shop_store',));
//        $dropdown->addChild('Shop By Look', array('route' => 'admin_shop_shop_by_look',));
        if (strrpos($request->get('_route'), 'admin_shop_category_') !== false) {
            $dropdown['Категории']->setCurrent(true);
        }
        if (strrpos($request->get('_route'), 'admin_shop_product_') !== false) {
            $dropdown['Товары']->setCurrent(true);
        }
        if (strrpos($request->get('_route'), 'admin_shop_size_') !== false) {
            $dropdown['Размеры']->setCurrent(true);
        }
        if (strrpos($request->get('_route'), 'admin_shop_settings_filter') !== false) {
            $dropdown['Фильтры']->setCurrent(true);
        }
        if (strrpos($request->get('_route'), 'admin_shop_store_') !== false) {
            $dropdown['Склады']->setCurrent(true);
        }
        if (strrpos($request->get('_route'), 'admin_shop_shop_by_look') !== false) {
            $dropdown['Категории']->setCurrent(true);
        }
        $dropdown_child = $dropdown->addChild('Настройки', array(
            'uri'=>'#',
            'caret' => true,
            'attributes'=>array('class'=>'treeview'),
//            'icon' => 'shopping-cart',
            'childrenAttributes' => array(
                'class' => 'treeview-menu',
            )
        ));
        $dropdown_child->addChild('Страны', array('route' => 'admin_shop_settings_country',));
        $dropdown_child->addChild('Валюты', array('route' => 'admin_shop_settings_currency',));
        $dropdown_child->addChild('Изображение слайдера', array('route' => 'admin_shop_settings_sliderimage',));
        if (strrpos($request->get('_route'), 'admin_shop_settings_country_') !== false) {
            $dropdown_child['Страны']->setCurrent(true);
        }
        if (strrpos($request->get('_route'), 'admin_shop_settings_currency_') !== false) {
            $dropdown_child['Валюты']->setCurrent(true);
        }
        if (strrpos($request->get('_route'), 'admin_shop_settings_sliderimage_') !== false) {
            $dropdown_child['Изображение слайдера']->setCurrent(true);
        }


        $user = $menu->addChild('Пользователи', array(
            'uri'=>'#',
            'caret' => true,
            'attributes'=>array('class'=>'treeview'),
            'childrenAttributes' => array(
                'class' => 'treeview-menu',
            )
        ));
        $user->addChild('Список', array('route' => 'admin_user',));
        $menu->addChild('Заказы', array('route' => 'admin_orders',));
        $menu->addChild('Настройки', array('route' => 'admin_settings',));

        $menu->addChild('Рассылки', array(
                'route' => 'admin_subscribe',
                'icon' => 'envelope')
        );
        $menu->addChild('Обратная связь', array(
                'route' => 'admin_cms_feedback',
                'icon' => 'envelope')
        );
        if (strrpos($request->get('_route'), 'admin_subscribe_') !== false) {
            $menu['Рассылки']->setCurrent(true);
        }

        return $menu;
    }
}