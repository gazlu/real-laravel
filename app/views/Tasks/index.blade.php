@extends('layouts.scaffold')

@section('styles')
<style>
@import url(//fonts.googleapis.com/css?family=Lato:300,400,700); .welcome { width:
	300px; height: 300px; position: absolute; left: 50%; top: 50%; margin-left: -150px;
	margin-top: -150px; }
	</style>
	@stop
	@section('title')
	Tasks
	@stop
	@section('main')
	<div class="row-fluid">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						Tasks
						<small>
							Manage your tasks
						</small>
					</h1>
				</div>
			</div>
			<div class="col-lg-12 formcontainer">
				<form action="/tasks/save" method="post">
					<div class="row-fluid">
						<input type="hidden" name="id" id="id" value="0">
						<div class="span3">
							<div class="control-group">
								<label for="Title" class="control-label">
									Title
								</label>
								<div class="controls">
									<input type="text" req="true" valsection="main" name="Title" value="" id="Title"
									placeholder="Please enter Title" class="input-large ">
								</div>
							</div>
						</div>
						<div class="span3">
							<div class="control-group">
								<label for="Description" class="control-label">
									Description
								</label>
								<div class="controls">
									<input type="text" req="true" valsection="main" name="Description" value="" id="Description"
									placeholder="Please enter Description" class="input-large ">
								</div>
							</div>
						</div>
						<div class="span3">
							<div class="control-group">
								<label for="AssignedTo" class="control-label">
									AssignedTo
								</label>
								<div class="controls">
									<input type="text" req="true" valsection="main" name="AssignedTo" value="" id="AssignedTo"
									placeholder="Please enter AssignedTo" class="input-large ">
								</div>
							</div>
						</div>
						<div class="span3">
							<div class="control-group">
								<label for="DueDate" class="control-label">
									DueDate
								</label>
								<div class="controls">
									<input type="text" req="true" valsection="main" name="DueDate" value="" id="DueDate"
									placeholder="Please enter DueDate" class="input-large date-picker">
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary pull-right">
							<i class="icon-ok">
							</i>
							Save
						</button>
						<button type="reset" class="btn pull-right">
							Cancel
						</button>
					</div>
				</form>

				<div id="gridView">
				</div>
			</div>
		</div>
	</div>
	@stop