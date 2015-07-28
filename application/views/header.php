<!DOCTYPE html>
<?php  
	require_once(APPPATH."/constants/GroupConstants.php");
	
	$session = $this->session->userdata("current_user");
?>
<html>
<head>
	<meta charset="UTF-8">

	<title>SiGA</title>

	<link rel="stylesheet" href=<?=base_url("css/bootstrap.css")?>>
	<link rel="stylesheet" href=<?=base_url("css/estilo.css")?>>
	<link rel="stylesheet" href=<?=base_url("font-awesome-4.2/css/font-awesome.min.css")?>>
	<link rel="stylesheet" href=<?=base_url("css/AdminLTE.css")?>>
	
	<script src=<?=base_url("js/jquery-2.1.1.min.js")?>></script>
	<script src=<?=base_url("js/bootstrap.min.js")?>></script>
	<script src=<?=base_url("js/AdminLTE/app.js")?>></script>
	<script src=<?=base_url("js/functions.js")?>></script>
	<script src=<?=base_url("js/jquery.inputmask.js")?>></script>
	<script src=<?=base_url("js/jquery.inputmask.numeric.extensions.js")?>></script>
	<script src=<?=base_url("js/jquery.inputmask.date.extensions.js")?>></script>
	<script src=<?=base_url("js/jquery.mask.min.js")?>></script>
</head>

<body class="skin-blue">
	<header>
		<?php 
			$this->load->helper('url');
			$site_url = site_url();

			echo "<input id='site_url' name='site_url' type='hidden' value=\"$site_url\"></input>";
		?>
		<div class="navbar navbar-fixed-top" role="navigation">
			<div class="navbar-btn sidebar-toggle" role="button">
				<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li><?=anchor("/", "Home", "class='navbar-brand'")?></li>
					<?php if ($session) { ?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
						<li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?=ucfirst($session['user']['name'])?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header ">
                                    <p>
                                        <?php
                                        	echo ucfirst($session['user']['name']);

                                        	echo "<br><br><small><b>	Grupos cadastrados:</b></small>";
                                        	foreach($session['user_groups'] as $group){
                                        		switch ($group['group_name']) {
                                        			case GroupConstants::ACADEMIC_SECRETARY_GROUP:
                                        				$groupNameToDisplay = "Secretaria acadêmica";
                                        				break;
                                        			case GroupConstants::FINANCIAL_SECRETARY_GROUP:
                                        				$groupNameToDisplay = "Secretaria financeira";
                                        				break;
                                        			default:
                                        				$groupNameToDisplay = $group['group_name'];
                                        				break;
                                        		}
                                        		echo ucfirst($groupNameToDisplay);
                                        		echo "<br>";
                                        	}
                                        ?>
                                        <br>	
                                        <small><?php echo $session['user']['email']?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <?=anchor("conta", "Conta", "class='btn btn-default btn-flat'")?>
                                    </div>
                                    <div class="pull-right">
                                        <?=anchor("logout", "Sair", "class='btn btn-default btn-flat'")?>
                                    </div>
                                </li>
                            </ul>
                        </li>
					</ul>
				<?php } else { ?>
						<li><?=anchor("usuario/novo", "Cadastro", "class='navbar-brand'")?></li>
				    </ul>
				<?php }?>
					
				</div>
			</div>
		</div>
	
	</header>
	<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php if($session){?>
	            <aside class="left-side sidebar-offcanvas">
	                <!-- sidebar: style can be found in sidebar.less -->
	                <section class="sidebar">
	                    <!-- Sidebar user panel -->
	                    <div class="user-panel">
	                        <div class="pull-left info">
	                            <br>
	                            <p>Olá, <?=ucfirst($session['user']['name'])?></p>
	
	                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

	                            <br><br>
	                            <div class="input-group-btn">
		                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
		                            Perfil <span class="fa fa-caret-down"></span></button>

		                            <ul class="dropdown-menu">
		                            	<?php 
		                            		foreach($session['user_groups'] as $group){
		                            			echo "<li>";
		                            			switch ($group['group_name']) {
                                        			case GroupConstants::ACADEMIC_SECRETARY_GROUP:
                                        				$groupNameToDisplay = "Secretaria acadêmica";
                                        				break;
                                        			case GroupConstants::FINANCIAL_SECRETARY_GROUP:
                                        				$groupNameToDisplay = "Secretaria financeira";
                                        				break;
                                        			default:
                                        				$groupNameToDisplay = $group['group_name'];
                                        				break;
                                        		}
		                            			if($group['group_name'] == GroupConstants::SECRETARY_GROUP){
													continue;
												}else{
		                            				echo anchor($group['profile_route'], ucfirst($groupNameToDisplay));
		                            			}
		                            			echo "</li>";
		                            		}
		                            	?>
		                            </ul>
	                            </div>
	                        </div>
	                    </div>
	                    <!-- search form -->
<!-- 	                    <form action="#" method="get" class="sidebar-form">
	                        <div class="input-group">
	                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
	                            <span class="input-group-btn">
	                                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
	                            </span>
	                        </div>
	                    </form> -->
	                    <!-- /.search form -->
	                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
	                <?php
	                
						foreach($session['user_permissions'] as $groupName => $groupPermissions){
                			if($groupName == GroupConstants::SECRETARY_GROUP){
								continue;
							}else{
								echo "<li class='treeview'>";
								
								switch ($groupName) {
                        			case GroupConstants::ACADEMIC_SECRETARY_GROUP:
                        				$groupNameToShow = "Secretaria acadêmica";
                        				break;
                        			case GroupConstants::FINANCIAL_SECRETARY_GROUP:
                        				$groupNameToShow = "Secretaria financeira";
                        				break;
                        			default:
                        				$groupNameToShow = $groupName;
                        				break;
                        		}
								echo anchor("", ucfirst($groupNameToShow),"class='fa fa-folder-o'");
								
									echo "<ul class='treeview-menu'>";
									
									if($groupPermissions !== FALSE){
										
										foreach($groupPermissions as $permission){
										
											echo "<li>";
											echo anchor($permission['route'], $permission['permission_name'], "class='fa fa-caret-right'");
											echo "</li>";
										}
									}
		
									echo "</ul>";
								
								echo "</li>";
							}
						}

					?>
                  	</ul>
	                </section>
	                <!-- /.sidebar -->
	            </aside>
            <?php }?>
            <aside class="right-side">
            	<div class="container">
            					
<?php
if ($this->session->flashdata("success")) : ?>
	<p class="alert alert-success text-center"><?= $this->session->flashdata("success") ?></p>
<?php endif;
if ($this->session->flashdata("danger")) : ?>
	<p class="alert alert-danger text-center"><?= $this->session->flashdata("danger") ?></p>
<?php endif; ?>
