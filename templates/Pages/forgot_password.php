<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>Forgot Password</h3>
    <?= $this->Form->create() ?>
    <?= $this->Form->control('email'); ?>
    <?= $this->Form->submit(__('Send New Password')) ?>
    <?= $this->Form->end() ?>
</div>
