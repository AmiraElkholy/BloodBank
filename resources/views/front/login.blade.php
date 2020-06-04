
@extends('front.layouts.master')


@section('content')
    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
            </ol>
        </nav><!--End Breadcrumb-->
        <section class="signup-form my-4 py-4">
            <div class="my-5 text-center"><img src="{{asset('front/imgs/logo.png')}}" alt="logo"></div>

            @include('_partials.errors')
            
            @include('flash::message')

            <form action="{{route('clientsLoginSubmit')}}"  method="POST" class="w-75 mx-auto my-5">
                {{ csrf_field() }}
                <input type="phone" name="phone" value="{{old('phone')}}" class="form-control my-3 py-3" id="phone" placeholder="الجوال">
                <input type="password" name="password" class="form-control my-3 py-3" id="password" placeholder="كلمة المرور">
                <div class="form-check float-right my-4">
                    <input class="form-check-input" type="checkbox" value="{{old('remember' ? 'checked' : '')}}" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                       تذكرنى
                    </label>
                </div>
                <div class="float-left my-4"><a href=""><i class="fas fa-exclamation-triangle px-2"></i><span>هل نسيت كلمة المرور</span></a></div>
                <div class="clr"></div>
                <div class="form-row my-4">
                    <div class="col">
                        <button type="submit" class="form-control py-3 bg-success text-white">دخول</button>
                    </div>
                    <div class="col">
                        <a href="signup.html" type="submit" class="form-control text-center py-3 bg">انشاء حساب جديد</a>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection 