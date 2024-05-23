<?php
session_start();
session_destroy();
foreach($_SESSION as $k => $v){
    unset($_SESSION);
}
header('location:./');
exit;