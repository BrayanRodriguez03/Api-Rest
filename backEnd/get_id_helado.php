<?php
    require('includes/helado.php');

    if ($_SERVER['REQUEST_METHOD'] =='GET' && isset($_GET['id'])) {
          
         Helado::get_id_helado($_GET['id']);
        
    }else{
        echo 'No se envio el Id';
    }


?>