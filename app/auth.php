<?php 
if(!isset($_SESSION['userdata']) || (isset($_SESSION['userdata']) && !isset($_SESSION['userdata']['id']))){
    echo "<script>location.replace('./?page=home')</script>";
    exit;
}
?>