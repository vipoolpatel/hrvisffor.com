<div class="section">
    <div class="container"> 
        <!-- title start -->
        <div class="titleTop">

            <h3>{{__('Latest')}} <span>{{__('Blogs')}}</span></h3>
        </div>
        <!-- title end -->
        <ul class="jobslist row">
            @if(null!==($blogs))
            <?php
            $count = 1;
            ?>
            @foreach($blogs as $blog)
            <?php
            $cate_ids = explode(",", $blog->cate_id);
            $data = DB::table('blog_categories')->whereIn('id', $cate_ids)->get();
            $cate_array = array();
            foreach ($data as $cat) {
                $cate_array[] = "<a href='" . url('/blog/category/') . "/" . $cat->slug . "'>$cat->heading</a>";
            }
            ?>
            <li class="col-lg-4">
                <div class="bloginner">
                    <div class="postimg">
                        <img src="{{asset('images/home/woman-in-discussing-a-lesson-plan-3772511.png')}}" class="img-fluid">
                        {{--@if(null!==($blog->image) && $blog->image!="")
                        --}}{{--<img class="lazy" data-src="resize.php?img={{asset('uploads/blogs/'.$blog->image)}}&w=350" alt="{{$blog->heading}}">--}}{{--
                        <img class="lazy" data-src="resize.php?img={{asset('images/home/woman-in-discussing-a-lesson-plan-3772511.png')}}&w=350" alt="{{$blog->heading}}">
                        @else
                        <img class="lazy" data-src="resize.php?img={{asset('images/blog/1.jpg')}}&w=350" alt="{{$blog->heading}}">
                        @endif--}}
                    </div>
                    <div class="blog-post">
                        <div class="post-header">
                            <h4><a href="{{route('blog-detail',$blog->slug)}}">{{$blog->heading}}</a></h4>
                            <div class="postmeta">Category : {!!implode(', ',$cate_array)!!}
                            </div>
                        </div>
                        <p class="p-1">{!! str_limit($blog->content, $limit = 150, $end = '...') !!}</p>
                    </div>
                </div>
            </li>
            <?php $count++; ?>
            @endforeach
            @endif
        </ul>
        <!--view button-->
        <div class="viewallbtn"><a href="{{route('blogs')}}">{{__('View All Blog Posts')}}</a></div>
        <!--view button end--> 
    </div>
</div>