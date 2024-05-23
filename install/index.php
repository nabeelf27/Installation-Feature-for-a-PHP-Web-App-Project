<?php 
error_reporting(-1);
require_once('./../lib/class.environment.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('header.php') ?>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient">
    <div class="container">
        <a class="navbar-brand" href="./">System Installation</a>
        <div>
            <a href="https://ahmedalimughal.netlify.app/" class="text-light fw-bolder h6 text-decoration-none" target="_blank">Ahmed Ali Mughal</a>
        </div>
    </div>
</nav>
<?php 
$step = isset($_GET['step']) ? $_GET['step'] : '';
switch($step){
    case 1:
        include_once('./pages/step1.php');
        break;
    case 2:
        include_once('./pages/step2.php');
        break;
    case 3:
        include_once('./pages/step3.php');
        break;
    case 4:
        include_once('./pages/step4.php');
        break;
    case 'installation_complete':
        include_once('./pages/installation_complete.php');
        break;
    default:
        include_once('./pages/installation.php');
} 
?>
</body>
</html>