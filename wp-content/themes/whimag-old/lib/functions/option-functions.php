<?php
////////////////////////////////////////////////////////////////////////////////
// get theme option
////////////////////////////////////////////////////////////////////////////////
if( !function_exists('get_theme_option') ):
function get_theme_option($option)
{
global $shortname;
return stripslashes(get_option($shortname . '_' . $option));
}
endif;

if( !function_exists('get_theme_settings') ):
function get_theme_settings($option)
{
return stripslashes(get_option($option));
}
endif;


////////////////////////////////////////////////////////////////////////////////
// multiple string option page
////////////////////////////////////////////////////////////////////////////////
function _g($str) { return $str; }

function theme_admin_head_script() {
global $theme_version;
if ($_GET["page"] == "theme-options") {
wp_enqueue_script( 'theme-color-picker-js', get_template_directory_uri() . '/lib/admin/js/colorpicker.js', array( 'jquery' ), $theme_version );
wp_enqueue_script( 'theme-option-custom-js', get_template_directory_uri() . '/lib/admin/js/options-custom.js', array( 'jquery' ), $theme_version );
//add uniform js
wp_enqueue_script( 'theme-uniform-js', get_template_directory_uri() . '/lib/admin/js/uniform/jquery.uniform.js', array( 'jquery' ), $theme_version );
?>
<script type='text/javascript'>
 jQuery(function(){
 jQuery("select,textarea,input:checkbox,input:text,input:radio,input:file").uniform();
 });
</script>
<?php
}
}

function theme_admin_head_style() {
global $theme_version;
if ($_GET["page"] == "theme-options") {
wp_enqueue_style( 'admin-css', get_template_directory_uri() . '/lib/admin/css/admin.css', array(), $theme_version );
wp_enqueue_style( 'color-picker-main', get_template_directory_uri() . '/lib/admin/css/colorpicker.css', array(), $theme_version );
wp_enqueue_style( 'uniform-css', get_template_directory_uri() . '/lib/admin/js/uniform/css/uniform.default.css', array(), $theme_version );
?>
<?php }
}
add_action('admin_footer', 'theme_admin_head_script');
add_action('admin_print_styles', 'theme_admin_head_style');


////////////////////////////////////////////////////////////////////////////////
// Theme Option
////////////////////////////////////////////////////////////////////////////////
$theme_data = wp_get_theme( TEMPLATE_DOMAIN );
$theme_version = $theme_data['Version'];
$theme_name = $theme_data['Name'];
$shortname = 'tn_'.TEMPLATE_DOMAIN;

$choose_count = array("Select a number","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20");

$font_family_group = array(
"Choose a font",
"---- Safe Fonts ----",
"Arial, sans-serif",
"Arial Black, sans-serif",
"Verdana, Geneva, sans-serif",
"Tahoma, Geneva, sans-serif",
"Trebuchet MS, sans-serif",
"Times New Roman, serif",
"Myriad Pro, sans-serif",
"Helvetica Neue, sans-serif",
"Helvetica, sans-serif",
"Helvetica Light, sans-serif",
"Lucida Grande, sans-serif",
"Courier New, monospace",
"Georgia, arial, serif",
"Palatino Linotype, Palatino, serif",
"---- Google Web Font ----",
"Museo, Georgia, Serif",
"Signika, sans-serif",
"Open Sans, arial, sans-serif",
"Josefin Slab, arial, sans-serif",
"Tienne, serif",
"Arvo, arial, sans-serif",
"Lato, arial, sans-serif",
"PT Sans, arial, sans-serif",
"PT Serif, serif",
"Cantarell, arial, serif",
"Cardo, arial, serif",
"Crimson Text, arial, serif",
"Droid Sans, arial, serif",
"Droid Serif, arial, serif",
"IM Fell DW Pica, arial, serif",
"Josefin Sans Std Light, arial, serif",
"Lobster, arial, serif",
"Molengo, arial, serif",
"Neuton, arial, serif",
"Nobile, arial, serif",
"OFL Sorts Mill Goudy TT, arial, serif",
"Reenie Beanie, arial, serif",
"Tangerine, arial, serif",
"Old Standard TT, arial, serif",
"Volkorn, arial, serif",
"Yanone Kaffeesatz, arial, serif",
"Just Another Hand, arial, serif",
"Terminal Dosis Light, arial, serif",
"Ubuntu, arial, serif",
"Ropa Sans, arial, sans-serif",
"Asap, sans-serif",
"Lilita One, arial, sans-serif",
"Telex, arial, sans-serif",
"Lustria, arial, sans-serif",
"Duru Sans, arial, sans-serif",
"Oswald, arial, sans-serif"
);





