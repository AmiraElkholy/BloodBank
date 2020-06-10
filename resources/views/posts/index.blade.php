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
              <h3 class="card-title">List of all posts</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


              @include('flash::message')

              
              <a href="{{url(route('posts.create'))}}">
                <button type="button" class="btn btn-success" style="float: right; font-weight:bold;">Add   <i class="fas fa-plus"></i></button>
              </a>

              <br><br>

            @if(count($records))
             <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>#</th>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Body</th>
                      <th>Image</th>
                      <th>Category</th>
                      <th>Publish Date</th>
                      <th>Created_at</th>
                      <th>Updated_at</th>
                      <th>Edit</th>
                      <th>Delete</th>
                      <th>Show Details</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($records as $record)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$record->id}}</td>
                      <td>{{$record->title}}</td>
                      <td>{{$record->body}}</td>
                      <td><a  target="_blank" href="{{ URL::to('/') }}/images/{{$record->image}}" >
                          <img src="{{ URL::to('/') }}/images/{{$record->image}}" style="max-height: 280px; max-width: 500px;">
                      </a></td>
                      <td>{{$record->category->name}}</td>
                      <td>{{$record->publish_date}}</td>
                      <td>{{$record->created_at}}</td>
                      <td>{{$record->updated_at}}</td>
                      <td class="text-center">
                        <a href="{{url(route('posts.edit', $record->id))}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                      </td>
                      <td class="text-center">
                        
                        <!-- Button HTML (to Trigger Modal) -->
                        <a href="#myModal" data-toggle="modal">
                          <button type="submit" class="btn btn-danger btn-xs">
                            <i class="fas fa-trash"></i>
                          </button> 
                        </a>

                      </td>
                      <td>
                         <a href="{{url(route('posts.show', $record->id))}}" class="btn btn-warning btn-xs"><i class="fas fa-list"></i></a>
                      </td>
                  </tr>       
                  @endforeach
              </table>
            @else
              <div class="alert alert-danger" role="alert">
                  No cities to display.
              </div>
            @endif 
            </div>
            <!-- /.card-body -->
          </div>

    </section>
    <!-- /.content -->

@endsection



@include('posts.modal')
