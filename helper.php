<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2021-03-16 10:57:18
 * @modify date 2021-03-16 10:57:18
 * @desc [description]
 */

(!defined('INDEX_AUTH')) ?? die('No direct include!');

// Generate Theme Link
function themeLink($path = '')
{
    global $sysconf;

    $versioning = '?ver=' . BIT_VERSION;

    if (ENVIRONMENT === 'development')
    {
        $versioning = '?ver='.date('this');
    }

    $dir = 'bitlike/';
    if ( isExists( SB.'admin/admin_template/bitlike-master/' ) && !isExists( SB.'admin/admin_template/bitlike/' ))
    {
        $dir = 'bitlike-master/';
    }

    return AWB . 'admin_template/' . $dir .$path . $versioning;
}

// Generate base Link
function baseLink($path = '')
{
    return SWB . $path;
}

// Generate Image Profile Link
function imageProfile()
{
    if (isset($_SESSION['upict']) && $_SESSION['upict'] === 'person.png')
    {
        return themeLink('assets/images/person.png');
    }

    return ( isExists( SB.'images/persons/' . $_SESSION['upict'] ) ) 
                ? 
                SWB.'images/persons/' . $_SESSION['upict'] 
                : 
                themeLink('assets/images/person.png');
}

// Check for true or false, and generate file path if needed
function isExists($path = '', $return = 'bool')
{

    switch (true) {
        case (file_exists($path) && $return === 'bool'):
            return true;
            break;

        case (!file_exists($path) && $return === 'bool'):
            return false;
            break;

        case (file_exists($path) && $return !== 'bool'):
            return $path;
            break;
        default:
            die('File '.$path.' not found!');
            break;
    }
}

// Generate LibraryName
function libraryName($opTional = '')
{
    global $sysconf;

    if (empty($opTional)) 
    {
        return $sysconf['library_name'].' :: '.$sysconf['library_subname'];
    }
    else
    {
        return $opTional;
    }
}

// Generate Javascript Lnk
function defaultJS($arrayAdditionalJS = [])
{
    global $sysconf;

    $jsMap = [
        JWB."jquery.js",
        AWB."admin_template/default/vendor/slimscroll/jquery.slimscroll.min.js",
        JWB."updater.js",
        JWB."gui.js?v=".date('this'),
        JWB."form.js",
        JWB."calendar.js?v=".date('this'),
        JWB."chosen/chosen.jquery.min.js",
        JWB."chosen/ajax-chosen.min.js",
        JWB."ckeditor/ckeditor.js",
        JWB."tooltipsy.js",
        JWB."colorbox/jquery.colorbox-min.js",
        JWB."jquery.imgareaselect/scripts/jquery.imgareaselect.pack.js",
        JWB."webcam.js",
        JWB."scanner.js",
        SWB."js/bootstrap.min.js",
        SWB."js/popper.min.js",
        themeLink("assets/js/vanilla-picker.min.js"),
        $sysconf['admin_template']['dir']."/default/js/smooth-scrollbar.js",
        $sysconf['admin_template']['dir']."/default/js/overscroll.js"
    ];

    if (count($arrayAdditionalJS) > 0)
    {
        $jsMap = array_merge($jsMap, $arrayAdditionalJS);
    }

    if (preg_replace('/[^0-9]/i', '', SENAYAN_VERSION) === "9")
    {
        $jsMap = array_merge($jsMap, [JWB."toastr/toastr.min.js"]);
    }

    $resultJS = '';
    foreach ($jsMap as $js) {
        $resultJS .= '<script type="text/javascript" src="' . $js . '"></script>';
    }

    return $resultJS;
}

// Generate CSS
function defaultCss($arrayAdditionalCSS = [])
{
    global $sysconf;

    $cssMap = [
        SWB."css/bootstrap.min.css?ver=".date('this'),
        SWB."css/core.css?ver=".date('this'),
        JWB."colorbox/colorbox.css?ver=".date('this'),
        JWB."chosen/chosen.css?ver=".date('this'),
        JWB."jquery.imgareaselect/css/imgareaselect-default.css",
        themeLink("assets/css/tui-chart.min.css")
    ];

    if (count($arrayAdditionalCSS) > 0)
    {
        $cssMap = array_merge($cssMap, $arrayAdditionalCSS);
    }

    if (preg_replace('/[^0-9]/i', '', SENAYAN_VERSION) === "9")
    {
        $cssMap = array_merge($cssMap, [JWB."toastr/toastr.min.css?ver=".date('this')]);
    }

    $resultCSS = '';
    foreach ($cssMap as $css) {
        $resultCSS .= '<link href="'.$css.'" rel="stylesheet" type="text/css"/>';
    }

    return $resultCSS;
}

