<?php
/**
 * Template part for displaying single posts.
 *
 * @package Matt Cass
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
    } ?>
    <header class="entry-header">
            <?php the_title('<h1 itemprop="title" class="entry-title">', '</h1>'); ?>
        <div class="entry-meta">
<?php mattcass_posted_on(); ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->
    <div class="entry-content">
        <?php
        $startPlink = ''; 
        $endPlink = ''; 
        if (get_post_meta($post->ID, 'project_link', true)) {
         $startPlink = '<a target="_blank" href="'.stripslashes(do_shortcode(get_post_meta($post->ID, 'project_link', true))).'">';
         $endPlink = '<span><strong>VIEW PROJECT</strong></span></a>'; 
        }
        if (get_post_meta($post->ID, 'alt_img', true)) {
            echo '<figure class="feature alt">';
            echo $startPlink.'<img src="';
            echo stripslashes(do_shortcode(get_post_meta($post->ID, 'alt_img', true)));
            echo '"/>'.$endPlink.'</figure>';
        }
        else if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
            echo '<figure class="feature">';
            the_post_thumbnail();
            echo '</figure>';
        }
        ?>
        <?php the_content(); ?>
        <?php if (get_post_meta($post->ID, 'project_link', true)) { ?>
        <a target="_blank" class="fbtn" href="
            <?php echo stripslashes(do_shortcode(get_post_meta($post->ID, 'project_link', true))); ?>
           ">VIEW PROJECT</a>
        <?php } ?>
           
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'mattcass'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
<?php mattcass_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->

