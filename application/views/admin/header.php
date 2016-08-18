    <script src="<?php echo base_url();?>AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	  <header class="main-header">
        <!-- Logo -->
        <a  href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b></span>
          <!-- logo for regular state and mobile devices -->
          <span style="color:#FFFFFF;" class="logo-lg">
		  	<?php if($this->session->userdata('id_level') == 1){?>
		  	<b>Dashboard Admin</b>
			<?php }else{?>
			<b>Dashboard Operator</b>
			<?php }?>
		  </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a style="color:#FFFFFF;"href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a style="color:#FFFFFF;"href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">Logout</span>
				  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <!-- Menu Footer-->
                  <li>
                    
                      <a style="color:#FFFFFF; background-color:#0066CC;" href="<?php echo site_url('admin/pengguna/akun_pribadi/'.$this->session->userdata('id_member') );?>" class="btn btn-default">Data Pribadi</a>
                  </li>
				   <li>
                      <a style="color:#FFFFFF; background-color:#0066CC;" href="<?php echo site_url('admin/pengguna/ganti_password/'.$this->session->userdata('id_user') );?>" class="btn btn-default">Ganti Password</a>
                  </li>
                  <li>
                      <a style="color:#FFFFFF; background-color:#0066CC;"href="<?php echo site_url('admin/home/logout');?>" class="btn btn-default">Logout</a>
                  </li>
				  
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a style="color:#FFFFFF;"href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
