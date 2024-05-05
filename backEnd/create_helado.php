<?php 
require_once('includes/helado.php');

if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['nombre']) 
&& isset($_POST['sabor']) && isset($_POST['precio']) && isset($_POST['stock'])){
    Helado::create_helado($_POST['nombre'], $_POST['sabor'], $_POST['precio'], $_POST['stock']);
} else {
    echo 'No se encontraron todos los datos necesarios';
}
?>

