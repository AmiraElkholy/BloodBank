@extends('layouts.app')



@section('page_title')
Contacts
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->                 
         <div class="card">
            <div class="card-header">
              <h3 class="card-title">Details of contact: "{{$record->name}}" </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


              @include('flash::message')
              <br><br>

            @if($record)
             <table id="example2" class="table table-bordered">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Date of birth</th>
                  <th>Blood type</th>
                  <th>Last donation date</th>
                  <th>City</th>
                  <th>Account status</th>
                  <th>Created_at</th>
                  <th>Updated_at</th>
                  <th>Activate / De-activate</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  <tr class="{{($record->is_activated)? 'activated' : 'de-activated'}}">
                      <td>{{$record->id}}</td>
                      <td>{{$record->name}}</td>
                      <td>{{$record->phone}}</td>
                       <td>{{$record->email}}</td>
                      <td>{{$record->date_of_birth}}</td>
                      <td>{{$record->bloodType->name}}</td>
                      <td>{{$record->last_donation_date}}</td>
                      <td>{{$record->city->name}}</td>
                      <td>{{ ($record->is_activated)? 'Activated' : 'De-activated' }}</td>
                      <td>{{$record->created_at}}</td>
                      <td>{{$record->updated_at}}</td>
                      <td class="text-center">
                        <a href="{{url(route('clients.toggleActivation', $record->id))}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                      </td>
                      <td class="text-center">
                        {!! Form::open([
                              'action' => ['ClientController@destroy', $record->id],
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
