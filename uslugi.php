<?php
/*
Template Name: Шаблон для страницы Услуги
Template Post Type: page
*/
?>

<!--MAIN BANNER AREA START -->
<?php get_header(); ?>

<div class="page-banner-area page-service" id="page-banner">
  <div class="overlay dark-overlay"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
        <div class="banner-content content-padding">
          <h1 class="text-white"><?php the_title(); ?></h1>
          <p>Мы оказываем весь спект диджитал услуг</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!--MAIN HEADER AREA END -->

<?php the_content(); ?>

    <!--  SERVICE BLOCK2 START  -->
    <section id="service-2" class="section-padding">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6">
            <div class="service-box-2">
              <span>01</span>
              <h4>Лучшие <br />аудит и аналитика</h4>
              <p>
                Мы изучаем крупные бренды и мелкие стартапы, чтобы суметь выстроить наиболее подходящую стратегию.
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="service-box-2">
              <span>02</span>
              <h4>Глубокое <br />понимание SEO</h4>
              <p>
                Мы знаем алгоритмы поисковых сайтов. Понимаем, какие действия ведут к лучшим результатам на рынке.
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="service-box-2">
              <span>03</span>
              <h4>Современная <br />работа с ядром</h4>
              <p>
                Мы собираем ядро сайта из ключевых слов, собирая данные со всех сайтов по вашей тематике. 
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--  SERVICE BLOCK2 END  -->

    <!--  SERVICE AREA START  -->
    <section class="section pt-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5 col-sm-12 col-md-6 mb-4">
            <img src="images/bg/2-min.jpg" alt="feature bg" class="img-fluid" />
          </div>

          <div class="col-lg-7 pl-4">
            <div class="mb-5">
              <h3 class="mb-4">Мы создаем эффективный <br />дизайн сайтов</h3>
              <p>
                Все наши проекты создаются креативными веб-дизайнерами, соблюдая все современнные тенденции в этой сфере. Лучшие специалисты будут создавать продукт для вас. 
              </p>
            </div>

            <ul class="about-list">
              <li>
                <h5 class="mb-2"><i class="icofont icofont-check-circled"></i>Адаптивные сайты</h5>
                <p>Сайты хорошо смотрятся на смартфонах.</p>
              </li>

              <li>
                <h5 class="mb-2"><i class="icofont icofont-check-circled"> </i> Фреймворки</h5>
                <p>В работе используются React, Bootstrap и др.</p>
              </li>

              <li>
                <h5 class="mb-2"><i class="icofont icofont-check-circled"> </i>Кроссбраузерно</h5>
                <p>Смотреться сайт будет одинаково хорошо во всех браузерах.</p>
              </li>
              <li>
                <h5 class="mb-2"><i class="icofont icofont-check-circled"> </i>Retina Friendly</h5>
                <p>Сайт создаются так, чтобы вся графика выглядела красиво на устройствах с Retina дисплеями.</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!--  SERVICE AREA END  -->

<?php echo get_template_part('template-parts/content', 'service', ['class' => 'service-style-two', 'custom-title' => 'Диджитал полного цикла']); ?>

<!--  PARTNER START  -->
<section class="section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 text-center text-lg-left">
        <div class="mb-5">
          <h3 class="mb-2">Эти компании доверяют нам</h3>
          <p>Компании, с которыми мы работаем давно</p>
        </div>
      </div>
    </div>
    <div class="row">

      <?php
        global $post;

        $query = new WP_Query( [
          'posts_per_page' => 4,
          'post_type'      => 'partners',
        ] );

        if ( $query->have_posts() ) {
          while ( $query->have_posts() ) {
            $query->the_post();
            ?>
            <div class="col-lg-3 col-sm-6 col-md-3 text-center">
              <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="partner" class="img-fluid" />
            </div>
            <?php
          }
        } else {
          ?>
          <p>Партнеров не найдено</p>
          <?php
        }

        wp_reset_postdata(); // Сбрасываем $post
      ?>
    </div>
  </div>
</section>
<!--  PARTNER END  -->

<?php get_footer(); ?>