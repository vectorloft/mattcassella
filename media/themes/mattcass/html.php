<?php
/*
  Template Name: HTML
  Template Name Posts: HTML
 */
get_header();
?>
<main id="main" role="main">
    <?php if (get_post_meta($post->ID, 'newsday_lead_content', true)) { ?>
                    <?php echo stripslashes(do_shortcode(get_post_meta($post->ID, 'newsday_lead_content', true))); ?>
                <?php } ?>
    <article id="post-<?php the_ID(); ?>" class="container" >

        <header class="entryHead">
            <?php 
         if (get_post_meta($id, 'hide_h1', true)) 
            { echo ''; }
         else 
            { ?>
           <?php //include_once( 'inc/simpleshare.php' ); ?>
           <h1 itemprop="name"><?php the_title(); ?></h1>
          <?php if (get_post_meta($post->ID, 'newsday_custom_byline', true)) { ?>
         <div class="entry-meta byline">
            <?php echo stripslashes(do_shortcode(get_post_meta($post->ID, 'newsday_custom_byline', true))); ?>
         </div>
      <?php } else { ?>
         <div class="entry-meta byline">
            Published: <?php the_time('l, F jS, Y') ?> By: <?php the_author(); ?>
         </div>
      <?php } ?>
           <?php } ?>
            
        </header>

        <div class="content">
            <?php remove_filter('the_content', 'wpautop'); ?>
            <?php the_content(); ?>
        </div><!-- .entry-content -->

    </article><!-- #post-## -->

</main><!-- #main -->
<?php get_footer(); ?>