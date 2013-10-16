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

<style>
  .hide {
    display: none;
  }

  .style-buttons {
    background-color: black;
    padding: 20px 20px;
  }

</style>

  <div id="primary" class="site-content style-layout">
    <div id="content" role="main">

      <?php while ( have_posts() ) : the_post(); ?>
      
      <div class="divider">
        <h1 class="divider-title">Typography</h1>
        <div class="divider-triangle"></div>
      </div> 

      <section>
        <h1>asdf</h1>
      </section>

      <div class="divider">
        <h1>Buttons</h1>
        <div class="divider-triangle"></div>
      </div>        
      
      <section class="style-buttons">
        <?php include('_buttons.php'); ?>
      </section>

      <?php endwhile; // end of the loop. ?>

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>