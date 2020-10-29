<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/12/2020
 * Time: 12:58 PM
 */

?>
<section class="news-area">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-12">
            <div class="titleTop text-center">

                <h3 class="latest-news-title"><a href="#">{{__('Latest')}} <span>{{__('News')}}</span></a></h3>
            </div>
            </div>
        </div>
        <div class="row">
            @if(null!==($latest_blogs))
                <?php
                $count = 1;
                ?>
                @foreach($latest_blogs as $blog)
                    <?php
                    $cate_ids = explode(",", $blog->cate_id);
                    $data = DB::table('blog_categories')->whereIn('id', $cate_ids)->get();
                    $cate_array = array();
                    foreach ($data as $cat) {
                        $cate_array[] = "<a href='" . url('/blog/category/') . "/" . $cat->slug . "'>$cat->heading</a>";
                    }
                    ?>
            <div class="col-md-6 py-3">
                <div class="card news-card">
                    <div class="row">

                        <div class="col-md-5 pr-0">
                            <img src="{{ asset('images/home/group-of-people-standing-inside-room-2608517.png') }}" class="news-img">
                        </div>
                        <div class="col-md-7 px-3">
                            <div class="card-block latest-news px-3">
                                <h4 class="card-title">{{$blog->heading}}</h4>
                                <div class="card-text">{!! str_limit($blog->content, $limit = 80, $end = '...') !!} </div>
                                <a href="{{route('blog-detail',$blog->slug)}}" class="btn latest-news-btn btn-sm">Read More</a>
                                <div class="text-right float-right py-1"><small><i class="fa fa-calendar"></i> Last updated on {{ date('Y-m-d',strtotime($blog->updated_at)) }}</small></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
                        <?php $count++; ?>
                    @endforeach
            @endif
            {{--<div class="col-md-6 py-3">
                <div class="card news-card">
                    <div class="row">

                        <div class="col-md-5 pr-0">
                            <img src="{{ asset('images/home/man-beside-flat-screen-television-with-photos-background-716276.png') }}" class="news-img">
                        </div>
                        <div class="col-md-7 px-3">
                            <div class="card-block latest-news px-3">
                                <h4 class="card-title">Training for offering
                                    Mindfulness online</h4>
                                <p class="card-text">Lorem ipsum, or lipsum as it is sometimes known, is to
                                    an unknown typesetter in the 15th century.</p>
                                <a href="#" class="btn latest-news-btn btn-sm">Read More</a>
                                <div class="text-right float-right py-1"><small><i class="fa fa-calendar"></i> Last updated on 2019-10-22</small></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 py-3">
                <div class="card news-card">
                    <div class="row">

                        <div class="col-md-5 pr-0">
                            <img src="{{ asset('images/home/women-in-black-top-and-black-leggings-stretching-3900796@2x.png') }}" class="news-img">
                        </div>
                        <div class="col-md-7 px-3">
                            <div class="card-block latest-news px-3">
                                <h4 class="card-title">Training for offering
                                    Mindfulness online</h4>
                                <p class="card-text">Lorem ipsum, or lipsum as it is sometimes known, is to
                                    an unknown typesetter in the 15th century.</p>
                                <a href="#" class="btn latest-news-btn btn-sm">Read More</a>
                                <div class="text-right float-right py-1"><small><i class="fa fa-calendar"></i> Last updated on 2019-10-22</small></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 py-3">

                <div class="card news-card">
                    <div class="row ">

                        <div class="col-md-5 pr-0">
                            <img src="{{ asset('images/home/people-having-meeting-inside-conference-room-1181395.png') }}" class="news-img" >
                        </div>
                        <div class="col-md-7 px-3">
                            <div class="card-block latest-news px-3">
                                <h4 class="card-title">Training for offering
                                    Mindfulness online</h4>
                                <p class="card-text">Lorem ipsum, or lipsum as it is sometimes known, is to
                                    an unknown typesetter in the 15th century.</p>
                                <a href="#" class="btn latest-news-btn btn-sm">Read More</a>
                                <div class="text-right float-right py-1"><small><i class="fa fa-calendar"></i> Last updated on 2019-10-22</small></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>--}}
        </div>

    </div>
</section>
