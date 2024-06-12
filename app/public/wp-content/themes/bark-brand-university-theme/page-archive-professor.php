<?php

/*
Template Name: Professors
*/

get_header();  
pageBanner(); 
?>
<div class="container container--narrow page-section">
<?php
    $theParent = wp_get_post_parent_id(get_the_ID());
      if ($theParent) { ?>         
        <div class="metabox metabox--position-up metabox--with-home-link">
          <p>
            <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo get_the_title($theParent); ?></a> <span class="metabox__main">
              <?php the_title();?></span>
          </p>
       </div>
     <?php }   
     ?>    

  <?php 

  $titleArray = get_pages(array(
    'child_of' => get_the_ID()
  ));

  if ($theParent or $titleArray) { ?>
      <div class="page-links">
          <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></h2>
          <ul class="min-list">
            <?php 
            if ($theParent) {
              $findChildrenOf = $theParent;    
            }    
            else {
              $findChildrenOf = get_the_ID();
            }        
            wp_list_pages(array(
              'title_li' => NULL,
              'child_of' => $findChildrenOf, 
              'sort_column' => 'menu_order'
            )); 
            ?>
          </ul>
      </div> 
      <?php } 
      
      
    // Add the filter to modify the query arguments to include 'orderby' for 'post_title' ordering
add_filter('posts_orderby', 'custom_posts_orderby', 10, 2);
function custom_posts_orderby($orderby, $query)
{
    global $wpdb;
    if ($query->get('post_type') == 'professor') {
        $orderby = "SUBSTRING_INDEX($wpdb->posts.post_title, ' ', -1) ASC";
    }
    return $orderby;
}

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'professor',
    'posts_per_page' => 10,
    'paged' => $paged,
);
$query = new WP_Query($args);

?>

<?php if ($query->have_posts()) : ?>
    <div class="professor-archive">   
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <!-- Display your post content here -->
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div><?php echo get_field('professor_title'); ?></div>
            <hr>
        <?php endwhile; 
        $total_pages = $query->max_num_pages;
        if ($total_pages > 1) {
            $current_page = max(1, get_query_var('paged'));
            echo paginate_links(array(
                'base' => get_pagenum_link(1) . '%_%',
                'format' => '/page/%#%',
                'current' => $current_page,
                'total' => $total_pages,
                'prev_text' => __('« Previous'),
                'next_text' => __('Next »'),
            ));
        }
        ?>
    </div>
<?php else : ?>
    <p><?php esc_html_e('No professors found.'); ?></p>
<?php endif; ?>

<?php wp_reset_postdata(); ?>

   
</div>

<?php get_footer();