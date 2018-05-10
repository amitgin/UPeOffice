<?php
/* options css */
?>



<?php
if( get_theme_option('body_font') == 'Choose a font' || get_theme_option('body_font') == '') { ?>
body {  font-family: PT Sans, arial, sans-serif !important; }
<?php } else { ?>
body { font-family: <?php echo get_theme_option('body_font'); ?> !important; }
<?php } ?>


<?php
if( get_theme_option('headline_font') == 'Choose a font' || get_theme_option('headline_font') == '') { ?>
h1,h2,h3,h4,h5,h6,.header-title,#main-navigation, #featured #featured-title, #cf .tinput, .post-more a, #wp-calendar caption,.flex-caption,#portfolio-filter li,.nivo-caption a.read-more,.form-submit #submit,.fbottom,ol.commentlist li div.comment-post-meta {  font-family:  Asap, sans-serif !important;
 }
<?php } else { ?>
h1,h2,h3,h4,h5,h6,.header-title,#main-navigation, #featured #featured-title, #cf .tinput, .post-more a, #wp-calendar caption,.flex-caption,#portfolio-filter li,.nivo-caption a.read-more,.form-submit #submit,.fbottom,ol.commentlist li div.comment-post-meta {
font-family:  <?php echo get_theme_option('headline_font'); ?> !important; }
<?php } ?>


<?php
if( get_theme_option('navigation_font') == 'Choose a font' || get_theme_option('navigation_font') == '') { ?>
#main-navigation, .sf-menu li {  font-family:  Asap, sans-serif !important;}
<?php } else { ?>
#main-navigation, .sf-menu li { font-family:  <?php echo get_theme_option('navigation_font'); ?> !important; }
<?php } ?>
