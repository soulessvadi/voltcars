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

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

use Cake\Network\Session\CacheSession;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class CatalogController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index()
    {
        $categories = TableRegistry::get('osc_shop_catalog')->find()->select(['name', 'alias', 'id'])->where(['block'=> 0])->orderAsc('order_id')->limit(1000);
        foreach ($categories as $key) {
            $first_category_alias = $key->alias;
            break;
        }
        header("Location: ".$this->Url->build("/catalog/".$first_category_alias),TRUE,301);
        exit();
    }

    public function category()
    {
        $conn = ConnectionManager::get('default');
        $LA = LA;
        $categories = TableRegistry::get('osc_shop_catalog')->find()->select(['name', 'alias', 'id'])->where(['block'=> 0])->orderAsc('order_id')->limit(1000);
        $this->set('categories', $categories);  

        $get_meta = TableRegistry::get('osc_menu')->find()->select(['meta_title', 'meta_keys', 'meta_desc'])->where(['alias'=>LA])->first();

        if ($get_meta['meta_title']) {
            $this->set('site_title', $site_title = $get_meta['meta_title']);
        }
        if ($get_meta['meta_desc']) {
            $this->set('site_desc', $site_desc = $get_meta['meta_desc']);
        }
        if ($get_meta['meta_keys']) {
            $this->set('site_keywords', $site_keywords = $get_meta['meta_keys']);
        }

        
        foreach ($categories as $key) {
            $first_category_id = $key->id;
            //$first_category_alias = $key->alias;
            break;
        }

       
       //$this->set('first_category_alias', $first_category_alias);


        $cat_id = $first_category_id;

        $products = $conn->query("SELECT M.id, M.quant, M.order_id, M.name, M.price, M.alias, M.dop_text, M.details, F.file, F.path, M.details, M.block, M.currency FROM `osc_shop_products` AS M
                                LEFT JOIN `osc_shop_catalog` AS L ON 
                                L.alias = '$LA' 
                                LEFT JOIN `osc_shop_cat_prod_ref` AS D ON 
                                D.cat_id = L.id 
                                LEFT JOIN `osc_files_ref` AS F ON
                                F.ref_id = M.id
                                WHERE D.prod_id = M.id AND M.block = 0 AND F.ref_table = 'shop_products'
            ")->fetchAll('assoc');

        // $products = $conn->query("
        //     SELECT M.id, M.quant, M.order_id, M.name, M.price, M.alias, M.dop_text, M.details, F.file, F.path, M.details, M.block, M.currency 
        //     FROM `osc_shop_products` AS M 
        //     LEFT JOIN `osc_shop_cat_prod_ref` AS D ON D.cat_id = '$cat_id'
        // ")->fetchAll('assoc');

        $this->set('products', $products);  
    }

    public function item()
    {
        $conn = ConnectionManager::get('default');
        $LA = LA;

        //GET PRODUCT ITEM
        $product_item = $conn->query("SELECT M.id, M.quant, M.details,M.order_id, M.name, M.gallery_id, M.currency, M.price, M.alias, M.dop_text, M.model, M.equipment, M.color_id, M.mileage, M.year, M.ad_options, F.file, F.path, M.title, M.desc, M.keys,
                                    (SELECT `name` FROM `osc_shop_colors` as K WHERE K.id = M.color_id LIMIT 1) as col
                                    FROM `osc_shop_products` AS M
                                    LEFT JOIN `osc_files_ref` AS F ON
                                    F.ref_id = M.id
                                    WHERE M.block = 0 AND M.alias = '$LA' LIMIT 1")->fetch('assoc');
        $this->set('product_item', $product_item);

        $prod_id = $product_item['id'];

        //GET PRODUCT CHARS
        $product_chars = $conn->query("SELECT R.*, CH.name as char_name, CH.measure 
                                        FROM `osc_shop_chars_prod_ref` as R 
                                        LEFT JOIN `osc_shop_chars` as CH on CH.id=R.char_id 
                                        WHERE R.prod_id=$prod_id AND CH.block=0 AND CH.show_site=1 AND R.value<>'' 
                                        GROUP BY R.char_id LIMIT 50
                                        ")->fetchAll('assoc');
        $this->set('product_chars', $product_chars);

        if ($product_item['title']) {
            $this->set('site_title', $site_title = $product_item['title']);
        }
        if ($product_item['desc']) {
            $this->set('site_desc', $site_desc = $product_item['desc']);
        }
        if ($product_item['keys']) {
            $this->set('site_keywords', $site_keywords = $product_item['keys']);
        }



        $g_n = $product_item['gallery_id'];
        $item_gallery = $conn->query("
                SELECT F.file, F.ref_id
                FROM `osc_files_ref` AS F 
                LEFT JOIN `osc_galleries` AS M ON
                M.id = F.ref_id
                LEFT JOIN `osc_shop_products` AS P ON
                P.gallery_id = M.id
                WHERE F.ref_table = 'galleries' AND P.alias = '$LA'
                LIMIT 1000
                
        ")->fetchAll('assoc');
        $this->set('item_gallery', $item_gallery);

 
    }

    public function getCategoryProd() {

        $conn = ConnectionManager::get('default');
          
        $data = ['status'=>'failed', 'message'=>'Ajax Error'];

        $cat_alias = $_POST['value'];
       
        $products = $conn->query("SELECT M.id, M.quant, M.order_id, M.name, M.price, M.alias, M.dop_text, F.file, F.path, M.details, M.block,  M.currency FROM `osc_shop_products` AS M

                                LEFT JOIN `osc_shop_catalog` AS C ON 
                                C.alias = '$cat_alias'

                                LEFT JOIN `osc_shop_cat_prod_ref` AS D ON 
                                D.cat_id = C.id

                                LEFT JOIN `osc_files_ref` AS F ON
                                F.ref_id = M.id

                                WHERE D.prod_id = M.id AND M.block = 0 AND F.ref_table = 'shop_products'
            ")->fetchAll('assoc');





    

        if ($products) {
            ob_start();
            foreach ($products as $key) {
                
                    ?>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 prod_item">
                            <a href="<?php echo $key['alias']; ?>">
                                <div class="img_wr">
                                    <div class="hover">
                                        <p><span>Узнать больше</span></p>
                                    </div>
                                    <img src="<?= PRODUCT_PATH.$key['file']; ?>" alt="Item" class="catalog_image"/>
                                </div>
                                <div class="wrap">
                                    <p><?php echo $key['name']; ?> <span><?php echo $key['dop_text']; ?></span></p>
                                    <p class="price"><?php echo $key['price']; ?> <span>$</span></p>
                                </div>
                            </a>
                        </div>
                    <?php
            }
            $data['html'] = ob_get_contents();
            ob_clean();
            $data['status'] = "success";
            $data['message'] = "success";
        }else{
            $data['status'] = "failed";
            $data['message'] = "<span class='cat_response'>Раздел пуст</span>";
        }
        
        


        echo json_encode($data); exit();      
    }
}
