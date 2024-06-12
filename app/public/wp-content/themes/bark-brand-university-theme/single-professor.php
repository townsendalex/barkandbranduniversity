<?php
get_header();

    while(have_posts()) {
        the_post(); 
        pageBanner();
    ?> 

<div class="container container--narrow page-section">
    
    <div class="generic-content">
                
          <div class="prof-image">
            <?php the_post_thumbnail('professorPortrait'); ?>
          </div>          
            <?php 
              $likeCount = new WP_Query(array(
                'post_type' => 'like',
                'meta_query' => array(
                  array (
                    'key' => 'liked_professor_id',
                    'compare' => '=',
                    'value' =>  get_the_id()
                  )
                )
                  ));
              $existsStatus = 'no';
              if(is_user_logged_in()) {
                $existsQuery = new WP_Query(array(
                  'author' => get_current_user_id(),
                  'post_type' => 'like',
                  'meta_query' => array(
                    array (
                      'key' => 'liked_professor_id',
                      'compare' => '=',
                      'value' =>  get_the_id()
                    )
                  )
                ));
                  if($existsQuery->found_posts) {
                    $existsStatus = 'yes';
                  }
              }
              
            ?>
            <span class="like-box" data-like="<?php if (isset($existsQuery->posts[0]->ID)) echo $existsQuery->posts[0]->ID; ?>" data-professor="<?php the_ID(); ?>" data-exists="<?php echo $existsStatus; ?>">
              <i class="fa fa-heart-o" aria-hidden="true"></i>
              <i class="fa fa-heart" aria-hidden="true"></i>
              <span class="like-count"><?php echo $likeCount->found_posts; ?></span>
            </span>
            <?php the_content(); ?>          

    </div> 
 
        <?php
          $relatedPrograms = get_field('related_programs');
          if ($relatedPrograms) {
            echo '<hr class="section-break">';
            echo '<h4 class="headline headline--medium-small">Subject(s) taught:</h4>';
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

