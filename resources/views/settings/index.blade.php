@extends('layouts.app')



@section('page_title')
Site Settings
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->                 
         <div class="card">
            <div class="card-header">
              <h3 class="card-title">List of all settings</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


              @include('flash::message')


            @if(count($records))
             <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>Notification Settings Text</th>
                  <th>About App Text</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>fb_link</th>
                  <th>tw_link</th>
                  <th>insta_link</th>
                  <th>youtube_link</th>
                  <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($records as $record)
                  <tr>
                      <td>{{$record->notification_settings_text}}</td>
                      <td>{{$record->about_app_text}}</td>
                      <td>{{$record->phone}}</td>
                      <td>{{$record->email}}</td>
                      <td>{{$record->fb_link}}</td>
                      <td>{{$record->tw_link}}</td>
                      <td>{{$record->insta_link}}</td>
                      <td>{{$record->youtube_link}}</td>
                      <td class="text-center">
                        <a href="{{url(route('setting.edit', $record->id))}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                      </td>
                  </tr>       
                  @endforeach
              </table>
            @else
              <div class="alert alert-danger" role="alert">
                  No settings to display.
              </div>
            @endif 
            </div>
            <!-- /.card-body -->
          </div>

    </section>
    <!-- /.content -->

@endsection
