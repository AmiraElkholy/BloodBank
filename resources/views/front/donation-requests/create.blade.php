
@inject('model', 'App\Models\DonationRequest')

@extends('front.layouts.master')



@section('content')
    <div class="container">
            <!--Breadcrumb-->
            <nav class="my-4" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء طلب تبرع جديد</li>
                </ol>
            </nav><!--End Breadcrumb-->
        </div><!--End container-->
        <section class="signup text-center">
            <div class="container">
                
                <div class="py-4 mb-4">

                    @include('_partials.errors')
            
                    @include('flash::message')
                    
                   <form action="{{url(route('clients.donation-requests.store'))}}" method="POST"> 
                    {{csrf_field()}}
                        <div>
                            <input type="text" name="patient_name" class="form-control my-3" placeholder="الاسم" value="{{old('patient_name')}}">
                        </div>
                        <div class="input-group mb-3">
                            <select name="blood_type_id" class="custom-select">
                                <option disabled selected style="color:#495057 !important;" value="">فصيلة الدم</option>
                                @foreach($blood__types as $blood_type)
                                    <option value="{{$blood_type->id}}">{{$blood_type->name}}</option>
                                @endforeach
                            </select>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                         <div>
                            <input type="text" name="patient_age" class="form-control my-3" placeholder="العمر" value="{{old('patient_age')}}">
                        </div>
                        <div>
                            <input type="number" name="number_of_bags" class="form-control my-3" placeholder="عدد الأكياس المطلوبة" value="{{old('naumber_of_bags')}}">
                        </div>
                        <div>
                            <input type="text" name="hospital_name" class="form-control my-3" placeholder="المستشفى" value="{{old('hospital_name')}}">
                        </div>
                        <div>
                            <input type="text" name="hospital_address" class="form-control my-3" placeholder="عنوان المستشفى" value="{{old('hospital_address')}}">
                        </div>
                        <div>
                            <input type="text" name="patient_phone" class="form-control my-3" placeholder="رقم الجوال" value="{{old('patient_phone')}}">
                        </div>
                        <div class="input-group">
                            {!! Form::select('city_id', $cities->pluck('name','id')->toArray(), null, [
                                'placeholder' => 'اختر مدينة',
                                'class' => 'custom-select',
                                'id'    => 'cities'
                            ]) !!}
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div>
                            <textarea name="notes" class="form-control my-3" placeholder="الملاحظات" value="{{old('notes')}}"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success py-2 w-50">ارسال</button>

                        </form>
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
    });
</script>

@endpush