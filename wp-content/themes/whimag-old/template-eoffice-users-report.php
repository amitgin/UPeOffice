<?php
/*
Template Name: eOffice Users Reports
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
<div><!-- Contributor Dashboard Start -->
<?php if( current_user_can('contributor') || current_user_can('administrator') ) {  ?>

<?php
if ( !is_user_logged_in() ) {
wp_redirect( '/login/?reauth=1' );
    exit;
}
?>
<style type="text/css">
    .table2 {border-radius: 5px;}
	.table2 tr th {text-align: center;font-size: smaller;vertical-align: middle; border:1px solid #ccc !important; color: #a90329;}
	.table2 tbody tr td { text-align: center; vertical-align: middle; padding: 3px; border:1px solid #ccc !important; }
	.edit-delete-button {background: #007acc; color: #fff !important; text-decoration: none !important; padding: 5px 10px 5px 10px; border-radius: 20px;}
	.add-employee-button {text-decoration: none !important; background: linear-gradient(to bottom, #a90329 0%,#8f0222 44%,#6d0019 100%); color: #ccc !important; border: 2px solid #444; padding: 5px; cursor: pointer; border-radius: 5px;}
    .add-employee-button:hover {color: #fff !important;}
	@import "https://fonts.googleapis.com/css?family=Raleway";

	#abc {width:100%;height:100%;top:0;left:0;display:none;position:fixed;background-color:#313131;overflow:auto}
	img#close {	position:absolute;right:-14px;top:-14px;cursor:pointer}
	div#popupContact {position:absolute;left:30%;top:5%;font-family:'Raleway',sans-serif}
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    function div_show(id) {
		$.get("/reportEdit.php?id="+id, function(data, status){
        	document.getElementById('abc').style.display = "block";
			$('#popupContact').html(data);
		 });
	}
    //Function for Cancel Button
    function cancel() {
		window.open("/dashboard/", "_self");
	}
    //Function To Update contributors list Details
	function update_data(id) {
        var form=$("#formObj");
        $("#empid").val(id);
        $.ajax({
            type:"POST",
            url:'/reportUpdate.php',
            data:form.serialize(),
            success: function(response){
                if(response.success == true){ // if true (1)
                  setTimeout(function(){// wait for 5 secs(2)
                       location.reload(); // then reload the page.(3)
                  }, 10000);
               }
            }
        });
	}
</script>
<?php global $wpdb;
    $current_user = wp_get_current_user();
    $org_name = $wpdb->get_results ( "SELECT `organization` FROM  uptron_contributor_list where `userid` LIKE '%". $current_user->user_login . "%' LIMIT 1" );
    $result = $wpdb->get_results ( "SELECT * FROM  uptron_contributor_reports where `userid` LIKE '%".$current_user->user_login );
    $totalemployee = $wpdb->get_var("SELECT COUNT(*) FROM uptron_contributor_reports where `userid` LIKE '%".$current_user->user_login . "%' LIMIT 1" );
    if ($totalemployee=="0"){ ?>
        <div style="text-align:center;">
            <h1>e-Office Users Status in <?php echo $current_user->display_name; ?></h1>
        </div>
        <style type="text/css">
            .box {
                padding: 20px;
                display: none;
                margin-top: 20px;
            }

            .red {
                background: #ff0000;
            }

            .green {
                background: #228B22;
            }

            .blue {
                background: #0000ff;
            }

            label {
                margin-right: 15px;
            }
        </style>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('input[type="radio"]').click(function(){
                    var inputValue = $(this).attr("value");
                    var targetBox = $("." + inputValue);
                    $(".box").not(targetBox).hide();
                    $(targetBox).show();
                });
            });
        </script>
        <div align="center">
            <label><input type="radio" name="lavel" value="district-lavel">District/DESTO User Only &nbsp;</label>
            <label><input type="radio" name="lavel" value="directorate-lavel">Directorate User Only</label>
        </div>
        <div class="district-lavel box">
        <form class="form" action="" id="contact" method='POST' enctype="multipart/form-data" onsubmit="return validateform()">
          <input type="hidden" name="action" value="signUpDone" />
           <div align="center">
            <table style="width:60%; border: 1px solid #DDD !important;">
                <tr>
                    <td style="width:50%;"><strong>District Name</strong></td>
                    <td><input type="text" name="districtname" style="width:100%;" value="<?php echo $current_user->display_name; ?>"/></td>
                </tr>
                <tr>
                    <td><strong>Number Of Departments</strong></td>
                    <td><input type="text" name="numberofdepartments" style="width:100%;" /></td>
                </tr>
                <tr>
                    <td><strong>Number Of Offices</strong></td>
                    <td><input type="text" name="numberofoffices" style="width:100%;" /></td>
                </tr>
                <tr>
                    <td><strong>Total Number of e-Office Users</strong></td>
                    <td><input type="text" name="numberofusers" style="width:100%;" /></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <input type="submit" value="Submit"/>&nbsp;
                        <input type="reset" value="Reset"/>&nbsp;
                        <input type="reset" value="Cancel" onclick="window.location='/dashboard/';"/>
                    </td>
                </tr>
            </table>
            </div>
        </form>
        </div>
        <div class="directorate-lavel box">
        <form class="form" action="" id="contact" method='POST' enctype="multipart/form-data" onsubmit="return validateform()">
          <input type="hidden" name="action1" value="signUpDone" />
           <div align="center">
            <table style="width:60%; border: 1px solid #DDD !important;">
                <tr>
                    <td><strong>Department/Directorate Name</strong></td>
                    <td><input type="text" name="departmentname" style="width:100%;" value="<?php echo $current_user->display_name; ?>"/></td>
                </tr>
                <tr>
                    <td><strong>Number Of Offices</strong></td>
                    <td><input type="text" name="numberofoffices" style="width:100%;" /></td>
                </tr>
                <tr>
                    <td><strong>Total Number of e-Office Users</strong></td>
                    <td><input type="text" name="numberofusers" style="width:100%;" /></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <input type="submit" value="Submit"/>&nbsp;
                        <input type="reset" value="Reset"/>&nbsp;
                        <input type="reset" value="Cancel" onclick="window.location='/dashboard/';"/>
                    </td>
                </tr>
            </table>
            </div>
        </form>
        </div>
<?php

if(isset($_POST['action']))
{
    if($_POST['districtname']=='' or $_POST['numberofoffices']=='' or $_POST['numberofusers']=='')
    {
        echo("<script>alert('Fill All the * fields')</script>");
        exit();
    }
    else
    {
        $current_user = wp_get_current_user();
        $userid = $current_user->user_login;
        $district_name = $_POST['districtname'];
        $department_numbers = $_POST['numberofdepartments'];
        $department_name = "NA";
        $offices_numbers = $_POST['numberofoffices'];
        $users_numbers = $_POST['numberofusers'];
        $contributor_name = $current_user->display_name;


        $table_name = $wpdb->prefix . "contributor_reports";
        $wpdb->insert($table_name, array('userid' => $userid, 'district_name' => $district_name, 'department_numbers' => $department_numbers, 'department_name' => $department_name, 'offices_numbers' => $offices_numbers, 'users_numbers' => $users_numbers, 'contributor_name' => $contributor_name) );
        header('location:/e-office-users-status/');
        die;
    }
}

if(isset($_POST['action1']))
{
    if($_POST['departmentname']=='' or $_POST['numberofoffices']=='' or $_POST['numberofusers']=='')
    {
        echo("<script>alert('Fill All the * fields')</script>");
    }
    else
    {
        $current_user = wp_get_current_user();
        $userid = $current_user->user_login;
        $district_name = "NA";
        $department_numbers = "0";
        $department_name = $_POST['departmentname'];
        $offices_numbers = $_POST['numberofoffices'];
        $users_numbers = $_POST['numberofusers'];
        $contributor_name = $current_user->display_name;


        $table_name = $wpdb->prefix . "contributor_reports";
        $wpdb->insert($table_name, array('userid' => $userid, 'district_name' => $district_name, 'department_numbers' => $department_numbers, 'department_name' => $department_name, 'offices_numbers' => $offices_numbers, 'users_numbers' => $users_numbers, 'contributor_name' => $contributor_name) );
        header('location:/e-office-users-status/');
        die;
    }
}
?>
    <?php }else{ ?>
        <div style="text-align:center;">
            <h1>e-Office Users Status in <?php echo $current_user->display_name; ?></h1>
        </div>
        <div align="center">
           <?php global $wpdb;
                $result = $wpdb->get_results ( "SELECT * FROM  uptron_contributor_reports where `userid` LIKE '%". $current_user->user_login ."%' " );
            foreach ( $result as $page )
            {
            echo '<table style="width:60%; border: 1px solid #DDD !important;">
                <tr>
                    <td style="width:50%;"><strong>District Name</strong></td>
                    <td>'.$page->district_name.'</td>
                </tr>
                <tr>
                    <td><strong>Department/Directorate Office Name</strong></td>
                    <td>'.$page->department_name.'</td>
                </tr>
                <tr>
                    <td><strong>Number Of Departments</strong></td>
                    <td>'.$page->department_numbers.'</td>
                </tr>
                <tr>
                    <td><strong>Number Of Offices</strong></td>
                    <td>'.$page->offices_numbers.'</td>
                </tr>
                <tr>
                    <td><strong>Numbers Of e-Office Users</strong></td>
                    <td>'.$page->users_numbers.'</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="button" name='.$page->id.' id="popup" onclick=div_show('.$page->id.') value="EDIT" style="width: 20%;">&nbsp;
                        <input type="button" name='.$page->id.' id="popup" onclick=cancel() value="CANCEL" style="width: 20%;"></td>
                </tr>
            </table>';
              }  ?>
        </div>
    <?php }
?>
<div id="abc">
	<div id="popupContact"></div>
</div>
<?php } ?>
</div><!-- Contributor Dashboard End -->
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
