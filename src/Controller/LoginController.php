<?php
declare(strict_types=1);

namespace App\Controller;

class LoginController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('custom');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the index action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['index']);
    }

    public function index()
    {
        $this->set('title', 'Login');
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $identity = $this->request->getAttribute('identity');
            if($identity->active == true) {
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Users',
                    'action' => 'index',
                ]);
                return $this->redirect($redirect);
            } else {
                $this->Authentication->logout();
                $this->Flash->error(__('You have no access to the CMS'));
                return $this->redirect(['controller' => 'Login', 'action' => 'index']);
            }
        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid email or password'));
        }
    }
}
