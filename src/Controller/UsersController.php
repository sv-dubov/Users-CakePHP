<?php
declare(strict_types=1);

namespace App\Controller;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('custom');
    }

    public function index()
    {
        $this->set('title', 'Users List');
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
    }

    public function view($id = null)
    {
        $this->set('title', 'User Profile');
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        $this->set(compact('user'));
    }

    public function add()
    {
        $this->set('title', 'Add User');
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been added.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be added. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $this->set('title', 'Edit User');
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be updated. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
