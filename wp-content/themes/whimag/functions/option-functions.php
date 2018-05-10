<?php
/*--------------------------------------------
Description: add body font style
---------------------------------------------*/
function frkw_add_body_font_style() {
$bodyfont = get_theme_mod('body_font');
$bodyfontweight = get_theme_mod('body_font_weight');
if( $bodyfont == 'Choose a font' || $bodyfont == '') { ?>
body {font-family: 'PT Sans',arial,sans-serif; font-weight:400;}
<?php } else { ?>
body {font-family:<?php echo $bodyfont; ?>;font-weight:<?php echo $bodyfontweight; ?>;}
<?php
}
}
add_action('frkw_custom_css','frkw_add_body_font_style');


/*--------------------------------------------
Description: add headline font style
---------------------------------------------*/
function frkw_add_headline_font_style() {
$headlinefont = get_theme_mod('headline_font');
$headlinefontweight = get_theme_mod('headline_font_weight');
if( $headlinefont == 'Choose a font' || $headlinefont == '') { ?>
h1,h2,h3,h4,h5,h6,#siteinfo div,.activity-header {font-family: 'Asap',sans-serif; font-weight:700;}
<?php } else { ?>
h1,h2,h3,h4,h5,h6,#siteinfo div,.activity-header { font-family: <?php echo $headlinefont; ?>; font-weight: <?php echo $headlinefontweight; ?>; }
<?php
}
}
add_action('frkw_custom_css','frkw_add_headline_font_style');

/*--------------------------------------------
Description: add navigation font style
---------------------------------------------*/
function frkw_add_navigation_font_style() {
$navfont = get_theme_mod('navigation_font');
$navfontweight = get_theme_mod('navigation_font_weight');
if( $navfont == 'Choose a font' || $navfont == '') { ?>
.sf-menu {font-family: 'Asap',sans-serif; font-weight:400;}
<?php } else { ?>
.sf-menu {font-family: <?php echo $navfont; ?>; font-weight:<?php echo $navfontweight; ?>; }
<?php
}
}
add_action('frkw_custom_css','frkw_add_navigation_font_style');



/*----------------------------------------------------
Description: add theme header text style
----------------------------------------------------*/
function frkw_add_header_textcolor() {
$header_text = get_theme_mod('header_text');
$header_textcolor = get_theme_mod('header_textcolor');
if( $header_text == 'blank' ) { ?>
#custom #siteinfo h1,#custom #siteinfo div, #custom #siteinfo p,#custom .site-title-wrap {display:none;}
<?php } else {
if( $header_textcolor ) { ?>
#custom #siteinfo a {color: #<?php echo $header_textcolor; ?> !important;text-decoration: none;}
#custom #siteinfo p#site-description {color: #<?php echo $header_textcolor; ?> !important;text-decoration: none;}
<?php
}
}
}
add_action('frkw_custom_css','frkw_add_header_textcolor');

/*----------------------------------------------------
Description: add header color css
----------------------------------------------------*/
function frkw_add_header_color() {
$header_color = get_theme_mod('header_color');
if( $header_color ) { ?>
#header {
background: <?php echo $header_color; ?>;
background: -moz-linear-gradient(top, <?php echo $header_color; ?> 0%, <?php echo dehex($header_color,-20); ?> 100%);
background: -webkit-linear-gradient(top, <?php echo $header_color; ?> 0%,<?php echo dehex($header_color,-20); ?> 100%);
background: linear-gradient(to bottom, <?php echo $header_color; ?> 0%,<?php echo dehex($header_color,-20); ?> 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $header_color; ?>', endColorstr='<?php echo dehex($header_color,-20); ?>',GradientType=0 );
}
#mobile-nav .mobile-open a {background-color: <?php echo dehex($header_color,-40); ?>;}
<?php }
}
add_action('frkw_custom_css','frkw_add_header_color');

