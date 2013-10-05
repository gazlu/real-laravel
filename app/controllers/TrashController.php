<?php

use taskapp\Models\trash;
	/**
	* 
	*/
	class TrashController extends AppController
	{
		
		function __construct()
		{
			parent::__construct(new trash, 'trash');
			$this->gridModel = array(
									'table' => $this->entity->table,
									'pk' => 'id',
									'columns' => array('tablename','recordid','deletedon','deletedby','restored'),
									'fields' => array('tablename','recordid','deletedon','deletedby','restored'),
									'rowEloq' => DB::table('trash')
								);
		}
	}