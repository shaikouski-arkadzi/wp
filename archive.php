<?php get_header(); ?>

<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
  <div class="overlay dark-overlay"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
        <div class="banner-content content-padding">
          <h1 class="text-white">
            <?php
              if(is_category()) {
                echo get_queried_object()->name;
              }
              if(is_tag()) {
                echo get_queried_object()->name;
              }
              if(is_date()) {
                echo get_the_date('j F Y');
              }
              if(is_author()) {
                echo get_the_author_meta('display_name');
              }
            ?>
          </h1>
          <p>Полезные статьи про маркетинг и диджитал</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!--MAIN HEADER AREA END -->

<section class="section blog-wrap ">
    <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
              <?php 
              $index = 0;
              if ( have_posts() ) : while ( have_posts() ) : the_post();
                $index++;
                switch($index) {
                  case "3": ?>
                    <div class="col-lg-12">
                      <div class="blog-post">
                        <?php
                          if( has_post_thumbnail() ) {
                            the_post_thumbnail('post-thumbnail', array('class' => "img-fluid w-100"));
                          }
                          else {
                            echo '<img class="img-fluid w-100" src="'.get_template_directory_uri().'/images/blog/blog-1.jpg" />';
                          }
                        ?>
                        <div class="mt-4 mb-3 d-flex">
                          <div class="post-author mr-3">
                            <i class="fa fa-user"></i>
                            <span class="h6 text-uppercase"><?php the_author(); ?></span>
                          </div>

                          <div class="post-info">
                            <i class="fa fa-calendar-check"></i>
                            <span><?php the_time('j F Y'); ?></span>
                          </div>
                        </div>
                        <a href="<?php echo get_the_permalink(); ?>" class="h4 "><?php the_title(); ?></a>
                        <p class="mt-3"><?php the_excerpt(); ?></p>
                        <a href="<?php echo get_the_permalink(); ?>" class="read-more">
                          Читать статью <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </div>
                  <?php
                    break;
                    default: ?>
                      <div class="col-lg-6">
                        <div class="blog-post">
                          <?php
                            if( has_post_thumbnail() ) {
                              the_post_thumbnail('post-thumbnail', array('class' => "img-fluid"));
                            }
                            else {
                              echo '<img class="img-fluid" src="'.get_template_directory_uri().'/images/blog/blog-1.jpg" />';
                            }
                          ?>
                          <div class="mt-4 mb-3 d-flex">
                            <div class="post-author mr-3">
                              <i class="fa fa-user"></i>
                              <span class="h6 text-uppercase"><?php the_author(); ?></span>
                            </div>

                            <div class="post-info">
                              <i class="fa fa-calendar-check"></i>
                              <span><?php the_time('j F Y'); ?></span>
                            </div>
                          </div>
                          <a href="<?php echo get_the_permalink(); ?>" class="h4 "><?php the_title(); ?></a>
                          <p class="mt-3"><?php the_excerpt(); ?></p>
                          <a href="<?php echo get_the_permalink(); ?>" class="read-more">
                            Читать статью <i class="fa fa-angle-right"></i>
                          </a>
                        </div>
                      </div>
                  <?php
                  break;
                } endwhile; else : ?>
                  <p>Записей нет.</p>
                <?php endif; ?>
                <?php the_posts_pagination(array(
                  'show_all'     => false, // показаны все страницы участвующие в пагинации
                  'end_size'     => 1,     // количество страниц на концах
                  'mid_size'     => 1,     // количество страниц вокруг текущей
                  'prev_next'    => true,  // выводить ли боковые ссылки "предыдущая/следующая страница".
                  'prev_text'    => __('<span class="p-2">« Previous</span>'),
                  'next_text'    => __('<span class="p-2">Next »</span>'),
                  'add_args'     => false, // Массив аргументов (переменных запроса), которые нужно добавить к ссылкам.
                  'add_fragment' => '',     // Текст который добавиться ко всем ссылкам.
                  'screen_reader_text' => __( 'Posts navigation' ),
                  'class'        => 'pagination', // CSS класс, добавлено в 5.5.0.
                  'before_page_number' => '<span class="p-2">',
                  'after_page_number' => '</span>',
                )); ?>
              </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>

<?php wp_footer(); ?>