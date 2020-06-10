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
                  <th>About App Text 2</th>
                  <th>About App Text 3</th>
                  <th>About Us Text</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>fb link</th>
                  <th>tw link</th>
                  <th>insta link</th>
                  <th>Whats Number</th>
                  <th>whats Link</th>
                  <th>youtube link</th>
                  <th>Intro Text</th>
                  <th>Mobile App Text</th>
                  <th>Google Play Link</th>
                  <th>Apple Store Link</th>
                  <th>Fax Number</th>
                  <th>Footer Text</th>
                  <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($records as $record)
                  <tr>
                      <td>{{$record->notification_settings_text}}</td>
                      <td>{{$record->about_app_text}}</td>
                      <td>{{$record->about_app_text_2}}</td>
                      <td>{{$record->about_app_text_3}}</td>
                      <td>{{$record->about_us_text}}</td>
                      <td>{{$record->phone}}</td>
                      <td>{{$record->email}}</td>
                      <td>{{$record->fb_link}}</td>
                      <td>{{$record->tw_link}}</td>
                      <td>{{$record->insta_link}}</td>
                      <td>{{$record->whats_number}}</td>
                      <td>{{$record->whats_link}}</td>
                      <td>{{$record->youtube_link}}</td>
                      <td>{{$record->intro_text}}</td>
                      <td>{{$record->mobile_app_text}}</td>
                      <td>{{$record->g_play_link}}</td>
                      <td>{{$record->apple_store_link}}</td>
                      <td>{{$record->fax_number}}</td>
                      <td>{{$record->footer_text}}</td>
                      <td class="text-center">
                        <a href="{{url(route('settings.edit', $record->id))}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
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
