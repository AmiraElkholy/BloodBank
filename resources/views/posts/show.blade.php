@extends('layouts.app')



@section('page_title')
Posts
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->                 
         <div class="card">
            <div class="card-header">
              <h3 class="card-title">Details of "{{$record->title}}"</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


              @include('flash::message')
              <br><br>

            @if($record)
             <table id="example2" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Body</th>
                  <th>Image</th>
                  <th>Category</th>
                  <th>Created_at</th>
                  <th>Updated_at</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                      <td>{{$record->id}}</td>
                       <td>{{$record->title}}</td>
                      <td>{{$record->body}}</td>
                      <td><a  target="_blank" href="{{ URL::to('/') }}/images/{{$record->image}}" >
                          <img src="{{ URL::to('/') }}/images/{{$record->image}}" style="max-height: 280px; max-width: 500px;">
                      </a></td>
                      <td>{{$record->category->name}}</td>
                      <td>{{$record->created_at}}</td>
                      <td>{{$record->updated_at}}</td>
                      <td class="text-center">
                        <a href="{{url(route('post.edit', $record->id))}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                      </td>
                      <td class="text-center">
                        {!! Form::open([
                              'action' => ['PostController@destroy', $record->id],
                              'method' => 'delete'
                          ]) !!}
                        <button type="submit" class="btn btn-danger btn-xs">
                          <i class="fas fa-trash"></i>
                        </button> 
                        {!! Form::close() !!}

                      </td>
                  </tr>  
              </table> 

              @endif

            </div>
            <!-- /.card-body -->
          </div>


          <div class="text-right back-btn">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> &nbsp;Back &nbsp;</a>
          </div>  

    </section>
    <!-- /.content -->

@endsection
