<?php get_header(); ?>

<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
  <div class="overlay dark-overlay"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
        <div class="banner-content content-padding">
          <h1 class="text-white">404</h1>
          <h2 class="banner-title">Такой страницы не существует</h2>
          <?php the_widget("WP_Widget_Search"); ?>
          <a href="/" class="btn btn-white btn-circled">Перейти на главную</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!--MAIN HEADER AREA END -->

<?php get_footer(); ?>

<?php wp_footer(); ?>