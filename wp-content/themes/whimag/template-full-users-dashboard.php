<?php
/*
Template Name: Dashboard
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
<div><!-- ***** Editor Dashboard Start -->
<?php if( current_user_can('editor') || current_user_can('administrator') ) { ?>
<?php if ( !is_user_logged_in() ) {
wp_redirect( '/login/?reauth=1' );
    exit;
} ?>
<style>
    #newsbox{
        display: block;
    }
    #leftsidebar{
        width: 100%;
        padding: 5px 0;
        border: 0px solid #D7D7D7;
        font-family: 'Droid Sans', sans-serif !important;
        font-size: 14px !important;
        color:beige;
    }
    .leftsidetd{
        background-color: #333;
        text-align: center !important;
    }
    .leftsidetd:hover{
        background-color: #a90329;
    }
    .leftsidetd a{
        color:beige;
        text-decoration: none !important;
    }
    #maincontent{
        width: 100%;
        color:#444;
        padding: 5px 0;
        font-family: 'Droid Sans', sans-serif !important;
        font-size: 14px !important;
    }
    #lowerside{
        background: #111;
        padding: 10px;
        font-family: 'Droid Sans', sans-serif !important;
        font-size: 14px !important;
    }
    table tr th{
        border: 1px solid #ddd;
        font-size: .9em;
    }
    table tr td{
        border: 1px solid #ddd;
    }
    #abc {width:100%;height:100%;top:0;left:0;display:none;position:fixed;background-color:#313131;overflow:auto}
	img#close {	position:absolute;right:-14px;top:-14px;cursor:pointer}
	div#popupContact {position:absolute;left:50%;top:5%;margin-left:-202px;font-family:'Raleway',sans-serif}
	.popupForm {min-width:250px;padding:10px 50px;border:2px solid gray;border-radius:10px;font-family:raleway;background-color:#fff}
    input#popup {text-decoration: none !important; background: linear-gradient(to bottom, #a90329 0%,#8f0222 44%,#6d0019 100%); color: #ccc; border: 2px solid #444; padding: 5px; cursor: pointer; border-radius: 5px;}
    input#popup:hover {color: #fff; border: 2px solid #444; padding: 5px; cursor: pointer; border-radius: 5px;}
	hr {margin:10px -50px;border:0;border-top:1px solid #ccc}
	input[type=text] {width: 82%;padding: 5px;margin-top: 5px;border: 1px solid #ccc;padding-left: 40px; font-family: raleway;}
    button {text-decoration: none !important; color: white; background: linear-gradient(to bottom, #a90329 0%,#8f0222 44%,#6d0019 100%);
</style>
<div style="text-align:center;"><h1>Welcome Alok !</h1></div>
<div id="newsbox" class="newsbox">
    <div id="leftsidebar" class="leftsidebar">
        <table style="width:100%; margin: 0 0 0 0;">
            <tr>
                <td class="leftsidetd" id="leftsidetd"><a href="?superusers=superusers"><strong>Administrators</strong></a></td>
                <td class="leftsidetd" id="leftsidetd"><a href="?orgnizations=orgnizations"><strong>Orgnizations</strong></a></td>
                <td class="leftsidetd" id="leftsidetd"><a href="?employees=employees"><strong>All Employees</strong></a></td>
                <td class="leftsidetd" id="leftsidetd"><a href="?news=news"><strong>Important News</strong></a></td>
            </tr>
        </table>
    </div>
    <div id="maincontent" class="maincontent">
        <div class="" id="">
            <?php
                $i=1;
                if(isset($_GET['superusers'])){ ?>
                <div style="background-color: #EAEAEA; border: 1px solid #D8D8D8; padding: 5px 0 5px 10px; margin: 0 0 10px 0;"><strong>Administrator Users</strong></div>
                <table>
                    <tbody>
                       <tr>
                           <th><strong>S.N.</strong></th>
                           <th><strong>Name</strong></th>
                           <th><strong>eMail</strong></th>
                           <th><strong>Nice Name</strong></th>
                       </tr>
                        <?php
                            $users = get_users('role=author');
                            foreach($users as $page){
                                echo '</tr>
                                    <td>'.$i++.'</td>
                                    <td>'.$page->display_name.'</td>
                                    <td>'.$page->user_email.'</td>
                                    <td>'.$page->user_nicename.'</td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
        <?php }
        ?>
        </div>
        <div class="" id="">
            <?php
                $i=1;
                if(isset($_GET['orgnizations'])){ ?>
                <div style="background-color: #EAEAEA; border: 1px solid #D8D8D8; padding: 5px 0 5px 10px; margin: 0 0 10px 0;"><strong>Orgnization Details</strong>
                <div style="float:right;"><button value="NEW" onclick=addEvent()>NEW</button>&nbsp;&nbsp;&nbsp;</div>
                </div>
                <table>
                    <tbody>
                       <tr>
                           <th><strong>S.N.</strong></th>
                           <th><strong>Name</strong></th>
                           <th><strong>eMail</strong></th>
                           <th><strong>Nice Name</strong></th>
                       </tr>
                        <?php
                            $users = get_users('role=contributor');
                            foreach($users as $page){
                                echo '<tr>
                                    <td>'.$i++.'</td>
                                    <td>'.$page->display_name.'</td>
                                    <td>'.$page->user_email.'</td>
                                    <td>'.$page->user_nicename.'</td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
            <?php }
            ?>
        </div>
        <div class="" id="">
            <?php
                if(isset($_GET['employees'])){ ?>
                <div style="background-color: #EAEAEA; border: 1px solid #D8D8D8; padding: 5px 0 5px 10px; margin: 0 0 10px 0;"><strong>Total Uttar Pradesh Employees (<?php echo $wpdb->get_var("SELECT COUNT(*) FROM uptron_contributor_list"); ?>)</strong></div>
                <table>
                    <tbody>
                       <tr>
                           <th><strong>S.N.</strong></th>
                           <th><strong>Name (Designation)</strong></th>
                           <th><strong>Orgnization Detail</strong></th>
                           <th><strong>Other Details</strong></th>
                        </tr>
                        <?php global $wpdb;
                            $page = $_GET['pageno'];
                            if($page=="" || $page=="1"){
                                $page1=0;
                                $i=1;
                            }else{
                                $page1=($page*100)-100;
                                $i=($page*100-100)+1;
                            }
                            $users = $wpdb->get_results("SELECT * FROM uptron_contributor_list limit $page1,100");
                            foreach($users as $page){
                                echo '<tr>
                                    <td style="font-size: 70%; text-align: center;">'.$i++.'</td>
                                    <td style="font-size: 70%;"><a href="'.$page->email_id.'">'.$page->name.'<br></a>('.$page->post_name.')</td>
                                    <td style="font-size: 70%; width:41%;">'.$page->organization.'<br><strong>Department:</strong>'.$page->department_name.'<br><strong>Office Name: </strong>'.$page->main_org.'</td>
                                    <td style="font-size: 70%;width: 18%"><strong>Adhar: </strong>'.$page->aadhaar_number.'<br><strong>Mobile: </strong>'.$page->mobile_number.'<br><strong>Other: </strong>'.$page->cug_number.'</td>
                                    </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            <?php
                $res=$wpdb->get_var("SELECT COUNT(*) FROM uptron_contributor_list");
                $a=$res/100;
                $a=ceil($a);
                for($b=1;$b<=$a;$b++){
                    ?><a href="?employees=employees&pageno=<?php echo $b; ?>" style="text-decoration:none !important;"><?php echo $b." "; ?></a><?php
                }
             }
            ?>
        </div>
        <div class="" id="">
            <?php
                if(isset($_GET['news'])){ ?>
                <div style="background-color: #EAEAEA; border: 1px solid #D8D8D8; padding: 5px 0 5px 10px; margin: 0 0 10px 0;"><strong>Notice Board Content</strong>
                <div style="float:right;"><button value="NEW" onclick=addEvent()>NEW</button>&nbsp;&nbsp;&nbsp;</div>
                </div>
                <table>
                    <tbody>
                       <tr>
                           <th><strong>S.N.</strong></th>
                           <th><strong>Title</strong></th>
                           <th><strong>Attached Data</strong></th>
                           <th><strong>Date</strong></th>
                        </tr>
                        <?php global $wpdb;
                            $i=1;
                            $news = $wpdb->get_results("SELECT * FROM uptron_notice_board");
                            foreach($news as $page){
                                echo '<tr>
                                        <td>'.$i++.'</td>
                                        <td><a href="'.$page->id.'">'.$page->title.'</td>
                                        <td><a href="/images/attachment/'.$page->attachment.'">'.$page->attachment.'</a></td>
                                        <td>'.$page->postdate.'</td>
                                    </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            <script>
                function addEvent(){
                    document.getElementById('abc').style.display = "block";
                };
                //Function to Hide Popup
                function div_hide(){
                    document.getElementById('abc').style.display = "none";
                };
            </script>
            <div id="abc">
                <div id="popupContact">
                <form method="post" name="form" class="popupForm" enctype="multipart/form-data" onsubmit="return validateform()">
                    <input type="hidden" name="action" value="signUpDone" />
                    <img id="close" src="/images/3.png" onclick ="div_hide()">
                    <div style="text-align:center"><h2>Add News Events</h2></div>
			        <hr>
                    <table>
                        <tr>
                            <td>Title</td>
                            <td>
                                <input id="title" name="title" type="text"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Content</td>
                            <td>
                                <textarea id="content" name="content" style="margin: 0px;width: 254px;height: 148px;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Attachment</td>
                            <td>
                                <input id="attachment" name="attachment" type="file" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center">
                                <input id="submit" type="submit">
                            </td>
                        </tr>
                    </table>
                </form>
                <?php global $wpdb;
                    if(isset($_POST["action"])){
                        $title = $_POST['title'];
                        $content = $_POST['content'];
                        $attachment_name = $_FILES['attachment']['name'];
                        $attachment_type = $_FILES['attachment']['type'];
                        $attachment_size = $_FILES['attachment']['size'];
                        $attachment_tmp = $_FILES['attachment']['tmp_name'];
                        $eventdate = date('Y-m-d');

                        if($title=='' or $content=='')
                        {
                            echo("<script>alert('Fill All The firelds')</script>");
                            exit();
                        }else{
                            if($attachment_type=="image/jpeg" or $attachment_type=="image/jpg" or $attachment_type=="image/png" or $attachment_type=="image/gif")
                        {
                            if($attachment_size<=100000)
                            {
                                move_uploaded_file($attachment_tmp,"/images/attachment/$attachment_name");
                            }
                            else
                            {
                                echo("<script>alert('Larger Image, Only 100 kb file size is valid.')</script>");
                            }
                        }
                        else
                        {
                            echo("<script>alert('Invalid file type.')</script>");
                        }
                            $wpdb->insert('uptron_notice_board',array(
                                'title' => $title,
                                'content' => $content,
                                'attachment' => $attachment_name,
                                'postdate' => $eventdate
                            ));
                            header('location:/dashboard/?news=news');
                            die;
                        }
                    }
                ?>
                </div>
            </div>
            <?php }
            ?>
        </div>
    </div>
</div>

<?php  } ?>
</div><!-- Editor Dashboard End -->
<div><!-- Author Dashboard Start -->
<?php if( current_user_can('author') || current_user_can('administrator') ) {  ?>
<?php
if ( !is_user_logged_in() ) {
wp_redirect( '/login/?reauth=1' );
    exit;
}
?>
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
	};
    function myFunction1() {
	  // Declare variables
	  var input, filter, table, tr, td, i;
	  input = document.getElementById("myInput1");
	  filter = input.value.toUpperCase();
	  table = document.getElementById("myTable1");
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="/pdf/tableExport.js"></script>
<script type="text/javascript" src="/pdf/jquery.base64.js"></script>
<script type="text/javascript" src="/pdf/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="/pdf/jspdf/jspdf.js"></script>
<script type="text/javascript" src="/pdf/jspdf/libs/base64.js"></script>
<script>
    function printtopdf(){$('#myTable1').tableExport({type:'pdf', escape:'false'}); };
    function printtoxls(){ $('#myTable1').tableExport({ type:'excel', escape:'false' }); };
    function printtodoc(){ $('#myTable1').tableExport({ type:'doc', escape:'false' }); };
</script>
<script>
    function demoFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        source = $('#myTable1')[0];

        // we support special element handlers. Register them with jQuery-style
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function(element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },
            function(dispose) {
                // dispose: object with X, Y of the last line add to the PDF
                //          this allow the insertion of new lines after html
                pdf.save('Test.pdf');
            }, margins);
    }
</script>
<!--<div style="width:94%;"><f2 style="font-size: 25px; font-weight: bolder; padding-right: 15px;">Please Select Orgnization</f2></div>-->
<div style="float:left;width:25%;">
<?php global $wpdb;
$contributors = get_users('role=contributor');
$i=1;
echo '<div style="width:100%;"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Orgnization"></div>
      <div style="width:100%;" align="left">
      <table id="myTable"><thead><tr class="header"><th>S.No.</th><th>Name</th></tr></thead>';
foreach ( $contributors as $page )
{
	$contributorNo = $wpdb->get_var("SELECT COUNT(*) FROM uptron_contributor_list where main_org = '$page->display_name'");
    echo '<tr><td style="text-align:center; width: 26px;">'.$i++.'</td><td><a id="contriname" href="index.php?display-name='.$page->display_name.'">'.$page->display_name.'</a>&nbsp;('.$contributorNo.')</td></tr>';
}
echo '</table>
      </div>
      </div>';

 function runMyFunction() { global $wpdb; $contributerid = $_GET['display-name']; $i=1; $result = $wpdb->get_results ( "SELECT * FROM `uptron_contributor_list` WHERE `main_org` = '$contributerid'" );
echo '
<div style="float:right;width:74%">
<div>
<div style="width: 80%;float: left;"><input style="width: 100%;" type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Search Employee"></div>
<div style="float: right;"><img src="https://cdn1.iconfinder.com/data/icons/application-file-formats/128/adobe-pdf-128.png" onClick=printtopdf(); style="height: 24px; width: 24px;" />&nbsp; <img src="https://cdn1.iconfinder.com/data/icons/application-file-formats/128/microsoft-excel-128.png" onClick=printtoxls(); style="height: 24px; width: 24px;" /></div>
</div>
<div style="clear:both;"><h2>'.$contributerid.'</h2></div>
<table id="myTable1">
    <thead>
        <tr class="header">
            <th>S.No.</th>
            <th>Name</th>
            <th>Department</th>
            <th>Designation</th>
            <th>Contact No</th>
        </tr>
    </thead>'; foreach( $result as $page ) { echo '
    <tr>
        <td style="text-align:center; width: 26px;">'.$i++.'</td>
        <td>'.$page->name.'</td>
        <td>'.$page->department_name.'</td>
        <td>'.$page->post_name.'</td>
        <td>'.$page->cug_number.'</td>
    </tr>'; } echo '</table>';
} if (isset($_GET['display-name'])) { runMyFunction(); }
?>
<style type="text/css">
	#myInput, #myInput1 {
		background-image: url('https://www.w3schools.com/css/searchicon.png');
		background-position: 10px 12px;
		background-repeat: no-repeat; /* Do not repeat the icon image */
		width: 77%; /* Full-width */
		padding: 12px 20px 12px 40px; /* Add some padding */
		border: 1px solid #ddd; /* Add a grey border */
		margin-bottom: 12px; /* Add some space below the input */
	}
	#myTable { border-collapse: collapse; width: 100%; border: 1px solid #ddd; }
	#myTable th, #myTable td { text-align: left; padding: 12px; }
	#myTable tr { border-bottom: 1px solid #ddd; }
	#myTable tr.header, #myTable tr:hover {	background-color: #f1f1f1;}
    #myTable1 { border-collapse: collapse; width: 100%; border: 1px solid #ddd; }
	#myTable1 th, #myTable1 td { text-align: left; padding: 12px; }
	#myTable1 tr { border-bottom: 1px solid #ddd; }
	#myTable1 tr.header, #myTable1 tr:hover {	background-color: #f1f1f1;}
