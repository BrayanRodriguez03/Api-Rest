<?php
require('includes/helado.php');
parse_str(file_get_contents("php://input"), $_PUT);

if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_PUT['nombre']) && isset($_PUT['sabor']) && isset($_PUT['precio']) && isset($_PUT['stock']) && isset($_PUT['id'] )) {
Helado::update_helado($_PUT['id'], $_PUT['nombre'], $_PUT['sabor'], $_PUT['precio'], $_PUT['stock']);
} else { echo 'No se proporcionaron los datos necesarios para la actualizacion'; }
?>