////////////////////////////////////////////////////////////////////////////////
// get alt style list
////////////////////////////////////////////////////////////////////////////////
$alt_stylesheet_path = get_template_directory() . '/lib/styles/alt-styles/';
$alt_stylesheets = array();
if ( is_dir($alt_stylesheet_path) ) {
if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) {
while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
if(stristr($alt_stylesheet_file, ".css") !== false) {
$alt_stylesheets[] = $alt_stylesheet_file;
}
}
}
}
$styles_bulk_list = array_unshift($alt_stylesheets, "default.css");

////////////////////////////////////////////////////////////////////////////////
// global upload path
////////////////////////////////////////////////////////////////////////////////
$option_upload = wp_upload_dir();
$option_upload_path = $option_upload['basedir'];
$option_upload_url = $option_upload['baseurl'];

////////////////////////////////////////////////////////////////////////////////
// get google web font
////////////////////////////////////////////////////////////////////////////////
if( !function_exists( 'theme_custom_google_font' ) ):
function theme_custom_google_font(){
$bodytype = get_theme_option('body_font');
$headtype = get_theme_option('headline_font');
$navtype = get_theme_option('navigation_font');


if ($bodytype == "" || $bodytype == "Choose a font"){ ?>
<?php } else if ($bodytype == "Open Sans, arial, sans-serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Josefin Slab, arial, sans-serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Josefin+Slab:400,600,700,400italic,600italic,700italic' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Arvo, arial, sans-serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Lato, arial, sans-serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "PT Sans, arial, sans-serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "PT Serif, serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Cantarell, arial, serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Cardo, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Cardo' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Crimson Text, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Crimson+Text' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Droid Sans, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Droid Serif, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "IM Fell DW Pica, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Josefin Sans Std Light, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans+Std+Light' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Lobster, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Molengo, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Neuton, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Neuton' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Nobile, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Nobile' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "OFL Sorts Mill Goudy TT, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=OFL+Sorts+Mill+Goudy+TT' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Reenie Beanie, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Reenie+Beanie' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Tangerine, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Old Standard TT, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Old+Standard+TT' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Volkorn, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Volkorn' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Yanone Kaffeesatz, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700,300,200' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Just Another Hand, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Just+Another+Hand' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Terminal Dosis Light, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis+Light' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Ubuntu, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:light,regular,bold' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Ropa Sans, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Ropa+Sans:400,400italic' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Asap, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Asap:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Lilita One, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Lilita+One' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Telex, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Telex' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Lustria, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Lustria' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Duru Sans, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Duru+Sans' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Oswald, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Tienne, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Tienne:400,700,900' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Signika, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Signika:400,300,600,700' rel='stylesheet' type='text/css'>
<?php }





if ($navtype == "" || $navtype == "Choose a font"){ ?>
<?php } else if ($navtype == "Open Sans, arial, sans-serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Josefin Slab, arial, sans-serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Josefin+Slab:400,600,700,400italic,600italic,700italic' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Arvo, arial, sans-serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Lato, arial, sans-serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "PT Sans, arial, sans-serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "PT Serif, serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Cantarell, arial, serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Cardo, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Cardo' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Crimson Text, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Crimson+Text' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Droid Sans, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Droid Serif, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "IM Fell DW Pica, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Josefin Sans Std Light, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans+Std+Light' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Lobster, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Molengo, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Neuton, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Neuton' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Nobile, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Nobile' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "OFL Sorts Mill Goudy TT, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=OFL+Sorts+Mill+Goudy+TT' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Reenie Beanie, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Reenie+Beanie' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Tangerine, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Old Standard TT, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Old+Standard+TT' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Volkorn, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Volkorn' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Yanone Kaffeesatz, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700,300,200' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Just Another Hand, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Just+Another+Hand' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Terminal Dosis Light, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis+Light' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Ubuntu, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:light,regular,bold' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Ropa Sans, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Ropa+Sans:400,400italic' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Asap, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Asap:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Lilita One, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Lilita+One' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Telex, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Telex' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Lustria, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Lustria' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Duru Sans, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Duru+Sans' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Oswald, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Tienne, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Tienne:400,700,900' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Signika, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Signika:400,300,600,700' rel='stylesheet' type='text/css'>
<?php }



if ($headtype == "" || $headtype == "Choose a font"){ ?>
<?php } else if ($headtype == "Open Sans, arial, sans-serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Josefin Slab, arial, sans-serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Josefin+Slab:400,600,700,400italic,600italic,700italic' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Arvo, arial, sans-serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Lato, arial, sans-serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "PT Sans, arial, sans-serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "PT Serif, serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Cantarell, arial, serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Cardo, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Cardo' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Crimson Text, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Crimson+Text' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Droid Sans, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Droid Serif, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "IM Fell DW Pica, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Josefin Sans Std Light, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans+Std+Light' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Lobster, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Molengo, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Neuton, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Neuton' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Nobile, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Nobile' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "OFL Sorts Mill Goudy TT, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=OFL+Sorts+Mill+Goudy+TT' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Reenie Beanie, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Reenie+Beanie' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Tangerine, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Old Standard TT, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Old+Standard+TT' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Volkorn, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Volkorn' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Yanone Kaffeesatz, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700,300,200' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Just Another Hand, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Just+Another+Hand' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Terminal Dosis Light, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis+Light' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Ubuntu, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:light,regular,bold' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Ropa Sans, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Ropa+Sans:400,400italic' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Asap, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Asap:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Lilita One, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Lilita+One' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Telex, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Telex' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Lustria, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Lustria' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Duru Sans, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Duru+Sans' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Oswald, arial, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Tienne, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Tienne:400,700,900' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Signika, sans-serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Signika:400,300,600,700' rel='stylesheet' type='text/css'>
<?php }

}
endif;


