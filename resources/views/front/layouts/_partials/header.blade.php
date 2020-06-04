<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap file css-->
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <!--Plugins file css-->
    <link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/jquery-nao-calendar.css')}}">
    <!--google-font-->
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&display=swap" rel="stylesheet">
    <!--main file css-->
    <link rel="stylesheet" href="{{asset('front/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <style type="text/css">
        select {
            padding-bottom: 0px !important;
        }
    </style>
    <title>بنك الدم</title>
</head>

<body>
    <!--Loading Page-->
    <div class="loading-page">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!--header section-->
    <section class="header">
        <!--top-bar-->
        <div class="top-bar py-2">
            <div class="container">
                <!--row of top-bar-->
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="index.html" class="ar px-1">عربى</a>
                        <a href="" class="en px-1">EN</a>
                    </div>
                    <div>
                        <ul class="list-unstyled">
                            <li class="d-inline-block mx-2"><a class="facebook" href="{{$settings->fb_link}}" target="_blank"><i
                                        class="fab fa-facebook-f"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="insta" href="{{$settings->insta_link}}" target="_blank"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="twitter" href="{{$settings->tw_link}}" target="_blank"><i
                                        class="fab fa-twitter"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="whatsapp" href="{{$settings->whats}}`" target="_blank"><i
                                        class="fab fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                    <div class="connect">
                        <div class="dropdown">
                            <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span> مرحبا بك </span> &nbsp; &nbsp;أحمد محمد
                            </a>
                            <div class="dropdown-menu text-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="index.html"> <i class="fas fa-home ml-2"></i>الرئيسيه</a>
                                <a class="dropdown-item" href="#"> <i class="fas fa-user-alt ml-2"></i>معلوماتى</a>
                                <a class="dropdown-item" href="#"> <i class="fas fa-bell ml-2"></i>اعدادات الاشعارات</a>
                                <a class="dropdown-item" href="#"> <i class="far fa-heart ml-2"></i>المفضلة</a>
                                <a class="dropdown-item" href="#"> <i class="far fa-comments ml-2"></i>ابلاغ</a>
                                <a class="dropdown-item" href="contact.html"> <i class="fas fa-phone ml-2"></i>تواصل
                                    معنا</a>
                                <a class="dropdown-item" href="#"> <i class="fas fa-sign-out-alt ml-2"></i>خروج</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End row-->
            </div>
            <!--End container-->
        </div>
        <!--End top-bar-->
        <!--navbar-->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="{{asset('front/imgs/logo.png')}}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.html">الرئيسيه <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">عن بنك الدم</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="article-details.html">المقالات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="donation.html">طلبات التبرع</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about-us.html">من نحن</a>
                        </li>
                        <li class="nav-item cont">
                            <a class="nav-link" href="contact.html">اتصل بنا</a>
                        </li>
                        <li class="mr-lg-auto"><a class="signin" href="signup.html">انشاء حساب جديد</a></li>
                        <li class="pr-3"><a class="btn bg" href="signin.html">الدخول</a></li>
                    </ul>
                </div>
            </div>
            <!--End container-->
        </nav>
        <!--End Nav-->
        