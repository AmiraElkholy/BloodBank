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
         <form action="{{route('cities.destroy', 'test')}}" method="post">
            {{method_field('delete')}}
            {{csrf_field()}}
            <input type="hidden" name="id" id="id" value="">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
            <button id="modalDeleteBtn" type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>     
@endpush