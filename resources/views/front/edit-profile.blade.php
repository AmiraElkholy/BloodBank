
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

                    @include('_partials.errors')
            
                    @include('flash::message')
                    

                    <form action="{{route('updateProfile')}}" method="POST" class="w-75 m-auto">
                        {{csrf_field()}}

                        <div>
                            <input type="text" name="name" class="form-control my-3" placeholder="الاسم" value="{{$user->name}}">
                        </div>
                        <div>
                            <input type="mail" name="email" class="form-control my-3" placeholder="البريد الاليكترونى" value="{{$user->email}}">
                        </div>
                        <div class="input-group">
                            <input type="text"  id="birthdaypicker" name="date_of_birth" class="form-control" id="birthdaypicker" placeholder="تاريخ الميلاد" value="{{$user->date_of_birth}}">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <br>
                        <div class="input-group mb-3">
                            <select name="blood_type_id" class="custom-select">
                                <option disabled selected style="color:#495057 !important;" value="">فصيلة الدم</option>
                                @foreach($blood_types as $blood_type)
                                    <option value="{{$blood_type->id}}" {{($blood_type->id==$user->blood_type_id)? 'selected' : ''}}>{{$blood_type->name}}</option>
                                @endforeach
                            </select>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <!-- $user->city->governorate->only(['name', 'id']) -->
                        <div class="input-group mb-3">
                            {!! Form::select('governorate_id', $governorates->pluck('name', 'id')->toArray(), null, [
                                'placeholder' => 'اختر محافظة',
                                'class' => 'custom-select',
                                'id'    => 'governorates'
                            ]) !!}
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="input-group">
                            {!! Form::select('city_id', [], null, [
                                'placeholder' => 'اختر مدينة',
                                'class' => 'custom-select',
                                'id'    => 'cities'
                            ]) !!}
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <input type="text" name="phone" class="form-control my-3" placeholder="رقم الهاتف" value="{{$user->phone}}">
                        <div class="input-group mb-3">
                            <input type="text" name="last_donation_date" class="form-control" id="donationdatepicker" placeholder="اخر تاريخ تبرع" value="{{$user->last_donation_date}}" aria-label="Username" aria-describedby="basic-addon1">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <input type="password" name="password" class="form-control my-3" placeholder="كلمة المرور">
                        <input type="password" name="password_confirmation" class="form-control my-3" placeholder="تأكيد كلمة المرور">
                        <button type="submit" class="btn btn-success py-2 w-50">ارسال</button>
                    </form>
                </div>
            </div>
        </section>
@endsection

@push('scripts')

<script type="text/javascript">
    $(function() {
        // console.log('here');
        //birthday date picker
        $('#birthdaypicker').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-m-d',
            // showOtherMonths: true,
            maxDate: '-13y' //The maximum date is 1 year ago
        });
        $("#donationdatepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-m-d',
            maxDate: 0, //The maximum date is 1 today
        });


         $('#governorates').click(function(e) {

            e.preventDefault();

            //empty cities from latest governorate values
            $('#cities').html('<option value="">اختر مدينة</option>');


            //get governorate
            var governorate_id = $(this).val();


            if(governorate_id) {
                //send ajax
                $.ajax({
                    url : '{{url('api/v1/cities?governorate_id=')}}'+governorate_id,
                    type: 'GET',
                    success: function(data) {
                        // console.log(data);

                        if(data.status ==1) {
                            //append cities
                            //console.log(data.data);
                            $.each(data.data.data, function(index, city) {
                                $('#cities').append('<option value="'+city.id+'">'+city.name+'</option>');
                            });
                        }
                       
                    },
                    error: function(jqXHR, textStatus, errorMessage) {
                        alert(errorMessage);
                    }
                });   
            }
            else {
                //empty cities from latest governorate values
                $('#cities').html('<option value="">اختر مدينة</option>');
            }

            





         });



    });



   

    


</script>

@endpush