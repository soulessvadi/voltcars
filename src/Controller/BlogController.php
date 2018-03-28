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
class BlogController extends AppController
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
            SELECT COUNT(`id`) as count FROM `osc_articles` WHERE `cat_id` = 4;
        ")->fetch('assoc');

        $num_pages = ceil($count_posts['count'] / $per_page);

        $this->set('num_pages', $num_pages);
        $this->set('cur_page', $cur_page);


        // GET PRODUCTS BY CATEGORY
        $blog_posts = $conn->query("SELECT M.name, M.alias, M.preview, M.order_id, M.content, M.meta_title, M.meta_keys, M.meta_desc, M.dateCreate, M.dateModify, D.id, M.filename, M.is_video FROM `osc_articles` AS M
                                LEFT JOIN `osc_categories` AS D ON 
                                D.alias = '$LA'
                                WHERE M.cat_id = D.id AND M.block = 0 ORDER BY M.id DESC LIMIT $start, $per_page")->fetchAll('assoc');

        





        $this->set('blog_posts', $blog_posts);

        $this->set('date_array', $date_array = ['01' => 'Январь', '02' => 'Февраль', '03' => 'Март', '02' => 'Апрель', '05' => 'Май', '06' => 'Июль', '07' => 'Июнь', '08' => 'Август', '09' => 'Сентябрь', '10' => 'Октябрь', '11' => 'Ноябрь', '12' => 'Декабрь']);

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


    }

    public function blogPost()
    {
        $conn = ConnectionManager::get('default');
        $last_alias = LA;

        $this->set('date_array', $date_array = ['01' => 'Январь', '02' => 'Февраль', '03' => 'Март', '02' => 'Апрель', '05' => 'Май', '06' => 'Июль', '07' => 'Июнь', '08' => 'Август', '09' => 'Сентябрь', '10' => 'Октябрь', '11' => 'Ноябрь', '12' => 'Декабрь']);

        $post_item = $conn->query("
            SELECT `name`, `alias`, `filename`, `meta_title`, `meta_keys`, `meta_desc`, `dateCreate`, `dateModify`, `content`, `is_video` FROM `osc_articles` WHERE `block` = 0 AND `alias` = '$last_alias' LIMIT 1
        ")->fetch('assoc');

            $date_str = $post_item['dateCreate'];
            $date_str = explode('-', $date_str);


        if ($post_item['meta_title']) {
            $this->set('site_title', $site_title = $post_item['meta_title']);
        }
        if ($post_item['meta_desc']) {
            $this->set('site_desc', $site_desc = $post_item['meta_desc']);
        }
        if ($post_item['meta_keys']) {
            $this->set('site_keywords', $site_keywords = $post_item['meta_keys']);
        }


  
        $this->set('post_item', $post_item);
        $this->set('post_date', $post_date = '<p class="date"><span>'.$date_array[$date_str[1]].'</span>'.$date_str[0].'</p>');


        $item_gallery = $conn->query("
                SELECT F.file, F.ref_id
                FROM `osc_files_ref` AS F 
                LEFT JOIN `osc_galleries` AS M ON
                M.id = F.ref_id
                LEFT JOIN `osc_articles` AS P ON
                P.gallery_id = M.id
                WHERE F.ref_table = 'galleries' AND P.alias = '$last_alias'
                LIMIT 1000
                
        ")->fetchAll('assoc');
        $this->set('item_gallery', $item_gallery);




       

    }

    public function blogSearch() {

        $conn = ConnectionManager::get('default');
          
        $data = ['status'=>'failed', 'message'=>'Ajax Error'];
        $date_array = ['01' => 'Январь', '02' => 'Февраль', '03' => 'Март', '02' => 'Апрель', '05' => 'Май', '06' => 'Июль', '07' => 'Июнь', '08' => 'Август', '09' => 'Сентябрь', '10' => 'Октябрь', '11' => 'Ноябрь', '12' => 'Декабрь'];

        $search_key = strip_tags(str_replace('\'', "", $_POST['search_key']));
        $cat_id = 4; // BLOG
        
        if (strlen($search_key)  > 0 ) {
            $blog_posts = $conn->query("SELECT * FROM `osc_articles` WHERE `cat_id` = '$cat_id' AND `block` = 0 AND (`name` LIKE '%$search_key%' OR `content` LIKE '%$search_key%')")->fetchAll('assoc');
        }else{
            $blog_posts = null;
        }
        

        if ($blog_posts) {
            ob_start();
            foreach ($blog_posts as $post) {

                    $date_str = $post['dateCreate'];
                    $post_create_unix = strtotime($date_str);
                    $date_str = explode('-', $date_str);
                    $now = strtotime(date("Y-m-d"));

                    ?>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 blog_post">
                            <a href="<?= $post['alias']; ?>">
                                <?php if (isset($post['filename']) && $post['filename'] != ""): ?>
                                    <div class="img_wr">
                                        <div class="hover">
                                            <p><span>Узнать больше</span></p>
                                        </div>
                                        <img src="<?= BANNER_PATH.$post['filename']; ?>" alt="Post" />
                                    </div>
                                <?php endif ?>
                                <div class="wrap">
                                    <span class="new">
                                        <?php 
                                            if (($now - $post_create_unix) < 8600) {
                                                echo "New";
                                            }else{
                                                echo "";
                                            }
                                        ?>
                                    </span>
                                    <p class="post_name"><?= $post['name']; ?></p>
                                    <p class="text"><?= implode(array_slice(explode('<br>',wordwrap(strip_tags($post['content']),250,'<br>',false)),0,1));?>...</p>
                                    <p class="date"><span><?= $date_array[$date_str[1]];?></span> <?= $date_str[0];?></p>
                                </div>
                            </a>
                        </div>
                    <?php
            }
            $data['html'] = ob_get_contents();
            ob_clean();
            $data['status'] = "success";
            $data['message'] = "Результаты поиска:";
        }else{
            $data['status'] = "failed";
            $data['message'] = "По данному запросу нет результата";
        }
        echo json_encode($data); exit();      
    }

}
