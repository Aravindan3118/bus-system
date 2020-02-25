 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel">
        <div class="pull-left image">
          <img src="inc/includes/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>User Name</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> -->

      <!-- search form (Optional) -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header">HEADER</li> -->
        <!-- Optionally, you can add icons to the links -->
        <!-- <li ><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li> -->
        <?php
        if($_SESSION['user_type'] == 'admin'){
          ?>
            <li><a href="manage_bus.php"><i class="fa fa-link"></i> <span>Manage Bus</span></a></li>
            <li><a href="manage_driver.php"><i class="fa fa-link"></i> <span>Manage Driver</span></a></li>
          <?php
        }
        ?>
        <?php
        if($_SESSION['user_type'] == 'driver'){
          ?>
            <!-- <li><a href="driver_location.php"><i class="fa fa-link"></i> <span>Location Emit</span></a></li> -->
          <?php
        }
        ?>
        <?php
        if($_SESSION['user_type'] == 'college'){
          ?>
            <li><a href="departments_master.php"><i class="fa fa-link"></i> <span>Manage Departments</span></a></li>
          <?php
        }
        ?>
        <!-- <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li> -->
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
