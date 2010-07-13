<?php
$_GLOBAL["str_backdir"] = isset($_GLOBAL["str_backdir"]) ? $_GLOBAL["str_backdir"] : '';

if (!isset($GLOBALS["ary_config"]))
{
  $GLOBALS["ary_config"] = array(); // The config file array.

  // Read the config file
  if ($array_tmp = file($_GLOBAL["str_backdir"].'configfile.txt'))
  {
    foreach($array_tmp as $v)
    {
      if ((substr(trim($v),0,1)!=';') && (substr_count($v,'=')>=1))
      {   //Line mustn't start with a ';' and must contain at least one '=' symbol.
        $pos = strpos($v, '=');
        $GLOBALS["ary_config"][trim(substr($v,0,$pos))] = trim(substr($v, $pos+1));
      }
    }
    unset($array_tmp);
  } else
  {
    echo "Failed to read ".$_GLOBAL["str_backdir"].'configfile.txt';
  }
}

// Added the languages files!!
$lang = array();
$ary_languages = array();

$obj_languages = new Getfiles($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'] . "/languages");
$ary_language = $obj_languages->Files();

for ($i_lang = 0 ; $i_lang < count($ary_language) ; $i_lang++)
{
  $obj_langfiles = new Getfiles($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'] ."/languages/" .
      $ary_language["$i_lang"]["0"]);
  $ary_langfiles = $obj_langfiles->Files();

  for ($i_langfiles = 0 ; $i_langfiles < count($ary_langfiles) ; $i_langfiles++)
  {
    $str_langfiles = isset($ary_langfiles["$i_langfiles"]["1"]) ? $ary_langfiles["$i_langfiles"]["1"] : "";
    if ($str_langfiles)
    {
      if ($ary_langfiles["$i_langfiles"]["1"] == "php")
      {
        $str_file = $ary_langfiles["$i_langfiles"]["0"] . "." . $ary_langfiles["$i_langfiles"]["1"];
        include ($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'] ."/languages/" .
            $ary_language["$i_lang"]["0"] . "/$str_file");
      }
      $ary_languages[$ary_language["$i_lang"]["0"]] = $lang;
    }
  }
}
// print_r is an echo.. Do not insert it into the echo!!
//echo "<pre>";
//print_r($ary_languages);
//echo "</pre>";


define('LIMITSIZE','30');
define('DATEFORMAT','d-m-Y H:i');
define('DATEFORMAT_SHORT','d-m-Y');
define('DATEFORMAT_LONG','Y-m-d H:i:s');

define('QOUTE_BGCOLOR', '#99FF00');
define('OPENORDER_BGCOLOR', '#FFFF00');
define('OPENWEBORDER_BGCOLOR', '#FF00FF');
define('ORDERPAYED_BGCOLOR', '#FFFF00');
define('PARTSHIP_BGCOLOR', '#FF9900');
define('COMPLETE_BGCOLOR', '#FF0000');
define('EOLPRODUCT_BGCOLOR', '#DD81FB');
define('EOLPRODUCT_ONSTOCK_BGCOLOR', '#C0E967');
define('PRODUCT_NOT_ONPRICELIST','#F785A5');
define('LOCKED_BGCOLOR','#FFABA9');
define('OTHER_BGCOLOR','#F785A5');
define('RMAORDER_BGCOLOR','#ffd850');
define('RMACREDITORDER_BGCOLOR','#aaaaaa');
define('WHITE_LINE_BGCOLOR','#FFFFFF');
define('BLUE_LINE_BGCOLOR','#B8B8EA');
define('LIGHTBLUE_LINE_BGCOLOR','#EAEAEA');

//minimum order marging before it turns red
define('MIN_ORDERMARGIN','10');

define('EAN_CODE_SIZE', 13);
define('EAN_CODE_SIZE_NO_CHECKSUM', 12);
define('IWEX_EAN_CODE_BEGIN', $GLOBALS["ary_config"]["EAN_CODE_BEGIN"]);

define('NOT_PAID_NOT_OVERDUE_BGCOLOR', '#FDE967');
define('NOT_PAID_OVERDUE_BGCOLOR', '#FF5050');
define('PAID_BGCOLOR', '#99FF00');
define('BGCOLOR_GREEN', '#99FF00');
define('PAID_OVERDUE_BGCOLOR', '#aa9900');
define("ALLOW_EXEPTION_COLOR","#99FF00");
define("NOT_PAID_DISPUUT_BGCOLOR", "#CCCCCC");

define('INVALID', -1);
define('ALL_INPUT_WILDCARD', '*');
define('DEF_ORDERCOST_WEB', 12.5);
define('DEF_ORDERCOST_OTHER', 13.5);
define('DEF_TRANSCOST', 5);
define('CREDITLIMIT_THRESHOLD', 0.75);
define('MAX_SELF_CHECK_CREDIT_LIMIT', 15000);
define('MONTH_INTREST_RATE', 1);
define("ORDER_OFFERTE",2);
define("ORDER_PROFORMA",3);

define("SHIPMENT_READY", "KLAAR");
define("SHIPMENT_REOPEN", "REOPEN");
define("SHIPMENT_CLEAR_TRACKING", 'CLEAR');
define("SHIPMENT_MAKE_SHIPLIST", 'SHIPL');
define("SHIPMENT_RETURN_TO_LIST", 'RETRN');
define("SHIPMENT_MAKE_UPS", 'UPSLAB');
define("SHIPMENT_MAKE_DHL", 'DHLLAB');
define("SHIPMENT_MAKE_GLS", 'GLSLAB');

define('FORMAT_ASCI', 'asci');
define('FORMAT_HTML', 'html');
define('FORMAT_PDF', 'pdf');
define('CUST_PACKING_LIST', 'custpack');
define('CUST_PACKING_LIST_FILE_NAME', 'packlist_');

define('COMPANYNAME', $GLOBALS["ary_config"]["companyname"]);
define('ADDRESS', $GLOBALS["ary_config"]["address"]);
define('POSTAL_ADDRESS', $GLOBALS["ary_config"]["postaddress"]);
define('ZIPCODE', $GLOBALS["ary_config"]["zipcode"]);
define('CITY', $GLOBALS["ary_config"]["city"]);
define('TELEPHONE', $GLOBALS["ary_config"]["telephone"]);
define('FAX', $GLOBALS["ary_config"]["fax"]);
define('COUNTRYCODE', $GLOBALS["ary_config"]["countrycode"]);
define('NUMBERFISCAL', $GLOBALS["ary_config"]["number_fiscal"]);

define('LOGOCOLOR', $GLOBALS["ary_config"]["logocolor"]);
define('LOGOBLACK', $GLOBALS["ary_config"]["logoblack"]);
define('LOGOSMALL', $GLOBALS["ary_config"]["logosmall"]);
define('LOGOCONTRAST', $GLOBALS["ary_config"]["logocontrast"]);
define('LOGOBIGBLACK', $GLOBALS["ary_config"]["logobigblack"]);
define('LOGOBIGCOLOR', $GLOBALS["ary_config"]["logobigcolor"]);

define('STYLESHEET', $GLOBALS["ary_config"]["stylesheet"]);

define('DELIVERY_CONDITIONS_EURO_DUTCH',
    "Alle prijzen in euro.\nDe algemene leveringsvoorwaarden zijn van kracht.");
define('IWEX_ADRES_INFO',
    COMPANYNAME . "\n" .
    NUMBERFISCAL . "\n" .
    ADDRESS . "\n" .
    POSTAL_ADDRESS . "\n" .
    ZIPCODE . "  " . CITY);
define('DEFAULT_DOMAIN', $GLOBALS["ary_config"]["defaultdomain"]);
define('IWEX_WEBSITE', $GLOBALS["ary_config"]["website"]);
define('IWEX_PHONE_INFO',
    "Tel: " . TELEPHONE . "  Fax: " . FAX);
define('IWEX_PHONE_INFO_SEPERATED',
    "Tel: " . TELEPHONE . "\nFax: " . FAX);

define('GIRO_ACCOUNT_ID', $GLOBALS["ary_config"]["giroaccountid"]);
define('GIRO', $GLOBALS["ary_config"]["giro"]);
define('IBANGIRO', $GLOBALS["ary_config"]["ibangiro"]);
define('SWIFTGIRO', $GLOBALS["ary_config"]["swiftgiro"]);
define('BANK_ACCOUNT_ID', $GLOBALS["ary_config"]["bankaccountid"]);
define('BANK', $GLOBALS["ary_config"]["bank"]);
define('IBANBANK', $GLOBALS["ary_config"]["ibanbank"]);
define('SWIFTBANK', $GLOBALS["ary_config"]["swiftbank"]);

define('KVK', $GLOBALS["ary_config"]["kvk"]);

define("STANDARD_WINDOW","'toolbar=1,menubar=0,resizable=1,scrollbars=1,dependent=0,status=0,width=800,height=500,left=25,top=25'");	   
define('ADMINISTRATION_TAG','Neem bij onjuist/onduidelijkheden even contact op met de administratie: 
        0226-411299 of <a href="mailto:' . $GLOBALS["ary_config"]["email.admin"] . '?cc=' . $GLOBALS["ary_config"]["email.sales"] . '&subject=Kredietoverschreiding / betalingsachterstand">' . $GLOBALS["ary_config"]["email.admin"] . '</a>.');
define('EXTERNAL_SMTP_SERVER', $GLOBALS["ary_config"]['smtpserver']); //if empty use PHP build-in mail() function to send email
define('EXTERNAL_MAILING_SMTP_SERVER', $GLOBALS["ary_config"]['smtpmailingserver']); //if empty use PHP build-in mail() function to send email
define('EXTERNAL_MAILING_SMTP_SERVER_USER', $GLOBALS["ary_config"]['smtpmailingserver.user']); //if empty use PHP build-in mail() function to send email
define('EXTERNAL_MAILING_SMTP_SERVER_PASSWORD', $GLOBALS["ary_config"]['smtpmailingserver.password']); //if empty use PHP build-in mail() function to send email
define("DEFAULT_MAIL_CLIENT_NAME", "sales");

define("MAIL_TEMP_DIR", "tmp_nameko");
define("MAIL_EXTENSION", "eml");

define('PERSONEN_TYPE_ID_VERVALLEN', 4);

define('RMA_CREDIT_TEXT','RMA credit');
define('RMA_RETOUR_TEXT','Retourzending RMA');
define('RMA_RETOUR_SUPPLIER_TEXT','RMA to Supplier');

define('js_upload_img', "onclick=\"window.open('upload_popup.php','upload popup','toolbar=0,menubar=0,resizable=0,scrollbars=0,status=0,width=400,height=200,left=60,top=25')\"");    
define('Device_Category_Condition'," (CategoryID = 3 OR CategoryID = 9 OR CategoryID = 13)");

define('ADMIN_ORDER_FREETEXT_ARTICLE',$GLOBALS["ary_config"]["Freetext Administration Article"]);

// GLS account number
define("GLS_ACCOUNT_NUMBER", $GLOBALS["ary_config"]["glsaccountnumber"]);

// Overdue days
define ("FIRST_MAIL_OVERDUE_DAYS", "7");
define ("SECOND_MAIL_OVERDUE_DAYS", "14");
define ("TELEPHONE_CALL_OVERDUE_DAYS", "28");
define ("FAX_OR_LETTER_OVERDUE_DAYS", "35");
define ("SIGNATURE_LETTER_OVERDUE_DAYS", "42");
define ("BAILIFF_OVERDUE_DAYS", "49");

// New VAT number for Iwex B.V. sinds 2004-10-01.
if (strtotime("now") < strtotime("2004-10-01"))
{
  define('IWEX_VAT_NUMBER', $GLOBALS["ary_config"]["vatnumber"]);
} else
{
  define('IWEX_VAT_NUMBER', $GLOBALS["ary_config"]["vatnumber"]);
}

define ("ORDER_CONFIRMATION_NL", "Order bevestiging");
define ("SHIP_CONFIRMATION_NL", "Verzendbericht");
define ("SALES_PROPOSAL_NL", "Offerte");
define ("YOUR_INVOICE_NL", "Uw factuur");
define ("INVOICE_STILL_OPEN_NL", "Openstaande facturen");

// EU tax check website.
define("EU_TAX_WEBSITE_URL", "http://ec.europa.eu/taxation_customs/vies/vieshome.do?selectedLanguage=EN");

// change '/sylvia/' into project directory if it changes
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/inc_files.php');
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/layout_functions.php');
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/db_functions.php');
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/pdf_functions.php');
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/ups_functions.php');
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/graphs.inc.php');
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/xml_fuctions.php');
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/mail_functions.php');
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/financial_functions.php');
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/purchase_functions.php');
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/sales_functions.php');
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/phpmailer/class.phpmailer.php');
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/pricing_functions.php');
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/order_functions.php');

//require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/upload_functions_class.php');

$db_iwex = new DB;
//mysql_connect($GLOBALS["ary_config"]["hostname"],$GLOBALS["ary_config"]["username"],$GLOBALS["ary_config"]["password"]);
//mysql_select_db($GLOBALS["ary_config"]["database"]); 

/*********************************************************
 * Function printheader
 * Will create the default Iwex header and look and feel
 *********************************************************/
function printheader($title = "Iwex controlecenter", $pagename = "IwexMain", $useoverlib = TRUE)
{
  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML><HEAD>
    <TITLE><?php echo $title ?></TITLE>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
    <META content="Iwex Sylvia" name=GENERATOR>
    <link rel="stylesheet" type="text/css" href="<?php echo docroot . STYLESHEET; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo docroot;?>/js/ThemeOffice/theme.css">
    <script TYPE="text/javascript" language="JavaScript" src="<?php echo docroot;?>/js/JSCookMenu.js"></script>
    <script language="JavaScript" src="<?php echo docroot;?>/js/ThemeOffice/theme.js" type="text/javascript"></script>
    <script language="JavaScript" src="<?php echo docroot;?>/js/layout.js" type="text/javascript"></script>
  <?php
    // Only print this when overlib is needed. When this is used body onload doesn't work anymore.
    if ($useoverlib)
    {
      ?>
    <script TYPE="text/javascript" language="JavaScript" src="<?php echo docroot;?>/js/overlib.js"></script>
    <script TYPE="text/javascript" language="JavaScript" src="<?php echo docroot;?>/js/overlib_cssstyle.js"></script>
    <script TYPE="text/javascript" language="JavaScript" src="<?php echo docroot;?>/js/calendar.js"></script>
    <?php
    }
    ?>
  </HEAD>
<?php
}

/*********************************************************
 * Function printemailheader
 * Will create the default Iwex email header and look and
 * feel
 *********************************************************/
function printemailheader($title = "Iwex controlecenter")
{
  ?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <HTML><HEAD>
      <TITLE><?php echo $title ?></TITLE>
      <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
      <META content="Dev-PHP 2.0.6" name=GENERATOR>
      <STYLE type="text/css">
        <!--
        BODY	{ color: black; font-size: 9pt; font-family:arial }
        TABLE  { color: black; border: 1px solid #A4A4A4; background-color : #eeeeff; font-family:Arial; font-size:9pt; }
        TD  { color: black; border: 1px solid #A4A4A4; background-color : #eeeeff; font-family:Arial; font-size:9pt; }
        TH  { color: white; border: 1px solid #A4A4A4; background-color : #0000ff; font-family:Arial; font-size:9pt; }
        -->
      </STYLE></HEAD>
<?php
}

/*********************************************************
 * Function printenddoc
 * Will create the default end of the document
 *********************************************************/
function printenddoc()
{
  ?>
  </body></html>
<?php
}

/** Defines the default Iwex e-mail header **/
$emailheader = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n"
    . "<HTML><HEAD>\n<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=ISO-8859-1\">\n"
    . "<META content=\"Iwex-PHP \" name=GENERATOR>\n"
    . "<TITLE>Iwex informatie</TITLE>"
    . "<STYLE>\nBODY,	{ color: black; font-size: 9pt; font-family:arial }\n"
    . "TABLE,  { color: black; border: 1px solid #A4A4A4; background-color : #eeeeff; font-family:Arial; font-size:9pt; }\n"
    . "TD,  { color: black; border: 1px solid #A4A4A4; background-color : #eeeeff; font-family:Arial; font-size:9pt; }\n"
    . "TH,  { color: white; border: 1px solid #A4A4A4; background-color : #0000ff; font-family:Arial; font-size:9pt; }\n"
    . "</STYLE></HEAD>\n";

/** Defines the default Iwex e-mail signature **/
$emailsignature = "\n<br>Met vriendelijke groeten<br>\n" . $GLOBALS["ary_config"]["companyname"] . " <a href=\"" . $GLOBALS["ary_config"]["website"] . "\">" . $GLOBALS["ary_config"]["website"] . "</a><br>\n";

/*********************************************************
 * Function     : Add_Calendar
 * Returns 		: A string with an image that pops up an
 * 				  calendar.
 * Input        : varible to set.
 *********************************************************/
function Add_Calendar($formvariable)
{
  return "<a href=\"javascript:show_calendar('$formvariable');\"
							onMouseOver=\"window.status='Date Picker';\" 
							onMouseOut=\"window.status='';nd();	return true;\"><img src=\"/images/calendar.gif\" border=\"0\" alt=\"Display Calendar\"s></a>";
}

/*********************************************************
 * Function     : CheckBTWlink
 * Will create correct html link to check VAT number
 * Input        : EU VAT number
 * 				: Text to display in the link.
 * Returns      : html code link to EU validate VAT site
 *********************************************************/
function CheckBTWlink($country, $vat, $str = "")
{
  $str = $str =="" ? $vat : $str;

  $vat = str_replace('', '', str_replace('.', '', $vat));
  return "<a href='http://ec.europa.eu/taxation_customs/vies/viesquer.do?ms=$country&iso=$country&vat=$vat' target='_new'>$str</a>";
}

/*********************************************************
 * Function     : KVKvalidation
 * Will create correct html link to check KVK number
 * Input        : KVK number
 * Returns      : error string when kvknumber not exist.
 *********************************************************/
function KVKvalidation($int_kvk, $int_country)
{
  $str_error = FALSE;
  $ary_lines = array();

  if ($int_country = "NL")
  {
  //$ch = curl_init();
  //curl_setopt($ch, CURLOPT_URL, "https://server.db.kvk.nl/TST-BIN/FU/TSWS001@?BUTT=" . $int_kvk);
  //$file = curl_exec($ch);
    $fp = fsockopen("https://server.db.kvk.nl/TST-BIN/FU/TSWS001@?BUTT=" . $int_kvk);
    echo $fp;
    $ary_lines = @file("https://server.db.kvk.nl/TST-BIN/FU/TSWS001@?BUTT=" . $int_kvk);
    if (isset($ary_lines))
    {
      foreach ($ary_lines As $str_line)
      {
        if(ereg("KvK-nummer niet gevonden", $str_line))
        {
          $str_error = "kvk niet gevonden";
        }
        if (ereg("Uitgeschreven", $str_line))
        {
          $str_error = "Het bedrijf is uitgeschreven";
        }
      }
    }
  }
  return $str_error;
}

/*********************************************************
 * Function     : CheckKVKlink
 * Will create correct html link to check KVK number
 * Input        : KVK number
 * Returns      : html code link to validate KVK site
 *********************************************************/
function CheckKVKlink($kvk)
{
  return "<a href='https://server.db.kvk.nl/TST-BIN/FU/TSWS001@?BUTT=$kvk' target='_new'>$kvk</a>";
}

/*********************************************************
 * Function     : createtrackinglink
 * Will create correct html link to the track and trace
 * website of the forwarder.
 * Input        : Trackingnumber, ship to zipcode
 * Returns      : html code link to the track and trace
 *                website
 *********************************************************/
function createtrackinglink($trackingnumber, $zipcode)
{
  return createtrackinglinktxt($trackingnumber, $zipcode, $trackingnumber);
}

/*********************************************************
 * Function     : createtrackinglinktxt
 * Will create correct html link to the track and trace
 * website of the forwarder.
 * Input        : Trackingnumber, ship to zipcode, link text
 * Returns      : html code link to the track and trace
 *                website
 *********************************************************/
function createtrackinglinktxt($trackingnumber, $zipcode, $linktxt)
{
  $returntxt = "";
  if ($trackingnumber != "")
  {
    if (ereg("1[Zz]", $trackingnumber))
    {  // Test UPS.
      $returntxt =  "UPS <a href=\"http://wwwapps.ups.com/WebTracking/processInputRequest?HTMLVersion=5.0&TypeOfInquiryNumber=T&loc=nl_NL&InquiryNumber1="
          . $trackingnumber . "&AgreeToTermsAndConditions=yes\" target=\"_new\">"
          . $linktxt . "</a>";
    } else if (ereg("3[Ss]", $trackingnumber))
      { // Test TPG
      // Strip spaces from the zipcode
        $zipcode = ereg_replace(' ', '', $zipcode);
        $returntxt = "TPG <a href=\"https://secure.postplaza.nl/TPGApps/tracktrace/findByBarcodeServlet?BARCODE="
            . $trackingnumber . "&ZIPCODE=" . $zipcode . "\" target=\"_new\">"
            . $linktxt . "</a>";
      }  else if (ereg(GLS_ACCOUNT_NUMBER, $trackingnumber))
        {  // Test GLS
          $returntxt =  "GLS <a href=\"http://www.tracking.npd.nl/tracking2/Tracking.html\" target=\"_new\">"
              . $linktxt . "</a>";
        } else if (ereg("[Tt][0-9][0-9]", $trackingnumber))
          { // Test Transmission
          // Strip spaces from the tracking number
            $trackingnumber = ereg_replace(' ', '', $trackingnumber);
            $returntxt = "Transmission <a href=\"http://www.mijnzending.nl/?zendingsoort=$trackingnumber[0]&depotnummer=$trackingnumber[1]$trackingnumber[2]&verladernummer="
                .substr($trackingnumber, 4, 5)."&zendingnummer="
                .substr($trackingnumber, 9, 6)."&button-zoeken=Zoeken"
                . "\" target=\"_new\">"
                . $linktxt . "</a>";
          } else if (ereg("DHL", $trackingnumber))
            {  // Test DHL in the Benelux
              $returntxt =  "<a href=\"".$GLOBALS["ary_config"]["dealersite"]."/dhl/extdhl.htm?PO+I+0000000000+"
                  .ereg_replace('DHL ',
                  '',
                  $trackingnumber)."\" target=\"_new\">"
                  . $linktxt . "</a>";
            } else if (ereg("JVGL", $trackingnumber))
              {  // Test DHL shipments outside Benelux
                $returntxt =  "<a href=\"http://tracknet.dpwn.com/migtrack/servlet/ShpSearch?Language=1&from=IS&icodelist=$trackingnumber;\" target=\"_new\">"
                    . $linktxt . "</a>";
              } else
              {
                $returntxt = $linktxt;
              }
  } else
  {
    $returntxt = "onbekend";
  }
  return $returntxt;
}

/*********************************************************
 * Function MakeBeep
 * Will create the default Iwex OK or wrong beep.
 *********************************************************/
      function MakeBeep($bl_ok = FALSE)
      {
        return $bl_ok ?
        "<embed src=\"".docroot."/includes/right.wav\" autostart=true hidden=true name=\"right_sound\">"
        :
        "<embed src=\"".docroot."/includes/wrong.wav\" autostart=true hidden=true name=\"wrong_sound\">";
      }

/*********************************************************
 * Function printIwexNav
 * Input    : $bl_use_DHTML_menu, True when dynamic HTML
 *              menus should be used. False if standard
 *              HTML menus should be used.
 * Will create the default Iwex nav banner
 *********************************************************/
      function printIwexNav($bl_use_DHTML_menu = TRUE)
      {
        global $db_iwex,
        $raccess_s, $raccess_a, $raccess_r, $raccess_v,
        $setup_s, $setup_a, $setup_r, $setup_v,
        $supervisor,
        $_GLOBAL,
        $uname;

        ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="back" id='iwexnav' style='display:block;'>
  <tr>
    <td>&nbsp;</td>
    <td><img src="<?php echo docroot ?>/images/menuleft.gif" alt=""></td>
    <td width="100%" background="<?php echo docroot ?>/images/menuback.gif" class="menubar">
        <?php
        $sql = 'SELECT id, name FROM menucategory WHERE menu > 0 ';
        $result = $db_iwex->query($sql);

        if (empty($raccess_s) && empty($raccess_a) && empty($raccess_r) && empty($raccess_v) && empty($setup_s) &&
            empty($setup_a) && empty($setup_r) && empty($setup_v) && empty($supervisor))
        {
          echo "U bent niet ingelogt of hebt geen rechten!";
        } else if ($bl_use_DHTML_menu)
          {
            echo "<div id='myMenuID'></div>\n<script language='JavaScript' type='text/javascript'>\n";
            echo "var myMenu =
            [
                ['<img src=\"".$_GLOBAL["str_backdir"]."js/ThemeOffice/home.png\"/>','','".docroot."/index.php',null,'Home Page'],
                _cmSplit";
            while ($menu=mysql_fetch_object($result))
            {
              echo ",\n\t\t[null,'$menu->name',null,null,'$menu->name'";
              //#149; <a href="'.docroot.'/index.php?category='.$menu->id.'" class="menubar"> '..'</a> '."\n";
              $menu_sql="SELECT name, imagename, link FROM menufunction ";
              $sqlwhere = " WHERE menucategoryid = '$menu->id'";
              $sqlwhere .= " AND (";
              if (isset($raccess_s) && $raccess_s) $sqlwhere.= queryparm('access_s',$raccess_s,$sqlwhere,false,' ');
              if (isset($raccess_a) && $raccess_a) $sqlwhere.= queryparm('access_a',$raccess_a,$sqlwhere,false,'OR');
              if (isset($raccess_r) && $raccess_r) $sqlwhere.= queryparm('access_r',$raccess_r,$sqlwhere,false,'OR');
              if (isset($raccess_v) && $raccess_v) $sqlwhere.= queryparm('access_v',$raccess_v,$sqlwhere,false,'OR');
              if (isset($setup_s) && $setup_s) $sqlwhere.= queryparm('setup_s',$saccess_s,$sqlwhere,false,'OR');
              if (isset($setup_a) && $setup_a) $sqlwhere.= queryparm('setup_a',$saccess_a,$sqlwhere,false,'OR');
              if (isset($setup_r) && $setup_r) $sqlwhere.= queryparm('setup_r',$saccess_r,$sqlwhere,false,'OR');
              if (isset($setup_v) && $setup_v) $sqlwhere.= queryparm('setup_v',$saccess_v,$sqlwhere,false,'OR');
              if (isset($supervisor) && $supervisor) $sqlwhere.= queryparm('supervisor',$supervisor,$sqlwhere,false,'OR');
              $sqlwhere .= ")";

              $menu_sql .= $sqlwhere;
              $menu_result = $db_iwex->query($menu_sql);
              While ($obj = mysql_fetch_object($menu_result))
              {
                $str_imagename = $obj->imagename ? $obj->imagename : "sections.png";
                echo ",\n\t\t\t['<img src=\"".$_GLOBAL["str_backdir"]."js/ThemeOffice/$str_imagename\"/>','$obj->name','".docroot."/$obj->link',null,'$obj->name']";
              //echo '&#149;<a href="'.$obj->link.'">'.$obj->name.'</a><br>'."\n";
              }
              echo "\n\t\t],\n_cmSplit";
            }
            echo GetNewOrders(TRUE);

      echo GetShipOrders(TRUE);

      echo GetSpecialMenus();

      echo "];\n
            cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
            </script>";
    } else
    {
    // Standard HTML menus
      while ($menu=mysql_fetch_object($result))
      {
        echo '&#149; <a href="'.docroot.'/index.php?category='.$menu->id.'" class="menubar"> '.$menu->name.'</a> '."\n";
      }
    }
  mysql_free_result($result);

  echo "</td>\n<td width=100% background='". docroot ."/images/menuback.gif' class='menubar'>";

  if ($bl_use_DHTML_menu)
  {
    echo "<div id='myMenuIDright'></div>\n<script language='JavaScript' type='text/javascript'>\n";
    echo "var myMenuRight =
            [
                ['<img src=\"".$_GLOBAL["str_backdir"]."js/ThemeOffice/help.png\"/>',' Help','".docroot."/help.php?file=".
        str_replace($GLOBALS["ary_config"]['http_docroot'].'/',
        '',
        preg_replace('/\?.+/', ' ', $_SERVER['REQUEST_URI']))."','help','Logout'],
                ['<img src=\"".$_GLOBAL["str_backdir"]."js/ThemeOffice/exit.png\"/>',' Logout','".docroot."/logout.php',null,'Logout'],
                _cmSplit";
    echo "];\n
                cmDraw ('myMenuIDright', myMenuRight, 'hbr', cmThemeOffice, 'ThemeOffice');
               </script>";
  } else
  {
    echo '<a href="<?php echo docroot; ?>/logout.php" class="menubar">Logout</a>';
  }
  ?>
    </td>
    <td><img src="/images/menuright.gif" alt=""></td>
    <td>&nbsp;</td>
  </tr>
</table>
  <?php
  echo "<script>
        InIframe('iwexnav');
    </script>";
}

/*********************************************************
 * Functions     : security
 * Enables security features
 * Encrypt     : hash data
 *********************************************************/
function Encrypt($string)
{//hash then encrypt a string
  $crypted = crypt(md5($string), md5($string));
  return $crypted;
}
/*********************************************************
 * Function     : AddUser
 * Input        : username, password, first name, last name
 * Returns      : true if succesfull otherwise false.
 *********************************************************/
function AddUser($username, $password, $fname, $lname)
{ //add user to table logins
  $password = Encrypt($password);
  //$username = encrypt($username);
  return mysql_query("insert into users set username = '$username' , password = '$password' , fname = '$fname', lname = '$lname';", $linkID)
      or die("Invalid AddUser insert: " . mysql_error());
}

/*********************************************************
 * Function     : Login
 * Input        : username, password
 * Returns      : true if succesfull otherwise false.
 *********************************************************/
function Login($user, $password)
{ //attempt to login false if invalid true if correct
  $auth = false;
  //$user = Encrypt($user);

  $result = mysql_query("select pwd from genuser where uid = '$user'")
      or die("Invalid passwrd request in Login: " . mysql_error());

  $pass = mysql_fetch_row($result);
  //mysql_close($linkID);
  if ($pass[0] == (Encrypt($password)))
  {
    $auth = true;
  }
  mysql_free_result($result);

  return $auth;
}

/*********************************************************
 * Function     : set_globals
 * Input        : username
 * Returns      : ??
 *********************************************************/
Function set_globals($user)
{ //set companyID / companyname and permissions for Sales,Administration,Voorraad and RMA

  global $pwd_company, $pwd_companyid,$pwd_rma,
  $raccess_s, $raccess_a, $raccess_v, $raccess_r,
  $waccess_s, $waccess_a, $waccess_v, $waccess_r,
  $saccess_s, $saccess_a, $saccess_v, $saccess_r, $supervisor, $employee_id;

  $usersql = 'select genuser.ContactID, raccess_s, raccess_a, raccess_v, raccess_r, '
      .'waccess_s, waccess_a, waccess_v, waccess_r, '
      .'saccess_s, saccess_a, saccess_v, saccess_r, supervisor, employee_id, '
      .'contacts.CompanyName from genuser '
      .'left join contacts on genuser.ContactID=contacts.ContactID '
      .'where genuser.uid = "'.$user.'"';
  $result = mysql_query($usersql)
      or die("Ongeldige uid query: ".$usersql. mysql_error());
  $objuser = mysql_fetch_object($result);
  $pwd_company = $objuser->CompanyName;
  $pwd_companyid = $objuser->ContactID;
  $raccess_s = $objuser->raccess_s;
  $raccess_a = $objuser->raccess_a;
  $raccess_v = $objuser->raccess_v;
  $raccess_r = $objuser->raccess_r;
  $waccess_s = $objuser->waccess_s;
  $waccess_a = $objuser->waccess_a;
  $waccess_v = $objuser->waccess_v;
  $waccess_r = $objuser->waccess_r;
  $saccess_s = $objuser->saccess_s;
  $saccess_a = $objuser->saccess_a;
  $saccess_v = $objuser->saccess_v;
  $saccess_r = $objuser->saccess_r;
  $supervisor = $objuser->supervisor;
  $employee_id = $objuser->employee_id;

  $GLOBALS["employee_id"] = $objuser->employee_id;

/*     echo $raccess_s, $raccess_a, $raccess_v, $raccess_r,
          $waccess_s, $waccess_a, $waccess_v, $waccess_r,
          $saccess_s, $saccess_a, $saccess_v, $saccess_r; */
  mysql_free_result($result);
}

/*********************************************************
 * Function     : nz
 * Input        : value, alternative if value is zero, NULL or empty
 * Returns      : a value or alternative
 *********************************************************/
function nz($value,$alternative)
{
// Check if the value is empty, <null>, or zero
// if it is use alternative value
  if (is_null($value)
      ||
      $value=''
      ||
      $value=0)
  {
    $returnvalue = $alternative;
  }
  else
  {
    $returnvalue = $value;
  }
  return $returnvalue;
}

/*********************************************************
 * Function     : PrintPriceSummary
 * Desctiption  : Prints the Summary on the screen.
 * Input        : flt_prodCost, total cost of the products
 * 				  flt_orderCost, total cost of the added order and shipment cost
 * 				  flt_vatAmount, total cost of the VAT.
 * 				  str_align, location of the table.
 *********************************************************/
function PrintPriceSummary($flt_prodCost, $flt_orderCost, $flt_vatAmount, $str_align = "left")
{
  global $ary_lang;
  $flt_totalcost = $flt_prodCost + $flt_orderCost + $flt_vatAmount;
  $str_ordercost = sprintf("%.2f", $flt_orderCost);
  $str_productcost = sprintf("%.2f", $flt_prodCost);
  $str_totalexclvat = sprintf("%.2f", $flt_prodCost + $flt_orderCost);
  $str_vatamount = sprintf("%.2f", $flt_vatAmount);
  $str_totalcost = sprintf("%.2f", $flt_totalcost);

  echo "<table width = \"100%\" border =\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td align=$str_align>";
  echo "<table width=\"250\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"cellline\">\n";
  echo "<tr><td>".$ary_lang["invoice_product_subtotal"]."</td><td align=\"right\"> &euro; $str_productcost</td></tr>\n";
  echo "<tr><td>".$ary_lang["invoice_order_costs"]."</td><td align=\"right\">&euro; $str_ordercost</td></tr>\n";
  echo "<tr><td></td><td align=\"right\">+ ------------</td></tr>\n";
  echo "<tr><td>".$ary_lang["invoice_total_vatex"]."</td><td align=\"right\"> &euro; $str_totalexclvat</td></tr>\n";
  echo "<tr><td>".$ary_lang["invoice_total_vat"]."</td><td align=\"right\"> &euro; $str_vatamount</td></tr>\n";
  echo "<tr><td></td><td align=\"right\">+ ------------</td></tr>\n";
  echo "<tr><td><strong>".$ary_lang["invoice_total"]."</strong></td><td align=\"right\"><strong> &euro;
      $str_totalcost</strong></td></tr></table>";
  echo "</td></tr></table>";
}

/*********************************************************
 * Function printbankinfo
 * Will return a string with the default Iwex bank info.
 *********************************************************/
function printbankinfo($ary_lang)
{
  $return_txt = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"cellline\">\n";
  $return_txt .= "<tr><th>".$ary_lang["footer_html_kvk"]."</th><th>".$ary_lang["footer_html_vat"]."</th>
						<th>".$ary_lang["footer_html_banknum"]."</th>
		 				<th>".$ary_lang["footer_html_iban"]."</th><th>".$ary_lang["footer_html_swift"]."</th></tr>";
  $return_txt .= "<tr><td ROWSPAN=2>" . KVK . "</td><td ROWSPAN=2>".IWEX_VAT_NUMBER."</td>";
  $return_txt .= "<td>".$ary_lang["footer_gironame"]." ".GIRO."</td><td>".IBANGIRO."</td><td>".SWIFTGIRO."</td></tr>\n";
  $return_txt .= "<tr><td>".$ary_lang["footer_bankname"]." ".BANK."</td><td>".IBANBANK."</td><td>".SWIFTBANK."</td></tr>\n";
  $return_txt .=  "</table>";
  return $return_txt ;
}

/**
 * Function PrintCreditStatus
 * Will return a string with customers credit status
 * Input    : $int_customer_id, The ID of the customer
 * Returns  : HTMl string with the status.
 **/
function PrintCreditStatus($int_customer_id)
{
  $return_txt = "";
  if ($int_customer_id)
  {
    $return_txt .= "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"cellline\">\n";
    $return_txt .= "<tr><th> Krediet limiet </th><th> Gebruikt </th><th> Te besteden </th></tr>";
    $return_txt .= "<tr><td align=right>&euro; "
        .ToDutchNumber(CurrentCreditLimit($int_customer_id))."</td><td align=right>&euro; "
        .ToDutchNumber(GetOpenInvoiceAmount($int_customer_id))."</td><td align=right>&euro; "
        .ToDutchNumber(CurrentCreditAmount($int_customer_id))."</td></tr>\n";
    $return_txt .=  "</table>\n";
  }
  return $return_txt ;
}

/*********************************************************
 * Function     : PrintInvoiceID
 * Input        : int_invoiceID, The id of the invoice.
 *                bl_orig, True when the orignal is requested.
 *                str_format, html or pdf output format.
 *                int_print, 0 for only displaying
 *                           1 when direct print,
 *                           2 for print and close window.
 *                bl_color, True when the invoice should 
 *                          be color. False for B&W.
 *********************************************************/
function PrintInvoiceID(
    $int_invoiceID,
    $bl_orig = FALSE,
    $str_format = "pdf",
    $int_print = 0,
    $bl_color = FALSE)
{
  global $_GLOBAL;
  $int_shipID = GetField("SELECT shipmentID FROM invoices WHERE InvoiceID = '$int_invoiceID'");
  if ($int_shipID)
  {
    PrintInvoice($int_shipID,
        $bl_orig,
        $str_format,
        $int_print,
        $bl_color);
  }
  else
  { //no shipment so this is an admin order
    $strOriginal = $bl_orig ? '&original=1' : '';
    $int_order_id = GetField("SELECT orderID FROM invoices WHERE InvoiceID = '$int_invoiceID'");
    echo "<script>location.replace('".$_GLOBAL["str_backdir"].ORDERCOMFIRM."?orderID=$int_order_id&format=".FORMAT_PDF."&invoice=1".$strOriginal."');</script>";
  }
}

/**
 * Function     : PDFshipmentDetailsInvoice
 * Input        : int_shipID, The id of the shipment record
 * 				              to show the invoice.
 *                bl_orig, True when the orignal is requested.
 *                $int_contactID,
 $bl_color,
 $bl_orig = FALSE,
 $bl_proforma = FALSE,
 *				  bl_writetemp, True when store on disk
 * 				  str_tempname = file name on the disk
 *				  bl_Protection = should the file be encripted
 * Returns      : The invoiceid when invoiced is created.
 * 				  False otherwise.
 **/
function PDFshipmentDetailsInvoice($int_shipID, 
    $bl_orig,
    $bl_color,
    $bl_orig = FALSE,
    $bl_proforma = FALSE,
    $bl_writetemp = FALSE,
    $str_tempname = "tempinvoice",
    $bl_Protection = FALSE)
{
  global $db_iwex, $ary_languages, $ary_lang;
  $bl_cust_pdf_loaded = FALSE;

  $int_invoiceID = GetInvoiceID($int_shipID);
  $str_proforma_id = "";

  // Set the needed lang text.
  $sql_language_sel =  "SELECT language, languages.languageID, contacts.ContactID
							  FROM shipments 
							  INNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID
							  INNER JOIN contacts ON Adressen.ContactID = contacts.ContactID
							  INNER JOIN languages ON languages.languageID = contacts.languageID 
							  WHERE Shipment_ID = '$int_shipID' ";
  $qry_ship = $db_iwex->query($sql_language_sel);

  $str_language = FALSE;
  $int_languageID = FALSE;
  $int_contactID = FALSE;

  if ($obj_shipinfo = mysql_fetch_object($qry_ship))
  {
    $str_language = $obj_shipinfo->language;
    $int_languageID = $obj_shipinfo->languageID;
    $int_contactID = $obj_shipinfo->ContactID;
    //var_dump($obj_shipinfo);
    mysql_free_result($qry_ship);
  }

  $ary_lang = $ary_languages["$str_language"];

  //Instanciation of inherited class
  $pdf=new InvoicePDF('P','mm','A4');
  if ($bl_Protection)
  {
    $pdf->SetProtection(array('print'));
    $pdf->SetMargins(15,20,15);
  } else
  {
  // See if a template can be found for invoices. This import only works for non encrypted pdf files.
    $str_cust_filname = $GLOBALS["ary_config"]['customerdocs']."/".
        CUST_PACKING_LIST_FILE_NAME.$GLOBALS["ary_config"]['own company'].".pdf";

    if (file_exists($str_cust_filname))
    {
      $bl_cust_pdf_loaded = $pdf->setSourceFile($str_cust_filname);
      $pdf_cust_page = $pdf->ImportPage(1);
      $pdf->usebankinfo(FALSE);
    }
    $pdf->SetMargins(10,20,20);
  }

  $pdf->SetColor($bl_color);

  if ($bl_proforma
      &&
      !$int_invoiceID)
  {
    $pdf->SetProformaInvoice(TRUE);
    $str_invoiceID = "PFS".$int_shipID."R".rand(1, 99); // Generate a random nummber to make the proforma more unique.
    $pdf->SetFootTxt(str_replace("X",
        $str_invoiceID,
        $ary_lang["proforma_footer"]) . getcontactname($int_contactID));
    // Create a query to select the shipment
    $sql_shipments =   "SELECT Shipment_ID, Ship_date, btw_number, Adressen.*, country.country
								FROM shipments
								INNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID
								INNER JOIN contacts ON Adressen.ContactID = contacts.ContactID
								INNER JOIN country ON country.code = Adressen.land 
						        WHERE Shipment_ID = '$int_shipID' ";

    $query = $db_iwex->query($sql_shipments);

    if ($objshipment = mysql_fetch_object($query))
    {

      $str_shipto = "$objshipment->Naam\n"
          ."$objshipment->straat huisnummer\n"
          ."$objshipment->postcode  $objshipment->plaats\n"
          ."$objshipment->country";

      $str_invoice_adres = GetInvoiceAdres($int_contactID);

      $str_vat_number = $objshipment->btw_number;

      $str_invoice_date = date("j-n-Y",
          strtotime($objshipment->Ship_date ? $objshipment->Ship_date
          : "now"));

      $str_duedate = "";

      mysql_free_result($query);
    }
    $str_duedate = FALSE;

  } else
  {
    $pdf->SetCopyInvoice(!$bl_orig);
    $pdf->SetFootTxt(str_replace("X",
        "$int_invoiceID",
        $ary_lang["order_footer"]) . getcontactname($int_contactID));
    $str_invoiceID = $int_invoiceID;

    // Create a query to select the shipment
    $sql_shipments =   "SELECT Shipment_ID, Ship_date, invoices.*, btw_number,
										IF(endmonth, 
										   DATE_ADD(CONCAT(YEAR(Invoice_date),
														 '-',
														 MONTH(Invoice_date),
														 '-01'),
												  INTERVAL 1 MONTH) - INTERVAL 1 DAY,
										   Invoice_date) + INTERVAL days DAY AS duedate
								FROM invoices
								INNER JOIN shipments ON invoices.ShipmentID = shipments.Shipment_ID 
								INNER JOIN contacts ON invoices.CustomerID = contacts.ContactID 
								LEFT JOIN paymentterm ON invoices.Paymentterm = PaymentTermID
						        WHERE invoices.InvoiceID = $int_invoiceID";

    $query = $db_iwex->query($sql_shipments);

    if ($objshipment = mysql_fetch_object($query))
    {
      $date_invoice = strtotime($objshipment->Invoice_date) < strtotime($objshipment->Ship_date) && $objshipment->Ship_date
          ? $objshipment->Invoice_date : $objshipment->Ship_date;

      $str_shipto = "$objshipment->ShipName\n";
      $str_shipto .= "$objshipment->ShipAddress\n"
          ."$objshipment->ShipPostalCode  $objshipment->ShipCity\n"
          ."$objshipment->ShipCountry";
      $str_invoice_adres = "$objshipment->companyName\n"
          ."$objshipment->Address\n"
          ."$objshipment->PostalCode  $objshipment->City\n$objshipment->Country";
      $str_vat_number = $objshipment->vat_number ? $objshipment->vat_number : $objshipment->btw_number;

      $str_invoice_date = date("j-n-Y",
          strtotime($date_invoice));

      $str_duedate = $objshipment->duedate;

      mysql_free_result($query);
    }
  }

  $pdf->Open();
  $pdf->AliasNbPages();
  $pdf->AddPage();

  if ($bl_cust_pdf_loaded)
  {
    $pdf->useTemplate($pdf_cust_page,
        0,
        0);
  }
  $pdf->SetFont('Arial','',10);

  $pdf->Ln(5);

  $pdf->SetWidths(array(30,59.5,30,59.5));
  $pdf->SetAligns(array('L','L','L','L'));
  $pdf->SetBorders(array('','','','',''));
  $pdf->SetHight(5);

  $pdf->Row(array($ary_lang["invoice_address"],
      $str_invoice_adres,
      $ary_lang["invoice_delivery"],
      $str_shipto));
  $pdf->Ln(5);

  $pdf->SetWidths(array(29.833,29.833,29.833,29.833,29.833,29.833));
  $pdf->SetAligns(array('C','C','C','C','C','C'));
  $pdf->SetBorders(array('F','F','F','F','F','F'));
  $pdf->SetHight(4);
  $date_shipdate = GetField("SELECT Ship_date FROM shipments WHERE Shipment_ID = $int_shipID");
  $str_shipdate = $date_shipdate ? date("j-n-Y",strtotime($date_shipdate)) : "";

  $pdf->PDFtable(array($ary_lang["invoice_number"], $ary_lang["invoice_date"], $ary_lang["invoice_delivery_number"],
      $ary_lang["invoice_customer_number"], $ary_lang["invoice_vat_number"], $ary_lang["invoice_ship_date"]),
      array(array($str_invoiceID,
      $str_invoice_date,
      $int_shipID,
      $int_contactID,
      $str_vat_number,
      $str_shipdate
      )
      )
  );
  $pdf->Ln(5);

  // 26 may 05 AK added 'AND NOT orders.consignment_order' to filter out orders for consignment
  $sql_orders = "SELECT DISTINCT inventory_transactions.OrderID, ContactsOrderID, OrderDate, Comments, rma_yn
			FROM inventory_transactions 
			INNER JOIN orders ON inventory_transactions.OrderID = orders.OrderID
            WHERE shipmentID = $int_shipID AND NOT orders.consignment_order";
  $query_orders = $db_iwex->query($sql_orders);

  $flt_ordercost = 0; // Sum of the order/shipment cost
  $flt_productcost = 0; // Sum of the product cost
  $flt_vatamount = 0; // Sum of the VAT amount.

  while ($obj_orders = mysql_fetch_object($query_orders))
  {
    $sql_inventoryt = "SELECT inventory_transactions.ProductID,
			 order_details.ProductName, current_product_list.ProductName AS orgProductName, inventory_transactions.Description,
			 inventory_transactions.UnitPrice, sum(UnitsSold) as UnitsSold, Quantity,
             inventory_transactions.btw_percentage, added_cost, Merk, CustOrderRowID
			FROM inventory_transactions 
            LEFT JOIN order_details ON order_details.OrderID = inventory_transactions.OrderID
                                       AND order_details.OrderDetailsID = inventory_transactions.OrderDetailsID
            INNER JOIN orders ON order_details.OrderID = orders.OrderID
            INNER JOIN current_product_list ON inventory_transactions.ProductID = current_product_list.ProductID
			WHERE shipmentID = $int_shipID
                AND inventory_transactions.OrderID = $obj_orders->OrderID
                AND UnitsSold
                AND NOT orders.consignment_order
            GROUP BY inventory_transactions.ProductID, order_details.OrderDetailsID
            ORDER BY order_details.OrderDetailsID, inventory_transactions.TransactionID";
    $query_invetory = $db_iwex->query($sql_inventoryt);

    //set the varaible to recognise an rma order
    $bl_rma = isset($obj_orders->rma_yn) ? $obj_orders->rma_yn : FALSE;

    if ($bl_rma)
    {
      $header = array($ary_lang["invoice_rmaid"], $ary_lang["invoice_rma_id"], $ary_lang["invoice_rma_name"],
          $ary_lang["invoice_rma_merk"], $ary_lang["invoice_rma_ref"], $ary_lang["invoice_rma_price"],
          $ary_lang["invoice_rma_deliverd"], $ary_lang["invoice_rma_subtotal"], $ary_lang["invoice_rma_vat"]);
      $str_header = "$obj_orders->ContactsOrderID";
    } else
    {
      $header = array($ary_lang["invoice_product_id"], $ary_lang["invoice_prodduct_extid"],
          $ary_lang["invoice_product_name"], $ary_lang["invoice_product_merk"],
          $ary_lang["invoice_product_ref"], $ary_lang["invoice_product_price"],
          $ary_lang["invoice_product_deliverd"], $ary_lang["invoice_product_subtotal"],
          $ary_lang["invoice_product_vat"]);
      $str_header = $ary_lang["invoice_order_ref"] . "$obj_orders->ContactsOrderID";
    }

    $str_header .= $ary_lang["invoice_order_num"] . "$obj_orders->OrderID      "
        .$ary_lang["invoice_order_date"].(isset($obj_orders->OrderDate) ?
        date("j-n-Y",strtotime($obj_orders->OrderDate)) : "");
    if ($obj_orders->Comments)
    {
      $str_header .= $ary_lang["invoice_order_comment"] . "$obj_orders->Comments";
    }

    $pdf->SetWidths(array(12,16,71,17,10,14,12,19,8));
    $pdf->SetAligns(array('R','L','L','L','R','R','R','R','R'));
    $pdf->SetBorders(array('F','F','F','F','F','F','F','F','F'));
    $pdf->SetHight(4);

    $flt_thisrow_order_cost = 0;
    $int_rowcnt = 0;
    $flt_max_vat = 0;

    $tabledata = array(); // Clear table data.
    while ($obj_inventory = mysql_fetch_object($query_invetory))
    {
      $flt_row_price = $obj_inventory->UnitPrice*$obj_inventory->UnitsSold;
      $str_row_price = ToDutchNumber(sprintf("%.2f", $flt_row_price));

      $flt_vat = 100*$obj_inventory->btw_percentage;
      $flt_max_vat = (($flt_vat) > $flt_max_vat) ? $flt_vat : $flt_max_vat;
      if ($bl_rma)
      {
        $str_ext_ID_column = GetField("SELECT RMAID FROM RMA_actions WHERE ActionID = $obj_inventory->Description");
        $str_name_column = $obj_inventory->ProductName;
        $str_quantity_column = GetField("SELECT RMA.Customer_ID FROM RMA_actions
                        INNER JOIN RMA ON RMA_actions.RMAID = RMA.ID
                        WHERE RMA_actions.ActionID = $obj_inventory->Description");
      } else
      {
        $str_ext_ID_column = $obj_inventory->CustOrderRowID;
        $str_name_column = $obj_inventory->ProductName;
        $str_quantity_column = $obj_inventory->Quantity;
      }

      // When empty string use the one from current product list.
      $str_prod_name = $obj_inventory->ProductName = "" || !$obj_inventory->ProductName ? $obj_inventory->orgProductName : $obj_inventory->ProductName;
      $tabledata[$int_rowcnt++] = array($obj_inventory->ProductID,
          $str_ext_ID_column,
          $str_name_column,
          $obj_inventory->Merk,
          $str_quantity_column,
          ToDutchNumber($obj_inventory->UnitPrice),
          $obj_inventory->UnitsSold,
          $str_row_price,
          $flt_vat."%" );

      $flt_thisrow_order_cost += $obj_inventory->added_cost * $obj_inventory->UnitsSold; // Added costs
      $flt_ordercost += $obj_inventory->added_cost * $obj_inventory->UnitsSold; // Added costs
      $flt_productcost += $flt_row_price;
      $flt_vatamount += ($obj_inventory->added_cost + $obj_inventory->UnitPrice) * $obj_inventory->UnitsSold * $obj_inventory->btw_percentage;
    }

    $str_hisrow_order_cost = ToDutchNumber(sprintf("%.2f", $flt_thisrow_order_cost));

    $pdf->PDFtable($header, $tabledata, $str_header);

    if ($flt_thisrow_order_cost)
    {
      $pdf->Ln(0);
      $pdf->Cell(12+16,4,"",'B',0,'R');
      $pdf->Cell((71+17+10+14+12),4,$ary_lang["invoice_order_costs"],'B',0,'L');
      $pdf->Cell(19,4,"$str_hisrow_order_cost",'B',0,'R');
      $pdf->Cell(8,4,$flt_vat."%",'B',1,'R');
    }

    // Generate the PDF table.
    $pdf->Ln(3);

    mysql_free_result($query_invetory);
  }
  mysql_free_result($query_orders);

  $flt_totalcost = $flt_productcost + $flt_ordercost + $flt_vatamount;
  //    echo "$flt_totalcost $flt_productcost $flt_ordercost $flt_vatamount";

  $str_paymentterm = FALSE;
  // Chech amount in the invoice with the calculated amount
  if ($int_invoiceID)
  {
    CompareTotalAmountWithInvoice($int_invoiceID, $flt_totalcost);

    $str_paymentterm = GetPaymentTermInvoice($int_invoiceID,
        &$int_payment_term_id,
        &$bl_incasso);
  }

  // When there is no paymentterm in the invoice table use the one from the contacts table.
  if (!$str_paymentterm)
  {
    GetPaymentTerm($int_contactID,
        &$str_paymentterm,
        &$int_payment_term_id,
        $int_languageID);
  }

  $int_payment_days = GetField("SELECT days FROM paymentterm WHERE PaymentTermID = $int_payment_term_id");

  $str_totalexclvat = ToDutchNumber(round($flt_productcost + $flt_ordercost, DB_INVOICE_PRECISION));
  $str_vatamount = ToDutchNumber(round($flt_vatamount, DB_INVOICE_PRECISION));
  $str_totalcost = ToDutchNumber(round($flt_productcost + $flt_ordercost,
      DB_INVOICE_PRECISION) +
      round($flt_vatamount,
      DB_INVOICE_PRECISION));

  // When there is not enough room for the amount box add a new page.
  if($pdf->GetY()+4*5>$pdf->PageBreakTrigger)
  {
    $pdf->AddPage($pdf->CurOrientation);
    if ($bl_cust_pdf_loaded)
    {
      $pdf->useTemplate($pdf_cust_page,0,0);
    }
  }

  $pdf->SetDrawColor(0);
  $pdf->SetLineWidth(0.7);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(100,
      10,
      $ary_lang["invoice_payment_term"]." $str_paymentterm",
      1,
      0,
      'L');

  $pdf->SetFont('Arial','',10);

  $pdf->SetX(-76);
  $pdf->Cell(40,5, $ary_lang["invoice_total_vatex"],'LT',0,'L');
  $pdf->Cell(20,5," $str_totalexclvat",'RT',2,'R');
  $pdf->SetX(-76);

  $pdf->Cell(40,5,$ary_lang["invoice_total_vat"] ,'L',0,'L');
  $pdf->Cell(20,5," $str_vatamount",'R',2,'R');

  $pdf->SetX(-76);
  $pdf->Cell(40,5,"",'L',0,'L');
  $pdf->Cell(20,5,"+ ------------",'R',2,'R');
  if ($int_payment_term_id != DB_PAYMENT_TERM_REMBOURS
      &&
      $int_payment_days>0
      &&
      ($flt_productcost + $flt_ordercost) != 0.0)
  {
    $pdf->Ln(0);
    if ($bl_incasso)
    {
    // Print the incasso date on the invoice.
      $int_bank_account_num = GetField("SELECT Bankinfo FROM contacts WHERE ContactID = $int_contactID");
      $pdf->SetFont('Arial','',8);
      $pdf->Cell(70,
          5,
          str_replace("Y",
          "$int_bank_account_num",
          str_replace( "X",
          date("j-n-Y",
          strtotime($str_duedate)),
          $ary_lang["invoice_payment_incasso"])),
          '',
          0);
      $pdf->SetFont('Arial','',10);
    } else
    { // Print the last day to pay on the invoice
      $pdf->Cell(70,
          5,
          $ary_lang["invoice_duedate"] .date("j-n-Y",
          strtotime($str_duedate)),
          '',
          0);
    }
  }
  $pdf->SetFont('Arial','B',10);
  $pdf->SetX(-76);
  $pdf->Cell(40,5, $ary_lang["invoice_total"],'LB',0,'L');
  $pdf->Cell(20,5," $str_totalcost",'BR',2,'R');

  if ($bl_writetemp)
  {
    $pdf->Output($GLOBALS['ary_config']['temp_dir']."/$str_tempname.pdf" , 'F');
  } else
  {
    $pdf->Output();
  }

  return $int_invoiceID;
}

/*********************************************************
 * Function     : PrintInvoice
 * Input        : int_shipID, The id of the shipment record
 * 				              to show the invoice.
 *                bl_orig, True when the orignal is requested.
 *                str_format, html or pdf output format.
 *                int_print, 0 for only displaying
 *                           1 when direct print,
 *                           2 for print and close window.
 *                bl_color, True when the invoice should 
 *                          be color. False for B&W.
 *				  bl_writetemp, True when store on disk
 * 				  str_tempname = file name on the disk
 *				  bl_Protection = should the file be encripted
 * Returns      : The invoiceid when invoiced is created. 
 * 				  False otherwise.
 *********************************************************/
function PrintInvoice($int_shipID, 
    $bl_orig = FALSE,
    $str_format = "pdf",
    $int_print = 0,
    $bl_color = FALSE,
    $bl_writetemp = FALSE,
    $str_tempname = "tempinvoice",
    $bl_Protection = FALSE)
{
  $bl_orig;
  global $db_iwex;
  $bl_returnvalue = FALSE;
  $int_invoiceID = GetInvoiceID($int_shipID);
  $bl_pdf = !strcasecmp($str_format, FORMAT_PDF);

  if (!$int_invoiceID)
  {
    $int_invoiceID = InsertInvoiceDelivery($int_shipID);
    $bl_orig = TRUE;
  }

  $int_invoiceID = PDFshipmentDetailsInvoice($int_shipID,
      $bl_orig,
      $bl_color,
      $bl_orig,
							  /*$bl_proforma = */ FALSE,
      $bl_writetemp,
      $str_tempname,
      $bl_Protection);

  return $int_invoiceID;
}

/*********************************************************
 * Function     : ToDutchNumber
 * Input        : str, Input string
 * Returns      : A string with the . replaced by a ,
 *********************************************************/
Function ToDutchNumber($str)
{
  return number_format($str, 2, ',', '.');
}

/*********************************************************
 * Function     : printbackorderlist
 * Input        : int_contactID, The id of the customer
 * Returns      : A complete formatted string that contains the backorderlist.
 *********************************************************/
Function printbackorderlist($int_contactID,
    $int_OrderID='',
    $int_ship_adres = FALSE)
{
  if ($int_contactID)
  {
    $sql_contactdetails = "Select ContactID, CompanyName FROM contacts WHERE
         ContactID = $int_contactID;";
    $query_contactdetails = mysql_query($sql_contactdetails)
        or die("Ongeldige query contactdetails: " . mysql_error());
    if ($obj = mysql_fetch_object($query_contactdetails))
    {
      $ret_string = "\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n<tr>\n";
      $ret_string .= "<th align='left'>Backorderlijst voor: $obj->CompanyName";
      $ret_string .= ($int_ship_adres ? " voor afleveradres : ".GetField("select CONCAT_WS(', ', Naam, attn, plaats)
                                                                            from Adressen 
                                                                            WHERE AdresID = $int_ship_adres")
          : "")
          . "</th></tr>\n";
      $ret_string .= "<tr><TH ALIGN='right'><small>Verwacht -> Datum wanneer het artikel bij ons op voorraad verwacht wordt.</small></TH></TR>
						<tr><TH ALIGN='right'><small>% -> Betrouwbaarheid van de verwachting</small></th>\n</tr>\n"; 
      $ret_string .=	"</table>\n";
      $ret_string .= "<hr>";
      // Create a query to select all shipments with open articles for contactID
      $sql_openorders = "SELECT ContactsOrderID, OrderDate, OrderID, Comments, Naam, Plaats
			FROM orders
			LEFT JOIN Adressen ON Adressen.AdresID = orders.ShipID
            WHERE " . openordedetails_condition . "
            AND OrderDate > '2004-01-01 00:00:00'
            AND orders.ContactID = $int_contactID
            AND OrderID <> '$int_OrderID' "
          .($int_ship_adres ? "AND orders.ShipID = $int_ship_adres" : "")
          ." ORDER BY Naam, OrderDate";

      $query_openorders = mysql_query($sql_openorders)
          or die("Ongeldige open orders query: " . $sql_openorders.  mysql_error());

      if (mysql_numrows($query_openorders))
      {
        while ($objopenorders = mysql_fetch_object($query_openorders))
        {
          upd_orderstatus($objopenorders->OrderID);
        }
      }
      mysql_free_result($query_openorders);

      $query_openorders = mysql_query($sql_openorders)
          or die("Ongeldige open orders query: " . $sql_openorders.  mysql_error());
      if (mysql_numrows($query_openorders))
      {
        while ($objopenorders = mysql_fetch_object($query_openorders))
        {
          $ret_string .= "\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"blockbody\">\n";
          $ret_string .= "<tr>\n<td colspan='9'>";
          $ret_string .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"blockbody\">\n";
          $ret_string .= "<tr>\n<th width='100'>Uw ref.</th><th width='100'>Order</th><th width='150'>Order datum</th>";
          $ret_string .= $int_ship_adres ? "" : "<th width='200'>Aflever adres</th>";
          $ret_string .= "<th>Notities</th></tr>\n";
          $ret_string .= "<tr>\n<td align=center class=\"cellline\">$objopenorders->ContactsOrderID</td><td align=center class=\"cellline\">$objopenorders->OrderID</td>";
          $ret_string .= "<td align=center class=\"cellline\">$objopenorders->OrderDate</td>";
          $ret_string .= $int_ship_adres ? "" : "<td align=center class=\"cellline\"><strong>$objopenorders->Naam, $objopenorders->Plaats</strong></td>";
          $ret_string .= "<td align=center class=\"cellline\">$objopenorders->Comments</td>\n</tr>";
          $ret_string .= "</table>\n";
          $ret_string .= "</td></tr>";
          $sql_details = "SELECT
                  OrderDetailsID, OrderID, order_details.ProductID, order_details.ProductName,
                  order_details.ProductDescription, UnitPrice, Quantity, Extended_price, btw_percentage,
                  cost_percentage, to_deliver, manual_price, last_exp, exp_rating, merk, ExternalID
                  FROM order_details
                  INNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID
                  WHERE OrderID = $objopenorders->OrderID
                  ORDER BY ProductID";
          $query_details = mysql_query($sql_details)
              or die("Ongeldige query: " . mysql_error());

          $ret_string .= "<tr><th><small>ID</small></th><th><small>merk</small></th>"
              ."<th><small>Ext. ID</small></th><th><small>Naam</small></th>"
              .($int_ship_adres ? "" : "<th><small>Prijs/stuk</small></th>")
              ."<th><small>Besteld</small></th><th><small>Backorder</small></th>"
              ."<th><small>Verwacht</small></th><th><small>%</small></th>\n</tr>\n";

          $flt_thisrow_order_cost = 0;
          while ($obj_details = mysql_fetch_object($query_details))
          {
            if ($obj_details->to_deliver>0)
            {
              if ($obj_details->ProductID<>0)
              {
                $str_row_price = sprintf("%,2f", $obj_details->UnitPrice);
                $ret_string .= "<tr>\n<td align=center width='50'>$obj_details->ProductID</td>
                         				 <td>$obj_details->merk</td>
                                         <td>$obj_details->ExternalID</td>
                                         <td>$obj_details->ProductName</td>";
                $ret_string .= $int_ship_adres ? "" : "<td width='50' align=right>$obj_details->UnitPrice</td>";
                $ret_string .= "<td width='50' align=right>$obj_details->Quantity</td>";
                $ret_string .= "<td width='50' align=right>$obj_details->to_deliver</td>\n";
                $ret_string .= "<td WIDTH='80' align=center>".date("d-M-Y",
                    strtotime(GetDeliveryDate($obj_details->ProductID,
                    $objopenorders->OrderID)
                    )
                    )."</td>\n";
                !$obj_details->exp_rating ? $obj_details->exp_rating = 25 : $obj_details->exp_rating;
                $ret_string .= "<td width='20' align=right>".$obj_details->exp_rating."%</td>\n</tr>\n";
              }
            }
          }
          $str_hisrow_order_cost = sprintf("%.2f", $flt_thisrow_order_cost);
          $ret_string .= "</table>\n<br>";

          mysql_free_result($query_details);
        }
        mysql_free_result($query_openorders);
        $ret_string .= "<br>";
      } else
      {
        $ret_string = "<br>Geen open orders.<br>";
      }
    } else
    {
      echo "no contactdetails ";
    }
  }
  return $ret_string;
}

/*********************************************************
 * Function     : ShowAdresDetails
 * Input        : bl_submit, TRUE when the data should be updated
 *                int_contactID, The id of the customer
 * Returns      : A complete formatted string that contains the adress information.
 *********************************************************/
function ShowAdresDetails($bl_submit, $int_customerID, $formname='customer')
{
  $str_return = '';
  $_GLOBAL["str_backdir"] = '../';

  $bl_override = edit_button(); // Get Override checkbox
  $DB_iwex = new DB();

  if ($bl_submit
      && $int_customerID
      && $bl_override)
  {
  // Create a query to select the adresses.
    $qry_select_adres = $DB_iwex->query(SQL_ADRESSEN_QUERY . "WHERE ContactID = '$int_customerID'");

    while ($obj_update = mysql_fetch_object($qry_select_adres))
    {
    // update records
      if (isset($_POST["adr_adrestitel$obj_update->AdresID"]))
      {
        $sql_update_adres = "UPDATE Adressen SET
                                    Prive_adres = '".GetCheckbox("prive_adres$obj_update->AdresID")."',
                                    adrestitel = '".$_POST["adr_adrestitel$obj_update->AdresID"]."',
                                    email = '".$_POST["adr_email$obj_update->AdresID"]."',
                                    telefoon = '".$_POST["adr_telefoon$obj_update->AdresID"]."'";
        if (isset($_POST["adr_Naam$obj_update->AdresID"]))
        {
          $str_adres = $_POST["adr_straat$obj_update->AdresID"];
          $str_housenumber = $_POST["adr_huisnummer$obj_update->AdresID"];
          if (!$str_housenumber || $str_housenumber == "" )
          {
            $str_housenumber = GetHouseNumber(&$str_adres);
          }
          $sql_update_adres .= ", Naam = '".$_POST["adr_Naam$obj_update->AdresID"]."',
                                    attn = '".$_POST["adr_attn$obj_update->AdresID"]."',
                                    straat = '$str_adres', 
                                    huisnummer = '$str_housenumber', 
                                    postcode = '".$_POST["adr_postcode$obj_update->AdresID"]."',
                                    plaats = '".$_POST["adr_plaats$obj_update->AdresID"]."',
                                    land = '".$_POST["adr_land$obj_update->AdresID"]."'";
        }

        $DB_iwex->query($sql_update_adres . " WHERE AdresID = '$obj_update->AdresID'");
      }
    }
    mysql_free_result($qry_select_adres);

    if ((isset($_POST["adr_NaamNew"]) && $_POST["adr_NaamNew"])
        ||
        (isset($_POST["adr_attnNew"]) && $_POST["adr_attnNew"]))
    {
    //When new records have been added, insert these first
      $str_adres = $_POST["adr_straatNew"];
      $str_housenumber = $_POST["adr_huisnummerNew"];
      if (!$str_housenumber || $str_housenumber == "" )
      {
        $str_housenumber = GetHouseNumber(&$str_adres);
      }
      $sql_insert_adres = "INSERT INTO Adressen SET
                                ContactID = $int_customerID, 
                                adrestitel = '".$_POST["adr_adrestitelNew"]."',
                                Naam = '".$_POST["adr_NaamNew"]."',
                                attn = '".$_POST["adr_attnNew"]."',
                                straat = '$str_adres', 
                                huisnummer = '$str_housenumber', 
                                postcode = '".$_POST["adr_postcodeNew"]."',
                                plaats = '".$_POST["adr_plaatsNew"]."',
                                land = '".$_POST["adr_landNew"]."',
                                email = '".$_POST["adr_emailNew"]."',
                                telefoon = '".$_POST["adr_telefoonNew"]."',
                                Prive_adres = '".GetCheckbox("prive_adresNew")."'";
      $DB_iwex->query($sql_insert_adres);
    }
  } // End update

  // Get the data.
  //echo SQL_ADRESSEN_QUERY . "WHERE ContactID = '$int_customerID'<br>";
  $qry_select_adres = $DB_iwex->query(SQL_ADRESSEN_QUERY . "WHERE ContactID = '$int_customerID'
                                            ORDER BY adrestitel = 3 desc, adrestitel = 1 desc, adrestitel asc, Naam asc, attn");

  $str_return .= "<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"1\" class=\"blockbody\">\n";
  $str_return .= "<tr><th>" . edit_button('waccess_s',$formname)
      ." Type</th><th>ID</th><th>Naam</th><th>T.a.v.</th><th>Straat</th><th>num.</th><th>Postcode</th><th>Plaats</th><th>Land</th><th>Prive</th><th>e-mail</th><th>Tel.</th></tr>\n";

  while ($obj_adres = mysql_fetch_object($qry_select_adres))
  {
    $str_return .= "<tr>\n";
    if ($bl_override)
    {
      $str_return .= "<td><a href='javascript:void()' onClick=\"window.open('".$_GLOBAL["str_backdir"]."label.php?adresid=$obj_adres->AdresID','Betalingen','toolbar=1,menubar=0,resizable=1,scrollbars=1,dependent=0,status=0,width=600,height=500,left=25,top=25');\">Print</a> ";
      $str_return .= makelistbox(GET_TITELS, "adr_adrestitel$obj_adres->AdresID","TitelID","titel", $obj_adres->adrestitel)."</td>";
    } else
    {
      $str_return .= "<td><a href='javascript:void()' onClick=\"window.open('".$_GLOBAL["str_backdir"]."label.php?adresid=$obj_adres->AdresID','Betalingen','toolbar=1,menubar=0,resizable=1,scrollbars=1,dependent=0,status=0,width=600,height=500,left=25,top=25');\">Print</a> ";
      $str_return .= GetField("SELECT titel FROM Adrestitels WHERE TitelID = $obj_adres->adrestitel")."</td>";
    }
    if ($bl_override
        &&
        !GetField("SELECT COUNT(OrderID) FROM orders WHERE ShipID = $obj_adres->AdresID"))
    {
      $str_return .= "<td>$obj_adres->AdresID</td>\n";
      $str_return .= "<td><input size=\"20\" name=\"adr_Naam$obj_adres->AdresID\" type=\"text\" value=\"$obj_adres->Naam\"></td>\n";
      $str_return .= "<td><input size=\"20\" name=\"adr_attn$obj_adres->AdresID\" type=\"text\" value=\"$obj_adres->attn\"></td>\n";
      $str_return .= "<td><input size=\"25\" name=\"adr_straat$obj_adres->AdresID\" type=\"text\" value=\"$obj_adres->straat\"></td>\n";
      $str_return .= "<td><input size=\"3\" align='right' name=\"adr_huisnummer$obj_adres->AdresID\" type=\"text\" value=\"$obj_adres->huisnummer\"></td>\n";
      $str_return .= "<td><input size=\"7\" name=\"adr_postcode$obj_adres->AdresID\" type=\"text\" value=\"$obj_adres->postcode\"></td>\n";
      $str_return .= "<td><input size=\"10\" name=\"adr_plaats$obj_adres->AdresID\" type=\"text\" value=\"$obj_adres->plaats\"></td>\n";
      $str_return .= "<td>".makelistbox(GET_COUNTRYS, "adr_land$obj_adres->AdresID", 'code' ,'code', $obj_adres->land)."</td>\n";
    } else
    {
      $str_return .= "<td>$obj_adres->AdresID</td>\n";
      $str_return .= "<td>$obj_adres->Naam</td>\n";
      $str_return .= "<td>$obj_adres->attn</td>\n";
      $str_return .= "<td>$obj_adres->straat</td>\n";
      $str_return .= "<td align='right'>$obj_adres->huisnummer </td>\n";
      $str_zip = $obj_adres->land == 'NL' ? $obj_adres->postcode : ""; // ONLY Zip code in Holland work.
      $str_return .= "<td ".ShowOnMouseOverText(GetAdresFromZip($str_zip)).">$obj_adres->postcode</td>\n";
      $str_return .= "<td>$obj_adres->plaats</td>\n";
      $str_return .= "<td>$obj_adres->land</td>\n";
    }
    if ($bl_override)
    {
      $str_return .= "<td>".MakeCheckbox("prive_adres$obj_adres->AdresID",
          $obj_adres->Prive_adres,
          TRUE,
          "Vink dit aan indien dit een huis adres is.<BR>(Bij bedrijfs adressen dus niet aan vinken.)<br>UPS residentieel toeslag.")."</td>\n";
      $str_return .= "<td><input size=\"10\" name=\"adr_email$obj_adres->AdresID\" type=\"text\" value=\"$obj_adres->email\"></td>\n";
      $str_return .= "<td><input size=\"10\" name=\"adr_telefoon$obj_adres->AdresID\" type=\"text\" value=\"$obj_adres->telefoon\"></td>\n";
    } else
    {
      $str_return .= "<td>".MakeCheckbox("prive_adres$obj_adres->AdresID", $obj_adres->Prive_adres, FALSE)."</td>\n";
      $str_return .= "<td>$obj_adres->email</td>\n";
      $str_return .= "<td>". Show_Phonenumber("$obj_adres->telefoon") ."</td>\n";
    }
    $str_return .= "</tr>\n";
  }
  mysql_free_result($qry_select_adres);

  if ($bl_override)
  {
  // Display a new empty detail record at the bottom when override is clicked
    $str_return .= "<tr>\n";
    $str_return .= "<td>".makelistbox(GET_TITELS, "adr_adrestitelNew","TitelID","titel", 8)."</td>";
    $str_return .= "<td></td>";
    $str_return .= "<td><input size=\"20\" name=\"adr_NaamNew\" type=\"text\" value=\"\"></td>\n";
    $str_return .= "<td><input size=\"20\" name=\"adr_attnNew\" type=\"text\" value=\"\"></td>\n";
    $str_return .= "<td><input size=\"25\" name=\"adr_straatNew\" type=\"text\" value=\"\"></td>\n";
    $str_return .= "<td><input size=\"3\" align='right' name=\"adr_huisnummerNew\" type=\"text\" value=\"\"></td>\n";
    $str_return .= "<td><input size=\"7\" name=\"adr_postcodeNew\" type=\"text\" value=\"\"></td>\n";
    $str_return .= "<td><input size=\"10\" name=\"adr_plaatsNew\" type=\"text\" value=\"\"></td>\n";
    $str_return .= "<td>".makelistbox(GET_COUNTRYS, 'adr_landNew', 'code' ,'code', 'NL')."</td>\n";
    $str_return .= "<td>".MakeCheckbox("prive_adresNew", FALSE)."</td>\n";
    $str_return .= "<td><input size=\"10\" name=\"adr_emailNew\" type=\"text\"></td>\n";
    $str_return .= "<td><input size=\"10\" name=\"adr_telefoonNew\" type=\"text\"></td>\n";
    $str_return .= "</tr>\n";
  }
  $str_return .= "</TABLE>\n";

  return $str_return;
}

/*********************************************************
 * Function     : ShowPersonDetails
 * Input        : bl_submit, TRUE when the data should be updated
 *                int_contactID, The id of the customer
 * Returns      : A complete formatted string that contains the person information.
 *********************************************************/
function ShowPersonDetails($bl_submit, $int_customerID, $formname='customer')
{
  $str_return = '';
  $bl_override = edit_button(); // Get Override
  $DB_iwex = new DB();

  if ($bl_submit
      && $int_customerID
      && $bl_override)
  {
  // Create a query to select the adresses.
    $qry_select_personen = $DB_iwex->query(SQL_PERSONS_QUERY . "WHERE ContactID = '$int_customerID'
                                                                    ORDER BY achternaam, tussenvoegsel, voornaam");

    while ($obj_update = mysql_fetch_object($qry_select_personen))
    {
    // update records
      if (isset($_POST["pers_titel$obj_update->persoonID"]))
      {
        $sql_update_person = "UPDATE Personen SET
                                    Personen_type_ID = '".$_POST["pers_type$obj_update->persoonID"]."',
                                    titel = '".$_POST["pers_titel$obj_update->persoonID"]."',
                                    voornaam = '".$_POST["pers_firstname$obj_update->persoonID"]."',
                                    tussenvoegsel = '".$_POST["pers_middelname$obj_update->persoonID"]."', 
                                    achternaam = '".$_POST["pers_lastname$obj_update->persoonID"]."',
                                    languageID = '".$_POST["pers_lang$obj_update->persoonID"]."',
                                    email = '".$_POST["pers_email$obj_update->persoonID"]."',
                                    mailing_yn = '".GetCheckbox("pers_mailing_yn$obj_update->persoonID")."',
                                    tel = '".$_POST["pers_phone$obj_update->persoonID"]."', 
                                    fax = '".$_POST["pers_fax$obj_update->persoonID"]."', 
                                    aanhef = '".$_POST["pers_aanhef$obj_update->persoonID"]."',
                                    gender = '".$_POST["pers_geslacht$obj_update->persoonID"]."',
                                    notes = '".$_POST["pers_notes$obj_update->persoonID"]."',
                                    mobile = '".$_POST["pers_mobile$obj_update->persoonID"]."'
                                    WHERE persoonID = '$obj_update->persoonID'";
        $DB_iwex->query($sql_update_person);
      }
    }
    mysql_free_result($qry_select_personen);

    if ((isset($_POST["pers_firstnameNew"]) && $_POST["pers_firstnameNew"])
        ||
        (isset($_POST["pers_emailNew"]) && $_POST["pers_emailNew"]))
    {
    //When new records have been added, insert these first
      $sql_insert_personen = "INSERT INTO Personen SET
                                    ContactID = $int_customerID,
                                    Personen_type_ID = '".$_POST["pers_typeNew"]."',
                                    titel = '".$_POST["pers_titelNew"]."',
                                    voornaam = '".$_POST["pers_firstnameNew"]."',
                                    tussenvoegsel = '".$_POST["pers_middelnameNew"]."', 
                                    achternaam = '".$_POST["pers_lastnameNew"]."',
                                    languageID = '".$_POST["pers_langNew"]."',
                                    email = '".$_POST["pers_emailNew"]."',
                                    mailing_yn = '".GetCheckbox("pers_mailing_ynNew")."',
                                    tel = '".$_POST["pers_phoneNew"]."', 
                                    fax = '".$_POST["pers_faxNew"]."', 
                                    aanhef = '".$_POST["pers_aanhefNew"]."',
                                    gender = '".$_POST["pers_geslachtNew"]."',
                                    notes = '".$_POST["pers_notesNew"]."',
                                    mobile = '".$_POST["pers_mobileNew"]."' ";
      $DB_iwex->query($sql_insert_personen);
    }
  } // End update

  // Get the data.
  //echo SQL_ADRESSEN_QUERY . "WHERE ContactID = '$int_customerID'<br>";
  $qry_select_personen = $DB_iwex->query(SQL_PERSONS_QUERY . "WHERE ContactID = '$int_customerID'");

  $str_return .= "<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" class=\"blockbody\">\n";
  $str_return .= "<tr><th>".edit_button ('waccess_s', $formname, $bl_override)

      //MakeCheckBox('personsoverride', $bl_override, True, 'Edit', $formname, True)
      ." Type</th><th>Title</th><th>Voornaam</th><th>tussen</th><th>Achternaam</th><th>Language</th><th>e-mail</th>";
  $str_return .= "<th>Mail</th><th>telefoon</th><th>fax</th><th>mobiel</th><th>Aanhef</th>";
  $str_return .= "<th>geslacht</th><th>Notes</th></tr>\n";

  while ($obj_persoon = mysql_fetch_object($qry_select_personen))
  {
    $str_return .= "<tr>\n";
    if ($bl_override)
    {
      $str_return .= "<td>".makelistbox(GET_PERSON_TYPES, "pers_type$obj_persoon->persoonID","Personen_type_ID", "Desctription", $obj_persoon->Personen_type_ID)."</td>";
      $str_return .= "<td><input size=\"5\" name=\"pers_titel$obj_persoon->persoonID\" type=\"text\" value=\"$obj_persoon->titel\"></td>\n";
      $str_return .= "<td><input size=\"7\" name=\"pers_firstname$obj_persoon->persoonID\" type=\"text\" value=\"$obj_persoon->voornaam\"></td>\n";
      $str_return .= "<td><input size=\"3\" name=\"pers_middelname$obj_persoon->persoonID\" type=\"text\" value=\"$obj_persoon->tussenvoegsel\"></td>\n";
      $str_return .= "<td><input size=\"15\" name=\"pers_lastname$obj_persoon->persoonID\" type=\"text\" value=\"$obj_persoon->achternaam\"></td>\n";
      $str_return .= "<td>" . makelistbox("SELECT languageID, language FROM languages ",  "pers_lang$obj_persoon->persoonID","languageID", "language", $obj_persoon->languageID) . "</td>\n";
      $str_return .= "<td><input size=\"20\" name=\"pers_email$obj_persoon->persoonID\" type=\"text\" value=\"$obj_persoon->email\"></td>\n";
      $str_return .= "<td>".MakeCheckbox("pers_mailing_yn$obj_persoon->persoonID", $obj_persoon->mailing_yn)."</td>\n";
      $str_return .= "<td><input size=\"13\" name=\"pers_phone$obj_persoon->persoonID\" type=\"text\" value=\"$obj_persoon->tel\"></td>\n";
      $str_return .= "<td><input size=\"13\" name=\"pers_fax$obj_persoon->persoonID\" type=\"text\" value=\"$obj_persoon->fax\"></td>\n";
      $str_return .= "<td><input size=\"13\" name=\"pers_mobile$obj_persoon->persoonID\" type=\"text\" value=\"$obj_persoon->mobile\"></td>\n";
      $str_return .= "<td><input size=\"6\" name=\"pers_aanhef$obj_persoon->persoonID\" type=\"text\" value=\"$obj_persoon->aanhef\"></td>\n";
      $str_return .= "<td>".makelistbox(GET_GENDER, "pers_geslacht$obj_persoon->persoonID", 'id' ,'Gender', $obj_persoon->gender)."</td>\n";
      $str_return .= "<td><input size=\"10\" name=\"pers_notes$obj_persoon->persoonID\" type=\"text\" value=\"$obj_persoon->notes\"></td>\n";
    } else
    {
      $str_return .= "<td>".GetField("SELECT Desctription FROM Personen_type WHERE Personen_type_ID = $obj_persoon->Personen_type_ID")."</td>";
      $str_return .= "<td>$obj_persoon->titel</td>\n";
      $str_return .= "<td>$obj_persoon->voornaam</td>\n";
      $str_return .= "<td>$obj_persoon->tussenvoegsel</td>\n";
      $str_return .= "<td>$obj_persoon->achternaam</td>\n";
      $str_return .= "<td>".GetField("SELECT language FROM languages WHERE languageID = '$obj_persoon->languageID'") . "</td>\n";
      $str_return .= "<td><a href='mailto:$obj_persoon->email'>$obj_persoon->email</a></td>\n";
      $str_return .= "<td>".MakeCheckbox("pers_mailing_yn$obj_persoon->persoonID", $obj_persoon->mailing_yn, FALSE)."</td>\n";
      $str_return .= "<td>". Show_Phonenumber("$obj_persoon->tel") . "</td>\n";
      $str_return .= "<td>$obj_persoon->fax</td>\n";
      $str_return .= "<td>". Show_Phonenumber("$obj_persoon->mobile") ."</td>\n";
      $str_return .= "<td>$obj_persoon->aanhef</td>\n";
      $str_return .= "<td>".GetField("SELECT Gender FROM Gender WHERE id = '$obj_persoon->gender'")."</td>\n";
      $str_return .= "<td>$obj_persoon->notes</td>\n";
    }
    $str_return .= "</tr>\n";
  }
  mysql_free_result($qry_select_personen);

  if ($bl_override)
  {
  // Display a new empty detail record at the bottom when override is clicked
    $str_return .= "<tr>\n";
    $str_return .= "<td>".makelistbox(GET_PERSON_TYPES, "pers_typeNew","Personen_type_ID", "Desctription", 1)."</td>";
    $str_return .= "<td><input size=\"5\" name=\"pers_titelNew\" type=\"text\"></td>\n";
    $str_return .= "<td><input size=\"7\" name=\"pers_firstnameNew\" type=\"text\"></td>\n";
    $str_return .= "<td><input size=\"3\" name=\"pers_middelnameNew\" type=\"text\"></td>\n";
    $str_return .= "<td><input size=\"15\" name=\"pers_lastnameNew\" type=\"text\"></td>\n";
    $str_return .= "<td>" . makelistbox("SELECT languageID, language FROM languages ",
        "pers_langNew","languageID",
        "language", $obj_persoon->languageID) . "</td>";
    $str_return .= "<td><input size=\"20\" name=\"pers_emailNew\" type=\"text\"></td>\n";
    $str_return .= "<td>".MakeCheckbox("pers_mailing_ynNew", $obj_persoon->mailing_yn)."</td>\n";
    $str_return .= "<td><input size=\"13\" name=\"pers_phoneNew\" type=\"text\"></td>\n";
    $str_return .= "<td><input size=\"13\" name=\"pers_faxNew\" type=\"text\"></td>\n";
    $str_return .= "<td><input size=\"13\" name=\"pers_mobileNew\" type=\"text\"></td>\n";
    $str_return .= "<td><input size=\"6\" name=\"pers_aanhefNew\" type=\"text\"></td>\n";
    $str_return .= "<td>".makelistbox(GET_GENDER, "pers_geslachtNew", 'id' ,'Gender', $obj_persoon->gender)."</td>\n";
    $str_return .= "<td><input size=\"10\" name=\"pers_notesNew\" type=\"text\" ></td>\n";
    $str_return .= "</tr>\n";
  }
  $str_return .= "</TABLE>\n";

  return $str_return;
}

/*********************************************************
 * Function     : GetBrowserOS
 * Returns      : Result of the compare
 *********************************************************/
function GetBrowserOS($str_comp)
{
  return substr_count($_SERVER["HTTP_USER_AGENT"], $str_comp);
}

/*********************************************************
 * Function     : ShowInventoryPODetails
 * Input        : bl_submit, TRUE when the data should be updated
 *                int_podetail_ID, The id of the purchaseorder
 *                bl_edit, edit or not 
 *                date, the date of the transaction.
 * Returns      : A complete formatted string that contains the person information.
 *********************************************************/
function ShowInventoryPODetails($bl_submit, $int_podetail_ID, $bl_edit, $date = '',$format='html')
{
  $return_var = '';
  $DB_iwex = new DB();
  if ($int_podetail_ID)
  {
    $sql_inv_podetails = SQL_INVENTORY_PO_DETAIL_QUERY . " WHERE podetailsID = '$int_podetail_ID' ORDER BY TransactionDate";
  } else
  {
    $sql_inv_podetails = SQL_INVENTORY_PO_DETAIL_QUERY .
        " WHERE TransactionDate >= '$date 0:0:0' AND TransactionDate <= '$date 23:59:59'
              ORDER BY podetailsID";    
  }
  if ($bl_submit
      &&
      $int_podetail_ID)
  {
  // Create a query to select the adresses.
    $qry_inventory_podetails = $DB_iwex->query($sql_inv_podetails);

    while ($obj_update = mysql_fetch_object($qry_inventory_podetails))
    {
      if (isset($_POST["comments$obj_update->TransactionID"])
          &&
          $_POST["comments$obj_update->TransactionID"])
      {
        $sql_update_inventory = "UPDATE inventory_transactions SET
                TransactionDescription = '".$_POST["comments$obj_update->TransactionID"]."'
                WHERE TransactionID = '".$obj_update->TransactionID."'";
        //echo $sql_update_podetails.'<br>';
        $DB_iwex->query($sql_update_inventory);
      } else if (isset($_POST["delete$obj_update->TransactionID"])
            &&
            $_POST["delete$obj_update->TransactionID"]
            &&
            $bl_edit)
        {
          $sql_del_inventory = "DELETE FROM inventory_transactions
                WHERE TransactionID = '".$obj_update->TransactionID."'";
          //echo $sql_update_podetails.'<br>';
          $DB_iwex->query($sql_del_inventory);
        }
    }
    mysql_free_result($qry_inventory_podetails);
  } // End update


  //echo '<br><br>'.$sql_po_details;
  // Get the data.
  $qry_inventory_podetails = $DB_iwex->query($sql_inv_podetails);

  if (mysql_num_rows($qry_inventory_podetails))
  {
    if ($format == 'html') $return_var .= "<table width=50% border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"blockbody\">\n";
    // <th>invoice</th><th>delivered</th>\n</tr>";
    $count = 0;
    while ($obj_inventory_detail = mysql_fetch_object($qry_inventory_podetails))
    {
      if ($format == 'html')
      {
        $return_var .= "<tr>\n";
        $return_var .= "<td width=15% class=\"cellinedetail\">$obj_inventory_detail->EmployeeName</td>\n";
        $return_var .= "<td width=6 class=\"cellinedetail\">".date("d-m-y",strtotime($obj_inventory_detail->TransactionDate))."</td>\n";
        $return_var .= "<td width=5 class=\"cellinedetail\">$obj_inventory_detail->UnitsReceived</td>\n";
        $return_var .= "<td width=30 class=\"cellinedetail\">Opmerking: <INPUT TYPE=text NAME='comments$obj_inventory_detail->TransactionID' VALUE='$obj_inventory_detail->TransactionDescription'></td>\n";
        if ($bl_edit) $return_var .= "<td width=30 class=\"cellinedetail\">del: ".makecheckbox('delete'.$obj_inventory_detail->TransactionID,FALSE)."</td>\n";
        $return_var .= "</tr>\n";
      } else if ($format == 'values')
        {
          $count += 1;
          //if (!is_array($return_var)&&!$return_var) $return_var = array();
          $return_var[] = array(
              "TransactionDate" => $obj_inventory_detail->TransactionDate,
              "EmployeeName" => $obj_inventory_detail->EmployeeName,
              "UnitsReceived" => $obj_inventory_detail->UnitsReceived,
              "TransactionID" => $obj_inventory_detail->TransactionID);
        }
    }
    if ($format == 'html') $return_var .= "</TABLE>\n";
  }

  mysql_free_result($qry_inventory_podetails);

  return $return_var;
}

/*********************************************************
 * Function     : CSVsplit
 * Input        : s, string with the CSV.
 * Returns      : An array with the data.
 *********************************************************/
function CSVsplit($s)
{
  $r = Array();
  $p = 0;
  $l = strlen($s);
  while ($p < $l)
  {
    while (($p < $l) && (strpos(" \r\t\n",$s[$p]) !== false)) $p++;
    if ($s[$p] == '"')
    {
      $p++;
      $q = $p;
      while (($p < $l) && ($s[$p] != '"'))
      {
        if ($s[$p] == '\\')
        { $p+=2; continue; }
        $p++;
      }
      $r[] = stripslashes(substr($s, $q, $p-$q));
      $p++;
      while (($p < $l) && (strpos(" \r\t\n",$s[$p]) !== false)) $p++;
      $p++;
    } else if ($s[$p] == "'")
      {
        $p++;
        $q = $p;
        while (($p < $l) && ($s[$p] != "'"))
        {
          if ($s[$p] == '\\')
          { $p+=2; continue; }
          $p++;
        }
        $r[] = stripslashes(substr($s, $q, $p-$q));
        $p++;
        while (($p < $l) && (strpos(" \r\t\n",$s[$p]) !== false)) $p++;
        $p++;
      } else
      {
        $q = $p;
        while (($p < $l) && (strpos(",;",$s[$p]) === false))
        {
          $p++;
        }
        $r[] = stripslashes(trim(substr($s, $q, $p-$q)));
        while (($p < $l) && (strpos(" \r\t\n",$s[$p]) !== false)) $p++;
        $p++;
      }
  }
  return $r;
}

/*
 * Function     : swiftmt940split
 * Input        : Array from a file!
 * Returns      : An array with the data.
 */
function swiftmt940split($ary_data)
{
// Tag information
// :20: Reference
// :25: Account
//:28C: Settlement
//:60F: Opening book balance
//:61: Settlement
//:86:  Description/other info
//:84: Interest value balance 
//:65: Forecast interest value balance
//:62F: Closing book balance


// Set default setting for the transactions array.
  $ary_transactions = array();
  $int_account = -1;

  // Loop trough the $ar_dara and put every output into the $line.
  foreach ($ary_data As $str_line)
  {

  // Deleting whitespace from the beginning and  end of the line.
    $str_line = addslashes(trim($str_line));


    //Now we  checking the line on the Swift tag code.
    if (ereg(":25:", $str_line))
    {

    //We filter the Swift tag code from the line.
      $int_bankaccount_number = explode(":", $str_line);

      // And now we set the database bank_account_number
      $int_bankaccount = ltrim($int_bankaccount_number[2]);

    } else if (ereg(":61:", $str_line))
      {

      // now we beginning to set  and account array number with the account var.
      // the description line will get on 0.
      // Get information on tag :81:
        $bl_get81 = TRUE;
        $int_account++;
        $int_description_line = 0;

        // Set defaults for every array entree.
        $ary_transactions[$int_account]["account"] = "";
        $ary_transactions[$int_account]["description"] = "";
        $ary_transactions[$int_account]["accountid"] = "";
        $ary_transactions[$int_account]["date"] = "";
        $ary_transactions[$int_account]["credit_debit"] = "";
        $ary_transactions[$int_account]["price"] = "";

        //We filter the
        //tag code from the line again.
        $ary_transactions[$int_account]["account"] = $int_bankaccount;
        $str_date_price = explode(":", $str_line);

        // Set date and Credit/Debit from the array string with the information
        $ary_transactions[$int_account]["date"] = substr($str_date_price[2], 0, 6);
        $ary_transactions[$int_account]["credit_debit"] = substr($str_date_price[2], 6, 1);
        // break the array again, and filter the prijs from the string with the informatie
        $str_price = explode("N" , substr($str_date_price[2], 7));
        $ary_transactions[$int_account]["price"] = str_replace(",", ".", $str_price[0]);
      } else if (ereg(":62F:", $str_line))
        {
        // If the tag is :62F: we don't need the :86:
          $bl_get81 = FALSE;
        } else if (ereg(":86:", $str_line) && $bl_get81)
          {

          //We filter the Swift tag code from the line and we check the description line number.
            $str_account_info = explode(":", $str_line);

            // If the number is zero, we get the basic information from the description lines.
            if ($int_description_line == 0)
            {
              $ary_transactions[$int_account]["accountnumber"] = ltrim(substr($str_account_info[2], 0, 10), 0);
              $ary_transactions[$int_account]["description"] = trim(substr($str_account_info[2], 10));

            // Only if there is more information. we put it in a special description array.
            } else if ($int_description_line == 1)
              {
                $ary_transactions[$int_account]["description"] .= trim($str_account_info[2]);
              } else
              {
                $ary_transactions[$int_account]["description"] .= " " . trim($str_account_info[2]);
              }
            // Set the description line.
            $int_description_line++;
          }
  }
  // Now we returning the transactions array filt with the different transactions beginning from zero.
  return $ary_transactions;
}

/*********************************************************
 * Function     : do_upload
 * Input        : upload_dir, directory to place the file
 *                filename, name of the file in the dir.
 * Returns      : An array with the data.
 *********************************************************/
function do_upload($upload_dir, $filename, $arr_types='', $message = '')
{   
  $message = "<br>upload_dir & filname not there";
  $bl_success = FALSE;

  if ($upload_dir && $filename)
  {
    $file_path = $upload_dir.$filename;
    $file_name = $_FILES['userfile']['name'];
    $file_type = $_FILES['userfile']['type'];
    $file_size = $_FILES['userfile']['size'];
    $result    = $_FILES['userfile']['error'];
    $temp_name = $_FILES['userfile']['tmp_name'];

    //check if the file extension needs to be restricted
    $ext_allowed = FALSE;
    //make filename lowercase
    $file_name = strtolower($file_name);

    if ($arr_types&&is_array($arr_types))
    {
      foreach ($arr_types as $ext)
      {
      //echo ".$ext". $file_type;
        if (eregi(".$ext", $file_type)) $ext_allowed = TRUE;
      }
    } else
    {
      $ext_allowed = TRUE;
    }
    if ($ext_allowed)
    {
      if (!strrchr($filename, '.'))
      {
        $str_ext = strrchr($file_name, '.');
        $file_path= $file_path.$str_ext;
      }
      if (stristr($file_name,"http"))
      {
        $message = "Upload van $file_name mislukt";
        if ($temp_name = Load_from_url($file_name,$file_path)) $message = "$file_path";
      } else
      {

      //File Name Check
        if ( $file_name =="")
        {
          $message = "Invalid File Name Specified";
          return FALSE;
        }
        //File Size Check
        else if ( $file_size > 500000)
          {
            $message = "The file size is over 500K.";
            return FALSE;
          }
          //File Type Check
          else if ( $file_type == "text/plain" )
            {
              $message = "Sorry, You cannot upload any script file" ;
              return FALSE;
            }
        $bl_success  =  move_uploaded_file($temp_name, $file_path);
        $message = ($bl_success) ? "$file_path" :
            "Somthing is wrong with uploading a file.";
        chmod($file_path, 0644); // Set rights to u+rw and go+r
      }
    } else
    {
      $message = "No external rights";

    }
  }
  return $bl_success;
}

/*
 * Function     : Load_from_url
 * Input        : URL to load from
 *                filename, name of the file in the dir.
 * Returns      : location and name of created file or FALSE
* 
* To load files from a URL
* thanks to bpiere21@hotmail.com 30-Jun-2002 03:57 on www.php.net
*/

function Load_from_url ($imgURL,$dest_name)
{
##-- Get Image file from Port 80 --##
  $fp = fopen($imgURL, "rb");
  $imageFile = fread ($fp, 3000000);
  fclose($fp);

  ##-- Put image data into the temp file --##
  $fp = fopen($dest_name, "wb");
  fwrite($fp, $imageFile);
  fclose($fp);

  return $dest_name;
}

/*
* Function     : thumb
* thumbnail creation
* input:    $image_path = path to image to resize
*           $path 		= destination dir of the thumbnails
*           $size       = thumbnails witdh 							default -> 30 pixel
*           $pre_name   = pre file string for thumbs				default -> ""
* Returns      : path of new file if succesful other wise errormessage.
*/
function thumb ( $image_path, $path, $size=30, $pre_name="" )
{
  $returnvar = FALSE;
  if ( (eregi("\.png$", $image_path)
      ||
      eregi("\.(jpg|jpeg)$", $image_path)
      ||
      (function_exists ( 'ImageCreateFromGIF' )
      &&
      eregi("\.gif$", $image_path) ) )
      &&
      $image_path )
  {
    $image_name = basename ( $image_path );
    $thumb_path = $path.$pre_name.$image_name;
    if ( resize_img($image_path, &$thumb_path, $size) ) return $thumb_path;
  }
  return $returnvar;
}	

/*
* Function  :   resize_jpeg
* Input:    $image_file_path : where is the input image now
*           $new_image_file_path : where do you want it
*           $max_width default = 480
*           $max_height default = 1600
* output:   true if succesfull
*/
function resize_img( $image_file_path, $new_image_file_path, $max_width=480, $max_height=1600 )
{

  $return_val = 1;

  // create new image

  if(eregi("\.png$",$image_file_path)) // if is a png

  {
    $return_val = ( ($img = ImageCreateFromPNG ( $image_file_path )) && $return_val == 1 ) ? "1" : "0";
  }

  if(eregi("\.(jpg|jpeg)$",$image_file_path)) // if is a jpg

  {
    $return_val = ( ($img = ImageCreateFromJPEG ( $image_file_path )) && $return_val == 1 ) ? "1" : "0";
  }

  if(eregi("\.gif$",$image_file_path)) // if is a gif

  {
    $return_val = ( ($img = ImageCreateFromGIF ( $image_file_path )) && $return_val == 1 ) ? "1" : "0";
  }

  $FullImage_width = imagesx ($img);    // original width
  $FullImage_height = imagesy ($img);    // original width

  // now we check for over-sized images and pare them down
  // to the dimensions we need for display purposes
  $ratio =  ( $FullImage_width > $max_width ) ? (real)($max_width / $FullImage_width) : 1 ;
  $new_width = ((int)($FullImage_width * $ratio));    //full-size width
  $new_height = ((int)($FullImage_height * $ratio));    //full-size height

  //check for images that are still too high
  $ratio =  ( $new_height > $max_height ) ? (real)($max_height / $new_height) : 1 ;
  $new_width = ((int)($new_width * $ratio));    //mid-size width
  $new_height = ((int)($new_height * $ratio));    //mid-size height

  // --Start Full Creation, Copying--
  // now, before we get silly and 'resize' an image that doesn't need it...
  if ( $new_width == $FullImage_width && $new_height == $FullImage_height ) copy ( $image_file_path, $new_image_file_path );


  $full_id = imagecreatetruecolor ( $new_width , $new_height ); //create an image


  ImageCopyResampled ( $full_id, $img, 0,0,0,0, $new_width, $new_height, $FullImage_width, $FullImage_height );
  //( resource dst_image, resource src_image, int dst_x, int dst_y, int src_x, int src_y, int dst_w, int dst_h, int src_w, int src_h)
  if(eregi("\.(jpg|jpeg)$",$image_file_path))
  {
    $return_val = ( $full = ImageJPEG( $full_id, $new_image_file_path, 80 ) && $return_val == 1 ) ? "1" : "0";
  }

  if(eregi("\.png$",$image_file_path))
  {
    $return_val = ( $full = ImagePNG( $full_id, $new_image_file_path ) && $return_val == 1 ) ? "1" : "0";
  }

  if(eregi("\.gif$",$image_file_path))
  {
    $return_val = ( $full = ImageGIF( $full_id, $new_image_file_path ) && $return_val == 1 ) ? "1" : "0";
  }
  ImageDestroy( $full_id );

  // --End Creation, Copying--

  return ($return_val) ? TRUE : FALSE ;

}

/*********************************************************
 * Function     : GetInvoiceColor
 * Input        : InvoiceID, the invoice number
				  bl_paid, paid yes or no
				  contact id, the id of the customer
				  payment_margin, true when this should be used.
 * Returns      : HTML color string
 *********************************************************/
function GetInvoiceColor($int_InvoiceID,
    $bl_paid,
    $int_ContactID,
    $bl_use_payment_margin = TRUE)
{
  $bgcolor = "";

  if (!$bl_paid)
  {
  //if ((strtotime($date_invoice) + 60*60*24* $int_paymentterm_days) < strtotime("now")) {
  // changed by AK to reflect overdue status from function
    if(Overdue($int_ContactID, $bl_use_payment_margin, $int_InvoiceID))
    {	// When outside the paymentterm;
      $bgcolor=NOT_PAID_OVERDUE_BGCOLOR;
    } else
    {
      $bgcolor=NOT_PAID_NOT_OVERDUE_BGCOLOR;
    }
  } else
  {
    $bgcolor=PAID_BGCOLOR;
  }

  return $bgcolor;
}

/**
 * Function     : GetSetFormVar
 * Get.or set the a form varaible from Post, Get or Session
 * input          : FormVarName on the form
 *                    SetSession set the session var or not
 *                    Default value
 *                    SessionName is the name of the corresponding variable in the session if not given use FormVarName
 * Returns      : the value
 **/
Function GetSetFormVar($FormVarName,
    $SetSession = FALSE,
    $default = '',
    $SessionName= NULL)
{
  $returnvalue = $default;
  if ( isset($_POST[$FormVarName]))
  {
    $returnvalue = $_POST[$FormVarName];
  } else if (isset($_GET[$FormVarName]))
    {
      $returnvalue = $_GET[$FormVarName];
    } else if ($SetSession)
      {
        $SessionName = $SessionName ? $SessionName : $FormVarName;
        $returnvalue = isset($_SESSION[$SessionName]) ? $_SESSION[$SessionName] : $default;
      }
  // deafault to formvarname if no sessionvaname is given
  $SessionName = $SessionName ? $SessionName : $FormVarName;
  //Set the session name if you said so.
  if ($SetSession)
  {
    $_SESSION[$SessionName] = $returnvalue;
  }

  return $returnvalue;
} 

/**
 * Function     : get_bgcolor
 * set Bgcolor to red if you are not in production data
 * input          : -
 * Returns      : HTML tag or nothing
 **/
Function get_bgcolor()
{
  $returnvar = '';
  if ($_SERVER['SERVER_NAME'] <> production) $returnvar = " BGCOLOR='#FFCC99' ";
  return $returnvar;
}

/**
 * Function     : GetSerialNumbers
 * Wil get the serialnumbers for a given transaction ID.
 * input        : Product_id, id of the product
 *                Delivery, id of the delivery
 *                box_id, The ID of the box in this delivery.
 * Returns      : Array with the serial numbers.
 **/
Function GetSerialNumbers($int_product_id,
    $int_shipment_id,
    $int_box_id = FALSE)
{
  global $db_iwex;
  $sql_serial = "SELECT Serial
                   FROM Serialnumbers
                   INNER JOIN inventory_transactions
                      ON Serialnumbers.Inventory_transactionID = inventory_transactions.TransactionID
                   WHERE inventory_transactions.ProductID = '$int_product_id'
                         AND inventory_transactions.shipmentID = '$int_shipment_id'
                   ORDER BY Serial";
  if ($int_box_id)
  {
    $sql_serial .= "AND inventory_transactions.box_ID = '$int_box_id'";
  }
  $serial_query = $db_iwex->query($sql_serial);
  $array_serialnum = array();
  while ($obj_serial = mysql_fetch_object($serial_query))
  {
    $array_serialnum[] = $obj_serial->Serial;
  }

  return $array_serialnum;
}

/*
 * Function     : strip_characters
 * Input/output : 	$str_string: String to be stript
			$ary_par: parameters to be stript bijv: -
 * Return:  stript string.
 */
Function strip_characters($str_string, $ary_par)
{

  foreach ($ary_par as $value)
  {
    $str_string = str_replace("$value" ,"", $str_string);
  }
  return $str_string;
}

/*
 * Class    : Getfiles
 * Input/output :  directory string			
 * Return:  Findfiles: True or false
	        Getfiles:   Array files with an array file name and file sort. 
 */
Class Getfiles
{

  var $ary_files;
  var $ary_filestrings;

  function Getfiles($directory)
  {

    if ($dir = opendir($directory))
    {
      while ($str_file = readdir($dir))
      {
        if ($str_file != "." && $str_file != "..")
        {
          $this->ary_filestrings[] = $str_file;
          $this->ary_files[] = explode(".", $str_file);
        }
      }
    }
    return $this->ary_files;
  }

  function Findfiles($ary_math)
  {
    $bl_found = FALSE;
    if($this->ary_filestrings)
    {
      foreach ($this->ary_filestrings  As $str_file)
      {
        foreach ($ary_math  As $str_math)
        {
          if ($str_math == $str_file)
          {
            $bl_found = TRUE;
          }
        }
      }
    }
    Return $bl_found;
  }

  function Files()
  {
    return $this->ary_files;
  }
}

/*
 * Function     : SendOverduemail
 * Input/output : 	$int_custid: Customerid, $int_type_id: overdue type 
 * Return:  $bl_send. False if mail not be send.
 */
Function SendOverduemail($int_custid, $int_type_id, $int_needed_type = FALSE)
{

  global $db_iwex;
  global $employee_id;
  global $emailheader;
  global $ary_languages;

  // Check if order ID is given.
  if ($int_custid)
  {
  // now get the totals of the selection
    $sql_totals = "SELECT sum(Invoice_total + Invoice_BTW) AS open
		                     FROM invoices 
		                     LEFT JOIN paymentterm ON Paymentterm = PaymentTermID 
							 WHERE CustomerID = '$int_custid' AND NOT paid_yn ";

    $flt_open_amount = GetField($sql_totals);

    $flt_paid_amount = GetField("SELECT sum(paid_amount)
		                     FROM invoices 
		                     LEFT JOIN paymentterm ON Paymentterm = PaymentTermID 
							 WHERE CustomerID = '$int_custid' AND NOT paid_yn ");

    // Select languages.
    $result_languages = $db_iwex->query("SELECT languages.languageID, language FROM contacts
						 					 LEFT JOIN languages ON contacts.languageID = languages.languageID 
						 					 WHERE ContactID = '$int_custid'");
    $obj_lang = mysql_fetch_object($result_languages);
    $ary_lang = $ary_languages["$obj_lang->language"];

    // Select text to be e-mailed.
    $ary_mailtxt = Gettexten("3", $obj_lang->languageID);
    $str_subject = $ary_mailtxt[0];
    $mailtxt = $ary_mailtxt[1];

    $mailtxt =  preg_replace("/".DB_CUST_REPLACE_VAR."/",
        getcontactname($int_custid),
        $mailtxt);

    // Create a query to select the customers payment detail.
    $sql_invoices = SQL_INVOICES_PAYMENT ." WHERE CustomerID = '$int_custid' AND NOT paid_yn
												ORDER BY InvoiceID ";

    $query = $db_iwex->query($sql_invoices);
    $str_mail_table = '<table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">
			  <tr>
				<th colspan=2>'.$ary_lang["overduemail_invoice"].'</th>
				<th>'.$ary_lang["overduemail_sendto"].'</th>
				<th>'.$ary_lang["overduemail_date"].'</th>
				<th>'.$ary_lang["overduemail_amount"].'</th>
				<th>'.$ary_lang["overduemail_paid"].'</th>
			  </tr>';

    while ($obj_invoices = mysql_fetch_object($query))
    {
      $bgcolor = GetInvoiceColor($obj_invoices->InvoiceID,
          $obj_invoices->paid_yn,
          $obj_invoices->CustomerID,
          FALSE); // Don't use payment margin
      $str_mail_table .= "<tr>\n"
          ."<td colspan=2 bgcolor='$bgcolor' style='background-color:$bgcolor;' align=center><b>$obj_invoices->InvoiceID</b></td>"
          .'<td>'.str_replace("\n"," ", $obj_invoices->ShipName).'</td>'
          .'<td align=center>'.date(DATEFORMAT_SHORT, strtotime($obj_invoices->Invoice_date)).'</td>'
          .'<td align=right>'.ToDutchNumber($obj_invoices->amount).'</td>'
          .'<td align=right>'.ToDutchNumber($obj_invoices->paid_amount).'</td>'
          ."\n".'</tr>';

      $ary_invoices[] = $obj_invoices->InvoiceID;
    }
    $str_mail_table .=	 "<tr><td align=center style=\"background-color:".NOT_PAID_NOT_OVERDUE_BGCOLOR.";\">OK</td>"
        ."<td align=center style=\"background-color:".NOT_PAID_OVERDUE_BGCOLOR.";\">Te laat</td>"
        ."<td align=right colspan=2><b>Totaal</b></td><td align=right>"
        .ToDutchNumber($flt_open_amount)."</td><td align=right>"
        .ToDutchNumber($flt_paid_amount)."</td><tr>\n";

    mysql_free_result($query);
    $str_mail_table .= "</table>\n\n";

    $mailtxt =  preg_replace(DB_INVOICETABLE_REPLACE_VAR,
        $str_mail_table,
        $mailtxt);

    $str_employee = GetField(GET_EMPLOYEE_NAME. $employee_id);

    $mailtxt =  preg_replace(DB_EMPLOYEE_REPLACE_VAR,
        $str_employee,
        $mailtxt);

    $qry = $db_iwex->query("SELECT contacts.email, Personen.email AS pemail
									FROM contacts 
									LEFT JOIN Personen ON contacts.ContactID = Personen.ContactID 
                                    AND (Personen_type_ID = 5 
                                         OR
                                         Personen_type_ID = 9)
									WHERE contacts.ContactID = '$int_custid' 
									ORDER BY Personen_type_ID = 9 DESC");
    if ($obj = mysql_fetch_object($qry))
    {
      $str_email = $obj->pemail ? $obj->pemail : $obj->email;
      $db_iwex->free_result($qry);
    }

    $mailtxt .= printbankinfo($ary_lang);

    // Send  the mail
    $str_fromname = $GLOBALS["ary_config"]["emailname.admin"];
    $str_from = $GLOBALS["ary_config"]["email.admin"];
    $str_mailtxt = stripslashes($mailtxt);
    $str_mailtxthtml = $emailheader . "<body>\n" . $str_mailtxt . "<br></body></html>";

    // The file will be send with mail to the invoice mail!
    $SMTPMail = new phpmailer();
    $SMTPMail->From     = $str_from;
    $SMTPMail->FromName = $str_fromname;
    if (EXTERNAL_SMTP_SERVER)
    {
      $SMTPMail->Host     = EXTERNAL_SMTP_SERVER;
      $SMTPMail->Mailer   = "smtp";
    } else
    { // Use normail PHP mail().
      $SMTPMail->Mailer   = "mail";
    }
    $SMTPMail->Body     = $str_mailtxthtml;
    $SMTPMail->AltBody  = strip_tags($str_mailtxt);
    $elements = preg_split("/[,;]+/", $str_email);
    for ($i = 0; $i < count($elements); $i++)
    {
      $SMTPMail->AddAddress($elements[$i]);
    }
    $SMTPMail->AddCC($str_from,
        $str_fromname);
    $SMTPMail->Subject  = $str_subject;

    if ($SMTPMail->Send())
    {
      $bl_send = 1;
      $sql_insert = 	"INSERT INTO calls SET
							ContactID = $int_custid, 
							employee = '$employee_id', 
							CallDate = '".date("Y-m-d H:i")."',
							Subject = '$str_subject',
							Notes = '".addslashes("Email verzonden aan: $str_email<hr>".$str_mailtxt)."'";
      $db_iwex->query($sql_insert);
      $int_call_id = $db_iwex->lastinserted();

      foreach ($ary_invoices As $str_invoice_ID)
      {
        if ($int_needed_type)
        {
          $int_type_id = $int_needed_type;
        }
        $db_iwex->query("INSERT INTO invoices_call(invoiceID, callID, typeID)
								 VALUES('$str_invoice_ID', '$int_call_id', '$int_type_id')");
      }

    } else
    {
      $bl_send = 0;
    }
  }
  return $bl_send;
}

/*
 * Function     : Getdays
 * Input/output : $str_first_daytime: date one, $str_second_daytime: date two 
 * Return:  $int_days. The numbers of days.
 */
Function Getdays($str_first_daytime, $str_second_daytime)
{

  $int_days = round((strtotime($str_first_daytime)-strtotime($str_second_daytime))/(60*60*24));

  return $int_days;
}

/*
 * Function     : IwexLetters
 * Input/output : $int_custid: Customerid to send the letter.
 * 				  $int_type_id: Type letter
 * 				  $int_needed_type: Another type letter than the type is set.
 * Return:  PDF created File name.
 */
Function IwexLetters($int_custid, $int_type_id, $int_needed_type = FALSE)
{

  Global $ary_languages;
  GLOBAL $employee_id;
  $db_iwex = new DB();
  $bl_error = FALSE;

  $result_languages = $db_iwex->query("SELECT languages.languageID, language FROM contacts
					 					 LEFT JOIN languages ON contacts.languageID = languages.languageID 
					 					 WHERE ContactID = '$int_custid'");
  $obj_lang = mysql_fetch_object($result_languages);
  $ary_lang = $ary_languages["$obj_lang->language"];

  $pdf=new IwexTemplateLetterPDF('P','mm','A4');
  $pdf->SetMargins(15,20,15);
  $pdf->usehead(TRUE);
  $pdf->Open();
  $pdf->AliasNbPages();
  $pdf->AddPage();
  $pdf->SetFont('Arial','',8);

  setlocale (LC_TIME, $ary_lang["LC_ALL"]);
  $str_date = strftime ("%e %B %Y");;

  $int_adres_id = GetInvoiceAdresId($int_custid);
  $str_invoice_sep = ", ";
  $str_title = $ary_lang["letter_title_default"];

  if ($int_needed_type)
  {
    $int_type = $int_needed_type;
  } else
  {
    $int_type = $int_type_id;
  }

  if ($int_type == DB_INVOICE_OVERDUE_FAX_OR_LETTER)
  {
    $int_text_id = 11;
    $str_invoice_sep = "\n";
    $str_notis = "Er is een fax opgeslagen met referentie num: ";
    $str_dir = $GLOBALS['ary_config']['faxen'];
    $str_subject = $ary_lang["letter_subject_fax"];
    $bl_invoice_table = TRUE;

  } else if ($int_type == DB_INVOICE_OVERDUE_SIGNATURE_LETTER)
    {
      $int_text_id = 10;
      $str_notis = "Er is een aangetekende brief opgeslagen met referentie num: ";
      $str_dir = $GLOBALS['ary_config']['signatureletters'];
      $str_title = $ary_lang["letter_title_signature"];
      $str_subject = $ary_lang["letter_subject_signature"];
      $bl_invoice_table = TRUE;
    }

  $yearnow = date("Y");
  if ($dir = opendir("$str_dir"))
  {
    while ($str_file = readdir($dir))
    {
      if ($str_file != "." && $str_file != "..")
      {
        if (ereg($yearnow, $str_file))
        {
          $ary_file[] = explode(".", $str_file);
        }
      }
    }
  }
  if (isset($ary_file))
  {
    $int_file = count($ary_file);
    sort($ary_file);
    $int_num = substr($ary_file[$int_file - 1][0], 0, 5) + 1;
    $str_lenght_num = strlen($int_num);
    $str_file_name = str_repeat("0", 5 - $str_lenght_num) . "$int_num$yearnow";
  } else
  {
    $str_file_name = "00001" . "$yearnow";
  }
  $str_notis .= "$str_file_name";

  $adres_result = $db_iwex->query("SELECT CompanyName, straat, huisnummer, postcode, plaats, naam,
									 		contacts.fax, Personen.fax AS pfax
									 FROM Adressen
									 LEFT JOIN contacts ON Adressen.ContactID = contacts.ContactID
									 LEFT JOIN Personen ON contacts.ContactID = Personen.ContactID
									 		AND (Personen_type_ID = ".DB_PERSONE_TYPE_ADMIN." 
												 OR
												 Personen_type_ID = ".DB_PERSONE_TYPE_DEB_ADMIN.")
									 WHERE AdresID = '$int_adres_id'
									 ORDER BY Personen_type_ID = ".DB_PERSONE_TYPE_DEB_ADMIN." DESC");
  $obj_adres = mysql_fetch_object($adres_result);
  $str_faxnumber = "";
  if ($int_type == DB_INVOICE_OVERDUE_FAX_OR_LETTER)
  {
    $str_faxnumber = $obj_adres->pfax ? $obj_adres->pfax : $obj_adres->fax;
    if(!$str_faxnumber)
    {
      $int_text_id = 9;
      $str_notis = "Er is een brief opgeslagen met referentie num: ";
      $str_dir = $GLOBALS['ary_config']['letters'];
      $str_subject = "Brief";
      $bl_invoice_table = TRUE;
    }
  }

  $ary_text = Gettexten("$int_text_id", $obj_lang->languageID);
  $str_text = $ary_text[1];

  $sql_totals = "SELECT sum(Invoice_total + Invoice_BTW - paid_amount) AS open
			       FROM invoices
			       LEFT JOIN paymentterm ON Paymentterm = PaymentTermID 
				   WHERE CustomerID = '$int_custid' AND NOT paid_yn ";
  $flt_open_amount = GetField($sql_totals);

  $sql_invoices = $db_iwex->query(SQL_INVOICES_PAYMENT ." WHERE CustomerID = '$int_custid'
															AND NOT paid_yn
															ORDER BY InvoiceID ");
  $str_invoiceid = "";
  $int_num_of_row = 0;
  $flt_tot_topay  = 0;
  $flt_tot_paid   = 0;
  $flt_tot_interst= 0;
  while ($obj_invoices = $db_iwex->fetch_object($sql_invoices))
  {
    $str_payment_days = $obj_invoices->days;
    $str_invoiceid .= $obj_invoices->InvoiceID . "$str_invoice_sep";
    $ary_invoices[]  = $obj_invoices->InvoiceID;

    $ary_row[$int_num_of_row][0] = $obj_invoices->InvoiceID;
    $ary_row[$int_num_of_row][1] = date(DATEFORMAT_SHORT, strtotime($obj_invoices->Invoice_date));
    $ary_row[$int_num_of_row][2] = str_replace("\n"," ", $obj_invoices->ShipName);
    $ary_row[$int_num_of_row][3] = ToDutchNumber($obj_invoices->amount);
    $ary_row[$int_num_of_row][4] = ToDutchNumber($obj_invoices->paid_amount);
    $flt_tot_topay += $obj_invoices->amount;
    $flt_tot_paid  += $obj_invoices->paid_amount;
    $flt_tot_interst += $obj_invoices->intrest;
    $int_num_of_row++;
  }
  $str_invoiceid = trim($str_invoiceid, $str_invoice_sep);

  $str_brief_date = "";

  $call_result = $db_iwex->query("SELECT invoices_call.callID, CallDate, typeID FROM invoices_call
									LEFT JOIN calls ON invoices_call.callID = calls.callID
									WHERE invoiceID = '". $ary_invoices[0] . "' 
									AND (typeID = 4
									OR typeID = 5)
									ORDER BY typeID desc");
  while ($obj_call = mysql_fetch_object($call_result))
  {
    if (!$str_brief_date)
    {
      list($str_brief_date, $str_brief_time) = explode(" " ,$obj_call->CallDate);
      list($str_year, $str_month, $str_day) = explode("-" ,$str_brief_date);
      $str_brief_date = "$str_day-$str_month-$str_year";
    }
  }

  $employee_result = $db_iwex->query("SELECT FirstName, middlename, LastName
										FROM employees 
										WHERE EmployeeID = '$employee_id'");
  $obj_employee = mysql_fetch_object($employee_result);
  $str_name = $obj_employee->FirstName . " " . $obj_employee->middlename . " " . $obj_employee->LastName;
  $str_adress = "$obj_adres->straat $obj_adres->huisnummer\n$obj_adres->postcode  $obj_adres->plaats";

  $str_text = str_replace(DB_LETTER_DATE_VAR, $str_date, $str_text);
  $str_text = str_replace(DB_CUST_REPLACE_VAR , $obj_adres->naam, $str_text );
  $str_text = str_replace(DB_LETTER_TO_ADRES_VAR, $str_adress, $str_text);
  $str_text = str_replace(DB_LETTER_TOTAL_VAR, ToDutchNumber($flt_open_amount), $str_text);
  $str_text = str_replace(DB_LETTER_TOTALINVOICES_VAR, $str_invoiceid, $str_text);
  $str_text = str_replace(DB_LETTER_TOTAL_AND_INTREST_VAR,
      ToDutchNumber($flt_open_amount + $flt_tot_interst + 10),
      $str_text);
  $str_text = str_replace(DB_LETTER_REFNUM_VAR, $str_file_name, $str_text);
  $str_text = str_replace(DB_LETTER_LETTERDATE_VAR, $str_brief_date, $str_text);
  $str_text = str_replace(DB_EMPLOYEE_REPLACE_VAR , $str_name, $str_text);
  $str_text = str_replace(DB_PAYMENT_TERM_VAR , $str_payment_days, $str_text);
  $str_text = str_replace(DB_FAXNUMBER_CUSTOMER_VAR ,$ary_lang["letter_faxnum"] . " " . $str_faxnumber, $str_text);

  if (ereg(DB_STRING_BREAK, $str_text))
  {
    list($str_text, $str_text2) = explode(DB_STRING_BREAK, $str_text);
  } else
  {
    $str_text2 = "";
  }

  $str_notis .= "<BR><BR>" . $str_text;

  $pdf->SetFont('Arial','',15);
  $pdf->SetWidths(array(175));
  $pdf->SetAligns(array('R'));
  $pdf->SetBorders(array(''));
  $pdf->SetHight(5);
  $pdf->Row(array($str_title));

  $pdf->SetFont('Arial','',10);
  $pdf->SetAligns(array('L'));
  $pdf->SetBorders(array(''));
  $pdf->Row(array("$str_text"));

  //	if ($int_type == DB_INVOICE_OVERDUE_SIGNATURE_LETTER) {
  //$int_x = $pdf->GetX();
  //$int_y = $pdf->GetY() - 25;
  //$pdf->image($_SERVER['DOCUMENT_ROOT'].'/sylvia/includes/signature.png',$int_x, $int_y, 55);
  //}
  $pdf->Ln(0);
  $pdf->SetWidths(array(30,20,73,30,20));
  $pdf->SetAligns(array('C','C','L','R','R'));
  $pdf->SetBorders(array('F','F','F','F','F','F'));
  $pdf->SetHight(4);

  if ($bl_invoice_table)
  {
    $pdf->PDFtable(array($ary_lang["letter_invoicenum"],
        $ary_lang["letter_date"],
        $ary_lang["letter_sendto"],
        $ary_lang["letter_vat"],
        $ary_lang["letter_paid"]),
        $ary_row);
    if ($int_num_of_row > 1)
    {
      $pdf->Ln(0);
      $pdf->Cell(30+20,4,"",'B',0,'R');
      $pdf->Cell(73,4, $ary_lang["letter_total"],'B',0,'R');
      $pdf->Cell(30,4,ToDutchNumber($flt_tot_topay),'B',0,'R');
      $pdf->Cell(20,4,ToDutchNumber($flt_tot_paid),'B',1,'R');
    }
    $str_notis  .= "<br><table width=\'100%\' border=\'1\' cellspacing=\'0\'>
						<tr><th>".$ary_lang["letter_invoicenum"]."</th><th>".$ary_lang["letter_date"]."</th>
						<th>".$ary_lang["letter_sendto"]."</th>
						<th>".$ary_lang["letter_vat"]."</th><th>".$ary_lang["letter_paid"]."</th></tr>";
    for($i = 0 ; $i < count($ary_row) ; $i++)
    {
      $str_notis	.=	"<tr><td>" . $ary_row[$i][0] . "</td><td>" .
          $ary_row[$i][1] . "</td><td>" . $ary_row[$i][2] . "</td><td>".
          $ary_row[$i][3] . "</td><td>" . $ary_row[$i][4] . "</td></tr>";
    }
    $str_notis	.=	"</table><br>";
  }
  $pdf->Ln(0);
  $pdf->SetWidths(array(175));
  $pdf->SetFont('Arial','',10);
  $pdf->SetAligns(array('L'));
  $pdf->SetBorders(array(''));
  $pdf->Row(array("$str_text2"));

  $str_notis .= $str_text2;

  if (!$bl_error)
  {
    $sql_insert = 	"INSERT INTO calls SET ContactID = $int_custid,
											   employee = '$employee_id', 
											   CallDate = '".date("Y-m-d H:i")."',
											   Subject = '$str_subject',
											   Notes = '$str_notis'";
    $db_iwex->query($sql_insert);
    $int_call_id = $db_iwex->lastinserted();

    foreach ($ary_invoices As $str_invoice_ID)
    {
      if($int_needed_type)
      {
        $int_type_id = $int_needed_type;
      }
      $db_iwex->query("INSERT INTO invoices_call(invoiceID, callID, typeID)
			 				 VALUES('$str_invoice_ID', '$int_call_id', '$int_type_id')");

    }

    $pdf->Output("$str_dir/$str_file_name.pdf");

    Return "$str_dir/$str_file_name.pdf";
  } else
  {
    Return FALSE;
  }
}

/*
 * Class    	: alert
 * Input/output : $str_validate: String to be checkt
 * 				  $str_error: Error string to be showt.
 * Return:  Full error string.
 */
class alert
{

  var $str_error = "";

  Function check ($str_check, $str_error)
  {
    if (!$str_check)
    {
      $this->str_error .= $str_error . "<br>";
    }
  }
  Function Showerror()
  {

    $str_error = "";
    if ($this->str_error)
    {
      $str_error = "<table border='1' cellspacing='0' cellpadding='2' bgcolor='#FF0000' width='100%'><tr><td>";
      $str_error.= $this->str_error;
      $str_error.= "</td></tr></table>";
    }

    Return $str_error;
  }
}

Function Makecode($int_length)
{
  $str_code = "";
  $str_pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
  for ($i=0 ; $i < $int_length ; $i++)
  {
    $str_code .= $str_pattern{rand(0,35)};
  }
  return $str_code;
}

Function Getshipmentpdf($int_shipmentID = FALSE, $str_format = "html", $int_box = FALSE, $int_max_box = FALSE ,$bl_gls = FALSE)
{

  global $db_iwex;

  define ("ROTATE_ANGLE", 90);
  define ("ROTATE_POINT_X", 73);
  define ("ROTATE_POINT_Y", 25);

  $header = array(); // Array to hold the header.
  $tabledata = array(); // Array to hold the table data.
  $int_rowcnt = 0; // Array row counter.

  // Get all the URL variable we need.
  $bl_pdf = !strcasecmp($str_format, FORMAT_PDF);
  $str_manco = "Manco meldingen en andere reclamaties kunnen alleen worden behandeld indien zij binnen 2 dagen na ontvangst worden
				  gemeld.";

  $int_gls_pagecount = 0;
  $ary_gls_pages = array();
  $int_current_pagecount = 0;
  $pdf_cust_page = NULL;

  if ($bl_pdf)
  {

    if (!get_box_numbers(&$boxquery, $int_shipmentID)) echo "No box number returned by get_box_numbers";
    $int_max_box=mysql_num_rows($boxquery);

    $bl_drop_ship = FALSE;
    $int_cust_id = 0;
    $bl_cust_pdf_loaded = FALSE;
    $qry_rest_cust = $db_iwex->query("SELECT AdressID, ContactID, adrestitel
										FROM shipments
										INNER JOIN Adressen ON Adressen.AdresID = shipments.AdressID
										WHERE Shipment_ID = ".$int_shipmentID."");
    if ($obj_cust = mysql_fetch_object($qry_rest_cust))
    {
      $bl_drop_ship = $obj_cust->adrestitel == DB_DROP_SHIP_ADRESTITEL;
      $int_cust_id = $obj_cust->ContactID;
    }
    mysql_free_result($qry_rest_cust);

    //Instanciation of inherited class
    $pdf=new PakagelistPDF('P','mm','A4');
    $pdf->AddFont('code39');
    $pdf->SetMargins(15,15,15);
    $pdf->Open();
    $pdf->AliasNbPages();

    // When GLS shipping include the GLS label in the PDF.
    if ($bl_gls)
    {
      $str_gls_filname = $GLOBALS["ary_config"]["temp_dir"]."/gls$int_shipmentID.pdf";
      $int_gls_pagecount = MakeGLSlabel($int_shipmentID, $str_gls_filname);
      $int_pagecount = $pdf->setSourceFile($str_gls_filname);
      for ($i = 1; $i <= $int_pagecount; $i++)
      {
        $ary_gls_pages[$i] = $pdf->ImportPage($i);
      }
    }
    if ($bl_drop_ship)
    {
      $str_cust_filname = $GLOBALS["ary_config"]['customerdocs']."/".
          CUST_PACKING_LIST_FILE_NAME."$int_cust_id.pdf";
      if (file_exists($str_cust_filname))
      {
        $bl_cust_pdf_loaded = $pdf->setSourceFile($str_cust_filname);
        $pdf_cust_page = $pdf->ImportPage(1);
      }
    }

    if ($int_max_box > 1) while ($objbox = mysql_fetch_object($boxquery))
      {
        $int_box = $objbox->box_number;
        // Reset row data.
        $tabledata = array(); // Array to hold the table data.
        $int_rowcnt = 0; // Array row counter.

        if ($int_shipmentID&&$int_box)
        {
        // Create a query to make the packinglist.
          $sql_packing_shipment = "SELECT Shipment_ID, Ship_date, Tracking, AdressID,
			adrestitel, Naam as shipname, attn, straat, huisnummer, postcode, plaats, land,
			CompanyName, Address, City, Region, PostalCode, country.country, Paymentterm, contacts.ContactID
			FROM shipments
			INNER JOIN Adressen ON Adressen.AdresID = shipments.AdressID
			INNER JOIN contacts ON contacts.ContactID = Adressen.ContactID
			INNER JOIN country ON Adressen.land = country.code
			WHERE Shipment_ID = ".$int_shipmentID.";";

          //    echo $sql_packing_shipment;
          $packlist_query = mysql_query($sql_packing_shipment)
              or die("Ongeldige select orders query: " .$sql_packing_shipment. mysql_error());
          $obj = mysql_fetch_object($packlist_query);


          $pdf->SetBox($int_box,
              $int_max_box,
              $obj->ContactID,
              $obj->Shipment_ID,
              !$bl_gls && !$bl_cust_pdf_loaded);
          $pdf->AddPage();
          $int_current_pagecount ++;

          if ($bl_gls)
          {
            $pdf->Rotate(ROTATE_ANGLE,
                ROTATE_POINT_X,
                ROTATE_POINT_Y);
            $pdf->useTemplate($ary_gls_pages[$int_current_pagecount],10,10);
            $pdf->Rotate(0);
            $pdf->Ln(50);
          } else
          {
          // When there is a customer packing list template include that one.
            if ($bl_cust_pdf_loaded)
            {
              $pdf->useTemplate($pdf_cust_page,0,0);
            }
            $pdf->SetFont('Arial','B',15);

            $pdf->SetWidths(array(59.5,30,89.5));
            $pdf->SetAligns(array('L','L','L'));
            $pdf->SetBorders(array('','','',''));
            $pdf->SetHight(7);

            $str_shipto = "$obj->shipname\n";
            if ($obj->attn != "")
            {
              $str_shipto  .= "T.a.v. $obj->attn\n";
            }
            $str_shipto .= "$obj->straat $obj->huisnummer\n"
                ."$obj->postcode  $obj->plaats\n"
                ."$obj->country";
            $pdf->Row(array("",
                "Aan:\nTo:",
                $str_shipto));
            $pdf->Ln(6);
          }

          $pdf->SetWidths(array(PAGE_WIDTH/3, PAGE_WIDTH/3, PAGE_WIDTH/3));
          $pdf->SetAligns(array('C','C','C'));
          $pdf->SetBorders(array('F','F','F'));
          $pdf->SetHight(4);
          $pdf->PDFtable(array('Levering', 'Klant nummer', 'Verzend Datum'),
              array(array($int_shipmentID,
              $obj->ContactID,
              date("j-n-Y",strtotime($obj->Ship_date))
              )
              )
          );

          $pdf->Ln(5);
          $pdf->SetWidths(array(15,35,15,20,79,15));
          $pdf->SetAligns(array('C','C','R','L','L','R'));
          $pdf->SetBorders(array('F','F','F','F','F','F'));
          $pdf->SetHight(4);
          $header = array('OrderID', 'Uw ref.', 'Product ID',  'Merk','Product', 'Aantal');


          // Create a query to select the shipmentdetails (inventory transactions.
          $sql_packing_details = "SELECT TransactionID, TransactionDate, inventory_transactions.ProductID, Description, inventory_transactions.box_ID, box_number,
			inventory_transactions.OrderID, TransactionDescription, UnitPrice, sum(UnitsSold) as UnitsSold, sum(UnitsShrinkage) as UnitsShrinkage,
			btw_percentage, Productname, ContactsOrderID, Merk, current_product_list.ExternalID, sku
			FROM inventory_transactions
			INNER JOIN current_product_list ON current_product_list.ProductID=inventory_transactions.ProductID
			INNER JOIN box ON inventory_transactions.box_ID = box.box_ID
			INNER JOIN orders ON orders.OrderID = inventory_transactions.OrderID
			WHERE ShipmentID = $int_shipmentID AND box_number = $int_box
					AND ContactsOrderID <> '".RMA_CREDIT_TEXT."'
			GROUP BY OrderID, ProductID, box_ID ORDER BY OrderID, ProductID";
          $packlist_det_query = mysql_query($sql_packing_details)
              or die("Ongeldige select orders query: " .$sql_packing_details. mysql_error());

          $int_rowcnt = 0;
          while ($objpackingdet = mysql_fetch_array($packlist_det_query, MYSQL_BOTH))
          {
            if ($objpackingdet["UnitsSold"]
                &&
                $objpackingdet["sku"] != DB_SKU_SOFTBUNDEL)
            {
              $tabledata[$int_rowcnt++] = array($objpackingdet["OrderID"],
                  $objpackingdet["ContactsOrderID"],
                  $objpackingdet["ProductID"],
                  $objpackingdet["Merk"],
                  $objpackingdet["Productname"],
                  $objpackingdet["UnitsSold"]);
            } else if ($objpackingdet["UnitsShrinkage"])
              {
                $tabledata[$int_rowcnt++] = array($objpackingdet["OrderID"],
                    $objpackingdet["ContactsOrderID"],
                    $objpackingdet["ProductID"],
                    $objpackingdet["Merk"],
                    $objpackingdet["TransactionDescription"]." (".  $objpackingdet["Productname"].")",
                    $objpackingdet["UnitsShrinkage"]);
              }
          }
          mysql_free_result($packlist_det_query);
          $pdf->PDFtable($header, $tabledata);
          $pdf->Ln(10);
        }

        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(179,4,$str_manco,0,1,'L');


      } // End while ($objbox = mysql_fetch_object($boxquery))

    // Create a query to select the shipment
    $sql_shipments = SQL_SHIPMENTS . "WHERE Shipment_ID = $int_shipmentID AND Cancel = 0";

    $query = mysql_query($sql_shipments)
        or die("Ongeldige query: " . mysql_error());

    while ($objshipment = mysql_fetch_object($query))
    {
      $pdf->SetBox(DELIVERY_NOTE_ID,
          DELIVERY_NOTE_ID,
          $objshipment->ContactID,
          $objshipment->Shipment_ID,
          !($bl_gls && $int_max_box == 1) && !$bl_cust_pdf_loaded);
      $pdf->AddPage();
      $int_current_pagecount++;

      if ($bl_gls && $int_max_box ==1)
      {
        $pdf->Rotate(ROTATE_ANGLE,
            ROTATE_POINT_X,
            ROTATE_POINT_Y);
        $pdf->useTemplate($ary_gls_pages[$int_current_pagecount],10,10);
        $pdf->Rotate(0);
        $pdf->Ln(50);
      } else
      {
      // When there is a customer packing list template include that one.
        if ($bl_cust_pdf_loaded)
        {
          $pdf->useTemplate($pdf_cust_page,0,0);
        }

        $pdf->SetFont('Arial','',10);

        $pdf->SetFont('Arial','B',15);

        $pdf->SetWidths(array(49.5,40,89.5));
        $pdf->SetAligns(array('L','L','L'));
        $pdf->SetBorders(array('','','',''));
        $pdf->SetHight(7);

        $str_shipto = "$objshipment->Naam\n";
        if ($objshipment->attn != "")
        {
          $str_shipto  .= "T.a.v. $objshipment->attn\n";
        }
        $str_shipto .= "$objshipment->straat $objshipment->huisnummer\n"
            ."$objshipment->postcode  $objshipment->plaats\n"
            ."$objshipment->land_naam";
        $pdf->Row(array("",
            "Afleveradres:\nShip to:",
            $str_shipto));
        $pdf->Ln(7);
      }

      $pdf->SetWidths(array(PAGE_WIDTH/3, PAGE_WIDTH/3, PAGE_WIDTH/3));
      $pdf->SetAligns(array('C','C','C'));
      $pdf->SetBorders(array('F','F','F'));
      $pdf->SetHight(4);
      $pdf->PDFtable(array('Levering', 'Klant nummer', 'Verzend Datum'),
          array(array($int_shipmentID,
          $objshipment->ContactID,
          date("j-n-Y",strtotime($objshipment->Ship_date))
          )
          )
      );
      $pdf->Ln(25);
      // Store customer ID for later use.
      $int_customerID = $objshipment->ContactID;
    }
    mysql_free_result($query);

    $sql_orders = "SELECT DISTINCT inventory_transactions.OrderID, ContactsOrderID, OrderDate, Comments, rma_yn
				FROM inventory_transactions
				INNER JOIN orders ON inventory_transactions.OrderID = orders.OrderID
				WHERE shipmentID = $int_shipmentID
					AND ContactsOrderID <> '".RMA_CREDIT_TEXT."'";
    $query_orders = mysql_query($sql_orders)
        or die("Ongeldige query: " . mysql_error());

    while ($obj_orders = mysql_fetch_object($query_orders))
    {
      $sql_inventoryt = "SELECT inventory_transactions.ProductID,
				current_product_list.ProductName, inventory_transactions.Description, TransactionDescription,
				inventory_transactions.UnitPrice, sum(UnitsSold) as UnitsSold, Quantity, store_serial_yn,
				inventory_transactions.btw_percentage, added_cost, to_deliver, Merk, sku, sum(UnitsShrinkage) as UnitsShrinkage,
				CustOrderRowID, EAN
				FROM inventory_transactions
				LEFT JOIN order_details ON (order_details.OrderID = inventory_transactions.OrderID
											AND order_details.OrderDetailsID = inventory_transactions.OrderDetailsID)
				INNER JOIN current_product_list ON current_product_list.ProductID=inventory_transactions.ProductID
				WHERE shipmentID = $int_shipmentID 
						AND inventory_transactions.OrderID = $obj_orders->OrderID
				GROUP BY order_details.OrderDetailsID, inventory_transactions.ProductID
				ORDER BY order_details.OrderDetailsID, inventory_transactions.TransactionID";
      $query_invetory = mysql_query($sql_inventoryt)
          or die("Ongeldige query: " . mysql_error());

      //set the varaible to recognise an rma order
      $bl_rma = isset($obj_orders->rma_yn) ? $obj_orders->rma_yn : FALSE;

      if ($bl_rma)
      {
        $header = array('ID', 'EAN', 'RMA ID', 'Merk', 'Naam', 'Uw ref.', '', 'Geleverd');
        $str_header = "$obj_orders->ContactsOrderID";
      } else
      {
        $header = array('ID', 'EAN', 'Ext. ID', 'Merk', 'Naam', 'Besteld', 'Backorder', 'Geleverd');
        $str_header = "Uw order referentie: $obj_orders->ContactsOrderID";
      }
      $str_header .= "           "
          ."Ons order nummer: $obj_orders->OrderID           "
          ."Order datum: ".date("j-n-Y",strtotime($obj_orders->OrderDate));

      $pdf->SetWidths(array(11.5, 23, 21, 20, 63.5, 13, 14, 13));
      $pdf->SetAligns(array('R','R','L','L','L','R','R','R'));
      $pdf->SetBorders(array('F','F','F','F','F','F','F','F'));
      $pdf->SetHight(4);

      $flt_thisrow_order_cost = 0;
      $int_rowcnt = 0;
      $flt_max_vat = 0;
      $tabledata = array();
      while ($obj_inventory = mysql_fetch_object($query_invetory))
      {
        $obj_inventory->to_deliver = $obj_inventory->to_deliver ? $obj_inventory->to_deliver : '-';

        if ($bl_rma)
        {
          $str_ext_ID_column = GetField("SELECT RMAID FROM RMA_actions WHERE ActionID = $obj_inventory->Description");
          $str_name_column = $obj_inventory->ProductName;
          $str_quantity_column = GetField("SELECT RMA.Customer_ID FROM RMA_actions
							INNER JOIN RMA ON RMA_actions.RMAID = RMA.ID
							WHERE RMA_actions.ActionID = $obj_inventory->Description");
          $str_to_deliver_column = '';
        } else
        {
          $str_quantity_column = $obj_inventory->Quantity;
          $str_to_deliver_column = $obj_inventory->to_deliver;
          $str_name_column = $obj_inventory->ProductName;
          $str_ext_ID_column = $obj_inventory->CustOrderRowID;
        }

        if ($obj_inventory->UnitsShrinkage)
        {
        // Part of softbundel
          $str_name_column = "  $obj_inventory->TransactionDescription ($obj_inventory->ProductName)";;
          $int_sold = $obj_inventory->UnitsShrinkage;
          $str_ID_column = "  $obj_inventory->ProductID";
        } else
        {
          $int_sold = $obj_inventory->UnitsSold;
        }

        $tabledata[$int_rowcnt++] = array($obj_inventory->ProductID,
            $obj_inventory->EAN,
            $str_ext_ID_column,
            $obj_inventory->Merk,
            $str_name_column,
            $str_quantity_column,
            $str_to_deliver_column,
            $int_sold);
      }
      mysql_free_result($query_invetory);

      $pdf->PDFtable($header, $tabledata, $str_header);
      // Generate the PDF table.
      $pdf->Ln(3);
    }

    $sql_products = "SELECT DISTINCT inventory_transactions.ProductID, current_product_list.ProductName
						FROM inventory_transactions
						INNER JOIN current_product_list ON current_product_list.ProductID=inventory_transactions.ProductID
						WHERE shipmentID = '$int_shipmentID' AND store_serial_yn";
    $query_products = $db_iwex->query($sql_products);

    $header = array('Product', 'Serie nummers');
    $pdf->SetWidths(array(12, 167));
    $pdf->SetAligns(array('R','L'));
    $pdf->SetBorders(array('F','F'));
    $pdf->SetHight(4);
    $tabledata = array();

    while ($obj_products = mysql_fetch_object($query_products))
    {
      $tabledata[] = array($obj_products->ProductID,
          implode(", ", GetSerialNumbers($obj_products->ProductID,
          $int_shipmentID)));
    }

    // Only print when there are records.
    if (count($tabledata))
    {
      $pdf->Ln(3);
      $pdf->PDFtable($header, $tabledata, "Lijst van de serie nummers in deze levering");
    }

    $pdf->Ln(7);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(179,4,$str_manco,0,1,'L');

    $pdf->Output($GLOBALS['ary_config']['temp_dir']."/shipmentmail.pdf" , 'F');

    // remove file if there is one.
    if (isset($str_gls_filname)) unlink($str_gls_filname);
  } // End if bl_pdf
}

/*
 * Class    	: button
 * Will display a button and submit the value in a separate var with the name you give, 
 * Input/output : $str_varname: name of the varibale
 *			$str_display: what should the button display?
 *			$formname: name of the form it's displayed in
 *			$str_disable: If true the button is disabled
 * Return:  $str_return: String to be diplayed
 */
function button($str_varname,
    $bl_last_state,
    $str_display,
    $str_toggle_text = '',
    $str_formname,
    $str_disable=FALSE)
{ 
  if ($str_toggle_text)
  {
    $last_state = $bl_last_state;
    $last_state ? $str_display_text = $str_toggle_text : $str_display_text = $str_display;
    $bl_upd_value = !$last_state;
  } else
  {
    $last_state = '';
    $str_display_text = $str_display;
    $bl_upd_value = '1';
  }

  if ($str_varname
      &&
      $str_display
      &&
      $str_formname)
  {
    $str_return = "<INPUT TYPE='hidden' NAME='$str_varname' VALUE='$last_state'>
			<INPUT $str_disable TYPE='button' VALUE='$str_display_text' 
				onclick=\"document.$str_formname.$str_varname.value='$bl_upd_value';
				document.$str_formname.submit()\"";
  } else
  {
    $str_return = "error: <br>" . $str_varname . $str_display . $str_formname;
  }
  return $str_return;
}
?>
