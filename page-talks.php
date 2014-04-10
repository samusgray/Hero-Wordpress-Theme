<?php
/**
 * The template for displaying all talks.
 *
 */
get_header(); ?>

  <?php wp_reset_query(); wp_reset_postdata();
    $talks = array(
       'post_type'      => 'ck_talks',
    );
    $talk_query = new WP_Query($talks);       
  ?>

  <div id="primary" class="site-content">
    <div id="content" role="main">  
    <?php while($talk_query->have_posts()) : $talk_query->the_post();   ?>
        <?php get_template_part( 'content', 'event' ); ?>
    <?php endwhile;  wp_reset_query(); wp_reset_postdata(); ?>
    </div>
  </div>

<?php get_footer(); ?>
