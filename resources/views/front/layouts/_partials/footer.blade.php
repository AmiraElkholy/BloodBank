    <!--Footer-->
    <footer>
        <div class="main-footer py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4  offset-1">
                        <img src="{{asset('front/imgs/logo.png')}}" alt="">
                        <h5 class="my-3">بنك الدم</h5>
                        <p class="pl-4">{{$settings->footer_text}}</p>
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('home')}}" style="text-decoration: none;"><h6>الرئيسية</h6></a>
                        <ul class="list-unstyled">
                            <li class="py-2"><a href="#about">عن بنك الدم</a></li>
                            <li class="py-2"><a href="{{url('/posts')}}">المقالات</a></li>
                            <li class="py-2"><a href="{{url('donation-requests')}}">عن التبرع</a></li>
                            <li class="py-2"><a href="{{route('about')}}">من نحن</a></li>
                            <li class="py-2"><a href="{{route('contact')}}">اتصل بنا</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 available">
                        <h6 class="mb-5">متوفر على</h6>
                        <div class="my-3"><a href="{{$settings->g_play_link}}" target="_blank"><img src="{{asset('front/imgs/google1.png')}}" alt=""></a></div>
                        <div class="my-3"><a href="{{$settings->apple_store_link}}" target="_blank"><img src="{{asset('front/imgs/ios1.png')}}" alt=""></a></div>
                    </div>
                </div>
            </div>
            <!--End container-->
        </div>
        <!--End main-footer-->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-unstyled">
                            <li class="d-inline-block mx-2"><a class="facebook" href=""><i
                                        class="fab fa-facebook-f"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="insta" href=""><i
                                        class="fab fa-instagram"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="twitter" href=""><i
                                        class="fab fa-twitter"></i></a></li>
                            <li class="d-inline-block mx-2"><a class="whatsapp" href=""><i
                                        class="fab fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center">جميع الحقوق محفوظه لـ <a href="{{route('home')}}"><span>بنك الدم</span></a> &copy; 2019</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--End Footer-->
    <!--scrollUp-->
    <div class="scrollUp">
        <i class="fas fa-chevron-up"></i>
    </div>
    <!--jquery/bootstrap/main file js-->
    <script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('front/js/slick.min.js')}}"></script>
    <script src="{{asset('front/js/jquery-nao-calendar.js')}}"></script>
    <script src="{{asset('front/js/popper.min.js')}}"></script>
    <script src="{{asset('front/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/js/main.js')}}"></script>
    <!-- date picker -->
    <script type="text/javascript" src="{{asset('front/js/datepicker.js')}}"></script>
    @stack('scripts')
</body>


</html>