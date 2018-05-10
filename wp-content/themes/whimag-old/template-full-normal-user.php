<?php
/*
Template Name: Normal User Dashboard
*/
?>
<?php
$current_user = wp_get_current_user();
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
<style type="text/css">
	.table1{border-collapse: separate; counter-reset: Serial;}
	.table1 tr td:first-child:before{ counter-increment: Serial;  content: "" counter(Serial); }
    .table1 tr th {text-align: center;font-size: smaller;vertical-align: middle;}
	.table1 tbody tr td { text-align: center; vertical-align: middle; padding: 3px; }
	.edit-delete-button {background: #007acc; color: #fff !important; text-decoration: none !important; padding: 5px 10px 5px 10px; border-radius: 20px;}
	.add-employee-button {text-decoration: none !important; background: linear-gradient(to bottom, #a90329 0%,#8f0222 44%,#6d0019 100%); color: #ccc !important; border: 2px solid #444; padding: 5px; cursor: pointer; border-radius: 5px;}
    .add-employee-button:hover {color: #fff !important;}
	@import "http://fonts.googleapis.com/css?family=Raleway";

	#abc {width:100%;height:100%;top:0;left:0;display:none;position:fixed;background-color:#313131;overflow:auto}
	img#close {	position:absolute;right:-14px;top:-14px;cursor:pointer}
	div#popupContact {position:absolute;left:50%;top:5%;margin-left:-202px;font-family:'Raleway',sans-serif}
	.popupForm {min-width:250px;padding:10px 50px;border:2px solid gray;border-radius:10px;font-family:raleway;background-color:#fff}
    input#popup {text-decoration: none !important; background: linear-gradient(to bottom, #a90329 0%,#8f0222 44%,#6d0019 100%); color: #ccc; border: 2px solid #444; padding: 5px; cursor: pointer; border-radius: 5px;}
    input#popup:hover {color: #fff; border: 2px solid #444; padding: 5px; cursor: pointer; border-radius: 5px;}
	hr {margin:10px -50px;border:0;border-top:1px solid #ccc}
	input[type=text] {width: 82%;padding: 5px;margin-top: 5px;border: 1px solid #ccc;padding-left: 40px; font-family: raleway;}
	#name {	background-image:url(../images/name.jpg);background-repeat:no-repeat;background-position:5px 2px}
	#department_name {	background-image:url(../images/office.png);background-repeat:no-repeat;background-position:5px 2px}
	#organization {	background-image:url(../images/office.png);background-repeat:no-repeat;background-position:5px 2px}
	#post_name {	background-image:url(../images/designation.png);background-repeat:no-repeat;background-position:5px 2px}
	#aadhaar_number {	background-image:url(../images/aadhar.jpg);background-repeat:no-repeat;background-position:5px 2px}
	#mobile_number {background-image: url(../images/mobile.png);background-repeat: no-repeat;background-position: 5px 3px;}
	#cug_number {background-image: url(../images/mobile.png);background-repeat: no-repeat;background-position: 5px 3px;}
	#email_id {background-image:url(../images/email.png);background-repeat:no-repeat;background-position:5px 3px}
	#submit {text-decoration: none !important;background-color: #FFBC00;color: #fff;border: 2px solid #444;padding: 5px;cursor: pointer;border-radius: 5px;}
	span {color:red;font-weight:700}
	button {height:30px;border-radius:10px;background: linear-gradient(to bottom, #a90329 0%,#8f0222 44%,#6d0019 100%);color:#fff;cursor:pointer}
</style>
<script>
	function myFunction() {
	  // Declare variables
	  var input, filter, table, tr, td, i;
	  input = document.getElementById("myInput");
	  filter = input.value.toUpperCase();
	  table = document.getElementById("myTable");
	  tr = table.getElementsByTagName("tr");

	  // Loop through all table rows, and hide those who don't match the search query
	  for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[1];
		if (td) {
		  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
			tr[i].style.display = "";
		  } else {
			tr[i].style.display = "none";
		  }
		}
	  }
	}
</script>
<script>
	/// Validating Empty Field
	function check_empty() {
	if (document.getElementById('name').value == "" || document.getElementById('department_name').value == "" || document.getElementById('organization').value == "" || document.getElementById('post_name').value == "" || document.getElementById('aadhaar_number').value == "" || document.getElementById('mobile_number').value == "" || document.getElementById('cug_number').value == "" || document.getElementById('email_id').value == "") {
	alert("Fill All Fields !");
	} else {
	alert("Form Submitted Successfully...");
	document.getElementById('form').submit();
	}
	}
	//Function To Display Popup
	function div_show(id) {
		$.get("/userEdit.php?id="+id, function(data, status){
        	document.getElementById('abc').style.display = "block";
			$('#popupContact').html(data);
		 });
	}
	//Function To Update contributors list Details
	function update_data(id) {
        var form=$("#formObj");
        $("#empid").val(id);
        $.ajax({
            type:"POST",
            url:'/userUpdate.php',
            data:form.serialize(),
            success: function(response){
            }
        });
	}
	//Function to Hide Popup
	function div_hide(){
	document.getElementById('abc').style.display = "none";
	}
	//Function to Delete Data
	function delete_data(id){
        var form=$("#formObj");
        $("#empid").val(id);
        $.ajax({
            type:"POST",
            url:'/userDelete.php',
            data:form.serialize(),
            success: function(response){
            }
        });
	}
    //Function To Display Popup
	function div_employee_show(id) {
		$.get("/userDetail.php?id="+id, function(data, status){
        	document.getElementById('abc').style.display = "block";
			$('#popupContact').html(data);
		 });
	}

</script>

<?php global $wpdb;
$current_user = wp_get_current_user();
$org_name = $wpdb->get_results ( "SELECT `organization` FROM  uptron_contributor_list where `userid` LIKE '%". $current_user->user_login . "%' LIMIT 1" );
$result = $wpdb->get_results ( "SELECT * FROM  uptron_contributor_list where `userid` LIKE '%". $current_user->user_login ."%'" );

echo '<div style="width:100%;">
	<div style="float: left;">
		<h2>'.$current_user->display_name.'</h2>
	</div>
	<div style="float: right;">
		<a href="/add-new-employee-detail/" id="onclick" class="add-employee-button" style="text-decoration: none !important;">Add Employee</a>
	</div>
</div>';
echo '<table class="table1" border="0" cellspacing="2" cellpadding="2">
	<thead>
		<tr>
			<th><b>S.No.</b></th>
			<th><b>Deparment</b></th>
			<th><b>Office Name</b></th>
			<th><b>Name</b></th>
			<th><b>Designation</b></th>
            <th><b>Contact No.</b></th>
			<th><b>eMail</b></th>
            <th><b>Action</b></th>
		</tr>
	</thead>';
foreach ( $result as $page )
{
	echo '<tr>
		<td></td>
		<td>'.$page->department_name.'</td>
		<td>'.$page->organization.'</td>
		<td><a href="#" style="text-decoration:none !important" onclick=div_employee_show('.$page->id.')>'.$page->name.'</a></td>
		<td>'.$page->post_name.'</td>
        <td>'.$page->mobile_number.'<br>'.$page->cug_number.'</td>
		<td><a href="mailto:'.$page->email_id.'" style="text-decoration:none !important" target="_top">'.$page->email_id.'</a></td>
		<td><input type="button" name='.$page->id.' id="popup" onclick=div_show('.$page->id.') value="Edit"></td>
	</tr>';
}
	echo '</table>';
?>
<div id="abc">
	<div id="popupContact">
	</div>
</div>
<?php } ?>
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