// Just for dump :)
function dump($mix, $exit = true)
{
    echo '<pre>';
    var_dump($mix);
    echo '</pre>';

    if ($exit) exit;
}

// set lang in HTML
function setLang($langCode)
{
    $getId = substr($langCode, 0,2);

    return $getId;
}

// Dasboard
// set warning
function setWarning($except = null)
{
    global $dbs,$sysconf;
    /**
     * Took from home.php
     */
    // generate warning messages
    $warnings = array();
    // Super user
    if ($_SESSION['uid'] === "1")
    {
        $warnings[] = __('<strong><i>You are logged in as Super User. With great power comes great responsibility.</i></strong>');
    }
    
    // check if images dir is writable or not
    if (!is_writable(IMGBS) OR !is_writable(IMGBS.'barcodes') OR !is_writable(IMGBS.'persons') OR !is_writable(IMGBS.'docs')) {
        $warnings[] = __('<strong>Images</strong> directory and directories under it is not writable. Make sure it is writable by changing its permission or you won\'t be able to upload any images and create barcodes');
    }
    // check if file repository dir is writable or not
    if (!is_writable(REPOBS)) {
        $warnings[] = __('<strong>Repository</strong> directory is not writable. Make sure it is writable (and all directories under it) by changing its permission or you won\'t be able to upload any bibliographic attachments.');
    }
    // check if file upload dir is writable or not
    if (!is_writable(UPLOAD)) {
        $warnings[] = __('<strong>File upload</strong> directory is not writable. Make sure it is writable (and all directories under it) by changing its permission or you won\'t be able to upload any file, create report files and create database backups.');
    }
    // check mysqldump
    if (!file_exists($sysconf['mysqldump'])) {
        $warnings[] = __('The PATH for <strong>mysqldump</strong> program is not right! Please check configuration file or you won\'t be able to do any database backups.');
    }
    // check installer directory
    if (is_dir('../install/')) {
        $warnings[] = __('Installer folder is still exist inside your server. Please remove it or rename to another name for security reason.');
    }

    // check GD extension
    if (!extension_loaded('gd')) {
        $warnings[] = __('<strong>PHP GD</strong> extension is not installed. Please install it or application won\'t be able to create image thumbnail and barcode.');
    } else {
        // check GD Freetype
        if (!function_exists('imagettftext')) {
            $warnings[] = __('<strong>Freetype</strong> support is not enabled in PHP GD extension. Rebuild PHP GD extension with Freetype support or application won\'t be able to create barcode.');
        }
    }

    if (!is_nan($except))
    {
        unset($warnings[$except]);
    }

    return $warnings;
}

// set info
function setInfo()
{
    global $dbs;
    // info
    $info = [];
    // check for overdue
    $overdue_q = $dbs->query('SELECT COUNT(loan_id) FROM loan AS l WHERE (l.is_lent=1 AND l.is_return=0 AND TO_DAYS(due_date) < TO_DAYS(\''.date('Y-m-d').'\')) GROUP BY member_id');
    $num_overdue = $overdue_q->num_rows;
    if ($num_overdue > 0) {
        $info[] = str_replace('{num_overdue}', $num_overdue, __('There are currently <strong>{num_overdue}</strong> library members having overdue. Please check at <b>Circulation</b> module at <b>Overdues</b> section for more detail')); //mfc
        $overdue_q->free_result();
    }

    return $info;
}

