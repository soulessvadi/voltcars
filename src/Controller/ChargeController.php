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
class ChargeController extends AppController
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
