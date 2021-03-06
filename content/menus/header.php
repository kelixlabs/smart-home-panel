<!DOCTYPE html>

<html>
<?php
if(isset($home)){
  $var = "'";
  require_once("content/connector/connection.php");
  require_once("content/room/room_model.php");
  require_once("content/device/device_model.php");
  require_once("content/events/evento.php");
  require_once("content/events/notes.php");
  require_once("content/events/widget-graph.php");
}else{
  $var="'" . "../../";
  require_once("../connector/connection.php");
  require_once("../room/room_model.php");
  require_once("../device/device_model.php");
  require_once("../events/evento.php");
  require_once("../events/notes.php");
  require_once("../events/widget-graph.php");


}
  $roomLister = new Room();
  $DevicesLister = new Device();
  $anEvent = new Event();
  $notesController = new Note();



  if(isset($_POST['nota'])){
    $notesController->CreateNote($_POST['nota']);
  }

  if(isset($_POST['timeSet'])){
   $anEvent->CreateStatusEvent($_POST['idDevice'],$_POST['optionsRadios'],$_POST['timeSet']);
  }


?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SMP | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href=<?php echo $var ?>assets/bootstrap/css/bootstrap.min.css<?php echo "'";?> >
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href=<?php echo $var ?>assets/dist/css/AdminLTE.min.css<?php echo "'";?>>

  <link rel="stylesheet" href=<?php echo $var ?>assets/dist/css/skins/skin-blue.min.css<?php echo "'";?>>
  <link rel="stylesheet" href=<?php echo $var ?>css/style.css<?php echo "'";?>>
  <link rel="stylesheet" href=<?php echo $var ?>css/weather.css<?php echo "'";?>>
  <link rel="stylesheet" href=<?php echo $var ?>css/widget-chart.css<?php echo "'";?>>


</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href=<?php echo $var; ?>index.php<?php echo "'";?> class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SH</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SmartHome</b>Panel</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php  $notesController->getTotalNotes();  ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php  $notesController->getTotalNotes();  ?> notifications</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                <!-- start notification -->
                  <?php 
                    $notesController->showNotes(); 
                  ?>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
        
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src=<?php echo $var ?>images/avatar.png<?php echo "'";?> class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Daniel Martin</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src=<?php echo $var ?>images/avatar.png<?php echo "'";?> class="img-circle" alt="User Image">
                <p>
                Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
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

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src=<?php echo $var ?>images/avatar.png<?php echo "'";?> class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Daniel Martin</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
       <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">House</li>
        <!-- Optionally, you can add icons to the links -->
        <li class=""><a href=<?php echo $var ?>index.php<?php echo "'";?> ><i class="fa fa-home"></i> <span>DashBoard</span></a></li>
     <!--   <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>-->
        <li class="treeview">
          <a href="#"><i class="fa  fa-list"></i> <span>Rooms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if(isset($home)){ $roomLister->getMenuList();}else{ $roomLister->getMenuListNotMain();} ?>
          </ul>
        </li>

        <!-- Device Type List -->
        <li class="treeview">
          <a href="#"><i class="fa   fa-sliders"></i> <span>Devices</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if(isset($home)){ $DevicesLister->getDeviceMenuList();}else{ $DevicesLister->getDeviceMenuListNotMain();} ?>
          </ul>
        </li>
        <!-- Device type list end -->


      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