// repair
function setRepair()
{
    global $dbs;

    // check need to be repaired mysql database
    $query_of_tables    = $dbs->query('SHOW TABLES');
    $num_of_tables      = $query_of_tables->num_rows;
    $prevtable          = '';
    $repair             = '';
    $is_repaired        = false;
    $repair_form        = '';

    if ($_SESSION['uid'] === '1') {
        if (isset ($_POST['do_repair'])) {
            if ($_POST['do_repair'] == 1) {
                while ($row = $query_of_tables->fetch_row()) {
                    $sql_of_repair = 'REPAIR TABLE '.$row[0];
                    $query_of_repair = $dbs->query ($sql_of_repair);
                }
            }
        }

        while ($row = $query_of_tables->fetch_row()) {
            $query_of_check = $dbs->query('CHECK TABLE '.$row[0]);
            while ($rowcheck = $query_of_check->fetch_assoc()) {
                if (!(($rowcheck['Msg_type'] == "status") && ($rowcheck['Msg_text'] == "OK"))) {
                    if ($row[0] != $prevtable) {
                    $repair .= '<li>Table '.$row[0].' might need to be repaired.</li>';
                    }
                    $prevtable = $row[0];
                    $is_repaired = true;
                }
            }
        }
        
        if (($is_repaired) && !isset($_POST['do_repair'])) {
            $repair_form  = '<div class="bg-red-100 border-t border-b border-red-500 text-red-700 px-4 py-3" role="alert">';
            $repair_form .= '<p class="font-bold">Table</p>';
            $repair_form .= '<ul>';
            $repair_form .= $repair;
            $repair_form .= '</ul>';
            $repair_form .= '</div>';
            $repair_form .= ' <form method="POST" style="margin:0 10px;">
                <input type="hidden" name="do_repair" value="1">
                <input type="submit" value="'.__('Click Here To Repair The Tables').'" class="button btn btn-block btn-default">
                </form>';
        }
    }

    return $repair_form;
}

