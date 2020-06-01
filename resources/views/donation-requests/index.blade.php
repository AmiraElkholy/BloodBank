@extends('layouts.app')



@section('page_title')
Donation Requests
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->                 
         <div class="card">
            <div class="card-header">
              <h3 class="card-title">List of all donation requests</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


              @include('flash::message')


            @if(count($records))
             <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Patient Name</th>
                  <th>Patient Phone</th>
                  <th>Patient Age</th>
                  <th>Blood Type</th>
                  <th>Num. of Bags</th>
                  <th>Hospital Name</th>
                  <th>City</th>
                  <th>Hospital Address</th>
                  <th>Notes</th>
                  <th>Latitude</th>
                  <th>Longitude</th>
                  <th>Client</th>
                  <th>Created_at</th>
                  <th>Delete</th>
                  <th>Show Details</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($records as $record)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$record->id}}</td>
                      <td>{{$record->patient_name}}</td>
                      <td>{{$record->patient_phone}}</td>
                      <td>{{$record->paient_age}}</td>
                      <td>{{$record->bloodType->name}}</td>
                      <td>{{$record->number_of_bags}}</td>
                      <td>{{$record->hospital_name}}</td>
                      <td>{{$record->city->name}}</td>
                      <td>{{$record->hospital_address}}</td>
                      <td>{{$record->notes}}</td>
                      <td>{{$record->latitude}}</td>
                      <td>{{$record->longitude}}</td>
                      <td>
                        <a href="{{url(route('client.show', $record->client_id))}}" class="btn btn-info">
                         <i class="fas fa-user-injured"></i> &nbsp; {{$record->client->name}} </a>
                      </td>
                      <td>{{$record->created_at}}</td>
                      <td class="text-center">
                        {!! Form::open([
                              'action' => ['DonationRequestController@destroy', $record->id],
                              'method' => 'delete'
                          ]) !!}
                        <button type="submit" class="btn btn-danger btn-xs">
                          <i class="fas fa-trash"></i>
                        </button> 
                        {!! Form::close() !!}
                      </td>
                      <td>
                         <a href="{{url(route('donation-request.show', $record->id))}}" class="btn btn-warning btn-xs"><i class="fas fa-list"></i></a>
                      </td>
                  </tr>       
                  @endforeach
              </table>
            @else
              <div class="alert alert-danger" role="alert">
                  No donation requests to display.
              </div>
            @endif 
            </div>
            <!-- /.card-body -->
          </div>

    </section>
    <!-- /.content -->

@endsection
