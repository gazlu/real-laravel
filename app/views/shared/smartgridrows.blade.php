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
		  	<a href="javascript:;" class="show-tooltip showit btn" title="Display details">
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