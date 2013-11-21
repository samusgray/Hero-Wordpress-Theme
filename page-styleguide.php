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

    <?php include('components/_divider.php'); ?>

  <section id="content" class="page-content--with-sidebar">
    <section class="style-item">
      <?php include('components/_typography.php'); ?>
    </section>
    <section class="style-item">
      <?php include('components/_featured-image.php'); ?>
    </section>    
    <section class="style-item">
      <?php include('components/_text.php'); ?>
    </section>    
    <section class="style-item">
      <?php include('components/_blog-single-header.php'); ?>
    </section>    
    <section class="style-item">
      <?php include('components/_testimonial.php'); ?>
    </section>    
    <section class="style-item">
      <?php include('components/_map.php'); ?>
    </section>
  </section><!-- #content -->

  <aside class="sidebar">
    <section class="style-item">
      <?php include('components/_buttons.php'); ?>   
    </section>
    <section class="style-item">
      <?php include('components/_drivers.php'); ?>
    </section>    
    <section class="style-item">    
      <?php include('components/_testimonial--small.php'); ?>
    </section>
    <section class="style-item">      
      <?php include('components/_form-small.php'); ?>
    </section>
  </aside>

<section class="page-content">
  <?php include('components/_staff.php'); ?>
  <?php include("components/_hero.php"); ?>
  <?php include("components/_accordion.php"); ?>
</section>

</div><!-- #primary -->

<?php get_footer(); ?>