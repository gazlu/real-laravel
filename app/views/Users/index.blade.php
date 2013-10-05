@extends('layouts.scaffold')

@section('styles')
<style>
@import url(//fonts.googleapis.com/css?family=Lato:300,400,700);
.welcome {
	width: 300px;
	height: 300px;
	position: absolute;
	left: 50%;
	top: 50%; 
	margin-left: -150px;
	margin-top: -150px;
}
</style>
@stop

@section('main')
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-title">
				<h3>
					<i class="icon-bar-chart">
					</i>
					users - Manage users
				</h3>
				<div class="box-tool">
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content formcontainer">
				<form action="/users/save" method="post">
					<div class="row-fluid">
						<input type="hidden" name="id" id="id" value="0">
						<div class="span3"><div class="control-group">
	<label for="username" class="control-label">username</label>
	<div class="controls">
		<input type="text" req="true" valsection="main" name="username" value="" id="username" placeholder="Please enter username" class="input-large ">
	</div>
</div></div>
						<div class="span3"><div class="control-group">
	<label for="password" class="control-label">password</label>
	<div class="controls">
		<input type="text" req="true" valsection="main" name="password" value="" id="password" placeholder="Please enter password" class="input-large ">
	</div>
</div></div>
						<div class="span3"><div class="control-group">
	<label for="Email" class="control-label">Email</label>
	<div class="controls">
		<input type="text" req="true" valsection="main" name="Email" value="" id="Email" placeholder="Please enter Email" class="input-large ">
	</div>
</div></div>
						<div class="span3"><div class="control-group">
	<label for="IsAdmin" class="control-label">IsAdmin</label>
	<div class="controls">
		<input type="text" req="true" valsection="main" name="IsAdmin" value="" id="IsAdmin" placeholder="Please enter IsAdmin" class="input-large ">
	</div>
</div></div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-primary pull-right"><i class="icon-ok"></i> Save</button>
						<button type="reset" class="btn pull-right">Cancel</button>
					</div>
				</form>
				<div id="gridView"></div>
			</div>
		</div>
	</div>
</div>
@stop