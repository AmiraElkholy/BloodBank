@extends('front.layouts.master')


@section('content')

 <div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url(route('home'))}}">الرئيسية</a></li>
                <li class="breadcrumb-item" active aria-current="page">المفضلة</li>
            </ol>
        </nav><!--End Breadcrumb-->
    </div><!--End container-->



  <section class="artice-detailes pb-5">
    <!--Articles section-->
    <section class="articles mb-5">
            <div class="title">
                <div class="container"><br>
                    <h5><span class="py-1">المفضلة <i class="fas fa-heart"></i></span> </h5>
                </div>
            </div>
            <div class="article-slide mt-3">
                <div class="container">
                    <div class="arrow text-left">
                        <button type="button" class="prev-arrow px-2 py-1"><i class="fas fa-chevron-right"></i></button>
                        <button type="button" class="next-arrow px-2 py-1"><i class="fas fa-chevron-left"></i></button>
                    </div>

                    <div class="slick2">
                    	@foreach($favourites as $post)
                        <div class="slick-cont">
                            <div class="card">
                                <img src="{{$post->full_thumbnail_path}}" class="card-img-top" alt="slick-img">
                                <div class="heart-icon" id="{{$post->id}}"><i class="fa-heart {{($post->is_favourite)? 'fas':'far'}}"></i></div>
                                <div class="card-body">
                                    <h5 class="card-title">{{$post->title}}</h5>
                                    <p>{{substrwords($post->body, 400)}}</p>
                                    <br>
                                    <p class="category-name"><span style="font-weight: bold">القسم:</span> <a style="color: #ab0b0e; hover:none;" href="{{url('posts/category/'.$post->category->id)}}">{{$post->category->name}}</a></p><br>
                                    <div class="text-center"><a href="{{url("/posts/$post->id")}}" class="btn bg px-5">التفاصيل</a></div>
                                </div>
                            </div>
                        </div> 
                        @endforeach                  
                    </div>
                </div>
            </div>
            <!--End container-->
        </section>
        <!--End Articles-->
    </section>

@endsection


@push('scripts')

    <script type="text/javascript">
        
        $('.heart-icon').click(function() { 
            var post_id = $(this).attr('id');
            var icon = $(this).find('i');

            console.log(post_id);

            $.ajax({
                url : '{{url(route('toggleFavouritesWeb'))}}',
                type: 'POST',
                data: {
                    _token  : '{{csrf_token()}}',
                    post_id : post_id,
                },
                success: function(data) {
                    console.log(data);

                    if(data.status ==1) {
                        if ($(icon).hasClass('fas')) {
                            $(icon).removeClass('fas').addClass('far');
                        } else {
                            $(icon).removeClass('far').addClass('fas');
                        };
                    }
                   
                },
                error: function(jqXHR, textStatus, errorMessage) {
                    alert(errorMessage);
                }
            });

        });

    </script>

@endpush