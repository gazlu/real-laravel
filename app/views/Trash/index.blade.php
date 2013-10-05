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
					trash - Manage trash
				</h3>
				<div class="box-tool">
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content formcontainer">
				<form action="/trash/save" method="post">
					<div class="row-fluid">
						<input type="hidden" name="id" id="id" value="0">
						<div class="span3"><div class="control-group">
	<label for="tablename" class="control-label">tablename</label>
	<div class="controls">
		<input type="text" req="true" valsection="main" name="tablename" value="" id="tablename" placeholder="Please enter tablename" class="input-large ">
	</div>
</div><div class="control-group">
	<label for="deletedby" class="control-label">deletedby</label>
	<div class="controls">
		<input type="text" req="true" valsection="main" name="deletedby" value="" id="deletedby" placeholder="Please enter deletedby" class="input-large ">
	</div>
</div></div>
						<div class="span3"><div class="control-group">
	<label for="record" class="control-label">record</label>
	<div class="controls">
		<input type="text" req="true" valsection="main" name="record" value="" id="record" placeholder="Please enter record" class="input-large ">
	</div>
</div><div class="control-group">
	<label for="restored" class="control-label">restored</label>
	<div class="controls">
		<input type="checkbox" req="true" valsection="main" name="restored" value="1" id="restored" placeholder="Please enter restored" class="input-large ">
	</div>
</div></div>
						<div class="span3"><div class="control-group">
	<label for="recordid" class="control-label">recordid</label>
	<div class="controls">
		<input type="text" req="true" valsection="main" name="recordid" value="" id="recordid" placeholder="Please enter recordid" class="input-large ">
	</div>
</div></div>
						<div class="span3"><div class="control-group">
	<label for="deletedon" class="control-label">deletedon</label>
	<div class="controls">
		<input type="text" req="true" valsection="main" name="deletedon" value="" id="deletedon" placeholder="Please enter deletedon" class="input-large ">
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