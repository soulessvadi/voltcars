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
class ElectrocarsController extends AppController
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
       $conn = ConnectionManager::get('default');
        $LA = LA;

        // PAGINATION

        $per_page = 9;
        $cur_page = 1;
        if (isset($_GET['page']) && $_GET['page'] > 0) 
        {
            $cur_page = $_GET['page'];
        }
        $start = ($cur_page - 1) * $per_page;

        $count_posts = $conn->query("
            SELECT COUNT(`id`) as count FROM `osc_articles` WHERE `cat_id` = 5;
        ")->fetch('assoc');

        $num_pages = ceil($count_posts['count'] / $per_page);

        $this->set('num_pages', $num_pages);
        $this->set('cur_page', $cur_page);


        // GET PRODUCTS BY CATEGORY
        $electrocars = $conn->query("SELECT M.name, M.alias, M.filename, M.order_id, M.content, M.meta_title, M.meta_keys, M.meta_desc, M.dateCreate, M.dateModify, D.id, M.block FROM `osc_articles` AS M
                                LEFT JOIN `osc_categories` AS D ON 
                                D.alias = '$LA'
                                WHERE M.cat_id = D.id AND M.block = 0 ORDER BY M.pos_id LIMIT $start, $per_page")->fetchAll('assoc');



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

        
        
        $this->set('electrocars', $electrocars);
        
    }
    public function itemCar()
    {
        $conn = ConnectionManager::get('default');
        $this->set('car_item', $car_item = TableRegistry::get('osc_articles')->find()->select(['name', 'alias', 'filename', 'meta_title', 'meta_keys', 'meta_desc', 'dateCreate', 'dateModify', 'content', 'gallery_id'])->where(['block'=>0, 'alias'=>LA])->first());


          if ($car_item['meta_title']) {
            $this->set('site_title', $site_title = $car_item['meta_title']);
          }
          if ($car_item['meta_desc']) {
              $this->set('site_desc', $site_desc = $car_item['meta_desc']);
          }
          if ($car_item['meta_keys']) {
              $this->set('site_keywords', $site_keywords = $car_item['meta_keys']);
          }


       $gal = $car_item['gallery_id'];
       $LA = LA;
       $gallery = $conn->query("
            SELECT M.file
            FROM `osc_files_ref` AS M
            LEFT JOIN `osc_galleries` AS G ON 
            G.id = M.ref_id 
            LEFT JOIN `osc_articles` AS A ON 
            A.gallery_id = G.id
            WHERE M.ref_table = 'galleries' AND A.block = 0 AND A.alias = '$LA' ORDER BY A.order_id LIMIT 1000
        ")->fetchAll('assoc');

      $this->set('gallery', $gallery);

      $last_alias = LA;
      $gal_cap = $conn->query("
            SELECT M.caption, M.data FROM osc_galleries AS M
            LEFT JOIN `osc_articles` AS A ON A.alias = '$last_alias'
            WHERE A.gallery_id = M.id
        
        ")->fetchAll('assoc');


      $this->set('gal_cap', $gal_cap);




    }
    public function ajax() {
        $conn = ConnectionManager::get('default');   
        if($this->request->is('ajax')) {
            $this->autoRender=false;
            $response_data = array('status'=>'failed', 'message'=>'Fatal ajax error');
            $actionName = $_POST['action'];
            switch($actionName){
                case 'default': {
                    
                    break;
                }

                default: break;
            }
            echo json_encode($response_data);         
        }
    }
}
