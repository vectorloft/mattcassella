<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Matt Cass
 */
?>
<div class="tweets revealOnScroll" data-animation="fadeInLeft">
                <div class="container">
                    <a class="tprof" href="https://twitter.com/mattcassella"><i class="fa fa-twitter"></i></a>
                        <?php echo do_shortcode("[tweets max=1]"); ?>
                    <a href="#" class="close mc-x"></a>
                </div>
            </div>
<footer class="colpholon" role="contentinfo">
    <div class="container">
        <a target="_blank" href="https://www.linkedin.com/in/mattcassella" class="fa fa-linkedin"></a>
        <a target="_blank" href="https://twitter.com/mattcassella" class="fa fa-twitter"></a>
        <a target="_blank" href="https://www.facebook.com/matthew.cassella" class="fa fa-facebook"></a>
    </div>
</footer>
</div><!-- #page -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-1968464-37', 'auto');
  ga('send', 'pageview');

</script>
<?php wp_footer(); ?>

</body>
</html>
