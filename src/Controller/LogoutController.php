<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Logout Controller
 *
 * @method \App\Model\Entity\Logout[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogoutController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }

    public function index()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            $this->Flash->success(__('You were logged out. Bye!'));
            return $this->redirect(['controller' => 'Login', 'action' => 'index']);
        }
    }
}
