<div class="panel panel-primary">
    <div class="panel-heading">
        <?= __('Edit User') ?>
        <?= $this->Html->link(__('Back to List'), ['action' => 'index'], ['class' => 'btn btn-success pull-right', 'style' => 'margin-top:-7px;']) ?>
    </div>
    <div class="panel-body">
        <?=
        $this->Form->create($user, ['class' => 'form-horizontal'])
        ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="firstname">First Name <span class="required-field"></span></label>
            <div class="col-sm-8">
                <?php echo $this->Form->control('firstname', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Enter First Name']); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="lastname">Last Name <span class="required-field"></span></label>
            <div class="col-sm-8">
                <?php echo $this->Form->control('lastname', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Enter Last Name']); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email <span class="required-field"></span></label>
            <div class="col-sm-8">
                <?php echo $this->Form->control('email', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Enter Email']); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="password">Password</label>
            <div class="col-sm-8">
                <?php echo $this->Form->control('password', ['class' => 'form-control', 'label' => false, 'value' =>'', 'required' => false]); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="active">Active</label>
            <div class="col-sm-2">
                <?php echo $this->Form->control('active', ['label' => false]); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-2">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
