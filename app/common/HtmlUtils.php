<?php
	define('SALT', 'reallaravel'); 
	
	class HtmlUtils{
		
		public static function encrypt($text) {
			$base = trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, SALT, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
			return base64_encode($base);
		} 
	
		public static function decrypt($text) {
			$text = base64_decode($text);
			$base = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, SALT, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
			return $base; 
		}

		public static function AutoCompleteTags($tableKey, $displayCol){
			$array = $this->dbaccess->ReadWholeTable($tableKey);
			foreach ($array as $row) {
				echo "\"".$row['id']."-".$row[$displayCol]."\"".",\n";
			}
		}

		public static function DropDownValues($tableKey, $displayCol, $selected='0'){
			$array = $this->dbaccess->ReadWholeTable($tableKey);
			foreach ($array as $row) {
				$selText = '';
				if ($row['id']==$selected) {
					$selText = 'selected';
				}
				echo "<option ".$selText." value=\"".$row['id']."\">".$row[$displayCol]."</option>";
			}
		}

		public static function ConvertDate($value, $format=1)
		{
			$date = '';
			$date = $value;
			if($format==1){
				$date = explode('/',$date);
				$date = array_reverse($date);
				$date = implode('-',$date);
			}else{
				$date = explode('-',$date);
				$date = array_reverse($date);
				$date = implode('/',$date);
			}
			return $date;
		}

		public static function GetFormDetails($storedProc, $cols, $labels, $id)
		{
			$template = '<p class="lefty">
					        <label for="firstname"> {0} </label>: {1}
				         </p><br/><br/>';
			$columns = explode(',', $cols);
			$labels = explode(',', $labels);
			$array = DBAccess::ReadDataTable($storedProc, $id);
			$details = '<fieldset>';
			foreach ($array as $row) {
				for ($i=0; $i < count($columns); $i++) { 
					$newTemplate = str_replace('{0}', $labels[$i], $template);
					$details .= str_replace('{1}', $row[$columns[$i]], $newTemplate);
				}
			}
			$details .= '</fieldset>';
			return $details;
		}

		public static function DetailsControlBox($id, $title, $baseUrl)
		{
			$boxHtml = '<p>
						  <a href="'.$baseUrl.$title.'/" class="button round blue image-left ic-left-arrow text-upper">
						    Add new '.$title.'
						  </a>
						  <a href="'.$baseUrl.$title.'/" class="button round blue image-left ic-delete text-upper">
						    Archive this '.$title.'
						  </a>
						  <a href="javascript:window.print();" class="button round blue image-left ic-print text-upper">
						    Print '.$title.'
						  </a>
						</p>';
			return $boxHtml;
		}

		public static function DropDownValue($tableKey, $displayCol)
		{
			$options = '';
			$array = DBAccess::ReadWholeTable($tableKey);
			foreach ($array as $row) {
				$options .= '<option value="'.$row->id.'">'.$row->$displayCol.'</option>';
			}
			return $options;
		}

		public static function LookupDropDown($lookupCode, $selected = 0)
		{

			$sql = 'SELECT id, name
					FROM   lookup
					WHERE  code = '.$lookupCode;
			$array =  DB::select($sql);
			foreach ($array[0] as $row) {
				$selText = '';
				if ($row['id']==$selected) {
					$selText = 'selected';
				}
				$options .= '<option '.$selText.' value="'.$row['id'].'">'.$row['name'].'</option>';
			}
			return $options;
		}

		public static function LookupArray($lookupCode)
		{
			$sql = 'SELECT id, name
					FROM   lookup
					WHERE  code = '.$lookupCode;
			$array =  DB::select($sql);
			
			return $array[0];
		}

		public static function LookupLabel($lookupId)
		{
			$sql = 'SELECT id, name
					FROM   lookup
					WHERE  id = '.$lookupId;
			$array =  DB::select($sql);
			if(count($array)>0){
				$row = $array[0];
				$row = $row[0];
				return $row['name'];
			}else{
				return '';
			}
		}

		public static function startsWith($haystack, $needle)
		{
		    return $needle === "" || strpos($haystack, $needle) === 0;
		}
		public static function endsWith($haystack, $needle)
		{
		    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
		}
	}