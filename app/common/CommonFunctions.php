<?php

	/**
	* 
	*/
	class CommonFunctions
	{	
		public function __construct()
		{
			
		}

		/*  ProcessPostData($objectName)
		/*  
		/*/ 
		public static function ProcessPostData($objectName){
			$obj = new $objectName();
			
			foreach(Input::all() as $key => $value) {
				if(!is_array($value)){
					$obj->$key = $value;
				}
			}
			
			return $obj;
		}

		public static function UserMessge($message, $flag, $class)
		{
			$messageTemplate = '{"Message":"{0}", "flag":{1}, "flagClass":"{2}"}';
			$messageTemplate = str_replace("{0}", $message, $messageTemplate);
			$messageTemplate = str_replace("{1}", $flag, $messageTemplate);
			$messageTemplate = str_replace("{2}", $class, $messageTemplate);
			return $messageTemplate;
		}

		public static function ObjectAsArray($formobject){
			$array = array();
			foreach($formobject as $key => $value) {
				$array[$key]= $value;
			}
			return $array;
		}
	}