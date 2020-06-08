@extends('front.layouts.master')


@section('content')

	<!--main-header-->
        <div class="main-header">
            <div class="slide">
                <img src="{{asset('front/imgs/header.jpg')}}" class="d-block w-100" alt="...">
                <div class="slick-caption">
                    <h4 class="my-md-3">بنك الدم نمضى قدما لصحة أفضل</h4>
                    <p class="pl-md-5">{{$settings->about_app_text}}</p>
                    <a href="{{route('about')}}"><button class="btn bg px-5">المزيد</button></a>
                </div>
            </div>
            <div class="slide">
                <img src="{{asset('front/imgs/header.jpg')}}" class="d-block w-100" alt="...">
                <div class="slick-caption">
                    <h4 class="my-md-3">بنك الدم نمضى قدما لصحة أفضل</h4>
                    <p class="pl-md-5">{{$settings->about_app_text_2}}</p>
                    <a href="{{route('about')}}"><button class="btn bg px-5">المزيد</button></a>
                </div>
            </div>
            <div class="slide">
                <img src="{{asset('front/imgs/header.jpg')}}" class="d-block w-100" alt="...">
                <div class="slick-caption">
                    <h4 class="my-md-3">بنك الدم نمضى قدما لصحة أفضل</h4>
                    <p class="pl-md-5">{{$settings->about_app_text_3}}</p>
                    <a href="{{route('about')}}"><button class="btn bg px-5">المزيد</button></a>
                </div>
            </div>
        </div>
        <!--End main-header-->
    </section>
    <!--End Header-->

    <!--About section-->
    <section class="about py-5">
        <div class="container">
            <div class="about-cont py-3">
                <p class="pl-4"><span> بنك الدم</span> {{$settings->intro_text}}
                </p>
            </div>
        </div>
        <!--End container-->
    </section>
    <!--End About-->
    <!--Articles section-->
    <section class="articles py-5">
        <div class="title">
            <div class="container">
                <h2><span class="py-1">المقالات</span> </h2>
            </div>
            <hr />
        </div>
        <div class="article-slide mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="arrow text-left">
                            <button type="button" class="prev-arrow px-2 py-1"><i
                                    class="fas fa-chevron-right"></i></button>
                            <button type="button" class="next-arrow px-2 py-1"><i
                                    class="fas fa-chevron-left"></i></button>
                        </div>
                    </div>
                </div>
                <div class="slick2">                   
                    @foreach($posts as $post)  
                    <div class="slick-cont">
                        <div class="card">
                            <img src="{{$post->full_thumbnail_path}}" class="card-img-top" alt="slick-img">
                            <div class="heart-icon" id="{{$post->id}}"><i class="fa-heart {{($post->is_favourite)? 'fas':'far'}}" ></i></div>
                            <div class="card-body">
                                <h5 class="card-title">{{$post->title}}</h5>
                                <p>{{$post->body}}</p>
                                <div class="text-center"><a href="{{url('posts/'.$post->id)}}" class="btn bg px-5">التفاصيل</a>
                                </div>
                            </div>
                        </div>
                    </div>
               		@endforeach
                  
                </div>
            </div>
        </div>
        <!--End container-->
    </section>
    <!--End Articles-->
    <br>
    <!--Donation-->
    <section class="donation">
        <h2 class="text-center"><span class="py-1">طلبات التبرع</span> </h2>
        <hr />
        <div class="donation-request py-5">
            <div class="container">
                <form method="POST" action="{{url('donation-requests')}}">
                    {{csrf_field()}}
                <div class="selection w-75 d-flex mx-auto my-4">
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
                </form>
                <!--End selection-->
                <div id="donations">
                	

                </div>
                <!--End last req-item-->

            </div>
            <!--End container-->
        </div>
        <!--End Donation-request-->
    </section>
    <!--End Donation-->



      <!--Contact-us-->
    <section class="contact-us py-5 mt-4">
        <div class="container">
            <div class="row">
                <div class="contact-info col-md-6 col-sm-12 text-center">
                    <h4 class="text-center"><span class="brd">اتصل بنا </span> </h4>
                    <p class="my-5">يمكنك الأتصال بنا للاستفسار عن معلومة وسيتم الرد عليكم</p>
                    <a href="{{$settings->whats}}" target="_blank" style="text-decoration: none;">
                    	<div class="phone-nm mx-auto">
	                        <p class="text-right" href="">{{$settings->whats_number}}</p>
	                        <img src="{{asset('front/imgs/whats.png')}}" alt="whats-phone">
	                    </div>
                    </a>
                </div>
            </div>
        </div>
        <!--End container-->
    </section>
    <!--End Contact-us-->
    <!--blood-app-->
    <section class="blood-app py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="mt-5 mb-4">تطبيق بنك الدم</h4>
                    <p class="appText">{{$settings->mobile_app_text}}</p>
                    <div class="text-center avilb">
                        <h5 class="my-4">متوفر على</h5>
                        <a href="{{$settings->g_play_link}}" target="_blank"><img src="{{asset('front/imgs/google.png')}}" alt=""></a>
                        <a href="{{$settings->apple_store_link}}" target="_blank"><img src="{{asset('front/imgs/ios.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-md-6 my-3"><img src="{{asset('front/imgs/App.png')}}" class="img-fluid" alt=""></div>
            </div>
            <!--End row-->
        </div>
        <!--End container-->
    </section>
    <!--End blood-app-->


@endsection



@push('scripts')

    <script type="text/javascript">
        
        $('.heart-icon').click(function() { 
            var post_id = $(this).attr('id');
            var icon = $(this).find('i');

            console.log(post_id);

            $.ajax({
                url : '{{url(route('toggleFavouritesWeb'))}}',
                type: 'POST',
                data: {
                    _token  : '{{csrf_token()}}',
                    post_id : post_id,
                },
                success: function(data) {
                    console.log(data);

                    if(data.status ==1) {
                        if ($(icon).hasClass('fas')) {
                            $(icon).removeClass('fas').addClass('far');
                        } else {
                            $(icon).removeClass('far').addClass('fas');
                        };
                    }
                   
                },
                error: function(jqXHR, textStatus, errorMessage) {
                    alert(errorMessage);
                }
            });

        });

    </script>

@endpush