@extends('layouts.scaffold')

@section('title')
Welcome
@stop

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
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            real-laravel
            <small>
                Pure scaffold wrapper for <a href="http://laravel.com/" title="laravel">laravel</a>
            </small>
        </h1>
        <!-- <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li class="active">
                Full Width Page
            </li>
        </ol> -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <h1>Features</h1>
        <p>
            <ul>
                <li>Generate Models, views and controllers from database tables</li>
                <li>Purely generic controllers</li>
                <li>Zero code master pages</li>
                <li>Highly scalable</li>
            </ul>
        </p>
        <p>
            #codehappy
        </p>
    </div>
</div>
@stop