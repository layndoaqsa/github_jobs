<div id="modal-import" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-purple-400">
				<h5 class="modal-title"><label id="modal-title"></label> @yield('titlepage')</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
            <form class="form-horizontal form-validate-jquery" action="{{route('user.import')}}" method="post" id="modal-form-import" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_edit" id="id_edit">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Download import format in</label>
                                <a href="{{asset('file/import-template/Format Import User.xlsx')}}" class="text-primary"> here</a>
                                <input type="file" name="file" id="file" class="file-input" data-show-preview="false" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" data-fouc>
                                <span class="form-text text-muted">Only <code>.xls</code> and  <code>.xlsx</code> extensions are allowed.</span>
                            </div>
                        </div>
                    </div>
                </div>
			</form>
		</div>
	</div>
</div>

@push('after_script')

@endpush