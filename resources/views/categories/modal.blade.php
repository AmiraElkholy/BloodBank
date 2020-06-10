@push('modals')
<!-- Modal HTML -->
<div id="myModal" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">
        <div class="icon-box">
          <i class="fas fa-times material-icons"></i>
        </div>        
        <h4 class="modal-title">Are you sure?</h4>  
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p>Do you really want to delete these records? This process cannot be undone.</p>
      </div>
      <div class="modal-footer">
        {!! Form::open([
            'action' => ['CategoryController@destroy', $record->id],
            'method' => 'delete'
        ]) !!}
        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>     
@endpush