<?php
use Cake\I18n\FrozenTime;
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <?= __('Users List') ?>
        <?= $this->Html->link(__('Add User'), ['action' => 'add'], ['class' => 'btn btn-success pull-right', 'style' => 'margin-top:-7px;']) ?>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Active</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (count($users) > 0) {
                    foreach ($users as $user) { ?>
                        <tr>
                            <td><?= $user->id ?></td>
                            <td><?= h($user->firstname) ?></td>
                            <td><?= h($user->lastname) ?></td>
                            <td><?= h($user->email) ?></td>
                            <td><?= $user->active ? __('Yes') : __('No'); ?></td>
                            <td><?= FrozenTime::parse($user->created)->i18nFormat('dd-MMM-yyyy HH:mm:ss') ?></td>
                            <td>
                                <?= $this->Html->link('View', ['action' => 'view', $user->id], ['class' => 'btn btn-info']) ?>
                                <?= $this->Html->link('Edit', ['action' => 'edit', $user->id], ['class' => 'btn btn-warning']) ?>
                                <?= $this->Form->postLink('Delete', ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete {0}?', $user->firstname), 'class' => 'btn btn-danger']) ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p class="text-center"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
