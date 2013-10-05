<div id="modalRowDetails" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel3">Details for {{ $table }}</h3>
	</div>
	<div class="modal-body">
		<p>
			<table class="table table-striped table-bordered">
				<tbody>
					@foreach ($model[0] as $column => $value)
					<tr>
						<td>
							{{ $column }} :
							@if (HtmlUtils::startsWith('[', trim($value)))
							 <pre>{{ $value }}</pre>
							@else
							 <pre>{{ $value }}</pre>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</p>
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" data-dismiss="modal">Ok</button>
	</div>
</div>