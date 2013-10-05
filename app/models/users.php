<?php namespace taskapp\Models;

	/**
	* Model class for users table
	*/
	class users extends BaseEntity
	{
		var $table = 'users';
		
		
		var $username;
		var $password;
		var $Email;
		var $IsAdmin;
	}