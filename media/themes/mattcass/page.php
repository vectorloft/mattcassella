<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Matt Cass
 */
get_header();
?>
<?php if (get_post_meta($post->ID, 'newsday_lead_content', true)) { ?>
    <?php echo stripslashes(do_shortcode(get_post_meta($post->ID, 'newsday_lead_content', true))); ?>
<?php } ?>
<article id="post-<?php the_ID(); ?>" class="container" >
    <?php
    if (!is_front_page()) {
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
        }
    }
    //endif;
    ?>
    <?php ?>
    <?php while (have_posts()) : the_post(); ?>

        <?php get_template_part('template-parts/content', 'page'); ?>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>

    <?php endwhile; // End of the loop. ?>

</article>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