</style>
</div>
<?php } ?>
</div><!-- Author Dashboard End -->
<div><!-- Contributor Dashboard Start -->
<?php if( current_user_can('contributor') || current_user_can('administrator') ) {  ?>

<?php
if ( !is_user_logged_in() ) {
wp_redirect( '/login/?reauth=1' );
    exit;
}
?>
<style type="text/css">
    .table1 {border-radius: 5px;}
	.table1 tr th {text-align: center;font-size: smaller;vertical-align: middle; border:1px solid #ccc !important; color: #a90329;}
	.table1 tbody tr td { text-align: center; vertical-align: middle; padding: 3px; border:1px solid #ccc !important; }
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
    $page = $_GET['pageno'];
    if($page=="" || $page=="1"){
        $page1=0;
        $i=1;
    }else{
        $page1=($page*100)-100;
        $i=($page*100-100)+1;
    }
    $current_user = wp_get_current_user();
    $org_name = $wpdb->get_results ( "SELECT `organization` FROM  uptron_contributor_list where `userid` LIKE '%". $current_user->user_login . "%' LIMIT 1" );
    $result = $wpdb->get_results ( "SELECT * FROM  uptron_contributor_list where `userid` LIKE '%". $current_user->user_login ."%' LIMIT $page1,100" );
    $totalemployee = $wpdb->get_var("SELECT COUNT(*) FROM uptron_contributor_list where `userid` LIKE '%". $current_user->user_login ."%'");
?>
<div style="width:100%;">
	<div style="float: left;">
		<h2><?php echo $current_user->display_name; ?>&nbsp;(<?php echo $totalemployee; ?>)</h2>
	</div>
	<div style="float: right;">
		<a href="/add-new-employee-detail/" id="onclick" class="add-employee-button" style="text-decoration: none !important;">Add Employee</a>
	</div>
</div>
<table class="table1" border="0" cellspacing="2" cellpadding="2">
	<thead>
		<tr>
			<th><b>SN</b></th>
			<th><b>Name</b></th>
			<th><b>Deparment</b></th>
			<th><b>Office Name</b></th>
			<th><b>Designation</b></th>
            <th><b>Contact No.</b></th>
			<th><b>eMail</b></th>
            <th><b>Action</b></th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ( $result as $page )
{
	echo '<tr>
		<td>'.$i++.'</td>
		<td><a href="#" style="text-decoration:none !important" onclick=div_employee_show('.$page->id.')>'.$page->name.'</a></td>
		<td>'.$page->department_name.'</td>
		<td>'.$page->organization.'</td>
		<td>'.$page->post_name.'</td>
        <td>'.$page->mobile_number.'<br>'.$page->cug_number.'</td>
		<td><a href="mailto:'.$page->email_id.'" style="text-decoration:none !important" target="_top">'.$page->email_id.'</a></td>
		<td><input type="button" name='.$page->id.' id="popup" onclick=div_show('.$page->id.') value="Edit"></td>
	</tr>';
}?>
	</tbody>
</table>
Page =>
<?php
    $a=$totalemployee/100;
    $a=ceil($a);
    for($b=1;$b<=$a;$b++){ ?>
        <a href="?pageno=<?php echo $b; ?>" style="text-decoration:none !important;"><?php echo $b." "; ?></a>
    <?php } ?>
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
