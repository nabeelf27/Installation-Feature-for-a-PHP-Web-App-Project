<?php 
$dir_path = $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI'];
require_once(realpath(__DIR__."/lib/class.environment.php"));
// echo "<pre>";
// print_r($_ENV);
// echo "</pre>";
// exit;
if($_ENV['SITE_INSTALLATION_COMPLETED'] == false){
    header('location:./install');
    exit;
}else{
    header('location:./app');
    exit;

}
?>