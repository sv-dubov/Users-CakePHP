<?php
$cakeDescription = 'CMS for users';

if (!empty($title)) {
    $this->assign('title', $title);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <?= $this->Html->css(['cake']) ?>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?= $this->Url->build('/') ?>">Home</a></li>
                <?php if ($this->request->getAttribute('identity')): ?>
                    <li><?= $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
                <?php endif ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($this->request->getAttribute('identity')): ?>
                    <li><?= $this->Html->link(__(' Logout'), ['controller' => 'Pages', 'action' => 'logout'], ['class' => 'glyphicon glyphicon-log-out']) ?></li>
                <?php else: ?>
                    <li><?= $this->Html->link(__(' Login'), ['controller' => 'Pages', 'action' => 'login'], ['class' => 'glyphicon glyphicon-log-in']) ?></li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </div>
</div>
</div>

</body>
</html>
