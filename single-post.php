<?php get_header(); ?>

<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner" style="background: url(<?php the_post_thumbnail_url(); ?>) no-repeat center / cover">
    <div class="overlay dark-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="banner-content content-padding">
                    <h1 class="text-white"><?php the_title(); ?></h1>
                    <p><?php
                        if(has_excerpt()) {
                            the_excerpt(); 
                        } 
                    ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MAIN HEADER AREA END -->

<section class="section blog-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <?php 
                            while (have_posts()) : 
                                the_post();
                                get_template_part('template-parts/content', 'post');
                                the_post_navigation( array(
                                    'prev_text' => '<span class="nav-subtitle">'.esc_html__('Prev:', 'aug24').'</span> <span class="nav-title">%title</span>',
                                    'next_text' => '<span class="nav-subtitle">'.esc_html__('Next:', 'aug24').'</span> <span class="nav-title">%title</span>',
                                ) );
                                if(comments_open() || get_comments_number()) :
                                    comments_template();
                                endif;
                            endwhile;
                        ?>
                    </div>
                </div>
            </div>
            <?php get_sidebar(); ?> 
        </div>
    </div>
</section>

<?php get_footer(); ?>

<?php wp_footer(); ?>