@extends('layouts.scaffold')

@section('styles')
<style>
@import url(//fonts.googleapis.com/css?family=Lato:300,400,700); .welcome { width:
	300px; height: 300px; position: absolute; left: 50%; top: 50%; margin-left: -150px;
	margin-top: -150px; }
	</style>
	@stop
	@section('title')
	Sushant Kulkarni
	@stop
	@section('main')
	<div class="row">

		<div class="col-lg-12">
			<h1 class="page-header">Contact <small>I'd Love to Hear From You!</small></h1>
			<ol class="breadcrumb">
				<li><a href="/">Home</a></li>
				<li class="active">Contact</li>
			</ol>
		</div>

		<div class="col-lg-12">
			<!-- Embedded Google Map using an iframe - to select your location find it on Google maps and paste the link as the iframe src. If you want to use the Google Maps API instead then have at it! -->
			<!-- <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe> -->
			<iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=16.405710,73.966290&amp;spn=56.506174,79.013672&amp;t=m&amp;z=13&amp;output=embed"></iframe>
		</div>

	</div><!-- /.row -->

	<div class="row">

		<div class="col-sm-8">
			<h3>Let's Get In Touch!</h3>
			<p>
				I am real big fan of code generator, have own code generators for CI, ASP.net mvc, custom php framework wrappers
			</p>
			<?php  

                // check for a successful form post  
			if (isset($_GET['s'])) echo "<div class=\"alert alert-success\">".$_GET['s']."</div>";  

                // check for a form error  
			elseif (isset($_GET['e'])) echo "<div class=\"alert alert-danger\">".$_GET['e']."</div>";  

			?>
			<form role="form" method="POST" action="contact-form-submission.php">
				<div class="form-group col-lg-4">
					<label for="input1">Name</label>
					<input type="text" name="contact_name" class="form-control" id="input1">
				</div>
				<div class="form-group col-lg-4">
					<label for="input2">Email Address</label>
					<input type="email" name="contact_email" class="form-control" id="input2">
				</div>
				<div class="form-group col-lg-4">
					<label for="input3">Phone Number</label>
					<input type="phone" name="contact_phone" class="form-control" id="input3">
				</div>
				<div class="clearfix"></div>
				<div class="form-group col-lg-12">
					<label for="input4">Message</label>
					<textarea name="contact_message" class="form-control" rows="6" id="input4"></textarea>
				</div>
				<div class="form-group col-lg-12">
					<input type="hidden" name="save" value="contact">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>

		<div class="col-sm-4">
			<h3>Sushant Kulkarni</h3>
			<h4>Radhanagari</h4>
			<p>
				Kolhapur.<br>
				India 416211<br>
			</p>
			<p><i class="icon-phone"></i> <abbr title="Phone">P</abbr>: (***) ***-****</p>
			<p><i class="icon-envelope-alt"></i> <abbr title="Email">E</abbr>: <a href="mailto:feedback@startbootstrap.com">sushskulkarni[at]gmail[period]com</a></p>
			<p><i class="icon-time"></i> <abbr title="Hours">H</abbr>: Monday - Friday: 9:00 AM to 5:00 PM</p>
			<ul class="list-unstyled list-inline list-social-icons">
				<li class="tooltip-social facebook-link"><a href="https://www.facebook.com/sushant.kulkarni" data-toggle="tooltip" data-placement="top" title="Sushant Kulkarni - Facebook"><i class="icon-facebook-sign icon-2x"></i></a></li>
				<li class="tooltip-social linkedin-link"><a href="http://in.linkedin.com/in/sushantskulkarni/" data-toggle="tooltip" data-placement="top" title="Sushant Kulkarni - LinkedIn"><i class="icon-linkedin-sign icon-2x"></i></a></li>
				<li class="tooltip-social twitter-link"><a href="https://twitter.com/sushskulkarni" data-toggle="tooltip" data-placement="top" title="Sushant Kulkarni - Twitter"><i class="icon-twitter-sign icon-2x"></i></a></li>
				<li class="tooltip-social google-plus-link"><a href="https://plus.google.com/117826537737252068764" data-toggle="tooltip" data-placement="top" title="Sushant Kulkarni - Google+"><i class="icon-google-plus-sign icon-2x"></i></a></li>
			</ul>
		</div>

	</div><!-- /.row -->
	@stop