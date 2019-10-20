<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\UploadedFileInterface as Uploaded;
use Slim\Http\UploadedFile;

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';
require_once '../includes/DbOperation.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);
$container = $app->getContainer();
$container['upload_directory'] = __DIR__ . '/uploads';
$container['upload_directory'] ='../photos/';
$app->post('/photo', function (Request $request, Response  $response) use ($app) {

    $directory = $this->get('upload_directory');
    
    $uploadedFiles = $request->getUploadedFiles();
    
    $uploadedFile = $uploadedFiles['picture'];
      if($uploadedFile->getError() === UPLOAD_ERR_OK) {
        $filename = moveUploadedFile1($directory, $uploadedFile);
        $response->write('uploaded ' . $filename . '<br/>');
     }
    
     });
     function moveUploadedFile1($directory, UploadedFile $uploadedFile){
        $extension = pathinfo($uploadedFile->getClientFilename(), 
        PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8));
        $filename = sprintf('%s.%0.8s', $basename, $extension);
        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
       
       return $filename;
       }

//registering a new user 
$app->post('/regis', function (Request $request, Response $response) {

        $directory = $this->get('upload_directory');
        $uploadedFiles = $request->getUploadedFiles();

        $requestData = $request->getParsedBody();
        $id_c = $requestData['id_c'];
        $id_a = $requestData['id_a'];
        
        $corte = $requestData['corte'];
        $lectura = $requestData['lectura'];
        $uploadedFile = $uploadedFiles['fotos1'];
        $uploadedFile1 = $uploadedFiles['fotos2'];
  
        $estado = $requestData['estado'];
       
        $id_clientes =$requestData['id_clientes'];;

        $db = new DbOperation();
        $responseData = array();
        $responseData1 = array();

            
       
    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        $fotos1 = moveUploadedFile($directory, $uploadedFile);
        $fotos2 = moveUploadedFile($directory, $uploadedFile1);
    }

         if ($db->regis($id_c, $id_a, $corte, $lectura, $fotos1, $fotos2, $estado,  $id_clientes)) {
            $responseData['error'] = false;
            $responseData['message'] = 'Message sent successfully';
            if ($db->actualizar( $estado, $id_clientes)) {
                $responseData1['error'] = false;
                $responseData1['message'] = 'actualizado';
            } else {
                $responseData1['error'] = true;
                $responseData1['message'] = 'sinactuaizar';
            }
    
            $response->getBody()->write(json_encode($responseData1));
        } else {
            $responseData['error'] = true;
            $responseData['message'] = 'Could not send message';
        }

        $response->getBody()->write(json_encode($responseData));
        
        
    
});
function moveUploadedFile($directory, UploadedFile $uploadedFile)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $fotos1 = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $fotos1);

    return $fotos1;
}
//registering a new user
$app->post('/register', function (Request $request, Response $response) {
    if (isTheseParametersAvailable(array('nombres', 'direccion', 'email', 'password','administrador_id_administrador','estado_id_estado'))) {
        $requestData = $request->getParsedBody();
        $nombres = $requestData['nombres'];
        $direccion = $requestData['direccion'];
        $email = $requestData['email'];
        $password = $requestData['password'];
        $administrador_id_administrador = $requestData['administrador_id_administrador'];
        $estado_id_estado = $requestData['estado_id_estado'];

        $db = new DbOperation();
        $responseData = array();

        $result = $db->registerUser($nombres, $direccion, $email, $password, $administrador_id_administrador, $estado_id_estado );

        if ($result == USER_CREATED) {
            $responseData['error'] = false;
            $responseData['message'] = 'Registered successfully';
           //

           // $responseData['user'] = $db->getUserByEmail($email);
        } elseif ($result == USER_CREATION_FAILED) {
            $responseData['error'] = true;
            $responseData['message'] = 'Some error occurred';
        } elseif ($result == USER_EXIST) {
            $responseData['error'] = true;
            $responseData['message'] = 'This email already exist, please login';
        }

        $response->getBody()->write(json_encode($responseData));
    }
});

