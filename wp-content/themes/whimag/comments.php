<?php if ( post_password_required() ) { return; } ?>

<div id="comments" class="comments-area">
<?php if ( have_comments() ) : ?>

<h2 class="comments-title"><?php printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'whimag' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?></h2>

<?php do_action('mp_before_comment_list'); ?>
<ol class="comment-list">
<?php wp_list_comments( array('style' => 'ol','short_ping' => true,'avatar_size' => 56 ) ); ?>
</ol>
<?php do_action('mp_after_comment_list'); ?>

<?php endif; ?>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<div class="post-paging" id="post-navigator"><?php paginate_comments_links(); ?></div>
<?php endif; ?>

<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
<p class="no-comments"><?php _e( 'Comments are closed.', 'whimag' ); ?></p>
<?php endif; ?>

<?php do_action('mp_before_comment_form'); ?>
<?php comment_form(); ?>
<?php do_action('mp_after_comment_form'); ?>

</div>
