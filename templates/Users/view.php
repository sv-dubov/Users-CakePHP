<?php
use Cake\I18n\FrozenTime;
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <?= h($user->firstname) ?> Profile
        <?= $this->Html->link(__('Back to List'), ['action' => 'index'], ['class' => 'btn btn-success pull-right', 'style' => 'margin-top:-7px;']) ?>
    </div>
    <div class="panel-body">
        <div class="column-responsive column-80">
            <div class="users view content">
                <table>
                    <tr>
                        <th><?= __('ID:') ?></th>
                        <td><?= $this->Number->format($user->id) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('First Name:') ?></th>
                        <td><?= h($user->firstname) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Last Name:') ?></th>
                        <td><?= h($user->lastname) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Email:') ?></th>
                        <td><?= h($user->email) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created:') ?></th>
                        <td><?= FrozenTime::parse($user->created)->i18nFormat('dd-MMM-yyyy HH:mm:ss') ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Active:') ?></th>
                        <td><?= $user->active ? __('Yes') : __('No'); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