//registering image
$app->post('/image', function (Request $request, Response $response) {
    if (isTheseParametersAvailable(array('image_name', 'image'))) {
        $requestData = $request->getParsedBody();
        $image_name = $requestData['image_name'];
        $image = $requestData['image'];
     
        $db = new DbOperation();
        $responseData = array();

        $result = $db->registerImages($image_name, $image);

       
        $response->getBody()->write(json_encode($responseData));
    }
});


//user login route
$app->post('/login', function (Request $request, Response $response) {
    if (isTheseParametersAvailable(array('email', 'password'))) {
        $requestData = $request->getParsedBody();
        $email = $requestData['email'];
        $password = $requestData['password'];
 
        $db = new DbOperation();

        $responseData = array();

        if ($db->userLogin($email, $password)) {
            $responseData['error'] = false;
             $responseData['message'] = 'correctamente logueado';
              $responseData['user'] = $db->getUserByEmail($email);
        } else {
            $responseData['error'] = true;
            $responseData['message'] = 'Invalid email or password';
        }

        $response->getBody()->write(json_encode($responseData));
    }
});

//getting all users
$app->get('/users', function (Request $request, Response $response) {
    $db = new DbOperation();
    $users = $db->getAllUsers();
    $response->getBody()->write(json_encode(array("users" => $users)));
});

//getting all users
$app->get('/cuadrilla/{id}', function (Request $request, Response $response) {
    $cuadrillaid = $request->getAttribute('id');
    $db = new DbOperation();
    $cuadrilla = $db->getCuadrilla($cuadrillaid);
    $response->getBody()->write(json_encode(array("cuadrilla" => $cuadrilla)));
});
//estos parametro esta usando en la api
$app->get('/planificados/{id}', function (Request $request, Response $response) {
    $userid = $request->getAttribute('id');
    $db = new DbOperation();
    $messages = $db->getPlanificados($userid);
    $response->getBody()->write(json_encode(array("messages" => $messages)));
});

//updating a user
$app->post('/update/{id}', function (Request $request, Response $response) {
    if (isTheseParametersAvailable(array('name', 'email', 'password', 'gender'))) {
        $id = $request->getAttribute('id');

        $requestData = $request->getParsedBody();

        $name = $requestData['name'];
        $email = $requestData['email'];
        $password = $requestData['password'];
        $gender = $requestData['gender'];


        $db = new DbOperation();

        $responseData = array();

        if ($db->updateProfile($id, $name, $email, $password, $gender)) {
            $responseData['error'] = false;
            $responseData['message'] = 'Updated successfully';
            $responseData['user'] = $db->getUserByEmail($email);
        } else {
            $responseData['error'] = true;
            $responseData['message'] = 'Not updated';
        }

        $response->getBody()->write(json_encode($responseData));
    }
});


//sending message to user
$app->post('/sendmessage', function (Request $request, Response $response) {
    if (isTheseParametersAvailable(array('from', 'to', 'title', 'message'))) {
        $requestData = $request->getParsedBody();
        $from = $requestData['from'];
        $to = $requestData['to'];
        $title = $requestData['title'];
        $message = $requestData['message'];

        $db = new DbOperation();

        $responseData = array();

        if ($db->sendMessage($from, $to, $title, $message)) {
            $responseData['error'] = false;
            $responseData['message'] = 'Message sent successfully';
        } else {
            $responseData['error'] = true;
            $responseData['message'] = 'Could not send message';
        }

        $response->getBody()->write(json_encode($responseData));
    }
});

//function to check parameters
function isTheseParametersAvailable($required_fields)
{
    $error = false;
    $error_fields = "";
    $request_params = $_REQUEST;

    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        $response = array();
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echo json_encode($response);
        return false;
    }
    return true;
}


$app->run();