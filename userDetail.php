<?php include('wp-config.php'); ?>
<?php
	global $wpdb;
	$userinfo_id = $_GET['id'];
	$userinfo = $wpdb->get_results ( "SELECT * FROM  uptron_contributor_list where id=".$userinfo_id );
	foreach ($userinfo as $page)
	{
	echo '<form id="formObj" method="post" name="form" class="popupForm">
            <input type="hidden" name="action" />
            <img id="close" src="/images/3.png" onclick ="div_hide()">
			<div style="text-align: center; height: 40px;padding-top: 13px;"><h2>Employee Detail</h2></div>
			<hr>
            <input id="empid" name="empid" type="hidden" >
            <table>
            <tr>
                <td><label>Name: <span>*</span></label></td>
                <td>'.$page->name.'</td>
            </tr>
            <tr>
                <td><label>Department : <span>*</span></td>
                <td>'.$page->department_name.'</td>
            </tr>
            <tr>
                <td><label>Office : <span>*</span></td>
                <td>'.$page->organization.'</td>
            </tr>
            <tr>
                <td><label>Designation : <span>*</span></td>
                <td>'.$page->post_name.'</td>
            </tr>
            <tr>
                <td><label>Digital Signature : <span>*</span></label></td>
                <td>'.$page->digsign.'</td>
            </tr>
            <tr>
                <td><label>Aadhar No : <span>*</span></label></td>
                <td>'.$page->aadhaar_number.'</td>
            </tr>
            <tr>
                <td><label>Aadhar Linked No : <span>*</span></label></td>
                <td>'.$page->mobile_number.'</td>
            </tr>
            <tr>
                <td><label>Other No : <span>*</span></label></td>
                <td>'.$page->cug_number.'</td>
            </tr>
            <tr>
                <td><label>eMail : <span>*</span></label></td>
                <td>'.$page->email_id.'</td>
            </tr>
            <tr>
                <td><label>Hardwares : <span>*</span></label></td>
                <td>'.$page->computer.'&nbsp;'.$page->scanner.'&nbsp;'.$page->internet.'</td>
            </tr>
            </table>
			<div style="text-align: center; height: 40px;padding-top: 13px;">
				<button onclick="div_hide()">Back</button>
			</div>
		</form>';
		}
?>
