
@extends('front.layouts.master')



@section('content')
    <div class="container">
            <!--Breadcrumb-->
            <nav class="my-4" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                </ol>
            </nav><!--End Breadcrumb-->
        </div><!--End container-->
        <section class="signup text-center">
            <div class="container">
                <div class="py-4 mb-4">
                    <form action="" class="w-75 m-auto">
                        <div><input type="text" name="usName" class="form-control my-3" placeholder="الاسم"></div>
                        <div><input type="mail" name="usEmail" class="form-control my-3" placeholder="البريد الاليكترونى"></div>
                        <div class="input-group">
                            <input type="text"  id="" name="usBirth" class="form-control datepicker" placeholder="تاريخ الميلاد">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <input type="text" name="booldType" class="form-control my-3" placeholder="فصيلة الدم">
                        <div class="input-group mb-3">
                            <select name="capital" id="capital" class="form-control ">
                                <option selected>المحافظة</option>
                                <option value="القاهرة">القاهرة</option>
                                <option value="القليوبيه">القليوبية</option>
                                <option value="سوهاج">سوهاج</option>
                            </select>
                            <!-- <i class="fas fa-chevron-down"></i> -->
                        </div>
                        <div class="input-group">
                            <select name="city" id="city" class="form-control">
                                <option selected>المدينة</option>
                                <option value="القاهرة">الدقى</option>
                                <option value="بنها">بنها</option>
                                <option value="سوهاج">سوهاج</option>
                            </select>
                            <!-- <i class="fas fa-chevron-down"></i> -->
                        </div>
                        <input type="text" name="usPhone" class="form-control my-3" placeholder="رقم الهاتف">
                        <div class="input-group mb-3">
                            <input type="text" id="" name="lstDon" class="form-control datepicker" placeholder="اخر تاريخ تبرع" aria-label="Username" aria-describedby="basic-addon1">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <input type="password" name="usPass" class="form-control my-3" placeholder="كلمة المرور">
                        <input type="password" name="rePass" class="form-control my-3" placeholder="تأكيد كلمة المرور">
                        <button type="submit" class="btn btn-success py-2 w-50">ارسال</button>
                    </form>
                </div>
            </div>
        </section>
@endsection

@push('scripts')

<script type="text/javascript">
    $(function() {
        console.log('here');
        $( ".datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true
        });
    });

</script>

@endpush