/*----------------------------------------------------
Description: add nav color css
----------------------------------------------------*/
function frkw_add_nav_color() {
$nav_color = get_theme_mod('nav_color');
if( $nav_color ) { ?>
#main-navigation {background-color:<?php echo $nav_color; ?>;}
#main-navigation li a { color:#fff; }
.sf-menu .menu-description,.sf-menu li.current-menu-item .menu-description { color:rgba(255,255,255,0.7); }
#main-navigation .sf-menu li.current-menu-item a,#main-navigation .sf-menu li.current-page-item a {background-color:<?php echo dehex($nav_color,-15); ?>;}
#main-navigation .sf-menu li li a {background:<?php echo $nav_color; ?> none;}
#main-navigation .sf-menu li li a:hover {background:<?php echo dehex($nav_color,-15); ?> none;}
.sf-arrows .sf-with-ul:after,.sf-arrows ul li > .sf-with-ul:focus:after,.sf-arrows ul li:hover > .sf-with-ul:after,.sf-arrows ul .sfHover > .sf-with-ul:after {color:#fff;}
<?php }
}
add_action('frkw_custom_css','frkw_add_nav_color');

/*----------------------------------------------------
Description: add link color css
----------------------------------------------------*/
function frkw_add_link_color() {
$link_color = get_theme_mod('link_color');
if( $link_color ) { ?>
#entries .entry-meta span a {color:<?php echo $link_color; ?>;}
.post-paging .page-navigation span.current {color:#fff;background-color:<?php echo $link_color; ?>;border:1px solid <?php echo $link_color; ?>;}
.content a,#custom #right-sidebar .widget a:hover,aside.widget #calendar_wrap a, #custom aside.widget .textwidget a {color:<?php echo $link_color; ?>;}
.content-area article .entry-content a.readmore {background-color:<?php echo $link_color; ?>;}
#right-sidebar aside.widget a {color:<?php echo $link_color; ?>;}
.content-area article h2.entry-title a:hover {color:<?php echo $link_color; ?>;}
.post-paging .page-navigation span.current { border: 1px solid <?php echo $link_color; ?>;background: <?php echo $link_color; ?>;background: -moz-linear-gradient(top, <?php echo $link_color; ?> 0%, <?php echo dehex($link_color,-20); ?> 100%);background: -webkit-linear-gradient(top, <?php echo $link_color; ?> 0%,<?php echo dehex($link_color,-20); ?> 100%);background: linear-gradient(to bottom, <?php echo $link_color; ?> 0%,<?php echo dehex($link_color,-20); ?> 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $link_color; ?>', endColorstr='<?php echo dehex($link_color,-20); ?>',GradientType=0 );
}
<?php }
}
add_action('frkw_custom_css','frkw_add_link_color');


/*----------------------------------------------------
Description: add footer color css
----------------------------------------------------*/
function frkw_add_footer_color() {
$footer_color = get_theme_mod('footer_color');
if( $footer_color ) { ?>
#custom footer.footer-top {background-color:<?php echo $footer_color; ?>;border-top:1px solid <?php echo dehex($footer_color,-20); ?>;}
#custom footer.footer-bottom {background-color:<?php echo dehex($footer_color,-20); ?>;border-top:1px solid <?php echo dehex($footer_color,10); ?>;}
#custom footer.footer-bottom .footer-left,#custom footer.footer-bottom a {color: rgba( 255,255,255,0.5);}
footer aside.widget ul.featured-cat-posts li,footer aside.widget ul.item-list li {  border-bottom: 1px solid <?php echo dehex($footer_color,-10); ?>; }
footer aside.widget caption {background-color: <?php echo dehex($footer_color,-10); ?>;}
footer aside.widget th {border-bottom: 1px solid <?php echo dehex($footer_color,-10); ?>;}
footer .ftop aside.widget { color:#fff; }
footer .ftop aside.widget a,footer aside.widget #calendar_wrap a { color:#fff; }
footer ul.tabbernav { border-bottom: 1px solid <?php echo dehex($footer_color,-15); ?>; }
footer ul.tabbernav li a{color: rgba( 255,255,255,0.5);background-color:<?php echo $footer_color; ?>;}
footer ul.tabbernav li.tabberactive a,footer ul.tabbernav li.tabberactive a:hover{color: #fff;border:1px solid <?php echo dehex($footer_color,-15); ?>;background-color:<?php echo $footer_color; ?>;}
<?php }
}
add_action('frkw_custom_css','frkw_add_footer_color');


/*----------------------------------------------------
Description: let's finalize all it wp_head
----------------------------------------------------*/
function frkw_init_theme_custom_style() {
print '<style id="theme-custom-css" type="text/css" media="all">' . "\n";
do_action( 'frkw_custom_css' );
print '</style>' . "\n";
}
add_action('wp_head','frkw_init_theme_custom_style',99);

?>
