<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Matt Cass
 */
?>
    
        <?php
        if (!is_front_page()) {
            echo '<header class="entry-header">';
            the_title('<h1 class="entry-title">', '</h1>');
            echo '</header>';
        }
        //endif;
        ?>
    

    <div class="entry-content">
        <?php
        if (get_post_meta($id, 'autop', true)) {
            remove_filter('the_content', 'wpautop');
        }
        ?>
        <?php the_content(); ?>

        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'mattcass'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
<?php edit_post_link(esc_html__('Edit', 'mattcass'), '<span class="edit-link">', '</span>'); ?>
    </footer><!-- .entry-footer -->

