@extends('layouts.app')



@section('page_title')
Donation Request Details
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->                 
         <div class="card">
            <div class="card-header">
              <h3 class="card-title">Details of donation request:</h3>
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
                </tr>
                </thead>
                <tbody>
                  <tr>
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
                        <a href="{{url(route('clients.show', $record->client_id))}}" class="btn btn-info">
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
