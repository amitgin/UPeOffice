<?php include('wp-config.php'); ?>
<?php

if(isset($_POST['action'])){

    $current_user = wp_get_current_user();
	$userid = $current_user->user_login;
    $empid = $_POST['empid'];
    $empname = $_POST['empname'];
    $depname = $_POST['depname'];
    $orgname = $_POST['orgname'];
    $postname = $_POST['postname'];
    $digsign = $_POST['digsign'];
    $aadhaarnum = $_POST['aadhaarnum'];
    $mobilenum = $_POST['mobilenum'];
    $cugnum = $_POST['cugnum'];
    $emailid = $_POST['emailid'];
    $computer = $_POST['computer'];
    $scanner = $_POST['scanner'];
    $internet = $_POST['internet'];

    $sql ="UPDATE `uptron_contributor_list` SET `userid` = '$userid', `organization` = '$orgname', `department_name` = '$depname', `name` = '$empname', `post_name` = '$postname', `digsign`='$digsign', `aadhaar_number` = '$aadhaarnum', `mobile_number` = '$mobilenum', `cug_number` = '$cugnum', `email_id` = '$emailid', `computer` = '$computer', `scanner` = '$scanner', `internet` = '$internet' WHERE `uptron_contributor_list`.`id` = '$empid'";
    $rez = $wpdb->query($sql);
    header('location:/contributor-dashboard/');
    die;
    }
?>
