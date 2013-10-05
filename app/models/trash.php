<?php namespace taskapp\Models;

	/**
	* Model class for trash table
	*/
	class trash
	{
		var $table = 'trash';
		
		
		var $tablename;
		var $record;
		var $recordid;
		var $deletedon;
		var $deletedby;
		var $restored = 0;
	}