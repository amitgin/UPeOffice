<?php include('wp-config.php'); ?>
<?php
	global $wpdb;
	$report_id = $_GET['id'];
	$userinfo = $wpdb->get_results ( "SELECT * FROM  uptron_contributor_reports where id=".$report_id );

	foreach ($userinfo as $page){
        if($page->department_name=="NA"){$depreadonly ="readonly";}
        if($page->district_name=="NA"){$disreadonly ="readonly";}
        if($page->department_numbers=="NA"){$depnumreadonly ="readonly";}
	echo '<form id="formObj" method="post" name="form" class="popupForm">
            <input type="hidden" name="action" />
            <img id="close" src="/images/3.png" onclick ="div_hide()">
			<div style="text-align:center"><h2>Edit Report</h2></div>
			<hr>
            <input id="empid" name="empid" type="hidden" >
            <table>
            <tr>
                <td><label>District Name: <span>*</span></label></td>
                <td><input id="name" name="districtname" type="text" value="'.$page->district_name.'" '.$disreadonly.'></td>
            </tr>
            <tr>
                <td><label>Department/Directorate Office Name: <span>*</span></td>
                <td><input id="department_name" name="departmentname" type="text" value="'.$page->department_name.'" '.$depreadonly.'></td>
            </tr>
            <tr>
                <td><label>Number of Departments: <span>*</span></td>
                <td><input id="organization" name="departmentnumbers" value="'.$page->department_numbers.'" type="text" '.$depnumreadonly.'></td>
            </tr>
            <tr>
                <td><label>Number Of Offices: <span>*</span></td>
                <td><input id="post_name" name="officenumbers" value="'.$page->offices_numbers.'" type="text"></td>
            </tr>
            <tr>
                <td><label>Numbers of e-Office Users: <span>*</span></label></td>
                <td><input id="aadhaar_number" name="usersnumbers" value="'.$page->users_numbers.'" type="text"></td>
            </tr>
            </table>
			<div style="text-align: center; height: 40px; padding-top: 10px;">
				<button onclick="update_data('.$page->id.')" id="submit">Update</button>
				<button onclick="div_hide()" id="submit">Cancel</button>
			</div>
		</form>';
		}
?>
