<?php require_once('./auth.php') ?>
<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 mx-auto">
    <h2 class="text-center">User Profile</h2>
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4 mx-auto">
        <hr class="border-primary" style="border-top-width:3px;opacity:1">
    </div>
</div>
<div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 mx-auto">
    <div class="card shadow rounded-0">
        <div class="card-body rounded-0">
            <div class="container">
                <?php foreach($_SESSION['userdata'] as $k => $v): ?>
                <dl class="row">
                    <dt class="col-lg-3 col-md-4 col-sm-12 col-xs-12"><b><?= strtoupper($k) ?>:</b></dt>
                    <dd class="col-lg-9 col-md-8 col-sm-12 col-xs-12"><?= $v ?></dd>
                </dl>
                <?php endforeach; ?>

            </div>
        </div>
        <div class="card-footer rounded-0 text-center">
            <a class="btn btn-danger rounded-0" href="./logout.php" >Logout</a>
        </div>
    </div>
</div>