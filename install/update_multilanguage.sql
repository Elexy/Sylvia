ALTER TABLE `contacts` ADD `languageID` TINYINT( 3 ) UNSIGNED DEFAULT '1' NOT NULL AFTER `Country` ;
ALTER TABLE `Personen` ADD `languageID` TINYINT( 3 ) UNSIGNED DEFAULT '1' NOT NULL AFTER `tussenvoegsel` ;
ALTER TABLE `users` ADD `languageID` TINYINT( 3 ) UNSIGNED DEFAULT '1' NOT NULL AFTER `email` ;

-- --------------------------------------------------------
-- 
-- Tabel structuur voor tabel `text_categories`
-- 

DROP TABLE IF EXISTS `text_categories`;
CREATE TABLE `text_categories` (
  `text_categoryID` tinyint(2) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`text_categoryID`)
) TYPE=MyISAM AUTO_INCREMENT=13 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `text_categories`
-- 

INSERT INTO `text_categories` (`text_categoryID`, `name`) VALUES (1, 'New dealer'),
(2, 'Order confirm'),
(3, 'Unpaid invoice reminder'),
(4, 'Password changed'),
(5, 'New password'),
(6, 'User blocked'),
(7, 'Email Factuur'),
(8, 'Home pagina text  	'),
(9, 'Overdue Letter'),
(10, 'Overdue letter aangetekend'),
(11, 'Overdue Fax'),
(12, 'Uw login aanvraag op iwex.nl');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `text`
-- 
DROP TABLE IF EXISTS `text`;
CREATE TABLE `text` (
  `textID` int(3) unsigned NOT NULL auto_increment,
  `categoryID` tinyint(2) unsigned NOT NULL default '0',
  `languageID` tinyint(3) unsigned NOT NULL default '0',
  `subject` varchar(30) NOT NULL default '',
  `text` text NOT NULL,
  PRIMARY KEY  (`textID`)
) TYPE=MyISAM COMMENT='texten' AUTO_INCREMENT=14 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `text`
-- 

