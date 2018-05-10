<?php include('wp-config.php'); ?>
<?php

if(isset($_POST['action'])){

    $report_id = $_POST['empid'];
    $district_name = $_POST['districtname'];
    $department_name = $_POST['departmentname'];
    $department_numbers = $_POST['departmentnumbers'];
    $offices_numbers = $_POST['officenumbers'];
    $users_numbers = $_POST['usersnumbers'];

    $sql ="UPDATE `uptron_contributor_reports` SET `district_name` = '$district_name', `department_name` = '$department_name', `department_numbers` = '$department_numbers', `offices_numbers` = '$offices_numbers', `users_numbers`='$users_numbers' WHERE `uptron_contributor_reports`.`id` = '$report_id'";
    $rez = $wpdb->query($sql);
    }
?>
