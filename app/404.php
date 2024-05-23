<?php 
require_once(realpath(__DIR__."/../lib/class.environment.php"));
?>

<!DOCTYPE html>
<html lang="en">
<?php 
$page_title = "(404) Page Not Found";
?>
<?php include_once('header.php') ?>
<body class="d-flex flex-column justify-content-between">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient col-auto">
        <div class="container">
            <a class="navbar-brand" href="./"><?= $_ENV['SITE_NAME'] ?></a>
            <div>
                <a href="https://ahmedalimughal.netlify.app/" class="text-light fw-bolder h6 text-decoration-none" target="_blank">Ahmed Ali Mughal</a>
            </div>
        </div>
    </nav>
    <main class="col-auto flex-shrink-1 flex-grow-1 py-2">
        <div class="container">
           <h1 class="text-center"><b>404 | Page not Found</b></h1>
        </div>
    </main>
    <footer class="bg-gradient bg-light shadow-top py-4 col-auto">
        <div class="">
            <div class="text-center">
                All Rights Reserved &copy; <?= date("Y") ?> | <span class="text-muted"><?= $_ENV['SITE_NAME'] ?></span>
            </div>
            <div class="text-center">
                <a href="mailto:<?= $_ENV['DEVELOPER_EMAIL'] ?>" class="text-decoration-none text-success"><?= $_ENV['DEVELOPER_NAME'] ?></a>
            </div>
        </div>
    </footer>
</body>
</html>