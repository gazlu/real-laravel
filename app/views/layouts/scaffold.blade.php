<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>
		real-laravel - @yield('title')
	</title>
	<!-- Bootstrap core CSS -->
	<link href="/css/bootstrap.css" rel="stylesheet">
	<!-- Add custom CSS here -->
	<link href="/css/modern-business.css" rel="stylesheet">
	<link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/assets/normalize/normalize.css">
	<!--page specific css styles-->
	<link rel="stylesheet" href="/assets/chosen-bootstrap/chosen.min.css" />
	<link rel="stylesheet" href="/assets/bootstrap-timepicker/compiled/timepicker.css"
	/>
	<link rel="stylesheet" href="/assets/clockface/css/clockface.css" />
	<link rel="stylesheet" href="/assets/bootstrap-datepicker/css/datepicker.css" />
	<link rel="stylesheet" href="/assets/bootstrap-daterangepicker/daterangepicker.css"
	/>
	<link rel="stylesheet" href="/assets/data-tables/DT_bootstrap.css" />
	<!--flaty css styles-->
	<link rel="shortcut icon" href="img/favicon.html">
	<script src="/assets/modernizr/modernizr-2.6.2.min.js">

	</script>
	<style type="text/css">
		.actionscol{
			min-width: 150px;
		}
	</style>
	@yield('styles')
</head>
<body>
	<?php echo View::make('layouts.shared.topnav'); ?>
	<div class="container">
		<div class="row-fluid">
			<div class="col-lg-12">
				<div class="flash alert alert-error hide" id="genMsg">
				</div>
			</div>
		</div>
		@yield('main')
	</div>
	<!-- /.container -->
	<?php echo View::make('layouts.shared.footer'); ?>
	<!-- /.container -->
	<!-- Bootstrap core JavaScript -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!--basic scripts-->
	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
	<script>
	window.jQuery || document.write('<script src="/assets/jquery/jquery-1.10.1.min.js"><\/script>')
	</script>
	<script src="/assets/bootstrap/bootstrap.min.js"></script>
	<script src="/js/modern-business.js"></script>
	<script src="/assets/nicescroll/jquery.nicescroll.min.js"></script>
	<!--page specific plugin scripts-->
	<script src="/assets/chosen-bootstrap/chosen.jquery.min.js"></script>
	<script src="/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="/assets/bootstrap-daterangepicker/date.js"></script>
	<script src="/assets/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="/assets/data-tables/jquery.dataTables.js"></script>
	<script src="/assets/data-tables/DT_bootstrap.js"></script>
	<script src="/assets/jquery/jquery.form.js"></script>
	<script src="/assets/jquery/jquery.blockUI.js"></script>
	<!--app scripts-->
	<script src="/js/app/formvalidation.js"></script>
	<script src="/js/app/core.js"></script>
	@yield('scripts')
</body>
</html>