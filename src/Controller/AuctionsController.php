<?php
namespace App\Controller;

// use Cake\Core\Configure;
// use Cake\Network\Exception\NotFoundException;
// use Cake\View\Exception\MissingTemplateException;
// use Cake\Network\Session\CacheSession;
// use Cake\ORM\TableRegistry;
// use Cake\Datasource\ConnectionManager;

class AuctionsController extends AppController
{
    public function index() {
        $this->set(['woop'=>'woohoo']);
    }
}
