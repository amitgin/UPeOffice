<?php
/*
Template Name: Important News
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
<style>
    #newsbox{
        display: flex;
    }
    #leftsidebar{
        width: 20%;
        padding: 10px;
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
        width: 80%;
        color:#444;
        padding: 10px;
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
</style>
<div id="newsbox" class="newsbox">
    <div id="leftsidebar" class="leftsidebar">
        <table style="width:100%;">
            <tr>
                <td class="leftsidetd" id="leftsidetd"><a href="?govt=govt">Important GO's</a></td>
            </tr>
            <tr>
                <td class="leftsidetd" id="leftsidetd"><a href="index.php?citizen-services=citizen-services">Citizen Services</a></td>
            </tr>
            <tr>
                <td class="leftsidetd" id="leftsidetd"><a href="index.php?imp-links=imp-links">Important Links</a></td>
            </tr>
            <tr>
                <td class="leftsidetd" id="leftsidetd"><a href="index.php?imp-guidelines=imp-guidelines">Important Guidelines</a></td>
            </tr>
        </table>
    </div>
    <div id="maincontent" class="maincontent">
        <div class="" id="">
            <?php
            if(isset($_GET['govt'])){
                ?>
                <div style="background-color: #EAEAEA; border: 1px solid #D8D8D8; padding: 5px 0 5px 10px; margin: 0 0 10px 0;"><strong>Important GO's</strong>
                <div style="float:right;">
                    <?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
                        <?php
                        if ( !is_user_logged_in() ) {
                            exit;
                        }else{  ?>
                           <!--  Web Font Loader  -->
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                            <button onClick=addgo() id="addgo">Add <i class="fa fa-plus-square" style="color:red"></i></button>
                            <script>
                                function addgo(){
                                    document.getElementById('abc').style.display = "block";
                                }
                                function div_hide(){
                                    document.getElementById('abc').style.display = "none";
                                }
                                function goadded(){
                                    alert("Under Process ! Plaese try again after getting notification from Site Admin.");
                                }
                            </script>
                            <style>
                            #abc {width:100%;height:100%;top:0;left:0;display:none;position:fixed;background-color:#313131;overflow:auto}
                            img#close {	position:absolute;right:-14px;top:-14px;cursor:pointer}
                            div#popupContact {position:absolute;left:50%;top:5%;margin-left:-202px;font-family:'Raleway',sans-serif}
                            .popupForm {min-width:250px;padding:10px 50px;border:2px solid gray;border-radius:10px;font-family:raleway;background-color:#fff}
                            input#popup {text-decoration: none !important; background: linear-gradient(to bottom, #a90329 0%,#8f0222 44%,#6d0019 100%); color: #ccc; border: 2px solid #444; padding: 5px; cursor: pointer; border-radius: 5px;}
                            input#popup:hover {color: #fff; border: 2px solid #444; padding: 5px; cursor: pointer; border-radius: 5px;}
                            hr {margin:10px -50px;border:0;border-top:1px solid #ccc}
                            input[type=text] {width: 95%;padding: 5px;margin-top: 5px;border: 1px solid #ccc; font-family: raleway;}
                            #submit {text-decoration: none !important;background-color: #FFBC00;color: #fff;border: 2px solid #444;padding: 5px;cursor: pointer;border-radius: 5px;}
                            span {color:red;font-weight:700}
                            button {height:30px;border-radius:10px;background: linear-gradient(to bottom, #a90329 0%,#8f0222 44%,#6d0019 100%);color:#fff;cursor:pointer}
                            </style>
                            <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                            <script type="text/javascript">

                              // Load the Google Transliterate API
                              google.load("elements", "1", {
                                    packages: "transliteration"
                                  });

                              function onLoad() {
                                var options = {
                                    sourceLanguage:
                                        google.elements.transliteration.LanguageCode.ENGLISH,
                                    destinationLanguage:
                                        [google.elements.transliteration.LanguageCode.HINDI],
                                    shortcutKey: 'ctrl+g',
                                    transliterationEnabled: true
                                };

                                // Create an instance on TransliterationControl with the required
                                // options.
                                var control =
                                    new google.elements.transliteration.TransliterationControl(options);

                                // Enable transliteration in the textbox with id
                                // 'transliterateTextarea'.
                                control.makeTransliteratable(['gonumber','gotitle']);
                              }
                              google.setOnLoadCallback(onLoad);
                            </script>
                            <div id="abc">
                                <div id="popupContact">
                                <form class="popupForm" name="goform" method="post">
                                   <img id="close" src="/images/3.png" onclick ="div_hide()">
                                   <div style="text-align:center">
                                   <h2>Add/Edit Government GO Table</h2>
                                   <span>Type in Hindi (Press Ctrl+g to toggle between English and Hindi)</span>
                                   </div>
                                   <input id="empid" name="empid" type="hidden" >
                                    <table>
                                    <tr>
                                        <td><label>GO Number: <span>*</span></label></td>
                                        <td><input id="gonumber" name="gonumber" type="text" value=""></td>
                                    </tr>
                                    <tr>
                                        <td><label>GO Issue Date: <span>*</span></label></td>
                                        <td><input id="department_name" name="depname" type="text" value=""></td>
                                    </tr>
                                    <tr>
                                        <td><label>GO Title: <span>*</span></label></td>
                                        <td><input id="gotitle" name="gotitle" value="" type="text"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Upload GO: <span>*</span></label></td>
                                        <td><input id="uploadgo" name="postname" type="file"></td>
                                    </tr>
                                    </table>
                                    <div style="text-align: center; height: 40px;padding-top: 13px;">
                                        <button onclick=goadded() id="submit">Submit</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        <?php
                        }
                    }
                    ?>
                </div></div>
                <table style="border-spacing: 0; border-collapse: collapse; border: 1px solid #ddd; font-size: .9em;">
                    <tbody>
                        <tr>
                            <th width="9%" align="right" style="text-align: center;font-size: .9em;">
                                <strong>S No.</strong>
                            </th>
                            <th width="34%" align="left" style="font-size: .9em;">
                                <strong>GO Number</strong>
                            </th>
                            <th width="9%" align="right" style="text-align: center;font-size: .9em;padding: inherit;">
                                <strong>Date</strong>
                            </th>
                            <th width="48%" align="left" style="font-size: .9em;">
                                <strong>Title</strong>
                            </th>
                            <th width="9%" align="right" style="text-align: center;font-size: .9em;">
                                <strong>GO</strong>
                            </th>
                        </tr>
                        <?php global $wpdb;
                        $i = 1;
                        $query = $wpdb->get_results ( "SELECT * FROM `uptron_government_go`" );
                        foreach($query as $page){
                            echo "<tr>
                                    <td style='text-align:center; vertical-align:middle;'>".$i++."</td>
                                    <td style='vertical-align:middle;'>$page->go_no</td>
                                    <td style='text-align:center; vertical-align:middle; padding: inherit;'>$page->date</td>
                                    <td style='vertical-align:middle;'>$page->title</td>
                                    <td style='text-align:center; vertical-align:middle;'><a target='_blank' href='/govt-orders/$page->attachment'><img src='http://www.wisetechglobal.com/Portals/WTG/images/pdf-icon.gif'></a></td>
                                </tr>";
                        }
                        ?>
                    </tbody>
            </table>
                <?php
            }
            ?>
        </div>
        <div class="" id="">
            <?php
            if(isset($_GET['citizen-services'])){
                ?>
                <div style="background-color: #EAEAEA; border: 1px solid #D8D8D8; padding: 5px 0 5px 10px; margin: 0 0 10px 0;"><strong>Citizen services currently being provided under e-District project</strong></div>
                <table style="border-spacing: 0; border-collapse: collapse; border: 1px solid #ddd; font-size: .9em;">
                    <tbody>
                        <tr>
                            <th width="9%" align="right" style="text-align: center;font-size: .9em;">
                                <strong>Sr. No.</strong>
                            </th>
                            <th width="34%" align="left" style="font-size: .9em;">
                                <strong>Department Name</strong>
                            </th>
                            <th width="9%" align="right" style="text-align: center;font-size: .9em;">
                                <strong>Sr. No.</strong>
                            </th>
                            <th width="48%" align="left" style="font-size: .9em;">
                                <strong>Name of Service</strong>
                            </th>
                        </tr>
                        <tr style="text-align:center">
                            <td width="8%" rowspan="10" style="text-align:center" style="text-align:center">
                                <strong>1.</strong>
                            </td>
                            <td width="34%" rowspan="10" align="left">
                                <strong>Revenue</strong>
                            </td>
                            <td width="9%" style="text-align:center" style="text-align:center">
                                <strong>1.</strong>
                            </td>
                            <td width="49%" align="left" valign="top">
                                Caste certificate
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center" style="text-align:center">
                                <strong>2.</strong>
                            </td>
                            <td width="49%" valign="bottom">
                                Income certificate
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center" style="text-align:center">
                                <strong>3.</strong>
                            </td>
                            <td width="49%" valign="bottom">
                                Domicile certificate
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center" style="text-align:center">
                                <strong>4.</strong>
                            </td>
                            <td width="49%" valign="bottom">
                                Cause List Generation
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>5.</strong>
                            </td>
                            <td width="49%" valign="bottom">
                                Case Tracking
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>6.</strong>
                            </td>
                            <td width="49%" valign="bottom">
                                Final Order Generation
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>7.</strong>
                            </td>
                            <td width="49%" valign="bottom">
                                Issuance of Citation for Recovery (RC)
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>8.</strong>
                            </td>
                            <td width="49%" valign="bottom">
                                Status of Recovery (RC)
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>9.</strong>
                            </td>
                            <td width="49%" valign="bottom">
                                Recording of Payments
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>10.</strong>
                            </td>
                            <td width="49%" valign="bottom">
                                Application for Khatauni
                            </td>
                        </tr>
                        <tr>
                            <td width="8%" rowspan="2" style="text-align:center">
                                <strong>2.</strong>
                            </td>
                            <td width="34%" rowspan="2">
                                <strong>Urban</strong> <strong>Development</strong>
                            </td>
                            <td width="9%" style="text-align:center">
                                <strong>11.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Birth certificate
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>12.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Death certificate
                            </td>
                        </tr>
                        <tr>
                            <td width="8%" style="text-align:center">
                                <strong>3.</strong>
                            </td>
                            <td width="34%" valign="top">
                                <strong>Medical &amp; Health</strong>
                            </td>
                            <td width="9%" style="text-align:center">
                                <strong>13.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Handicap Certificate
                            </td>
                        </tr>
                        <tr>
                            <td width="8%" rowspan="5" style="text-align:center">
                                <strong>4.</strong>
                            </td>
                            <td width="34%" rowspan="5">
                                <strong>Social Welfare</strong>
                            </td>
                            <td width="9%" style="text-align:center">
                                <strong>14.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Old Age Pension
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>15.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Family Benefit Scheme
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>16.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Application for Scholarship (Gen &amp; SC/ST)
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>17.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Application for Marriage &amp; Illness Grant
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>18.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Application for assistance against atrocities
                            </td>
                        </tr>
                        <tr>
                            <td width="8%" rowspan="5" style="text-align:center">
                                <strong>5.</strong>
                            </td>
                            <td width="34%" rowspan="5">
                                <strong>Women Welfare &amp; Child Development</strong>
                            </td>
                            <td width="9%" style="text-align:center">
                                <strong>19.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Pension for widows
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>20.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Dampati Puraskar scheme to promote widow marriage under 35 yrs
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>21.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Financial assistance to women of dowry scheme
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>22.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Legal assistance to dowry sufferers women scheme
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>23.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Grant for marriage of daughter of widow destitute scheme
                            </td>
                        </tr>
                        <tr>
                            <td width="8%" rowspan="4" style="text-align:center">
                                <strong>6.</strong>
                            </td>
                            <td width="34%" rowspan="4">
                                <strong>Handicap Welfare</strong>
                            </td>
                            <td width="9%" style="text-align:center">
                                <strong>24.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Handicap pension
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>25.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Application for loan to Handicap Person
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>26.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Application for Aids &amp; Appliances
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>27.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Application for Marriage Grants
                            </td>
                        </tr>
                        <tr>
                            <td width="8%" rowspan="2" style="text-align:center">
                                <strong>7.</strong>
                            </td>
                            <td width="34%" rowspan="2">
                                <strong>Employment</strong>
                            </td>
                            <td width="9%" style="text-align:center">
                                <strong>28.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Registration in Employment Exchange
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>29.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Application for renewal of Employee Registration
                            </td>
                        </tr>
                        <tr>
                            <td width="8%" rowspan="4" style="text-align:center">
                                <strong>8.</strong>
                            </td>
                            <td width="34%" rowspan="4">
                                <strong>Food &amp; Civil Supplies</strong>
                            </td>
                            <td width="9%" style="text-align:center">
                                <strong>30.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Issuance of Ration Card
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>31.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Surrender of Ration Card
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>32.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Modification in Ration Cards
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>33.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Duplicate Ration Cards
                            </td>
                        </tr>
                        <tr>
                            <td width="8%" rowspan="3" style="text-align:center">
                                <strong>9.</strong>
                            </td>
                            <td width="34%" rowspan="3">
                                <strong>Panchayati Raj</strong>
                            </td>
                            <td width="9%" style="text-align:center">
                                <strong>34.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Copy of Kutumb Register
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>35.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Birth certificate (Rural)
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>36.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Death certificate (Rural)
                            </td>
                        </tr>
                        <tr>
                            <td width="8%" rowspan="3" style="text-align:center">
                                <strong>&nbsp;</strong>
                            </td>
                            <td width="34%" rowspan="3">
                                <strong>All Concerned departments w.r.t. e-District</strong>
                            </td>
                            <td width="9%" style="text-align:center">
                                <strong>37.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Filing of Grievance
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>38.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Tracking of Grievance
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>39.</strong>
                            </td>
                            <td width="49%" valign="top">
                                All Application forms on web for downloading from anywhere
                            </td>
                        </tr>
                        <tr>
                            <td width="8%" rowspan="3" style="text-align:center">
                                <strong>10.</strong>
                            </td>
                            <td width="34%" rowspan="3">
                                <strong>Labour Board</strong>
                            </td>
                            <td width="9%" style="text-align:center">
                                <strong>40.</strong>
                            </td>
                            <td width="49%" valign="bottom">
                                Labour Registration
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>41.</strong>
                            </td>
                            <td width="49%" valign="bottom">
                                Labour Renewal
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>42.</strong>
                            </td>
                            <td width="49%" valign="bottom">
                                Benefits of Scheme
                            </td>
                        </tr>
                        <tr>
                            <td width="8%" style="text-align:center">
                                <strong>11.</strong>
                            </td>
                            <td width="34%" valign="top">
                                <strong>Food Safety &amp; Drug Administration</strong>
                            </td>
                            <td width="9%" style="text-align:center">
                                <strong>43.</strong>
                            </td>
                            <td width="49%" valign="bottom">
                                Online Drug Store Registration &amp; Licensing System (ODRALS)
                            </td>
                        </tr>
                        <tr>
                            <td width="8%" style="text-align:center">
                                <strong>12.</strong>
                            </td>
                            <td width="34%" valign="top">
                                <strong>IGRS</strong>
                            </td>
                            <td width="9%" style="text-align:center">
                                <strong>44.</strong>
                            </td>
                            <td width="49%" valign="bottom">
                                Online Grievance
                            </td>
                        </tr>
                        <tr>
                            <td width="8%" rowspan="11" style="text-align:center">
                                <strong>13.</strong>
                            </td>
                            <td width="34%" rowspan="11">
                                <strong>Labour</strong>
                            </td>
                            <td width="9%" style="text-align:center">
                                <strong>45.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Registration of Establishment
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>46.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Renewal of Establishment
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>47.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Issuance of duplicate certificate for Registered Establishment
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>48.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Notice of Change
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>49.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Amendment Of Contractor License
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>50.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Amendment Registration Of Establishment
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>51.</strong>
                            </td>
                            <td width="49%" valign="top">
                                License Of Contractor
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>52.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Notice Of Commencement Or Completion Of Work
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>53.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Registration Of Establishment Employing Contract Labour
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>54.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Registration Of Motor Transport
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>55.</strong>
                            </td>
                            <td width="49%" valign="top">
                                Renewal Of Contract License
                            </td>
                        </tr>
                        <tr>
                            <td width="8%" rowspan="2" style="text-align:center">
                                <strong>14.</strong>
                            </td>
                            <td width="34%" rowspan="2">
                                <strong>Commercial Tax</strong>
                            </td>
                            <td width="9%" style="text-align:center">
                                <strong>56.</strong>
                            </td>
                            <td width="49%" valign="top">
                                e-Registration
                            </td>
                        </tr>
                        <tr>
                            <td width="9%" style="text-align:center">
                                <strong>57.</strong>
                            </td>
                            <td width="49%" valign="top">
                                e-Return
                            </td>
                        </tr>
                    </tbody>
                </table>
           <?php
            }
            ?>
        </div>
        <div class="" id="">
            <?php
            if(isset($_GET['imp-links'])){
                ?>
                <div style="background-color: #EAEAEA; border: 1px solid #D8D8D8; padding: 5px 0 5px 10px; margin: 0 0 10px 0;"><strong>Important Links</strong></div>
                <table class="border-spacing: 0; border-collapse: collapse; border: 1px solid #ddd; font-size: .9em;">
                    <tbody>
                        <tr class="active">
                            <th style="text-align: center;font-size: .9em;">
                                <strong>Sr.No.</strong>
                            </th>
                            <th style="text-align: left;font-size: .9em;">
                                <strong>Important Links</strong>
                            </th>
                            <th style="text-align: center;font-size: .9em;">
                                <strong>Website Url</strong>
                            </th>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                1.
                            </td>
                            <td>
                                Government of Uttar Pradesh
                            </td>
                            <td style="text-align: center;">
                                <a href="http://up.gov.in/" target="_blank" title="Click here to view website" style="text-decoration: none !important">
                                        Visit Website</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                2.
                            </td>
                            <td>
                                Uttar Pradesh Chief Minister Office
                            </td>
                            <td style="text-align: center;">
                                <a href="http://upcmo.up.nic.in/" target="_blank" title="Click here to view website" style="text-decoration: none !important">
                                        Visit Website</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                3.
                            </td>
                            <td>
                                Election Commission of India
                            </td>
                            <td style="text-align: center;">
                                <a href="http://eci.nic.in/eci/eci.html" target="_blank" title="Click here to view website" style="text-decoration: none !important">Visit Website</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                4.
                            </td>
                            <td>
                                Chief Electoral Officer, UP
                            </td>
                            <td style="text-align: center;">
                                <a href="http://ceouttarpradesh.nic.in/" target="_blank" title="Click here to view website" style="text-decoration: none !important">Visit Website</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                5.
                            </td>
                            <td>
                                Ministry of Electronics and Information Technology
                            </td>
                            <td style="text-align: center;">
                                <a href="http://meity.gov.in/" target="_blank" title="Click here to view website" style="text-decoration: none !important">Visit Website</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                6.
                            </td>
                            <td>
                                e-Services Portal of Uttar Pradesh
                            </td>
                            <td style="text-align: center;">
                                <a href="http://uponline.up.nic.in/" target="_blank" title="Click here to view website" style="text-decoration: none !important">Visit Website</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                7.
                            </td>
                            <td>
                                Digital India
                            </td>
                            <td style="text-align: center;">
                                <a href="http://www.digitalindia.gov.in/" target="_blank" title="Click here to view website" style="text-decoration: none !important">Visit Website</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                8.
                            </td>
                            <td>
                                e-Tender
                            </td>
                            <td style="text-align: center;">
                                <a href="https://etender.up.nic.in/" target="_blank" title="Click here to view website" style="text-decoration: none !important">Visit Website</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
            }
            ?>
        </div>
        <div class="" id="">
            <?php
            if(isset($_GET['imp-guidelines'])){
                ?>
                <div style="background-color: #EAEAEA; border: 1px solid #D8D8D8; padding: 5px 0 5px 10px; margin: 0 0 10px 0;"><strong>Important Guidelines</strong></div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<div id="lowerside" class="lowerside">Lower Side</div>
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
