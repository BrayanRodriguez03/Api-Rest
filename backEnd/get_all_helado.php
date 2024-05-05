<?php
require_once('includes/helado.php');
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    Helado::get_all_helado();
}
?>

