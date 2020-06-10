
@extends('front.layouts.master')


@section('page_title')
معلوماتي
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
        </div><!--End container-->
        <section class="signup text-center">
            <div class="container">
            
                <div class="py-4 mb-4 text-center">

                    @include('flash::message')


                        <table id="profileTable">
                            <tbody>
                                <tr >
                                    <td>الاسم :</td>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <td>الإيميل :</td>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <td>تاريخ الميلاد :</td>
                                    <td>{{$user->date_of_birth}}</td>
                                </tr>
                                <tr>
                                    <td>فصيلة الدم :</td>
                                    <td>{{$user->bloodType->name}}</td>
                                </tr>
                                <tr>
                                    <td>المحافظة :</td>
                                    <td>{{$user->city->governorate->name}}</td>
                                </tr>
                                <tr>
                                    <td>المدينة :</td>
                                    <td>{{$user->city->name}}</td>
                                </tr>
                                <tr>
                                    <td>الهاتف :</td>
                                    <td>{{$user->phone}}</td>
                                </tr>
                                <tr>
                                    <td>آخر تاريخ للتبرع :</td>
                                    <td>{{$user->last_donation_date}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div>

                        <br>
                        <a href="{{route('editProfile')}}"><button class="btn btn-success py-2 w-50">تعديل</button></a>
                </div>
            </div>
        </section>
@endsection
