<?php
require 'header.php';
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                 
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Asignar
                      </button>

                    <form mehtod="post" id="export_excel">  
                                                  <h1 class="box-title">Seleccionar Excel
                                                   <input  class="btn btn-success" type="file" name="excel_file" id="excel_file" />  </h1>
                    </form>  
                  
      
                        <div class="box-tools pull-right">

                        </div>
                              
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>id</th>
                            <th>codigo</th>
                            <th>nombres</th>
                            <th>cedula</th>
                            <th>provincia</th>
                            <th>canton</th>
                            <th>sector</th>
                            <th>ruta</th>
                            <th>secuencia</th>
                            <th>zona</th>
                            <th>medidor</th>
                            <th>estado_id_estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>id</th>
                            <th>codigo</th>
                            <th>nombres</th>
                            <th>cedula</th>
                            <th>provincia</th>
                            <th>canton</th>
                            <th>sector</th>
                            <th>ruta</th>
                            <th>secuencia</th>
                            <th>zona</th>
                            <th>medidor</th>
                            <th>estado_id_estado</th>
                          </tfoot>
                        </table>
                    </div>
            
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Lista Cuadrilla</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                      <table id="listar_cuadrilla" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>id</th>
                            <th>nombres</th>
                            <th>direccion</th>
                            <th>administrador</th>
                    
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>id</th>
                            <th>nombres</th>
                            <th>direccion</th>
                            <th>administrador</th>
                         
                          </tfoot>
                        </table>
                         <div id="result"></div>  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="submit">Asignar</button>
          </div>
        </div>
      </div>
    </div>
  <!--Fin-Contenido-->
<?php
require 'footer.php';
?>
<script>  
 $(document).ready(function(){  
      $('#excel_file').change(function(){  
           $('#export_excel').submit();  
           alert('documento cargado con exito');
           location.reload();
      });  
      $('#export_excel').on('submit', function(event){  
           event.preventDefault();  
           $.ajax({  
                url:"../lib/export.php",  
                method:"POST",  
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
                success:function(data){  
                     $('#result').html(data);  
                     $('#excel_file').val('');  
                }  
           });  
      });  
 });  
 </script>  

<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/excel.js"></script>