 <!--  SERVICE PARTNER START  -->
 <section id="service-head" class="<?php echo $args['class']; ?>">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-sm-12 m-auto">
        <div class="heading text-white text-center">
          <h4 class="section-title text-white"><?php echo $args['custom-title']; ?></h4>
      <p>
        Это означает, что мы сможем выполнить любую цифровую задачу: <br />
        видео, маркетинг, реклама, разработка или дизайн.
      </p>
        </div>
      </div>
    </div>
  </div>
</section>
<!--  SERVICE PARTNER END  -->
<!--  SERVICE AREA START  -->
<section id="service">
  <div class="container">
    <div class="row">

    <?php
      global $post;

      $query = new WP_Query( [
        'posts_per_page' => 6,
        'post_type'      => 'service',
      ] );

      if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
          $query->the_post();
          ?>
          <div class="col-lg-4 col-sm-6 col-md-6">
            <div class="service-box">
              <div class="service-img-icon">
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="service-icon" class="img-fluid" />
              </div>
              <div class="service-inner">
                <h4><?php the_title(); ?></h4>
                <p><?php the_content(); ?></p>
              </div>
            </div>
          </div>
          <?php
        }
      } else {
        ?>
        <p>Услуг не найдено</p>
        <?php
      }

      wp_reset_postdata(); // Сбрасываем $post
    ?>
    </div>
  </div>
</section>
<!--  SERVICE AREA END  -->