// statistic
function chart($type)
{
        // Take from home.php
        global $dbs;

        if ($type == 'barchart'):
            // generate dashboard content
            $get_date       = '';
            $get_loan       = '';
            $get_return     = '';
            $get_extends    = '';
            $start_date     = date('Y-m-d'); // set date from TODAY
        
            // get date transaction
            $sql_date = 
                    "SELECT 
                        DATE_FORMAT(loan_date,'%d/%m') AS loandate,
                        loan_date
                    FROM 
                        loan
                    WHERE 
                        loan_date BETWEEN DATE_SUB('".$start_date."', INTERVAL 8 DAY) AND '".$start_date."' 
                    GROUP BY 
                        loan_date
                    ORDER BY 
                        loan_date";
        
            // echo $sql_date; //for debug purpose only
            $set_date       = $dbs->query($sql_date);
            if($set_date->num_rows > 0 ) {
                while ($transc_date = $set_date->fetch_object()) {
                    // set transaction date
                    $get_date .= $transc_date->loandate.',';
        
                    // get latest loan
                    $sql_loan = 
                            "SELECT 
                                COUNT(loan_date) AS countloan
                            FROM 
                                loan
                            WHERE 
                                loan_date = '".$transc_date->loan_date."' 
                                AND is_lent = 1 
                                AND renewed = 0
                                AND is_return = 0
                            GROUP BY 
                                loan_date";
        
                    $set_loan       = $dbs->query($sql_loan);
                    if($set_loan->num_rows > 0) {
                        $transc_loan    = $set_loan->fetch_object();
                        $get_loan      .= (int)$transc_loan->countloan.',';            
                    } else {
                        $get_loan       .= '0,';
                    }
        
                    // get latest return
                    $sql_return = 
                            "SELECT 
                                COUNT(loan_date) AS countloan
                            FROM 
                                loan
                            WHERE 
                                loan_date = '".$transc_date->loan_date."' 
                                AND is_lent = 1 
                                AND renewed = 0
                                AND is_return = 1
                            GROUP BY 
                                return_date";
        
                    $set_return       = $dbs->query($sql_return);                     
                    if($set_return->num_rows > 0) {
                        $transc_return    = $set_return->fetch_object();
                        $get_return      .= $transc_return->countloan.',';
                    } else {
                        $get_return       .= '0,';
                    }
        
                    // get latest extends
                    $sql_extends = 
                            "SELECT 
                                COUNT(loan_date) AS countloan
                            FROM 
                                loan
                            WHERE 
                                loan_date = '".$transc_date->loan_date."' 
                                AND is_lent     = 1 
                                AND renewed     = 1
                            GROUP BY 
                                return_date";
                    $set_extends       = $dbs->query($sql_extends);   
                    if($set_extends->num_rows > 0) {              
                        $transc_extends    = $set_extends->fetch_object();
                        $get_extends      .= $transc_extends->countloan.',';
                    } else {
                        $get_extends      .= '0,';
                    }
                }
            }
            // return transaction date
            $default        = null;
            $get_date       = explode(',', trim(substr($get_date,0,-1), ','));
            $get_loan       = explode(',', trim(substr($get_loan,0,-1), ','));
            $get_return     = explode(',', trim(substr($get_return,0,-1), ','));
            $get_extends    = explode(',', trim(substr($get_extends,0,-1), ','));

            return [
                    (count($get_date) == 0)?$default:$get_date,
                    (count($get_loan) == 0)?$default:$get_loan,
                    (count($get_return) == 0)?$default:$get_return,
                    (count($get_extends) == 0)?$default:$get_extends
                   ];
        endif;

        if ($type == 'doughchart'):
            // get loan summary
            $sql_loan_coll = ' SELECT 
                                    COUNT(loan_id) AS total
                                FROM 
                                    loan
                                WHERE
                                    is_lent = 1
                                    AND is_return = 0';
            $total_loan         = $dbs->query($sql_loan_coll);
            $loan               = $total_loan->fetch_object();
            $get_total_loan     = $loan->total;

            // get total summary
            $sql_total_coll = ' SELECT 
                                    COUNT(loan_id) AS total
                                FROM 
                                    loan';
            $total_coll = $dbs->query($sql_total_coll);
            $total      = $total_coll->fetch_object();
            $get_total  = $total->total;
        
            // get return summary
            $sql_return_coll = ' SELECT 
                                    COUNT(loan_id) AS total
                                FROM 
                                    loan
                                WHERE
                                    is_lent = 1
                                    AND is_return = 1';
            $total_return         = $dbs->query($sql_return_coll);
            $return               = $total_return->fetch_object();
            $get_total_return     = $return->total;
        
            // get extends summary
            $sql_extends_coll = ' SELECT 
                                    COUNT(loan_id) AS total
                                FROM 
                                    loan
                                WHERE
                                    is_lent = 1
                                    AND renewed = 1
                                    AND is_return = 0';
            $total_extends         = $dbs->query($sql_extends_coll);
            $renew                 = $total_extends->fetch_object();
            $get_total_extends     = $renew->total;
        
            // get overdue
            $sql_overdue_coll = ' SELECT 
                                    COUNT(fines_id) AS total
                                FROM 
                                    fines';
            $total_overdue         = $dbs->query($sql_overdue_coll);
            $overdue               = $total_overdue->fetch_object();
            $get_total_overdue     = $overdue->total;

            return [$get_total, $get_total_loan, $get_total_return, $get_total_extends, $get_total_overdue];
        endif;

        if ($type == 'num'):
            // get loan summary
            $sql_loan_coll = ' SELECT 
                                    COUNT(loan_id) AS total
                                FROM 
                                    loan
                                WHERE
                                    is_lent = 1
                                    AND is_return = 0';
            $total_loan         = $dbs->query($sql_loan_coll);
            $loan               = $total_loan->fetch_object();
            $get_total_loan     = $loan->total;
            
            // get titles
            $sql_title_coll = ' SELECT 
                                    COUNT(biblio_id) AS total
                                FROM 
                                    biblio';
            $total_title         = $dbs->query($sql_title_coll);
            $title               = $total_title->fetch_object();
            $get_total_title     = $title->total;
        
            // get item
            $sql_item_coll = ' SELECT 
                                    COUNT(item_id) AS total
                                FROM 
                                    item';
            $total_item          = $dbs->query($sql_item_coll);
            $item                = $total_item->fetch_object();
            $get_total_item      = $item->total;
            $get_total_available = $item->total - $get_total_loan;
            $get_total_available = $get_total_available;

            // set out
            return [$get_total_title, $get_total_item, $get_total_loan,$get_total_available];
        endif;
}

// Greate
function setGreater()
{
    $time = '?';
    switch (true) {
        case (date('G') >= 0 && date('G') < 11):
            $time = 'Selamat Pagi, ';
            break;

        case (date('G') >= 11 && date('G') < 15):
            $time = 'Selamat Siang, ';
            break;
        
        case (date('G') >= 15 && date('G') < 21):
            $time = 'Selamat Sore, ';
            break;
        
        case (date('G') >= 21 && date('G') <= 23):
            $time = 'Selamat Malam, ';
            break;
    }

    return $time;
}