insert into `text` values 
(1,1,1,'Nieuwe dealer','Allereerst dank ik u voor uw interesse in onze producten en organisatie en voor het toezenden van uw KVK gegevens. Hierbij vindt u in het kort wat informatie.\r\n\r\nIwex is een Groothandel en doet als zodanig alleen zaken met bedrijven. Er is geen minimum voorraadeis of bestelaantal. Bij grotere aantallen gaat echter wel de prijs omlaag. Voor iedereen geld dat de eerste drie maanden alle orders onder rembours of vooruitbetaling geschieden, daarna eventueel met 14 dagen betalingstermijn. Verder kunnen wij u ondersteunen door het voorzien in beeldmateriaal, eventueel foldermateriaal. Boven de 400 euro (online 300) worden zendingen tot de Nederlandse grens franco geleverd, daaronder worden 13,50 (online 12,50) kosten berekend. Indien u kiest voor rembours rekenen wij 10 euro extra.\r\n\r\nWij zijn specialist in mobiele navigatie en communicatie oplossingen. Wij hebben daarvoor dan ook alle kennis in huis. Naast de bekende merken kunnen wij u ook op maat oplossingen bieden. \r\n\r\nDe meest recente prijslijst vindt u op: http://iwex.serveftp.net/prijslijst/ \r\nusername: customer \r\npassword: go35700\r\nDit password kan wijzigen dus raadpleeg uw laatste prijslijst email voor het juiste wachtwoord.\r\n\r\nOm naast online artikelen en prijzen te bekijken ook online te bestellen zouden we u willen vragen dit http://iwex.serveftp.org/prijslijst/Overeenkomst%20elektronische%20handel.pdf formulier ondertekend aan ons terug te sturen.\r\n\r\nMet vriendelijke groeten,\r\n\r\nIwex\r\nDorpsstraat 115\r\nNL 1733 AG NIEUWE NIEDORP \r\n\r\nTel: +31 (0) 226 411 299\r\nFax: +31 (0) 842 216 330\r\n\r\nMailto:verkoop@iwex.nl\r\nhttp://www.iwex.nl'),
(2,2,1,'Order confirm','Beste inkoop van varCustomer,\r\n\r\nvarCreditText<p>Hieronder vindt u uw varComfirmType met prijsinformatie, met uw referentie: \'varCustorderID\'.</p>\r\n<p>Wij vragen u deze te controleren op juistheid en volledigheid. Wanneer er geen onregelmatigheden zijn, hoeft u niet te reageren.</p> \r\n\r\nWilt u deze varComfirmType online inzien en volgen, klik op: varOnlineOrderText\r\n<br>\r\n\r\nvarOrderdetails\r\n\r\n<p>Uw betalingsconditie: varPaymentTerm</p>\r\n\r\n<p>Aflever adres is:<br>\r\nvarShipTo</p>\r\n\r\n<p>Met vriendelijke groeten,</p>\r\n\r\n<p>varEmployee<br>\r\n_varcompanyname_ verkoop<br>\r\n_varaddress_<br>\r\n_varzipcode_ _varcity_<br>\r\nTel. _vartelephone_<br>\r\nFax. _varfaxnumber_<br>\r\n<a href=\'_varwebsite_\'>_varcompanyname_</a></p>\r\n\r\n<p>Op al onze diensten en leveringen zijn onze <a href=\"http://iwex.serveftp.org/prijslijst/Leveringsvoorwaarden.pdf\">\r\n<img src=\"http://iwex.serveftp.org/images/pdficon.gif\" alt=\"PDF file\" border=\"0\" height=\"15\"> leveringsvoorwaarden</a> van toepassing.</p>\r\n'),
(3,3,1,'Openstaande Facturen','Beste administratie van varCustomer,\r\n\r\n<p>Volgens onze administratie heeft uw bedrijf de volgende factuur(en) nog niet voldaan.</p>\r\n\r\n<p>varInvoiceTable</p>\r\n\r\n<p>Wij verzoeken u vriendelijk de openstaande factuur z.s.m. te voldoen.<br>\r\nWanneer deze factuur reeds voldaan is, kunt u deze email als niet verzonden beschouwen.</p>\r\n\r\n<p>Met vriendelijke groeten,</p>\r\n\r\n<p>varEmployee</p>\r\nAdministratie: <a href=\"mailto:administratie@iwex.nl\">administratie@iwex.nl</a><br>\r\nTel: _vartelephone_<br>\r\n_varcompanyname_'),
(4,4,1,'Password changed','Geachte Heer/Mevrouw,\r\n\r\nUw wachtwoord op de website van http://iwex.serveftp.org/prijslijst is succes vol gewijzigd.'),
(5,5,1,'Nieuw wachtwoord','Geacht Heer/Mevrouw,\r\n\r\nEr is een nieuw wachtwoord aangemaakt op de website van http://iwex.serveftp.org/prijslijst.\r\n\r\nUw nieuwe wachtwoord is: pwnew\r\n\r\nN.b. Uit veiligheidsoverwegingen is er geen username meegestuurd.'),
(6,6,1,'User blocked','Geachte Heer/Mevrouw,\r\n\r\nEr is drie keer fout ingelogd op de dealer site van Iwex met de webuser: USER.\r\n\r\nUw account is nu geblokkeerd. U kunt hier: http://iwex.serveftp.org/prijslijst/get_password.php een nieuw wachtwoord aanvragen.\r\n\r\nHet volgende ip adres is hiervoor gebruikt IP. '),
(7,7,1,'Uw factuur','Beste varCustomer,<br /><br />  Bij deze uw factuur.<br />'),
(8,8,1,'Home pagina text','<h2>Asterisk start guide</h2><p>0 buiten lijn via ISDN</p><p>8 buiten lijn via VoipBuster (zo intikken 80031226411299)</p><p><a target=\"_blank\" href=\"http://192.168.0.8/amp/admin/reports.php?\">Gesprekken overzicht </a></p><p><a target=\"_blank\" href=\"http://192.168.0.8/amp/recordings/\">Voicemail menu </a></p>      <table border=\"0\"><tbody>  <tr><th class=\"mceVisualAid\">Snel keuze toetsen</th><th class=\"mceVisualAid\">Toestel nummers</th></tr>     <tr>    <td>     <p>#70 On hold/parkeren. Daarna hoor je de parkeerplaats meestal 71<br />     #xx Direct doorverbinden naar toestel \'xx\'<br />     #*xx Direct doorverbinden naar de voicemail </p>         <p>*43       Echo Test<br />      </p>              <p class=\"\\\"><!--[if !supportEmptyParas]--> <!--[endif]--></p>              <p class=\"\\\"> *60       Time<br />       *61        Weather<br />        *62       Schedule wakeup call<br />       *65       Festival test (your extension is XXX)</p>              <p class=\"\\\">*69       Last Caller number/ID<br />       *70       Activate Call Waiting (deactivated by default)<br />        *71       Deactivate Call Waiting<br />       *72       Call Forwarding System<br />       *73       Disable Call Forwarding<br />       *77       IVR Recording<br />       *78       Enable Do-Not-Disturb<br />        *79       Disable Do-Not-Disturb<br />*8   Pickup extern<br />       *90       Call Forward on Busy<br />       *91       Disable Call Forward on Busy<br />       *97       Message Center (does no ask for extension)<br />       *98       Enter Message Center<br />        *99       Playback IVR Recording</p>              <p class=\"\\\">*411     Directory<br />       666      Test Fax</p>              <p class=\"\\\">888      Barge in (there are variations)<br />        7777    Simulate incoming call</p>     </td>       <td valign=\"top\">   <p>11<br />     12<br />   13 Henri (RMA)<br />   14 Menno<br />   21 Fred<br />   22 Els<br />   23 Alex & Iwan<br />   24 Peter<br />   </p><p>Soft phones<br />32 Iwan<br />37 Henri<br />41 Mathieu<br /></p><p> </p></td>     </tr>    </tbody></table>'),
(9,9,1,'Overdue Letter','_varcity_, _varletterdateText_\r\n\r\nvarCustomer\r\n_varletterTo_\r\n\r\nBetreft: Openstaande facturen \r\n\r\nOns referentie nummer: _varletterrefNum_\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoormiddel van dit schrijven wil ik u er op wijzen dat uw firma varCustomer, nog een bedrag van € _varlettertotal_ bij ons heeft openstaan.\r\n\r\n_varstringbreak_\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van _varPaymentTerm_ dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nBij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze € _varlettertotal_ alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben geïnformeerd.\r\n\r\nHoogachtend,\r\n_varcompanyname_\r\n\r\n\r\n\r\n\r\n\r\n\r\n_varEmployee_\r\nHoofd administratie'),
(10,10,1,'Overdue letter aangetekend','_varcity_, _varletterdateText_\r\n\r\nvarCustomer\r\n_varletterTo_\r\n\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: _varletterrefNum_\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nOp _varletterletterdateText_ hebben wij u verzocht om onze facturen met nr. _varlettertotalinvoices_ ten bedrage van € _varlettertotal_ (incl. BTW) binnen 7 dagen te voldoen. Bij deze het overzicht van de openstaande facturen:\r\n\r\n_varstringbreak_\r\nTot op heden hebben wij echter nog geen betaling mogen ontvangen. \r\n\r\nGelet op het feit dat u niet antwoordde op ons vorige schrijven, noch de ontvangst daarvan bevestigde, zijn wij thans genoodzaakt u dit aangetekende schrijven te sturen. \r\n\r\nWij verzoeken u, en voor zover nodig sommeren u, om binnen tien dagen na dagtekening van dit schrijven het verschuldigde bedrag ad € _varlettertotalandintrest_  (incl. 1% verschuldigde rente per maand en € 10,00 aangetekend schrijven kosten) alsnog over te maken op één van onze rekening nummers. Geeft u aan deze sommatie geen gevolg, dan bent u aan het einde van de sommatie termijn van rechtswege in verzuim.\r\n\r\nVanaf dat moment bent u ook de wettelijke rente verschuldigd op basis van de toepasselijke algemene voorwaarden en reeds nu voor alsdan in gebreke. Wij zullen alsdan overgaan tot het nemen van rechtsmaatregelen, waarbij alle gerechtelijke en buitengerechtelijke kosten voor uw rekening komen. \r\n\r\nOm strikt formele redenen wordt een kopie van deze brief u ook per gewone post toegezonden.\r\n\r\nOnder voorbehoud van alle rechten en weren.\r\n\r\nHoogachtend, \r\n\r\n\r\n\r\n\r\n_varEmployee_\r\nDirecteur _varcompanyname_'),
(11,11,1,'Overdue Fax','_varcity_, _varletterdateText_\r\n\r\nvarCustomer\r\n_varfaxnumber_\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: _varletterrefNum_\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoor middel van dit schrijven wil ik u er op wijzen dat uw firma varCustomer, nog een bedrag van € _varlettertotal_ bij ons heeft openstaan. Dit is geresulteerd uit de facturen met nummers:\r\n\r\n_varstringbreak_\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van 14 dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nBij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze € _varlettertotal_ alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben geïnformeerd.\r\n\r\nMet vriendelijke groeten,\r\n\r\n\r\n_varEmployee_'),
(12,12,1,'Uw login aanvraag op iwex.nl','Geachte Heer/Mevrouw\r\n\r\nBij deze is er een nieuwe account voor u aangemaakt op _vardealerlogin_\r\n\r\nU kunt nu inloggen met de volgende login gegevens\r\n\r\nUsername: _varnewusername_\r\nPassword: _varnewuserpass_\r\n\r\nOp de website van _varcompanyname_ kunt u uw wachtwoord wijzigen. Deze moet echter wel \r\nmeer dan 8 characters lang zijn en minimaal 1 hoofdletter bevatten\r\n\r\nLet op! Het is niet mogelijk om dit wachtwoord opnieuw op te vragen.\r\n\r\nMet vriendelijke groeten,\r\n_varcompanyname_ verkoop '),
(13,1,2,'New dealer','Thank you for you interest in our products.\r\n\r\nIwex is a distribution company and will only sell to their dealers. First orders will go under rembours or payment upfront. After that we will use a 14 days payment term. \r\n\r\nWe can help you with images and other material. Online orders are shipped to the Dutch border for free above 300 euro. Other orders are free Dutch border for above 400 euro. Below this amount we invoice 12.50 order cost for online and 13.50 for other order methods. Rembours will cost an extra 10 euro. T\r\n\r\nhe most recent price list can be found on : http://iwex.serveftp.net/prijslijst/ username: customer \r\npassword: 35700 \r\nThis password can change so check our latest mailing for the correct one. \r\n\r\nKind regards, \r\nIwex Dorpsstraat 115 \r\nNL 1733 AG NIEUWE NIEDORP \r\nPhone: +31 (0) 226 411 299 \r\nFax: +31 (0) 842 216 330 \r\nMailto:verkoop@iwex.nl \r\nhttp://www.iwex.nl ');


