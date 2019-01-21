<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Retina_Blog
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <?php $retina_blog_footer_widgets_number = retina_blog_get_option('number_of_footer_widget');
    if (1 == $retina_blog_footer_widgets_number) {
        $col = 'col-full';
    } elseif (2 == $retina_blog_footer_widgets_number) {
        $col = 'col-half';
    } elseif (3 == $retina_blog_footer_widgets_number) {
        $col = 'col-three';
    } elseif (4 == $retina_blog_footer_widgets_number) {
        $col = 'col-four';
    } else {
        $col = 'col-three';
    }
    if (is_active_sidebar('footer-col-one') || is_active_sidebar('footer-col-two') || is_active_sidebar('footer-col-three') || is_active_sidebar('footer-col-four')) { ?>
        <div class="footer-divider">
            <div class="wrapper">
                <hr>
            </div>
        </div>

        <div class="footer-widget-area">
            <div class="wrapper">
                <div class="col-row">
                    <?php if (is_active_sidebar('footer-col-one') && $retina_blog_footer_widgets_number > 0) : ?>
                        <div class="col <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-one'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-two') && $retina_blog_footer_widgets_number > 1) : ?>
                        <div class="col <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-two'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-three') && $retina_blog_footer_widgets_number > 2) : ?>
                        <div class="col <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-three'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-four') && $retina_blog_footer_widgets_number > 3) : ?>
                        <div class="col <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-four'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="footer-divider">
            <div class="wrapper">
                <hr>
            </div>
        </div>
    <?php } ?>
    <div class="site-info">
        <div class="wrapper">
            <?php
                $retina_blog_copyright_text = wp_kses_post(retina_blog_get_option('copyright_text'));
                if (!empty ($retina_blog_copyright_text)) {
                    echo wp_kses_post(retina_blog_get_option('copyright_text'));
                }
            ?>
            <span class="sep"> | </span>
            <span>Norrbackavägen 5 23391 Svedala | 0723333780 | marionabaudach@hotmail.com </span>
           
        </div><!-- .site-info -->
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->
<a id="scroll-up">
    <span>
        <strong><?php esc_html_e('Back To Top', 'retina-blog'); ?></strong> <i class="icon-arrow-right-circle icons"></i>
    </span>
</a>

<?php wp_footer(); ?>

</body>
</html>
