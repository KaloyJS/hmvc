<aside class="main-sidebar" style="">
    <section class="sidebar">
		<div class="user-panel">
			<div class="pull-left info">
			  <p><?php if(isset($sbegn_u_name)){echo "Welcome ".$sbegn_u_name;} ?></p>
			  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		   <ul class="sidebar-menu" data-widget="tree">
			<li class="header ">KPI</li>	
			
			<li class=""><a href='<?php echo base_url(); ?>welcome'><i class='fa fa-home'></i><span>Home</span></a></li>
			<?php 
			$userrole = getRole();
		?>

		

		  </ul>
    </section>
  </aside>

