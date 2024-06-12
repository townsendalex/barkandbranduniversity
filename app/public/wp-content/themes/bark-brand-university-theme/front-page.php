<?php 
    get_header(); 
    ?>

    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/Bark_&_Brand_University_Students.jpg') ?>)"></div>
        <div class="page-banner__content container t-center c-white ">
          <h1 class="headline headline--large headline--bold">Welcome!</h1>
          <h2 class="headline headline--medium headline--x-bold">We think you&rsquo;ll dig it here.</h2>
          <a href="<?php echo get_post_type_archive_link('program') ?>" class="btn btn--large btn--blue">Find Your Major</a>
        </div>
    </div>

    <div class="full-width-split group">
      <div class="full-width-split__one">
        <div class="full-width-split__inner">
          <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>

          <?php
            $today = date('Ymd');
            $homepageEvents = new WP_Query(array(
              'posts_per_page' => 2,
              'post_type' => 'event',
              'meta_key' => 'event_date',
              'orderby' => 'meta_value_num',
              'order' => 'ASC',
              'meta_query' => array(
                array(
                  'key' => 'event_date',
                  'compare' => '>=',
                  'value' => $today,
                  'type' => 'numeric'
                )
              )
            ));

            while ($homepageEvents->have_posts()) {
              $homepageEvents->the_post(); 
              get_template_part('template-parts/content', 'event');
            }
          ?>          
         
          <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn--blue">View All Events</a></p>
        </div>
      </div>

      <div class="full-width-split__two">
        <div class="full-width-split__inner">
          <h2 class="headline headline--small-plus t-center">From Our Blog</h2>

            <?php 
            $homepagePosts = new WP_Query(array(
              'posts_per_page' => 2
            ));

            while ($homepagePosts->have_posts()) {
              $homepagePosts->the_post(); ?>
              <div class="event-summary">
            <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
              <span class="event-summary__month"><?php the_time('M'); ?></span>
              <span class="event-summary__day"><?php the_time('d'); ?></span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
              <p><?php if (has_excerpt()) {
                  echo get_the_excerpt();
              } else {
                 echo wp_trim_words(get_the_content(), 18);
              }              
              ?>
              <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
            </div>
          </div>
              <?php
            } wp_reset_postdata();
            ?>    

          <p class="t-center no-margin"><a href="<?php echo site_url('/blog'); ?>" class="btn btn--yellow">View All Blog Posts</a></p>
        </div>
      </div>
    </div>

    <div class="hero-slider">
      <div data-glide-el="track" class="glide__track">
        <div class="glide__slides">
          <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/BBU-Bus.jpg') ?>)">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">Free Transportation</h2>
                <p class="t-center hero-slider__text">Our students enjoy free unlimited bus fare.</p>
                <p class="t-center no-margin"><a href="./transportation/" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/dentistry.jpg') ?>)">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">A Carrot A Day</h2>
                <p class="t-center hero-slider__text">BBU dentistry recommendations for oral health.</p>
                <p class="t-center no-margin"><a href="./health/the-crunch-factor-raw-bones-and-vegetables-for-canine-dental-health/" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/food.jpg') ?>)">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">Free Food</h2>
                <p class="t-center hero-slider__text">BBU offers lunch plans for students in need.</p>
                <p class="t-center no-margin"><a href="./nourish-flourish-food-program/" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
      </div>
    </div>

    <?php 
    
    get_footer();

