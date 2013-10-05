<?php 

	/**
	* 
	*/
	class DBAccess
	{
		function __construct()
		{
		}

		public static function InsertRecord($entity, $tableName)
		{
			DB::table($tableName)->insert(CommonFunctions::ObjectAsArray($entity));
			return true;
		}

		public static function UpdateRecord($entity, $tableName)
		{
			DB::table($tableName)
            ->where('id', $entity->id)
            ->update(CommonFunctions::ObjectAsArray($entity));
            
            return true;
		}

		public static function ArchiveRecord($entity, $tableName)
		{
			if (DBAccess::InsertRecord($entity, 'trash')) {
				DB::table($tableName)
	            ->where('id', $entity->recordid)
	            ->delete();
            }else{
            	return false;
            }
            return true;
		}

		public static function ReadWholeTable($table)
		{
			return DB::table($table)->get();
		}
	}