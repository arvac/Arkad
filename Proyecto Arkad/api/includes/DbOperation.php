<?php

class DbOperation
{
    private $con;

    function __construct()
    {
        require_once dirname(__FILE__) . '/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }

    //Method to create a new user
    function regis($id_c, $id_a, $corte, $lectura, $fotos1, $fotos2,$estado)
    {
     
            $stmt = $this->con->prepare("INSERT INTO register (id_c, id_a, corte, lectura, fotos1, fotos2, estado) VALUES (?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("sssssss", $id_c, $id_a, $corte, $lectura, $fotos1, $fotos2, $estado);
            if ($stmt->execute())
            return true;
        
        return false;
    }
    function actualizar($estado, $id_clientes)
    {
        $stmt1 = $this->con->prepare("UPDATE clientes SET estado_id_estado = ? WHERE id_clientes = ?");
        $stmt1->bind_param("ss", $estado, $id_clientes);
        if ($stmt1->execute())
            return true;
        
        return false;
    }
    //Method to create a new user
    function registerUser($nombres, $direccion, $email, $password_pass, $administrador_id_administrador, $estado_id_estado)
    {
        if (!$this->isUserExist($email)) {
            $password = md5($password_pass);
            $stmt = $this->con->prepare("INSERT INTO cuadrilla (nombres, direccion, email, password, administrador_id_administrador, estado_id_estado) VALUES (?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("ssssss", $nombres, $direccion, $email, $password, $administrador_id_administrador, $estado_id_estado);
            if ($stmt->execute())
                return USER_CREATED;
            return USER_CREATION_FAILED;
        }
        return USER_EXIST;
    }

    //Method to create a new iMAGE
    function registerImages($image_name, $image)
    {
    
           
            $stmt = $this->con->prepare("INSERT INTO imagetable (img_name, img_path) VALUES (?, ?)");
            $stmt->bind_param("iiss", $image_name, $image);
            if ($stmt->execute())
                 return true;
        return false;
    }

    //Method for user login
    function userLogin($email, $password_pass)
    {
       $password = md5($password_pass);
        $stmt = $this->con->prepare("SELECT id_cuadrilla FROM cuadrilla WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    //Method to send a message to another user
    function sendMessage($from, $to, $title, $message)
    {
        $stmt = $this->con->prepare("INSERT INTO messages (from_users_id, to_users_id, title, message) VALUES (?, ?, ?, ?);");
        $stmt->bind_param("iiss", $from, $to, $title, $message);
        if ($stmt->execute())
            return true;
        return false;
    }

    //Method to update profile of user
    function updateProfile($id, $name, $email, $pass, $gender)
    {
        $password = md5($pass);
        $stmt = $this->con->prepare("UPDATE users SET name = ?, email = ?, password = ?, gender = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $name, $email, $password, $gender, $id);
        if ($stmt->execute())
            return true;
        return false;
    }

    //carga la data asignado al personal de cuadrilla 
    function getPlanificados($userid)
    {
        $stmt = $this->con->prepare("SELECT cl.id_clientes, a.id_asignar,  cl.codigo ,cl.nombres FROM cuadrilla c INNER JOIN asignar a ON c.id_cuadrilla = a.cuadrilla_id_cuadrilla INNER JOIN clientes cl ON cl.id_clientes = a.clientes_id_clientes WHERE c.id_cuadrilla = ? AND cl.estado_id_estado= '2' ");
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $stmt->bind_result($id_clientes , $id_asignar, $codigo, $nombres);

        $messages = array();

        while ($stmt->fetch()) {
            $temp = array();
            $temp['id_clientes'] = $id_clientes;
            $temp['id_asignar'] = $id_asignar;
            $temp['nombres'] = $nombres;
            $temp['codigo'] = $codigo;
           
      
            array_push($messages, $temp);
        }

        return $messages;
    }
     //Method to get messages of a particular user
     function getCuadrilla($cuadrillaid)
     {
         $stmt = $this->con->prepare("SELECT cl.id_clientes, a.cuadrilla_id_cuadrilla, c.nombres, cl.codigo FROM cuadrilla c INNER JOIN asignar a ON c.id_cuadrilla = a.cuadrilla_id_cuadrilla INNER JOIN clientes cl ON cl.id_clientes = a.clientes_id_clientes WHERE id_cuadrilla = ?");
         $stmt->bind_param("i", $cuadrillaid);
         $stmt->execute();
         $stmt->bind_result($id_clientes, $id_asignar, $codigo, $nombres);
 
         $messages = array();
 
         while ($stmt->fetch()) {
             $temp = array();
             $temp['id_clientes'] = $id_clientes;
             $temp['id_asignar'] = $id_asignar;
             $temp['nombres'] = $nombres;
             $temp['codigo'] = $codigo;
            
       
             array_push($messages, $temp);
         }
 
         return $messages;
     }

    //Method to get user by email
    function getUserByEmail($email)
    {
        $stmt = $this->con->prepare("SELECT id_cuadrilla, nombres, direccion, email FROM cuadrilla WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id_cuadrilla, $nombres, $email, $password);
        $stmt->fetch();
        $user = array();
        $user['id_cuadrilla'] = $id_cuadrilla;
        $user['nombres'] = $nombres;
        $user['email'] = $email;
        $user['direccion'] = $password;
        return $user;
    }

    //Method to get all users
    function getAllUsers(){
        $stmt = $this->con->prepare("SELECT id, name, email, gender FROM users");
        $stmt->execute();
        $stmt->bind_result($id, $name, $email, $gender);
        $users = array();
        while($stmt->fetch()){
            $temp = array();
            $temp['id'] = $id;
            $temp['name'] = $name;
            $temp['email'] = $email;
            $temp['gender'] = $gender;
            array_push($users, $temp);
        }
        return $users;
    }

    //Method to check if email already exist
    function isUserExist($email)
    {
        $stmt = $this->con->prepare("SELECT id_cuadrilla FROM cuadrilla WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
}