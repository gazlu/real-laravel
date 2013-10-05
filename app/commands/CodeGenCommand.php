<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CodeGenCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'codegen:scaffold';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate controller, model and view for a db table.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$skipFields = array('id','isactive','isarchived','createdon','createdby','modifiedon','modifiedby');

		$table = $this->argument('table');
		$modelns = $this->argument('modelns');

		$this->line('Generating code for '.$table.' Table.');
		$columns = DB::select('DESCRIBE '.$table);
		$modelFileContents = file_get_contents("app/commands/stubs/modeltemp.txt");
		$controllerFileContents = file_get_contents("app/commands/stubs/controllertemp.txt");
		$viewFileContents = file_get_contents("app/commands/stubs/viewtemp.txt");
		$viewFieldFileContents = file_get_contents("app/commands/stubs/viewfieldtemp.txt");

		/**
		 * Genete model code
		 */
		$modelFields = '';
		foreach ($columns as $columnIndex => $column) {
			if (!in_array(strtolower($column->Field), $skipFields)) {
				$defaultValue = $this->startsWith($column->Type, 'bit') ? ' = 0' : '';
				$modelFields .= "\n\t\t".'var $'.$column->Field.$defaultValue.';';
			}
		}
		$modelFileContents = str_replace('{{fields}}', $modelFields, $modelFileContents);
		$modelFileContents = str_replace('{{modelns}}', $modelns, $modelFileContents);
		$modelFileContents = str_replace('{{table}}', $table, $modelFileContents);

		file_put_contents("app/models/".$table.'.php', $modelFileContents);

		$this->line('Generated Model for '.$table.' Table.');

		/**
		 * Genete controller code
		 */
		$modelFields = '';
		foreach ($columns as $columnIndex => $column) {
			if (!in_array(strtolower($column->Field), $skipFields)) {
				$modelFields .= "'".$column->Field."',";
			}
		}

		$modelFields = mb_substr($modelFields, 0, -1);
		$controllerFileContents = str_replace('{{name}}', ucfirst($table), $controllerFileContents);
		$controllerFileContents = str_replace('{{model}}', $table, $controllerFileContents);
		$controllerFileContents = str_replace('{{table}}', $table, $controllerFileContents);
		$controllerFileContents = str_replace('{{modelns}}', $modelns, $controllerFileContents);
		$controllerFileContents = str_replace('{{columns}}', str_replace('"', '', $modelFields), $controllerFileContents);

		file_put_contents("app/controllers/".ucfirst($table).'Controller.php', $controllerFileContents);
		$this->line('Generated Controller for '.$table.' Table.');
		
		/**
		 * Genete view code
		 */
		$fieldViews = array();
		
		# replace table name at controller form action and title
		$viewHtml = str_replace('{{table}}', strtolower($table), $viewFileContents);

		$colIndex = 1;
		foreach ($columns as $columnIndex => $column) {
			if (!in_array(strtolower($column->Field), $skipFields)) {
				$fieldProcessedTemplate = $colIndex.'$'.$this->ProcessViewField(
																	$viewFieldFileContents, 
																	$column->Field, 
																	$column->Type
																);
				array_push($fieldViews, $fieldProcessedTemplate);
				$colIndex == 4 ? $colIndex = 1 : $colIndex++;
			}
		}
		foreach ($fieldViews as $fieldIndex => $fieldHtml) {
			$fieldHtmlArray = explode('$', $fieldHtml);
			$viewHtml = str_replace(
									'{{fieldcol'.$fieldHtmlArray[0].'}}',
									$fieldHtmlArray[1].'{{fieldcol'.$fieldHtmlArray[0].'}}',
									$viewHtml
								);
		}

		$viewHtml = str_replace('{{fieldcol1}}', '', $viewHtml);
		$viewHtml = str_replace('{{fieldcol2}}', '', $viewHtml);
		$viewHtml = str_replace('{{fieldcol3}}', '', $viewHtml);
		$viewHtml = str_replace('{{fieldcol4}}', '', $viewHtml);

		if (!file_exists("app/views/".ucfirst($table)."/")) {
		    mkdir("app/views/".ucfirst($table)."/", 0777, true);
		}

		file_put_contents("app/views/".ucfirst($table)."/index.blade.php", $viewHtml);
		$this->line('Generated master view for '.$table.' Table.');

		$this->line(exec('composer dump-auto'));

		$this->line('hurrayyyyyy... need not to do [composer dump-auto]');
	}

	/**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('table', InputArgument::REQUIRED, 'Table Name'),
            array('modelns', InputArgument::REQUIRED, 'Model namespace'),
        );
    }

    protected function ProcessViewField($fieldTemplate, $fieldName, $fieldType)
    {
    	$fieldTemplate = str_replace('{{field}}', $fieldName, $fieldTemplate);
    	$fieldType = strtolower($fieldType);
    	if ($this->startsWith($fieldType, 'datetime')) {
    		$fieldTemplate = str_replace('{{class}}', 'date-picker', $fieldTemplate);
    		$fieldTemplate = str_replace('{{type}}', 'text', $fieldTemplate);
    	}elseif ($this->startsWith($fieldType, 'bit')) {
    		$fieldTemplate = str_replace('{{value}}', '1', $fieldTemplate);
    		$fieldTemplate = str_replace('{{type}}', 'checkbox', $fieldTemplate);
    	}else{
    		$fieldTemplate = str_replace('{{type}}', 'text', $fieldTemplate);
    	}
    	$fieldTemplate = str_replace('{{value}}', '', $fieldTemplate);
    	return str_replace('{{class}}', '', $fieldTemplate);
    }

    protected function startsWith($haystack, $needle)
	{
	    return $needle === "" || strpos($haystack, $needle) === 0;
	}
	protected function endsWith($haystack, $needle)
	{
	    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
	}
}