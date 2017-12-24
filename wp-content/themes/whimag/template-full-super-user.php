<?php
/*
Template Name: Super User Dashboard
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
