<?php
/**
 *
 *
 * @version $Id: invoice_payment_pdf.php,v 1.5 2005-05-06 12:10:06 iwan Exp $
 * @copyright $date:
 **/

include ("include.php");

$bl_overdue = isset($_REQUEST["overdue"]);
$bl_monthpayment = isset($_REQUEST["month"]);

$db_iwex = new DB();

if ($bl_overdue) {
    //Instanciation of inherited class
    $pdf=new IwexPDF('P','mm','A4');
    
    $pdf->SetWidths(array(20,20,20,20,20,20,20,20,19));
    $pdf->SetAligns(array('C','R','R','R','R','R','R','R','C'));
    $pdf->SetBorders(array('F','F','F','F','F','F','F','F','F'));
    $pdf->SetLineWidth(0);
    $pdf->SetHight(3);
    $pdf->SetMargins(15,15,15);
    $pdf->usehead(FALSE); // Don't print the header
    $pdf->usebankinfo(FALSE); // Don't print the bankinfo
    
    $pdf->Open();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',10);

    
    $qry_custsearch = $db_iwex->query("SELECT contacts.CompanyName, ContactID, sum(Invoice_total + Invoice_BTW - paid_amount) AS openamount
                                       FROM contacts
                                       RIGHT JOIN invoices ON contacts.ContactID = invoices.CustomerID
                                       LEFT JOIN paymentterm ON invoices.Paymentterm = paymentterm.PaymentTermID
                                       WHERE NOT paid_yn
                                             AND (to_days(curdate()) - to_days(Invoice_date) > days 
                                             AND Invoice_total+Invoice_BTW-paid_amount > ".DB_INVOICE_MARGIN."
                                             OR Invoice_total+Invoice_BTW-paid_amount < 0)
                                       GROUP BY invoices.CustomerID
                                       ORDER BY CompanyName");
                                       
    while ($obj = mysql_fetch_object($qry_custsearch)) {
        $flt_interest_rate = MONTH_INTREST_RATE / 100;
        $resultsearch = $db_iwex->query("SELECT Invoice_date, InvoiceID, Invoice_total, Invoice_BTW,
                                         Invoice_total + Invoice_BTW AS Totaal, 
                                         IF(paid_yn,
                                           (TO_DAYS(paid_date) - TO_DAYS(Invoice_date)),
                                           (TO_DAYS(NOW()) - TO_DAYS(Invoice_date))) AS Dagen_open, 
                                         ROUND(IF(paid_yn, 
                                                  IF((TO_DAYS(paid_date) - TO_DAYS(Invoice_date)) > days, 
                                                     (TO_DAYS(paid_date) - TO_DAYS(Invoice_date))/30.5*$flt_interest_rate*
                                                     (Invoice_total + Invoice_BTW),
                                                     0),
                                                  IF((TO_DAYS(NOW()) - TO_DAYS(Invoice_date)) > days, 
                                                     (TO_DAYS(NOW()) - TO_DAYS(Invoice_date))/30.5*$flt_interest_rate*(Invoice_total + Invoice_BTW),
                                                     0)),
                                               2) AS rente, paid_amount, paid_date
                                         FROM invoices
                                         LEFT JOIN paymentterm ON Paymentterm = PaymentTermID
                                         WHERE CustomerID = '$obj->ContactID'
                                            AND NOT paid_yn
                                            AND (to_days(curdate()) - to_days(Invoice_date) > days 
                                            AND Invoice_total+Invoice_BTW-paid_amount > ".DB_INVOICE_MARGIN."
                                            OR Invoice_total+Invoice_BTW-paid_amount < 0)");
             
        $headerdata = array();
        for ($i = 0; $i < mysql_num_fields($resultsearch); $i++){
               $headerdata[$i]= mysql_field_name($resultsearch, $i);
        }
        $tabledata = array();
        $rowcnt = 0;
        while($row = mysql_fetch_row($resultsearch)) {
            $tabledata[$rowcnt++] = $row;
        }
    
        // Generate the PDF table.
        $pdf->PDFtable($headerdata, $tabledata, "ID: $obj->ContactID    Bedrijf: $obj->CompanyName      Totaal open staand: $obj->openamount");
        $pdf->Ln(5);
    }
    
    $pdf->Output();

    mysql_free_result($resultsearch);
} else if ($bl_monthpayment) {
    //Instanciation of inherited class
    $pdf=new IwexPDF('P','mm','A5');
    
    $pdf->SetWidths(array(20,25,20,20,20,20));
    $pdf->SetAligns(array('C','C','R','R','R','R'));
    $pdf->SetBorders(array('F','F','F','F','F','F'));
    $pdf->SetLineWidth(0);
    $pdf->SetHight(3);
    $pdf->SetMargins(10,10,10);
    $pdf->usehead(FALSE); // Don't print the header
    $pdf->usebankinfo(FALSE); // Don't print the bankinfo
    
    $pdf->Open();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',10);
    
    $qry_custsearch = $db_iwex->query ("SELECT DISTINCT payments_link.InvoiceID, invoices.Invoice_date,
                                        SUBSTRING(invoices.companyName,1,35) AS companyName
                                        FROM payments_link
                                        LEFT JOIN bank_transactions ON payments_link.BankTransactionId = bank_transactions.transaction_id
                                        LEFT JOIN invoices ON invoices.InvoiceID = payments_link.InvoiceID
                                        WHERE IF (MONTH(NOW()) = 1,
                                                  MONTH(bank_transactions.transaction_date) = MONTH(NOW()) AND YEAR(bank_transactions.transaction_date) = (YEAR(NOW()) -1),
                                                  MONTH(bank_transactions.transaction_date) = (MONTH(NOW()) -1) AND YEAR(bank_transactions.transaction_date) = YEAR(NOW())
                                                 )
                                        ORDER BY InvoiceID ");

    $headerdata = array("Betaal datum", "Bankrekening", "Geboekt", "Cumulatief", "Factuur bedrag", "Betaald");                                        
    while ($obj = mysql_fetch_object($qry_custsearch)) {
        $resultsearch = $db_iwex->query("SELECT bank_transactions.transaction_date,
                                        bank_accounts.account_name, link_amount AS geboekt,
                                        invoices.Invoice_total + invoices.Invoice_BTW as inv_total, paid_amount
                                        FROM payments_link
                                        INNER JOIN bank_transactions AS lastmonth ON payments_link.BankTransactionId = lastmonth.transaction_id
                                        LEFT JOIN bank_transactions ON payments_link.BankTransactionId = bank_transactions.transaction_id
                                        LEFT JOIN bank_accounts ON bank_transactions.bank_account_id = account_id
                                        LEFT JOIN invoices ON invoices.InvoiceID = payments_link.InvoiceID
                                        WHERE invoices.InvoiceID = '$obj->InvoiceID'");

        $tabledata = array();
        $rowcnt = 0;
        $flt_sum = 0;
        while($obj_details = mysql_fetch_object($resultsearch)) {
            $tabledata[$rowcnt++] = array($obj_details->transaction_date,
                                          $obj_details->account_name,
                                          ToDutchNumber($obj_details->geboekt),
                                          ToDutchNumber($flt_sum += $obj_details->geboekt),
                                          ToDutchNumber($obj_details->inv_total),
                                          ToDutchNumber($obj_details->paid_amount));
        }
    
        // Generate the PDF table.
        $pdf->PDFtable($headerdata, 
                       $tabledata, 
                       "Factuur: $obj->InvoiceID    Datum: $obj->Invoice_date   Bedrijf: $obj->companyName");
        $pdf->Ln(3);
    }
    
    $pdf->Output();

    mysql_free_result($resultsearch);
    
    // Set update date
    $db_iwex->query("UPDATE events 
                     SET action_performed_date = NOW(),
                     action_done_by = '$employee_id'
                     WHERE id = 2");
}
?>
