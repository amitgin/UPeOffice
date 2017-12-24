<div class="post-meta the-icons">

<?php if( !is_page()) { ?>

<?php _e('Posted by', TEMPLATE_DOMAIN); ?> <span class="post-author"><?php the_author_posts_link(); ?></span> <?php _e('on', TEMPLATE_DOMAIN); ?> <span class="post-time"><?php the_time('l, d F Y') ?></span>

<?php if( is_home() ) { ?>
 <?php _e('in', TEMPLATE_DOMAIN); ?> <span class="post-category"><?php echo get_singular_cat() ?></span>
<?php } else { ?>
 <?php _e('in', TEMPLATE_DOMAIN); ?> <span class="post-category"><?php the_category(', ') ?></span>
<?php } ?>&nbsp;&nbsp;<?php if( has_tag() ) { ?>
<span class="post-tags"><?php the_tags(__('tags:&nbsp;',TEMPLATE_DOMAIN), ', '); ?></span>
<?php } ?>

<?php } //dont show this in pages ?>

<?php if ( comments_open() ) { ?>
<span class="post-comment"><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span>
<?php } ?>


<?php if( !is_singular() ): ?>
<?php if ( function_exists( 'get_wp_post_view' ) ) { $view_count = get_wp_post_view( get_the_ID() ); if(!$view_count) { $view_count = '0 Read'; } elseif( $view_count == '1' ) { $view_count = '1 Read'; } else { $view_count=$view_count. ' Reads'; }?>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="post-view"><a title="Click here to read <?php the_title(); ?>" href="<?php echo the_permalink(); ?>"> <?php echo $view_count; ?></a></span>
<?php } ?>
<?php endif; ?>


<?php if ( current_user_can('edit_posts') ) { ?>
<span class="post-edit"><?php edit_post_link(__('Edit',TEMPLATE_DOMAIN)); ?></span>
<?php } ?>


</div>
