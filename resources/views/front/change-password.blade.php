
@extends('front.layouts.master')


@php
    $segments = \Request::segments();
    $token = end($segments);
@endphp


@section('content')
    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">تغيير كلمة المرور</li>
            </ol>
        </nav><!--End Breadcrumb-->
        <section class="signup-form my-4 py-4">
            <div class="my-5 text-center"><img src="{{asset('front/imgs/logo.png')}}" alt="logo"></div>

            @include('_partials.errors')
            
            @include('flash::message')

            <form action="{{route('clientsChangePassword')}}"  method="POST" class="w-75 mx-auto my-5">
                @csrf
                <input type="hidden" name="token" value="{{$token}}">
                <p>من فضلك ادخل الإيميل وكلمة المرور الجديدة :</p>
                <input type="email" name="email" class="form-control my-3 py-3" id="email" placeholder="الإيميل">
                <input type="password" name="password" class="form-control my-3 py-3" id="password" placeholder="كلمة المرور">
                <input type="password" name="password_confirmation" class="form-control my-3 py-3" id="password_confirmation" placeholder="تأكيد كلمة المرور">
                <div class="clr"></div>
                <div class="form-row my-4">
                    <div class="col">
                        <button type="submit" class="form-control py-3 bg-success text-white">تغيير كلمة المرور</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection 