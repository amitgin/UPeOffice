<?php include('wp-config.php'); ?>
<?php global $wpdb;
	$goid = $_GET['id'];
	$gotitle = $wpdb->get_results ( "SELECT title FROM  uptron_notice_board where id=".$goid );

?>
	<form id="formObj" method="post" name="form" class="popupForm">
            <input type="hidden" name="action" />
            <img id="close" src="/images/3.png" onclick ="div_hide()">
			<div style="text-align:center"><h2>Edit or Delete Employee <?php echo $goid; ?></h2></div>
			<hr>
            <input id="empid" name="empid" type="hidden" >
            <table>
            <tr>
                <td><label>Employee Name: <span>*</span></label></td>
                <td><input id="name" name="empname" type="text" value="'.$page->name.'"></td>
            </tr>
            <tr>
                <td><label>Department Name: <span>*</span></label></td>
                <td><input id="department_name" name="depname" type="text" value="'.$page->department_name.'"></td>
            </tr>
            <tr>
                <td><label>Office Name: <span>*</span></label></td>
                <td><input id="organization" name="orgname" value="'.$page->organization.'" type="text"></td>
            </tr>
            <tr>
                <td><label>Designation: <span>*</span></label></td>
                <td><input id="post_name" name="postname" value="'.$page->post_name.'" type="text"></td>
            </tr>
            <tr>
                <td><label>Digital Signature: <span>*</span></label></td>
                <td>
                    <input type="radio" name="digsign" value="Yes"> Yes
                    <input type="radio" name="digsign" value="No"> No
                </td>
            </tr>
            <tr>
                <td><label>Aadhar No: <span>*</span></label></td>
                <td><input id="aadhaar_number" name="aadhaarnum" value="'.$page->aadhaar_number.'" type="text"></td>
            </tr>
            <tr>
                <td><label>Aadhar Linked No: <span>*</span></label></td>
                <td><input id="mobile_number" name="mobilenum" value="'.$page->mobile_number.'" type="text"></td>
            </tr>
            <tr>
                <td><label>Other No: <span>*</span></label></td>
                <td><input id="cug_number" name="cugnum" value="'.$page->cug_number.'" type="text"></td>
            </tr>
            <tr>
                <td><label>eMail: <span>*</span></label></td>
                <td><input id="email_id" name="emailid" value="'.$page->email_id.'" type="text"></td>
            </tr>
            <tr>
                <td><label>Is employee has ?: </label></td>
                <td>
                    <input type="checkbox" name="computer" value="Computer," '.$pc.'>Computer
                    <input type="checkbox" name="scanner" value="Scanner," '.$sc.'>Scanner
                    <input type="checkbox" name="internet" value="Internet" '.$int.'>Internet
                </td>
            </tr>
            </table>
			<div style="text-align: center; height: 40px;padding-top: 13px;">
				<button onclick="update_data('.$page->id.')" id="submit">Update</button>
				<button onclick="delete_data('.$page->id.')" id="submit">Delete</button>
				<button onclick="div_hide()" id="submit">Cancel</button>
			</div>
		</form>
