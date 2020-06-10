@extends('front.layouts.master')


@section('page_title')
المقالات
@endsection



@section('content')


 <div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url(route('home'))}}">الرئيسيه</a></li>
                <li class="breadcrumb-item"><a href="{{url('/posts')}}">المقالات</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
            </ol>
        </nav><!--End Breadcrumb-->
    </div><!--End container-->
    <section class="artice-detailes pb-5">
        <div class="container">
            <div class="article-img m-auto">
                <img src="{{$post->full_thumbnail_path}}" class="card-img-top" alt="article-img">
            </div>
            <div class="article-content my-4">
                <div class="article-header p-2 d-flex justify-content-between">
                    <h6>{{$post->title}}</h6>
                    <a href="" id="heart-icon"><i class="fa-heart {{($post->is_favourite)? 'fas':'far'}}" id="{{$post->id}}"></i></a>
                </div>
                <div class="article-details p-4">
                    <p class="my-md-4">{{$post->body}}</p>
                </div>
            </div>
        </div>
    </section>
    <?php $relatedPosts = $post->category->posts->except($post->id)->take(6);    ?>
    


    @if($relatedPosts->count())
    <!--Articles section-->
    <section class="articles mb-5">
            <div class="title">
                <div class="container">
                    <h5><span class="py-1">مقالات ذات صلة</span> </h5>
                </div>
            </div>
            <div class="article-slide mt-3">
                <div class="container">
                    <div class="arrow text-left">
                        <button type="button" class="prev-arrow px-2 py-1"><i class="fas fa-chevron-right"></i></button>
                        <button type="button" class="next-arrow px-2 py-1"><i class="fas fa-chevron-left"></i></button>
                    </div>

                    <div class="slick2">
                    	@foreach($relatedPosts as $relatedPost)
                    	@if($relatedPost->is_published)
                        <div class="slick-cont">
                            <div class="card">
                                <img src="{{$relatedPost->full_thumbnail_path}}" class="card-img-top" alt="slick-img">
                                <div class="heart-icon" id="{{$relatedPost->id}}"><i class="fa-heart {{($relatedPost->is_favourite)? 'fas':'far'}}"></i></div>
                                <div class="card-body">
                                    <h5 class="card-title">{{$relatedPost->title}}</h5>
                                    <p>{{substrwords($relatedPost->body, 150)}}</p>
                                    <div class="text-center"><a href="{{url("/posts/$relatedPost->id")}}" class="btn bg px-5">التفاصيل</a></div>
                                </div>
                            </div>
                        </div> 
                        @endif
                        @endforeach                  
                    </div>
                </div>
            </div>
            <!--End container-->
        </section>
        <!--End Articles-->
        @endif

@endsection


@push('scripts')

    <script type="text/javascript">
        
        $('#heart-icon').click(function(e) {

        	e.preventDefault();

            var icon = $(this).find('i');
            var post_id = icon.attr('id');

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