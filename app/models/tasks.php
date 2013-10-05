<?php namespace taskapp\Models;

	/**
	* Model class for tasks table
	*/
	class tasks extends BaseEntity
	{
		var $table = 'tasks';
		
		
		var $Title;
		var $Description;
		var $AssignedTo;
		var $DueDate;
	}