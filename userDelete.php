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

    $sql ="DELETE FROM `uptron_contributor_list` WHERE `uptron_contributor_list`.`id` = '$empid'";
    $rez = $wpdb->query($sql);
}
?>
