<?php
/*
Template Name: Add New Employee
*/
?>
<?php get_header(); ?>
<?php do_action( 'bp_before_content' ) ?>
<!-- CONTENT START -->
<div class="content full-width">
<div class="content-inner">

<?php do_action( 'bp_before_blog_home' ) ?>

<!-- POST ENTRY -->
<div id="post-entry">
<section class="post-entry-inner">

<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>

<article <?php post_class('post-single page-single'); ?> id="post-<?php the_ID(); ?>">
<div class="post-content">
<?php the_content( __('...Continue reading', TEMPLATE_DOMAIN) ); ?>
<?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>

<!-- **************************************  START Custom Code *********************************************** -->
<?php if( current_user_can('contributor') || current_user_can('administrator') ) {  ?>
<?php
if ( !is_user_logged_in() ) {
wp_redirect( '/login/?reauth=1' );
    exit;
}
?>
<!-- New Employee Form -->
<div id="contactdiv" align="center">
<h1>Employee Detail</h1>
<form class="form" action="" id="contact" method='POST' enctype="multipart/form-data" onsubmit="return validateform()">
	<input type="hidden" name="action" value="signUpDone" />
	<div align="center">
	<table style="width:60%;">
        <tr>
           <td><label>Department Name: <span>*</span></label></td>
           <td><input type="text" name="department" placeholder="Department" style="width:100%;"/></td>
        </tr>
        <tr>
           <td><label>Office Name: </label></td>
           <td><input type="text" name="officename" placeholder="Office Name" style="width:100%;"/></td>
        </tr>
        <tr>
            <td><label>Employee Name: <span>*</span></label></td>
            <td><input type="text" name="employeename" placeholder="Employee Name" style="width:100%;"/></td>
        </tr>
	   <tr>
           <td><label>Designation: <span>*</span></label></td>
           <td><input type="text" name="designation" placeholder="Designation" style="width:100%;"/></td>
        </tr>
        <tr>
            <td><label>Digital Signature: </label></td>
            <td><input type="radio" name="digsign" value="Yes"> Yes<input type="radio" name="digsign" value="No"> No</td>
        </tr>
        <tr>
            <td><label>Is employee has ?: </label></td>
            <td>
                <input type="checkbox" name="computer" value="Computer,">Computer
                <input type="checkbox" name="scanner" value="Scanner,">Scanner
                <input type="checkbox" name="internet" value="Internet">Internet
            </td>
        </tr>
        <tr>
            <td><label>Aadhar No: </label></td>
            <td><input type="text" name="aadharno" placeholder="Aadhar Number" style="width:100%;"/></td>
        </tr>
        <tr>
            <td><label>Aadhar Linked Mobile No: </label></td>
            <td><input type="text" name="contactno" placeholder="Aadhar Linked Mobile Number" style="width:100%;"/></td>
        </tr>
        <tr>
            <td><label>Other No: <span>*</span></label></td>
            <td><input type="text" name="cugno" placeholder="Other Number" style="width:100%;"/></td>
        </tr>
        <tr>
            <td><label>Email Address: <span>*</span></label></td>
            <td><input type="text" name="email" placeholder="Email Address" style="width:100%;"/></td>
        </tr>
        <tr>
            <td style="text-align:right;"><input type="submit" value="Submit"/></td>
            <td text-align="left"><input type="reset" value="Reset"/><input type="reset" value="Cancel" onclick="window.location='/contributor-dashboard/';"/></td>
        </tr>
	</table>
	</div>
</form>
</div>

<?php

if(isset($_POST['action']))
{
    if($_POST['officename']=='' or $_POST['department']=='' or $_POST['employeename']=='' or $_POST['designation']=='' or $_POST['digsign']=='' or $_POST['contactno']=='' or $_POST['cugno']=='' or $_POST['email']=='')
    {
        echo("<script>alert('Fill All the * fields')</script>");
        exit();
    }
    else
    {
        $current_user = wp_get_current_user();
        $userid = $current_user->user_login;
        $organization = $_POST['officename'];
        $main_org = $current_user->display_name;
        $department_name = $_POST['department'];
        $name = $_POST['employeename'];
        $post_name = $_POST['designation'];
        $digsign = $_POST['digsign'];
        $aadhaar_number = $_POST['aadharno'];
        $mobile_number = $_POST['contactno'];
        $cug_number = $_POST['cugno'];
        $email_id = $_POST['email'];
        $computer = $_POST['computer'];
        $scanner = $_POST['scanner'];
        $internet = $_POST['internet'];


        $table_name = $wpdb->prefix . "contributor_list";
        $wpdb->insert($table_name, array('userid' => $userid, 'organization' => $organization, 'main_org' => $main_org, 'department_name' => $department_name, 'name' => $name, 'post_name' => $post_name, 'digsign'=>$digsign, 'aadhaar_number' => $aadhaar_number, 'mobile_number' => $mobile_number, 'cug_number' => $cug_number, 'email_id' => $email_id, 'computer' => $computer, 'scanner' => $scanner, 'internet' => $internet) );
        header('location:/dashboard/');
        die;
    }
}
?>
<?php }?>
<!-- **************************************  STOP Custom Code *********************************************** -->
</div><!-- POST CONTENT END -->
</article>

<?php endwhile; ?>
<?php if ( comments_open() ) { ?><?php comments_template( '', true ); ?><?php } ?>
<?php else : ?>
<?php get_template_part( 'lib/templates/result' ); ?>
<?php endif; ?>

</section>
</div>
<!-- POST ENTRY END -->

<?php do_action( 'bp_after_blog_home' ) ?>

</div><!-- CONTENT INNER END -->
</div><!-- CONTENT END -->

<?php do_action( 'bp_after_content' ) ?>

<?php get_footer(); ?>
