<?php  
 //export.php  
 if(!empty($_FILES["excel_file"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "brizna");  
      $file_array = explode(".", $_FILES["excel_file"]["name"]);  
      if($file_array[1] == "xlsx")  
      {  
         
           include("excel/Classes/PHPExcel/IOFactory.php");
           $output = '';  
           $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr>  
                          <th>codigo Name</th>  
                          <th>nombres</th>  
                          <th>cedula</th>  
                          <th>provincia</th>  
                          <th>canton</th>  
                          <th>sector Name</th>  
                          <th>ruta</th>  
                          <th>secuencia</th>  
                          <th>zona</th>  
                          <th>medidor</th>  
                          <th>estado_id_estado</th>  
                     </tr>  
                     ";  
           $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);  
           foreach($object->getWorksheetIterator() as $worksheet)  
           {  
                $highestRow = $worksheet->getHighestRow();  
                for($row=2; $row<=$highestRow; $row++)  
                {  
                     $codigo = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());  
                     $nombres = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());  
                     $cedula = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());  
                     $provincia = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());  
                      $canton = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(5, $row)->getValue());  
                     $sector = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(6, $row)->getValue());  
                     $ruta = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(7, $row)->getValue());  
                     $secuencia = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(8, $row)->getValue());  
                      $zona = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(9, $row)->getValue());  
                     $medidor = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(10, $row)->getValue());  
                     $estado_id_estado ='1';  
                    
                    // $country = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(5, $row)->getValue());  
                     $query = "  
                     INSERT INTO clientes  
                     (codigo, nombres, cedula, provincia, canton, sector, ruta, secuencia, zona, medidor, estado_id_estado)   
                     VALUES ('".$codigo."', '".$nombres."', '".$cedula."', '".$provincia."', '".$canton."','".$sector."', '".$ruta."', '".$secuencia."', '".$zona."', '".$medidor."', '".$estado_id_estado."')  
                     ";  
                     mysqli_query($connect, $query);  
                     $output .= '  
                     <tr>  
                          <td>'.$codigo.'</td>  
                          <td>'.$nombres.'</td>  
                          <td>'.$cedula.'</td>  
                          <td>'.$provincia.'</td>  
                          <td>'.$canton.'</td>  
                          <td>'.$sector.'</td>  
                          <td>'.$ruta.'</td>  
                          <td>'.$secuencia.'</td>  
                          <td>'.$zona.'</td>  
                          <td>'.$medidor.'</td>  
                          <td>'.$estado_id_estado.'</td> 
                     </tr>  
                     ';  
                }  
           }  
           $output .= '</table>';  
           echo $output;  
      }  
      else  
      {  
           echo '<label class="text-danger">Invalid File</label>';  
      }  
 }  
 ?>  