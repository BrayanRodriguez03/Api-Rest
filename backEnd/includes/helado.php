<?php
    require_once('Database.php');

    class helado
    {
        public static function get_all_helado()
        {
            $database = new Database();
            $conn=$database->getConnection();
            $stmt=$conn->prepare('SELECT * FROM helado');
            
            if ($stmt->execute()) {
                $result = $stmt->fetchAll();
                header('HTTP/1.1 202 ok');
                echo json_encode($result);
                return json_encode($result);
            } else {
                header('HTTP/1.1 401 fallo');
                echo "Error en el listado";
            }
        }
        public static function create_helado($nombre,$sabor, $precio, $stock){
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare('INSERT INTO helado (nombre, sabor, precio , stock) VALUES (:nombre, :sabor, :precio, :stock)');
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':sabor', $sabor);
            $stmt->bindParam(':precio', $precio); 
            $stmt->bindParam(':stock', $stock);   
            if ($stmt->execute()) {
                header('HTTP/1.1 201 Created');
                echo json_encode(array("message" => "El helado ha sido creado correctamente."));
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(array("message" => "Error al crear el helado."));
            }
        }

        public static function Delete_helado($id){
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare('DELETE FROM helado WHERE id=:id');
            $stmt->bindParam(':id',$id);
    
            if ($stmt->execute()) {
                http_response_code(200);
                echo json_encode(array("message" => "El helado se borró exitosamente"));
            } else {
                http_response_code(500);
                echo json_encode(array("message" => "No se pudo borrar el helado"));
            }      
        }


        public static function get_id_helado($id){
            $database = new Database();
            $conn = $database->getConnection();
        
            $stmt = $conn->prepare('SELECT * FROM helado WHERE id = :id');
            $stmt->bindParam(':id',$id);
            
        
            if ($stmt->execute()) {
                $result = $stmt->fetchAll();
                header('HTTP/1.1 202 ok');
                echo json_encode($result);
                return json_encode($result);
            } else {
                header('HTTP/1.1 401 fallo');
                echo "Error en el listado";
            }
        }

        
         public static function update_helado($id, $nombre, $sabor, $precio, $stock){
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare('UPDATE helado SET id=:id, nombre=:nombre, sabor=:sabor, precio=:precio, stock=:stock WHERE id=:id');
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':sabor', $sabor); 
            $stmt->bindParam(':precio', $precio); 
            $stmt->bindParam(':stock', $stock);  
            $stmt->bindParam(':id', $id);  
            
            if ($stmt->execute()) {
                header('HTTP/1.1 201 el helado se actualizo correctamente');
                echo json_encode(array("message" => "helado actualizado correctamente."));
            } else {
                header('HTTP/1.1 401 el helado no se pudo actualizar');
                echo json_encode(array("message" => "Nose pudo actualizar el helado."));
            }           
         }     
    }
?>