$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
$wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category");


$options = array (


/*header setting*/
array(
"header-title" => __("Header Setting", TEMPLATE_DOMAIN),
"name" => __("Site Logo", TEMPLATE_DOMAIN),
	"description" => __("Upload your logo here.", TEMPLATE_DOMAIN),
	"id" => $shortname."_header_logo",
    "filename" => $shortname."_header_logo",
	"type" => "uploads",
	"default" => ""),

array(
"name" => __("Favourite Icon", TEMPLATE_DOMAIN),
	"description" => __("Upload your fav icon here. <em>prefered 16x16 or 32x32 image dimension</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_fav_icon",
    "filename" => $shortname."_fav_icon",
	"type" => "uploads",
	"default" => ""),


/*array(
"name" => __("Enable or Disable the Header Banner", TEMPLATE_DOMAIN),
"description" => __("Choose if you want to enable or disable header banner.", TEMPLATE_DOMAIN),
	"id" => $shortname."_header_embed_on",
	"type" => "radio",
	"options" => array("Enable","Disable"),
	"default" => "Enable"),*/

array( "name" => __("468x60 or 728x90 Header Banner and Advertisment Embed Code", TEMPLATE_DOMAIN),
  "description" => __("Add Embed Code or Image Banner Here <em>*HTML Allowed</em>. Leave blank if not use.", TEMPLATE_DOMAIN),
	"id" => $shortname."_header_embed",
	"type" => "textarea",
	"default" => ""),

/* typography setting */
array(
"header-title" => __("Typography Settings", TEMPLATE_DOMAIN),
"name" => __("Body Font", TEMPLATE_DOMAIN),
	"description" => __("Choose a font for the body text.", TEMPLATE_DOMAIN),
	"id" => $shortname."_body_font",
	"type" => "select-fonts",
	"options" => $font_family_group,
	"default" => ""),

array(
"name" => __("Headline and Title Font", TEMPLATE_DOMAIN),
	"description" => __("Choose a font for the headline text.", TEMPLATE_DOMAIN),
	"id" => $shortname."_headline_font",
	"type" => "select-fonts",
	"options" => $font_family_group,
	"default" => ""),

array(
"name" => __("Navigation Font", TEMPLATE_DOMAIN),
	"description" => __("Choose a font for the navigation text.", TEMPLATE_DOMAIN),
	"id" => $shortname."_navigation_font",
	"type" => "select-fonts",
	"options" => $font_family_group,
	"default" => ""),


/* Slider setting */
array(
"header-title" => __("Gallery Slider Settings", TEMPLATE_DOMAIN),
"name" => __("Enable Featured Gallery Slider", TEMPLATE_DOMAIN),
"description" => __("Choose if you want to enable or disable gallery slider.", TEMPLATE_DOMAIN),
	"id" => $shortname."_slider_on",
	"type" => "radio",
	"options" => array("Disable", "Enable"),
	"default" => "Disable"),


array(
"name" => __("Categories ID", TEMPLATE_DOMAIN),
"description" => __("Add a list of category ids if you want to use category as featured. <em>*leave blank to use bottom post ids featured</em><br /><small>example: 3,4,68</small>", TEMPLATE_DOMAIN),
	"id" => $shortname."_feat_cat",
	"type" => "text",
	"default" => ""),

array(
"name" => __("Limit to how many posts", TEMPLATE_DOMAIN),
"description" => __("How many posts in categories you listed you want to show?", TEMPLATE_DOMAIN),
	"id" => $shortname."_feat_cat_count",
	"type" => "select",
    "options" => $choose_count,
	"default" => ""),


array(
"name" => __("Posts ID", TEMPLATE_DOMAIN),
"description" => __("Add a list of post ids if you want to use posts as featured. <em>*leave blank to use above category ids featured</em><br /><small>example: 136,928,925,80,77,55,49</small>", TEMPLATE_DOMAIN),
	"id" => $shortname."_feat_post",
	"type" => "text",
	"default" => ""),


/* Sidebar Featured setting */
array(
"header-title" => __("Featured Sidebar", TEMPLATE_DOMAIN),
"name" => __("Enable Featured Category Sidebar", TEMPLATE_DOMAIN),
"description" => __("Choose if you want to enable or disable featured category sidebar. <em>*leave blank if not use</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_feat_sidebar_on",
	"type" => "radio",
	"options" => array("Disable", "Enable"),
	"default" => "Disable"),


array(
"name" => __("Sidebar Featured Category 1", TEMPLATE_DOMAIN),
"description" => __("Choose which category to featured.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat1",
	"type" => "select",
	"options" => $wp_cats),
array(
"name" => __("Featured Category 1 Count", TEMPLATE_DOMAIN),
"description" => __("How many posts you want to list in this category?", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat1_count",
	"type" => "select",
    "options" => $choose_count,
	"default" => ""),

array(
"name" => __("Sidebar Featured Category 2", TEMPLATE_DOMAIN),
"description" => __("Choose which category to featured.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat2",
	"type" => "select",
	"options" => $wp_cats),
array(
"name" => __("Featured Category 2 Count", TEMPLATE_DOMAIN),
"description" => __("How many posts you want to list in this category?", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat2_count",
	"type" => "select",
    "options" => $choose_count,
	"default" => ""),


array(
"name" => __("Sidebar Featured Category 3", TEMPLATE_DOMAIN),
"description" => __("Choose which category to featured.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat3",
	"type" => "select",
	"options" => $wp_cats),
array(
"name" => __("Featured Category 3 Count", TEMPLATE_DOMAIN),
"description" => __("How many posts you want to list in this category?", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat3_count",
	"type" => "select",
    "options" => $choose_count,
	"default" => ""),


array(
"name" => __("Sidebar Featured Category 4", TEMPLATE_DOMAIN),
"description" => __("Choose which category to featured.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat4",
	"type" => "select",
	"options" => $wp_cats),
array(
"name" => __("Featured Category 4 Count", TEMPLATE_DOMAIN),
"description" => __("How many posts you want to list in this category?", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat4_count",
	"type" => "select",
    "options" => $choose_count,
	"default" => ""),


/*adsense setting*/
array(
"header-title" => __("Google Adsense Settings", TEMPLATE_DOMAIN),
"name" => __("Google Adsense in Post Loop", TEMPLATE_DOMAIN),
	"description" => __("Insert Google Adsense code for the blog post loop. It will appeared after <em>post_content()</em>. Leave blank if not use.", TEMPLATE_DOMAIN),
	"id" => $shortname."_adsense_post",
	"type" => "textarea",
	"default" => ""),

array( "name" => __("Google Adsense in Single Post", TEMPLATE_DOMAIN),
  "description" => __("Insert Google Adsense code for the single post page. It will appeared before <em>post_content()</em>. Leave blank if not use.", TEMPLATE_DOMAIN),
	"id" => $shortname."_adsense_single",
	"type" => "textarea",
	"default" => ""),

array( "name" => __("Google Adsense in Left Sidebar", TEMPLATE_DOMAIN),
  "description" => __("Insert Google Adsense code for the sidebar. 300x250 or 250x250 dimension preferable. Leave blank if not use.", TEMPLATE_DOMAIN),
	"id" => $shortname."_adsense_sidebar",
	"type" => "textarea",
	"default" => ""),

array( "name" => __("Google Analytics", TEMPLATE_DOMAIN),
	"description" => __("Insert <strong>Google Analytics</strong> code on head section. <em>Leave blank if not use</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_google_analytics",
	"type" => "textarea",
	"default" => ""),




array(
"header-title" => __("Sidebar Banner Settings", TEMPLATE_DOMAIN),
"name" => __("Banner Ads 1", TEMPLATE_DOMAIN),
	"description" => __("Insert banner 1 HTML code. <em>*leave blank if not use</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_sponsor_banner_one",
	"type" => "textarea",
	"std" => ""),

array( "name" => __("Banner Ads 2", TEMPLATE_DOMAIN),
	"description" => __("Insert banner 2 HTML code. <em>*leave blank if not use</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_sponsor_banner_two",
	"type" => "textarea",
	"std" => ""),

array( "name" => __("Banner Ads 3", TEMPLATE_DOMAIN),
	"description" => __("Insert banner 3 HTML code. <em>*leave blank if not use</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_sponsor_banner_three",
	"type" => "textarea",
	"std" => ""),

array( "name" => __("Banner Ads 4", TEMPLATE_DOMAIN),
	"description" => __("Insert banner 4 HTML code. <em>*leave blank if not use</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_sponsor_banner_four",
	"type" => "textarea",
	"std" => ""),

array( "name" => __("Banner Ads 5", TEMPLATE_DOMAIN),
	"description" => __("Insert banner 5 HTML code. <em>*leave blank if not use</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_sponsor_banner_five",
	"type" => "textarea",
	"std" => ""),

array( "name" => __("Banner Ads 6", TEMPLATE_DOMAIN),
	"description" => __("Insert banner 6 HTML code. <em>*leave blank if not use</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_sponsor_banner_six",
	"type" => "textarea",
	"std" => ""),


/* services setting */
array(
"header-title" => __("Social Settings", TEMPLATE_DOMAIN),
"name" => __("Twitter and Facebook Like and Send in Posts", TEMPLATE_DOMAIN),
	"description" => __("Enable Twitter and Facebook Like and Send in posts", TEMPLATE_DOMAIN),
	"id" => $shortname."_social_on",
	"type" => "radio",
	"options" => array('Yes','No'),
	"default" => "Yes"),

array(
"name" => __("Facebook User or Apps ID", TEMPLATE_DOMAIN),
	"description" => __("Insert your Facebook User ID or Apps ID", TEMPLATE_DOMAIN),
	"id" => $shortname."_fb_app_id",
	"type" => "text",
	"default" => ""),


array(
"name" => __("RSS Feed url", TEMPLATE_DOMAIN),
	"description" => __("Insert your RSS Feed url like feed url for feedburner", TEMPLATE_DOMAIN),
	"id" => $shortname."_rss_feed",
	"type" => "text",
	"default" => ""),

array(
"name" => __("Facebook page url", TEMPLATE_DOMAIN),
	"description" => __("Insert your facebook page url", TEMPLATE_DOMAIN),
	"id" => $shortname."_facebook_page",
	"type" => "text",
	"default" => ""),

array(
"name" => __("Twitter page url", TEMPLATE_DOMAIN),
	"description" => __("Insert your twitter page url", TEMPLATE_DOMAIN),
	"id" => $shortname."_twitter_page",
	"type" => "text",
	"default" => ""),

array(
"name" => __("Linkedin page url", TEMPLATE_DOMAIN),
	"description" => __("Insert your linkedin page url", TEMPLATE_DOMAIN),
	"id" => $shortname."_linkedin_page",
	"type" => "text",
	"default" => ""),


array(
"name" => __("Youtube page url", TEMPLATE_DOMAIN),
	"description" => __("Insert your youtube page url", TEMPLATE_DOMAIN),
	"id" => $shortname."_youtube_page",
	"type" => "text",
	"default" => ""),

array(
"name" => __("Google Plus page url", TEMPLATE_DOMAIN),
	"description" => __("Insert your google plus page url", TEMPLATE_DOMAIN),
	"id" => $shortname."_gplus_page",
	"type" => "text",
	"default" => ""),

array(
"name" => __("Flickr page url", TEMPLATE_DOMAIN),
	"description" => __("Insert your flickr page url", TEMPLATE_DOMAIN),
	"id" => $shortname."_flickr_page",
	"type" => "text",
	"default" => ""),

/* extra setting */
array(
"header-title" => __("Extra Settings", TEMPLATE_DOMAIN),
"name" => __("Use Timthumb for thumbnails", TEMPLATE_DOMAIN),
	"description" => __("Enable timthumb for all thumbnails. You may experience higher server or host cpu load, if yes, you can choose to disable it", TEMPLATE_DOMAIN),
	"id" => $shortname."_timthumb_usage",
	"type" => "radio",
	"options" => array('Disable','Enable'),
	"default" => "Disable")

);

function theme_admin_option_register() {
global $theme_name, $shortname, $options, $option_upload_path, $option_upload_url;
?>

<div id="custom-theme-option" class="wrap">
<?php screen_icon(); echo "<h2>" . $theme_name . __( ' Theme Options', TEMPLATE_DOMAIN ) . "</h2>"; ?>
<?php
if ( $_REQUEST['saved'] ) echo '<div class="updated fade"><p><strong>'. $theme_name . __(' settings saved.', TEMPLATE_DOMAIN) . '</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div class="updated fade"><p><strong>'. $theme_name . __(' settings reset.', TEMPLATE_DOMAIN) . '</strong></p></div>';
?>


<!-- START ANNOUCE -->
<div id="announce">

<h1>Thank You For Using <?php echo $theme_name; ?> WordPress Theme By <a rel="nofollow" href="http://www.magpress.com" target="_blank">MagPress.com</a></h1>
<p id="rss">Don't forget to <a href="http://feedburner.google.com/fb/a/mailverify?uri=MagPress&loc=en_US" title="MagPress RSS Feed" rel="nofollow" onclick="window.open('http://feedburner.google.com/fb/a/mailverify?uri=MagPress&loc=en_US','popup','width=700,height=500,scrollbars=yes,resizable=yes,toolbar=no,directories=no,location=no,menubar=no,status=no,left=50,top=0'); return false">SUBSCRIBE OUR RSS FEED</a> to receive latest themes updates.</p>
<p id="note">Note: This free version contained advertisement and sponsored links. If you're interested in purchasing a developer's license for this theme.<br />please go to this <a href="http://www.magpress.com/developer-license" target="_blank">developer license purchase page</a>. Thanks.</p>

<div id="fbbox">
<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FMagPress%2F174211329277208&amp;width=300&amp;height=370&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23d8dfea&amp;stream=false&amp;header=true&amp;appId=235560553158042" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:370px;" allowTransparency="true"></iframe>
</div>

<div id="sponsored">
<h6>MagPress.com Premium Themes</h6>
<div id="content">
<?php if(function_exists('fetch_feed')) {
include_once(ABSPATH . WPINC . '/feed.php'); // the file to rss feed generator
$feed = fetch_feed('http://www.magpress.com/category/premium-themes/feed'); // specify the rss feed
$pt = 1;
$limit = $feed->get_item_quantity(4); // specify number of items
$items = $feed->get_items(0, $limit); // create an array of items
}
if ($limit == 0) echo '<div>The feed is either empty or unavailable.</div>';
else foreach ($items as $item) : ?>
<div class="premium-theme-list pt<?php echo $pt; ?>"><h2><?php echo $item->get_title(); ?></h2>
<?php echo substr($item->get_description(), 0, 240); ?>...<a target="_blank" href="<?php echo $item->get_permalink(); ?>" alt="<?php echo $item->get_title(); ?>">View Details &raquo;</a>
</div>
<?php $pt++; endforeach; ?>
<a class="more-themes" target="_blank" title="check out more premium themes from magpress.com" href="http://www.magpress.com/category/premium-themes">More Premium Themes &raquo;</a>
</div><!-- CONTENT END -->
</div><!-- SPONSORED END -->

</div><!-- END ANNOUCE -->

<form id="wp-theme-options" method="post" action="" enctype="multipart/form-data">

<table class="form-table">

<?php foreach ($options as $value) { ?>

<?php if ( $value['header-title'] != "" ) { ?>
<tr class="trtitle" valign="top"><th scope="row"><h3><?php echo stripslashes($value['header-title']); ?></h3></th></tr>
<?php } ?>


<?php if ( $value['type'] == "text" ) { ?>

<tr valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>
<input class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo stripslashes($value['default']); } ?>" /><br />
<label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></label>
</td>
</tr>

<?php } else if ( $value['type'] == "uploads" ) { ?>

<tr valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>
<?php if( file_exists( $option_upload_path . '/' . $value['filename'] . '.jpg') ) { ?>
<img src="<?php echo $option_upload_url . '/' . $value['filename'] . '.jpg'; ?>" alt="<?php echo $value['id']; ?>" />
<br /><input type="submit" class="button-secondary" name="delete_<?php echo $value['filename']; ?>" value="Delete this image &raquo;" />
<?php } else { ?>
<input type="file" id="<?php echo $value['id']; ?>" name="<?php echo $value['filename']; ?>" size="50" />
<br />
<label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></label>
<?php } ?>
</td>
</tr>

<?php } elseif ( $value['type'] == "radio" ) { // setting ?>

<tr valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>
<?php foreach ($value['options'] as $option) {
$radio_setting = get_option($value['id']);
if($radio_setting != '') {
if (get_option($value['id']) == $option) { $checked = "checked=\"checked\""; } else { $checked = ""; }
} else {
if(get_option($value['id']) == $value['default'] ){ $checked = "checked=\"checked\""; } else { $checked = ""; }
} ?>
<input id="<?php echo $value['hide_call']; ?>" type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $option; ?>" <?php echo $checked; ?> />&nbsp;<?php echo $option; ?>&nbsp;&nbsp;&nbsp;
<?php } ?>
<br /><label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></label>
</td>
</tr>


<?php } elseif ( $value['type'] == "checkbox" ) { // setting ?>

<tr valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>
<?php if(get_option($value['id'])) { $checked = "checked=\"checked\""; } else { $checked = ""; } ?>
<input type="<?php echo $value['type']; ?>" class="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php echo $value['id']; ?>" <?php echo $checked; ?> />&nbsp;&nbsp;<?php echo $value['name']; ?>
<br /><label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></label>
</td>
</tr>

<?php } elseif ( $value['type'] == "textarea" ) { // setting ?>

<tr valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>
<?php
$valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_option($valuey);
?>
<textarea name="<?php echo $valuey; ?>" class="mytext" cols="60%" rows="8" /><?php if ( get_option($valuey) != "") { echo stripslashes($video_code); } else { echo $value['default']; } ?>
</textarea><br />
<label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></label>
</td>
</tr>

<?php } elseif ( $value['type'] == "colorpicker" ) { ?>

<tr valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>

<div id="<?php echo esc_attr( $value['id'] . '_picker' ); ?>" class="colorSelector">
<div style="background-color:<?php if( get_option( $value['id'] )) { echo get_option( $value['id'] ); } ?>"></div></div>&nbsp;
<input class="of-color" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if( get_option( $value['id'] )) { echo get_option( $value['id'] ); } ?>" /><br /><label class="description" for="<?php echo $value['id']; ?>">&nbsp;&nbsp;<?php echo $value['description']; ?></label>
</td>
</tr>


<?php } elseif ( $value['type'] == "select" ) { ?>

<tr class="<?php echo $value['hide_blk']; ?>" valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['default']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select><br />
<label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></label>
</td>
</tr>


<?php } elseif ( $value['type'] == "select-fonts" ) { ?>

<tr valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option style="font-family:<?php echo $option; ?>;" <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == get_option( $value['default']) ) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
<br />
<label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></label>
</td>
</tr>


<?php } elseif ( $value['type'] == "notice" ) { ?>

<tr valign="top"><th scope="row"></th>
<td>
<p class="<?php echo $value['hide_blk']; ?> notice"><?php echo $value['description']; ?></p>
</td>
</tr>


<?php } ?>

<?php } ?>
</table>

<div style="float: left; margin: 20px 40px 0 0;" class="submit">
<input name="save" type="submit" class="button-primary sbutton" value="<?php echo esc_attr(__('Save Options',TEMPLATE_DOMAIN)); ?>" /><input type="hidden" name="action" value="save" />
</div>
</form>

<form method="post">
<div style="float: left; margin: 20px 40px 0 0;" class="submit">
<?php
$alert_message = __("Are you sure you want to delete all saved settings for this theme?.", TEMPLATE_DOMAIN ); ?>
<input name="reset" type="submit" class="button-secondary" onclick="return confirm('<?php echo $alert_message; ?>')" value="<?php echo esc_attr(__('Reset Options',TEMPLATE_DOMAIN)); ?>" />
<input type="hidden" name="action" value="reset" />
</div>
</form>


</div>

<?php }



function theme_admin_menu_register() {
global $thetextlink,$theme_name, $shortname, $options, $option_upload_path, $option_upload_url;
if ( $_GET['page'] == 'theme-options' ) {
if ( 'save' == $_REQUEST['action'] ) {

foreach ($options as $value) {
update_option( $value['id'], $_REQUEST[ $value['id'] ] );
if($_FILES[ $value['filename'] ]['type'] ) {
//Get the file information
$userfile_name = $_FILES[ $value['filename'] ]['name'];
$userfile_sanitize_name = str_replace(" ","-",$userfile_name);
$userfile_sanitize_ext = substr($userfile_sanitize_name, strripos($userfile_sanitize_name, '.'));
$userfile_size = $_FILES[ $value['filename'] ]['size'];
$userfile_tmp = $_FILES[ $value['filename'] ]['tmp_name'];
$allowed_file_types = array('.png','.jpg','.jpeg','.gif');
if ( in_array($userfile_sanitize_ext,$allowed_file_types) ) {
$large_image_location = $option_upload_path . '/' . $value['filename'] . '.jpg';
if(ereg('[^a-zA-Z0-9 ._.-]', $userfile_sanitize_name)){
echo "<p class=\"uperror\">" . __('The image name contain invalid character, rename it and try upload it again', TEMPLATE_DOMAIN) . "</p>";
} else {
move_uploaded_file($userfile_tmp, $large_image_location);
chmod($large_image_location, 0777);
}
}
}
$img1 = $value['filename'];
if ( isset( $_POST['delete_' . $img1] )){
if( file_exists( $option_upload_path . '/' . $value['filename'] . '.jpg' )) {
unlink($option_upload_path . '/' . $value['filename'] . '.jpg');
}
}
}
foreach ($options as $value) {
if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); }
}
header("Location: themes.php?page=theme-options&saved=true");
die;

} else if( 'reset' == $_REQUEST['action'] ) {

foreach ($options as $value) {
delete_option( $value['id'] );
if( file_exists( $option_upload_path . '/' . $value['filename'] . '.jpg' )) {
unlink($option_upload_path . '/' . $value['filename'] . '.jpg');
}
}
header("Location: themes.php?page=theme-options&reset=true");
die;
}
}

add_theme_page(_g ($theme_name . __(' Options' , TEMPLATE_DOMAIN)),  _g (__('Theme Options', TEMPLATE_DOMAIN)),  'edit_theme_options', 'theme-options', 'theme_admin_option_register');
}

add_action('admin_menu', 'theme_admin_menu_register');
?>
