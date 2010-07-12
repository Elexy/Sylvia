<?php
include("include.php");

$bl_showgraph = isset($_POST["showgraph"]) ? TRUE : FALSE;    
// Print default Iwex HTML header.
printheader (COMPANYNAME . " login");

echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"index\">\n";

if(isset($_SESSION['uname'])) {
    

printIwexNav();
?>
     <!-- Keuze blok -->
     <table border="0" cellspacing="3" cellpadding="5" width="100%" class="back">
     <tr>
       <td class=featureblock valign=top width=150 rowspan=2>
     	<?php
		echo table("menu", 1);
		?>
     	</tr>
     	<tr>
     		<td width="100%" colspan="3">
     		<table cellpadding="3" border="0" cellspacing="0" width="100%">
     		<tr>
     			<td width="100%" class="blockbody">
     				<?php
                         //no rights at all
                        if (empty($raccess_s) && empty($raccess_a) && empty($raccess_r) && empty($raccess_v) && empty($setup_s) &&
                           empty($setup_a) && empty($setup_r) && empty($setup_v) && empty($supervisor))
                        {
                            echo "U heeft geen rechten!<BR><HR><BR>Neem contact op met de Administrator";
                        }else {        
                            if (isset($_GET['category'])) {
                                $category = $_GET['category'];
                            } else {
                                $category='1';
                            }
                            $menu_sql="select name, link from menufunction ";
               		    $sqlwhere = " WHERE menucategoryid = '$category'"; 
                      
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
                        
                            $menu_sql = $menu_sql . $sqlwhere;
                            $menu_result = mysql_query($menu_sql)
                                or die("Ongeldige select query: ".$menu_sql.' '.mysql_error());
                            While ($obj = mysql_fetch_object($menu_result))
                            {
                                echo '&#149;<a href="'.$obj->link.'">'.$obj->name.'</a><br>'."\n";
                            }
                         
                             echo "<br>Welkom ".$uname."<BR>";
                             echo '<input type="SUBMIT" name="showgraph" value="omzet" CLASS="button">';
                         }
                         ?>
     			</td>
     		</tr>
     		<?php
			echo table("menu", 2);
			?>
     		</td>
     	</tr>
     	</table>
     	<br><br>
       </td>
       <td width="60%" valign=top>
     	<?php
            echo GetNewOrders();
            if ($bl_showgraph) { 
                print_margin_graph();
            } else {
				$ary_text = Gettexten(8, 1);
                echo "<p>". $ary_text[1] ."</p>"; // Show the default screen.
            }
        ?>
       </td>
       <td valign="top">
      </td>
     </tr>
     </table>
     <!-- end table -->


     <p>
     <hr>
     <table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
       <td>Pagina vernieuwd op: <?php echo date("d-m-Y G:i:s");?></td>
       <td align="right"><?php echo date("Y");?> &copy; <a href="mailto:<?php echo $GLOBALS["ary_config"]["email.info"] . ">".COMPANYNAME."</A> K.V.K. " . KVK ."</td>"; ?>
      </tr>
     </table>

     </td></tr>
     </table>
<?php
}
?>
</form>
</body>

</html>

