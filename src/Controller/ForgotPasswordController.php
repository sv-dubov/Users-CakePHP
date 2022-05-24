<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

class ForgotPasswordController extends AppController
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
        $this->set('title', 'Forgot Password');
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $userTable = TableRegistry::get('Users');
            if ($email == NULL) {
                $this->Flash->error(__('Please, insert your email address'));
            }
            if ($user = $userTable->find('all')->where(['email' => $email])->first()) {
                $new_password = $this->generateRandomPassword();
                $user->password = $new_password;
                if ($userTable->save($user)) {
                    $baseUrl = Router::url('/', true);
                    $mailer = new Mailer('default');
                    //$mailer->setTransport('smtp');
                    $mailer->setTransport('gmail');
                    $mailer->setFrom(['sviatoslavdubov85@gmail.com' => 'Users CMS'])
                        ->setTo($email)
                        ->setEmailFormat('html')
                        ->setSubject('Your New Password from Users CMS')
                        ->deliver('Hello!<br/>Your new password is ' . $new_password . '<br/>Try it to <a href="' . $baseUrl . 'login">Login</a><br/>');
                }
                $this->Flash->success('New password has been sent to your email (' . $email . '). Please, check it');
                return $this->redirect(['controller' => 'Login', 'action' => 'index']);
            }
            if ($total = $userTable->find('all')->where(['email' => $email])->count() == 0) {
                $this->Flash->error(__('This email is not registered in the system'));
            }
        }
    }

    protected function generateRandomPassword()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz!@#$&()[]<>-+=0123456789';
        $new_password = '';
        for ($i = 0; $i < 10; $i++) {
            $new_password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $new_password;
    }
}