/*Table structure for table `fields_text_languages` */

DROP TABLE IF EXISTS `fields_text_languages`;

CREATE TABLE `fields_text_languages` (
  `fieldID` int(3) unsigned NOT NULL,
  `categoryID` tinyint(2) unsigned NOT NULL default '0',
  `languageID` tinyint(3) unsigned NOT NULL default '0',
  `text` varchar(50) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`fieldID`,`languageID`)
) ENGINE=MyISAM;

/*Data for the table `fields_text_languages` */

insert into `fields_text_languages` values 
(1,1,1,'Binnen 30 dagen'),
(2,1,1,'Binnen 14 dagen'),
(3,1,1,'Rembours'),
(4,1,1,'Vooruit / upfront'),
(5,1,1,'Automatische incasso'),
(6,1,1,'Binnen 45 dagen einde maand'),
(7,1,1,'Binnen 60 dagen einde maand'),
(8,1,1,'Autom. incasso na 30 dagen'),
(1,1,2,'Within 30 days'),
(2,1,2,'Within 14 days'),
(3,1,2,'Rembours'),
(4,1,2,'Upfront'),
(5,1,2,'Automatic witdrawn'),
(6,1,2,'Within 45 days end of the month'),
(7,1,2,'Within 60 days end of the month'),
(8,1,2,'Automatic witdrawn afther 30 days');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `languages`
-- 

DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `languageID` int(3) unsigned NOT NULL auto_increment,
  `language` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`languageID`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `languages`
-- 

INSERT INTO `languages` (`languageID`, `language`) VALUES (1, 'Dutch'),
(2, 'English'),
(3, 'German'),
(4, 'French'),
(5, 'Spanish'),
(6, 'Greek'),
(7, 'Italian');