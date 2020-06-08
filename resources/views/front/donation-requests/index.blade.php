@extends('front.layouts.master')



@section('content')

<div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
            </ol>
        </nav>
    </div><!--End container-->
    <!--Donation-->
    <section class="donation">
        <h2 class="text-center"><span class="py-1">طلبات التبرع</span> </h2>
        <hr />
        <div class="donation-request py-5">
            <div class="container">
                <form method="POST" action="{{url('/donation-requests')}}">
                <div class="selection w-75 d-flex mx-auto my-4">
                        {{csrf_field()}}
                        <select class="custom-select" name="blood_type_id">
                            <option selected value="">اختر فصيلة الدم</option>
                            @foreach($blood__types as $blood_type)
                                <option value="{{$blood_type->id}}">{{$blood_type->name}}</option>
                            @endforeach
                        </select>
                        <select class="custom-select mx-md-3 mx-sm-1" name="city_id">
                            <option selected value="">اختر المدينة</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                        
                        <div>
                            <button type="submit" style="border:none; background-color: #F5F5F5;"><i class="fas fa-search"></i></button></a>
                        </div>
                    </div>

                <!--End selection-->
                </form>

                @foreach($donation_requests as $don_req)
                <div class="req-item my-3">
                    <div class="row">
                        <div class="col-md-9 col-sm-12 clearfix">
                            <div class="blood-type m-1 float-right">
                                <h3>{{$don_req->bloodType->name}}</h3>
                            </div>
                            <div class="mx-3 float-right pt-md-2">
                                <p>
                                    اسم الحالة : {{$don_req->patient_name}}
                                </p>
                                <p>
                                    مستشفى : {{$don_req->hospital_name}}
                                </p>
                                <p>
                                    المدينة : {{$don_req->city->name}}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 text-center p-sm-3 pt-md-5">
                            <a href="{{url('/donation-requests/'.$don_req->id)}}" class="btn btn-light px-5 py-3">التفاصيل</a>
                        </div>
                    </div>
                </div>
                @endforeach

               
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center my-3">
                        {!! $donation_requests->links() !!}
                  </ul>
                </nav>
            </div>
            <!--End container-->
        </div>
        <!--End Donation-request-->
    </section>
    <!--End Donation-->







@endsection