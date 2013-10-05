<?php namespace taskapp\Models;

	class BaseEntity
	{
		function __construct(){
			date_default_timezone_set('Asia/Kolkata');
			$this->createdon = date('Y-m-d g:i:s');
			$this->modifiedon = date('Y-m-d g:i:s');
		}
	
		var $id = 0;
		var $isactive = 1;
		var $isarchived = 0;
		var $createdby = 0;
		var $createdon;
		var $modifiedby = 0;
		var $modifiedon;
	}