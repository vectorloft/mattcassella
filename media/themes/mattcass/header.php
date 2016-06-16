<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Matt Cass
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_directory'); ?>/img/icons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('template_directory'); ?>/img/icons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/img/icons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_directory'); ?>/img/icons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/img/icons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_directory'); ?>/img/icons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_directory'); ?>/img/icons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_directory'); ?>/img/icons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory'); ?>/img/icons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php bloginfo('template_directory'); ?>/img/icons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_directory'); ?>/img/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php bloginfo('template_directory'); ?>/img/icons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_directory'); ?>/img/icons/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <link href='https://fonts.googleapis.com/css?family=Lato:400,300|Oswald:400,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="https://file.myfontastic.com/QgJ7JV4JLgoHRnxmn9v8be/icons.css" rel="stylesheet">
        <link rel="stylesheet" href="http://www.mattcassella.com/media/themes/mattcass/css/mc.min.css">
        <script src="http://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.7.2.js"></script>
        <?php wp_head(); ?>
        <!-- Hotjar Tracking Code for http://mattcassella.com -->
        <script>
            (function(h, o, t, j, a, r) {
                h.hj = h.hj || function() {
                    (h.hj.q = h.hj.q || []).push(arguments)
                };
                h._hjSettings = {hjid: 217222, hjsv: 5};
                a = o.getElementsByTagName('head')[0];
                r = o.createElement('script');
                r.async = 1;
                r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
                a.appendChild(r);
            })(window, document, '//static.hotjar.com/c/hotjar-', '.js?sv=');
        </script>
    </head>

    <body <?php body_class(); ?>>
        <nav id="navi" role="navigation" class="animated">
            <img src="<?php bloginfo('template_directory'); ?>/img/icons/apple-icon.png" alt="Matthew Cassella UX" width="192" height="192"/>
            <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu')); ?>
        </nav><!-- #site-navigation -->
        <a href="#" class="ntrig"><span></span></a>
        <div id="page" class="hfeed site">
            <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'mattcass'); ?></a>

            <header id="masthead"role="banner">
                <div class="cover"></div>
                <?php if (is_front_page()) : ?>
                    <h1 itemprop="name">MATTHEW <span>CASSELLA</span> <strong>UX ARCHITECT</strong></h1>
                <?php else : ?>
                    <a class="h1" href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?>
                        <?php if (get_post_meta($post->ID, 'subhead', true)) { ?>
                            <?php echo '<strong>' . stripslashes(do_shortcode(get_post_meta($post->ID, 'subhead', true))) . '</strong>'; ?>
                            <?php
                        } else {
                            echo '<strong>UX ARCHITECT</strong>';
                        }
                        ?>
                    </a>
                <?php endif ?>

            </header><!-- #masthead -->