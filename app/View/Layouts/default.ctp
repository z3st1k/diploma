<!DOCTYPE html>
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
	echo $this->Html->css('bootstrap-select.min');
	echo $this->Html->css('font-awesome.min');
	echo $this->Html->css('sb-admin');
	echo $this->Html->css('notify');
	echo $this->Html->css('full');
	?>
	<link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

	<?php
	echo $this->Html->script('jquery-3.1.1');
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->script('bootstrap-select');
	echo $this->Html->script('jquery.validate.min');
	echo $this->Html->script('jquery.additional.validate');
	echo $this->Html->script('notify');
	echo $this->Html->script('jquery.additional');
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
				<a href="#" class="color-white">
					Balance: <?php echo number_format($userBalance, 2); ?> UAH
				</a>
			</li>
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
						<a href="<?php echo $this->webroot; ?>user/profile">
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

		<?php
		$leftItems = array(
			array(
				'label' => "Dashboard",
				'url'   => "panel/index",
				'icon'  => "fa-dashboard"
			),
			array(
				'label' => "Deals",
				'url'   => "deals/index",
				'icon'  => "fa-handshake-o"
			),
//			array(
//				'label'    => "Origination",
//				'icon'     => "fa-phone-square",
//				'subItems' => array(
//					array(
//						'label' => "Order New Number",
//						'url'   => "did_client/orderNewNumber",
//						'icon'  => "fa-phone-square"
//					),
//					array(
//						'label' => "Trunk Groups",
//						'url'   => "did_client/trunkGroups",
//						'icon'  => "fa-cog"
//					),
//					array(
//						'label' => "My DIDs",
//						'url'   => "did_client/dids",
//						'icon'  => "fa-phone-square"
//					),
//					array(
//						'label' => "Reports",
//						'url'   => "did_client/reports",
//						'icon'  => "fa-bar-chart-o"
//					),
//					array(
//						'label' => "CDR",
//						'url'   => "did_client/cdr",
//						'icon'  => "fa-phone-square"
//					)
//				)
//			)
		);
		?>

		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav side-nav">
				<?php
				$index = 0;
				$activeItem = $this->params['controller'] . '/' . $this->params['action'];
				foreach ($leftItems as $item) {
					?>
					<li <?php echo $item['url'] == $activeItem ? "class='active'" : ""; ?> >
						<?php
						if (isset($item['subItems'])) {
							?>
							<a href="javascript:;" data-toggle="collapse" data-target="#demo<?php echo $index; ?>"><i class="fa fa-fw <?php echo $item['icon']; ?>"></i> <?php echo $item['label']; ?> <i class="fa fa-fw fa-caret-down"></i></a>
							<?php
							$isOpened = false;

							foreach ($item['subItems'] as $subItem) {
								if ($subItem['url'] == $activeItem) {
									$isOpened = true;
									break;
								}
							}
							?>
							<ul id="demo<?php echo $index; ?>" class="collapse <?php echo $isOpened ? 'in': ''; ?>">
								<?php
								foreach ($item['subItems'] as $subItem) {
									?>
									<li <?php echo $subItem['url'] == $activeItem ? "class='active'" : ""; ?> >
										<a href="<?php echo $this->webroot . $subItem['url']; ?>"><i class="fa <?php echo $subItem['icon']; ?>"></i> <?php echo $subItem['label']; ?></a>
									</li>
									<?php
								}
								?>
							</ul>
							<?php
						} else {
							?>
							<a href="<?php echo $this->webroot . $item['url']; ?>"><i class="fa fa-fw <?php echo $item['icon']; ?>"></i> <?php echo $item['label']; ?></a>
							<?php
						}
						$index++;
						?>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</nav>

	<div id="page-wrapper">
		<?php echo $this->fetch('content'); ?>
	</div>
	<!-- /#page-wrapper -->
</div>

<?php //echo $this->element('sql_dump'); ?>

<!--    Flash messages-->
<?php
$flashMessage = $this->Flash->render();
if (!empty($flashMessage)):
	$flashData = json_decode($flashMessage, true);
	switch ($flashData['code']) {
		case '101':
			$flashData['type'] = 'danger';
			$flashData['icon'] = 'close';
			break;
		case '201':
			$flashData['type'] = 'success';
			$flashData['icon'] = 'check';
			break;
		case '301':
			$flashData['type'] = 'info';
			$flashData['icon'] = 'exclamation';
			break;
	}
	?>
	<script>
		$(document).ready(function () {
			$.notify("<?php echo $flashData['message']; ?>", {
				align: "left",
				verticalAlign: "top",
				type: "<?php echo $flashData['type']; ?>",
				icon: "<?php echo $flashData['icon']; ?>"
			});
		});
	</script>
<?php endif; ?>

<script>
	$( function() {
		$("a").tooltip();
	});
</script>
</body>

</html>
