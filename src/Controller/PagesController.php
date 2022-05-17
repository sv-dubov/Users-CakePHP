<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('custom');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'forgotPassword', 'display']);
    }

    public function login()
    {
        $this->set('title', 'Login');
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Flash->success(__('You were logged in successfully.'));
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Users',
                'action' => 'index',
            ]);
            return $this->redirect($redirect);
        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid email or password'));
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            $this->Flash->success(__('You were logged out. Bye!'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'login']);
        }
    }

    public function forgotPassword()
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
                    $mailer = new Mailer('default');
                    //$mailer->setTransport('smtp');
                    $mailer->setTransport('gmail');
                    $mailer->setFrom(['sviatoslavdubov85@gmail.com' => 'Users CMS'])
                        ->setTo($email)
                        ->setEmailFormat('html')
                        ->setSubject('New Password Users CMS')
                        ->deliver('Hello!<br/>Your new password is ' . $new_password . '<br/>Try it to <a href="http://localhost:8765/login">Login</a><br/>');
                }
                $this->Flash->success('New password has been sent to your email (' . $email . '). Please, check it');
                return $this->redirect(['controller' => 'Pages', 'action' => 'login']);
            }
            if ($total = $userTable->find('all')->where(['email' => $email])->count() == 0) {
                $this->Flash->error(__('This email is not registered in the system'));
            }
        }
    }

    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function display(string ...$path): ?Response
    {
        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function generateRandomPassword()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz!@#$&()[]<>-+=0123456789';
        $new_password = '';
        for ($i = 0; $i < 10; $i++) {
            $new_password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $new_password;
    }
}
