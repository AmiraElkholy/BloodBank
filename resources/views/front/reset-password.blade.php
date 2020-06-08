
@extends('front.layouts.master')


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

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{route('clientsResetLinkRequest')}}"  method="POST" class="w-75 mx-auto my-5">
                {{ csrf_field() }}
                <p>من فضلك ادخل الإيميل المسجل ببيانتنا :</p>
                <input type="email" name="email" value="{{old('email')}}" class="form-control my-3 py-3" id="email" placeholder="الإيميل">
                <div class="clr"></div>
                <div class="form-row my-4">
                    <div class="col-4" >
                        <button type="submit" class="form-control py-3 bg-success text-white">إرسال</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection 