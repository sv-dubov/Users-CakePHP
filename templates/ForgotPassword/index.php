<div class="users form">
    <?= $this->Flash->render() ?>
    <div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Forgot Password?</div>
                <div style="float:right; font-size: 90%; position: relative; top:-10px">
                    <?= $this->Html->link("Login", ['controller' => 'Login', 'action' => 'index']) ?>
                </div>
            </div>
            <div style="padding-top:30px" class="panel-body">
                <?= $this->Form->create() ?>
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon required-field"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="email" class="form-control" name="email" placeholder="Your email" required>
                </div>
                <div style="margin-top:10px" class="form-group">
                    <div class="col-sm-12 controls">
                        <button type="submit" class="btn btn-success">Send New Password</button>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
