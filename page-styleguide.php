<?php
/**
 * Template Name: StyleGuide
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 */

 get_header(); ?>

<div id="primary" class="site-content style-layout">

  <section id="content" class="page-content--with-sidebar">
    <?php include('components/_typography.php'); ?>
    <?php include('components/_buttons.php'); ?>   
    <?php include('components/_driverr.php'); ?>
  </section><!-- #content -->

  <?php get_sidebar(); ?>

  <section class="page-content">
  
  </section>

</div><!-- #primary -->

<?php get_footer(); ?>