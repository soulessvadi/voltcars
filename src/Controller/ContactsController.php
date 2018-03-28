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
class ContactsController extends AppController
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

    public function contactForm() {
        $conn = ConnectionManager::get('default');   
 
        $contact_mail = TableRegistry::get('osc_total_config')->find()->select(['feedback_email'])->first();
        


        $data = ['status'=>'failed', 'message'=>'Ajax Error'];

        $name = strip_tags(str_replace("'", '\'', $_POST['name']));
        $email = strip_tags(str_replace("'", '\'', $_POST['email']));
        $message = strip_tags(str_replace("'", '\'', $_POST['message']));

        $date = date("Y-m-d H:i:s", time());

        if (strlen($name) >= 2) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (strlen($message) >= 10) {

                        $success=TableRegistry::get('osc_contact_form')
                        ->query()
                        ->insert(['name', 'email', 'message', 'date_created'])
                        ->values(['name' => $name,'email' => $email, 'message' => $message, 'date_created' => $date])
                        ->execute();

                        if ($success) {

                            $to  = "<".$contact_mail['feedback_email'].">"; 
                            $subject = "Новое сообщение на VOLT-CARS.COM.UA";
                            $message = ' 
                            <html> 
                            <head> 
                            <title>Новое сообщение на VOLT-CARS.COM.UA</title> 
                            </head> 
                            <body> 
                            <p style="color: green;">От: '.$name.'</p>
                            <p style="color: green;">Email: '.$email.'</p>
                            <hr />
                            <p>Сообщение: '.$message.'</p>
                            <hr />
                            </body> 
                            </html>';

                            $headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
                            $headers .= "From: noreply@volt-cars.com.ua <noreply@volt-cars.com.ua>\r\n"; 

                            mail($to, $subject, $message, $headers);


                            $data['reason'] = "";
                            $data['status'] = "success";
                            $data['message'] = "Ваше сообщение отправлено";
                        }

                }else{
                    $data['reason'] = "message";
                $data['status'] = "failed";
                $data['message'] = "Сообщение должно содержать минимум 10 символа";
                }
            }else{
                $data['reason'] = "email";
                $data['status'] = "failed";
                $data['message'] = "Введите корректный Email";
            }
        }else{
            $data['reason'] = "name";
            $data['status'] = "failed";
            $data['message'] = "Имя должно содержать минимум 2 символа";
        }

       
        echo json_encode($data); exit();      

    }
    
}
