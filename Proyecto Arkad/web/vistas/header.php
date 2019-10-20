<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ITVentas | www.incanatoit.com</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
   <script type="text/javascript">
    $(document).ready(function(){

    // submit button click
    $("#submit").click(function(){
     alert('submit c');
   
        var lang = [];
         var langm = [];

        // Initializing array with Checkbox checked values
        $("input[name='prolang']:checked").each(function(){
            lang.push(this.value);
            alert(lang);
        });
         // Initializing array with Checkbox checked values
        $("input[name='prolangm']:checked").each(function(){
            langm.push(this.value);
            alert(langm);
        });
    
            $.ajax({
                url: '../ajax/asignar.php',
                type: 'post',
                data: {list:lang,list1:langm},
              
             success:function(data){  
             $('#result').html(data);  
                                   } 


            });
        
    });

});
</script>
  </head>
  <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Arkad</b>IT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Arkad</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../public/dist/img/zu.png" class="user-image" alt="User Image">
                  <span class="hidden-xs">Usuario</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../public/dist/img/zu.png" class="img-circle" alt="User Image">
                    <p>
                      www.brizna.com - Desarrolladora Consultora de Software
                      <small>linkedin</small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            <li>
              <a href="#">
                <i class="fa fa-tasks"></i> <span>Bienvenido</span>
              </a>
            </li>            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Tareas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="excel.php"><i class="fa fa-circle-o"></i> Por Planificar</a></li>
                <li><a href="planificados.php"><i class="fa fa-circle-o"></i> Planificados</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="grupotrabajo.php">
                <i class="fa fa-th"></i>
                <span>Grupo de Trabajo</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="categoria.php"><i class="fa fa-circle-o"></i> Personal de Cuadrilla</a></li>
                <li><a href="administrador.php"><i class="fa fa-circle-o"></i> Administrador </a></li>
                <li><a href="finalizados.php"><i class="fa fa-circle-o"></i> finalizados </a></li>
              </ul>
            </li>
                                
          
  
            <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De la Empresa</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
