<?php
 /*
 * upload_popup.php
 *
 * @version $Id: upload_popup.php,v 1.1 2007-07-03 10:24:15 alex Exp $
 * @copyright $date:
 **/

 
$_GLOBAL["str_backdir"] = '../';

include ($_GLOBAL["str_backdir"]."include.php");

$str_filename = GetSetFormvar("Filename");
$str_filename = $str_filename ? $str_filename : $_SESSION["popup_parm"];
$bl_succes = GetSetFormVar('succes');

$str_send = GetSetFormVar("send");

$str_upload_type = GetSetFormVar("type");

// Print default Iwex HTML header.
printheader ("Upload new file for: $str_filename");
echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"upload\" enctype=\"multipart/form-data\">\n";
echo '<table align="CENTER" width="100%" border="0">
  <tr>';
$mini = '';
$go = '';
$bl_succes = FALSE;
if ($str_filename) {
    if ($str_send == "ok" ) 
    {	
        // Store the packing list on the correct location.
        if ($str_upload_type == CUST_PACKING_LIST) {
			$str_msg_results = "";
            if (do_upload($GLOBALS["ary_config"]['customerdocs']."/", 
                                CUST_PACKING_LIST_FILE_NAME.$str_filename, 
                                array('pdf'),
							    &$str_msg_results)) {
                print "Upload OK<br>$str_msg_results<br>"; // Print the path to file uploaded
                $bl_success = TRUE;
            } else {
				print "Upload failed<br>$str_msg_results<br>"; // Print the path to file uploaded
			}
        } else {
            // allowed exstensions
            $ext_allowed = array('jpg', 'jpeg');
            
            // If the form was send ( $send == "ok" ) make upload
            // The new object must be created first:
            
            if (do_upload(img_root, $str_filename, $ext_allowed, &$str_msg_results)) {
                print "$str_msg_results<br>"; // Print the path to file uploaded
                // the miniatura method accept in input the path to image to resize and the destination dir of the thumbnail	
                
                if (thumb ($str_msg_results,img_root.THUMBS_DIR)) {
                    print "Thumbnail ".$mini." created."; // Print path to the thumbnail
                    $bl_success = TRUE;
                } else {
                    print "Error while try to create the thumbnail<BR>";
                }
            } else {
                print "File upload Failed";
            }
        }
        if ($bl_success) {
            echo "<SCRIPT> window.close(); </SCRIPT>";
        }
    }
} else {
    echo "No filename given....";
}
echo '</div></td>
  </tr>
  <td colspan="2">
        <p align="center"> 
            <input type="hidden" name="Filename" value='.$str_filename.'>
          <input name="userfile" type="file" class="testo">
        </p>
      </td>
  </tr>
  <tr> 
    <td colspan="2"> <p align="center"> 
        <input name="Submit" type="submit" value="Upload file &gt;&gt;" class="testo">
        <input name="send" type="hidden" value="ok">
      </p></td>
  </tr>
</table>';
//Store the upload file type.
echo "<input type=hidden name=type value='$str_upload_type'>";
echo '<script TYPE="text/javascript" language="JavaScript">document.upload.userfile.focus();</script>';

printenddoc();

?>
