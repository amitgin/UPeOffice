<?php include('wp-config.php'); ?>
<ul>
<?php global $wpdb;
$user = wp_get_current_user();
$userid = $user->user_login;
$qr = $wpdb->get_results("SELECT * FROM uptron_contributor_list WHERE userid=".$userid."GROUP BY department_name");
foreach($qr as $page){
    echo "<li>".$page->department_name."</li>";
}
?>
</ul>
