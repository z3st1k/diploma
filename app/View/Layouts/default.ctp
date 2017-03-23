<!DOCTYPE html>
<html lang="en">

<html lang="en">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
	echo $this->Html->meta('icon');
	echo $this->fetch('meta');

	echo $this->Html->css('bootstrap.min');
	echo $this->Html->css('font-awesome.min');
	echo $this->Html->css('sb-admin');
	?>
	<link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

	<?php
	echo $this->Html->script('jquery-3.1.1');
	echo $this->Html->script('bootstrap.min');
	?>

</head>

<body>

<div id="wrapper">

	<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand page-scroll" href="<?php echo $this->webroot; ?>">
				<i class="fa fa-thumbs-up"></i> Gooddeal
			</a>
		</div>
		<!-- Top Menu Items -->
		<ul class="nav navbar-right top-nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
				<ul class="dropdown-menu message-dropdown">
					<li class="message-preview">
						<a href="#">
							<div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
								<div class="media-body">
									<h5 class="media-heading"><strong></strong>
									</h5>
									<p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
									<p>Lorem ipsum dolor sit amet, consectetur...</p>
								</div>
							</div>
						</a>
					</li>
					<li class="message-footer">
						<a href="#">Read All New Messages</a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
				<ul class="dropdown-menu alert-dropdown">
					<li>
						<a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
					</li>
					<li>
						<a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
					</li>
					<li>
						<a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
					</li>
					<li>
						<a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
					</li>
					<li>
						<a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
					</li>
					<li>
						<a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="#">View All</a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $Auth->user('username'); ?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo $this->webroot; ?>panel/profile">
							<i class="fa fa-fw fa-user"></i> Profile
						</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="<?php echo $this->webroot; ?>homes/logout">
							<i class="fa fa-fw fa-power-off"></i> Log Out
						</a>
					</li>
				</ul>
			</li>
		</ul>
		<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav side-nav">
				<li>
					<a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
				</li>
				<li>
					<a href="charts.html"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
				</li>
				<li class="active">
					<a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
				</li>
				<li>
					<a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
				</li>
				<li>
					<a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
				</li>
				<li>
					<a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
				</li>
				<li>
					<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
					<ul id="demo" class="collapse">
						<li>
							<a href="#">Dropdown Item</a>
						</li>
						<li>
							<a href="#">Dropdown Item</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
				</li>
				<li>
					<a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</nav>

	<div id="page-wrapper">
		<?php echo $this->fetch('content'); ?>
	</div>
	<!-- /#page-wrapper -->

</div>

<?php echo $this->fetch('sql_dump'); ?>

</body>

</html>
