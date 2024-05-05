<?php 
require_once('includes/helado.php');

if($_SERVER['REQUEST_METHOD']== 'DELETE' && isset($_GET['id'])){
    Helado::delete_helado($_GET['id']);
}
?>