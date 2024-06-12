<?php 
  
  get_header(); 
  pageBanner(array(
    'title' => 'Events',
    'subtitle' => 'Unleash the Fun: Explore BBU\'s Vibrant Campus Events'
  ));
  ?>
<div class="container container--narrow page-section">
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'event',
    'posts_per_page' => 5,
    'paged' => $paged
);
$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        get_template_part('template-parts/content-event');
    }
    ?>
    <div class="pagination">
        <?php
        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $query->max_num_pages,
            'prev_text' => __('« Previous'),
            'next_text' => __('Next »'),
        ));
        ?>
    </div>
    <?php
}
?>
    <hr class="section-break">
    <p>Looking for information about past events? <a href="<?php echo site_url('/past-events') ?>">Check out our events archive.</a></p>

  </div>

<?php 

get_footer();