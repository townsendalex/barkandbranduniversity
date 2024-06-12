<?php 
  get_header();

    while(have_posts()) {
        the_post(); 
        pageBanner();
    ?>
   
    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
          <p>
            <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Events Home</a>
            <span class="metabox__main"><?php the_title(); ?></span>
          </p>
    </div>
    <?php
      $eventDate = get_field('event_date');
      $eventDate = DateTime::createFromFormat('Ymd', $eventDate);

      $startTime = get_field('event_start_time');
      $endTime = get_field('event_end_time');

      // Check if start time is empty
      if ($startTime !== false && !empty($startTime)) {
          $formattedStartTime = $startTime;
      } else {
          $formattedStartTime = 'N/A'; 
      }

      // Check if end time is empty
      if ($endTime !== false && !empty($endTime)) {
          $formattedEndTime = $endTime;
          } else {
          $formattedEndTime = 'N/A'; 
          }
      ?>
      <div><h5 class="headline headline--medium-small"><?php echo $eventDate->format('F j, Y'); ?> - <?php echo $formattedStartTime; ?> - <?php echo $formattedEndTime; ?></h5></div>

      <?php 
        $campusId = get_field('event_campus');
        $campusId = $campusId[0];
        $campusName = get_field('campus_name', $campusId);

        $eventLocation = get_field('event_location');
        ?>
        <div><h5 class="headline headline--small-plus"><?php echo $eventLocation?> - <?php echo $campusName ?></h5></div>

        <div class="generic-content"><?php the_content(); ?></div>

      <?php
        $relatedPrograms = get_field('related_programs');
        if ($relatedPrograms) {
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium-small">Sponsoring Program(s):</h2>';
        echo '<ul class="link-list min-list">';
        foreach ($relatedPrograms as $program) { ?>
          <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>              
          <?php 
        }
        echo '</ul>';
      }
      ?>

    </div>
    <?php }

    get_footer();
