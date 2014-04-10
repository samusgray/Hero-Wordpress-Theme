<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 */

get_header(); ?>

  <div id="primary" class="site-content">
    <div id="content" role="main">

      <?php while ( have_posts() ) : the_post(); ?>
        <?php include('components/home-hero/_home-hero.php'); ?>
        <?php include('components/home-blurb/_home-blurb.php'); ?>
        <?php include('components/featured-talks/_featured-talks.php'); ?>
        <?php include('components/featured-articles/_featured-articles.php'); ?>
      <?php endwhile; // end of the loop. ?>

    </div><!-- #content -->
  </div><!-- #primary -->
  
<?php get_footer(); ?>