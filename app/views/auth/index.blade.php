@extends('layouts.loginlayout')

@section('main')
<!-- BEGIN Login Form -->
<form id="form-login" action="/auth/serviceLogin" method="POST">
	<h3>Login to your account</h3>
	<hr/>
	<div class="control-group">
		<div class="controls">
			<input type="text" name="username" id="username" placeholder="Username" class="input-block-level" />
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input type="password" name="password" id="password" placeholder="Password" class="input-block-level" />
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<label class="checkbox">
				<input type="checkbox" value="remember" /> Remember me
			</label>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-primary input-block-level">Sign In</button>
		</div>
	</div>
	<hr/>
	<p class="clearfix">
		<a href="javascript:;" class="goto-forgot">Forgot Password?</a>
		<!-- <a href="javascript:;" class="goto-register pull-right">Sign up now</a> -->
	</p>
</form>
<!-- END Login Form -->

<!-- BEGIN Forgot Password Form -->
<form id="form-forgot" action="" method="get" class="hide">
	<h3>Get back your password</h3>
	<hr/>
	<div class="control-group">
		<div class="controls">
			<input type="text" placeholder="Email" class="input-block-level" />
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-primary input-block-level">Give me my password</button>
		</div>
	</div>
	<hr/>
	<p class="clearfix">
		<a href="javascript:;" class="goto-login pull-left">← Back to login form</a>
	</p>
</form>
<!-- END Forgot Password Form -->

<!-- BEGIN Register Form -->
<form id="form-register" action="" method="get" class="hide">
	<h3>Sign up</h3>
	<hr/>
	<div class="control-group">
		<div class="controls">
			<input type="text" placeholder="Email" class="input-block-level" />
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input type="text" placeholder="Username" class="input-block-level" />
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input type="password" placeholder="Password" class="input-block-level" />
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input type="password" placeholder="Repeat Password" class="input-block-level" />
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<label class="checkbox">
				<input type="checkbox" value="remember" /> I accept the <a href="#">user aggrement</a>
			</label>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-primary input-block-level">Sign up</button>
		</div>
	</div>
	<hr/>
	<p class="clearfix">
		<a href="javascript:;" class="goto-login pull-left">← Back to login form</a>
	</p>
</form>
<!-- END Register Form -->
@stop