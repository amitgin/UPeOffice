<div class="post-meta the-icons pm-bottom">
<?php if( is_home() ) { ?>
 <?php _e('in', TEMPLATE_DOMAIN); ?> <span class="post-category"><?php echo get_singular_cat() ?></span>
<?php } else { ?>
 <?php _e('in', TEMPLATE_DOMAIN); ?> <span class="post-category"><?php the_category(', ') ?></span>
<?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if( has_tag() ) { ?>
<span class="post-tags"><?php the_tags(__('tags:&nbsp;',TEMPLATE_DOMAIN), ', '); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
<?php } ?>
<?php if ( current_user_can('edit_posts') ) { ?>
<span class="post-edit"><?php edit_post_link(__('Edit',TEMPLATE_DOMAIN)); ?></span>
<?php } ?>
</div>
