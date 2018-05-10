<?php
/*
Template Name: Important News
*/
?>
    <?php get_header(); ?>
    <?php do_action( 'mp_before_container' ); ?>
    <main id="container">
        <?php do_action( 'mp_inside_container' ); ?>
        <div id="single-content" class="content full-width-content">
            <?php do_action( 'mp_before_content_inner' ); ?>
            <div class="content-inner">
                <?php do_action( 'mp_before_content_area' ); ?>
                <div id="entries" class="content-area">
                    <?php do_action( 'mp_before_content_area_inner' ); ?>
                    <div class="content-area-inner">
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
        color:white;
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
                <td class="leftsidetd" id="leftsidetd"><a href="?govt=govt">Important GO/Letters</a></td>
            </tr>
            <tr>
                <td class="leftsidetd" id="leftsidetd"><a href="index.php?citizen-services=citizen-services">Citizen Services</a></td>
            </tr>
            <tr>
                <td class="leftsidetd" id="leftsidetd"><a href="index.php?imp-links=imp-links">Important Links</a></td>
            </tr>
        </table>
    </div>
    <div id="maincontent" class="maincontent">
        <div class="" id="">
            <?php
            if(isset($_GET['govt'])){
                ?>
                <div style="background-color: #EAEAEA; border: 1px solid #D8D8D8; padding: 5px 0 5px 10px; margin: 0 0 10px 0;"><strong>Government Orders (GO) and Letters</strong>
                </div>
                <table style="border-spacing: 0; border-collapse: collapse; border: 1px solid #ddd; font-size: .9em; width: 100%;">
                    <tbody>
                        <tr>
                            <th width="9%" align="right" style="text-align: center;font-size: .9em;">
                                <strong>S No.</strong>
                            </th>
                            <th width="34%" align="left" style="font-size: .9em;">
                                <strong>Title</strong>
                            </th>
                            <th width="9%" align="right" style="text-align: center;font-size: .9em;">
                                <strong>GO</strong>
                            </th>
                            <th width="48%" align="right" style="text-align: center;font-size: .9em;padding: inherit;">
                                <strong>Date</strong>
                            </th>
                        </tr>
                        <?php global $wpdb;
                        $i = 1;
                        $query = $wpdb->get_results("SELECT * FROM `uptron_notice_board`");
                        foreach($query as $page){
                            echo "<tr>
                                    <td style='text-align:center; vertical-align:middle;'>".$i++."</td>
                                    <td style='vertical-align:middle;'>$page->title</td>
                                    <td style='text-align:center; vertical-align:middle;'><a target='_blank' href='/govt-orders/$page->attachment'><img src='http://www.wisetechglobal.com/Portals/WTG/images/pdf-icon.gif'></a></td>
                                    <td style='text-align:center; vertical-align:middle; padding: inherit;'>$page->postdate</td>
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
                <table style="border-spacing: 0; border-collapse: collapse; border: 1px solid #ddd; font-size: .9em; width: 100%;">
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
                            <th style="text-align: center; font-size: .9em;">
                                <strong>Sr.No.</strong>
                            </th>
                            <th style="text-align: left; font-size: .9em;">
                                <strong>Important Links</strong>
                            </th>
                            <th style="text-align: center; font-size: .9em;">
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
    </div>
</div>
<!-- **************************************  STOP Custom Code *********************************************** -->
                    </div>
                    <?php do_action( 'mp_after_content_area_inner' ); ?>
                </div>
                <?php do_action( 'mp_after_content_area' ); ?>
                <?php //comments_template(); ?>
            </div>
            <?php do_action( 'mp_after_content_inner' ); ?>
        </div>
        <?php do_action( 'mp_after_content' ); ?>
    </main>
    <?php get_footer(); ?>
