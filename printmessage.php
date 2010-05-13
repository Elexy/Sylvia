<?PHP
include ("include.php");
$str_message = isset($_GET['message']) ? $_GET['message'] : FALSE;
 // Print default Iwex HTML header.
printheader ("Let op");
echo "	<BODY" . get_bgcolor() . ">
			<table bgcolor='#7FFF00' cellspacing='0' width='100%'>
				<tr>
					<td align='center'>
					$str_message
					</td>
				</tr>
			</table>
		</BODY>
	</HTML>";
?>