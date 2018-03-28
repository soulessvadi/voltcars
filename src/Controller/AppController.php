<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

use Cake\Network\Session\CacheSession;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;



/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        \Cake\Cache\Cache::clear(false);
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');


        $conn = ConnectionManager::get('default');
        define('RS', '/');
        define('BANNER_PATH', RS.'split/files/images/');
        define('PRODUCT_PATH', RS.'split/files/shop/products/');
        define('GALLERY_PATH', RS.'split/files/content/');

        //GET MENU
        $this->set('nav_menu', TableRegistry::get('osc_menu')->find()->select(['name', 'alias', 'target'])->where(['block'=>0])->limit(1000)->orderAsc('pos_id'));
        //GET SITE INFO
        $site_info = TableRegistry::get('osc_total_config')->find()->select()->first();
        $this->set('site_name', $site_name = $site_info['site_name']);
        $this->set('site_title', $site_title = $site_info['meta_title']);
        $this->set('site_desc', $site_desc = $site_info['meta_desc']);
        $this->set('site_keywords', $site_keywords = $site_info['meta_keys']);
        $this->set('site_address', $site_address = $site_info['address']);
        $this->set('header_phone', $header_phone = $site_info['header_phone']);
        $this->set('site_phone1', $site_phone1 = $site_info['phone_number']);
        $this->set('site_phone2', $site_phone2 = $site_info['phone_number2']);
        $this->set('site_phone3', $site_phone3 = $site_info['phone_number3']);
        $this->set('fb_link', $fb_link = $site_info['fb_link']);
        $this->set('vk_link', $vk_link = $site_info['vk_link']);
        $this->set('gp_link', $gp_link = $site_info['gp_link']);
        $this->set('yt_link', $yt_link = $site_info['yt_link']);
        $this->set('site_email', $site_email = $site_info['support_email']);
        $this->set('site_index', $site_index = $site_info['index']);


        //GET MAIN BANNER
        $mb = TableRegistry::get('osc_banners')->find()->select(['id'])->where(['block !='=>1])->orderAsc('pos_id')->first();

        $this->set('main_banner', TableRegistry::get('osc_banners')->find()->select()->where(['block'=>0])->orderAsc('pos_id')->limit(1000));
        //GET SECONDARY BANNER
        $this->set('main_banner_sec', TableRegistry::get('osc_secondary_banners')->find()->select()->where(['block'=>0, 'parent'=>$mb['id']])->limit(1000));

        
        //GET MOBILE MAIN BANNER
        $this->set('main_banner_m', TableRegistry::get('osc_mobile_banners')->find()->select()->where(['block !='=>1])->orderAsc('pos_id')->limit(1000));

        $this->set('header_logo', TableRegistry::get('osc_logo')->find()->select(['file'])->where(['alias'=>'logo_header'])->first());
        $this->set('footer_logo', TableRegistry::get('osc_logo')->find()->select(['file'])->where(['alias'=>'logo_footer'])->first());
        $this->set('mobile_logo', TableRegistry::get('osc_logo')->find()->select(['file'])->where(['alias'=>'logo_mobile'])->first()); 

        $this->set('test_drive_desctop', TableRegistry::get('osc_logo')->find()->select(['file'])->where(['alias'=>'test_drive_desctop'])->first());
        $this->set('test_drive_mobile', TableRegistry::get('osc_logo')->find()->select(['file'])->where(['alias'=>'test_drive_mobile'])->first());

        $this->set('section_compare_desktop', TableRegistry::get('osc_logo')->find()->select(['file'])->where(['alias'=>'section_compare_desktop'])->first());
        $this->set('section_compare_mobile', TableRegistry::get('osc_logo')->find()->select(['file'])->where(['alias'=>'section_compare_mobile'])->first());
        $this->set('section_5_reasons_desktop', TableRegistry::get('osc_logo')->find()->select(['file'])->where(['alias'=>'section_5_reasons_desktop'])->first());
        $this->set('section_5_reasons_mobile', TableRegistry::get('osc_logo')->find()->select(['file'])->where(['alias'=>'section_5_reasons_mobile'])->first());
        $this->set('modal_bg', TableRegistry::get('osc_logo')->find()->select(['file'])->where(['alias'=>'modal_bg'])->first());


        // SITE MAP

        $menu_links = array();
        $art_links = array();
        $catalog_cat_links = array();
        $catalog_prod_links = array();
        $blog_links = array();
        $electrocars_links = array();

        //MENU
        $map_query = $conn->query("
            SELECT `name`, `alias` FROM `osc_menu` WHERE `block` = 0 ORDER BY `id` LIMIT 1000;
        ")->fetchAll('assoc');
        foreach ($map_query as $key) {
            $menu_links[$key['name']] = $key['alias'];
        }

        // BLOG
        if (isset($menu_links['Блог'])) {
            $map_query = $conn->query("
                SELECT `name`, `alias` FROM `osc_articles` WHERE `block` = 0 AND `cat_id` = 4 ORDER BY `id` LIMIT 1000;
            ")->fetchAll('assoc');
            foreach ($map_query as $key) {
                $blog_links[$key['name']] = $key['alias'];
            }
        }else{
            $blog_links = [];
        }
        

        // ELECTROCARS
        $map_query = $conn->query("
            SELECT `name`, `alias` FROM `osc_articles` WHERE `block` = 0 AND `cat_id` = 5 ORDER BY `id` LIMIT 1000;
        ")->fetchAll('assoc');
        foreach ($map_query as $key) {
            $electrocars_links[$key['name']] = $key['alias'];
        }

        // CATALOG CATEGORIES
        $map_query = $conn->query("
            SELECT `name`, `alias` FROM `osc_shop_catalog` WHERE `block` = 0 ORDER BY `id` LIMIT 1000;
        ")->fetchAll('assoc');
        foreach ($map_query as $key) {
            $catalog_cat_links[$key['name']] = $key['alias'];
        }

        // PRODUCTS
        $map_query = $conn->query("
            SELECT `name`, `alias`
            FROM `osc_shop_products` WHERE `block` = 0  ORDER BY `id` LIMIT 1000;
        ")->fetchAll('assoc');
        foreach ($map_query as $key) {
            $catalog_prod_links[$key['name']] = $key['alias'];
        }

        $this->set('menu_links', $menu_links);
        $this->set('blog_links', $blog_links);
        $this->set('electrocars_links', $electrocars_links);
        $this->set('catalog_cat_links', $catalog_cat_links);
        $this->set('catalog_prod_links', $catalog_prod_links);


        $catalogMap = $conn->query("
            SELECT `id`,`name`, `alias` FROM `osc_shop_catalog` WHERE `block` = 0 ORDER BY `id` LIMIT 1000;
        ")->fetchAll('assoc');

        foreach($catalogMap as &$sCat)
        {
            $sCat['prodItems'] = $conn->query("
                    SELECT P.name, P.alias 
                    FROM `osc_shop_products` as P  
                    LEFT JOIN `osc_shop_cat_prod_ref` as R ON R.prod_id=P.id 
                    WHERE R.cat_id=".$sCat['id']." AND P.block = 0  
                    GROUP BY R.id  
                    LIMIT 1000
                ")->fetchAll('assoc');
        }

        // echo '<pre>'; print_r($catalogMap); echo '</pre>'; exit();

        $this->set('catalogMap', $catalogMap);


        // GET FA AND LA
        $ri_trim = trim($_SERVER['REQUEST_URI'],'/\\');
        $ri = explode("/",$ri_trim);
        if(!$ri){
            header("Location: ".RS."404/");
            exit();
        }else{ 
            if(count($ri) > 1){
                if($ri[0]=="volt-cars.com.ua") array_shift($ri);
            }
            if(strpos($ri[0], "index.php") !== false || trim($ri[0]) == "" || $ri[0] =="volt-cars.com.ua"){ 
                $ri[0] = "home";
            }
            $lastAlias = $ri[count($ri)-1];
            if($lastAlias[0]=='?' && count($ri) > 1){
                $lastAlias = $ri[count($ri)-2];
            }
            define("FA",$ri[0]);   
            define("LA",$lastAlias);
        }     

        // GET PAGE CONTENT

        $this->set('page_content', TableRegistry::get('osc_menu')->find()->select(['name', 'details', 'header', 'sub_header'])->where(['alias'=>LA, 'block'=>0])->first());

        //GET GALLERY

        $gallery_list = $conn->query("
            SELECT * FROM `osc_galleries` WHERE block = 0 LIMIT 100
        ")->fetchAll('assoc');


        $gallery = $conn->query("
            SELECT * FROM osc_files_ref WHERE `ref_id` = (SELECT id FROM osc_galleries WHERE block = 0 ORDER BY id LIMIT 1) AND `ref_table` = 'galleries'
        ")->fetchAll('assoc');

        $gal_data = $conn->query("
            SELECT * FROM osc_galleries WHERE 1 LIMIT 1
        ")->fetch('assoc');

        $intro_head = $conn->query("
            SELECT M.intro_head as head_scr
            FROM `osc_total_config` AS M
            LIMIT 1
        ")->fetch('assoc');
        $this->set('intro_head', $intro_head);

        $intro_foot = $conn->query("
            SELECT M.intro_foot as foot_scr
            FROM `osc_total_config` AS M
            LIMIT 1
        ")->fetch('assoc');
        $this->set('intro_foot', $intro_foot);

        $this->set('gallery_list', $gallery_list);
        $this->set('gallery', $gallery);
        $this->set('gal_data', $gal_data);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {

        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

}
