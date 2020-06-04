    <!--Footer-->
    <footer>
        <div class="main-footer py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4  offset-1">
                        <img src="{{asset('front/imgs/logo.png')}}" alt="">
                        <h5 class="my-3">بنك الدم</h5>
                        <p class="pl-4"> هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد
                            هذا النص من مولد النص العرب حيث يمكنك ان تولد هذا النص أو
                            العديد من النصوص الأخرى وإضافة الى زيادة عدد الحروف التى يولدها التطبيق يطلع على صورة حقيقة
                            لتطبيق
                            الموقع
                        </p>
                    </div>
                    <div class="col-md-3">
                        <h6 class="">الرئيسية</h6>
                        <ul class="list-unstyled">
                            <li class="py-2"><a href="">عن بنك الدم</a></li>
                            <li class="py-2"><a href="article-details.html">المقالات</a></li>
                            <li class="py-2"><a href="donation.html">عن التبرع</a></li>
                            <li class="py-2"><a href="about-us.html">من نحن</a></li>
                            <li class="py-2"><a href="contact.html">اتصل بنا</a></li>
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
                        <p class="text-center">جميع الحقوق محفوظه لـ <span>بنك الدم</span> &copy; 2019</p>
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
    <script>
        // var request = new XMLHttpRequest();

        // var url = "https://cors-anywhere.herokuapp.com/" + "http://ipda3-tech.com/blood-bank/api/v1/donation-requests?api_token=W4mx3VMIWetLcvEcyF554CfxjZHwdtQldbdlCl2XAaBTDIpNjKO1f7CHuwKl&page=1";

        // request.open('GET', url);

        // request.onreadystatechange = function () {
        //     if (this.readyState == 4 && this.status == 200) {

        //         var dataHolder = JSON.parse(this.responseText);
        //         var div = document.getElementById('donations');
        //         var temp = "";
        //         for (var i = 0; i < dataHolder['data'].data.length; i++) {
        //             temp += '<div class="req-item my-3"><div class="row"><div class="col-md-9 col-sm-12 clearfix"><div class="blood-type m-1 float-right"><h3>' + dataHolder['data'].data[i].blood_type.name + '</h3></div><div class="mx-3 float-right pt-md-2"><p>اسم الحالة : ' + dataHolder['data'].data[i].patient_name + '</p><p>مستشفى : ' + dataHolder['data'].data[i].hospital_name + '</p><p>المدينة : ' + dataHolder['data'].data[i].city.name + '</p></div></div><div class="col-md-3 col-sm-12 text-center p-sm-3 pt-md-5"><a href="Status-detailes.html" class="btn btn-light px-5 py-3">التفاصيل</a></div></div></div>';
        //         }


        //         div.innerHTML = temp;
        //         // console.log(dataHolder);


        //     }
        // };

        // request.send();

    </script>
</body>


</html>