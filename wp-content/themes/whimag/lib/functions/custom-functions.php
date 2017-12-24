<?php
////////////////////////////////////////////////////////////////////////////////
//Adding the Open Graph in the Language Attributes
////////////////////////////////////////////////////////////////////////////////
function add_opengraph_doctype( $output ) {
return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

function insert_fb_in_head() {
global $post;
$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "thumbnail" );
$fb_id = get_theme_option('fb_app_id');
?>
<!-- start open graph code -->
<meta property="fb:app_id" content="<?php echo $fb_id; ?>" />


<?php if( is_singular() ) { ?>

<meta property="og:url" content="<?php echo the_permalink() ?>"/>
<meta property="og:title" content="<?php echo get_the_title(); ?>" />
<meta property="og:description" content="<?php echo get_the_featured_excerpt($excerpt_length=30); ?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?php if( !empty($thumbnail_src) ) { echo $thumbnail_src[0]; } else { echo get_template_directory_uri() . '/lib/styles/images/noimage.png'; } ?>" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />

<?php } else { ?>

<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<meta property="og:title" content="<?php bloginfo('description'); ?>" />
<meta property="og:url" content="<?php echo site_url() ?>"/>
<meta property="og:description" content="<?php bloginfo('description'); ?>" />
<meta property="og:type" content="website" />
<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/lib/styles/images/noimage.png" />

<?php } ?>

<!-- end open graph code -->
<?php }
add_action( 'wp_head', 'insert_fb_in_head', 5 );


?>
