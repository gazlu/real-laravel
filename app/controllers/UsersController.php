<?php

use taskapp\Models\users;
	/**
	* 
	*/
	class UsersController extends AppController
	{
		
		function __construct()
		{
			parent::__construct(new users, 'users');
			$this->gridModel = array(
									'table' => $this->entity->table,
									'pk' => 'id',
									'columns' => array('username','Email','IsAdmin'),
									'fields' => array('username','Email','IsAdmin'),
									'rowEloq' => DB::table('users')
								);
		}
	}