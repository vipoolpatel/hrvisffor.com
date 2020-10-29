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

                <h3 class="latest-news-title"><a href="#"><?php echo e(__('Latest')); ?> <span><?php echo e(__('News')); ?></span></a></h3>
            </div>
            </div>
        </div>
        <div class="row">
            <?php if(null!==($latest_blogs)): ?>
                <?php
                $count = 1;
                ?>
                <?php $__currentLoopData = $latest_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            <img src="<?php echo e(asset('images/home/group-of-people-standing-inside-room-2608517.png')); ?>" class="news-img">
                        </div>
                        <div class="col-md-7 px-3">
                            <div class="card-block latest-news px-3">
                                <h4 class="card-title"><?php echo e($blog->heading); ?></h4>
                                <div class="card-text"><?php echo str_limit($blog->content, $limit = 80, $end = '...'); ?> </div>
                                <a href="<?php echo e(route('blog-detail',$blog->slug)); ?>" class="btn latest-news-btn btn-sm">Read More</a>
                                <div class="text-right float-right py-1"><small><i class="fa fa-calendar"></i> Last updated on <?php echo e(date('Y-m-d',strtotime($blog->updated_at))); ?></small></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
                        <?php $count++; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            
        </div>

    </div>
</section>
