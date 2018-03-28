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
class HomeController extends AppController
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

        $this->set('reasons', TableRegistry::get('osc_reasons_to_buy')->find()->select(['content'])->limit(1000)->orderAsc('pos_id'));

        $statistics_block = $conn->query("
            SELECT * FROM `osc_design_elem` WHERE `id` = 1
        ")->fetchAll('assoc');
        $this->set('statistics_block', $statistics_block);

        $about_block = $conn->query("
            SELECT * FROM `osc_design_elem` WHERE `id` = 2
        ")->fetchAll('assoc');
        $this->set('about_block', $about_block);

    }
    
    public function slideChange() {
         
        $data = ['status'=>'failed', 'message'=>'Ajax Error'];
        $slide_index = $_POST['value'];
        $pos_id = (int)$_POST['value'];

        $real_limit_pos = $pos_id + 1;

        //GET MAIN BANNER
        $main_banner = TableRegistry::get('osc_banners')->find()->select()->where(['block'=>0])->limit(1)->page($real_limit_pos)->orderAsc('pos_id')->first();

        //GET MOBILE MAIN BANNER
        $main_banner_m = TableRegistry::get('osc_mobile_banners')->find()->select()->where(['pos_id'=>$pos_id, 'block !='=>1])->first();

        $child_banners = [];
        if ($main_banner) {
            $secondary_banner = TableRegistry::get('osc_secondary_banners')->find()->select()->where(['parent'=>$main_banner['id'], 'block !='=>1])->limit(30)->orderAsc('id');

                foreach ($secondary_banner as $key) {
                   array_push($child_banners, ["name"=>$key->name, "file"=>$key->file, "data"=>$key->data, "link"=>$key->link]);
                }
        }

       if (count($child_banners) > 0) {
           ob_start();
            ?>
                <div class="owl-carousel_<?php echo $slide_index; ?> secondary_banner">
                    <?php
                        foreach ($child_banners as $key) {
                            //debug($key['file']); exit();
                            ?>
                                <div class="item">
                                    <img src="<?php echo BANNER_PATH.$key['file']; ?>" alt="" title="" />
                                </div>
                                
                            <?php    
                        } 
                    ?>
                </div>
            <?php
            $data['html'] = ob_get_contents();
            ob_clean();
        }else{
            $data['html'] = "";
        }
        
        

       
        echo json_encode($data); exit();      

    }

    public function testDriveRequestForm() {

        $contact_mail = TableRegistry::get('osc_total_config')->find()->select(['orders_email'])->first();

        $data = ['status'=>'failed', 'message'=>'Ajax Error'];

        $name = strip_tags(str_replace("'", '\'', $_POST['name']));
        $phone = strip_tags(str_replace("'", '\'', $_POST['phone']));
        $date = date("Y-m-d H:i:s", time());

        if (strlen($name) >= 2) {
            if (strlen($phone)>=5) {
                $success=TableRegistry::get('osc_test_drive_orders')
                ->query()
                ->insert(['name', 'phone', 'date_created'])
                ->values(['name' => $name,'phone' => $phone, 'date_created' => $date])
                ->execute();

                if ($success) {

                    $to  = "<".$contact_mail['orders_email'].">"; 
                    $subject = "Новая заявка на VOLT-CARS.COM.UA";
                    $message = ' 
                    <html> 
                    <head> 
                    <title>Новая заявка на VOLT-CARS.COM.UA</title> 
                    </head> 
                    <body> 
                    <p style="color: green;">От: '.$name.'</p>
                    <p style="color: green;">Телефон: '.$phone.'</p>
                    <p style="color: green;">Дата: '.$date.'</p>
                    <hr />

                    </body> 
                    </html>';

                    $headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
                    $headers .= "From: noreply@volt-cars.com.ua <noreply@volt-cars.com.ua>\r\n"; 

                    mail($to, $subject, $message, $headers);

                    $data['reason'] = "";
                    $data['status'] = "success";
                    $data['message'] = "Ваша заявка отправлена";
                }

            }else{
                $data['reason'] = "phone";
                $data['status'] = "failed";
                $data['message'] = "Телефон должен содержать минимум 5 символов";
            }
        }else{
            $data['reason'] = "name";
            $data['status'] = "failed";
            $data['message'] = "Имя должно содержать минимум 2 символа";
        }
        echo json_encode($data); exit();      
    }

    public function getGallery() {
        $conn = ConnectionManager::get('default');

        $data = ['status'=>'failed', 'message'=>'Ajax Error'];

        $gal = (int)$_POST['value'];

        $gallery = $conn->query("
            SELECT M.file, G.name, G.id, M.ref_id
            FROM `osc_files_ref` AS M 
                LEFT JOIN `osc_galleries` AS G ON
                M.ref_id = G.id
            WHERE M.ref_id = G.id AND G.id = '$gal' AND M.ref_table = 'galleries' LIMIT 100 
        ")->fetchAll('assoc');

        $gal_data = $conn->query("
            SELECT * FROM osc_galleries WHERE id = '$gal' LIMIT 1
        ")->fetch('assoc');

  

        $data['caption'] = $gal_data['caption'];
        $data['det'] = $gal_data['data'];


        $this->set('gallery', $gallery);

        if ($gallery) {
            ob_start();
            foreach ($gallery as $item) {  
                ?>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 item">
                        <a href="<?php echo GALLERY_PATH.$item['file']; ?>" class="fancyimage" data-fancybox-group="group">
                            <div class="hover"></div>
                            <img src="<?php echo GALLERY_PATH."crop/335x193_".$item['file']; ?>" alt="Volt-Car" class="img-responsive" />
                        </a>
                    </div>
                <?php
            }
            $data['html'] = ob_get_contents();
            $data['status'] = "success";
            $data['message'] = "success";
            ob_get_clean();
        }else{
            $data['message'] = "failed";
            $data['status'] = "failed";
        }

       
        echo json_encode($data); exit();      

    }
}
