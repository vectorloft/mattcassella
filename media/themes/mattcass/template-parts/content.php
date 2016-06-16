<?php
/**
 * Template part for displaying posts.
 *
 * @package Matt Cass
 */
?>

<section>
    <a href="<?php echo get_permalink(); ?>">
        <?php
        //the_title(sprintf('<h2 ><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
        ?>
        <?php if ('post' == get_post_type()) : ?>
            <?php
            if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
                the_post_thumbnail();
            }
            ?>
            <div class="op">
                <?php the_title('<h2>', '</h2>'); ?>
                <span><?php //the_tags(''); ?></span>
            </div>
        <?php endif; ?>
    </a>
</section><!-- .entry-header -->

