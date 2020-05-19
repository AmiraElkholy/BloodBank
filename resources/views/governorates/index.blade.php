@extends('layouts.app')



@section('page_title')
Governorates
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->                 
         <div class="card">
            <div class="card-header">
              <h3 class="card-title">List of all governorates</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
              <a href="{{url(route('governorate.create'))}}">
                <button type="button" class="btn btn-primary" style="float: right; font-weight:bold;">Add   <i class="fas fa-plus"></i></button>
              </a>

              <br><br>

            @if(count($governorates))
             <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Created_at</th>
                  <th>Updated_at</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($governorates as $governorate)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$governorate->id}}</td>
                      <td>{{$governorate->name}}</td>
                      <td>{{$governorate->created_at}}</td>
                      <td>{{$governorate->updated_at}}</td>
                      <td><a href=""></a></td>
                      <td><a href=""></a></td>
                  </tr>       
                  @endforeach
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Created_at</th>
                      <th>Updated_at</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
              </table>
            @else
              <div class="alert alert-danger" role="alert">
                  No governorates to display.
              </div>
            @endif 
            </div>
            <!-- /.card-body -->
          </div>

    </section>
    <!-- /.content -->

@endsection
