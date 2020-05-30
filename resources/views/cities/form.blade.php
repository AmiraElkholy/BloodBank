

          <div class="form-group">
            <label for="name">Name: </label>
            {!! Form::text('name', null, [
                'class' => 'form-control'
            ])  !!}
          </div>
          <div class="form-group">
            <label for="governorate_id">Governorate: </label>
            {!! Form::select('governorate_id', $availableGovernorates, null, ['class' => 'form-control'])  !!}
          </div>


         <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
         </div> 
