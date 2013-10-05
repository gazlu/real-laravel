<div class="row">
	<form id="gridForm" name="gridForm" class="reportform">
		<div class="btn-toolbar pull-right clearfix">
			<div class="btn-group">
				<a class="btn btn-circle show-tooltip" title="Add new record" href="javascript:;"><i class="icon-plus"></i></a>
				<a class="btn btn-circle show-tooltip" title="Edit selected" href="javascript:;"><i class="icon-edit"></i></a>
				<a class="btn btn-circle show-tooltip" title="Delete selected" onclick="multiArchive()" href="javascript:;"><i class="icon-trash"></i></a>
			</div>
			<div class="btn-group">
				<a class="btn btn-circle show-tooltip" title="Print" href="javascript:;"><i class="icon-print"></i></a>
				<a class="btn btn-circle show-tooltip" title="Export to PDF" href="javascript:;"><i class="icon-file-text-alt"></i></a>
				<a class="btn btn-circle show-tooltip" title="Export to Exel" href="javascript:;"><i class="icon-table"></i></a>
			</div>
			<div class="btn-group">
				<a class="btn btn-circle show-tooltip" id="gridRefresh" title="Refresh" onclick="LoadDataTable()" href="javascript:;"><i class="icon-repeat"></i></a>
			</div>
		</div>
		<div class="clearfix"></div>
		<table class="table table-advance dataTable table-striped" id="datatable">
			<thead>
				<tr>
					<th>
						<input type="checkbox" name="checkAllRows" value="1" id="checkAllRows">
					</th>
					@foreach ($gridmodel['columns'] as $column) 
					<th>{{ $column }}</th>
					@endforeach
					<th class="actionscol">Actions</th>
				</tr>
			</thead>
			<tbody>
				@if($serverside!=='1')
					@foreach ($gridmodel['rows'] as $rowIndex => $row)
					<tr class="{{ $rowIndex%2==0? 'table-flag-blue' : 'table-flag-orange' }}" data-rowid="{{ HtmlUtils::encrypt($row->id) }}">
						<td>
							<input type="checkbox" name="checkDataRow[]" 
							value="{{ HtmlUtils::encrypt($row->id) }}" id="checkDataRow">
						</td>
						@for ($iField =0; $iField < count($gridmodel['fields']); $iField++)
						<td>
							{{ $row->$gridmodel['fields'][$iField] }}
						</td>
						@endfor
						<td class="actionscol">
							<div class="btn-group">
							  	<a class="show-tooltip showit btn" title="Display details" href="javascript:;">
							  		<i class="icon-zoom-in"></i>
							  	</a>
								<a href="javascript:;" class="show-tooltip editit btn" title="Edit this item">
									<i class="icon-edit-sign"></i>
								</a>
								<a href="javascript:;" class="show-tooltip removeit btn" title="Archive this item">
									<i class="icon-remove-sign"></i>
								</a>
							</div>
							@if (in_array('action', $gridmodel))
								{{ $gridmodel['action'] }}
							@endif
						</td>
					</tr>
					@endforeach
				@endif
			</tbody>
			<tfoot>
				<tr>
					<td></td>
					@for ($iColumn =0; $iColumn < count($gridmodel['columns']); $iColumn++)
					<td class="dtFoot">
						<div class="input-append">
                            <input class="input-small" type="text" name="filter[]" value="" placeholder="Search {{ $gridmodel['columns'][$iColumn] }}">
                            <button class="btn" type="button"><i class="icon-search"></i></button>
                        </div>
					</td>
					@endfor
					<td></td>
				</tr>
			</tfoot>
		</table>
	</form>
</div>