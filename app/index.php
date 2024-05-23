<?php 
session_start();
require_once(realpath(__DIR__."/../lib/class.environment.php"));
if($_ENV['SITE_INSTALLATION_COMPLETED'] == false){
    header('location:./../install');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php 
$page_title = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 'home';
$page_title = str_replace("_", " ", $page_title);
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
    <main class="col-auto flex-shrink-1 flex-grow-1 py-2 overflow-auto">
        <div class="container">
           <?php 
            $page = isset($_GET['page']) ? $_GET['page'] : "home";
            if(!is_file("./{$page}.php")){
                echo "<script>location.replace('404.php')</script>";
                exit;
            }else{
                include_once("./{$page}.php");
            }
           ?>
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