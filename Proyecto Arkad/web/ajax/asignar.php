<?php


require_once "../modelos/Excel.php";
$insert = new Excel();
$estado=2;
        $lis=$_POST["list"];
           $count = count($lis);
           echo "total de registros".$count."<br>";
//////////////////////////////////////////////////////////////////////////////////
        $list1=$_POST["list1"];
           $count_ma = count($list1);
           echo "total de registros maquina ".$count_ma."<br>";
   //////////////////////////////////////////////////        ////////////////////
      for ($i=0; $i <$count_ma ; $i++) { 
        ////////////////comparar total de interacion del array ,cuantos datos son totales
        echo "test".$i."<br>";
        $user = $_POST['list1'][$i];

        for ($y=0; $y <$count ; $y++) { 
          /////////interacion para contar los usuarios 
        echo "prueba".$y."<br>";
        $contar = $_POST['list'][$y];
             //user es cuadrilla ,contar es cliente
             $insert->insertar($user,$contar);
             $insert->editar_Estado($contar,$estado);
             $insert->editar_Estado_c($user,$estado);
            }//
      }

/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brizna";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
//Update users Set id_users='10' Where  id_employee IN ('3','4')

        $lis=$_POST["list"];
           $count = count($lis);
           echo "total de registros".$count."<br>";
//////////////////////////////////////////////////////////////////////////////////
        $list1=$_POST["list1"];
           $count_ma = count($list1);
           echo "total de registros maquina ".$count_ma."<br>";
   //////////////////////////////////////////////////        ////////////////////
      for ($i=0; $i <$count_ma ; $i++) { 
        ////////////////comparar total de interacion del array ,cuantos datos son totales
        echo "test".$i."<br>";
        $user = $_POST['list1'][$i];

        for ($y=0; $y <$count ; $y++) { 
          /////////interacion para contar los usuarios 
        echo "prueba".$y."<br>";
        $contar = $_POST['list'][$y];
           // echo "string".$contar;
             $consulta = 'INSERT INTO asignar (id_asignar, cuadrilla_id_cuadrilla, clientes_id_clientes) VALUES  ("","'.$user.'"," '. $contar.'")';
              mysqli_query($conn, $consulta);
      }//
      }
*/
?>