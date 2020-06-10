@extends('front.layouts.master')


@section('page_title')
من نحن
@endsection



@section('content')

<div class="container">
        <!--Breadcrumb-->
        <nav class="my-4" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page_title')</li>
            </ol>
        </nav><!--End Breadcrumb-->
        <section class="about-us my-4 py-5">
            <div class="my-5 text-center"><img src="{{asset('front/imgs/logo.png')}}" alt="logo"></div>
            <div class="about-US-content px-4 mb-5">
                <p class="my-md-4">
                	{{$settings->about_us_text}}
                </p> 
            </div>
        </section><!--End about-us-->
    </div><!--End container-->




@endsection