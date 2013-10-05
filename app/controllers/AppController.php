<?php

use taskapp\Models\trash;

class AppController extends BaseController {

	protected $entity;
	protected $controller;
	protected $gridModel;
	protected $formData = false;

	public function __construct($entity, $controller)
	{
		$this->beforeFilter('auth');
		$this->entity = $entity;
		$this->controller = $controller;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return View::make($this->controller.'.index');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function postSave()
	{
		$tableData;

		### Check for baseentity inheritance for the model
		$hasBaseEntity = get_parent_class($this->entity);
		
		if (!$this->formData) {
			### Process this when no overriden by controller
			$tableData = CommonFunctions::ProcessPostData(new $this->entity);
		}else{
			### Process this when overriden by controller
			$tableData = $this->formData;
		}
		$table = $tableData->table;
		unset($tableData->table);
		if ($hasBaseEntity) {
			$tableData->modifiedby = Session::get('light.useruid');
		}
		
		if ($tableData->id == 0) {
			if ($hasBaseEntity) {
				$tableData->createdby = Session::get('light.useruid');
			}
			$dbStatus = DBAccess::InsertRecord($tableData, $table);
			if ($dbStatus) {
				return CommonFunctions::UserMessge("Record Saved Successfully!", 1, "alert-success");
			}else{
				return CommonFunctions::UserMessge("Problem Creating Record", 0, "alert-error");
			}
		}else{
			//return 'Updating';
			$dbStatus = DBAccess::UpdateRecord($tableData, $table);
			if ($dbStatus) {
				return CommonFunctions::UserMessge("Record Updated Successfully!", 1, "alert-success");
			}else{
				return CommonFunctions::UserMessge("Problem Updating Record", 0, "alert-error");
			}
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function postGrid($id)
	{
		return View::make('shared.smartgrid', array('gridmodel' => $this->gridModel, 'serverside' => $id));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function postEdit($id)
	{
		$id = HtmlUtils::decrypt($id);
		return json_encode(DB::table($this->entity->table)->where('id', $id)->get());
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function postArchive($id)
	{
		$id = HtmlUtils::decrypt($id);
		$record = DB::table($this->entity->table)->where('id', $id)->get();

		$trash = new trash;
		$trash->tablename = $this->entity->table;
		$trash->record = json_encode($record);
		$trash->recordid = $id;
		$trash->deletedby = Session::get('light.useruid');
		
		unset($trash->table);

		$dbStatus = DBAccess::ArchiveRecord($trash, $trash->tablename);
		if ($dbStatus) {
			return CommonFunctions::UserMessge("Record Archived Successfully!", 1, "alert-success");
		}else{
			return CommonFunctions::UserMessge("Problem in archiving Record", 0, "alert-error");
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function postDetail($id)
	{
		$id = HtmlUtils::decrypt($id);
		return View::make(
							'shared.details', 
							array(
								'model' => DB::table($this->entity->table)->where('id', $id)->get(),
								'table' => $this->entity->table
								)
						);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function postArchiveAll($id)
	{
		$ids = Input::get('checkDataRow');
		$dbStatus = true;
		if (!isset($ids)) {
			return CommonFunctions::UserMessge("No records selected for archiving", 0, "alert-error");
		}
		foreach ($ids as $idkey => $id) {
			$id = HtmlUtils::decrypt($id);
			$record = DB::table($this->entity->table)->where('id', $id)->get();

			$trash = new trash;
			$trash->tablename = $this->entity->table;
			$trash->record = json_encode($record);
			$trash->recordid = $id;
			$trash->deletedby = Session::get('light.useruid');
			
			unset($trash->table);

			$dbStatus &= DBAccess::ArchiveRecord($trash, $trash->tablename);			
		}

		if ($dbStatus) {
			return CommonFunctions::UserMessge("All Records Archived Successfully!", 1, "alert-success");
		}else{
			return CommonFunctions::UserMessge("Problem in archiving Records", 0, "alert-error");
		}
	}

	/**
	 * Return dropdown options for cascade table
	 *
	 * @return option html
	 */
	public function postCascade($id)
	{
		$table = Input::get('spKey');
		$nameField = Input::get('nameField');
		$pkField = Input::get('pkField');
		$pkId = Input::get('data');

		$optionRecord = DB::table($table)
							->where($pkField, $pkId)
							->select('id', $nameField)->get();
		$optionHtml = '';
		foreach ($optionRecord as $optionIndex => $option) {
			$optionHtml .= '<option value="'.$option->id.'">'.$option->$nameField.'</option>';
		}

		return $optionHtml;
	}

	public function getServerGrid()
	{
		$rowsHtml = '';
		$iSortCol = intval(Input::get('iSortCol_0'));
		$iSortCol = $iSortCol>0?$iSortCol-1:$iSortCol;
		$iDisplayStart = intval(Input::get('iDisplayStart'));
		$iDisplayLength = intval(Input::get('iDisplayLength'));
		
		$rowsQry = $this->gridModel['rowEloq']
		            ->orderBy(
		            		$this->gridModel['fields'][$iSortCol],
		            		Input::get('sSortDir_0')
		            	)
		            ->orWhere(function($query)
			            {
			            	$fieldFilters = explode(',', Input::get('footerFilters'));
			            	foreach ($fieldFilters as $fieldIndex => $fieldFilter) {
			            		if (trim($fieldFilter)!='') {
			            			$query->whereRaw(
			            				$this->gridModel['fields'][$fieldIndex]." like '%".$fieldFilter."%'"
			            			);
			            		}
			            	}
			            })
		            ->skip($iDisplayStart)
		            ->take($iDisplayLength);
		
		$this->gridModel['rows'] = $rowsQry->get();
		$rowsHtml = View::make(
						'shared.smartgridrows',
						array('gridmodel' => $this->gridModel, 'serverside' => 0)
					)
					->render();

		$totalRows = $rowsQry->count();
		
		$gridData = array(
						"sEcho" => 1,
						"iTotalRecords"=> $totalRows,
  						"iTotalDisplayRecords"=> $totalRows,
  						"aaData"=> array(),
  						"aaRowHtml"=> $rowsHtml,
  						"skip"=>$iDisplayStart,
  						"take"=>$iDisplayLength,
  						"footerFilters"=>explode(',', Input::get('footerFilters')),
  						"iSortCol_0" => $iSortCol,
  						"sSortDir_0" => Input::get('sSortDir_0')
					);
		return json_encode($gridData);
	}
}