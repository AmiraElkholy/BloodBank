


          <div class="form-group">
            <label for="title">Title: </label>
            {!! Form::text('title', null, [
                'class' => 'form-control'
            ])  !!}
          </div>


		
		  <div class="form-group">
            <label for="body">Body: </label>
            {!! Form::textarea('body', null, [
                'class' => 'form-control'
            ])  !!}
          </div>


          <div class="form-group">
            <label for="image">image: </label>
            {!! Form::file('image', null, [
                'class' => 'form-control'
            ])  !!}
          </div>          


          <div class="form-group">
            <label for="category_id">Category: </label>
            {!! Form::select('category_id', $availableCategories, null, ['class' => 'form-control'])  !!}
          </div>

          <div class="form-group">
            <label for="publish_date">Publish Date: </label>
            <input type="date" name="publish_date" value="{{$record ? \Carbon\Carbon::createFromDate($record->publish_date)->format('Y-m-d') : ''}}" class="form-control">
            
          </div>




         <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
         </div> 
