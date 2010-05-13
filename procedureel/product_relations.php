<?php
 /*
 * product_relations.php
 *
 * @version $Id: product_relations.php,v 1.4 2005-01-31 21:54:48 alex Exp $
 * @copyright $date:
 **/

include ("include.php");
$bl_submit = GetSetFormVar("submit",FALSE,FALSE);
$int_productID = GetSetFormVar("ProductID",TRUE,FALSE,'popup_parm');
$str_function = GetSetFormVar("Function",TRUE,FALSE,'Function');
$str_parm1 = GetSetFormVar("parm1");
$str_del_relation = GetSetFormVar("del");
$int_del_ID = GetSetFormVar("delID");
$int_ins_ID = GetSetFormVar("ProductIDNew");
$int_copyfromID = GetSetFormVar("copyfromID");
$str_copyfromtype = GetSetFormVar("copyfromtype");
$bl_del_all = GetSetFormVar("del_all");

// Print default Iwex HTML header.
printheader ("popup");

//select the db
$DB_iwex = new DB();

echo "<BODY><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"Relation_$str_parm1\">\n";
echo "<INPUT TYPE='hidden' NAME='Function' VALUE='$str_function'>\n";
echo "<INPUT TYPE='hidden' NAME='parm1' VALUE='$str_parm1'>\n";
if ($bl_submit&&($int_ins_ID||($int_copyfromID&&$str_copyfromtype))) {
    if ($int_ins_ID) {
        Insert_relations($str_parm1,$int_ins_ID,$int_productID);
    } else if ($int_copyfromID&&$str_copyfromtype) {
        if ($from_array = get_relations($int_copyfromID,$str_copyfromtype)) {
            if ($to_array = get_relations($int_productID,$str_parm1)) {
                $add_array = array_diff($from_array,$to_array);
                echo count($add_array) . " added";
                Insert_relations($str_parm1,$add_array,$int_productID);
            }
        }
    }
}
if ($int_productID) {
    if ($str_del_relation) {
        delete_relations($str_del_relation,$int_del_ID,$int_productID);
    }
    if ($bl_del_all) {
        if ($this_array = get_relations($int_productID,$str_parm1)) {
            delete_relations($str_parm1,$this_array,$int_productID);
            echo count($this_array) . " deleted";
        }
    }
    $str_function($int_productID,$str_parm1);
}

echo "</FORM>\n";

printenddoc();

/*
 * Function     : Insert_relations
 * Inserts relations in the table you want, 1 or multiple
 * Input        : Type is the relationtype (Device, Accesoire, related)
 *                Products is either one or many (comma seperated) ProductIDs
 * Returns      : True when it worked
 */
function Insert_relations($type,$products,$subject)
{
    //select the db
    $DB_iwex = new DB();
    
    $str_return = FALSE;
    if ($type && $products && $subject) {
        is_array($products) ? $Product_array = $products : $Product_array = explode("," , $products);
        foreach ($Product_array as $ProductID) {
            if ($subject && $ProductID ) {
                if ($type == 'device') {
                    $sql_insert = "INSERT INTO associated_products 
                        SET ProductID_Main = '" . $ProductID . "', 
                        ProductID_Acc = '" . $subject . "';";  
                } else if ($type == 'acces') {
                    $sql_insert = "INSERT INTO associated_products 
                        SET ProductID_Acc = '" . $ProductID . "', 
                        ProductID_Main = '" . $subject . "';";  
                } else if ($type == 'other') {
                    $sql_insert = "INSERT INTO related_products 
                        SET ProductID1 = '" . $ProductID . "', 
                        ProductID2 = '" . $subject . "';";  
                } 
                if ($DB_iwex->query($sql_insert)) $str_return = TRUE;
            }
        }
    }
    return $str_return;

}

/*
 * Function     : delete_relations
 * Deletes relations in the table you want, 1 or multiple
 * Input        : Type is the relationtype (Device, Accesoire, related)
 *                Products is either one or many (comma seperated) ProductIDs
 * Returns      : True when it worked
 */
function delete_relations($type,$products,$subject)
{
    //select the db
    $DB_iwex = new DB();
    
    $str_return = FALSE;
    if ($type && $products && $subject) {
        is_array($products) ? $Product_array = $products : $Product_array = explode("," , $products);
        foreach ($Product_array as $ProductID) {
            if ($type == 'device') {
                $sql_delete = "DELETE FROM associated_products 
                    WHERE ProductID_Main = '" . $ProductID . "' AND 
                    ProductID_Acc = '" . $subject . "';";  
            } else if ($type == 'acces') {
                $sql_delete = "DELETE FROM associated_products 
                    WHERE (ProductID_Acc = '" . $ProductID . "' AND  
                    ProductID_Main = '" . $subject . "') OR
                    (ProductID_Acc = '" . $subject  . "' AND  
                    ProductID_Main = '" . $ProductID . "');";  
            } else if ($type == 'other') {
                $sql_delete = "DELETE FROM related_products 
                    WHERE (ProductID1 = '" . $ProductID . "' AND
                    ProductID2 = '" . $subject . "') OR 
                    (ProductID2 = '" . $ProductID . "' AND
                    ProductID1 = '" . $subject . "');";  
            } 
            //echo $sql_delete;
            $DB_iwex->query($sql_delete);
        }
        $str_return = TRUE;
    }
    return $str_return;
}


?>
