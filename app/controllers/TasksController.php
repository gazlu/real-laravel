<?php

use taskapp\Models\tasks;
	/**
	* 
	*/
	class TasksController extends AppController
	{
		
		function __construct()
		{
			parent::__construct(new tasks, 'tasks');
			$this->gridModel = array(
									'table' => $this->entity->table,
									'pk' => 'id',
									'columns' => array('Title','Description','AssignedTo','DueDate'),
									'fields' => array('Title','Description','AssignedTo','DueDate'),
									'rowEloq' => DB::table('tasks')
								);
		}
	}