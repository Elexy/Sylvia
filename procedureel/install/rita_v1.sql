-- phpMyAdmin SQL Dump
-- version 2.8.0.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generatie Tijd: 24 Mei 2006 om 10:53
-- Server versie: 4.0.24
-- PHP Versie: 4.4.0-3
-- 
-- Database: `rita_v1`
-- 

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `Adressen`
-- 

CREATE TABLE `Adressen` (
  `AdresID` int(10) unsigned NOT NULL auto_increment,
  `ContactID` int(10) unsigned default '0',
  `adrestitel` tinyint(3) default '1',
  `Naam` varchar(60) default NULL,
  `attn` varchar(60) default NULL,
  `straat` varchar(100) default '0',
  `huisnummer` varchar(18) default NULL,
  `postcode` varchar(10) default '0',
  `postbus` tinyint(1) unsigned NOT NULL default '0',
  `plaats` varchar(50) default '0',
  `land` char(2) NOT NULL default 'NL',
  `email` varchar(100) default NULL,
  `telefoon` varchar(20) default NULL,
  `Prive_adres` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`AdresID`),
  KEY `ContactID` (`ContactID`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `Adressen`
-- 

INSERT INTO `Adressen` (`AdresID`, `ContactID`, `adrestitel`, `Naam`, `attn`, `straat`, `huisnummer`, `postcode`, `postbus`, `plaats`, `land`, `email`, `telefoon`, `Prive_adres`) VALUES (1, 2, 4, 'Adress 1', '', '', '', '1111AA', 0, 'everywhere', 'NL', '', '', 0),
(2, 3, 4, 'Klant  2', 'dhr klantjes', 'unknown', '10', '1234AA', 0, 'unknown', 'NL', '', '', 0);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `Adrestitels`
-- 

CREATE TABLE `Adrestitels` (
  `titelID` tinyint(3) unsigned NOT NULL auto_increment,
  `titel` varchar(30) default '0',
  PRIMARY KEY  (`titelID`)
) TYPE=MyISAM AUTO_INCREMENT=10 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `Adrestitels`
-- 

INSERT INTO `Adrestitels` (`titelID`, `titel`) VALUES (1, 'Bezoekadres'),
(2, 'Factuuradres'),
(3, 'Afleveradres'),
(4, 'Enige adres'),
(5, 'Afleveradres thuis'),
(6, 'Postbusadres'),
(7, 'vervallen'),
(8, 'Drop ship adres'),
(9, 'RMA afdeling');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `Bugs`
-- 

CREATE TABLE `Bugs` (
  `Id` tinyint(3) unsigned NOT NULL auto_increment,
  `Description` varchar(200) NOT NULL default '0',
  `Prio` tinyint(3) unsigned default '0',
  PRIMARY KEY  (`Id`),
  UNIQUE KEY `Id` (`Id`),
  KEY `Id_2` (`Id`)
) TYPE=MyISAM COMMENT='Fouten die opgelost moeten worden.' AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `Bugs`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `Gender`
-- 

CREATE TABLE `Gender` (
  `Gender` varchar(10) default '0',
  `id` tinyint(1) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) TYPE=MyISAM COMMENT='man / vrouw' AUTO_INCREMENT=3 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `Gender`
-- 

INSERT INTO `Gender` (`Gender`, `id`) VALUES ('m', 1),
('v', 2);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `Personen`
-- 

CREATE TABLE `Personen` (
  `persoonID` int(10) unsigned NOT NULL auto_increment,
  `ContactID` int(10) unsigned NOT NULL default '0',
  `Personen_type_ID` int(3) unsigned NOT NULL default '0',
  `titel` varchar(30) default NULL,
  `voornaam` varchar(30) default NULL,
  `achternaam` varchar(30) default NULL,
  `tussenvoegsel` varchar(15) default NULL,
  `languageID` int(3) unsigned NOT NULL default '0',
  `email` varchar(100) default NULL,
  `mailing_yn` tinyint(3) default '1',
  `tel` varchar(30) default NULL,
  `fax` varchar(30) default NULL,
  `aanhef` varchar(20) default NULL,
  `gender` tinyint(3) unsigned default NULL,
  `notes` varchar(255) default NULL,
  `mobile` varchar(30) default NULL,
  PRIMARY KEY  (`persoonID`),
  KEY `ContactID` (`ContactID`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `Personen`
-- 

INSERT INTO `Personen` (`persoonID`, `ContactID`, `Personen_type_ID`, `titel`, `voornaam`, `achternaam`, `tussenvoegsel`, `languageID`, `email`, `mailing_yn`, `tel`, `fax`, `aanhef`, `gender`, `notes`, `mobile`) VALUES (1, 3, 1, 'Tester', 'Richard', 'tester', '', 1, '', 0, '', '', '', 0, '', '');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `Personen_type`
-- 

CREATE TABLE `Personen_type` (
  `Personen_type_ID` int(3) unsigned NOT NULL auto_increment,
  `Desctription` varchar(15) NOT NULL default '0',
  PRIMARY KEY  (`Personen_type_ID`),
  UNIQUE KEY `Personen_type_ID` (`Personen_type_ID`),
  KEY `Personen_type_ID_2` (`Personen_type_ID`)
) TYPE=MyISAM AUTO_INCREMENT=10 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `Personen_type`
-- 

INSERT INTO `Personen_type` (`Personen_type_ID`, `Desctription`) VALUES (1, 'Algemeen'),
(2, 'RMA'),
(3, 'Inkoop'),
(4, 'Verkoop'),
(5, 'Administratie'),
(6, 'Logistiek'),
(7, 'Anders'),
(8, 'Vervallen'),
(9, 'Debiteurenadmin');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `RMA`
-- 

CREATE TABLE `RMA` (
  `ID` int(8) unsigned NOT NULL auto_increment,
  `contacts_id` int(8) unsigned default NULL,
  `ProductID` int(10) unsigned default NULL,
  `aantal` smallint(1) unsigned default '1',
  `Customer_ID` varchar(20) default NULL,
  `SupplierID` varchar(20) default NULL,
  `Date_in` date default NULL,
  `SN` varchar(50) default '0',
  `Reason` mediumtext,
  `Date_done` date default NULL,
  `Additional_items` varchar(50) default NULL,
  `Aticle_code` tinyint(10) unsigned default NULL,
  `Article_name` varchar(25) default NULL,
  `FactuurID` int(10) unsigned default NULL,
  `State` tinyint(3) unsigned NOT NULL default '1',
  `product_customer` tinyint(3) unsigned NOT NULL default '1',
  `product_location` tinyint(3) unsigned NOT NULL default '1',
  `valid` tinyint(1) unsigned default '0',
  `webuser` varchar(30) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `productid` (`ProductID`),
  KEY `customerid` (`Customer_ID`),
  KEY `contactid` (`contacts_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `RMA`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `RMA_actions`
-- 

CREATE TABLE `RMA_actions` (
  `ActionID` int(10) unsigned NOT NULL auto_increment,
  `RMAID` int(11) default NULL,
  `ActionDate` datetime default NULL,
  `ActionTime` datetime default NULL,
  `Subject` tinyint(3) default NULL,
  `Notes` longtext,
  `employee` tinyint(3) unsigned default NULL,
  `webuser` varchar(30) default NULL,
  PRIMARY KEY  (`ActionID`),
  KEY `RMAID` (`RMAID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `RMA_actions`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `RMA_product_customer`
-- 

CREATE TABLE `RMA_product_customer` (
  `State_ID` tinyint(3) unsigned NOT NULL auto_increment,
  `State_text` char(100) default '0',
  UNIQUE KEY `Subject_ID` (`State_ID`),
  KEY `Subject_ID_2` (`State_ID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `RMA_product_customer`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `RMA_product_location`
-- 

CREATE TABLE `RMA_product_location` (
  `State_ID` tinyint(3) unsigned NOT NULL auto_increment,
  `State_text` char(100) default '0',
  UNIQUE KEY `Subject_ID` (`State_ID`),
  KEY `Subject_ID_2` (`State_ID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `RMA_product_location`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `RMA_state`
-- 

CREATE TABLE `RMA_state` (
  `State_ID` tinyint(3) unsigned NOT NULL auto_increment,
  `State_text` varchar(100) default '0',
  UNIQUE KEY `Subject_ID` (`State_ID`),
  KEY `Subject_ID_2` (`State_ID`)
) TYPE=MyISAM AUTO_INCREMENT=16 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `RMA_state`
-- 

INSERT INTO `RMA_state` (`State_ID`, `State_text`) VALUES (1, 'Klant RMA aanvraag'),
(2, 'Ontvangen'),
(3, 'Getest'),
(4, 'Wacht op antwoord dealer'),
(5, 'Wacht op antw. fabrikant'),
(6, 'RMA aangevraag bij fabrikant'),
(7, 'Verzonden aan fabrikant'),
(8, 'RMA unit ontvangen van fabrikant'),
(9, 'Afgehandeld'),
(10, 'Credit aangevraagd bij fabrikant'),
(11, 'Credit ontvangen van fabrikant'),
(12, 'Geen probleem gevonden'),
(14, 'Onbekend'),
(15, 'Credit gemaakt voor dealer');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `RMA_subject`
-- 

CREATE TABLE `RMA_subject` (
  `Subject_ID` tinyint(3) unsigned NOT NULL auto_increment,
  `Subject_text` varchar(25) default '0',
  UNIQUE KEY `Subject_ID` (`Subject_ID`),
  KEY `Subject_ID_2` (`Subject_ID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `RMA_subject`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `Serialnumbers`
-- 

CREATE TABLE `Serialnumbers` (
  `Inventory_transactionID` int(10) NOT NULL default '0',
  `Serial` varchar(50) NOT NULL default '0',
  `SerialRecordID` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`SerialRecordID`),
  UNIQUE KEY `UniqueSerial` (`Inventory_transactionID`,`Serial`),
  KEY `Serial` (`Serial`),
  KEY `Inventory` (`Inventory_transactionID`)
) TYPE=MyISAM COMMENT='serienummer uitgeleverde producten' AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `Serialnumbers`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `actions`
-- 

CREATE TABLE `actions` (
  `ID` tinyint(10) unsigned zerofill NOT NULL auto_increment,
  `ActionDate` datetime default NULL,
  `ContactID` tinyint(4) unsigned default '0',
  `ContactContents` longtext,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `actions`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `allow`
-- 

CREATE TABLE `allow` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `ContactID` int(10) unsigned default '0',
  `grant_shipment` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`),
  KEY `ID_2` (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `allow`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `amounts`
-- 

CREATE TABLE `amounts` (
  `id` tinyint(4) NOT NULL auto_increment,
  `value` decimal(10,2) default '0.00',
  `Description` varchar(25) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) TYPE=MyISAM COMMENT='opzoeken van vaste bedragen' AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `amounts`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `associated_products`
-- 

CREATE TABLE `associated_products` (
  `ProductID_Main` int(10) unsigned NOT NULL default '0',
  `ProductID_Acc` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ProductID_Acc`,`ProductID_Main`)
) TYPE=MyISAM;

-- 
-- Gegevens worden uitgevoerd voor tabel `associated_products`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `bank_accounts`
-- 

CREATE TABLE `bank_accounts` (
  `account_id` tinyint(3) unsigned NOT NULL auto_increment,
  `account_name` varchar(30) default NULL,
  `valuta_id` tinyint(3) unsigned default '2',
  `amount` decimal(10,2) default '0.00',
  KEY `account_id` (`account_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `bank_accounts`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `bank_transactions`
-- 

CREATE TABLE `bank_transactions` (
  `transaction_id` int(10) unsigned NOT NULL auto_increment,
  `bank_account_id` tinyint(3) unsigned default '0',
  `transaction_date` date default NULL,
  `name` varchar(30) default NULL,
  `amount` decimal(10,2) default '0.00',
  `description` varchar(200) default NULL,
  `other_account_number` varchar(25) default '0',
  `CustomerID` int(8) unsigned default NULL,
  PRIMARY KEY  (`transaction_id`),
  UNIQUE KEY `uniqueKey` (`transaction_date`,`description`,`amount`,`other_account_number`),
  KEY `transaction_date` (`transaction_date`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `bank_transactions`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `box`
-- 

CREATE TABLE `box` (
  `box_ID` int(10) unsigned NOT NULL auto_increment,
  `Shipment_ID` int(10) unsigned default NULL,
  `tracking` char(50) default NULL,
  `weight_kg` decimal(10,5) default NULL,
  `length_cm` decimal(10,2) default NULL,
  `width_cm` decimal(10,2) default NULL,
  `height_cm` decimal(10,2) default NULL,
  `volume_weight_kg` decimal(10,5) default NULL,
  `box_number` tinyint(3) unsigned default '0',
  PRIMARY KEY  (`box_ID`),
  KEY `Shipment` (`Shipment_ID`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `box`
-- 

INSERT INTO `box` (`box_ID`, `Shipment_ID`, `tracking`, `weight_kg`, `length_cm`, `width_cm`, `height_cm`, `volume_weight_kg`, `box_number`) VALUES (1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `branches`
-- 

CREATE TABLE `branches` (
  `BrancheContactID` int(5) NOT NULL default '0',
  `MainContactID` int(5) NOT NULL default '0',
  PRIMARY KEY  (`BrancheContactID`,`MainContactID`)
) TYPE=MyISAM;

-- 
-- Gegevens worden uitgevoerd voor tabel `branches`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `brand`
-- 

CREATE TABLE `brand` (
  `brand_id` int(4) unsigned NOT NULL auto_increment,
  `name` char(25) default '0',
  PRIMARY KEY  (`brand_id`)
) TYPE=MyISAM COMMENT='lookup brand names' AUTO_INCREMENT=3 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `brand`
-- 

INSERT INTO `brand` (`brand_id`, `name`) VALUES (1, 'Merk 1'),
(2, 'Merk 2');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `btwtabel`
-- 

CREATE TABLE `btwtabel` (
  `Btw_class` tinyint(1) unsigned NOT NULL default '0',
  `BTWpercentage` tinyint(4) unsigned default '0',
  PRIMARY KEY  (`Btw_class`),
  UNIQUE KEY `BTWClass` (`Btw_class`),
  KEY `BTWClass_2` (`Btw_class`)
) TYPE=MyISAM COMMENT='pzoeken van BTW';

-- 
-- Gegevens worden uitgevoerd voor tabel `btwtabel`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `calls`
-- 

CREATE TABLE `calls` (
  `CallID` int(10) unsigned NOT NULL auto_increment,
  `ContactID` int(11) default NULL,
  `CallDate` datetime default NULL,
  `CallTime` datetime default NULL,
  `employee` tinyint(3) unsigned default NULL,
  `Subject` longtext,
  `Notes` longtext,
  PRIMARY KEY  (`CallID`)
) TYPE=MyISAM AUTO_INCREMENT=24 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `calls`
-- 

INSERT INTO `calls` (`CallID`, `ContactID`, `CallDate`, `CallTime`, `employee`, `Subject`, `Notes`) VALUES (1, 3, '2006-05-23 16:27:00', NULL, 1, 'Openstaande Facturen', 'Email verzonden aan: <hr>Beste administratie van Klant 2,\r\n\r\n<p>Volgens onze administratie heeft uw bedrijf de volgende factuur(en) nog niet voldaan.</p>\r\n\r\n<p><table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">\n			  <tr>\n				<th colspan=2>Factuur</th>\n				<th>Verstuurd aan</th>\n				<th>Datum</th>\n				<th>Bedrag</th>\n				<th>Betaald</th>\n			  </tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>1</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-04-2006</td><td align=right>57,50</td><td align=right>0,00</td>\n</tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>2</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-03-2006</td><td align=right>123,50</td><td align=right>0,00</td>\n</tr><tr><td align=center style="background-color:#FDE967;">OK</td><td align=center style="background-color:#FF5050;">Te laat</td><td align=right colspan=2><b>Totaal</b></td><td align=right>181,00</td><td align=right>0,00</td><tr>\n</table>\n\n</p>\r\n\r\n<p>Wij verzoeken u vriendelijk de openstaande factuur z.s.m. te voldoen.<br>\r\nWanneer deze factuur reeds voldaan is, kunt u deze email als niet verzonden beschouwen.</p>\r\n\r\n<p>Met vriendelijke groeten,</p>\r\n\r\n<p>Rita de Program</p>\r\nAdministratie: <a href="mailto:administratie@iwex.nl">administratie@iwex.nl</a><br>\r\nTel: +31 36 549 0083<br>\r\nKeomo<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cellline">\n<tr><th></th><th></th>\n						<th></th>\n		 				<th></th><th></th></tr><tr><td ROWSPAN=2>1000001</td><td ROWSPAN=2>813372100B01</td><td> 9232112</td><td>NL91PSTB0009232112</td><td>PSTBNL21</td></tr>\n<tr><td> 654197865</td><td>123</td><td>456</td></tr>\n</table>'),
(2, 3, '2006-05-23 16:31:00', NULL, 1, 'Fax', 'Er is een fax opgeslagen met referentie num: 000012006<BR><BR>Almere, 23 May 2006\r\n\r\nKlant  2\r\n+31 842 7126432\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: 000012006\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoor middel van dit schrijven wil ik u er op wijzen dat uw firma Klant  2, nog een bedrag van � 181,00 bij ons heeft openstaan. Dit is geresulteerd uit de facturen met nummers:\r\n\r\n<br><table width=''100%'' border=''1'' cellspacing=''0''>\n						<tr><th>Factuur nummer</th><th>Datum</th><th>Verzonden aan</th>\n						<th>Bedrag</th><th>Betaald</th></tr><tr><td>1</td><td>19-04-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>57,50</td><td>0,00</td></tr><tr><td>2</td><td>19-03-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>123,50</td><td>0,00</td></tr></table><br>\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van 14 dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nnij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze � 181,00 alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben ge�nformeerd.\r\n\r\nMet vriendelijke groeten,\r\nRita de Program'),
(3, 3, '2006-05-23 16:34:00', NULL, 1, 'Fax', 'Er is een fax opgeslagen met referentie num: 000012006<BR><BR>Almere, 23 May 2006\r\n\r\nKlant  2\r\n+31 842 7126432\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: 000012006\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoor middel van dit schrijven wil ik u er op wijzen dat uw firma Klant  2, nog een bedrag van � 181,00 bij ons heeft openstaan. Dit is geresulteerd uit de facturen met nummers:\r\n\r\n<br><table width=''100%'' border=''1'' cellspacing=''0''>\n						<tr><th>Factuur nummer</th><th>Datum</th><th>Verzonden aan</th>\n						<th>Bedrag</th><th>Betaald</th></tr><tr><td>1</td><td>19-04-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>57,50</td><td>0,00</td></tr><tr><td>2</td><td>19-03-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>123,50</td><td>0,00</td></tr></table><br>\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van 14 dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nnij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze � 181,00 alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben ge�nformeerd.\r\n\r\nMet vriendelijke groeten,\r\nRita de Program'),
(4, 3, '2006-05-23 17:10:00', NULL, 1, 'Fax', 'Er is een fax opgeslagen met referentie num: 000022006<BR><BR>Almere, 23 May 2006\r\n\r\nKlant  2\r\n+31 842 7126432\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: 000022006\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoor middel van dit schrijven wil ik u er op wijzen dat uw firma Klant  2, nog een bedrag van � 181,00 bij ons heeft openstaan. Dit is geresulteerd uit de facturen met nummers:\r\n\r\n<br><table width=''100%'' border=''1'' cellspacing=''0''>\n						<tr><th>Factuur nummer</th><th>Datum</th><th>Verzonden aan</th>\n						<th>Bedrag</th><th>Betaald</th></tr><tr><td>1</td><td>19-04-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>57,50</td><td>0,00</td></tr><tr><td>2</td><td>19-03-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>123,50</td><td>0,00</td></tr></table><br>\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van 14 dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nnij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze � 181,00 alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben ge�nformeerd.\r\n\r\nMet vriendelijke groeten,\r\nRita de Program'),
(5, 3, '2006-05-23 17:11:00', NULL, 1, 'Fax', 'Er is een fax opgeslagen met referentie num: 000032006<BR><BR>Almere, 23 May 2006\r\n\r\nKlant  2\r\n+31 842 7126432\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: 000032006\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoor middel van dit schrijven wil ik u er op wijzen dat uw firma Klant  2, nog een bedrag van � 181,00 bij ons heeft openstaan. Dit is geresulteerd uit de facturen met nummers:\r\n\r\n<br><table width=''100%'' border=''1'' cellspacing=''0''>\n						<tr><th>Factuur nummer</th><th>Datum</th><th>Verzonden aan</th>\n						<th>Bedrag</th><th>Betaald</th></tr><tr><td>1</td><td>19-04-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>57,50</td><td>0,00</td></tr><tr><td>2</td><td>19-03-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>123,50</td><td>0,00</td></tr></table><br>\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van 14 dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nnij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze � 181,00 alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben ge�nformeerd.\r\n\r\nMet vriendelijke groeten,\r\nRita de Program'),
(6, 3, '2006-05-23 17:16:00', NULL, 1, 'Fax', 'Er is een fax opgeslagen met referentie num: 000012006<BR><BR>Almere, 23 May 2006\r\n\r\nKlant  2\r\n+31 842 7126432\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: 000012006\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoor middel van dit schrijven wil ik u er op wijzen dat uw firma Klant  2, nog een bedrag van � 181,00 bij ons heeft openstaan. Dit is geresulteerd uit de facturen met nummers:\r\n\r\n<br><table width=''100%'' border=''1'' cellspacing=''0''>\n						<tr><th>Factuur nummer</th><th>Datum</th><th>Verzonden aan</th>\n						<th>Bedrag</th><th>Betaald</th></tr><tr><td>1</td><td>19-04-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>57,50</td><td>0,00</td></tr><tr><td>2</td><td>19-03-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>123,50</td><td>0,00</td></tr></table><br>\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van 14 dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nnij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze � 181,00 alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben ge�nformeerd.\r\n\r\nMet vriendelijke groeten,\r\nRita de Program'),
(7, 3, '2006-05-23 17:18:00', NULL, 1, 'Fax', 'Er is een fax opgeslagen met referentie num: 000022006<BR><BR>Almere, 23 May 2006\r\n\r\nKlant  2\r\n+31 842 7126432\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: 000022006\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoor middel van dit schrijven wil ik u er op wijzen dat uw firma Klant  2, nog een bedrag van � 181,00 bij ons heeft openstaan. Dit is geresulteerd uit de facturen met nummers:\r\n\r\n<br><table width=''100%'' border=''1'' cellspacing=''0''>\n						<tr><th>Factuur nummer</th><th>Datum</th><th>Verzonden aan</th>\n						<th>Bedrag</th><th>Betaald</th></tr><tr><td>1</td><td>19-04-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>57,50</td><td>0,00</td></tr><tr><td>2</td><td>19-03-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>123,50</td><td>0,00</td></tr></table><br>\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van 14 dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nnij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze � 181,00 alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben ge�nformeerd.\r\n\r\nMet vriendelijke groeten,\r\nRita de Program'),
(8, 3, '2006-05-23 17:20:00', NULL, 1, 'Fax', 'Er is een fax opgeslagen met referentie num: 000032006<BR><BR>Almere, 23 May 2006\r\n\r\nKlant  2\r\n+31 842 7126432\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: 000032006\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoor middel van dit schrijven wil ik u er op wijzen dat uw firma Klant  2, nog een bedrag van � 181,00 bij ons heeft openstaan. Dit is geresulteerd uit de facturen met nummers:\r\n\r\n<br><table width=''100%'' border=''1'' cellspacing=''0''>\n						<tr><th>Factuur nummer</th><th>Datum</th><th>Verzonden aan</th>\n						<th>Bedrag</th><th>Betaald</th></tr><tr><td>1</td><td>19-04-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>57,50</td><td>0,00</td></tr><tr><td>2</td><td>19-03-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>123,50</td><td>0,00</td></tr></table><br>\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van 14 dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nnij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze � 181,00 alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben ge�nformeerd.\r\n\r\nMet vriendelijke groeten,\r\nRita de Program'),
(9, 3, '2006-05-23 17:30:00', NULL, 1, 'Fax', 'Er is een fax opgeslagen met referentie num: 000042006<BR><BR>Almere, 23 May 2006\r\n\r\nKlant  2\r\n+31 842 7126432\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: 000042006\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoor middel van dit schrijven wil ik u er op wijzen dat uw firma Klant  2, nog een bedrag van � 181,00 bij ons heeft openstaan. Dit is geresulteerd uit de facturen met nummers:\r\n\r\n<br><table width=''100%'' border=''1'' cellspacing=''0''>\n						<tr><th>Factuur nummer</th><th>Datum</th><th>Verzonden aan</th>\n						<th>Bedrag</th><th>Betaald</th></tr><tr><td>1</td><td>19-04-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>57,50</td><td>0,00</td></tr><tr><td>2</td><td>19-03-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>123,50</td><td>0,00</td></tr></table><br>\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van 14 dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nnij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze � 181,00 alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben ge�nformeerd.\r\n\r\nMet vriendelijke groeten,\r\nRita de Program'),
(10, 3, '2006-05-23 17:30:00', NULL, 1, 'Fax', 'Er is een fax opgeslagen met referentie num: 000052006<BR><BR>Almere, 23 May 2006\r\n\r\nKlant  2\r\n+31 842 7126432\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: 000052006\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoor middel van dit schrijven wil ik u er op wijzen dat uw firma Klant  2, nog een bedrag van � 181,00 bij ons heeft openstaan. Dit is geresulteerd uit de facturen met nummers:\r\n\r\n<br><table width=''100%'' border=''1'' cellspacing=''0''>\n						<tr><th>Factuur nummer</th><th>Datum</th><th>Verzonden aan</th>\n						<th>Bedrag</th><th>Betaald</th></tr><tr><td>1</td><td>19-04-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>57,50</td><td>0,00</td></tr><tr><td>2</td><td>19-03-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>123,50</td><td>0,00</td></tr></table><br>\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van 14 dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nnij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze � 181,00 alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben ge�nformeerd.\r\n\r\nMet vriendelijke groeten,\r\nRita de Program'),
(11, 3, '2006-05-23 17:30:00', NULL, 1, 'Fax', 'Er is een fax opgeslagen met referentie num: 000062006<BR><BR>Almere, 23 May 2006\r\n\r\nKlant  2\r\n+31 842 7126432\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: 000062006\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoor middel van dit schrijven wil ik u er op wijzen dat uw firma Klant  2, nog een bedrag van � 181,00 bij ons heeft openstaan. Dit is geresulteerd uit de facturen met nummers:\r\n\r\n<br><table width=''100%'' border=''1'' cellspacing=''0''>\n						<tr><th>Factuur nummer</th><th>Datum</th><th>Verzonden aan</th>\n						<th>Bedrag</th><th>Betaald</th></tr><tr><td>1</td><td>19-04-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>57,50</td><td>0,00</td></tr><tr><td>2</td><td>19-03-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>123,50</td><td>0,00</td></tr></table><br>\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van 14 dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nnij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze � 181,00 alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben ge�nformeerd.\r\n\r\nMet vriendelijke groeten,\r\nRita de Program'),
(12, 3, '2006-05-23 17:31:00', NULL, 1, 'Fax', 'Er is een fax opgeslagen met referentie num: 000072006<BR><BR>Almere, 23 May 2006\r\n\r\nKlant  2\r\n+31 842 7126432\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: 000072006\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoor middel van dit schrijven wil ik u er op wijzen dat uw firma Klant  2, nog een bedrag van � 181,00 bij ons heeft openstaan. Dit is geresulteerd uit de facturen met nummers:\r\n\r\n<br><table width=''100%'' border=''1'' cellspacing=''0''>\n						<tr><th>Factuur nummer</th><th>Datum</th><th>Verzonden aan</th>\n						<th>Bedrag</th><th>Betaald</th></tr><tr><td>1</td><td>19-04-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>57,50</td><td>0,00</td></tr><tr><td>2</td><td>19-03-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>123,50</td><td>0,00</td></tr></table><br>\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van 14 dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nnij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze � 181,00 alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben ge�nformeerd.\r\n\r\nMet vriendelijke groeten,\r\nRita de Program'),
(13, 3, '2006-05-24 08:17:00', NULL, 1, 'Fax', 'Er is een fax opgeslagen met referentie num: 000082006<BR><BR>Almere, 24 May 2006\r\n\r\nKlant  2\r\n+31 842 7126432\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: 000082006\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoor middel van dit schrijven wil ik u er op wijzen dat uw firma Klant  2, nog een bedrag van � 181,00 bij ons heeft openstaan. Dit is geresulteerd uit de facturen met nummers:\r\n\r\n<br><table width=''100%'' border=''1'' cellspacing=''0''>\n						<tr><th>Factuur nummer</th><th>Datum</th><th>Verzonden aan</th>\n						<th>Bedrag</th><th>Betaald</th></tr><tr><td>1</td><td>19-04-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>57,50</td><td>0,00</td></tr><tr><td>2</td><td>19-03-2006</td><td>Klant  2\r T.a.v. dhr klantjes</td><td>123,50</td><td>0,00</td></tr></table><br>\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van 14 dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nnij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze � 181,00 alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben ge�nformeerd.\r\n\r\nMet vriendelijke groeten,\r\nRita de Program'),
(14, 3, '2006-05-24 10:29:00', NULL, 1, 'Openstaande Facturen', 'Email verzonden aan: <hr>Beste administratie van Klant 2,\r\n\r\n<p>Volgens onze administratie heeft uw bedrijf de volgende factuur(en) nog niet voldaan.</p>\r\n\r\n<p><table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">\n			  <tr>\n				<th colspan=2></th>\n				<th></th>\n				<th></th>\n				<th></th>\n				<th></th>\n			  </tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>1</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-04-2006</td><td align=right>57,50</td><td align=right>0,00</td>\n</tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>2</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-03-2006</td><td align=right>123,50</td><td align=right>0,00</td>\n</tr><tr><td align=center style="background-color:#FDE967;">OK</td><td align=center style="background-color:#FF5050;">Te laat</td><td align=right colspan=2><b>Totaal</b></td><td align=right>181,00</td><td align=right>0,00</td><tr>\n</table>\n\n</p>\r\n\r\n<p>Wij verzoeken u vriendelijk de openstaande factuur z.s.m. te voldoen.<br>\r\nWanneer deze factuur reeds voldaan is, kunt u deze email als niet verzonden beschouwen.</p>\r\n\r\n<p>Met vriendelijke groeten,</p>\r\n\r\n<p>Rita de Program</p>\r\nAdministratie: <a href="mailto:administratie@iwex.nl">administratie@iwex.nl</a><br>\r\nTel: +31 36 549 0083<br>\r\nKeomo<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cellline">\n<tr><th></th><th></th>\n						<th></th>\n		 				<th></th><th></th></tr><tr><td ROWSPAN=2>1000001</td><td ROWSPAN=2>813372100B01</td><td> 9232112</td><td>NL91PSTB0009232112</td><td>PSTBNL21</td></tr>\n<tr><td> 654197865</td><td>123</td><td>456</td></tr>\n</table>'),
(15, 3, '2006-05-24 10:32:00', NULL, 1, 'Openstaande Facturen', 'Email verzonden aan: <hr>Beste administratie van Klant 2,\r\n\r\n<p>Volgens onze administratie heeft uw bedrijf de volgende factuur(en) nog niet voldaan.</p>\r\n\r\n<p><table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">\n			  <tr>\n				<th colspan=2></th>\n				<th></th>\n				<th></th>\n				<th></th>\n				<th></th>\n			  </tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>1</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-04-2006</td><td align=right>57,50</td><td align=right>0,00</td>\n</tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>2</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-03-2006</td><td align=right>123,50</td><td align=right>0,00</td>\n</tr><tr><td align=center style="background-color:#FDE967;">OK</td><td align=center style="background-color:#FF5050;">Te laat</td><td align=right colspan=2><b>Totaal</b></td><td align=right>181,00</td><td align=right>0,00</td><tr>\n</table>\n\n</p>\r\n\r\n<p>Wij verzoeken u vriendelijk de openstaande factuur z.s.m. te voldoen.<br>\r\nWanneer deze factuur reeds voldaan is, kunt u deze email als niet verzonden beschouwen.</p>\r\n\r\n<p>Met vriendelijke groeten,</p>\r\n\r\n<p>Rita de Program</p>\r\nAdministratie: <a href="mailto:administratie@iwex.nl">administratie@iwex.nl</a><br>\r\nTel: +31 36 549 0083<br>\r\nKeomo<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cellline">\n<tr><th></th><th></th>\n						<th></th>\n		 				<th></th><th></th></tr><tr><td ROWSPAN=2>1000001</td><td ROWSPAN=2>813372100B01</td><td> 9232112</td><td>NL91PSTB0009232112</td><td>PSTBNL21</td></tr>\n<tr><td> 654197865</td><td>123</td><td>456</td></tr>\n</table>'),
(16, 3, '2006-05-24 10:33:00', NULL, 1, 'Openstaande Facturen', 'Email verzonden aan: <hr>Beste administratie van Klant 2,\r\n\r\n<p>Volgens onze administratie heeft uw bedrijf de volgende factuur(en) nog niet voldaan.</p>\r\n\r\n<p><table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">\n			  <tr>\n				<th colspan=2></th>\n				<th></th>\n				<th></th>\n				<th></th>\n				<th></th>\n			  </tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>1</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-04-2006</td><td align=right>57,50</td><td align=right>0,00</td>\n</tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>2</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-03-2006</td><td align=right>123,50</td><td align=right>0,00</td>\n</tr><tr><td align=center style="background-color:#FDE967;">OK</td><td align=center style="background-color:#FF5050;">Te laat</td><td align=right colspan=2><b>Totaal</b></td><td align=right>181,00</td><td align=right>0,00</td><tr>\n</table>\n\n</p>\r\n\r\n<p>Wij verzoeken u vriendelijk de openstaande factuur z.s.m. te voldoen.<br>\r\nWanneer deze factuur reeds voldaan is, kunt u deze email als niet verzonden beschouwen.</p>\r\n\r\n<p>Met vriendelijke groeten,</p>\r\n\r\n<p>Rita de Program</p>\r\nAdministratie: <a href="mailto:administratie@iwex.nl">administratie@iwex.nl</a><br>\r\nTel: +31 36 549 0083<br>\r\nKeomo<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cellline">\n<tr><th></th><th></th>\n						<th></th>\n		 				<th></th><th></th></tr><tr><td ROWSPAN=2>1000001</td><td ROWSPAN=2>813372100B01</td><td> 9232112</td><td>NL91PSTB0009232112</td><td>PSTBNL21</td></tr>\n<tr><td> 654197865</td><td>123</td><td>456</td></tr>\n</table>'),
(17, 3, '2006-05-24 10:33:00', NULL, 1, 'Openstaande Facturen', 'Email verzonden aan: <hr>Beste administratie van Klant 2,\r\n\r\n<p>Volgens onze administratie heeft uw bedrijf de volgende factuur(en) nog niet voldaan.</p>\r\n\r\n<p><table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">\n			  <tr>\n				<th colspan=2></th>\n				<th></th>\n				<th></th>\n				<th></th>\n				<th></th>\n			  </tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>1</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-04-2006</td><td align=right>57,50</td><td align=right>0,00</td>\n</tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>2</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-03-2006</td><td align=right>123,50</td><td align=right>0,00</td>\n</tr><tr><td align=center style="background-color:#FDE967;">OK</td><td align=center style="background-color:#FF5050;">Te laat</td><td align=right colspan=2><b>Totaal</b></td><td align=right>181,00</td><td align=right>0,00</td><tr>\n</table>\n\n</p>\r\n\r\n<p>Wij verzoeken u vriendelijk de openstaande factuur z.s.m. te voldoen.<br>\r\nWanneer deze factuur reeds voldaan is, kunt u deze email als niet verzonden beschouwen.</p>\r\n\r\n<p>Met vriendelijke groeten,</p>\r\n\r\n<p>Rita de Program</p>\r\nAdministratie: <a href="mailto:administratie@iwex.nl">administratie@iwex.nl</a><br>\r\nTel: +31 36 549 0083<br>\r\nKeomo<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cellline">\n<tr><th></th><th></th>\n						<th></th>\n		 				<th></th><th></th></tr><tr><td ROWSPAN=2>1000001</td><td ROWSPAN=2>813372100B01</td><td> 9232112</td><td>NL91PSTB0009232112</td><td>PSTBNL21</td></tr>\n<tr><td> 654197865</td><td>123</td><td>456</td></tr>\n</table>'),
(18, 3, '2006-05-24 10:34:00', NULL, 1, 'Openstaande Facturen', 'Email verzonden aan: <hr>Beste administratie van Klant 2,\r\n\r\n<p>Volgens onze administratie heeft uw bedrijf de volgende factuur(en) nog niet voldaan.</p>\r\n\r\n<p><table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">\n			  <tr>\n				<th colspan=2></th>\n				<th></th>\n				<th></th>\n				<th></th>\n				<th></th>\n			  </tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>1</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-04-2006</td><td align=right>57,50</td><td align=right>0,00</td>\n</tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>2</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-03-2006</td><td align=right>123,50</td><td align=right>0,00</td>\n</tr><tr><td align=center style="background-color:#FDE967;">OK</td><td align=center style="background-color:#FF5050;">Te laat</td><td align=right colspan=2><b>Totaal</b></td><td align=right>181,00</td><td align=right>0,00</td><tr>\n</table>\n\n</p>\r\n\r\n<p>Wij verzoeken u vriendelijk de openstaande factuur z.s.m. te voldoen.<br>\r\nWanneer deze factuur reeds voldaan is, kunt u deze email als niet verzonden beschouwen.</p>\r\n\r\n<p>Met vriendelijke groeten,</p>\r\n\r\n<p>Rita de Program</p>\r\nAdministratie: <a href="mailto:administratie@iwex.nl">administratie@iwex.nl</a><br>\r\nTel: +31 36 549 0083<br>\r\nKeomo<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cellline">\n<tr><th></th><th></th>\n						<th></th>\n		 				<th></th><th></th></tr><tr><td ROWSPAN=2>1000001</td><td ROWSPAN=2>813372100B01</td><td> 9232112</td><td>NL91PSTB0009232112</td><td>PSTBNL21</td></tr>\n<tr><td> 654197865</td><td>123</td><td>456</td></tr>\n</table>'),
(19, 3, '2006-05-24 10:37:00', NULL, 1, 'Openstaande Facturen', 'Email verzonden aan: <hr>Beste administratie van Klant 2,\r\n\r\n<p>Volgens onze administratie heeft uw bedrijf de volgende factuur(en) nog niet voldaan.</p>\r\n\r\n<p><table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">\n			  <tr>\n				<th colspan=2></th>\n				<th></th>\n				<th></th>\n				<th></th>\n				<th></th>\n			  </tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>1</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-04-2006</td><td align=right>57,50</td><td align=right>0,00</td>\n</tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>2</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-03-2006</td><td align=right>123,50</td><td align=right>0,00</td>\n</tr><tr><td align=center style="background-color:#FDE967;">OK</td><td align=center style="background-color:#FF5050;">Te laat</td><td align=right colspan=2><b>Totaal</b></td><td align=right>181,00</td><td align=right>0,00</td><tr>\n</table>\n\n</p>\r\n\r\n<p>Wij verzoeken u vriendelijk de openstaande factuur z.s.m. te voldoen.<br>\r\nWanneer deze factuur reeds voldaan is, kunt u deze email als niet verzonden beschouwen.</p>\r\n\r\n<p>Met vriendelijke groeten,</p>\r\n\r\n<p>Rita de Program</p>\r\nAdministratie: <a href="mailto:administratie@iwex.nl">administratie@iwex.nl</a><br>\r\nTel: +31 36 549 0083<br>\r\nKeomo<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cellline">\n<tr><th></th><th></th>\n						<th></th>\n		 				<th></th><th></th></tr><tr><td ROWSPAN=2>1000001</td><td ROWSPAN=2>813372100B01</td><td> 9232112</td><td>NL91PSTB0009232112</td><td>PSTBNL21</td></tr>\n<tr><td> 654197865</td><td>123</td><td>456</td></tr>\n</table>'),
(20, 3, '2006-05-24 10:37:00', NULL, 1, 'Openstaande Facturen', 'Email verzonden aan: <hr>Beste administratie van Klant 2,\r\n\r\n<p>Volgens onze administratie heeft uw bedrijf de volgende factuur(en) nog niet voldaan.</p>\r\n\r\n<p><table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">\n			  <tr>\n				<th colspan=2></th>\n				<th></th>\n				<th></th>\n				<th></th>\n				<th></th>\n			  </tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>1</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-04-2006</td><td align=right>57,50</td><td align=right>0,00</td>\n</tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>2</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-03-2006</td><td align=right>123,50</td><td align=right>0,00</td>\n</tr><tr><td align=center style="background-color:#FDE967;">OK</td><td align=center style="background-color:#FF5050;">Te laat</td><td align=right colspan=2><b>Totaal</b></td><td align=right>181,00</td><td align=right>0,00</td><tr>\n</table>\n\n</p>\r\n\r\n<p>Wij verzoeken u vriendelijk de openstaande factuur z.s.m. te voldoen.<br>\r\nWanneer deze factuur reeds voldaan is, kunt u deze email als niet verzonden beschouwen.</p>\r\n\r\n<p>Met vriendelijke groeten,</p>\r\n\r\n<p>Rita de Program</p>\r\nAdministratie: <a href="mailto:administratie@iwex.nl">administratie@iwex.nl</a><br>\r\nTel: +31 36 549 0083<br>\r\nKeomo<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cellline">\n<tr><th></th><th></th>\n						<th></th>\n		 				<th></th><th></th></tr><tr><td ROWSPAN=2>1000001</td><td ROWSPAN=2>813372100B01</td><td> 9232112</td><td>NL91PSTB0009232112</td><td>PSTBNL21</td></tr>\n<tr><td> 654197865</td><td>123</td><td>456</td></tr>\n</table>'),
(21, 3, '2006-05-24 10:40:00', NULL, 1, 'Openstaande Facturen', 'Email verzonden aan: <hr>Beste administratie van Klant 2,\r\n\r\n<p>Volgens onze administratie heeft uw bedrijf de volgende factuur(en) nog niet voldaan.</p>\r\n\r\n<p><table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">\n			  <tr>\n				<th colspan=2>Factuur</th>\n				<th>Verstuurd aan</th>\n				<th>Datum</th>\n				<th>Bedrag</th>\n				<th>Betaald</th>\n			  </tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>1</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-04-2006</td><td align=right>57,50</td><td align=right>0,00</td>\n</tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>2</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-03-2006</td><td align=right>123,50</td><td align=right>0,00</td>\n</tr><tr><td align=center style="background-color:#FDE967;">OK</td><td align=center style="background-color:#FF5050;">Te laat</td><td align=right colspan=2><b>Totaal</b></td><td align=right>181,00</td><td align=right>0,00</td><tr>\n</table>\n\n</p>\r\n\r\n<p>Wij verzoeken u vriendelijk de openstaande factuur z.s.m. te voldoen.<br>\r\nWanneer deze factuur reeds voldaan is, kunt u deze email als niet verzonden beschouwen.</p>\r\n\r\n<p>Met vriendelijke groeten,</p>\r\n\r\n<p>Rita de Program</p>\r\nAdministratie: <a href="mailto:administratie@iwex.nl">administratie@iwex.nl</a><br>\r\nTel: +31 36 549 0083<br>\r\nKeomo<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cellline">\n<tr><th></th><th></th>\n						<th></th>\n		 				<th></th><th></th></tr><tr><td ROWSPAN=2>1000001</td><td ROWSPAN=2>813372100B01</td><td> 9232112</td><td>NL91PSTB0009232112</td><td>PSTBNL21</td></tr>\n<tr><td> 654197865</td><td>123</td><td>456</td></tr>\n</table>'),
(22, 3, '2006-05-24 10:42:00', NULL, 1, 'Openstaande Facturen', 'Email verzonden aan: <hr>Beste administratie van Klant 2,\r\n\r\n<p>Volgens onze administratie heeft uw bedrijf de volgende factuur(en) nog niet voldaan.</p>\r\n\r\n<p><table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">\n			  <tr>\n				<th colspan=2>Factuur</th>\n				<th>Verstuurd aan</th>\n				<th>Datum</th>\n				<th>Bedrag</th>\n				<th>Betaald</th>\n			  </tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>1</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-04-2006</td><td align=right>57,50</td><td align=right>0,00</td>\n</tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>2</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-03-2006</td><td align=right>123,50</td><td align=right>0,00</td>\n</tr><tr><td align=center style="background-color:#FDE967;">OK</td><td align=center style="background-color:#FF5050;">Te laat</td><td align=right colspan=2><b>Totaal</b></td><td align=right>181,00</td><td align=right>0,00</td><tr>\n</table>\n\n</p>\r\n\r\n<p>Wij verzoeken u vriendelijk de openstaande factuur z.s.m. te voldoen.<br>\r\nWanneer deze factuur reeds voldaan is, kunt u deze email als niet verzonden beschouwen.</p>\r\n\r\n<p>Met vriendelijke groeten,</p>\r\n\r\n<p>Rita de Program</p>\r\nAdministratie: <a href="mailto:administratie@iwex.nl">administratie@iwex.nl</a><br>\r\nTel: +31 36 549 0083<br>\r\nKeomo<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cellline">\n<tr><th></th><th></th>\n						<th></th>\n		 				<th></th><th></th></tr><tr><td ROWSPAN=2>1000001</td><td ROWSPAN=2>813372100B01</td><td> 9232112</td><td>NL91PSTB0009232112</td><td>PSTBNL21</td></tr>\n<tr><td> 654197865</td><td>123</td><td>456</td></tr>\n</table>'),
(23, 3, '2006-05-24 10:49:00', NULL, 1, 'Openstaande Facturen', 'Email verzonden aan: <hr>Beste administratie van Klant 2,\r\n\r\n<p>Volgens onze administratie heeft uw bedrijf de volgende factuur(en) nog niet voldaan.</p>\r\n\r\n<p><table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">\n			  <tr>\n				<th colspan=2>Factuur</th>\n				<th>Verstuurd aan</th>\n				<th>Datum</th>\n				<th>Bedrag</th>\n				<th>Betaald</th>\n			  </tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>1</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-04-2006</td><td align=right>57,50</td><td align=right>0,00</td>\n</tr><tr>\n<td colspan=2 bgcolor=''#FF5050'' style=''background-color:#FF5050;'' align=center><b>2</b></td><td>Klant  2\r T.a.v. dhr klantjes</td><td align=center>19-03-2006</td><td align=right>123,50</td><td align=right>0,00</td>\n</tr><tr><td align=center style="background-color:#FDE967;">OK</td><td align=center style="background-color:#FF5050;">Te laat</td><td align=right colspan=2><b>Totaal</b></td><td align=right>181,00</td><td align=right>0,00</td><tr>\n</table>\n\n</p>\r\n\r\n<p>Wij verzoeken u vriendelijk de openstaande factuur z.s.m. te voldoen.<br>\r\nWanneer deze factuur reeds voldaan is, kunt u deze email als niet verzonden beschouwen.</p>\r\n\r\n<p>Met vriendelijke groeten,</p>\r\n\r\n<p>Rita de Program</p>\r\nAdministratie: <a href="mailto:administratie@iwex.nl">administratie@iwex.nl</a><br>\r\nTel: +31 36 549 0083<br>\r\nKeomo<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cellline">\n<tr><th></th><th></th>\n						<th></th>\n		 				<th></th><th></th></tr><tr><td ROWSPAN=2>1000001</td><td ROWSPAN=2>813372100B01</td><td> 9232112</td><td>NL91PSTB0009232112</td><td>PSTBNL21</td></tr>\n<tr><td> 654197865</td><td>123</td><td>456</td></tr>\n</table>');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `categories`
-- 

CREATE TABLE `categories` (
  `CategoryID` int(10) unsigned NOT NULL auto_increment,
  `ParentID` int(10) NOT NULL default '0',
  `CategoryName` varchar(100) default NULL,
  `public` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`CategoryID`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `categories`
-- 

INSERT INTO `categories` (`CategoryID`, `ParentID`, `CategoryName`, `public`) VALUES (1, 0, 'Category 1', 0);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `commited`
-- 

CREATE TABLE `commited` (
  `OrderDetailsID` int(10) unsigned NOT NULL auto_increment,
  `OrderID` int(10) unsigned NOT NULL default '0',
  `ProductID` int(10) unsigned NOT NULL default '0',
  `ProductName` varchar(255) default NULL,
  `ProductDescription` text,
  `UnitPrice` decimal(10,2) NOT NULL default '0.00',
  `UnitBTW` decimal(10,2) NOT NULL default '0.00',
  `Quantity` smallint(6) default NULL,
  `Extended_price` decimal(10,2) NOT NULL default '0.00',
  `Discount` decimal(10,2) default '0.00',
  `SerialNB` varchar(255) default NULL,
  `ShipID` int(8) unsigned default NULL,
  `Orderdate` date default NULL,
  `btw_percentage` decimal(10,2) NOT NULL default '0.00',
  `cost_percentage` float NOT NULL default '0',
  `delivered` smallint(5) unsigned default NULL,
  PRIMARY KEY  (`OrderDetailsID`,`OrderID`,`ProductID`),
  KEY `OrderID` (`OrderID`,`ProductID`),
  KEY `OrderID_2` (`OrderID`,`ProductID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `commited`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `contact_types`
-- 

CREATE TABLE `contact_types` (
  `ContactTypeID` int(10) unsigned NOT NULL auto_increment,
  `ContactType` longtext,
  PRIMARY KEY  (`ContactTypeID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `contact_types`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `contacts`
-- 

CREATE TABLE `contacts` (
  `ContactID` int(8) unsigned NOT NULL auto_increment,
  `CompanyName` varchar(50) default NULL,
  `ContactFirstName` varchar(35) default NULL,
  `ContactTussenvoegs` varchar(25) default NULL,
  `ContactName` varchar(50) default NULL,
  `ContactTitle` varchar(15) default NULL,
  `Address` varchar(50) default NULL,
  `City` varchar(50) default NULL,
  `Region` varchar(50) default NULL,
  `PostalCode` varchar(10) default NULL,
  `Country` char(2) default NULL,
  `languageID` tinyint(3) unsigned NOT NULL default '0',
  `Phone` varchar(20) default NULL,
  `Fax` varchar(20) default NULL,
  `MobilePhone` varchar(20) default NULL,
  `email` varchar(100) default NULL,
  `website` varchar(35) default NULL,
  `kvk_number` varchar(35) default NULL,
  `use_btw` tinyint(1) unsigned NOT NULL default '1',
  `btw_number` varchar(35) default NULL,
  `Bankinfo` varchar(25) default NULL,
  `Paymentterm` tinyint(2) default '4',
  `Paymentterm_margin` tinyint(2) default '3',
  `UPSaccount` varchar(10) default NULL,
  `conditions_OK_yn` tinytext,
  `mailing` tinytext,
  `Dealer_yn` tinytext,
  `Auto_yn` tinytext,
  `Watersport_yn` tinytext,
  `Foto_yn` tinytext,
  `Supplier_yn` tinytext,
  `ContactTypeID` mediumint(8) unsigned default NULL,
  `Aanhef` varchar(15) default NULL,
  `PhoneExtention` varchar(10) default NULL,
  `Notes` longtext,
  `pricelevel` tinyint(2) unsigned default '1',
  `uid` varchar(25) default NULL,
  `pwd` varchar(25) default NULL,
  `groupid` int(11) default NULL,
  `ordercosts` tinyint(4) default '1',
  `transportcost` tinyint(4) default '1',
  `ordercost_type_id` tinyint(2) unsigned NOT NULL default '1',
  `CreditLimit` int(10) unsigned default '0',
  `warehouse_customer` tinyint(1) unsigned NOT NULL default '0',
  `consignment` tinyint(1) unsigned NOT NULL default '0',
  `invoice_copies` tinyint(1) NOT NULL default '1',
  `invoice_copies_iwex` tinyint(1) NOT NULL default '1',
  `invoice_option` tinyint(1) default '0',
  `overdue_type` int(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ContactID`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `contacts`
-- 

INSERT INTO `contacts` (`ContactID`, `CompanyName`, `ContactFirstName`, `ContactTussenvoegs`, `ContactName`, `ContactTitle`, `Address`, `City`, `Region`, `PostalCode`, `Country`, `languageID`, `Phone`, `Fax`, `MobilePhone`, `email`, `website`, `kvk_number`, `btw_number`, `Bankinfo`, `Paymentterm`, `Paymentterm_margin`, `UPSaccount`, `conditions_OK_yn`, `mailing`, `Dealer_yn`, `Auto_yn`, `Watersport_yn`, `Foto_yn`, `Supplier_yn`, `ContactTypeID`, `Aanhef`, `PhoneExtention`, `Notes`, `pricelevel`, `uid`, `pwd`, `groupid`, `ordercosts`, `transportcost`, `ordercost_type_id`, `CreditLimit`, `warehouse_customer`, `consignment`, `invoice_copies`, `invoice_copies_iwex`, `invoice_option`, `overdue_type`) VALUES (1, 'Leverancier 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '', '', NULL, '', '', '', '', '', 4, 3, '', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, '', 1, NULL, NULL, NULL, 1, 1, 1, 0, 0, 0, 1, 1, 0, 0),
(2, 'Klant 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NL', 1, '0123456789', '0123456789', NULL, '', '', '', '', '', 0, 3, '', NULL, '0', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, 'Dit is klant 1', 0, NULL, NULL, NULL, 0, 0, 0, 350, 0, 0, 1, 1, 1, 0),
(3, 'Klant 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NL', 1, '1234567890', '1234567890', NULL, '', '', '000000000', '000', '111111111', 2, 3, '', NULL, '0', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, 'Dit is klant 2', 1, NULL, NULL, NULL, 0, 0, 1, 250, 0, 0, 1, 1, 2, 0);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `contacts_bank_accounts`
-- 

CREATE TABLE `contacts_bank_accounts` (
  `account_number` char(25) NOT NULL default '0',
  `ContactID` int(3) default '0',
  PRIMARY KEY  (`account_number`),
  KEY `account_number_2` (`ContactID`)
) TYPE=MyISAM COMMENT='Customer bank account numbers';

-- 
-- Gegevens worden uitgevoerd voor tabel `contacts_bank_accounts`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `country`
-- 

CREATE TABLE `country` (
  `code` char(2) NOT NULL default '0',
  `country` varchar(50) NOT NULL default '0',
  `eu_country` tinyint(1) unsigned default '0',
  `iso_code` char(3) default NULL,
  `zipcode_format` varchar(10) default NULL,
  UNIQUE KEY `code` (`code`,`country`)
) TYPE=MyISAM COMMENT='country codes';

-- 
-- Gegevens worden uitgevoerd voor tabel `country`
-- 

INSERT INTO `country` (`code`, `country`, `eu_country`, `iso_code`, `zipcode_format`) VALUES ('AD', 'Andorra, Principality of', 0, NULL, NULL),
('AE', 'United Arab Emirates', 0, NULL, NULL),
('AF', 'Afghanistan, Islamic State of', 0, NULL, NULL),
('AG', 'Antigua and Barbuda', 0, NULL, NULL),
('AI', 'Anguilla', 0, NULL, NULL),
('AL', 'Albania', 0, NULL, NULL),
('AM', 'Armenia', 0, NULL, NULL),
('AN', 'Netherlands Antilles', 0, NULL, NULL),
('AO', 'Angola', 0, NULL, NULL),
('AQ', 'Antarctica', 0, NULL, NULL),
('AR', 'Argentina', 0, NULL, NULL),
('AS', 'American Samoa', 0, NULL, NULL),
('AT', 'Austria', 1, '038', 'NNNN'),
('AU', 'Australia', 0, NULL, NULL),
('AW', 'Aruba', 0, NULL, NULL),
('AZ', 'Azerbaidjan', 0, NULL, NULL),
('BA', 'Bosnia-Herzegovina', 0, NULL, NULL),
('BB', 'Barbados', 0, NULL, NULL),
('BD', 'Bangladesh', 0, NULL, NULL),
('BE', 'Belgium', 1, '002', 'NNNN'),
('BF', 'Burkina Faso', 0, NULL, NULL),
('BG', 'Bulgaria', 0, NULL, NULL),
('BH', 'Bahrain', 0, NULL, NULL),
('BI', 'Burundi', 0, NULL, NULL),
('BJ', 'Benin', 0, NULL, NULL),
('BM', 'Bermuda', 0, NULL, NULL),
('BN', 'Brunei Darussalam', 0, NULL, NULL),
('BO', 'Bolivia', 0, NULL, NULL),
('BR', 'Brazil', 0, NULL, NULL),
('BS', 'Bahamas', 0, NULL, NULL),
('BT', 'Bhutan', 0, NULL, NULL),
('BV', 'Bouvet Island', 0, NULL, NULL),
('BW', 'Botswana', 0, NULL, NULL),
('BY', 'Belarus', 0, NULL, NULL),
('BZ', 'Belize', 0, NULL, NULL),
('CA', 'Canada', 0, NULL, NULL),
('CC', 'Cocos (Keeling) Islands', 0, NULL, NULL),
('CD', 'Congo, The Democratic Republic of the', 0, NULL, NULL),
('CF', 'Central African Republic', 0, NULL, NULL),
('CG', 'Congo', 0, NULL, NULL),
('CH', 'Switzerland', 0, NULL, NULL),
('CI', 'Ivory Coast (Cote D''Ivoire)', 0, NULL, NULL),
('CK', 'Cook Islands', 0, NULL, NULL),
('CL', 'Chile', 0, NULL, NULL),
('CM', 'Cameroon', 0, NULL, NULL),
('CN', 'China', 0, NULL, NULL),
('CO', 'Colombia', 0, NULL, NULL),
('CR', 'Costa Rica', 0, NULL, NULL),
('CS', 'Former Czechoslovakia', 1, '063', 'NNNNN'),
('CU', 'Cuba', 0, NULL, NULL),
('CV', 'Cape Verde', 0, NULL, NULL),
('CX', 'Christmas Island', 0, NULL, NULL),
('CY', 'Cyprus', 1, NULL, NULL),
('CZ', 'Czech Republic', 0, NULL, NULL),
('DE', 'Germany', 1, '004', 'NNNNN'),
('DJ', 'Djibouti', 0, NULL, NULL),
('DK', 'Denmark', 1, '008', 'NNNN'),
('DM', 'Dominica', 0, NULL, NULL),
('DO', 'Dominican Republic', 0, NULL, NULL),
('DZ', 'Algeria', 0, NULL, NULL),
('EC', 'Ecuador', 0, NULL, NULL),
('EE', 'Estonia', 1, NULL, NULL),
('EG', 'Egypt', 0, NULL, NULL),
('EH', 'Western Sahara', 0, NULL, NULL),
('ER', 'Eritrea', 0, NULL, NULL),
('ES', 'Spain', 1, '011', 'NNNNN'),
('ET', 'Ethiopia', 0, NULL, NULL),
('FI', 'Finland', 1, '032', 'NNNNN'),
('FJ', 'Fiji', 0, NULL, NULL),
('FK', 'Falkland Islands', 0, NULL, NULL),
('FM', 'Micronesia', 0, NULL, NULL),
('FO', 'Faroe Islands', 0, NULL, NULL),
('FR', 'France', 1, '250', 'NNNNN'),
('FX', 'France (European Territory)', 0, NULL, NULL),
('GA', 'Gabon', 0, NULL, NULL),
('GB', 'Great Britain', 1, '826', NULL),
('GD', 'Grenada', 0, NULL, NULL),
('GE', 'Georgia', 0, NULL, NULL),
('GF', 'French Guyana', 0, NULL, NULL),
('GH', 'Ghana', 0, NULL, NULL),
('GI', 'Gibraltar', 0, NULL, NULL),
('GL', 'Greenland', 0, NULL, NULL),
('GM', 'Gambia', 0, NULL, NULL),
('GN', 'Guinea', 0, NULL, NULL),
('GP', 'Guadeloupe (French)', 0, NULL, NULL),
('GQ', 'Equatorial Guinea', 0, NULL, NULL),
('GR', 'Greece', 1, '009', 'NNNNN'),
('GS', 'S. Georgia & S. Sandwich Isls.', 0, NULL, NULL),
('GT', 'Guatemala', 0, NULL, NULL),
('GU', 'Guam (USA)', 0, NULL, NULL),
('GW', 'Guinea Bissau', 0, NULL, NULL),
('GY', 'Guyana', 0, NULL, NULL),
('HK', 'Hong Kong', 0, NULL, NULL),
('HM', 'Heard and McDonald Islands', 0, NULL, NULL),
('HN', 'Honduras', 0, NULL, NULL),
('HR', 'Croatia', 0, NULL, NULL),
('HT', 'Haiti', 0, NULL, NULL),
('HU', 'Hungary', 1, '064', 'NNNN'),
('ID', 'Indonesia', 0, NULL, NULL),
('IE', 'Ireland', 1, '007', 'CCCCCCC'),
('IL', 'Israel', 0, NULL, NULL),
('IN', 'India', 0, NULL, NULL),
('IO', 'British Indian Ocean Territory', 0, NULL, NULL),
('IQ', 'Iraq', 0, NULL, NULL),
('IR', 'Iran', 0, NULL, NULL),
('IS', 'Iceland', 0, NULL, NULL),
('IT', 'Italy', 1, '005', 'NNNNN'),
('JM', 'Jamaica', 0, NULL, NULL),
('JO', 'Jordan', 0, NULL, NULL),
('JP', 'Japan', 0, NULL, NULL),
('KE', 'Kenya', 0, NULL, NULL),
('KG', 'Kyrgyz Republic (Kyrgyzstan)', 0, NULL, NULL),
('KH', 'Cambodia, Kingdom of', 0, NULL, NULL),
('KI', 'Kiribati', 0, NULL, NULL),
('KM', 'Comoros', 0, NULL, NULL),
('KN', 'Saint Kitts & Nevis Anguilla', 0, NULL, NULL),
('KP', 'North Korea', 0, NULL, NULL),
('KR', 'South Korea', 0, NULL, NULL),
('KW', 'Kuwait', 0, NULL, NULL),
('KY', 'Cayman Islands', 0, NULL, NULL),
('KZ', 'Kazakhstan', 0, NULL, NULL),
('LA', 'Laos', 0, NULL, NULL),
('LB', 'Lebanon', 0, NULL, NULL),
('LC', 'Saint Lucia', 0, NULL, NULL),
('LI', 'Liechtenstein', 0, NULL, NULL),
('LK', 'Sri Lanka', 0, NULL, NULL),
('LR', 'Liberia', 0, NULL, NULL),
('LS', 'Lesotho', 0, NULL, NULL),
('LT', 'Lithuania', 1, NULL, NULL),
('LU', 'Luxembourg', 1, '019', 'NNNN'),
('LV', 'Latvia', 1, NULL, NULL),
('LY', 'Libya', 0, NULL, NULL),
('MA', 'Morocco', 0, NULL, NULL),
('MC', 'Monaco', 0, NULL, NULL),
('MD', 'Moldavia', 0, NULL, NULL),
('MG', 'Madagascar', 0, NULL, NULL),
('MH', 'Marshall Islands', 0, NULL, NULL),
('MK', 'Macedonia', 0, NULL, NULL),
('ML', 'Mali', 0, NULL, NULL),
('MM', 'Myanmar', 0, NULL, NULL),
('MN', 'Mongolia', 0, NULL, NULL),
('MO', 'Macau', 0, NULL, NULL),
('MP', 'Northern Mariana Islands', 0, NULL, NULL),
('MQ', 'Martinique (French)', 0, NULL, NULL),
('MR', 'Mauritania', 0, NULL, NULL),
('MS', 'Montserrat', 0, NULL, NULL),
('MT', 'Malta', 1, NULL, NULL),
('MU', 'Mauritius', 0, NULL, NULL),
('MV', 'Maldives', 0, NULL, NULL),
('MW', 'Malawi', 0, NULL, NULL),
('MX', 'Mexico', 0, NULL, NULL),
('MY', 'Malaysia', 0, NULL, NULL),
('MZ', 'Mozambique', 0, NULL, NULL),
('NA', 'Namibia', 0, NULL, NULL),
('NC', 'New Caledonia (French)', 0, NULL, NULL),
('NE', 'Niger', 0, NULL, NULL),
('NF', 'Norfolk Island', 0, NULL, NULL),
('NG', 'Nigeria', 0, NULL, NULL),
('NI', 'Nicaragua', 0, NULL, NULL),
('NL', 'Netherlands', 1, '003', 'NNNNCC'),
('NO', 'Norway', 0, NULL, NULL),
('NP', 'Nepal', 0, NULL, NULL),
('NR', 'Nauru', 0, NULL, NULL),
('NT', 'Neutral Zone', 0, NULL, NULL),
('NU', 'Niue', 0, NULL, NULL),
('NZ', 'New Zealand', 0, NULL, NULL),
('OM', 'Oman', 0, NULL, NULL),
('PA', 'Panama', 0, NULL, NULL),
('PE', 'Peru', 0, NULL, NULL),
('PF', 'Polynesia (French)', 0, NULL, NULL),
('PG', 'Papua New Guinea', 0, NULL, NULL),
('PH', 'Philippines', 0, NULL, NULL),
('PK', 'Pakistan', 0, NULL, NULL),
('PL', 'Poland', 1, '060', 'NNNNN'),
('PM', 'Saint Pierre and Miquelon', 0, NULL, NULL),
('PN', 'Pitcairn Island', 0, NULL, NULL),
('PR', 'Puerto Rico', 0, NULL, NULL),
('PT', 'Portugal', 1, '010', 'NNNN'),
('PW', 'Palau', 0, NULL, NULL),
('PY', 'Paraguay', 0, NULL, NULL),
('QA', 'Qatar', 0, NULL, NULL),
('RE', 'Reunion (French)', 0, NULL, NULL),
('RO', 'Romania', 0, NULL, NULL),
('RU', 'Russian Federation', 0, NULL, NULL),
('RW', 'Rwanda', 0, NULL, NULL),
('SA', 'Saudi Arabia', 0, NULL, NULL),
('SB', 'Solomon Islands', 0, NULL, NULL),
('SC', 'Seychelles', 0, NULL, NULL),
('SD', 'Sudan', 0, NULL, NULL),
('SE', 'Sweden', 1, '030', 'NNNNN'),
('SG', 'Singapore', 0, NULL, NULL),
('SH', 'Saint Helena', 0, NULL, NULL),
('SI', 'Slovenia', 1, NULL, NULL),
('SJ', 'Svalbard and Jan Mayen Islands', 0, NULL, NULL),
('SK', 'Slovak Republic', 1, NULL, NULL),
('SL', 'Sierra Leone', 0, NULL, NULL),
('SM', 'San Marino', 0, NULL, NULL),
('SN', 'Senegal', 0, NULL, NULL),
('SO', 'Somalia', 0, NULL, NULL),
('SR', 'Suriname', 0, NULL, NULL),
('ST', 'Saint Tome (Sao Tome) and Principe', 0, NULL, NULL),
('SU', 'Former USSR', 0, NULL, NULL),
('SV', 'El Salvador', 0, NULL, NULL),
('SY', 'Syria', 0, NULL, NULL),
('SZ', 'Swaziland', 0, NULL, NULL),
('TC', 'Turks and Caicos Islands', 0, NULL, NULL),
('TD', 'Chad', 0, NULL, NULL),
('TF', 'French Southern Territories', 0, NULL, NULL),
('TG', 'Togo', 0, NULL, NULL),
('TH', 'Thailand', 0, NULL, NULL),
('TJ', 'Tadjikistan', 0, NULL, NULL),
('TK', 'Tokelau', 0, NULL, NULL),
('TM', 'Turkmenistan', 0, NULL, NULL),
('TN', 'Tunisia', 0, NULL, NULL),
('TO', 'Tonga', 0, NULL, NULL),
('TP', 'East Timor', 0, NULL, NULL),
('TR', 'Turkey', 0, NULL, NULL),
('TT', 'Trinidad and Tobago', 0, NULL, NULL),
('TV', 'Tuvalu', 0, NULL, NULL),
('TW', 'Taiwan', 0, NULL, NULL),
('TZ', 'Tanzania', 0, NULL, NULL),
('UA', 'Ukraine', 0, NULL, NULL),
('UG', 'Uganda', 0, NULL, NULL),
('UK', 'United Kingdom', 0, NULL, NULL),
('UM', 'USA Minor Outlying Islands', 0, NULL, NULL),
('US', 'United States', 0, NULL, NULL),
('UY', 'Uruguay', 0, NULL, NULL),
('UZ', 'Uzbekistan', 0, NULL, NULL),
('VA', 'Holy See (Vatican City State)', 0, NULL, NULL),
('VC', 'Saint Vincent & Grenadines', 0, NULL, NULL),
('VE', 'Venezuela', 0, NULL, NULL),
('VG', 'Virgin Islands (British)', 0, NULL, NULL),
('VI', 'Virgin Islands (USA)', 0, NULL, NULL),
('VN', 'Vietnam', 0, NULL, NULL),
('VU', 'Vanuatu', 0, NULL, NULL),
('WF', 'Wallis and Futuna Islands', 0, NULL, NULL),
('WS', 'Samoa', 0, NULL, NULL),
('YE', 'Yemen', 0, NULL, NULL),
('YT', 'Mayotte', 0, NULL, NULL),
('YU', 'Yugoslavia', 0, NULL, NULL),
('ZA', 'South Africa', 0, NULL, NULL),
('ZM', 'Zambia', 0, NULL, NULL),
('ZR', 'Zaire', 0, NULL, NULL),
('ZW', 'Zimbabwe', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `creditlimits`
--

CREATE TABLE IF NOT EXISTS `creditlimits` (
  `CreditLimit_ID` int(10) NOT NULL auto_increment,
  `limit_amount` decimal(10,2) NOT NULL default '0.00',
  `own_limit` tinyint(2) unsigned NOT NULL default '0',
  `currencyid` tinyint(2) unsigned NOT NULL default '2',
  `start_date` date NOT NULL default '0000-00-00',
  `end_date` date NOT NULL default '0000-00-00',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(2) unsigned NOT NULL default '0',
  `ContactID` int(10) unsigned NOT NULL default '0',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(2) unsigned NOT NULL default '0',
  `notes` varchar(30) NOT NULL,
  PRIMARY KEY  (`CreditLimit_ID`),
  KEY `ConctactID` (`ContactID`),
  KEY `startdate` (`start_date`),
  KEY `enddate` (`end_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Credit limit table' AUTO_INCREMENT=771 ;

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `current_product_list`
-- 

CREATE TABLE `current_product_list` (
  `ProductID` int(10) unsigned NOT NULL auto_increment,
  `CategoryID` tinyint(2) unsigned default NULL,
  `SubcategoryID` int(10) NOT NULL default '0',
  `ProductName` varchar(255) default NULL,
  `Productdescription` text,
  `purchase_price_foreign` decimal(10,2) NOT NULL default '0.00',
  `Purchase_price_home` decimal(10,2) NOT NULL default '0.00',
  `extra_cost` decimal(6,4) NOT NULL default '0.0000',
  `Margin_correction` decimal(6,4) NOT NULL default '1.0000',
  `Price_discovery` decimal(10,2) default '0.00',
  `Price_discovery_10` decimal(10,2) default '0.00',
  `Price_discovery_100` decimal(10,2) default '0.00',
  `Selling_price` decimal(10,2) NOT NULL default '0.00',
  `Selling_price_10` decimal(10,2) NOT NULL default '0.00',
  `Selling_price_50` decimal(10,2) default '0.00',
  `Selling_price_100` decimal(10,2) default '0.00',
  `Retail_price_ex` decimal(10,2) NOT NULL default '0.00',
  `Btw_class` tinyint(1) unsigned default '0',
  `euproductcode` int(8) unsigned default NULL,
  `old_stock` int(11) default NULL,
  `last_exp` date default NULL,
  `exp_rating` tinyint(3) unsigned default NULL,
  `Taric` int(2) unsigned default NULL,
  `EAN` bigint(13) unsigned default NULL,
  `Reorder_q` smallint(6) unsigned NOT NULL default '0',
  `ReorderLevel` smallint(8) unsigned default NULL,
  `LeadTime` tinyint(3) unsigned default NULL,
  `Supplier` int(8) unsigned NOT NULL default '0',
  `Merk` varchar(35) NOT NULL default '',
  `MerkID` tinyint(3) unsigned NOT NULL default '0',
  `Pricelist_yn` int(1) unsigned default '0',
  `RoadKing` tinyint(1) unsigned NOT NULL default '0',
  `Neptune` tinyint(1) unsigned default '0',
  `Outdoor` tinyint(1) unsigned default '0',
  `Discontinued_yn` tinyint(1) unsigned NOT NULL default '0',
  `ExternalID` varchar(15) NOT NULL default '0',
  `currency` int(3) unsigned NOT NULL default '2',
  `weight_corr` decimal(10,2) default NULL,
  `sku` tinyint(1) default '1',
  `old_location_ID` smallint(1) unsigned default NULL,
  `special` tinyint(1) unsigned default '0',
  `public` tinyint(1) unsigned default NULL,
  `store_serial_yn` tinyint(1) unsigned default NULL,
  `image` varchar(10) default NULL,
  PRIMARY KEY  (`ProductID`),
  UNIQUE KEY `EAN` (`EAN`),
  KEY `Pricelist` (`Pricelist_yn`),
  KEY `EOL` (`Discontinued_yn`),
  KEY `ProductName` (`ProductName`),
  KEY `ExternalID` (`ExternalID`),
  KEY `MerkID` (`MerkID`),
  KEY `sku` (`sku`),
  KEY `CategoryID` (`CategoryID`),
  KEY `Supplier` (`Supplier`)
) TYPE=MyISAM AUTO_INCREMENT=10004 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `current_product_list`
-- 

INSERT INTO `current_product_list` (`ProductID`, `CategoryID`, `SubcategoryID`, `ProductName`, `Productdescription`, `purchase_price_foreign`, `Purchase_price_home`, `extra_cost`, `Margin_correction`, `Price_discovery`, `Price_discovery_10`, `Price_discovery_100`, `Selling_price`, `Selling_price_10`, `Selling_price_50`, `Selling_price_100`, `Retail_price_ex`, `Btw_class`, `euproductcode`, `old_stock`, `last_exp`, `exp_rating`, `Taric`, `EAN`, `Reorder_q`, `ReorderLevel`, `LeadTime`, `Supplier`, `Merk`, `MerkID`, `Pricelist_yn`, `RoadKing`, `Neptune`, `Outdoor`, `Discontinued_yn`, `ExternalID`, `currency`, `weight_corr`, `sku`, `old_location_ID`, `special`, `public`, `store_serial_yn`, `image`) VALUES (10000, 1, 0, 'Product 1', 'Dit is het eerst product.', 0.00, 0.00, 0.0000, 1.0000, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 'Merk 1', 1, 1, 0, 0, 0, 0, '0', 2, 0.00, 1, NULL, 0, 0, 0, NULL),
(10001, 0, 0, 'Product 2', 'Dit is product 2', 0.00, 0.00, 0.0000, 1.0000, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 'Merk 1', 1, 1, 0, 0, 0, 0, '0', 2, 0.00, 1, NULL, 0, 0, 0, NULL),
(10002, NULL, 0, 'Product 3', 'Product 3', 0.00, 0.00, 0.0000, 1.0000, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'Merk 2', 2, 0, 0, 0, 0, 0, '0', 2, NULL, 1, NULL, 0, NULL, NULL, NULL),
(10003, 1, 0, 'Product 4', 'Product 4', 0.00, 0.00, 0.0000, 1.0000, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 'Merk 2', 2, 1, 0, 0, 0, 0, '0', 2, 5.00, 1, NULL, 0, 0, 0, NULL);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `employees`
-- 

CREATE TABLE `employees` (
  `EmployeeID` int(1) unsigned NOT NULL auto_increment,
  `FirstName` varchar(50) default NULL,
  `middlename` varchar(25) default NULL,
  `LastName` varchar(50) default NULL,
  `Title` varchar(50) default NULL,
  `Extension` varchar(50) default NULL,
  `WorkPhone` varchar(50) default NULL,
  `homephone` varchar(50) default NULL,
  `mobilephone` varchar(50) default NULL,
  `login` varchar(25) NOT NULL default '',
  `pwd` varchar(25) NOT NULL default '',
  `uid` varchar(25) NOT NULL default '',
  `groupid` int(11) NOT NULL default '0',
  `address` varchar(100) default NULL,
  `postcode` varchar(15) default NULL,
  `city` varchar(100) default NULL,
  `birth_date` date default NULL,
  `gender` varchar(10) default NULL,
  `passport` varchar(25) default NULL,
  `sofinumber` varchar(25) default NULL,
  `salary_month` float default NULL,
  `start` date default NULL,
  `end` date default NULL,
  `Bankrekening` int(10) unsigned NOT NULL default '0',
  `Girorekening` int(10) unsigned NOT NULL default '0',
  `Afstand_km` float default NULL,
  PRIMARY KEY  (`EmployeeID`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `employees`
-- 

INSERT INTO `employees` (`EmployeeID`, `FirstName`, `middlename`, `LastName`, `Title`, `Extension`, `WorkPhone`, `homephone`, `mobilephone`, `login`, `pwd`, `uid`, `groupid`, `address`, `postcode`, `city`, `birth_date`, `gender`, `passport`, `sofinumber`, `salary_month`, `start`, `end`, `Bankrekening`, `Girorekening`, `Afstand_km`) VALUES (1, 'Rita', 'de', 'Program', 'Program', NULL, NULL, NULL, NULL, '', '', '', 0, NULL, NULL, NULL, '2006-04-06', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `event_querys`
-- 

CREATE TABLE `event_querys` (
  `taskid` int(2) unsigned NOT NULL default '0',
  `queryid` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`queryid`,`taskid`),
  KEY `taskid` (`taskid`),
  KEY `queryid` (`queryid`)
) TYPE=MyISAM;

-- 
-- Gegevens worden uitgevoerd voor tabel `event_querys`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `events`
-- 

CREATE TABLE `events` (
  `id` int(12) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL default '',
  `description` varchar(120) NOT NULL default '',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL default '0',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL default '0',
  `publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
  `link` varchar(50) NOT NULL default '',
  `image` varchar(50) NOT NULL default '',
  `reccurtype` tinyint(1) NOT NULL default '0',
  `reccurtimes` varchar(255) NOT NULL default '',
  `reccurtimesinterval` varchar(7) NOT NULL default '',
  `reccurday` varchar(4) NOT NULL default '',
  `reccurweekdays` varchar(20) NOT NULL default '',
  `reccurweeks` varchar(10) NOT NULL default '',
  `action_performed_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `action_done_by` int(11) unsigned NOT NULL default '0',
  `approved` tinyint(1) NOT NULL default '1',
  `functionname` varchar(255) NOT NULL default '',
  `Cronjob_yn` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `actiondateperformed` (`action_performed_date`),
  KEY `up` (`publish_up`),
  KEY `down` (`publish_down`)
) TYPE=MyISAM AUTO_INCREMENT=12 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `events`
-- 

INSERT INTO `events` (`id`, `title`, `description`, `created`, `created_by`, `modified`, `modified_by`, `publish_up`, `publish_down`, `link`, `image`, `reccurtype`, `reccurtimes`, `reccurtimesinterval`, `reccurday`, `reccurweekdays`, `reccurweeks`, `action_performed_date`, `action_done_by`, `approved`, `functionname`, `Cronjob_yn`) VALUES (1, 'CBS data', 'Every month we need to send our data to the CBS', '2005-05-05 18:00:00', 2, '0000-00-00 00:00:00', 0, '2005-01-01 00:00:00', '0000-00-00 00:00:00', 'cbsdata.php', 'document.png', 3, '', '', '', '1,2,3,4,5', '', '2006-03-06 08:40:19', 2, 1, '', 0),
(2, 'Print betaalde facturen', 'Every month print all invoices that have a payment in last month', '2005-05-05 18:00:00', 2, '0000-00-00 00:00:00', 0, '2005-05-05 00:00:00', '0000-00-00 00:00:00', 'invoice_payment_pdf.php?month=1', 'document.png', 3, '', '', '', '1,2,3,4,5', '', '2006-03-02 12:34:56', 3, 1, '', 0),
(3, 'Incasso facturen', 'Every week show incasso orders', '0000-00-00 00:00:00', 2, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'invoice_payment.php?incasso=1', 'document.png', 1, '', '', '0', '', '', '2006-03-06 16:23:47', 2, 1, '', 0),
(4, 'Get Overdue Invoices', 'searche for the overdue invoices and set them in an status', '2005-12-20 11:23:37', 0, '2006-01-09 16:36:33', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 1, '', '1 min', '', '', '', '2006-04-19 16:23:38', 0, 1, 'SetOverdueTypes', 1),
(5, '0 Overdue Firstmail', 'invoice FirstMail', '2006-01-12 00:00:00', 0, '2006-01-12 12:23:56', 0, '2005-01-01 00:00:00', '0000-00-00 00:00:00', 'invoice_overdue.php?overdue_type=1&UnSetEventid=5', 'document.png', 6, '', '', '', '', '', '0000-00-00 00:00:00', 1, 1, '', 0),
(6, '1 Overdue Secondmail', 'There is a new Overdue invoice SecondMail', '2006-01-12 00:00:00', 0, '0000-00-00 00:00:00', 0, '2005-01-01 00:00:00', '0000-00-00 00:00:00', 'invoice_overdue.php?overdue_type=2&UnSetEventid=6', 'document.png', 6, '', '', '', '', '', '2006-05-23 16:28:13', 1, 1, '', 0),
(8, '0 Overdue Fax/Letter', 'There is a new Overdue invoice Fax/Letter', '2006-01-12 00:00:00', 0, '0000-00-00 00:00:00', 0, '2005-01-01 00:00:00', '0000-00-00 00:00:00', 'invoice_overdue.php?overdue_type=4&UnSetEventid=8', 'document.png', 6, '', '', '', '', '', '0000-00-00 00:00:00', 1, 1, '', 0),
(7, '0 Overdue Telephone call', 'There is a new Overdue invoice Telephonecall', '2006-01-12 00:00:00', 0, '0000-00-00 00:00:00', 0, '2005-01-01 00:00:00', '0000-00-00 00:00:00', 'invoice_overdue.php?overdue_type=3&UnSetEventid=7', 'document.png', 6, '', '', '', '', '', '0000-00-00 00:00:00', 1, 1, '', 0),
(9, '0 Overdue signature letter', 'There is a new Overdue invoice signature letter', '2006-01-12 00:00:00', 0, '0000-00-00 00:00:00', 0, '2005-01-01 00:00:00', '0000-00-00 00:00:00', 'invoice_overdue.php?overdue_type=5&UnSetEventid=9', 'document.png', 6, '', '', '', '', '', '0000-00-00 00:00:00', 1, 1, '', 0),
(10, '0 Overdue Deurwaarde', 'There is a new Overdue invoice Bailiff', '2006-01-12 00:00:00', 0, '0000-00-00 00:00:00', 0, '2005-01-01 00:00:00', '0000-00-00 00:00:00', 'invoice_overdue.php?overdue_type=6&UnSetEventid=10', 'document.png', 6, '', '', '', '', '', '0000-00-00 00:00:00', 1, 1, '', 0),
(11, 'Set Garbage Outside', 'Set Garbage Outside', '2006-05-11 09:35:42', 1, '2006-05-11 09:39:14', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'document.png', 7, '', '', '', '3', '', '2006-05-11 09:35:42', 0, 1, '', 0);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `extra_product_info`
-- 

CREATE TABLE `extra_product_info` (
  `ProductID` int(10) unsigned NOT NULL default '0',
  `Best_syst_ID` int(3) unsigned NOT NULL default '0',
  `Processor_snelheid` int(10) default NULL,
  `Processor_type` int(3) default NULL,
  `AfmetingX` float default NULL,
  `AfmetingY` float default NULL,
  `AfmetingZ` float default NULL,
  `Afm_schermX` float default NULL,
  `Afm_schermY` float default NULL,
  `ResolutieX` int(5) default NULL,
  `ResolutieY` int(5) default NULL,
  `Kleuren` int(10) default NULL,
  `Backlite_yn` tinyint(2) unsigned default NULL,
  `Infrarood_yn` tinyint(2) unsigned default NULL,
  `Bluetooth_yn` tinyint(2) unsigned default NULL,
  `WLAN_yn` tinyint(2) unsigned default NULL,
  `GSM_GPRS_yn` tinyint(2) unsigned default NULL,
  `Type_aansluiting` text,
  `Accu_type_id` int(3) default NULL,
  `Accu_duur` int(10) default NULL,
  `Accu_size` smallint(5) unsigned default NULL,
  `Geheugen_int` float unsigned default NULL,
  `Geheugen_ext` float unsigned default NULL,
  `Geheugen_slot` text,
  `Gewicht` float unsigned default '0',
  PRIMARY KEY  (`ProductID`)
) TYPE=MyISAM COMMENT='Extra product informatie voor PDAs';

-- 
-- Gegevens worden uitgevoerd voor tabel `extra_product_info`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `extra_product_text`
-- 

CREATE TABLE `extra_product_text` (
  `ID` int(3) NOT NULL auto_increment,
  `ProductID` varchar(10) NOT NULL default '',
  `text` text NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ProductID` (`ProductID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `extra_product_text`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `genuser`
-- 

CREATE TABLE `genuser` (
  `id` double NOT NULL auto_increment,
  `uid` varchar(50) NOT NULL default '',
  `pwd` varchar(64) default NULL,
  `raccess_s` int(11) NOT NULL default '0',
  `raccess_a` int(11) NOT NULL default '0',
  `raccess_v` int(11) NOT NULL default '0',
  `raccess_r` int(11) NOT NULL default '0',
  `waccess_s` int(11) NOT NULL default '0',
  `waccess_a` int(11) NOT NULL default '0',
  `waccess_v` int(11) NOT NULL default '0',
  `waccess_r` int(11) NOT NULL default '0',
  `saccess_s` int(11) NOT NULL default '0',
  `saccess_a` int(11) NOT NULL default '0',
  `saccess_v` int(11) NOT NULL default '0',
  `saccess_r` int(11) NOT NULL default '0',
  `supervisor` int(11) NOT NULL default '0',
  `email` varchar(100) NOT NULL default '',
  `logon_attempts` tinyint(4) NOT NULL default '0',
  `active` int(11) NOT NULL default '0',
  `stylesheetid` int(11) NOT NULL default '1',
  `deflanguage` int(11) NOT NULL default '1',
  `contactid` int(8) NOT NULL default '0',
  `employee_id` tinyint(3) unsigned default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`uid`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `genuser`
-- 

INSERT INTO `genuser` (`id`, `uid`, `pwd`, `raccess_s`, `raccess_a`, `raccess_v`, `raccess_r`, `waccess_s`, `waccess_a`, `waccess_v`, `waccess_r`, `saccess_s`, `saccess_a`, `saccess_v`, `saccess_r`, `supervisor`, `email`, `logon_attempts`, `active`, `stylesheetid`, `deflanguage`, `contactid`, `employee_id`) VALUES (1, 'admin', '2198ZHchCPvo2', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '', 0, 0, 1, 1, 0, 1);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `help_text`
-- 

CREATE TABLE `help_text` (
  `id` smallint(3) unsigned NOT NULL auto_increment,
  `file` varchar(30) NOT NULL default '0',
  `title` varchar(100) NOT NULL default '0',
  `text_Dutch` text NOT NULL,
  `last_changed_by` tinyint(3) unsigned NOT NULL default '0',
  `change_date` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `file` (`file`),
  KEY `file_2` (`file`)
) TYPE=MyISAM COMMENT='Help text ' AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `help_text`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `inventory_transactions`
-- 

CREATE TABLE `inventory_transactions` (
  `TransactionID` int(10) unsigned NOT NULL auto_increment,
  `TransactionDate` datetime default NULL,
  `ProductID` int(11) default NULL,
  `Description` varchar(255) default NULL,
  `ExternalID` varchar(25) default NULL,
  `PurchaseOrderID` int(11) default NULL,
  `podetailsID` int(10) unsigned default NULL,
  `OrderID` int(10) unsigned default NULL,
  `orderdetailsID` int(10) unsigned default '0',
  `shipmentID` int(10) unsigned NOT NULL default '0',
  `TransactionDescription` longtext,
  `UnitPrice` decimal(10,2) default NULL,
  `UnitsOrdered` int(11) default '0',
  `Backorder` smallint(5) unsigned default NULL,
  `UnitsReceived` int(11) NOT NULL default '0',
  `UnitsSold` int(11) default '0',
  `UnitsShrinkage` int(11) default '0',
  `btw_percentage` decimal(4,2) NOT NULL default '0.00',
  `added_cost` float NOT NULL default '0',
  `box_ID` int(10) unsigned default NULL,
  `employee` tinyint(3) unsigned default NULL,
  `stock_owner_id` smallint(5) unsigned NOT NULL default '802',
  PRIMARY KEY  (`TransactionID`),
  KEY `ProductID` (`ProductID`),
  KEY `Boxid` (`box_ID`),
  KEY `shipmentid` (`shipmentID`),
  KEY `OrderID` (`OrderID`),
  KEY `OrderDetailsID` (`orderdetailsID`),
  KEY `podetailsid` (`podetailsID`),
  KEY `OwnerID` (`stock_owner_id`)
) TYPE=InnoDB AUTO_INCREMENT=3 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `inventory_transactions`
-- 

INSERT INTO `inventory_transactions` (`TransactionID`, `TransactionDate`, `ProductID`, `Description`, `ExternalID`, `PurchaseOrderID`, `podetailsID`, `OrderID`, `orderdetailsID`, `shipmentID`, `TransactionDescription`, `UnitPrice`, `UnitsOrdered`, `Backorder`, `UnitsReceived`, `UnitsSold`, `UnitsShrinkage`, `btw_percentage`, `added_cost`, `box_ID`, `employee`, `stock_owner_id`) VALUES (1, '2006-04-19 15:42:03', 10003, '', '0', NULL, NULL, 2, 4, 2, 'shipment', 44.00, 0, NULL, 0, 1, 0, 0.00, 13.5, 2, 1, 802),
(2, '2006-04-19 16:15:03', 10001, '', '0', NULL, NULL, 3, 5, 3, 'shipment', 110.00, 0, NULL, 0, 1, 0, 0.00, 13.5, 3, 1, 802);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `invoices`
-- 

CREATE TABLE `invoices` (
  `ShipName` varchar(100) default NULL,
  `ShipAddress` varchar(50) default NULL,
  `ShipCity` varchar(50) default NULL,
  `ShipRegion` varchar(40) default NULL,
  `ShipPostalCode` varchar(15) default NULL,
  `ShipCountry` varchar(50) default NULL,
  `CustomerID` int(8) default NULL,
  `companyName` varchar(100) default NULL,
  `Address` varchar(50) default NULL,
  `City` varchar(50) default NULL,
  `Region` varchar(40) default NULL,
  `PostalCode` varchar(15) default NULL,
  `Country` varchar(50) default NULL,
  `EmployeeID` smallint(10) NOT NULL default '0',
  `InvoiceID` int(10) unsigned NOT NULL auto_increment,
  `orderID` int(10) unsigned default NULL,
  `shipmentID` int(8) unsigned default NULL,
  `OrderDate` datetime default NULL,
  `RequiredDate` datetime default NULL,
  `ShippedDate` datetime default NULL,
  `CompanyNameShip` varchar(50) default NULL,
  `Invoice_total` decimal(10,2) default '0.00',
  `Invoice_BTW` decimal(10,2) default '0.00',
  `Btw` tinyint(4) default NULL,
  `paid_yn` tinyint(1) unsigned default '0',
  `paid_amount` decimal(10,2) default '0.00',
  `paid_date` date default NULL,
  `payment_type` tinyint(3) unsigned default '0',
  `Invoice_date` date default NULL,
  `paymentterm` tinyint(3) unsigned default NULL,
  `vat_number` varchar(15) NOT NULL default '',
  `DispuutID` int(2) unsigned NOT NULL default '0',
  `overduetypeID` int(2) unsigned NOT NULL default '0',
  PRIMARY KEY  (`InvoiceID`),
  UNIQUE KEY `shipment` (`shipmentID`),
  KEY `Orders` (`orderID`),
  KEY `Unpaid` (`paid_yn`),
  KEY `customerID` (`CustomerID`),
  KEY `dispuut` (`DispuutID`),
  KEY `overduetype` (`overduetypeID`),
  KEY `invoicedate` (`Invoice_date`)
) TYPE=InnoDB AUTO_INCREMENT=3 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `invoices`
-- 

INSERT INTO `invoices` (`ShipName`, `ShipAddress`, `ShipCity`, `ShipRegion`, `ShipPostalCode`, `ShipCountry`, `CustomerID`, `companyName`, `Address`, `City`, `Region`, `PostalCode`, `Country`, `EmployeeID`, `InvoiceID`, `orderID`, `shipmentID`, `OrderDate`, `RequiredDate`, `ShippedDate`, `CompanyNameShip`, `Invoice_total`, `Invoice_BTW`, `Btw`, `paid_yn`, `paid_amount`, `paid_date`, `payment_type`, `Invoice_date`, `paymentterm`, `vat_number`, `DispuutID`, `overduetypeID`) VALUES ('Klant  2\r\nT.a.v. dhr klantjes', 'unknown 10', 'unknown', NULL, '1234AA', 'Netherlands', 3, 'Klant  2\r\nT.a.v. dhr klantjes', 'unknown 10', 'unknown', '', '1234AA', 'Netherlands', 1, 1, NULL, 2, NULL, NULL, '2006-04-19 15:04:23', NULL, 57.50, 0.00, NULL, 0, 0.00, NULL, 0, '2006-04-19', 2, '000', 0, 0),
('Klant  2\r\nT.a.v. dhr klantjes', 'unknown 10', 'unknown', NULL, '1234AA', 'Netherlands', 3, 'Klant  2\r\nT.a.v. dhr klantjes', 'unknown 10', 'unknown', '', '1234AA', 'Netherlands', 1, 2, NULL, 3, NULL, NULL, '2006-03-19 16:04:13', NULL, 123.50, 0.00, NULL, 0, 0.00, NULL, 0, '2006-03-19', 2, '000', 0, 1);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `invoices_call`
-- 

CREATE TABLE `invoices_call` (
  `invoices_call_ID` int(7) unsigned NOT NULL auto_increment,
  `invoiceID` int(7) unsigned NOT NULL default '0',
  `callID` int(7) unsigned NOT NULL default '0',
  `typeID` int(2) unsigned NOT NULL default '0',
  `DispuutID` int(2) unsigned NOT NULL default '0',
  PRIMARY KEY  (`invoices_call_ID`),
  KEY `invoice` (`invoiceID`),
  KEY `callid` (`callID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `invoices_call`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `languages`
-- 

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

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `listbox`
-- 

CREATE TABLE `listbox` (
  `ID` tinyint(3) unsigned NOT NULL auto_increment,
  `value` varchar(25) default '0',
  `text` varchar(25) default NULL,
  `category` tinyint(3) unsigned default '0',
  `comments` varchar(50) default NULL,
  `color` varchar(10) default NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`),
  KEY `ID_2` (`ID`),
  KEY `value` (`value`),
  KEY `category` (`category`),
  KEY `text` (`text`)
) TYPE=MyISAM AUTO_INCREMENT=61 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `listbox`
-- 

INSERT INTO `listbox` (`ID`, `value`, `text`, `category`, `comments`, `color`) VALUES (5, '2', 'Bevestigd Klant', 2, 'Order status', '#FFFF00'),
(1, '1', 'Ja', 1, 'for listbox search forms', NULL),
(2, '0', 'Nee', 1, 'for listbox search forms', NULL),
(4, '1', 'Bevestigd Iwex', 2, 'Order status', NULL),
(6, '0', 'Onbevestigd', 2, 'Order status', '#99FF00'),
(7, '3', 'Wachten op betaling', 2, 'for listbox search forms', NULL),
(8, '5', 'zeer laag', 3, 'for listbox exp_date rating', NULL),
(9, '25', 'laag', 3, 'for listbox exp_date rating', NULL),
(10, '50', 'middel', 3, 'for listbox exp_date rating', NULL),
(11, '75', 'hoog', 3, 'for listbox exp_date rating', NULL),
(12, '95', 'zeer hoog', 3, 'for listbox exp_date rating', NULL),
(13, '0', 'Multi Article', 4, 'for SKU', NULL),
(14, '1', 'Phisical Article', 4, 'for SKU', NULL),
(15, '2', 'Soft Bundle', 4, 'for SKU', NULL),
(17, '4', 'Vervallen', 2, 'Ordere status', NULL),
(16, '3', 'Administration', 4, 'for SKU', NULL),
(18, '1', 'Ongelezen', 5, 'for sales@iwex.nl', NULL),
(19, '2', 'Gelezen', 5, 'for sales@iwex.nl', NULL),
(20, '3', 'Beantwoord', 5, 'for sales@iwex.nl', NULL),
(21, '4', 'Doorgestuurd', 5, 'for sales@iwex.nl', NULL),
(22, '5', 'Verwerkt', 5, 'for sales@iwex.nl', NULL),
(23, '1', 'PPC 2003', 8, 'OS for pda', NULL),
(24, '1', 'Intel�', 6, 'processor_type for pda', NULL),
(25, '1', 'Li-Ion', 7, 'accu_type for pda', NULL),
(26, '2', 'Win Mob. 2003 smartphone', 8, 'OS for pda', NULL),
(27, '2', 'Intel� Xscale', 6, 'processor_type for pda', NULL),
(28, '3', 'Intel� StrongArm', 6, 'processor_type for pda', NULL),
(29, '4', 'Intel PXA-255', 6, 'processor_type for pda', NULL),
(30, '3', 'Win Mob PPC 2003 phone', 8, 'OS for pda', NULL),
(31, '5', 'Intel Bulverde', 6, 'processor_type for pda', NULL),
(32, '4', 'Windows Mobile� 2003 for', 8, 'OS for pda', NULL),
(33, '5', 'Microsoft Windows CE 4.2', 8, 'OS for pda', NULL),
(34, '6', 'Intel Cotulla 400Mhz', 8, 'OS for pda', NULL),
(35, '6', 'Intel Cotulla 400Mhz', 6, 'processor_type for pda', NULL),
(36, '7', 'Palm OS', 8, 'OS for pda', NULL),
(37, '7', 'Intel PXA 270', 6, 'processor_type for pda', NULL),
(38, '1', 'jpg', 10, 'possible images extensions', NULL),
(39, '2', 'gif', 10, 'possible images extensions', NULL),
(40, '3', 'png', 10, 'possible images extensions', NULL),
(41, '1', 'dag', 11, 'Reoccurence time of events', NULL),
(42, '2', 'week', 11, 'Reoccurence time of events', NULL),
(43, '3', 'maand', 11, 'Reoccurence time of events', NULL),
(44, '4', 'kwartaal', 11, 'Reoccurence time of events', NULL),
(45, '5', 'jaar', 11, 'Reoccurence time of events', NULL),
(46, '4', 'Windows Mobile 5.0 Engels', 8, 'OS for pda', NULL),
(47, '0', 'Post', 12, 'Invoice options', NULL),
(48, '1', 'E-mail', 12, 'Invoice options', NULL),
(49, '2', 'Post en E-mail', 12, 'Invoice options', NULL),
(50, '1', 'First Mail', 13, 'Selectie for Invoices', NULL),
(51, '2', 'Second Mail', 13, 'Selectie for Invoices', NULL),
(52, '3', 'Telefoon Call', 13, 'Selectie for Invoices', NULL),
(53, '4', 'Fax', 13, 'Selectie for Invoices', NULL),
(54, '5', 'Brief', 13, 'Selectie for Invoices', NULL),
(55, '6', 'Aangetekende brief', 13, 'Selectie for Invoices', NULL),
(56, '7', 'Deurwaarder', 13, 'Selectie for Invoices', NULL),
(57, '0', 'Geen Dispuut', 14, 'Dispuut opties', NULL),
(58, '2', 'Dispuut', 14, 'Dispuut opties', NULL),
(59, '3', 'Dispuut Afgerond', 14, 'Dispuut opties', NULL),
(60, '1', 'New dispuut', 14, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `location`
-- 

CREATE TABLE `location` (
  `ID` smallint(1) unsigned NOT NULL auto_increment,
  `location` varchar(20) NOT NULL default '0',
  `walk_order` tinyint(2) unsigned NOT NULL default '50',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `location` (`location`),
  KEY `walk` (`walk_order`)
) TYPE=MyISAM COMMENT='locations in the warehouse' AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `location`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `menucategory`
-- 

CREATE TABLE `menucategory` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `orderflag` int(11) NOT NULL default '0',
  `menu` int(11) NOT NULL default '0',
  `description` blob,
  `access_s` int(11) NOT NULL default '0',
  `access_a` int(11) NOT NULL default '0',
  `access_v` int(11) NOT NULL default '0',
  `access_r` int(11) NOT NULL default '0',
  `setup_s` int(11) NOT NULL default '0',
  `setup_a` int(11) NOT NULL default '0',
  `setup_v` int(11) NOT NULL default '0',
  `setup_r` int(11) NOT NULL default '0',
  `supervisor` int(11) NOT NULL default '0',
  `nonsupervisor` int(11) NOT NULL default '0',
  `extvend` int(11) NOT NULL default '0',
  `extcust` int(11) NOT NULL default '0',
  `nonext` int(11) NOT NULL default '0',
  `companyid` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `orderflag` (`orderflag`),
  KEY `accessap` (`access_s`),
  KEY `accessar` (`access_a`),
  KEY `accessinv` (`access_v`),
  KEY `supervisor` (`supervisor`),
  KEY `nonsupervisor` (`nonsupervisor`),
  KEY `extvend` (`extvend`),
  KEY `extcust` (`extcust`),
  KEY `nonext` (`nonext`),
  KEY `access_r` (`access_r`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `menucategory`
-- 

INSERT INTO `menucategory` (`id`, `name`, `orderflag`, `menu`, `description`, `access_s`, `access_a`, `access_v`, `access_r`, `setup_s`, `setup_a`, `setup_v`, `setup_r`, `supervisor`, `nonsupervisor`, `extvend`, `extcust`, `nonext`, `companyid`) VALUES (1, 'Verkoop', 1, 1, 0x50726f766964657320616e2065617379206d65616e7320666f7220796f7520746f20656e746572206f726465727320666f723a205374616e64617264204974656d733b20437573746f6d206f6e652d74696d65205072696e74204a6f62733b206f72204e6577205374616e64617264204974656d7320746f206265207072696e7465642e20416c6c206f66207468657365206f726465722074797065732063616e20616c736f2062652065646974656420616e6420757064617465642e20416c736f2c20796f752063616e20656e7465722f75706461746520637573746f6d657220696e666f726d6174696f6e206f72207072696e74206c69737473206f6620637573746f6d6572732e2053696d706c7920636c69636b206f6e2074686520617070726f7072696174652073656374696f6e2e, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0),
(2, 'Debiteuren', 4, 0, 0x577269746520496e766f696365732c20636865636b20637573746f6d6572206163636f756e74732c20766965772073756d6d6172696573206f662062696c6c696e6720696e666f2c206167696e6720646174612e, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0),
(3, 'Logistiek', 5, 1, 0x456e7465722f4368616e6765204974656d20696e666f726d6174696f6e20616e642072756e206974656d207265706f7274732e, 0, 1, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0),
(4, 'Administratie', 11, 1, 0x41646420496e7465726e616c2055736572732c2061646a757374207468656972207269676874732c20696d706f727420646174612066726f6d2065787465726e616c2064617461626173652c20616e642073657420757020446f63756d656e742043617465676f7269657320746f20616c6c6f772065617369657220736561726368657320666f7220446f63756d656e74732e, 0, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0),
(5, 'RMA', 12, 1, '', 0, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0),
(6, 'Beheer', 0, 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0),
(7, 'Inkoop', 0, 1, NULL, 0, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `menufunction`
-- 

CREATE TABLE `menufunction` (
  `id` int(11) NOT NULL auto_increment,
  `menucategoryid` int(11) NOT NULL default '0',
  `name` char(50) NOT NULL default '',
  `imagename` char(50) default NULL,
  `link` char(50) NOT NULL default '',
  `orderflag` int(11) NOT NULL default '0',
  `access_s` int(11) NOT NULL default '0',
  `access_a` int(11) NOT NULL default '0',
  `access_v` int(11) NOT NULL default '0',
  `access_r` int(11) NOT NULL default '0',
  `setup_s` int(11) NOT NULL default '0',
  `setup_a` int(11) NOT NULL default '0',
  `setup_v` int(11) NOT NULL default '0',
  `setup_r` int(11) NOT NULL default '0',
  `supervisor` int(11) NOT NULL default '0',
  `nonsupervisor` int(11) NOT NULL default '0',
  `extvend` int(11) NOT NULL default '0',
  `extcust` int(11) NOT NULL default '0',
  `nonext` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `menucategoryid` (`menucategoryid`),
  KEY `orderflag` (`orderflag`),
  KEY `accessap` (`access_s`),
  KEY `accessar` (`access_a`),
  KEY `accessgl` (`access_v`),
  KEY `accesspay` (`access_r`),
  KEY `supervisor` (`supervisor`),
  KEY `nonsupervisor` (`nonsupervisor`),
  KEY `extvend` (`extvend`),
  KEY `extcust` (`extcust`),
  KEY `nonext` (`nonext`)
) TYPE=MyISAM AUTO_INCREMENT=34 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `menufunction`
-- 

INSERT INTO `menufunction` (`id`, `menucategoryid`, `name`, `imagename`, `link`, `orderflag`, `access_s`, `access_a`, `access_v`, `access_r`, `setup_s`, `setup_a`, `setup_v`, `setup_r`, `supervisor`, `nonsupervisor`, `extvend`, `extcust`, `nonext`) VALUES (1, 1, 'Producten', 'edit.png', 'products/product_sel.php', 1, 1, 1, 1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0),
(2, 5, 'RMA', 'edit.png', 'rma.php', 2, 1, 1, 1, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0),
(7, 3, 'Verzendberichten', 'mass_email.png', 'shipped_mail.php', 7, 0, 1, 1, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0),
(8, 6, 'Interne gebruikers', 'user.png', 'admin/admin.php', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0),
(9, 3, 'Multiarticles', 'edit.png', 'multiarticles.php', 0, 0, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0),
(10, 1, 'Mailing', 'mail.png', 'prijslijstmail.php', 0, 1, 0, 0, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0),
(11, 6, 'web gebruikers', 'db.png', 'admin/admin_extern.php', 0, 1, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0),
(12, 1, 'Orders', 'edit.png', 'order.php', 0, 1, 0, 0, 1, 1, 0, 0, 1, 1, 0, 0, 0, 0),
(14, 4, 'Leveringen te factureren', 'document.png', 'invoice_shipments.php', 0, 1, 1, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0),
(15, 3, 'Leveringen', NULL, 'shipment.php', 0, 0, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0),
(16, 3, 'Labels', 'document.png', 'label.php', 0, 1, 1, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0),
(17, 7, 'Openstaande Artikelen', NULL, 'bo_articles.php', 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0),
(18, 1, 'Contact formulier web', NULL, 'dealer_request_response.php', 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0),
(19, 4, 'Relatiebeheer', 'edit.png', 'contacts/maintain.php', 0, 1, 1, 1, 0, 0, 1, 1, 0, 1, 0, 0, 0, 0),
(20, 7, 'Inkooplijst', NULL, 'purchase_list.php?merkID=1', 0, 0, 0, 0, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0),
(21, 4, 'Facturen overzicht', 'document.png', 'invoice_payment.php', 0, 1, 1, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0),
(22, 7, 'Purchase orders', NULL, 'purchase_sel.php', 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 0, 0, 0),
(24, 4, 'Betalingen invoeren', NULL, 'bank_transactions_maint.php', 0, 1, 1, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0),
(25, 1, 'Inbox Verkoop', 'messaging.png', 'inbox.php?tbmail=sales', 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0),
(26, 3, 'Voorraad aanpassing', NULL, 'stock_mutations.php', 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0),
(27, 5, 'Serie nummer zoeken', NULL, 'includes/find_serial_numbers.php', 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0),
(28, 4, 'Admin. factuur', NULL, 'admin/admin_order.php', 0, 0, 1, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0),
(29, 4, 'Inbox Algemeen', 'messaging.png', 'inbox.php?tbmail=info', 0, 1, 1, 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 0),
(30, 6, 'Queries', NULL, 'queries.php', 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
(31, 4, 'Inbox Administratie', 'messaging.png', 'inbox.php?tbmail=admin', 0, 0, 1, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0),
(32, 6, 'Teksten aanpassen', 'edit.png', 'admin/db_text.php', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0),
(33, 6, 'Tasks', NULL, 'tasks.php', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `months`
-- 

CREATE TABLE `months` (
  `ID` int(2) NOT NULL auto_increment,
  `month` int(2) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=InnoDB AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `months`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `msysconf`
-- 

CREATE TABLE `msysconf` (
  `Config` smallint(2) NOT NULL default '0',
  `chValue` varchar(255) default NULL,
  `nValue` int(4) default '0',
  `Comments` varchar(255) default NULL
) TYPE=MyISAM;

-- 
-- Gegevens worden uitgevoerd voor tabel `msysconf`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `multi_articles`
-- 

CREATE TABLE `multi_articles` (
  `Multi_ID` int(10) unsigned NOT NULL default '0',
  `product_ids` text,
  PRIMARY KEY  (`Multi_ID`),
  UNIQUE KEY `Multi_ID` (`Multi_ID`)
) TYPE=MyISAM COMMENT='lookup multiple underlying articles';

-- 
-- Gegevens worden uitgevoerd voor tabel `multi_articles`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `multi_articles2`
-- 

CREATE TABLE `multi_articles2` (
  `Multi_ProductID` int(10) unsigned NOT NULL auto_increment,
  `Multi_ID` int(10) unsigned NOT NULL default '0',
  `Product_ids` int(10) default NULL,
  `Aantal` tinyint(3) default NULL,
  PRIMARY KEY  (`Multi_ProductID`),
  UNIQUE KEY `Multi_ProductID` (`Multi_ProductID`)
) TYPE=MyISAM COMMENT='lookup multiple underlying articles' AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `multi_articles2`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `my_company_information`
-- 

CREATE TABLE `my_company_information` (
  `SetupID` int(10) unsigned NOT NULL auto_increment,
  `CompanyName` longtext,
  `Address` longtext,
  `City` longtext,
  `StateOrProvince` longtext,
  `PostalCode` longtext,
  `Country` longtext,
  `PhoneNumber` longtext,
  `FaxNumber` longtext,
  PRIMARY KEY  (`SetupID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `my_company_information`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `order_details`
-- 

CREATE TABLE `order_details` (
  `OrderDetailsID` int(10) unsigned NOT NULL auto_increment,
  `OrderID` int(10) unsigned NOT NULL default '0',
  `ProductID` int(10) unsigned NOT NULL default '0',
  `ProductName` varchar(255) default NULL,
  `ProductDescription` text,
  `UnitPrice` decimal(10,2) NOT NULL default '0.00',
  `UnitBTW` decimal(10,2) NOT NULL default '0.00',
  `Quantity` smallint(6) default NULL,
  `to_deliver` int(10) default '0',
  `Extended_price` decimal(10,2) NOT NULL default '0.00',
  `Discount` float default NULL,
  `SerialNB` varchar(255) default NULL,
  `ContactID` int(8) unsigned default NULL,
  `Orderdate` date default NULL,
  `btw_percentage` decimal(10,2) NOT NULL default '0.00',
  `cost_percentage` float NOT NULL default '0',
  `manual_price` tinyint(3) unsigned NOT NULL default '0',
  `RMA_actionID` int(10) unsigned default NULL,
  `CustOrderRowID` varchar(10) default NULL,
  `stock_owner_id` smallint(5) unsigned NOT NULL default '802',
  PRIMARY KEY  (`OrderDetailsID`),
  KEY `ToDeliver` (`to_deliver`),
  KEY `RMAid` (`RMA_actionID`),
  KEY `OrderID` (`OrderID`),
  KEY `ProductID` (`ProductID`)
) TYPE=MyISAM AUTO_INCREMENT=9 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `order_details`
-- 

INSERT INTO `order_details` (`OrderDetailsID`, `OrderID`, `ProductID`, `ProductName`, `ProductDescription`, `UnitPrice`, `UnitBTW`, `Quantity`, `to_deliver`, `Extended_price`, `Discount`, `SerialNB`, `ContactID`, `Orderdate`, `btw_percentage`, `cost_percentage`, `manual_price`, `RMA_actionID`, `CustOrderRowID`, `stock_owner_id`) VALUES (1, 1, 10000, 'Product 1', NULL, 45.00, 0.00, 1, 1, 45.00, 0, NULL, NULL, NULL, 0.00, 0.235192, 0, NULL, '0', 802),
(2, 1, 10001, 'Product 2', NULL, 99.00, 0.00, 12, 12, 1188.00, 0.1, NULL, NULL, NULL, 0.00, 0.517422, 0, NULL, '0', 802),
(3, 1, 10002, 'Product 3', NULL, 270.00, 0.00, 5, 5, 1350.00, 0, NULL, NULL, NULL, 0.00, 1.41115, 0, NULL, '0', 802),
(4, 2, 10003, 'Product 4', NULL, 44.00, 0.00, 1, 0, 44.00, 0, NULL, NULL, NULL, 0.00, 13.5, 0, NULL, '0', 802),
(5, 3, 10001, 'Product 2', NULL, 110.00, 0.00, 1, 0, 110.00, 0, NULL, NULL, NULL, 0.00, 13.5, 0, NULL, '0', 802),
(6, 9, 10001, 'Product 2', NULL, 105.00, 0.00, 1, 1, 105.00, 0.0454545, NULL, NULL, NULL, 0.00, 18.5, 0, NULL, '0', 802),
(7, 11, 10002, 'Product 3', NULL, 270.00, 0.00, 1, 1, 270.00, 0, NULL, NULL, NULL, 0.00, 18.5, 0, NULL, '0', 802),
(8, 12, 10001, 'Product 2', NULL, 105.00, 0.00, 1, 1, 105.00, 0.0454545, NULL, NULL, NULL, 0.00, 13.5, 0, NULL, '0', 802);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `order_history`
-- 

CREATE TABLE `order_history` (
  `OrderHistoryID` int(10) unsigned NOT NULL auto_increment,
  `OrderID` int(8) unsigned NOT NULL default '0',
  `employee` tinyint(3) unsigned NOT NULL default '0',
  `old_value` varchar(100) NOT NULL default '0',
  `new_value` varchar(100) NOT NULL default '0',
  `date_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `FieldName` varchar(25) NOT NULL default '',
  PRIMARY KEY  (`OrderHistoryID`),
  KEY `OrderID` (`OrderID`)
) TYPE=MyISAM AUTO_INCREMENT=153 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `order_history`
-- 

INSERT INTO `order_history` (`OrderHistoryID`, `OrderID`, `employee`, `old_value`, `new_value`, `date_modified`, `FieldName`) VALUES (1, 1, 1, '0.00', '13.50', '2006-04-07 11:06:16', 'Ordercosts'),
(2, 1, 1, '0.00', '5.00', '2006-04-07 11:06:16', 'Transportcosts'),
(3, 1, 1, '', '0', '2006-04-07 11:06:54', 'ContactsOrderID'),
(4, 1, 1, '0', '-', '2006-04-07 11:06:54', 'Price_Level'),
(5, 1, 1, '', '0', '2006-04-07 11:06:54', 'paymentterm_yn'),
(6, 1, 1, '5.00', '0.00', '2006-04-07 11:06:55', 'Transportcosts'),
(7, 1, 1, '0', '-', '2006-04-07 11:15:35', 'Price_Level'),
(8, 1, 1, '0', '-', '2006-04-07 11:15:37', 'Price_Level'),
(9, 1, 1, '0', '-', '2006-04-07 11:15:41', 'Price_Level'),
(10, 1, 1, '0', '-', '2006-04-07 11:18:15', 'Price_Level'),
(11, 1, 1, '0', '1', '2006-04-07 11:18:19', 'Price_Level'),
(12, 1, 1, '0', '1', '2006-04-07 11:33:54', 'confirmed_yn'),
(13, 1, 1, '', '10002', '2006-04-07 14:23:47', 'Toegevoegd product 10002'),
(14, 1, 1, '', 'richard@iwex.nl', '2006-04-07 15:35:40', 'orderbevestiging verzonde'),
(15, 2, 1, '', '3', '2006-04-07 16:37:30', 'ContactID'),
(16, 2, 1, '', '13.50', '2006-04-07 16:37:31', 'Ordercosts'),
(17, 2, 1, '', '5.00', '2006-04-07 16:37:31', 'Transportcosts'),
(18, 2, 1, '', '3', '2006-04-07 16:38:04', 'ContactID'),
(19, 2, 1, '', '1', '2006-04-07 16:38:04', 'Price_Level'),
(20, 2, 1, '', '13.50', '2006-04-07 16:38:05', 'Ordercosts'),
(21, 2, 1, '', '5.00', '2006-04-07 16:38:05', 'Transportcosts'),
(22, 2, 1, '', '2', '2006-04-10 11:05:28', 'ContactID'),
(23, 2, 1, '0', '-', '2006-04-10 11:05:28', 'ShipID'),
(24, 2, 1, '0.00', '13.50', '2006-04-10 11:05:28', 'Ordercosts'),
(25, 2, 1, '0.00', '5.00', '2006-04-10 11:05:28', 'Transportcosts'),
(26, 2, 1, '0', '1', '2006-04-10 11:26:53', 'ShipID'),
(27, 2, 1, '', '12345', '2006-04-10 11:26:53', 'ContactsOrderID'),
(28, 2, 1, '0', '-', '2006-04-10 11:26:53', 'Price_Level'),
(29, 2, 1, '', '0', '2006-04-10 11:26:53', 'paymentterm_yn'),
(30, 2, 1, '5.00', '0.00', '2006-04-10 11:26:53', 'Transportcosts'),
(31, 1, 1, '0', '123456', '2006-04-10 12:20:47', 'ContactsOrderID'),
(32, 1, 1, '123456', '1', '2006-04-10 12:20:55', 'ContactsOrderID'),
(33, 2, 1, '12345', '2', '2006-04-10 12:22:05', 'ContactsOrderID'),
(34, 2, 1, '0', '-', '2006-04-10 12:22:05', 'Price_Level'),
(35, 2, 1, '', 'richard@iwex.nl', '2006-04-19 10:20:54', 'offerte verzonden'),
(36, 2, 1, '0', '1', '2006-04-19 10:24:31', 'confirmed_yn'),
(37, 2, 1, '0', '-', '2006-04-19 10:24:31', 'Price_Level'),
(38, 2, 1, '', 'richard@iwex.nl', '2006-04-19 10:24:45', 'orderbevestiging verzonde'),
(39, 2, 1, '', 'richard@iwex.nl', '2006-04-19 11:12:23', 'offerte verzonden'),
(40, 2, 1, '', 'richard@iwex.nl', '2006-04-19 11:18:43', 'offerte verzonden'),
(41, 2, 1, '0', '-', '2006-04-19 11:18:53', 'Price_Level'),
(42, 2, 1, '0', '-', '2006-04-19 11:21:28', 'Price_Level'),
(43, 2, 1, '', 'richard@iwex.nl', '2006-04-19 11:33:20', 'offerte verzonden'),
(44, 2, 1, '', 'richard@iwex.nl', '2006-04-19 11:33:46', 'offerte verzonden'),
(45, 2, 1, '0', '-', '2006-04-19 11:33:54', 'Price_Level'),
(46, 2, 1, '', 'richard@iwex.nl', '2006-04-19 11:34:31', 'orderbevestiging verzonde'),
(47, 2, 1, '0', '-', '2006-04-19 12:37:59', 'Price_Level'),
(48, 2, 1, '2', '3', '2006-04-19 14:23:02', 'ContactID'),
(49, 2, 1, '0', '-', '2006-04-19 14:23:02', 'Price_Level'),
(50, 2, 1, '1', '2', '2006-04-19 14:23:05', 'ShipID'),
(51, 2, 1, '0', '1', '2006-04-19 14:23:05', 'Price_Level'),
(52, 2, 1, '0', '1', '2006-04-19 15:42:03', 'Complete_yn'),
(53, 2, 1, '0', '1', '2006-04-19 15:42:03', 'Locked_yn'),
(54, 3, 1, '0.00', '13.50', '2006-04-19 16:07:06', 'Ordercosts'),
(55, 3, 1, '0.00', '5.00', '2006-04-19 16:07:06', 'Transportcosts'),
(56, 3, 1, '0', '2', '2006-04-19 16:07:48', 'ShipID'),
(57, 3, 1, '', '2', '2006-04-19 16:07:48', 'ContactsOrderID'),
(58, 3, 1, '0', '1', '2006-04-19 16:07:48', 'Price_Level'),
(59, 3, 1, '', '2', '2006-04-19 16:07:48', 'paymentterm_yn'),
(60, 3, 1, '5.00', '0.00', '2006-04-19 16:07:48', 'Transportcosts'),
(61, 3, 1, '0', '1', '2006-04-19 16:11:51', 'confirmed_yn'),
(62, 3, 1, '', 'richard@iwex.nl', '2006-04-19 16:11:59', 'orderbevestiging verzonde'),
(63, 3, 1, '0', '1', '2006-04-19 16:15:03', 'Complete_yn'),
(64, 3, 1, '0', '1', '2006-04-19 16:15:03', 'Locked_yn'),
(65, 7, 1, '0', '-', '2006-05-05 09:42:11', 'ShipID'),
(66, 7, 1, '', 'test', '2006-05-05 09:42:11', 'ContactsOrderID'),
(67, 7, 1, '0', '1', '2006-05-05 09:42:11', 'Price_Level'),
(68, 7, 1, '', '2', '2006-05-05 09:42:11', 'paymentterm_yn'),
(69, 7, 1, '0.00', '13.50', '2006-05-05 09:42:11', 'Ordercosts'),
(70, 7, 1, '0.00', '5.00', '2006-05-05 09:42:11', 'Transportcosts'),
(71, 7, 1, '0', '-', '2006-05-05 13:24:03', 'ShipID'),
(72, 8, 1, '0.00', '13.50', '2006-05-05 14:12:02', 'Ordercosts'),
(73, 8, 1, '0.00', '5.00', '2006-05-05 14:12:02', 'Transportcosts'),
(74, 8, 1, '0', '-', '2006-05-05 14:20:13', 'ShipID'),
(75, 8, 1, '0', '1', '2006-05-05 14:20:13', 'Price_Level'),
(76, 8, 1, '', '2', '2006-05-05 14:20:13', 'paymentterm_yn'),
(77, 9, 1, '0.00', '13.50', '2006-05-05 14:23:32', 'Ordercosts'),
(78, 9, 1, '0.00', '5.00', '2006-05-05 14:23:32', 'Transportcosts'),
(79, 9, 1, '0', '-', '2006-05-05 14:24:33', 'ShipID'),
(80, 9, 1, '2', '-', '2006-05-05 14:24:33', 'ContactsOrderID'),
(81, 9, 1, '0', '1', '2006-05-05 14:24:33', 'Price_Level'),
(82, 9, 1, '', '2', '2006-05-05 14:24:33', 'paymentterm_yn'),
(83, 9, 1, '0', '-', '2006-05-05 14:27:06', 'ShipID'),
(84, 9, 1, '0', '2', '2006-05-05 14:27:06', 'confirmed_yn'),
(85, 9, 1, '0', '-', '2006-05-05 14:27:13', 'ShipID'),
(86, 9, 1, '0', '-', '2006-05-05 14:39:29', 'ShipID'),
(87, 9, 1, '0', '-', '2006-05-05 14:39:32', 'ShipID'),
(88, 9, 1, '2', '1', '2006-05-05 14:39:32', 'confirmed_yn'),
(89, 9, 1, '0', '-', '2006-05-05 14:39:33', 'ShipID'),
(90, 9, 1, '2', '-', '2006-05-05 14:51:01', 'ShipID'),
(91, 9, 1, '0', '-', '2006-05-05 14:52:39', 'ShipID'),
(92, 9, 1, '0', '-', '2006-05-05 14:52:41', 'ShipID'),
(93, 9, 1, '0', '-', '2006-05-05 15:26:46', 'ShipID'),
(94, 9, 1, '0', '-', '2006-05-05 15:26:51', 'ShipID'),
(95, 9, 1, '0', '-', '2006-05-05 15:27:40', 'ShipID'),
(96, 9, 1, '0', '-', '2006-05-05 15:43:20', 'ShipID'),
(97, 9, 1, '0', '-', '2006-05-05 15:43:26', 'ShipID'),
(98, 9, 1, '0', 'selected', '2006-05-05 15:47:40', 'ShipID'),
(99, 9, 1, '0', 'selected', '2006-05-05 15:52:08', 'ShipID'),
(100, 9, 1, '0', 'selected', '2006-05-05 15:52:28', 'ShipID'),
(101, 9, 1, '0', 'selected', '2006-05-05 15:53:11', 'ShipID'),
(102, 9, 1, '0', 'selected', '2006-05-05 15:53:42', 'ShipID'),
(103, 9, 1, '0', 'selected', '2006-05-05 15:54:12', 'ShipID'),
(104, 9, 1, '0', 'selected', '2006-05-05 15:57:37', 'ShipID'),
(105, 9, 1, '0', 'selected', '2006-05-05 16:09:09', 'ShipID'),
(106, 9, 1, '0', 'selected', '2006-05-05 16:09:35', 'ShipID'),
(107, 9, 1, '0', 'selected', '2006-05-05 16:09:55', 'ShipID'),
(108, 9, 1, '0', 'selected', '2006-05-05 16:10:48', 'ShipID'),
(109, 9, 1, '0', 'selected', '2006-05-05 16:13:18', 'ShipID'),
(110, 9, 1, '0', 'selected', '2006-05-05 16:19:33', 'ShipID'),
(111, 9, 1, '0', 'selected', '2006-05-05 16:22:02', 'ShipID'),
(112, 9, 1, '0', 'selected', '2006-05-05 16:22:41', 'ShipID'),
(113, 9, 1, '0', 'selected', '2006-05-05 16:24:00', 'ShipID'),
(114, 9, 1, '0', 'selected', '2006-05-05 16:27:07', 'ShipID'),
(115, 9, 1, '0', 'selected', '2006-05-05 16:32:27', 'ShipID'),
(116, 9, 1, '0', 'selected', '2006-05-05 16:33:38', 'ShipID'),
(117, 9, 1, '0', 'selected', '2006-05-05 16:33:54', 'ShipID'),
(118, 9, 1, '0', 'selected', '2006-05-05 16:34:00', 'ShipID'),
(119, 9, 1, '0', 'selected', '2006-05-05 16:40:55', 'ShipID'),
(120, 9, 1, '0', '7', '2006-05-05 16:42:03', 'ShipID'),
(121, 9, 1, '', '10001', '2006-05-09 09:26:27', 'Toegevoegd product 10001'),
(122, 9, 1, '7', '5', '2006-05-09 14:00:34', 'ShipID'),
(123, 9, 1, '5', '7', '2006-05-09 15:40:53', 'ShipID'),
(124, 10, 1, '0.00', '13.50', '2006-05-10 12:10:31', 'Ordercosts'),
(125, 10, 1, '0.00', '5.00', '2006-05-10 12:10:31', 'Transportcosts'),
(126, 11, 1, '0.00', '13.50', '2006-05-10 12:17:41', 'Ordercosts'),
(127, 11, 1, '0.00', '5.00', '2006-05-10 12:17:41', 'Transportcosts'),
(128, 11, 1, '0', '2', '2006-05-10 12:17:50', 'ContactID'),
(129, 11, 1, '0', '-', '2006-05-10 12:17:50', 'ShipID'),
(130, 11, 1, '0', '5', '2006-05-10 12:17:59', 'ShipID'),
(131, 11, 1, '', '2', '2006-05-10 12:17:59', 'paymentterm_yn'),
(132, 11, 1, '0', '1', '2006-05-10 12:18:50', 'confirmed_yn'),
(133, 11, 1, '5', '7', '2006-05-10 12:19:04', 'ShipID'),
(134, 11, 1, '7', '6', '2006-05-10 12:19:11', 'ShipID'),
(135, 11, 1, '6', '5', '2006-05-10 12:19:26', 'ShipID'),
(136, 11, 1, '1', '2', '2006-05-10 12:19:39', 'confirmed_yn'),
(137, 11, 1, '2', '1', '2006-05-10 12:19:44', 'confirmed_yn'),
(138, 11, 1, '', '10002', '2006-05-10 12:19:52', 'Toegevoegd product 10002'),
(139, 12, 1, '0.00', '13.50', '2006-05-10 12:21:34', 'Ordercosts'),
(140, 12, 1, '0.00', '5.00', '2006-05-10 12:21:34', 'Transportcosts'),
(141, 12, 1, '0', '-', '2006-05-10 12:22:05', 'ShipID'),
(142, 12, 1, '', '1', '2006-05-10 12:22:05', 'ContactsOrderID'),
(143, 12, 1, '0', '1', '2006-05-10 12:22:05', 'Price_Level'),
(144, 12, 1, '', '2', '2006-05-10 12:22:05', 'paymentterm_yn'),
(145, 12, 1, '0', '5', '2006-05-10 12:22:38', 'ShipID'),
(146, 12, 1, '0', '1', '2006-05-10 12:22:54', 'confirmed_yn'),
(147, 12, 1, '', 'test@test.nl', '2006-05-10 12:25:43', 'orderbevestiging verzonde'),
(148, 8, 1, '0', '2', '2006-05-12 10:44:04', 'ShipID'),
(149, 8, 1, '0', '1', '2006-05-12 10:44:04', 'confirmed_yn'),
(150, 12, 1, '5', '-', '2006-05-15 16:09:45', 'ShipID'),
(151, 12, 1, '0', '1', '2006-05-15 16:56:20', 'ShipID'),
(152, 12, 1, '5.00', '0.00', '2006-05-15 16:56:22', 'Transportcosts');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `order_margin`
-- 

CREATE TABLE `order_margin` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `OrderID` int(10) NOT NULL default '0',
  `Sales_Value` decimal(10,2) NOT NULL default '0.00',
  `Purchase_Value` decimal(10,2) NOT NULL default '0.00',
  `Shipping_Cost` decimal(10,2) NOT NULL default '0.00',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `orderid` (`OrderID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `order_margin`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `ordercost_type`
-- 

CREATE TABLE `ordercost_type` (
  `OrderCostID` tinyint(2) unsigned NOT NULL auto_increment,
  `Description` char(25) NOT NULL default '',
  `WebOrderCost` float NOT NULL default '12.5',
  `MinWebOrderAmount` float NOT NULL default '300',
  `OrderCost` float NOT NULL default '13.5',
  `MinOrderAmount` float NOT NULL default '400',
  `ShippingCost` float NOT NULL default '5',
  `RealCost` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`OrderCostID`)
) TYPE=MyISAM AUTO_INCREMENT=7 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `ordercost_type`
-- 

INSERT INTO `ordercost_type` (`OrderCostID`, `Description`, `WebOrderCost`, `MinWebOrderAmount`, `OrderCost`, `MinOrderAmount`, `ShippingCost`, `RealCost`) VALUES (1, 'Default', 12.5, 300, 13.5, 400, 5, 0),
(2, 'Geen orderkosten', 0, 0, 0, 0, 5, 0),
(3, 'Geen order en verzend kos', 0, 0, 0, 0, 0, 0),
(4, '15 euro buitenland', 12.5, 300, 13.5, 400, 15, 0),
(5, 'Werkelijke verzend kosten', 0, 0, 5, 200, 0, 1),
(6, 'Fiat Deal extravision', 6, 300, 6, 400, 0, 0);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `orders`
-- 

CREATE TABLE `orders` (
  `OrderID` int(10) unsigned NOT NULL auto_increment,
  `ContactID` int(8) default NULL,
  `ContactsOrderID` varchar(100) default NULL,
  `EmployeeID` int(11) default NULL,
  `OrderDate` datetime default NULL,
  `RequiredDate` datetime default NULL,
  `ShippedDate` datetime default NULL,
  `xp_no` int(11) unsigned default NULL,
  `mailtable` varchar(10) default NULL,
  `ShipVia` tinyint(4) unsigned default NULL,
  `ShipID` int(10) unsigned NOT NULL default '0',
  `ShipName` varchar(50) default NULL,
  `Shipaddress` varchar(50) default NULL,
  `ShipCity` varchar(50) default NULL,
  `ShipRegion` varchar(50) default NULL,
  `ShipPostalCode` varchar(50) default NULL,
  `ShipCountry` varchar(50) default NULL,
  `Locked_yn` tinyint(1) unsigned NOT NULL default '0',
  `Comments` mediumtext,
  `confirmed_yn` tinyint(1) default '0',
  `blockorder` tinyint(3) unsigned NOT NULL default '0',
  `Confirmed_how` varchar(30) default NULL,
  `endcustomer_yn` tinytext,
  `paymentterm_yn` tinytext,
  `Trackingnummer` tinytext,
  `Btw_YN` tinytext,
  `Price_level` tinyint(2) unsigned default NULL,
  `Complete_yn` tinyint(1) default '0',
  `Transportcosts` decimal(10,2) default '0.00',
  `manual_transportcosts` tinyint(1) unsigned NOT NULL default '0',
  `Ordercosts` decimal(10,2) default '0.00',
  `manual_ordercosts` tinyint(1) unsigned NOT NULL default '0',
  `employee` tinyint(3) unsigned default NULL,
  `in_one_delivery_yn` tinyint(1) unsigned default NULL,
  `rma_yn` tinyint(1) NOT NULL default '0',
  `consignment_order` tinyint(1) unsigned NOT NULL default '0',
  `administration_order` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`OrderID`),
  KEY `Contactid` (`ContactID`),
  KEY `ShipID` (`ShipID`),
  KEY `ReadyOrder` (`confirmed_yn`,`Complete_yn`),
  KEY `rma` (`rma_yn`),
  KEY `xp_no` (`xp_no`,`mailtable`)
) TYPE=MyISAM AUTO_INCREMENT=13 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `orders`
-- 

INSERT INTO `orders` (`OrderID`, `ContactID`, `ContactsOrderID`, `EmployeeID`, `OrderDate`, `RequiredDate`, `ShippedDate`, `xp_no`, `mailtable`, `ShipVia`, `ShipID`, `ShipName`, `Shipaddress`, `ShipCity`, `ShipRegion`, `ShipPostalCode`, `ShipCountry`, `Locked_yn`, `Comments`, `confirmed_yn`, `Confirmed_how`, `endcustomer_yn`, `paymentterm_yn`, `Trackingnummer`, `Btw_YN`, `Price_level`, `Complete_yn`, `Transportcosts`, `manual_transportcosts`, `Ordercosts`, `manual_ordercosts`, `employee`, `in_one_delivery_yn`, `rma_yn`, `consignment_order`, `administration_order`) VALUES (1, 2, '1', NULL, '2006-04-07 11:05:00', NULL, NULL, 0, '', NULL, 1, 'Adress 1', '', 'everywhere', NULL, '1111AA', 'NL', 0, '', 1, NULL, NULL, '0', NULL, '-1', 1, 0, 0.00, 0, 13.50, 0, 1, 0, 0, 0, 0),
(2, 3, '2', NULL, '2006-04-10 09:45:11', NULL, NULL, 0, '', NULL, 2, 'Klant  2', 'unknown 10', 'unknown', NULL, '1234AA', 'NL', 1, '', 1, NULL, NULL, '0', NULL, '-1', 1, 1, 0.00, 0, 13.50, 0, NULL, 0, 0, 0, 0),
(3, 3, '2', NULL, '2006-03-19 16:06:00', NULL, NULL, 0, '', NULL, 2, 'Klant  2', 'unknown 10', 'unknown', NULL, '1234AA', 'NL', 1, '', 1, NULL, NULL, '2', NULL, '-1', 1, 1, 0.00, 0, 13.50, 0, 1, 0, 0, 0, 0),
(4, 2, '', NULL, '2006-05-05 08:47:00', NULL, NULL, 0, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 0, NULL, NULL, '', NULL, '0', 0, 0, 0.00, 0, 0.00, 0, 1, 0, 0, 0, 0),
(5, 2, '', NULL, '2006-05-05 08:47:00', NULL, NULL, 0, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 0, NULL, NULL, '', NULL, '0', 0, 0, 0.00, 0, 0.00, 0, 1, 0, 0, 0, 0),
(6, 2, '', NULL, '2006-05-05 08:47:00', NULL, NULL, 0, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 0, NULL, NULL, '', NULL, '0', 0, 0, 0.00, 0, 0.00, 0, 1, 0, 0, 0, 0),
(7, 2, 'test', NULL, '2006-05-05 08:47:00', NULL, NULL, 0, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 0, NULL, NULL, '2', NULL, '0', 1, 0, 5.00, 0, 13.50, 0, 1, 0, 0, 0, 0),
(8, 3, '', NULL, '2006-05-05 14:10:00', NULL, NULL, 0, '', NULL, 2, 'Klant  2', 'unknown 10', 'unknown', NULL, '1234AA', 'NL', 0, '', 1, NULL, NULL, '2', NULL, '-1', 1, 0, 5.00, 0, 13.50, 0, 1, 0, 0, 0, 0),
(9, 2, '2', NULL, '2006-05-05 14:23:00', NULL, NULL, 0, '', NULL, 7, '', 'dorpstraat 8', 'nieuwe niedorp', NULL, '1628 CG', 'NL', 0, '', 1, NULL, NULL, '2', NULL, '0', 1, 0, 5.00, 0, 13.50, 0, 1, 0, 0, 0, 0),
(10, 2, '', NULL, '2006-05-10 12:09:00', NULL, NULL, 0, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 0, NULL, NULL, '', NULL, '0', 1, 0, 5.00, 0, 13.50, 0, 1, 0, 0, 0, 0),
(11, 2, '', NULL, '2006-05-10 12:09:00', NULL, NULL, 0, '', NULL, 5, '', 'winterkoninkje 6', 'Hoorn', NULL, '1628 CG', '', 0, '', 1, NULL, NULL, '2', NULL, '0', 1, 0, 5.00, 0, 13.50, 0, 1, 0, 0, 0, 0),
(12, 2, '1', NULL, '2006-05-10 12:21:00', NULL, NULL, 0, '', NULL, 1, 'Adress 1', '', 'everywhere', NULL, '1111AA', 'NL', 0, '', 1, NULL, NULL, '2', NULL, '-1', 1, 0, 0.00, 0, 13.50, 0, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `payment_type`
-- 

CREATE TABLE `payment_type` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `payment_name` varchar(50) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=14 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `payment_type`
-- 

INSERT INTO `payment_type` (`ID`, `payment_name`) VALUES (1, 'Kas Iwan'),
(2, 'Kas Alex'),
(3, 'Rabobank'),
(4, 'Postbank'),
(5, 'Rembours Postbank'),
(6, 'ABNAMRO'),
(7, 'Niet ingevoerd'),
(8, 'Gecrediteerd'),
(9, 'Verloren/niet aangekomen'),
(10, 'Kas Iwex'),
(11, 'Demo'),
(12, 'PayPal'),
(13, 'Bekijk sylvia');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `payments_link`
-- 

CREATE TABLE `payments_link` (
  `link_ID` int(8) unsigned NOT NULL auto_increment,
  `BankTransactionID` int(10) unsigned NOT NULL default '0',
  `InvoiceID` int(10) unsigned default NULL,
  `link_amount` decimal(10,2) default NULL,
  PRIMARY KEY  (`link_ID`),
  UNIQUE KEY `link_ID` (`link_ID`),
  KEY `BankTransaction` (`BankTransactionID`),
  KEY `InvoiceID` (`InvoiceID`)
) TYPE=MyISAM COMMENT='Links the banktransactions with the invoices' AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `payments_link`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `paymentterm`
-- 

CREATE TABLE `paymentterm` (
  `PaymentTermID` tinyint(3) unsigned NOT NULL auto_increment,
  `Description` varchar(30) default '0',
  `days` tinyint(3) unsigned default NULL,
  `endmonth` tinyint(1) unsigned NOT NULL default '0',
  `incasso` tinyint(1) unsigned NOT NULL default '0',
  `languageID` tinyint(3) unsigned NOT NULL default '0',
  `categoryID` tinyint(3) unsigned NOT NULL default '0',
  UNIQUE KEY `PaymentTermID` (`PaymentTermID`)
) TYPE=MyISAM AUTO_INCREMENT=13 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `paymentterm`
-- 

INSERT INTO `paymentterm` (`PaymentTermID`, `Description`, `days`, `endmonth`, `incasso`, `languageID`, `categoryID`) VALUES (2, 'Binnen 14 dagen', 14, 0, 0, 1, 2),
(3, 'Rembours', 14, 0, 0, 1, 3),
(4, 'Vooruit / upfront', 0, 0, 0, 1, 4),
(1, 'Binnen 30 dagen', 30, 0, 0, 1, 1),
(5, 'Automatische incasso', 14, 0, 1, 1, 5),
(6, 'Binnen 45 dagen', 45, 0, 0, 1, 6),
(7, 'Within 14 days', 14, 0, 0, 2, 2),
(8, 'Rembours', 14, 0, 0, 2, 3),
(9, 'Vooruit / upfront', 0, 0, 0, 2, 4),
(10, 'Binnen 30 dagen', 30, 0, 0, 2, 1),
(11, 'Automatische incasso', 14, 0, 1, 2, 5),
(12, 'Binnen 45 dagen', 45, 0, 0, 2, 6);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `po_details`
-- 

CREATE TABLE `po_details` (
  `podetailsID` int(10) unsigned NOT NULL auto_increment,
  `poID` int(10) unsigned default NULL,
  `podate` date default NULL,
  `productID` int(10) unsigned NOT NULL default '0',
  `unitprice` decimal(10,2) NOT NULL default '0.00',
  `quantity` int(10) default NULL,
  `to_deliver` int(10) default '0',
  `tax_percentage` decimal(10,2) NOT NULL default '0.00',
  `added_cost` float NOT NULL default '0',
  `last_exp` date default NULL,
  `comments` varchar(50) default NULL,
  PRIMARY KEY  (`podetailsID`),
  KEY `podate` (`podate`),
  KEY `productid` (`productID`),
  KEY `poID` (`poID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `po_details`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `pricelevel`
-- 

CREATE TABLE `pricelevel` (
  `id` tinyint(3) unsigned NOT NULL default '0',
  `level` tinyint(2) unsigned default '0',
  `Description` varchar(10) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) TYPE=MyISAM;

-- 
-- Gegevens worden uitgevoerd voor tabel `pricelevel`
-- 

INSERT INTO `pricelevel` (`id`, `level`, `Description`) VALUES (1, 0, 'Auto'),
(2, 0, '10+'),
(3, 0, '50+'),
(4, 0, '100+');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `pricing`
-- 

CREATE TABLE `pricing` (
  `recordID` int(10) NOT NULL auto_increment,
  `purchase_price` decimal(10,2) NOT NULL default '0.00',
  `amount` decimal(10,2) NOT NULL default '0.00',
  `currentyid` int(2) unsigned NOT NULL default '0',
  `currencyid` tinyint(2) unsigned NOT NULL default '2',
  `start_date` date NOT NULL default '0000-00-00',
  `end_date` date NOT NULL default '0000-00-00',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(2) unsigned NOT NULL default '0',
  `ContactID` int(10) unsigned default '0',
  `productID` int(10) unsigned default NULL,
  `price_type` tinyint(3) unsigned NOT NULL default '1',
  `start_number` int(10) unsigned NOT NULL default '0',
  `end_number` int(10) unsigned NOT NULL default '0',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(2) unsigned NOT NULL default '0',
  PRIMARY KEY  (`recordID`),
  UNIQUE KEY `RecordID` (`recordID`),
  KEY `RecordID_2` (`recordID`),
  KEY `ProductID` (`productID`),
  KEY `ConctactID` (`ContactID`),
  KEY `startdate` (`start_date`),
  KEY `enddate` (`end_date`),
  KEY `startnumber` (`start_number`),
  KEY `price_type` (`price_type`)
) TYPE=MyISAM COMMENT='pricing table' AUTO_INCREMENT=9 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `pricing`
-- 

INSERT INTO `pricing` (`recordID`, `purchase_price`, `amount`, `currentyid`, `currencyid`, `start_date`, `end_date`, `created`, `created_by`, `ContactID`, `productID`, `price_type`, `start_number`, `end_number`, `modified`, `modified_by`) VALUES (1, 0.00, 45.00, 0, 2, '2006-04-07', '0000-00-00', '2006-04-07 11:15:27', 1, 0, 10000, 1, 1, 0, '0000-00-00 00:00:00', 0),
(2, 0.00, 110.00, 0, 2, '2006-03-07', '0000-00-00', '2006-04-07 11:21:17', 1, 0, 10001, 1, 1, 0, '2006-04-19 16:10:50', 1),
(3, 0.00, 105.00, 0, 2, '2006-04-07', '0000-00-00', '2006-04-07 11:24:07', 1, 2, 10001, 1, 1, 9, '2006-04-19 16:10:50', 1),
(4, 0.00, 99.00, 0, 2, '2006-04-07', '0000-00-00', '2006-04-07 11:24:32', 1, 2, 10001, 1, 10, 20, '2006-04-19 16:10:50', 1),
(5, 0.00, 280.00, 0, 2, '2006-04-03', '2006-04-06', '2006-04-06 14:12:21', 1, 0, 10002, 1, 1, 0, '2006-04-07 14:18:37', 1),
(6, 0.00, 270.00, 0, 2, '2006-04-07', '0000-00-00', '2006-04-07 14:17:05', 1, 0, 10002, 1, 1, 0, '2006-04-07 14:18:37', 1),
(7, 0.00, 45.00, 0, 2, '2006-04-08', '2006-04-09', '2006-04-10 11:20:25', 1, 0, 10003, 1, 1, 0, '2006-04-10 11:23:18', 1),
(8, 0.00, 44.00, 0, 2, '2006-04-10', '0000-00-00', '2006-04-10 11:20:55', 1, 0, 10003, 1, 1, 0, '2006-04-10 11:23:18', 1);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `product_history`
-- 

CREATE TABLE `product_history` (
  `ProductHistoryID` int(10) unsigned NOT NULL auto_increment,
  `ProductID` int(8) unsigned NOT NULL default '0',
  `employee` tinyint(3) unsigned NOT NULL default '0',
  `old_value` varchar(100) NOT NULL default '0',
  `new_value` varchar(100) NOT NULL default '0',
  `date_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `FieldName` varchar(25) NOT NULL default '',
  PRIMARY KEY  (`ProductHistoryID`),
  KEY `ProductID` (`ProductID`)
) TYPE=MyISAM AUTO_INCREMENT=23 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `product_history`
-- 

INSERT INTO `product_history` (`ProductHistoryID`, `ProductID`, `employee`, `old_value`, `new_value`, `date_modified`, `FieldName`) VALUES (1, 10000, 0, '0', '1', '2006-04-06 13:56:12', 'Supplier'),
(2, 10000, 0, '0', '1', '2006-04-06 13:56:51', 'CategoryID'),
(3, 10000, 0, '2', '-', '2006-04-06 13:56:51', 'currency'),
(4, 10000, 0, '0', '1', '2006-04-06 13:57:01', 'Pricelist_yn'),
(5, 10000, 0, '0', '2', '2006-04-06 14:16:12', 'currency'),
(6, 10001, 1, 'Nieuw', 'Product 2', '2006-04-06 16:08:28', 'ProductName'),
(7, 10001, 1, '0', '1', '2006-04-06 16:08:28', 'Supplier'),
(8, 10001, 1, '0', '1', '2006-04-06 16:09:14', 'Pricelist_yn'),
(9, 10002, 1, 'Merk 1', 'Merk 2', '2006-04-07 14:11:53', 'Merk'),
(10, 10002, 1, 'Nieuw', 'Dit is product 3', '2006-04-07 14:11:53', 'ProductName'),
(11, 10002, 1, 'Dit is product 3', 'Product 3', '2006-04-07 14:24:41', 'ProductName'),
(12, 10002, 1, 'Dit is Product 3', 'Product 3', '2006-04-07 14:24:41', 'Productdescription'),
(13, 10003, 1, 'Nieuw', 'Product 4', '2006-04-10 11:09:55', 'ProductName'),
(14, 10003, 1, '0', '1', '2006-04-10 11:09:55', 'Supplier'),
(15, 10003, 1, '0', '5.00', '2006-04-10 11:11:24', 'weight_corr'),
(16, 10003, 1, '0', '1', '2006-04-10 11:11:36', 'CategoryID'),
(17, 10003, 1, '0', '1', '2006-04-19 14:32:49', 'Pricelist_yn'),
(18, 10001, 1, 'Product 2', 'Product 3', '2006-04-26 14:01:12', 'ProductName'),
(19, 10001, 1, 'Product 2', 'Product 244', '2006-05-17 12:24:48', 'ProductName'),
(20, 10001, 1, 'Dit is product 2', 'Dit is product 24', '2006-05-17 12:26:23', 'Productdescription'),
(21, 10001, 1, 'Dit is product 2', 'Dit is product 24', '2006-05-17 12:43:35', 'Productdescription'),
(22, 10001, 1, 'Dit is product 2', 'Dit is product 24', '2006-05-17 12:44:01', 'Productdescription');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `product_stock`
-- 

CREATE TABLE `product_stock` (
  `product_stock_id` int(8) unsigned NOT NULL auto_increment,
  `Product_ID` int(8) unsigned NOT NULL default '0',
  `stock` smallint(3) NOT NULL default '0',
  `free_stock` smallint(3) NOT NULL default '0',
  `free_stock_calculated` datetime NOT NULL default '0000-00-00 00:00:00',
  `location_id` smallint(3) unsigned NOT NULL default '0',
  `owner_id` smallint(5) unsigned NOT NULL default '802',
  PRIMARY KEY  (`product_stock_id`),
  KEY `id` (`product_stock_id`,`Product_ID`,`owner_id`)
) TYPE=MyISAM COMMENT='Products stock and owner information' AUTO_INCREMENT=5 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `product_stock`
-- 

INSERT INTO `product_stock` (`product_stock_id`, `Product_ID`, `stock`, `free_stock`, `free_stock_calculated`, `location_id`, `owner_id`) VALUES (1, 10000, 10, 9, '0000-00-00 00:00:00', 0, 802),
(2, 10001, 11, 0, '0000-00-00 00:00:00', 0, 802),
(3, 10002, 10, 5, '0000-00-00 00:00:00', 0, 802),
(4, 10003, 11, 11, '0000-00-00 00:00:00', 0, 802);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `purchase_orders`
-- 

CREATE TABLE `purchase_orders` (
  `PurchaseOrderID` int(10) unsigned NOT NULL auto_increment,
  `PurchaseOrderNumber` varchar(100) default NULL,
  `PurchaseOrderDescription` varchar(100) default NULL,
  `SupplierID` int(11) default NULL,
  `EmployeeID` int(11) default NULL,
  `OrderDate` datetime default NULL,
  `ShipContactID` int(10) default NULL,
  `ship_adresID` int(11) unsigned default NULL,
  `ShipName` varchar(50) default NULL,
  `ShipAddress` varchar(50) default NULL,
  `ShipPostalCode` varchar(50) default NULL,
  `ShipCity` varchar(50) default NULL,
  `ShipCountry` varchar(50) default NULL,
  `DateRequired` datetime default NULL,
  `DatePromised` datetime default NULL,
  `ShipDate` datetime default NULL,
  `ShippingMethodID` int(11) default NULL,
  `FreightCharge` tinyint(4) default NULL,
  `Order_currency` tinyint(1) default '2',
  `btw_yn` tinyint(4) default NULL,
  `PO_sent` datetime default NULL,
  `status` tinyint(3) unsigned default '1',
  `buyer_contactID` int(10) unsigned default NULL,
  PRIMARY KEY  (`PurchaseOrderID`),
  KEY `SupplierID` (`SupplierID`),
  KEY `status` (`status`),
  KEY `POsent` (`PO_sent`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `purchase_orders`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `query`
-- 

CREATE TABLE `query` (
  `Name` varchar(35) NOT NULL default '0',
  `statement` longtext,
  `ID` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`ID`),
  KEY `Name_2` (`Name`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

INSERT INTO `query` (`Name`, `statement`, `ID`) VALUES 
('prod_euro', 'update current_product_list set purchase_price_home=purchase_price_foreign*1.14574\r\nwhere currency=1\r\n', 1),
('Pretec_upd', 'Update current_product_list set Purchase_price_home = Purchase_price_foreign*1.02 where merk = ''Pretec'';\r\n', 2),
('Prijsupd_a', 'update current_product_list, valuta set Purchase_price_home = Purchase_price_foreign*valuta.ValutaXrate*1.04 where currency = valuta.ValutaID and currency <> 2 and Purchase_price_foreign <> 0;\r\nupdate current_product_list set Retail_price_ex = (Purchase_price_home+extra_cost)*Margin_correction*1.85 where Margin_correction<>0;\r\nupdate current_product_list set Selling_price = (Purchase_price_home+extra_cost)*Margin_correction*1.30 where Margin_correction<>0;\r\nupdate current_product_list set Selling_price_10 = (Purchase_price_home+extra_cost)*Margin_correction*1.20 where Margin_correction<>0;\r\nupdate current_product_list set Selling_price_50 = (Purchase_price_home+extra_cost)*Margin_correction*1.15 where Margin_correction<>0;\r\nupdate current_product_list set Selling_price_100 = (Purchase_price_home+extra_cost)*Margin_correction*1.10 where Margin_correction<>0;\r\n\r\nupdate current_product_list set Retail_price_ex = (Purchase_price_home+extra_cost)*Margin_correction*2.35 where Margin_correction<>0 and Purchase_price_home<15;\r\nupdate current_product_list set Selling_price = (Purchase_price_home+extra_cost)*Margin_correction*1.50 where Margin_correction<>0 and Purchase_price_home<15;\r\nupdate current_product_list set Selling_price_10 = (Purchase_price_home+extra_cost)*Margin_correction*1.30 where Margin_correction<>0 and Purchase_price_home<15 and Merk <>''HR Richter'';\r\nupdate current_product_list set Selling_price_50 = (Purchase_price_home+extra_cost)*Margin_correction*1.25 where Margin_correction<>0 and Purchase_price_home<15 and Merk <>''HR Richter'';\r\nupdate current_product_list set Selling_price_100 = (Purchase_price_home+extra_cost)*Margin_correction*1.20 where Margin_correction<>0 and Purchase_price_home<15 and Merk <>''HR Richter'';\r\n\r\nupdate current_product_list set Price_discovery = (Purchase_price_home+extra_cost)*Margin_correction*1.60 where Margin_correction<>0;\r\nupdate current_product_list set Price_discovery = (Purchase_price_home+extra_cost)*Margin_correction*1.90 where Margin_correction<>0 and Purchase_price_home<15;\r\n\r\nSELECT ProductID, ProductName, Productdescription, purchase_price_foreign, Purchase_price_home, extra_cost, Selling_price_100, Selling_price_10, Selling_price FROM `current_product_list` \r\n  WHERE (purchase_price_home >= Selling_price_100 or purchase_price_home >= Selling_price_10 or purchase_price_home >= Selling_price) and purchase_price_home <> 0;', 3),
('Faxmailing', 'select CompanyName,Fax from contacts where mailing=1 and Auto_yn=1;', 4),
('AutoDlist', 'select CompanyName, Address, PostalCode, City, Phone, Fax, website, email from contacts where mailing=1 and Auto_yn=1 order by PostalCode;', 5),
('klanten', 'select DISTINCT \r\n  contacts.ContactID,\r\n  contacts.CompanyName, \r\n  ContactFirstName as first, \r\n  ContactTussenvoegs as \\'' \\'', \r\n  ContactName as last, \r\n  contacts.Address, \r\n  contacts.PostalCode, \r\n  contacts.City \r\nFROM contacts\r\nINNER JOIN invoices ON invoices.customerID=contacts.ContactID\r\nORDER BY contacts.PostalCode;', 6),
('BackordKlt', 'select distinct \r\n  orders.OrderID, \r\n  ProductID, ProductName\r\nfrom order_details, contacts, orders \r\nwhere ProductID = 991148 and \r\n      order_details.OrderID=orders.OrderID and \r\n      orders.ContactID=88;', 7),
('kwrtInvoic', 'SELECT * FROM `invoices` where QUARTER(paid_date) = 4 and paid_yn = 1 and YEAR(paid_date) =2003;', 8),
('update Inv', 'UPDATE invoices INNER JOIN contacts ON invoices.companyName = contacts.CompanyName SET invoices.CustomerID = [ContactID]\r\nWHERE (((invoices.CustomerID) Is Null));', 9),
('intracom', 'SELECT contacts.CompanyName, ShipName, Invoice_date, ShipCountry, Invoice_total, \r\n    Invoice_BTW, btw_number, eu_country, paid_date\r\nFROM invoices \r\nLEFT join contacts ON invoices.CustomerID = contacts.ContactID\r\nLEFT JOIN country ON contacts.Country = country.code\r\nwhere QUARTER(invoice_date) = 4 \r\n    AND YEAR(invoice_date) =2008 \r\n    AND invoices.ShipCountry NOT LIKE \\"N%\\"\r\norder by eu_country desc, btw_number;', 10),
('deb not nl', 'SELECT contacts.CompanyName, ShipName, Invoice_date, ShipCountry, Invoice_total, Invoice_BTW, paid_date, btw_number FROM invoices inner join contacts where invoices.CustomerID = contacts.ContactID and YEAR(invoice_date) =2003 and ShipCountry not like ''N%'' and (paid_date is NULL or paid_date > ''2003-12-31'') order by btw_number;\r\n', 11),
('debit. nl', 'SELECT contacts.CompanyName, Invoice_date, ShipCountry, Invoice_total, Invoice_BTW, Invoice_total+Invoice_BTW as invoice_totaal, paid_date FROM invoices inner join contacts where invoices.CustomerID = contacts.ContactID and YEAR(invoice_date) =2003 and ShipCountry like ''N%'' and (paid_date is NULL or paid_date > ''2003-12-31'') order by contacts.CompanyName;', 12),
('upd_stock', 'Update current_product_list, inventory_transactions set current_product_list.stock = (\r\nSum((UnitsReceived)-(UnitsSold)-(UnitsShrinkage)) \r\nWHERE current_product_list.ProductID = inventory_transactions.ProductID)', 13),
('voorraad', 'SELECT DISTINCTROW current_product_list.ProductID, current_product_list.ProductName, \r\ncurrent_product_list.ReorderLevel, current_product_list.LeadTime, \r\nSum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)) AS Stock,\r\nSum(IF(isnull(UnitsOrdered),0,UnitsOrdered)-IF(isnull(UnitsReceived),0,UnitsReceived)) AS on_order,  \r\ncurrent_product_list.Productdescription, current_product_list.Merk\r\nFROM current_product_list \r\nINNER JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID\r\nGROUP BY current_product_list.ProductID, current_product_list.ProductName, \r\ncurrent_product_list.ReorderLevel, current_product_list.LeadTime, \r\ncurrent_product_list.Productdescription, current_product_list.Merk, \r\ncurrent_product_list.sku;', 14),
('shp_cnvrt', 'INNER JOIN orders ON orders.orderID = order_details.orderID\r\nSET to_deliver=quantity\r\nWHERE (Trackingnummer = '''' OR isnull(Trackingnummer)) AND confirmed_yn = ''-1'' AND\r\nContactsOrderID not like ''%offerte%'';\r\nselect * from orders where ShipID = '''';', 15),
('omzet top 100', 'SELECT (Sum(invoices.Invoice_total)+Sum(invoices.Invoice_BTW)) AS totaal, contacts.CompanyName, contacts.ContactID\r\nFROM contacts RIGHT JOIN invoices ON contacts.ContactID = invoices.CustomerID\r\nWHERE YEAR(invoices.Invoice_date) = YEAR(now(-1)) \r\nGROUP BY contacts.ContactID \r\nOrder by totaal DESC', 16),
('klantnamen', 'select DISTINCT contacts.CompanyName\r\nFROM contacts\r\nINNER JOIN invoices ON invoices.customerID = contacts.ContactID\r\nWHERE YEAR(invoices.Invoice_date) = YEAR(now()) OR\r\n      YEAR(invoices.Invoice_date) = YEAR(now())-1\r\nORDER BY contacts.CompanyName;', 61),
('RMA coolblue', 'SELECT `RMA`.`ID`, `RMA`.`contacts_id`, `RMA_state`.`State_ID`, `RMA_state`.`State_text`, `RMA`.`Customer_ID`, \r\n`RMA`.`Date_done`, `RMA`.`Date_in` , RMA_product_customer.State_text as customer_State, ProductName,\r\nRMA_actions.Notes\r\nFROM `iwex`.`RMA` `RMA` \r\nINNER JOIN `iwex`.`RMA_state` `RMA_state` ON `RMA_state`.`State_ID` = `RMA`.`State`\r\nINNER JOIN RMA_product_customer on RMA.product_customer = RMA_product_customer.State_ID\r\nINNER JOIN current_product_list on RMA.ProductID = current_product_list.ProductID\r\nINNER JOIN RMA_actions on RMA.ID = RMA_actions.RMAID\r\nWHERE  \r\n`RMA`.`contacts_id` = 88 AND \r\n`RMA_state`.`State_ID` <> 9 AND\r\nRMA.product_customer = 1\r\nGROUP BY RMA.ID\r\nORDER BY RMA.ID,RMA_state.State_text', 17),
('Test Ship Cancel products', 'select ProductID, shipmentID, UnitsSold, Cancel\r\nfrom inventory_transactions\r\ninner join shipments ON Shipment_ID = shipmentID\r\nwhere Cancel = 1;', 18),
('fill_po_details', 'delete from po_details;\r\n\r\nINSERT INTO po_details (poID, podate, productID, unitprice, quantity, to_deliver, tax_percentage, invoice)\r\nSELECT inventory_transactions.PurchaseOrderID, TransactionDate, ProductID, UnitPrice, UnitsOrdered, \r\n(UnitsOrdered-UnitsReceived) as to_deliver, (if(btw_yn,''0,19'',''0'')) as tax_percentage, TransactionDescription \r\nFROM inventory_transactions \r\nINNER JOIN purchase_orders ON inventory_transactions.PurchaseOrderID = purchase_orders.PurchaseOrderID\r\nGROUP BY inventory_transactions.PurchaseOrderID,inventory_transactions.ProductID\r\nORDER BY inventory_transactions.PurchaseOrderID;', 19),
('bestellen', 'SELECT order_details.ProductID, merk, current_product_list.ProductName, stock, SUM(to_deliver) as to_deliver, ReorderLevel  \r\nFROM current_product_list  \r\nLEFT JOIN order_details ON current_product_list.ProductID = order_details.ProductID \r\nINNER JOIN orders ON orders.OrderID = order_details.OrderID\r\n                     AND (orders.Confirmed_yn = ''1'' OR orders.Confirmed_yn = ''-1'') AND (NOT Complete_yn OR Complete_yn IS NULL)\r\nWHERE Discontinued_yn = 0 \r\nAND (stock < ReorderLevel \r\n     OR \r\n    to_deliver > stock )\r\nGROUP BY order_details.ProductID\r\nORDER BY merk, order_details.ProductID;', 20),
('po_shipadres', 'UPDATE purchase_orders \r\nINNER JOIN Adressen ON (purchase_orders.ShipName = Adressen.Naam) AND (purchase_orders.ShipContactID = Adressen.ContactID) \r\nSET purchase_orders.ship_adresID = Adressen.AdresID;', 21),
('omzet_totaal 2004', 'SELECT Sum(invoices.Invoice_total) AS SumOfInvoice_total, \r\nSum(invoices.Invoice_BTW) AS SumOfInvoice_BTW, \r\nSum(Invoice_total+Invoice_BTW) AS totaal\r\nFROM invoices \r\nWHERE invoices.Invoice_date >= \\''2004-01-01\\'' And invoices.Invoice_date <= \\''2004-12-31\\''\r\nOrder by Invoice_date;', 22),
('omzet_ontwikkeling', 'SELECT \r\n DATE_FORMAT(Invoice_Date,\\''%b %y\\'') as month, \r\n Sum(invoices.Invoice_total) AS SumOfInvoice_total, \r\n Sum(invoices.Invoice_BTW) AS SumOfInvoice_BTW, \r\n Sum(Invoice_total+Invoice_BTW) AS totaal\r\nFROM invoices \r\nWHERE \r\n YEAR(Invoice_Date) = YEAR(NOW()) OR\r\n YEAR(Invoice_Date) = YEAR(NOW())-1\r\nGROUP BY month \r\nORDER BY Invoice_Date DESC;', 23),
('RMA responsetime', 'SELECT  DATE_FORMAT(RMA.Date_in,''%b %y'') as month,\r\nAVG(TO_DAYS(RMA_actions.ActionDate)-TO_DAYS(RMA.Date_in)) as ''Avg Responsetime''\r\nFROM `iwex`.`RMA` `RMA` \r\nINNER JOIN `iwex`.`RMA_state` `RMA_state` ON `RMA_state`.`State_ID` = `RMA`.`State`\r\nINNER JOIN RMA_product_customer on RMA.product_customer = RMA_product_customer.State_ID\r\nINNER JOIN current_product_list on RMA.ProductID = current_product_list.ProductID\r\nINNER JOIN RMA_actions on RMA.ID = RMA_actions.RMAID\r\nINNER JOIN RMA_subject on RMA_actions.Subject = RMA_subject.Subject_ID AND RMA_subject.Subject_ID = 4\r\nWHERE  \r\nRMA.contacts_id = 88  AND\r\nRMA.Date_in > ''2004-01-01''\r\nGroup BY month\r\norder by RMA.Date_in', 24),
('Update leadtek', 'Update current_product_list\r\nSET\r\nSelling_price = ''14'',\r\nSelling_price_10 = ''11'',\r\nSelling_price_50 = ''10'',\r\nSelling_price_100 = ''9,50'',\r\nRetail_price_ex = ''24,37''\r\nWHERE ProductName like ''%GPSmuis verloop %''', 25),
('TomTom customers', 'select Distinctrow \r\n   contacts.ContactID, \r\n   CompanyName,\r\n   SUM(inventory_transactions.UnitsSold*inventory_transactions.UnitPrice) as Turnover\r\nFROM contacts \r\nInner Join orders on orders.contactID = contacts.ContactID\r\nINNER JOIN order_details ON orders.OrderID = order_details.OrderID\r\nINNER JOIN inventory_transactions ON inventory_transactions.OrderDetailsID = order_details.OrderDetailsID\r\nINNER JOIN current_product_list c on c.ProductID = order_details.ProductID\r\nWhere merkID = \\''22\\''\r\nAND YEAR(orders.OrderDate) = YEAR(NOW())\r\nGROUP BY CompanyName\r\nOrder by Turnover DESC;', 26),
('ontvangen buiten NL', 'SELECT ContactID, CompanyName, contacts.Country, eu_country, bank_accounts.account_name, \r\n    bank_transactions.amount, transaction_date, sum(link_amount) AS geboekt\r\nFROM bank_transactions\r\nLEFT JOIN contacts ON contacts.ContactID = CustomerID\r\nLEFT JOIN country ON contacts.Country = country.code\r\nLEFT JOIN bank_accounts ON bank_account_id = account_id\r\nLEFT JOIN payments_link ON payments_link.BankTransactionId = bank_transactions.transaction_id\r\nWHERE contacts.Country <> ''NL'' \r\n    AND QUARTER(transaction_date) = 4 \r\n    AND YEAR(transaction_date) = 2004 \r\nGROUP BY transaction_id\r\nORDER BY transaction_date, name', 27),
('Delete old delete e-mail', 'DELETE FROM xeoport WHERE cancel=1 AND (to_days(curdate()) - to_days(xp_date_iso)) > 60;\r\nDELETE FROM info WHERE cancel=1 AND (to_days(curdate()) - to_days(xp_date_iso)) > 60;\r\nDELETE FROM admin WHERE cancel=1 AND (to_days(curdate()) - to_days(xp_date_iso)) > 60;\r\nDELETE FROM fred WHERE cancel=1 AND (to_days(curdate()) - to_days(xp_date_iso)) > 60;\r\nDELETE FROM mathieu WHERE cancel=1 AND (to_days(curdate()) - to_days(xp_date_iso)) > 60;\r\nDELETE FROM peter WHERE cancel=1 AND (to_days(curdate()) - to_days(xp_date_iso)) > 60;\r\nDELETE FROM petra WHERE cancel=1 AND (to_days(curdate()) - to_days(xp_date_iso)) > 60;\r\nDELETE FROM rma WHERE cancel=1 AND (to_days(curdate()) - to_days(xp_date_iso)) > 60;\r\nDELETE FROM henri WHERE cancel=1 AND (to_days(curdate()) - to_days(xp_date_iso)) > 60;', 28),
('Verkochten artikeln aan klant', 'select ProductName, ProductID, Quantity, to_deliver, UnitPrice, \r\norders.OrderDate, orders.OrderID\r\nfrom order_details \r\ninner join orders on order_details.OrderID = orders.OrderID\r\nwhere orders.ContactID = 871 and (ProductID = 992445 or ProductID = 992452)', 29),
('sales out tomtom', 'SELECT distinctrow DATE_FORMAT(inventory_transactions.TransactionDate,''%m'') as month, \r\nCompanyName, ProductName, sum(UnitsSold) as total, current_product_list.externalID \r\nfrom inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIn orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE merkID=''22'' \r\n AND MONTH( transactiondate ) =  (MONTH( NOW( ))-1) AND YEAR(transactiondate) = 2005\r\n AND UnitsSold > 2\r\nGROUP BY month, contacts.contactID, current_product_list.externalID \r\nOrder by contacts.contactID, month', 30),
('voorraad for connected', 'SELECT current_product_list.ProductID as ''Iwex ID'', current_product_list.externalID, current_product_list.ProductName, Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)) AS Stock, current_product_list.Merk FROM current_product_list INNER JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID WHERE stock_owner_id = ''474'' GROUP BY current_product_list.ProductID, current_product_list.ProductName, current_product_list.ReorderLevel, current_product_list.LeadTime, current_product_list.Productdescription, current_product_list.Merk, current_product_list.sku;', 31),
('Sales out $ top 25 YTD', 'SELECT DISTINCTROW current_product_list.ProductID, name, current_product_list.ProductName, current_product_list.ExternalID, SUM(UnitsSold*UnitPrice) as Sold\r\nFROM current_product_list \r\nINNER JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID\r\nINNER JOIN brand ON current_product_list.merkID = brand_id\r\nWHERE YEAR(inventory_transactions.transactiondate) = YEAR(NOW())\r\nGROUP BY current_product_list.ProductID, current_product_list.ProductName, \r\ncurrent_product_list.ReorderLevel, current_product_list.LeadTime, \r\ncurrent_product_list.Productdescription, current_product_list.Merk, \r\ncurrent_product_list.sku\r\nORDER BY Sold DESC\r\nLIMIT 25;', 102),
('discontinued no stock', '#Update current_product_list\r\n#INNER JOIN product_stock ON product_stock.Product_ID = current_product_list.ProductID\r\n#SET pricelist_yn=0\r\n#where discontinued_yn=1 and stock<=0;\r\n\r\nselect ProductID, ProductName, stock \r\nfrom current_product_list\r\nINNER JOIN product_stock ON product_stock.Product_ID = current_product_list.ProductID\r\nwhere pricelist_yn=1 AND discontinued_yn=1 and stock<=0;', 33),
('Covertec sales out', 'SELECT distinctrow DATE_FORMAT(inventory_transactions.TransactionDate,\\''%y%m\\'') as month, \r\nCompanyName, ProductName, sum(UnitsSold) as total, current_product_list.externalID \r\nfrom inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIn orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nwhere merkID=\\''73\\'' \r\nGROUP BY month, contacts.contactID, current_product_list.externalID \r\nOrder by contacts.contactID, month, ProductName;', 34),
('Consigment', 'SELECT inventory_transactions.ProductID, ProductName, sum(UnitsSold), orders.OrderID\r\nFROM inventory_transactions\r\nINNER JOIN orders on orders.OrderID = inventory_transactions.OrderID\r\nINNER JOIN current_product_list on current_product_list.ProductID = inventory_transactions.ProductID \r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE consignment_order\r\nGROUP BY CompanyName, inventory_transactions.ProductID\r\nORDER BY CompanyName', 35),
('inv_tr_invoices', 'UPDATE inventory_transactions\r\nINNER JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN invoices ON shipments.invoiceID = invoices.InvoiceID\r\nSET inventory_transactions.InvoiceID = invoices.InvoiceID', 36),
('tomtom ytd sales out', 'SELECT DATE_FORMAT(shipments.Ship_Date,\\''%m\\'') as month, \r\nCompanyName, current_product_list.externalID, sum(UnitsSold) as total\r\nfrom inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nINNER JOIN shipments ON shipments.Shipment_ID = inventory_transactions.shipmentID\r\nWHERE merkID=\\''22\\'' \r\n AND YEAR(Ship_Date) = YEAR(now())\r\n        AND MONTH(Ship_Date) = MONTH(now())\r\n\r\nGROUP BY month, contacts.contactID, current_product_list.externalID\r\nOrder by  month, contacts.contactID', 37),
('backorder adres change', 'UPDATE orders SET ShipID = 2509\r\nWHERE ContactID = 88 AND NOT Complete_yn AND confirmed_yn', 38),
('tomtom ytd sales out detail', 'SELECT DISTINCTROW DATE_FORMAT(Ship_Date,\\''%d-%m-%y\\'') as date, \r\n CompanyName, \r\n current_product_list.ProductName, \r\n  sum(UnitsSold) as total, \r\n order_details.UnitPrice as Verkoop,   \r\n  SUM(order_details.UnitPrice*UnitsSold) as turnover, \r\n  current_product_list.externalID \r\nFROM inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN order_details on orders.OrderID=order_details.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nINNER JOIN shipments ON shipments.Shipment_ID = inventory_transactions.shipmentID\r\nWHERE merkID=\\''22\\'' \r\n AND YEAR(Ship_Date) = YEAR(now())\r\n        AND (Supplier = \\''647\\'' OR Supplier=\\''4210\\'')\r\n        AND QUARTER(Ship_Date) < QUARTER(NOW())\r\nGROUP BY inventory_transactions.TransactionDate, contacts.contactID, inventory_transactions.ProductID \r\nORDER BY inventory_transactions.TransactionDate, contacts.CompanyName, date ASC ', 40),
('Media Markt Keomo overzicht', 'SELECT distinctrow  \r\n contacts.CompanyName,\r\n YEAR(orders.OrderDate) as Y,\r\n  QUARTER(orders.OrderDate) as Q,\r\n sum(if(Quantity>0,(Quantity),0)) as \\''+\\'',\r\n  sum(if(Quantity<0,(Quantity),0)) as \\''-\\'',\r\n  SUM(Quantity*order_details.UnitPrice) as Euro,\r\n    order_details.ProductID,\r\n  current_product_list.ProductName\r\nFROM order_details\r\nINNER JOIN orders ON orders.orderID = order_details.OrderID\r\nINNER JOIN current_product_list on order_details.ProductID=current_product_list.ProductID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nINNER JOIN branches ON branches.BrancheContactID = contacts.ContactID AND MainContactID = 3949\r\nWHERE MerkID = 88\r\nGROUP BY  contacts.CompanyName, YEAR(orders.OrderDate), QUARTER(orders.OrderDate), order_details.ProductID\r\nOrder by contacts.CompanyName, orders.OrderDate;', 187),
('Searchdog omzet vorige maand', 'SELECT DATE_FORMAT(Invoice_date,\\''%b %Y\\'') as month,\r\nSum(invoices.Invoice_total) AS Omzet,\r\nSum(invoices.Invoice_total)/100*0.95 AS \\"0,95% rebate\\"\r\nFROM invoices\r\nWHERE invoices.customerID=\\''3778\\'' AND \r\n invoices.Shipname NOT LIKE \\"%Searchdog%\\"\r\nGROUP BY month\r\nOrder by Invoice_date;', 43),
('Searchdog omzet per BP', 'SELECT DATE_FORMAT(Invoice_date,\\''%b %Y\\'') as month, invoices.Shipname, sum(invoices.invoice_total) as omzet\r\nfrom invoices\r\nLEFT JOIN shipments ON shipments.Shipment_ID = invoices.ShipmentID\r\nWHERE  invoices.CustomerID =\\''3778\\'' AND \r\n  MONTH( Invoice_date  ) =  (MONTH( NOW( ))-1) AND \r\n YEAR( Invoice_date ) = 2005 AND\r\n invoices.Shipname NOT LIKE \\"%Searchdog%\\"\r\nGROUP BY invoices.Shipname\r\nOrder by  omzet DESC, invoices.Shipname ASC;', 44),
('Searchdog GO', 'SELECT DATE_FORMAT(transactiondate,\\''%Y-%m\\'') as month,\r\n ProductName, sum(UnitsSold) as total, current_product_list.externalID\r\nfrom inventory_transactions\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE orders.ContactID =\\''3778\\'' AND merkID=\\''22\\'' \r\nAND (inventory_transactions.ProductID = 992553\r\nOR inventory_transactions.ProductID = 992554\r\nOR inventory_transactions.ProductID = 992555\r\nOR inventory_transactions.ProductID = 993037\r\nOR inventory_transactions.ProductID = 993013\r\nOR inventory_transactions.ProductID = 992965)\r\nGROUP BY month, contacts.contactID, current_product_list.externalID\r\nOrder by month, contacts.contactID', 45),
('ViaMichelin sales out MM', 'SELECT distinctrow DATE_FORMAT(transactiondate,\\''%Y%b\\'') as date, \r\n                Adressen.naam, \r\n               ProductName, \r\n               sum(UnitsSold) as total, \r\n               current_product_list.externalID, \r\n               brand.name\r\nFROM inventory_transactions\r\nINNER JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIn orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE (YEAR( transactiondate ) = YEAR(NOW())-1 OR YEAR( transactiondate ) = YEAR(NOW()))\r\n  AND contacts.CompanyName LIKE \\''%media%markt%\\''\r\n AND current_product_list.MerkID = 71\r\nGROUP BY Adressen.naam, current_product_list.externalID\r\nOrder by  date, Adressen.naam, current_product_list.externalID;', 73),
('Searchdog Go en ONE ship dec 05', 'SELECT distinctrow DATE_FORMAT(transactiondate,\\''%b %Y\\'') as date, Adressen.naam, \r\nProductName, sum(UnitsSold) as total, current_product_list.externalID\r\nfrom inventory_transactions\r\nINNER JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIn orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE orders.ContactID =\\''3778\\'' AND MONTH( transactiondate  ) =  1 AND YEAR( transactiondate ) = 2006 AND\r\n(inventory_transactions.ProductID = 992553\r\nOR inventory_transactions.ProductID = 992554\r\nOR inventory_transactions.ProductID = 992555\r\nOR inventory_transactions.ProductID = 992965\r\nOR inventory_transactions.ProductID = 992975\r\nOR inventory_transactions.ProductID = 993037\r\nOR inventory_transactions.ProductID = 993013)\r\nGROUP BY Adressen.naam, current_product_list.externalID\r\nOrder by  Adressen.naam, date, current_product_list.externalID;', 65),
('marge ruw per maand', 'SELECT distinctrow \r\n  DATE_FORMAT(inventory_transactions.TransactionDate,\\''%m\\'') as month, \r\n sum(UnitsSold*order_details.UnitPrice) as sold,\r\n sum(UnitsReceived*inventory_transactions.UnitPrice) as purchased,\r\n sum(UnitsSold*order_details.UnitPrice)-sum(UnitsReceived*inventory_transactions.UnitPrice) as margin\r\nFROM inventory_transactions \r\nLEFT JOIN order_details ON inventory_transactions.OrderID = order_details.OrderID AND\r\n order_details.ProductID = inventory_transactions.ProductID\r\nWHERE YEAR(transactiondate) = (year( NOW()))\r\nGROUP BY month \r\nOrder by month', 46),
('tomtom sales out YTD', 'SELECT DISTINCTROW DATE_FORMAT(shipments.Ship_Date,\\''%d-%m-%Y\\'') as date, \r\n  CompanyName, \r\n current_product_list.ProductName, \r\n  sum(UnitsSold) as total, \r\n order_details.UnitPrice as Verkoop,   \r\n  SUM(order_details.UnitPrice*UnitsSold) as turnover, \r\n  current_product_list.externalID \r\nFROM inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\n        AND NOT orders.rma_yn\r\nINNER JOIN order_details on orders.OrderID=order_details.OrderID\r\n AND  inventory_transactions.ProductID=order_details.ProductID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nINNER JOIN shipments ON shipments.Shipment_ID = inventory_transactions.shipmentID\r\nWHERE \r\n  YEAR(shipments.Ship_Date) = YEAR(now()) \r\n  AND (Supplier=647 OR Supplier=4210) \r\nGROUP BY date, contacts.contactID, inventory_transactions.ProductID \r\nOrder by inventory_transactions.TransactionDate,  current_product_list.externalID', 47),
('Voorraad $ top', 'SELECT ProductID, ProductName, \r\n  Purchase_price_home as kostprijs,\r\n  sum(stock * Purchase_price_home) as waarde, \r\n  stock as \\''#\\'', \r\n  location\r\nFROM current_product_list\r\nLEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = 802\r\nLEFT JOIN location ON location_ID = ID\r\nWHERE (NOT Discontinued_yn AND (sku=1 OR sku=0) \r\n              OR Pricelist_yn AND Discontinued_yn AND location_ID\r\n              OR stock AND (sku=1 OR sku=0))\r\n      AND NOT CategoryID = 12\r\n      AND stock > 0\r\nGROUP BY current_product_list.ProductID\r\nORDER BY waarde Desc\r\n', 48),
('voorraad # top 20', 'SELECT DISTINCTROW current_product_list.ProductID, current_product_list.ProductName, current_product_list.ExternalID,\r\nSum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)) AS Stock\r\nFROM current_product_list \r\nINNER JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID\r\nGROUP BY current_product_list.ProductID, current_product_list.ProductName, \r\ncurrent_product_list.ReorderLevel, current_product_list.LeadTime, \r\ncurrent_product_list.Productdescription, current_product_list.Merk, \r\ncurrent_product_list.sku\r\nORDER BY stock DESC\r\nLIMIT 20;', 50),
('Special Products', 'SELECT ProductID, ProductName \r\nFROM current_product_list\r\nWHERE special', 52),
('Copaco TomTom prijslijst EAN codes', 'SELECT current_product_list.ProductID, current_product_list.ExternalID, ProductName, EAN,\r\n  IF(MMprice.amount,MMprice.amount,pricing.amount) as inkoop, Retail_price_ex as RRP\r\nFROM current_product_list\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN categories ON current_product_list.CategoryID = categories.CategoryID\r\nLEFT JOIN catalogusdetails ON current_product_list.ProductID = catalogusdetails.ProductID\r\nLEFT JOIN catalogus ON catalogusdetails.CatalogusID = catalogus.CatalogusID\r\nLEFT JOIN pricing ON  current_product_list.ProductID = pricing.ProductID\r\n            AND (pricing.ContactID=0)\r\n             AND (pricing.start_date <= NOW() || isnull(pricing.start_date) || pricing.start_date=0) \r\n                      AND (pricing.end_date >= NOW() || isnull(pricing.end_date) || pricing.end_date=0)\r\n                      AND (pricing.start_number <= \\''100\\'' || isnull(pricing.start_number) || pricing.start_number=0)\r\n                      AND (pricing.end_number >= \\''101\\'' || isnull(pricing.end_number) || pricing.end_number=0)\r\n                      AND pricing.price_type=\\''1\\'' \r\nLEFT JOIN pricing MMprice ON  current_product_list.ProductID = MMprice.ProductID\r\n            AND (MMprice.ContactID=\\''2145\\'')\r\n            AND (MMprice.start_date <= NOW() || isnull(MMprice.start_date) || MMprice.start_date=0) \r\n                      AND (MMprice.end_date >= NOW() || isnull(MMprice.end_date) || MMprice.end_date=0)\r\n                      AND (MMprice.start_number <= \\''1\\'' || isnull(MMprice.start_number) || MMprice.start_number=0)\r\n                      AND (MMprice.end_number >= \\''1\\'' || isnull(MMprice.end_number) || MMprice.end_number=0)\r\n                      AND MMprice.price_type=\\''1\\'' \r\nWHERE (catalogus.ContactID=\\''2145\\'' OR MerkID=\\''22\\'') AND Pricelist_yn\r\nGROUP BY current_product_list.ProductID\r\nORDER BY brand.name, current_product_list.ProductID', 53),
('Keomo sales out ytd', 'SELECT distinctrow DATE_FORMAT(inventory_transactions.TransactionDate,\\''%Y%m\\'') as month, \r\nCompanyName, ProductName, sum(UnitsSold) as total, current_product_list.externalID \r\nfrom inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIn orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE merkID=\\''88\\'' AND\r\n   YEAR(transactiondate) = YEAR(now())\r\nGROUP BY month, contacts.contactID, current_product_list.externalID \r\nOrder by contacts.contactID, month', 54),
('Keomo turnover ytd detail', 'SELECT distinctrow \r\n  DATE_FORMAT(inventory_transactions.TransactionDate,\\''%Y%m\\'') as month,\r\n  SUM(UnitsSold) as Aantal, \r\n  SUM(UnitsSold*UnitPrice) as Euros\r\nFROM inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nWHERE merkID=\\''88\\'' AND\r\n   (YEAR(transactiondate) = YEAR(now()) OR YEAR(transactiondate) = (YEAR(now())-1))\r\nGROUP BY month\r\nORDER BY month', 55),
('Merken op de prijslijst', 'SELECT DISTINCTROW current_product_list.Merk, MerkID, pricelist_yn\r\nFROM current_product_list\r\nORDER BY pricelist_yn, Merk', 56),
('Keomo Trunover ytd', 'SELECT distinctrow \r\n  SUM(UnitsSold) as Aantal, \r\n  SUM(UnitsSold*UnitPrice) as Euros\r\nFROM inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nWHERE merkID=\\''88\\'' AND\r\n   YEAR(transactiondate) = YEAR(now()) ', 57),
('Orders Typed by (2007)', 'SELECT employees.EmployeeID, employees.FirstName, count(*) as aantal\r\nFROM orders\r\nLEFT JOIN employees ON orders.employee=employees.EmployeeID\r\nWHERE YEAR(OrderDate) = \\''2007\\''\r\nGROUP BY employee\r\nORDER BY aantal DESC;', 58),
('Orders Typed by', 'SELECT employees.EmployeeID, employees.FirstName, OrderID\r\nFROM orders\r\nLEFT JOIN employees ON orders.employee=employees.EmployeeID\r\nWHERE YEAR(OrderDate) = \\''2005\\'' \r\nGROUP BY employee\r\n', 59),
('voorraadlijst', 'SELECT \r\n  ExternalID, \r\n  ProductName,   \r\n  stock as \\''#\\'', \r\n  Purchase_price_home as price, \r\n  ROUND(sum(stock * Purchase_price_home*0.8),2) as total\r\nFROM current_product_list\r\nLEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = 802\r\nLEFT JOIN location ON location_ID = ID\r\nWHERE stock\r\nGROUP BY current_product_list.ProductID\r\nHAVING stock\r\nORDER BY total Desc', 60),
('mailing media markt', 'SELECT DISTINCTROW contacts.ContactID, contacts.CompanyName, Personen.email\r\nFROM iwex.contacts\r\nLEFT JOIN iwex.Personen ON contacts.ContactID = Personen.ContactID\r\n                  AND Personen.Personen_type_ID != \\''8\\''\r\nWHERE Personen.email <> \\''\\'' \r\n      AND Personen.mailing_yn\r\n      AND CompanyName like \\''%media Markt%\\''\r\nORDER BY contacts.CompanyName', 262),
('voorraad detail2', 'SELECT \r\n  ProductID,\r\n  brand.name,\r\n  externalID,\r\n  stock as \\''#\\'', \r\n  ProductName,\r\n  (stock * Purchase_price_home) as kostprijs\r\n#  location\r\nFROM current_product_list\r\nINNER JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = 802\r\nLEFT JOIN location ON location_ID = ID\r\nINNER JOIN brand ON current_product_list.MerkID = brand.brand_id\r\nWHERE stock\r\nORDER BY current_product_list.ProductID', 263),
('voorraad owner keomo', 'SELECT current_product_list.ProductID as \\''Iwex ID\\'', current_product_list.externalID, current_product_list.ProductName, \r\ncurrent_product_list.Merk, \r\nlocation, stock,\r\nSum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)) AS CalcStock,\r\nPurchase_price_home\r\nFROM current_product_list \r\nINNER JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID \r\nLEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND product_stock.owner_id = stock_owner_id\r\nLEFT JOIN location ON product_stock.location_id = location.ID\r\nWHERE stock_owner_id = \\''4275\\'' \r\nGROUP BY current_product_list.ProductID, current_product_list.ProductName, current_product_list.ReorderLevel, current_product_list.LeadTime, current_product_list.Productdescription, current_product_list.Merk, current_product_list.sku\r\nORDER BY stock*Purchase_price_home DESC;', 96),
('locaties', 'SELECT * FROM location', 62),
('Searchdog omzet per BP TT', 'SELECT DATE_FORMAT(Invoice_date,\\''%b %Y\\'') as month, invoices.Shipname, sum(invoices.invoice_total) as omzet\r\nfrom invoices\r\nINNER JOIN shipments ON shipments.Shipment_ID = invoices.ShipmentID\r\nINNER JOIN inventory_transactions ON inventory_transactions.ShipmentID = invoices.ShipmentID\r\nINNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID\r\nWHERE invoices.CustomerID =\\''3778\\'' AND \r\n MONTH( Invoice_date  ) =  11 AND \r\n YEAR( Invoice_date ) = 2005 AND\r\n invoices.Shipname NOT LIKE \\"%Searchdog%\\" AND\r\n        merkID = \\''22\\''\r\nGROUP BY invoices.Shipname\r\nOrder by  omzet DESC, invoices.Shipname ASC;', 63),
('Revah prijslijst', 'SELECT current_product_list.ProductID as ID, EAN,\r\n    ExternalID, ProductName, standard.amount AS Price_100, \r\n    pricing.amount AS \\''specialprice100+\\'', Retail_Price_ex AS RRP\r\nFROM current_product_list\r\nLEFT JOIN pricing ON (current_product_list.ProductID = pricing.ProductID\r\n    AND (pricing.ContactID=\\''1689\\'')\r\n    AND (pricing.start_date <= DATE(NOW()) || isnull(pricing.start_date) || pricing.start_date=0) \r\n    AND (pricing.end_date >= DATE(NOW()) || isnull(pricing.end_date) || pricing.end_date=0)\r\n    AND (pricing.start_number || isnull(pricing.start_number) || pricing.start_number=0)\r\n    AND (pricing.end_number >= 0 || isnull(pricing.end_number) || pricing.end_number=0)\r\n    AND pricing.price_type=\\''1\\'')\r\nLEFT JOIN  pricing standard ON (current_product_list.ProductID = standard.ProductID\r\n    AND (standard.ContactID=\\''0\\'')\r\n    AND (standard.start_date <= DATE(NOW()) || isnull(standard.start_date) || standard.start_date=0) \r\n    AND (standard.end_date >= DATE(NOW()) || isnull(standard.end_date) || standard.end_date=0)\r\n    AND (standard.start_number >= 100 || isnull(standard.start_number) || standard.start_number=0)\r\n    AND (standard.end_number >= 0 || isnull(standard.end_number) || standard.end_number=0)\r\n    AND standard.price_type=\\''1\\'')\r\n\r\nWHERE MerkID=\\''22\\'' AND Pricelist_yn\r\nORDER BY ProductName', 64),
('Media Markt Merken', 'SELECT distinctrow DATE_FORMAT(transactiondate,\\''%Y\\'') as date,  sum(UnitsSold) as brandtotal, brand.name\r\nFROM inventory_transactions\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIn orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE (YEAR( transactiondate ) = 2005 OR YEAR( transactiondate ) = 2006 OR YEAR( transactiondate ) = 2007)\r\n AND contacts.CompanyName LIKE \\''%media%markt%\\''\r\nGROUP BY date, brand.name\r\nOrder by  date;', 69),
('TomTom omzet SO mediamarkt', 'SELECT DISTINCTROW DATE_FORMAT(TransactionDate,\\''%Y %m\\'') as month, sum(inventory_transactions.UnitPrice*UnitsSold) as \\''omzet tomtom ex btw\\'', contacts.CompanyName\r\nFROM inventory_transactions \r\nINNER JOIN current_product_list ON inventory_transactions.ProductID = current_product_list.ProductID\r\nINNER JOIN shipments ON inventory_transactions.ShipmentID= shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID=Adressen.AdresID\r\nINNER JOIN contacts ON Adressen.ContactID=contacts.ContactID\r\nWHERE current_product_list.MerkID = \\''22\\'' AND \r\n  YEAR( TransactionDate ) = YEAR(now())                            \r\n  AND contacts.CompanyName LIKE \\''%media%markt%\\''\r\n  AND (supplier = \\''647\\'' OR supplier = \\''4210\\'')\r\nGROUP BY month, contacts.CompanyName\r\nORDER BY contacts.CompanyName ASC,month DESC;', 67),
('Media Markt geshipped', 'SELECT distinctrow DATE_FORMAT(transactiondate,\\''%Y%m\\'') as date, Adressen.naam, contacts.CompanyName,  \r\nProductName, sum(UnitsSold) as total, current_product_list.externalID, brand.name\r\nFROM inventory_transactions\r\nINNER JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE (YEAR( transactiondate ) = 2005 OR YEAR( transactiondate ) = 2006)\r\n AND Adressen.naam LIKE \\''%media%markt%\\''\r\nGROUP BY Adressen.naam, current_product_list.externalID\r\nOrder by  date DESC, Adressen.naam, current_product_list.externalID;', 68),
('Openstaande facturen eind van het j', 'SELECT invoices.companyName, invoices.CustomerID, invoices.InvoiceID, Invoice_date,\r\n    Invoice_total AS exc_btw, (Invoice_total + Invoice_BTW) AS amount, paid_amount AS paid_amount, paid_date,\r\n   kvk_number, CreditLimit, invoices.Country\r\n   FROM invoices \r\n    INNER JOIN contacts ON invoices.CustomerID = contacts.ContactID\r\nWHERE  YEAR(Invoice_date) = YEAR(NOW())-1  \r\n        AND (NOT paid_yn \r\n            OR \r\n             paid_yn AND YEAR(paid_date)=YEAR(NOW()))\r\nORDER BY Country, companyName', 70),
('Omzet per jaar', 'SELECT YEAR(Invoice_date) AS year, Sum(invoices.Invoice_total) AS EXCL_BTW, \r\nSum(invoices.Invoice_BTW) AS BTW, \r\nSum(Invoice_total+Invoice_BTW) AS totaal\r\nFROM invoices \r\nGROUP BY YEAR(Invoice_date);', 71),
('Sales out Viamichelin', 'SELECT distinctrow DATE_FORMAT(transactiondate,\\''%Y%b\\'') as date, \r\n               Adressen.naam, \r\n               ProductName, \r\n               sum(UnitsSold) as total, \r\n               current_product_list.externalID, \r\n               brand.name\r\nFROM inventory_transactions\r\nINNER JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIn orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE (YEAR( transactiondate ) = YEAR(NOW())-1 OR YEAR( transactiondate ) = YEAR(NOW()))\r\n  AND current_product_list.MerkID = 71\r\n        AND current_product_list.ProductName LIKE \\"%x-930%\\"\r\nGROUP BY Adressen.naam, current_product_list.externalID\r\nOrder by  date, Adressen.naam, current_product_list.externalID;', 72),
('Sales out $ top 25', 'SELECT DISTINCTROW current_product_list.ProductID, name, current_product_list.ProductName, current_product_list.ExternalID, SUM(UnitsSold*UnitPrice) as Sold\r\nFROM current_product_list \r\nINNER JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID\r\nINNER JOIN brand ON current_product_list.merkID = brand_id\r\nGROUP BY current_product_list.ProductID, current_product_list.ProductName, \r\ncurrent_product_list.ReorderLevel, current_product_list.LeadTime, \r\ncurrent_product_list.Productdescription, current_product_list.Merk, \r\ncurrent_product_list.sku\r\nORDER BY Sold DESC\r\nLIMIT 20;', 74),
('sales out # top 20', 'SELECT DISTINCTROW current_product_list.ProductID, current_product_list.ProductName, current_product_list.ExternalID, SUM(UnitsSold) as Sold\r\nFROM current_product_list \r\nINNER JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID\r\nGROUP BY current_product_list.ProductID, current_product_list.ProductName, \r\ncurrent_product_list.ReorderLevel, current_product_list.LeadTime, \r\ncurrent_product_list.Productdescription, current_product_list.Merk, \r\ncurrent_product_list.sku\r\nORDER BY Sold DESC\r\nLIMIT 20;', 75),
('old margin', 'SELECT DATE_FORMAT(inventory_transactions.transactiondate, \\"%Y-%m\\") as \\''Year_Month\\'',    \r\n  ROUND(sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage)),2) as omzet, \r\n sum((UnitsSold)*(UnitCost)) as inkoop, \r\n ROUND(sum(cost_percentage*UnitsSold),2) as extra_cost,\r\n  ROUND(sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage-UnitCost)) ,2)as marge,\r\n ROUND(100*((sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage))) / (sum((UnitsSold)*(UnitCost)))-1),2) as \\''%\\'',\r\n  ROUND(sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage-UnitCost))*0.0095 ,2) as \\"0,95%\\",\r\n ROUND(sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage-UnitCost))*0.012 ,2) as \\"1,2%\\"\r\nFROM inventory_transactions\r\nINNER JOIN orders on orders.OrderID =  inventory_transactions.OrderID\r\nINNER JOIN order_details ON inventory_transactions.orderdetailsID = order_details.OrderDetailsID\r\nINNER JOIN employees ON orders.employee = employees.EmployeeID\r\nWHERE order_details.stock_owner_id=802 \r\n AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT administration_order\r\n  AND NOT rma_yn\r\n  AND ( (YEAR(inventory_transactions.transactiondate) = YEAR(NOW()) -1 AND MONTH(inventory_transactions.transactiondate) = 12) OR\r\n       (YEAR(orders.OrderDate) = YEAR(NOW())))\r\nGROUP BY  YEAR(inventory_transactions.transactiondate) , MONTH(inventory_transactions.transactiondate)\r\nORDER BY  YEAR(inventory_transactions.transactiondate) , MONTH(inventory_transactions.transactiondate)', 76),
('Viamichelin Last week', 'SELECT distinctrow WEEK( transactiondate) as Week, \r\ncontacts.CompanyName as klant, Adressen.naam Shipadres, ProductName, sum(UnitsSold) as total,     current_product_list.externalID, brand.name\r\nFROM inventory_transactions\r\nINNER JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIn orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE (WEEK( transactiondate ) = WEEK(NOW())-1 AND\r\nYEAR( transactiondate ) = YEAR(NOW()))\r\n AND current_product_list.MerkID = 71\r\nGROUP BY Adressen.naam, current_product_list.externalID\r\nOrder by Adressen.naam, current_product_list.externalID;', 77),
('Viamichelin Sales Out', 'SELECT distinctrow DATE_FORMAT(transactiondate,\\''%Y%b\\'') as date, Adressen.naam, \r\nProductName, sum(UnitsSold) as total, current_product_list.externalID, \r\nbrand.name\r\nFROM inventory_transactions\r\nINNER JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIn orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE (YEAR( transactiondate ) = YEAR(NOW())-1 OR YEAR( transactiondate ) = YEAR(NOW()))\r\n AND current_product_list.MerkID = 71\r\nGROUP BY Adressen.naam, current_product_list.externalID\r\nOrder by  date, Adressen.naam, current_product_list.externalID;', 78),
('Media Markt Producten', 'SELECT distinctrow sum(UnitsSold) as brandtotal, brand.name, ProductName, current_product_list.ProductID, EAN, current_product_list.ExternalID\r\nFROM inventory_transactions\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIn orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE (YEAR( transactiondate ) = 2005 OR YEAR( transactiondate ) = 2006)\r\n AND contacts.CompanyName LIKE \\''%media%markt%\\''\r\nGROUP BY brand.name, ProductName\r\nOrder by  brand.name;', 79),
('Covertec ytd turnover', 'SELECT distinctrow merk,\r\n  DATE_FORMAT(inventory_transactions.TransactionDate,\\''%Y%m\\'') as month,\r\n  SUM(UnitsSold) as Aantal, \r\n  SUM(UnitsSold*UnitPrice) as Euros\r\nFROM inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nWHERE merkID=\\''73\\'' AND\r\n   (YEAR(transactiondate) = YEAR(now()) OR YEAR(transactiondate) = (YEAR(now())-1))\r\nGROUP BY month\r\nORDER BY month', 80),
('Media Markt Catalog', 'SELECT DISTINCTROW \r\n  NULL,\r\n  \\''iwex b.v.\\'' as leverancier,\r\n  brand.name as producent,\r\n  categories.CategoryName as \\''art_grp\\'',\r\n  1 as VPE,\r\n  1 as Pl,\r\n  current_product_list.externalID as \\''Ref. Prod\\'',\r\n  current_product_list.ProductID as \\''Iwex Ref.\\'', \r\n  current_product_list.ProductName, \r\n  current_product_list.Retail_price_ex*1.19 as Verkoop,\r\n  IF(MMprice.amount,MMprice.amount,pricing.amount) as inkoop,\r\n  current_product_list.EAN,\r\nIF(Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage))>=0,Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)),0) as voorraad\r\nFROM current_product_list\r\nLEFT JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN categories ON current_product_list.CategoryID = categories.CategoryID\r\nINNER JOIN catalogusdetails ON current_product_list.ProductID = catalogusdetails.ProductID\r\nINNER JOIN catalogus ON catalogusdetails.CatalogusID = catalogus.CatalogusID\r\nINNER JOIN pricing ON  current_product_list.ProductID = pricing.ProductID\r\n            AND (pricing.ContactID=0)\r\n             AND (pricing.start_date <= NOW() || isnull(pricing.start_date) || pricing.start_date=0) \r\n                      AND (pricing.end_date >= NOW() || isnull(pricing.end_date) || pricing.end_date=0)\r\n                      AND (pricing.start_number <= \\''1\\'' || isnull(pricing.start_number) || pricing.start_number=0)\r\n                      AND (pricing.end_number >= \\''1\\'' || isnull(pricing.end_number) || pricing.end_number=0)\r\n                      AND pricing.price_type=\\''1\\'' \r\nLEFT JOIN pricing MMprice ON  current_product_list.ProductID = MMprice.ProductID\r\n            AND (MMprice.ContactID=\\''3949\\'')\r\n            AND (MMprice.start_date <= NOW() || isnull(MMprice.start_date) || MMprice.start_date=0) \r\n                      AND (MMprice.end_date >= NOW() || isnull(MMprice.end_date) || MMprice.end_date=0)\r\n                      AND (MMprice.start_number <= \\''1\\'' || isnull(MMprice.start_number) || MMprice.start_number=0)\r\n                      AND (MMprice.end_number >= \\''1\\'' || isnull(MMprice.end_number) || MMprice.end_number=0)\r\n                      AND MMprice.price_type=\\''1\\'' \r\nWHERE catalogus.ContactID=\\''3949\\'' and (not Discontinued_yn || pricelist_yn)\r\nGROUP BY current_product_list.ProductID\r\nORDER BY brand.name, current_product_list.ProductID\r\n', 81);
INSERT INTO `query` (`Name`, `statement`, `ID`) VALUES 
('sales out # top 20 last 6 months', 'SELECT DISTINCTROW current_product_list.ProductID, current_product_list.ProductName, current_product_list.ExternalID, SUM(UnitsSold) as Sold\r\nFROM current_product_list \r\nINNER JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID\r\nWHERE YEAR(inventory_transactions.transactiondate) = YEAR(NOW()) AND\r\n   inventory_transactions.stock_owner_id = \\''802\\''\r\nGROUP BY current_product_list.ProductID, current_product_list.ProductName, \r\ncurrent_product_list.ReorderLevel, current_product_list.LeadTime, \r\ncurrent_product_list.Productdescription, current_product_list.Merk, \r\ncurrent_product_list.sku\r\nORDER BY Sold DESC\r\nLIMIT 20;', 82),
('Harense Smid catalog', 'SELECT brand.name,\r\n  current_product_list.ProductID, \r\n  current_product_list.ExternalID,   \r\n  ProductName, \r\n  EAN,\r\n  IF(MMprice.amount,MMprice.amount,pricing.amount) as inkoop, \r\n  IF(MMprice.start_number>1,MMprice.start_number,\\''\\'') as minimum,\r\n  Retail_price_ex as RRP_ex, Retail_price_ex*1.19 as RRP_incl\r\nFROM current_product_list\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN categories ON current_product_list.CategoryID = categories.CategoryID\r\nLEFT JOIN catalogusdetails ON current_product_list.ProductID = catalogusdetails.ProductID\r\nLEFT JOIN catalogus ON catalogusdetails.CatalogusID = catalogus.CatalogusID\r\nLEFT JOIN pricing ON  current_product_list.ProductID = pricing.ProductID\r\n            AND (pricing.ContactID=0)\r\n             AND (pricing.start_date <= NOW() || isnull(pricing.start_date) || pricing.start_date=0) \r\n                      AND (pricing.end_date >= NOW() || isnull(pricing.end_date) || pricing.end_date=0)\r\n                      AND (pricing.start_number <= \\''1\\'' || isnull(pricing.start_number) || pricing.start_number=0)\r\n                      AND (pricing.end_number >= \\''1\\'' || isnull(pricing.end_number) || pricing.end_number=0)\r\n                      AND pricing.price_type=\\''1\\'' \r\nLEFT JOIN pricing MMprice ON  current_product_list.ProductID = MMprice.ProductID\r\n            AND (MMprice.ContactID=\\''4286\\'')\r\n            AND (MMprice.start_date <= NOW() || isnull(MMprice.start_date) || MMprice.start_date=0) \r\n                      AND (MMprice.end_date >= NOW() || isnull(MMprice.end_date) || MMprice.end_date=0)\r\n                      AND MMprice.price_type=\\''1\\'' \r\nWHERE (catalogus.ContactID=\\''4286\\'' OR MerkID=\\''22\\'') AND Pricelist_yn\r\nGROUP BY current_product_list.ProductID\r\nORDER BY brand.name, current_product_list.ProductID', 83),
('Email Adressen', 'select DISTINCT contacts.CompanyName, \r\ncontacts.Email, Personen.Email\r\nfrom contacts\r\nINNER JOIN Personen ON Personen.ContactID = contacts.ContactID\r\nINNER JOIN invoices ON invoices.customerID = contacts.ContactID\r\nWHERE YEAR(invoices.Invoice_date) = YEAR(now())\r\nORDER BY contacts.CompanyName;', 84),
('Margin Detail', 'SELECT MONTH(orders.orderdate) as month, orders.OrderID,\r\n ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)),2) as omzet, \r\n  ROUND(sum((Quantity-to_deliver)*(UnitCost)),2) as inkoop, \r\n  ROUND(sum((Quantity-to_deliver)*cost_percentage),2) as shipping,\r\n  ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)),2) as marge,\r\n  ROUND(100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1),2) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nWHERE order_details.stock_owner_id=802 \r\n  AND NOT ISNULL(UnitCost)\r\n  AND confirmed_yn\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\nGROUP BY (orders.OrderID)\r\nOrder by orders.orderdate', 150),
('Media Markt Marge', 'SELECT distinctrow DATE_FORMAT(transactiondate,\\''%Y%d\\'') as date, Adressen.naam, \r\nProductName, sum(UnitsSold) as total, current_product_list.externalID, brand.name\r\nFROM inventory_transactions\r\nINNER JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIn orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE (YEAR( transactiondate ) = 2007)\r\n AND contacts.CompanyName LIKE \\''%media%markt%\\''\r\nGROUP BY Adressen.naam, current_product_list.externalID\r\nOrder by  date, Adressen.naam, current_product_list.externalID;', 85),
('tomtom sales out last month', 'SELECT DISTINCTROW DATE_FORMAT(shipments.Ship_date, \\''%d/%m/%Y\\'') as date, \r\n  CompanyName, \r\n current_product_list.ProductName, \r\n  sum(UnitsSold) as total, \r\n order_details.UnitPrice as Verkoop,   \r\n  SUM(order_details.UnitPrice*UnitsSold) as turnover, \r\n  current_product_list.externalID \r\nFROM inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\n        AND NOT orders.rma_yn\r\nINNER JOIN order_details on orders.OrderID=order_details.OrderID\r\n AND  inventory_transactions.ProductID=order_details.ProductID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nINNER JOIN shipments ON shipments.Shipment_ID = inventory_transactions.shipmentID\r\n\r\nWHERE   YEAR(transactiondate) = YEAR(now()) \r\n  AND MONTH(transactiondate) = MONTH(now())-1\r\n AND (Supplier=647 OR Supplier=4210) \r\n AND contacts.ContactID = 88\r\nGROUP BY date, contacts.contactID, inventory_transactions.ProductID \r\nOrder by date, current_product_list.externalID', 90),
('Media Markt Producten per vestiging', 'SELECT distinctrow  \r\n        YEAR(inventory_transactions.transactiondate) as Y,\r\n        QUARTER(inventory_transactions.transactiondate) as Q,\r\n        MONTH(inventory_transactions.transactiondate) as M,\r\n contacts.CompanyName,  \r\n sum((UnitsSold)*UnitPrice) as \\''€\\'',\r\n        sum(UnitsSold) as \\''#\\'',\r\n        inventory_transactions.ProductID,\r\n        current_product_list.ProductName\r\nFROM inventory_transactions\r\nLEFT JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE YEAR( transactiondate ) = YEAR (NOW())\r\n AND contacts.CompanyName LIKE \\''%media%markt%\\''\r\n AND current_product_list.merkID = \\''88\\''\r\nGROUP BY Adressen.naam, inventory_transactions.ProductID\r\nOrder by Adressen.naam, inventory_transactions.transactiondate;', 148),
('Envicom Catalog', 'SELECT DISTINCTROW \r\n  categories.CategoryName as \\''art_grp\\'',\r\n  \\''iwex b.v.\\'' as leverancier,\r\n  brand.name as producent,\r\n  1 as VPE,\r\n  1 as Pl,\r\n  current_product_list.externalID as \\''Ref. Prod\\'',\r\n  current_product_list.ProductID as \\''Iwex Ref.\\'', \r\n  current_product_list.ProductName, \r\n  current_product_list.Retail_price_ex*1.19 as Verkoop,\r\n  IF(MMprice.amount,MMprice.amount,pricing.amount) as inkoop,\r\n  current_product_list.EAN,\r\nIF(Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage))>=0,Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)),0) as voorraad\r\nFROM current_product_list\r\nLEFT JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN categories ON current_product_list.CategoryID = categories.CategoryID\r\nINNER JOIN catalogusdetails ON current_product_list.ProductID = catalogusdetails.ProductID\r\nINNER JOIN catalogus ON catalogusdetails.CatalogusID = catalogus.CatalogusID\r\nINNER JOIN pricing ON  current_product_list.ProductID = pricing.ProductID\r\n           AND (pricing.ContactID=0)\r\n             AND (pricing.start_date <= NOW() || isnull(pricing.start_date) || pricing.start_date=0) \r\n                      AND (pricing.end_date >= NOW() || isnull(pricing.end_date) || pricing.end_date=0)\r\n                      AND (pricing.start_number <= \\''1\\'' || isnull(pricing.start_number) || pricing.start_number=0)\r\n                      AND (pricing.end_number >= \\''1\\'' || isnull(pricing.end_number) || pricing.end_number=0)\r\n                      AND pricing.price_type=\\''1\\'' \r\nLEFT JOIN pricing MMprice ON  current_product_list.ProductID = MMprice.ProductID\r\n            AND (MMprice.ContactID=\\''4286\\'')\r\n            AND (MMprice.start_date <= NOW() || isnull(MMprice.start_date) || MMprice.start_date=0) \r\n                      AND (MMprice.end_date >= NOW() || isnull(MMprice.end_date) || MMprice.end_date=0)\r\n                      AND (MMprice.start_number <= \\''1\\'' || isnull(MMprice.start_number) || MMprice.start_number=0)\r\n                      AND (MMprice.end_number >= \\''1\\'' || isnull(MMprice.end_number) || MMprice.end_number=0)\r\n                      AND MMprice.price_type=\\''1\\'' \r\nWHERE catalogus.ContactID=\\''4341\\''\r\nGROUP BY current_product_list.ProductID\r\nORDER BY brand.name, current_product_list.ProductID\r\n', 88),
('tomtom sales out last week', 'SELECT DISTINCTROW DATE_FORMAT(inventory_transactions.TransactionDate,\\''%d/%m/%Y\\'') as date, \r\n CompanyName, \r\n current_product_list.ProductName, \r\n  sum(UnitsSold) as total, \r\n order_details.UnitPrice as Verkoop,   \r\n  SUM(order_details.UnitPrice*UnitsSold) as turnover, \r\n  current_product_list.externalID \r\nFROM inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\n        AND NOT orders.rma_yn\r\nINNER JOIN order_details on orders.OrderID=order_details.OrderID\r\n AND  inventory_transactions.ProductID=order_details.ProductID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE \r\n YEAR(transactiondate) = YEAR(now()) \r\n  AND WEEK(transactiondate) = WEEK(now())-1\r\n AND (Supplier=647 OR Supplier=4210)\r\nGROUP BY date, contacts.contactID, inventory_transactions.ProductID \r\nOrder by date, current_product_list.externalID', 89),
('TomTom weekly Sell Out', 'SELECT  \r\n  DATE_FORMAT(shipments.Ship_Date,\\''%v %Y\\'') as Week, \r\n  current_product_list.ProductID, \r\n  current_product_list.externalID, \r\n ProductName, \r\n contacts.ContactID, \r\n  CompanyName, Country, \r\n  sum(UnitsSold) as total\r\nFROM current_product_list\r\nINNER JOIN inventory_transactions on inventory_transactions.ProductID=current_product_list.ProductID\r\nLEFT JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\n        AND NOT orders.rma_yn\r\nINNER JOIN shipments ON shipments.Shipment_ID = inventory_transactions.shipmentID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE   YEAR(Ship_Date) = YEAR(now()) AND\r\n        WEEK(Ship_Date) = WEEK(now())-1\r\n AND (Supplier=647 OR Supplier=4210) \r\nGROUP BY contacts.ContactID, current_product_list.ProductID\r\nORDER BY current_product_list.externalID', 91),
('Keomo DS Media Markt product-month', 'SELECT current_product_list.externalID, DATE_FORMAT(transactiondate,\\''%Y-%m\\'') as  \\"Year Month\\", Adressen.naam, \r\nProductName, sum(UnitsSold) as total\r\nFROM inventory_transactions\r\nINNER JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE (YEAR( transactiondate ) = 2005 OR YEAR( transactiondate ) = 2006)\r\n AND Adressen.naam LIKE \\''%media%markt%\\''\r\n AND merkID=\\''88\\'' \r\nGROUP BY current_product_list.externalID, \\"Year Month\\", Adressen.naam\r\nOrder by current_product_list.externalID, \\"Year Month\\", Adressen.naam;', 94),
('TomTom Stock weekly', 'SELECT DISTINCTROW \r\n  current_product_list.ProductID, \r\n  current_product_list.ExternalID, \r\n current_product_list.ProductName,\r\n    IF(Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage))<0,0,(Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)))) AS Stock\r\nFROM current_product_list\r\nLEFT JOIN inventory_transactions ON inventory_transactions.ProductID = current_product_list.ProductID\r\nLEFT JOIN orders ON inventory_transactions.OrderID = orders.OrderID \r\n        WHERE (rma_yn <> 1 or rma_yn is Null)\r\n        AND (Supplier=647 OR Supplier=4210) \r\n        AND stock_owner_id = \\''802\\''\r\n    AND current_product_list.ExternalID\r\nGROUP BY current_product_list.ProductID\r\nORDER BY current_product_list.ExternalID;', 92),
('TomTom weekly Stock Report', 'SELECT DISTINCTROW \r\n  current_product_list.ProductID, \r\n  current_product_list.ExternalID, \r\n  current_product_list.ProductName,    IF(Sum(IF(isnull(inventory_transactions.UnitsReceived),0,inventory_transactions.UnitsReceived)-IF(isnull(inventory_transactions.UnitsSold),0,inventory_transactions.UnitsSold)-IF(isnull(inventory_transactions.UnitsShrinkage),0,inventory_transactions.UnitsShrinkage))<0,0,(Sum(IF(isnull(inventory_transactions.UnitsReceived),0,inventory_transactions.UnitsReceived)-IF(isnull(inventory_transactions.UnitsSold),0,inventory_transactions.UnitsSold)-IF(isnull(inventory_transactions.UnitsShrinkage),0,inventory_transactions.UnitsShrinkage)))) AS Stock,\r\n  SUM(IF(YEAR(Ship_Date) = YEAR(now())AND(WEEK(Ship_Date) = WEEK(now())-1),inventory_transactions.UnitsSold,0)) as sold\r\nFROM current_product_list\r\nLEFT JOIN inventory_transactions ON inventory_transactions.ProductID = current_product_list.ProductID\r\nLEFT JOIN orders ON inventory_transactions.OrderID = orders.OrderID \r\nLEFT JOIN shipments ON shipments.Shipment_ID = inventory_transactions.shipmentID\r\nWHERE (rma_yn <> 1 or rma_yn is Null)\r\n        AND (Supplier=647 OR Supplier=4210) \r\n        AND inventory_transactions.stock_owner_id = \\''802\\''\r\n AND current_product_list.ExternalID\r\n        AND current_product_list.Pricelist_yn = 1\r\nGROUP BY current_product_list.ProductID\r\nORDER BY current_product_list.ExternalID;', 93),
('Keomo Omzet per Media Markt', 'SELECT Adressen.naam, DATE_FORMAT(transactiondate,\\''%b %Y\\'') as  Month, sum(UnitsSold*UnitPrice) as total\r\nFROM inventory_transactions\r\nINNER JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nWHERE (YEAR( transactiondate ) = 2005 OR YEAR( transactiondate ) = 2006)\r\n AND Adressen.naam LIKE \\''%media%markt%\\''\r\n AND merkID=\\''88\\'' \r\nGROUP BY Adressen.naam, Month \r\nOrder by Adressen.naam, transactiondate DESC', 95),
('Dynabyte Sold consignment', 'SELECT contacts.CompanyName, order_details.ProductID, current_product_list.ProductName, sum(order_details.Quantity)\r\nFROM order_details  \r\nINNER JOIN orders ON orders.OrderID = order_details.OrderID   \r\nINNER JOIN current_product_list on current_product_list.ProductID = order_details.ProductID \r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE orders.administration_order\r\n AND contacts.ContactID=97\r\nGROUP BY CompanyName, order_details.ProductID\r\nORDER BY CompanyName;', 97),
('Consignatie Dynabyte', 'SELECT inventory_transactions.ProductID, ProductName, UnitsSold, orders.OrderID, shipmentID, transactionDate, consignment_order\r\nFROM inventory_transactions\r\nINNER JOIN orders on orders.OrderID = inventory_transactions.OrderID\r\nINNER JOIN current_product_list on current_product_list.ProductID = inventory_transactions.ProductID \r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE merkID = 73 AND orders.ContactID = 97 AND OrderDate > \\''2005-04-28\\''\r\nORDER BY transactiondate', 99),
('Consignatie Dynabyte Sold detail', 'SELECT contacts.CompanyName, order_details.ProductID, current_product_list.ProductName, order_details.Quantity, orders.orderID,         orders.ContactsOrderID\r\nFROM order_details  \r\nINNER JOIN orders ON orders.OrderID = order_details.OrderID   \r\nINNER JOIN current_product_list on current_product_list.ProductID = order_details.ProductID \r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE orders.administration_order\r\n AND contacts.ContactID=97\r\nORDER BY orders.orderID;', 98),
('Pipeline Detail', 'SELECT \r\ncontacts.ContactID, \r\ncontacts.CompanyName, \r\norders.OrderID,\r\norders.OrderDate,\r\nROUND(SUM(order_details.to_deliver*order_details.unitPrice),2) as pipeline,\r\nROUND(SUM(order_details.to_deliver*order_details.unitCost),2) as Cost,\r\nROUND(SUM(order_details.to_deliver*(order_details.unitPrice+order_details.cost_percentage-order_details.unitCost)),2) as marge\r\nFROM order_details\r\nINNER JOIN orders ON orders.OrderID = order_details.OrderID\r\nLEFT JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE orders.confirmed_yn = 1 AND\r\n   order_details.to_deliver\r\nGROUP BY orders.OrderID\r\nORDER BY pipeline DESC\r\n', 100),
('Klanten zonder order', 'SELECT \r\n  count(contacts.ContactID) as ''#'', \r\n  orders.OrderID, \r\n  contacts.ContactID, \r\n  CompanyName, \r\n  Phone, \r\n  Naam, \r\n  attn, \r\n  straat, \r\n  huisnummer, \r\n  postcode, \r\n  plaats, \r\n  contacts.country\r\nFROM contacts\r\nleft outer JOIN orders ON orders.ContactID = contacts.ContactID\r\nINNER JOIN Adressen ON Adressen.ContactID = contacts.ContactID AND adrestitel <>  \r\n7 AND adrestitel <> 8 AND adrestitel <> 5\r\nLEFT JOIN country ON contacts.Country = country.country\r\nWHERE isnull(orders.OrderID) \r\n  AND dealer_yn\r\nGROUP BY contacts.ContactID\r\nORDER BY ContactID desc', 101),
('Phonehouse catalog', 'SELECT current_product_list.ProductID, current_product_list.ExternalID, ProductName, EAN,\r\n  IF(MMprice.amount,MMprice.amount,pricing.amount) as inkoop, Retail_price_ex as RRP\r\nFROM current_product_list\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN categories ON current_product_list.CategoryID = categories.CategoryID\r\nLEFT JOIN catalogusdetails ON current_product_list.ProductID = catalogusdetails.ProductID\r\nLEFT JOIN catalogus ON catalogusdetails.CatalogusID = catalogus.CatalogusID\r\nLEFT JOIN pricing ON  current_product_list.ProductID = pricing.ProductID\r\n            AND (pricing.ContactID=0)\r\n             AND (pricing.start_date <= NOW() || isnull(pricing.start_date) || pricing.start_date=0) \r\n                      AND (pricing.end_date >= NOW() || isnull(pricing.end_date) || pricing.end_date=0)\r\n                      AND (pricing.start_number <= \\''1\\'' || isnull(pricing.start_number) || pricing.start_number=0)\r\n                      AND (pricing.end_number >= \\''1\\'' || isnull(pricing.end_number) || pricing.end_number=0)\r\n                      AND pricing.price_type=\\''1\\'' \r\nLEFT JOIN pricing MMprice ON  current_product_list.ProductID = MMprice.ProductID\r\n            AND (MMprice.ContactID=\\''3396\\'')\r\n            AND (MMprice.start_date <= NOW() || isnull(MMprice.start_date) || MMprice.start_date=0) \r\n                      AND (MMprice.end_date >= NOW() || isnull(MMprice.end_date) || MMprice.end_date=0)\r\n                      AND (MMprice.start_number <= \\''1\\'' || isnull(MMprice.start_number) || MMprice.start_number=0)\r\n                      AND (MMprice.end_number >= \\''1\\'' || isnull(MMprice.end_number) || MMprice.end_number=0)\r\n                      AND MMprice.price_type=\\''1\\'' \r\nWHERE (catalogus.ContactID=\\''3396\\'' OR MerkID=\\''22\\'') AND Pricelist_yn\r\nGROUP BY current_product_list.ProductID\r\nORDER BY brand.name, current_product_list.ProductID', 103),
('Media Markt omzet', 'SELECT \r\n  YEAR(Invoice_date) as Year,\r\n  MONTH(Invoice_date) as M, \r\n  DAY(Invoice_date) as dag,\r\n  contacts.CompanyName, \r\n  Invoice_total as factuurwaarde,\r\n  InvoiceID as factuurnummer\r\nFROM invoices\r\nINNER JOIN contacts ON contacts.ContactID = invoices.CustomerID\r\nWHERE YEAR(Invoice_date) = 2007 AND\r\n  QUARTER(Invoice_date) = 4 AND\r\n  (contacts.CompanyName LIKE \\''%media%markt%\\'' OR\r\n  contacts.CompanyName LIKE \\''%saturn%zuidplein%\\'')\r\nORDER BY contacts.CompanyName, Year DESC, M DESC, dag DESC;', 104),
('Media Markt invoiced per J', 'SELECT \r\n  YEAR(Invoice_date) as Year, \r\n  contacts.CompanyName, \r\n  sum(Invoice_total) as Omzet\r\nFROM invoices\r\nINNER JOIN contacts ON contacts.ContactID = invoices.CustomerID\r\nWHERE contacts.CompanyName LIKE \\''%media%markt%\\'' OR\r\n      contacts.CompanyName LIKE \\''%saturn%zuidplein%\\''\r\nGROUP BY YEAR(Invoice_date), contacts.ContactID\r\nORDER BY Year DESC, contacts.CompanyName;', 266),
('Saturn Omzet', 'SELECT CONCAT(YEAR(Invoice_date), \\"-\\" , QUARTER(Invoice_date)) as Year_Q, contacts .CompanyName, sum(Invoice_total) as Omzet\r\nFROM invoices\r\nINNER JOIN contacts ON contacts.ContactID = invoices.CustomerID\r\nWHERE YEAR( Invoice_date) = YEAR(NOW())\r\n      AND contacts.CompanyName LIKE \\''%Saturn%\\''\r\nGROUP BY Year_Q, ContactID\r\nORDER BY Year_Q DESC, contacts.CompanyName;', 106),
('Searchdog omzet per BP TT go one ri', 'SELECT distinctrow DATE_FORMAT(inventory_transactions.TransactionDate,\\''%b %Y\\'') as month, Adressen.Naam, current_product_list.ProductName,  SUM(inventory_transactions.UnitsSold) AS Aantal, SUM(inventory_transactions.UnitPrice*inventory_transactions.UnitsSold) as omzet\r\nfrom inventory_transactions\r\nINNER JOIN shipments ON shipments.Shipment_ID = inventory_transactions.ShipmentID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID\r\nWHERE Adressen.ContactID =\\''3778\\'' AND \r\n MONTH( inventory_transactions.TransactionDate  ) =  MONTH(NOW())-1 AND \r\n YEAR( inventory_transactions.TransactionDate ) = YEAR(NOW()) AND\r\n  Adressen.Naam NOT LIKE \\"%Searchdog%\\" AND\r\n        (current_product_list.ProductID = 992965 OR\r\n         current_product_list.ProductID = 992571 OR\r\n         current_product_list.ProductID = 993189 OR\r\n         current_product_list.ProductID = 993078 OR\r\n         current_product_list.ProductID = 993079 OR\r\n         current_product_list.ProductID = 993077)\r\nGROUP BY Adressen.AdresID, current_product_list.ProductID\r\nOrder by  Adressen.Naam ASC, omzet DESC;', 105),
('Reprint Catalog', 'SELECT DISTINCTROW \r\n  categories.CategoryName as \\''art_grp\\'',\r\n  \\''iwex b.v.\\'' as leverancier,\r\n  brand.name as producent,\r\n  1 as VPE,\r\n  1 as Pl,\r\n  current_product_list.externalID as \\''Ref. Prod\\'',\r\n  current_product_list.ProductID as \\''Iwex Ref.\\'', \r\n  current_product_list.ProductName, \r\n  current_product_list.Retail_price_ex*1.19 as Verkoop,\r\n  IF(MMprice.amount,MMprice.amount,pricing.amount) as inkoop,\r\n  current_product_list.EAN,\r\nIF(Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage))>=0,Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)),0) as voorraad\r\nFROM current_product_list\r\nLEFT JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN categories ON current_product_list.CategoryID = categories.CategoryID\r\nINNER JOIN catalogusdetails ON current_product_list.ProductID = catalogusdetails.ProductID\r\nINNER JOIN catalogus ON catalogusdetails.CatalogusID = catalogus.CatalogusID\r\nINNER JOIN pricing ON  current_product_list.ProductID = pricing.ProductID\r\n           AND (pricing.ContactID=0)\r\n             AND (pricing.start_date <= NOW() || isnull(pricing.start_date) || pricing.start_date=0) \r\n                      AND (pricing.end_date >= NOW() || isnull(pricing.end_date) || pricing.end_date=0)\r\n                      AND (pricing.start_number <= \\''1\\'' || isnull(pricing.start_number) || pricing.start_number=0)\r\n                      AND (pricing.end_number >= \\''1\\'' || isnull(pricing.end_number) || pricing.end_number=0)\r\n                      AND pricing.price_type=\\''1\\'' \r\nLEFT JOIN pricing MMprice ON  current_product_list.ProductID = MMprice.ProductID\r\n            AND (MMprice.ContactID=\\''4286\\'')\r\n            AND (MMprice.start_date <= NOW() || isnull(MMprice.start_date) || MMprice.start_date=0) \r\n                      AND (MMprice.end_date >= NOW() || isnull(MMprice.end_date) || MMprice.end_date=0)\r\n                      AND (MMprice.start_number <= \\''1\\'' || isnull(MMprice.start_number) || MMprice.start_number=0)\r\n                      AND (MMprice.end_number >= \\''1\\'' || isnull(MMprice.end_number) || MMprice.end_number=0)\r\n                      AND MMprice.price_type=\\''1\\'' \r\nWHERE catalogus.ContactID=\\''3252\\'' AND \r\n   inventory_transactions.stock_owner_id = \\''802\\''\r\nGROUP BY current_product_list.ProductID\r\nORDER BY brand.name, current_product_list.ProductID\r\n', 107),
('MediaMarkt catalog uitegbreid', 'SELECT DISTINCTROW \r\n  categories.CategoryName as \\''art_grp\\'',\r\n  \\''iwex b.v.\\'' as leverancier,\r\n  brand.name as producent,\r\n  1 as VPE,\r\n  1 as Pl,\r\n  current_product_list.externalID as \\''Ref. Prod\\'',\r\n  current_product_list.ProductID as \\''Iwex Ref.\\'', \r\n  current_product_list.ProductName, \r\n  current_product_list.ProductDescription, \r\n  current_product_list.Retail_price_ex*1.19 as Verkoop,\r\n  IF(MMprice.amount,MMprice.amount,pricing.amount) as inkoop,\r\n  current_product_list.EAN,\r\nIF(Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage))>=0,Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)),0) as voorraad\r\nFROM current_product_list\r\nLEFT JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN categories ON current_product_list.CategoryID = categories.CategoryID\r\nINNER JOIN catalogusdetails ON current_product_list.ProductID = catalogusdetails.ProductID\r\nINNER JOIN catalogus ON catalogusdetails.CatalogusID = catalogus.CatalogusID\r\nINNER JOIN pricing ON  current_product_list.ProductID = pricing.ProductID\r\n            AND (pricing.ContactID=0)\r\n             AND (pricing.start_date <= NOW() || isnull(pricing.start_date) || pricing.start_date=0) \r\n                      AND (pricing.end_date >= NOW() || isnull(pricing.end_date) || pricing.end_date=0)\r\n                      AND (pricing.start_number <= \\''1\\'' || isnull(pricing.start_number) || pricing.start_number=0)\r\n                      AND (pricing.end_number >= \\''1\\'' || isnull(pricing.end_number) || pricing.end_number=0)\r\n                      AND pricing.price_type=\\''1\\'' \r\nLEFT JOIN pricing MMprice ON  current_product_list.ProductID = MMprice.ProductID\r\n            AND (MMprice.ContactID=\\''3949\\'')\r\n            AND (MMprice.start_date <= NOW() || isnull(MMprice.start_date) || MMprice.start_date=0) \r\n                      AND (MMprice.end_date >= NOW() || isnull(MMprice.end_date) || MMprice.end_date=0)\r\n                      AND (MMprice.start_number <= \\''1\\'' || isnull(MMprice.start_number) || MMprice.start_number=0)\r\n                      AND (MMprice.end_number >= \\''1\\'' || isnull(MMprice.end_number) || MMprice.end_number=0)\r\n                      AND MMprice.price_type=\\''1\\'' \r\nWHERE catalogus.ContactID=\\''3949\\'' and (not Discontinued_yn || pricelist_yn)\r\nGROUP BY current_product_list.ProductID\r\nORDER BY brand.name, current_product_list.ProductID', 108),
('Rikaline turnover ytd', 'SELECT distinctrow \r\n  brand.name,\r\n  NULL, \r\n  SUM(UnitsSold*UnitPrice)*1.9 as Euros\r\nFROM inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNEr JOIN brand on brand.brand_id = current_product_list.merkID\r\nWHERE YEAR(transactiondate) = YEAR(now())\r\nGROUP BY current_product_list.merkID\r\nORDER BY Euros DESC\r\nLIMIT 15', 109),
('Average Margin', 'SELECT MONTH(orderdate),\r\n       CONCAT(100*(AVG((Sales_Value/(Purchase_Value+Shipping_Cost))-1)),\\'' %\\'') AS AVG_margin\r\nFROM order_margin\r\nINNER JOIN orders ON order_margin.OrderID = orders.OrderID\r\nWHERE YEAR(orderdate) = YEAR(NOW())\r\nGROUP BY MONTH(orderdate)\r\n', 110),
('Weighted Average Margin', 'SELECT MONTH(orders.orderdate),\r\n   SUM(Sales_Value),\r\n   SUM(Sales_Value) - (SUM(Purchase_Value)),\r\n   SUM(Sales_Value) / (SUM(Purchase_Value))\r\nFROM order_margin\r\nINNER JOIN orders ON order_margin.OrderID = orders.OrderID\r\nWHERE YEAR(orders.orderdate) = YEAR(NOW())\r\nGROUP BY MONTH(orderdate)', 111),
('W Margin march 2006', 'SELECT MONTH(orderdate), \r\n   orders.OrderID,\r\n   SUM(Sales_Value) AS omzet,\r\n   SUM(Sales_Value) - (SUM(Purchase_Value)+SUM(Shipping_Cost)),\r\n   (SUM(Sales_Value) / (SUM(Purchase_Value)+SUM(Shipping_Cost)))\r\nFROM order_margin\r\nINNER JOIN orders ON order_margin.OrderID = orders.OrderID\r\nWHERE YEAR(orderdate) = YEAR(NOW()) AND\r\n      MONTH(orderdate) = 3 AND\r\n      Sales_Value\r\nGROUP BY orderdate', 112),
('Marge TomTom', 'SELECT \r\nYEAR(orders.orderdate) as YEAR,\r\nMONTH(orders.orderdate) as Month,     ROUND(sum((UnitsSold)*(order_details.UnitPrice+cost_percentage)),2) as omzet, \r\nROUND(sum((UnitsSold)*(UnitCost)),2) as inkoop, \r\nROUND(sum(cost_percentage),2) as \\"added cost\\",  ROUND(sum((UnitsSold)*(order_details.UnitPrice+cost_percentage-UnitCost)) ,2)as marge,\r\nROUND(100*((sum((UnitsSold)*(order_details.UnitPrice+cost_percentage))) / (sum((UnitsSold)*(UnitCost)))-1),2) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID\r\nLEFT JOIN inventory_transactions ON inventory_transactions.orderdetailsID = order_details.OrderDetailsID\r\nWHERE order_details.stock_owner_id=802 \r\n AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate) = YEAR(now())\r\n        AND NOT (administration_order AND order_details.Productdescription LIKE \\"%protection%\\")\r\n  AND merkID = 22\r\nGROUP BY YEAR(orders.OrderDate)\r\n, MONTH(orders.OrderDate)\r\nOrder by orders.orderdate', 114),
('Weighted Average Margin per year', 'SELECT YEAR(orders.orderdate),\r\n   SUM(Sales_Value),\r\n   SUM(Sales_Value) - (SUM(Purchase_Value)),\r\n   SUM(Sales_Value) / (SUM(Purchase_Value))\r\nFROM order_margin\r\nINNER JOIN orders ON order_margin.OrderID = orders.OrderID \r\nWHERE YEAR(orders.orderdate) = YEAR(NOW())\r\nGROUP BY YEAR(orders.orderdate)', 113),
('Media Markt facturen', 'SELECT invoices.companyName, invoices.InvoiceID, invoices.Invoice_total AS excl_btw, \r\n                            invoices.Invoice_BTW AS BTW, invoices.Invoice_BTW + invoices.Invoice_total AS totaal,\r\n                            invoices.paid_yn, invoices.paid_date,\r\n                            invoices.Invoice_date, sum(link_amount) AS geboekt, bank_account_id,                      bank_transactions.amount AS bankamount\r\n                            FROM invoices\r\n                            LEFT JOIN payments_link ON invoices.InvoiceID = payments_link.InvoiceID\r\n                            LEFT JOIN bank_transactions ON payments_link.BankTransactionId = bank_transactions.transaction_id\r\n                            LEFT JOIN paymentterm ON Paymentterm = PaymentTermID\r\n                            LEFT JOIN branches ON invoices.CustomerID = branches.BrancheContactID\r\n                            WHERE (invoices.CustomerID = \\''3949\\'' \r\n                             OR\r\n                             branches.MainContactID = \\''3949\\'')\r\n                            GROUP BY InvoiceID', 115),
('Keomo Omzet per klant', 'SELECT distinctrow DATE_FORMAT(inventory_transactions.TransactionDate,\\''%Y%m\\'') as month, \r\nCompanyName, current_product_list.ProductName, sum(UnitsSold*UnitPrice) as omzet\r\nfrom inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE merkID=\\''88\\'' AND\r\n   YEAR(inventory_transactions.TransactionDate) = YEAR(NOW())\r\nGROUP BY month, contacts.contactID, current_product_list.ProductID\r\nOrder by month DESC, omzet DESC', 116),
('TfT catalog', 'SELECT current_product_list.ProductID, current_product_list.ExternalID, ProductName, EAN,\r\n  IF(MMprice.amount,MMprice.amount,pricing.amount) as inkoop, Retail_price_ex as RRP\r\nFROM current_product_list\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN categories ON current_product_list.CategoryID = categories.CategoryID\r\nLEFT JOIN catalogusdetails ON current_product_list.ProductID = catalogusdetails.ProductID\r\nLEFT JOIN catalogus ON catalogusdetails.CatalogusID = catalogus.CatalogusID\r\nLEFT JOIN pricing ON  current_product_list.ProductID = pricing.ProductID\r\n           AND (pricing.ContactID=0)\r\n             AND (pricing.start_date <= NOW() || isnull(pricing.start_date) || pricing.start_date=0) \r\n                      AND (pricing.end_date >= NOW() || isnull(pricing.end_date) || pricing.end_date=0)\r\n                      AND (pricing.start_number <= \\''50\\'' || isnull(pricing.start_number) || pricing.start_number=0)\r\n                      AND (pricing.end_number >= \\''51\\'' || isnull(pricing.end_number) || pricing.end_number=0)\r\n                      AND pricing.price_type=\\''1\\'' \r\nLEFT JOIN pricing MMprice ON  current_product_list.ProductID = MMprice.ProductID\r\n            AND (MMprice.ContactID=\\''3766\\'')\r\n            AND (MMprice.start_date <= NOW() || isnull(MMprice.start_date) || MMprice.start_date=0) \r\n                      AND (MMprice.end_date >= NOW() || isnull(MMprice.end_date) || MMprice.end_date=0)\r\n                      AND (MMprice.start_number <= \\''1\\'' || isnull(MMprice.start_number) || MMprice.start_number=0)\r\n                      AND (MMprice.end_number >= \\''1\\'' || isnull(MMprice.end_number) || MMprice.end_number=0)\r\n                      AND MMprice.price_type=\\''1\\'' \r\nWHERE (catalogus.ContactID=\\''3766\\'' OR MerkID=\\''22\\'' OR MerkID=\\''88\\'') AND Pricelist_yn\r\nGROUP BY current_product_list.ProductID\r\nORDER BY brand.name, current_product_list.ProductID', 166),
('Media Markt omzet per q en merk', 'SELECT distinctrow CONCAT(YEAR(transactiondate), \\"-Q\\" , QUARTER(transactiondate)) as Year_q, \r\n  contacts.CompanyName,  \r\n sum((UnitsSold)*UnitPrice) as total, \r\n brand.name\r\nFROM inventory_transactions\r\nLEFT JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE YEAR( transactiondate ) = YEAR (NOW())\r\n AND contacts.CompanyName LIKE \\''%media%markt%\\''\r\nGROUP BY Year_q, Adressen.naam, current_product_list.merkID\r\nOrder by  Year_q DESC, Adressen.naam, current_product_list.merkID;', 117),
('GSm shop januari', 'SELECT distinctrow DATE_FORMAT(transactiondate,\\''%Y%m\\'') as date, Adressen.naam, Adressen.straat, Adressen.huisnummer, Adressen.plaats, contacts.CompanyName,  \r\nProductName, sum(UnitsSold) as total, current_product_list.externalID, brand.name\r\nFROM inventory_transactions\r\nINNER JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE YEAR( transactiondate) = 2006 AND MONTH(transactiondate) = 1\r\n AND Adressen.naam LIKE \\''%gsm-shop%\\'' \r\nGROUP BY Adressen.naam, current_product_list.externalID\r\nOrder by  date DESC, Adressen.naam, current_product_list.externalID;', 118),
('pricelist No stock ', 'SELECT DISTINCTROW \r\n  current_product_list.ProductID, \r\n  current_product_list.ExternalID, \r\n  current_product_list.ProductName,\r\n  Pricelist_yn,\r\n  Discontinued_yn,\r\n  free_stock,\r\n  stock \r\nFROM current_product_list\r\nINNER JOIN product_stock on current_product_list.ProductID = product_stock.Product_ID AND owner_id = \\''802\\''\r\nWHERE owner_id = \\''802\\''\r\n        AND current_product_list.Pricelist_yn\r\n        AND Pricelist_yn\r\n        AND NOT stock\r\nGROUP BY current_product_list.ProductID\r\nORDER BY current_product_list.ExternalID;', 136),
('Voorraad detail', 'SELECT \r\n  ProductID,\r\n  brand.name,\r\n  externalID,\r\n  stock as \\''#\\'', \r\n  ProductName,\r\n  sum(stock * Purchase_price_home) as kostprijs,\r\n  location\r\nFROM current_product_list\r\nLEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = 802\r\nLEFT JOIN location ON location_ID = ID\r\nINNER JOIN brand ON current_product_list.MerkID = brand.brand_id\r\nWHERE (NOT Discontinued_yn AND (sku=1 OR sku=0) \r\n              OR Pricelist_yn AND Discontinued_yn AND location_ID\r\n              OR stock AND (sku=1 OR sku=0))\r\n      AND NOT CategoryID > 9\r\nGROUP BY current_product_list.ProductID\r\nHAVING stock\r\nORDER BY location, brand.name, externalID', 261),
('Marge top 25 %', 'SELECT contacts.CompanyName, orders.OrderID,\r\n  sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)) as omzet, \r\n sum((Quantity-to_deliver)*(UnitCost)) as inkoop, \r\n sum(cost_percentage),\r\n sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)) as marge,\r\n 100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN contacts ON orders.ContactID = contacts.ContactID\r\nWHERE order_details.stock_owner_id=802 \r\n AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\nGROUP BY orders.ContactID\r\nORDER BY \\''%\\'' DESC\r\nLIMIT 25', 119),
('Marge bottom 25 %', 'SELECT contacts.contactID, contacts.CompanyName,\r\n sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)) as omzet, \r\n sum((Quantity-to_deliver)*(UnitCost)) as inkoop, \r\n sum(cost_percentage),\r\n sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)) as marge,\r\n 100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN contacts ON orders.ContactID = contacts.ContactID\r\nWHERE order_details.stock_owner_id=802 \r\n AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\nGROUP BY orders.ContactID\r\nORDER BY \\''%\\'' ASC\r\nLIMIT 25', 120),
('Marge per klant', 'SELECT contacts.ContactID, contacts.CompanyName, \r\n  sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)) as omzet, \r\n sum((Quantity-to_deliver)*(UnitCost)) as inkoop, \r\n sum(cost_percentage),\r\n sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)) as marge,\r\n 100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN contacts ON orders.ContactID = contacts.ContactID\r\nWHERE order_details.stock_owner_id=802 \r\n AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT administration_order\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\nGROUP BY orders.ContactID\r\nORDER BY \\''%\\'' ASC', 121),
('Marge per maand this year', 'SELECT MONTH(orders.orderdate) as month,\r\n ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)),2) as omzet, \r\n  ROUND(sum((Quantity-to_deliver)*(UnitCost)),2) as inkoop, \r\n  ROUND(sum((Quantity-to_deliver)*cost_percentage),2) Shipping,\r\n ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)),2) as marge,\r\n  ROUND(100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1),2) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nWHERE order_details.stock_owner_id=802 \r\n  AND NOT ISNULL(UnitCost)\r\n  AND confirmed_yn\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\nGROUP BY MONTH(orders.orderdate)\r\nOrder by orders.orderdate', 128),
('Voorraad owner iwex -> keomo', 'SELECT current_product_list.ProductID, current_product_list.externalID, current_product_list.ProductName, Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)) AS Stock, current_product_list.Merk FROM current_product_list \r\nINNER JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID \r\nWHERE stock_owner_id = \\''802\\'' AND \r\n    merkID = 88 \r\nGROUP BY current_product_list.ProductID\r\nORDER BY Stock DESC', 122),
('PO per supplier this year', 'SELECT ContactID, CompanyName, poID, CONCAT(YEAR(OrderDate), \\''-\\'', WEEK(OrderDate)) as \\"year-week\\", current_product_list.ProductID, current_product_list.ExternalID, unitprice, quantity, to_deliver, (unitprice * quantity) as total\r\nFROM po_details\r\nINNER JOIN purchase_orders ON purchase_orders.PurchaseOrderID = po_details.poID\r\nINNER JOIN current_product_list on po_details.ProductID = \r\ncurrent_product_list.ProductID\r\nINNER JOIN contacts ON contacts.ContactID = purchase_orders.SupplierID\r\nWHERE YEAR(OrderDate) = YEAR(NOW())\r\nGROUP BY po_details.ProductID, poID, CONCAT(YEAR(OrderDate), \\''-\\'', WEEK(OrderDate))\r\nORDER BY ContactID, po_details.ProductID, poID, OrderDate ', 123),
('PO per supplier last year', 'SELECT ContactID, CompanyName, CONCAT(YEAR(OrderDate), \\''-\\'', WEEK(OrderDate)) as \\"year-week\\" , poID, current_product_list.ProductID, current_product_list.ExternalID, unitprice, quantity, to_deliver, (unitprice * quantity) as total\r\nFROM po_details\r\nINNER JOIN purchase_orders ON purchase_orders.PurchaseOrderID = po_details.poID\r\nINNER JOIN current_product_list on po_details.ProductID = \r\ncurrent_product_list.ProductID\r\nINNER JOIN contacts ON contacts.ContactID = purchase_orders.SupplierID\r\nWHERE YEAR(OrderDate) = YEAR(NOW())-1\r\nGROUP BY po_details.ProductID, poID, CONCAT(YEAR(OrderDate), \\''-\\'', WEEK(OrderDate))\r\nORDER BY ContactID, OrderDate, poID\r\n', 124),
('PO per supplier this year BO', 'SELECT ContactID, CompanyName, poID, CONCAT(YEAR(OrderDate), \\''-\\'', WEEK(OrderDate)) as \\"year-week\\", current_product_list.ProductID, current_product_list.ExternalID, unitprice, quantity, to_deliver, (unitprice * quantity) as total\r\nFROM po_details\r\nINNER JOIN purchase_orders ON purchase_orders.PurchaseOrderID = po_details.poID\r\nINNER JOIN current_product_list on po_details.ProductID = \r\ncurrent_product_list.ProductID\r\nINNER JOIN contacts ON contacts.ContactID = purchase_orders.SupplierID\r\nWHERE YEAR(OrderDate) = YEAR(NOW()) AND to_deliver\r\nGROUP BY po_details.ProductID, poID, CONCAT(YEAR(OrderDate), \\''-\\'', WEEK(OrderDate))\r\nORDER BY ContactID, po_details.ProductID, poID, OrderDate ', 125),
('Marge top 25 Euro', 'SELECT contacts.CompanyName,\r\n  ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)),2) as omzet,\r\n  ROUND(sum((Quantity-to_deliver)*(UnitCost)),2) as inkoop,\r\n  ROUND(sum(cost_percentage),2) as cost,\r\n  ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)),2) as \\''marge\\'',\r\n  ROUND(100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1),2) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN contacts ON orders.ContactID = contacts.ContactID\r\nWHERE order_details.stock_owner_id=802 \r\n AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\nGROUP BY orders.ContactID\r\nORDER BY marge DESC\r\nLIMIT 25', 126),
('marge bottom 25 €', 'SELECT contacts.CompanyName, orders.OrderID,\r\n sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)) as omzet, \r\n sum((Quantity-to_deliver)*(UnitCost)) as inkoop, \r\n sum(cost_percentage),\r\n sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)) as marge,\r\n 100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN contacts ON orders.ContactID = contacts.ContactID\r\nWHERE order_details.stock_owner_id=802 \r\n AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())-1\r\n        AND (Quantity-to_deliver)\r\nGROUP BY orders.ContactID\r\nORDER BY \\''marge\\'' ASC\r\nLIMIT 25', 127),
('Marge this month', 'SELECT orders.OrderID,\r\n  sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)) as omzet, \r\n sum((Quantity-to_deliver)*(UnitCost)) as inkoop, \r\n sum(cost_percentage),\r\n sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)) as marge,\r\n 100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nWHERE order_details.stock_owner_id=802 \r\n AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())\r\n  AND MONTH(orders.orderdate)=MONTH(NOW())\r\n        AND (Quantity-to_deliver)\r\nGROUP BY orders.OrderID\r\nORDER BY orders.OrderDate DESC\r\n', 129);
INSERT INTO `query` (`Name`, `statement`, `ID`) VALUES 
('Media Markt Keomo', 'SELECT DISTINCTROW \r\n  categories.CategoryName as \\''art_grp\\'',\r\n  \\''iwex b.v.\\'' as leverancier,\r\n  brand.name as producent,\r\n  1 as VPE,\r\n  1 as Pl,\r\n  current_product_list.externalID as \\''Ref. Prod\\'',\r\n  current_product_list.ProductID as \\''Iwex Ref.\\'', \r\n  current_product_list.ProductName, \r\n  current_product_list.Retail_price_ex*1.19 as Verkoop,\r\n  IF(MMprice.amount,MMprice.amount,pricing.amount) as inkoop,\r\n  current_product_list.EAN,\r\nIF(Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage))>=0,Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)),0) as voorraad\r\nFROM current_product_list\r\nLEFT JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN categories ON current_product_list.CategoryID = categories.CategoryID\r\nINNER JOIN catalogusdetails ON current_product_list.ProductID = catalogusdetails.ProductID\r\nINNER JOIN catalogus ON catalogusdetails.CatalogusID = catalogus.CatalogusID\r\nINNER JOIN pricing ON  current_product_list.ProductID = pricing.ProductID\r\n           AND (pricing.ContactID=0)\r\n             AND (pricing.start_date <= NOW() || isnull(pricing.start_date) || pricing.start_date=0) \r\n                      AND (pricing.end_date >= NOW() || isnull(pricing.end_date) || pricing.end_date=0)\r\n                      AND (pricing.start_number <= \\''1\\'' || isnull(pricing.start_number) || pricing.start_number=0)\r\n                      AND (pricing.end_number >= \\''1\\'' || isnull(pricing.end_number) || pricing.end_number=0)\r\n                      AND pricing.price_type=\\''1\\'' \r\nLEFT JOIN pricing MMprice ON  current_product_list.ProductID = MMprice.ProductID\r\n            AND (MMprice.ContactID=\\''3949\\'')\r\n            AND (MMprice.start_date <= NOW() || isnull(MMprice.start_date) || MMprice.start_date=0) \r\n                      AND (MMprice.end_date >= NOW() || isnull(MMprice.end_date) || MMprice.end_date=0)\r\n                      AND (MMprice.start_number <= \\''1\\'' || isnull(MMprice.start_number) || MMprice.start_number=0)\r\n                      AND (MMprice.end_number >= \\''1\\'' || isnull(MMprice.end_number) || MMprice.end_number=0)\r\n                      AND MMprice.price_type=\\''1\\'' \r\nWHERE catalogus.ContactID=\\''3949\\'' AND\r\n      (not Discontinued_yn || pricelist_yn) AND\r\n      merkID = 88 AND\r\n      stock_owner_id = 802\r\nGROUP BY current_product_list.ProductID\r\nORDER BY brand.name, current_product_list.ProductID\r\n', 130),
('Marge per maand door fred', 'SELECT Month(orders.OrderDate),\r\n  sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)) as omzet, \r\n sum((Quantity-to_deliver)*(UnitCost)) as inkoop, \r\n sum(cost_percentage),\r\n sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)) as marge,\r\n 100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nWHERE order_details.stock_owner_id=802 \r\n AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\n        AND orders.employee = 11\r\nGROUP BY month(orders.OrderDate)\r\nORDER BY orders.OrderDate DESC\r\n', 131),
('Iwex ean list', 'SELECT ProductID, ProductName, EAN, Merk\r\nFROM current_product_list\r\nWHERE EAN like \\"871759189%\\"\r\nORDER BY EAN', 132),
('Searchdog go one', 'SELECT \r\n   ProductName, \r\n   current_product_list.externalID,\r\n   current_product_list.ProductID,\r\n   sum(UnitsSold) as total, \r\n   sum(UnitsSold*UnitPrice) as turnover\r\nfrom inventory_transactions\r\nINNER JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\n        AND NOT orders.rma_yn\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE \r\n   orders.ContactID =\\''3778\\'' AND \r\n   merkID=\\''22\\'' AND \r\n   YEAR( transactiondate ) = YEAR(NOW())-1\r\n   AND (inventory_transactions.ProductID = 992553\r\n     OR inventory_transactions.ProductID = 992554\r\nOR inventory_transactions.ProductID = 992555\r\nOR inventory_transactions.ProductID = 992965\r\nOR inventory_transactions.ProductID = 992975\r\nOR inventory_transactions.ProductID = 993037\r\nOR inventory_transactions.ProductID = 993013\r\nOR inventory_transactions.ProductID = 993077\r\nOR inventory_transactions.ProductID = 993078\r\nOR inventory_transactions.ProductID = 993079\r\nOR inventory_transactions.ProductID = 992571\r\nOR inventory_transactions.ProductID = 992998)\r\nGROUP BY current_product_list.externalID\r\nOrder by current_product_list.externalID', 133),
('Harense Omzet', 'SELECT DATE_FORMAT(Invoice_date,\\''%d %b %Y\\'') as month, invoices.InvoiceID, invoices.Shipname, invoices.invoice_total as omzet\r\nfrom invoices\r\nINNER JOIN shipments ON shipments.Shipment_ID = invoices.ShipmentID\r\nINNER JOIN inventory_transactions ON inventory_transactions.ShipmentID = invoices.ShipmentID\r\nINNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID\r\nWHERE invoices.CustomerID =\\''4286\\'' AND \r\n YEAR( Invoice_date ) > YEAR(NOW())-2\r\nGROUP BY invoices.Invoice_date\r\nOrder by Invoice_date;', 134),
('Harense Aantallen mnd', 'SELECT distinctrow YEAR(inventory_transactions.TransactionDate) as Y, QUARTER(inventory_transactions.TransactionDate) as Q, MONTH(inventory_transactions.TransactionDate) as month,\r\nAdressen.Naam, current_product_list.ProductName,  SUM(inventory_transactions.UnitsSold) AS Aantal, SUM(inventory_transactions.UnitPrice*inventory_transactions.UnitsSold) as omzet\r\nfrom inventory_transactions\r\nINNER JOIN shipments ON shipments.Shipment_ID = inventory_transactions.ShipmentID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID\r\nWHERE Adressen.ContactID =\\''4286\\'' AND\r\n      inventory_transactions.UnitPrice > 0 AND\r\n  YEAR( inventory_transactions.TransactionDate ) > YEAR(NOW())-2 AND\r\n    current_product_list.MerkID = 22 AND\r\n  current_product_list.CategoryID = 13\r\nGROUP BY MONTH( inventory_transactions.TransactionDate  ), current_product_list.ProductID\r\nOrder by inventory_transactions.TransactionDate ;', 135),
('orders typed since yesterday', 'SELECT \r\n  YEAR(OrderDate),\r\n  WEEK(OrderDate),\r\n  employees.FirstName,\r\n  COUNT(OrderID)\r\nFROM orders\r\nINNER JOIN employees ON orders.employee=employees.EmployeeID\r\nWHERE OrderDate > DATE_ADD(NOW(), INTERVAL -1 WEEK) \r\nGROUP BY \r\n employees.EmployeeID,\r\n  YEAR(OrderDate),\r\n  WEEK(OrderDate)\r\nORDER by orderDate\r\n', 223),
('Incasso datums', 'SELECT InvoiceID, invoices.companyName, CustomerID, Invoice_date, \r\nInvoice_total + Invoice_BTW AS amount, paid_amount,\r\nDATE_ADD(IF(endmonth, \r\n    DATE_ADD(CONCAT(YEAR(Invoice_date),\r\n              \\''-\\'',\r\n               MONTH(Invoice_date),\r\n              \\''-01\\''),\r\n            INTERVAL 1 MONTH) - INTERVAL 1 DAY,\r\n      Invoice_date), \r\n    INTERVAL days DAY) AS incaso_date,\r\nWEEK(DATE_ADD(IF(endmonth, \r\n    DATE_ADD(CONCAT(YEAR(Invoice_date),\r\n              \\''-\\'',\r\n               MONTH(Invoice_date),\r\n              \\''-01\\''),\r\n            INTERVAL 1 MONTH) - INTERVAL 1 DAY,\r\n      Invoice_date), \r\n    INTERVAL days DAY)) AS incasso_week\r\n\r\nFROM invoices \r\nLEFT JOIN paymentterm ON Paymentterm = PaymentTermID\r\nWHERE incasso=1 AND NOT paid_yn\r\nORDER BY incasso_week, customerID', 151),
('Harense Smid Marge', 'SELECT MONTH(orders.orderdate) as Month, sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage)) as omzet,   -sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage))*0.02 as bonus_korting, \r\n -sum((UnitsSold)*(UnitCost)) as inkoop, \r\n  sum(cost_percentage),\r\n sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage-UnitCost)) as bruto_marge,\r\n        sum((inventory_transactions.UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage-UnitCost-(inventory_transactions.UnitPrice*0.02))) as netto_marge,\r\n 100*((sum((inventory_transactions.UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage))) / (sum((inventory_transactions.UnitsSold)*(UnitCost)))-1) as \\''bruto%\\'',\r\n100*((sum((inventory_transactions.UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage-(inventory_transactions.UnitPrice*0.02)))) / (sum((UnitsSold)*(UnitCost)))-1) as \\''netto%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNEr JOIN inventory_transactions ON inventory_transactions.OrderDetailsID = order_details.OrderDetailsID\r\nWHERE order_details.stock_owner_id=802 \r\n AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT administration_order\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\n        AND orders.ContactID = \\''4286\\''\r\nGROUP BY MONTH(orders.OrderDate)\r\nOrder by orders.orderdate', 137),
('W margeontwikkeling', 'SELECT MONTH(inventory_transactions.transactiondate ) as Month,    \r\n  sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage)) as omzet, \r\n  sum((UnitsSold)*(UnitCost)) as inkoop, \r\n sum(cost_percentage),\r\n sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage-UnitCost)) as marge,\r\n  100*((sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage))) / (sum((UnitsSold)*(UnitCost)))-1) as \\''%\\'',\r\n sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage-UnitCost))*0.003 as \\"0.3%\\",\r\n sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage-UnitCost))*0.005 as \\"0.5%\\"\r\nFROM inventory_transactions\r\nINNER JOIN orders on orders.OrderID =  inventory_transactions.OrderID\r\nINNER JOIN order_details ON inventory_transactions.orderdetailsID = order_details.OrderDetailsID\r\nWHERE order_details.stock_owner_id=802 \r\n AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT rma_yn\r\n  AND YEAR(inventory_transactions.transactiondate )=YEAR(NOW())\r\nGROUP BY Month\r\nOrder by  MONTH(inventory_transactions.transactiondate ) ', 149),
('MediaMarkt Marge ytd', 'SELECT MONTH(orders.orderdate) as Month,\r\n  ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)),2) as omzet, \r\n  ROUND(sum((Quantity-to_deliver)*(UnitCost)),2) as inkoop, \r\n  ROUND(sum(cost_percentage),2) as \\''added cost\\'',\r\n  ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)),2) as marge,\r\n  ROUND(100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1),2) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN contacts on orders.ContactID = contacts.ContactID\r\nWHERE order_details.stock_owner_id=802 \r\n  AND confirmed_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\n        AND contacts.CompanyName LIKE \\''%media%markt%\\''\r\nGROUP BY MONTH(orders.OrderDate)\r\nOrder by orders.orderdate', 138),
('Covertec prijslijst', 'SELECT DISTINCTROW \r\n  categories.CategoryName as \\''art_grp\\'',\r\n  \\''iwex b.v.\\'' as leverancier,\r\n  brand.name as producent,\r\n  1 as VPE,\r\n  1 as Pl,\r\n  current_product_list.externalID as \\''Ref. Prod\\'',\r\n  current_product_list.ProductID as \\''Iwex Ref.\\'', \r\n  current_product_list.ProductName, \r\n  current_product_list.Retail_price_ex*1.19 as Verkoop,\r\n  IF(MMprice.amount,MMprice.amount,pricing.amount) as inkoop,\r\n  current_product_list.EAN,\r\nIF(Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage))>=0,Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)),0) as voorraad\r\nFROM current_product_list\r\nLEFT JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN categories ON current_product_list.CategoryID = categories.CategoryID\r\nINNER JOIN pricing ON  current_product_list.ProductID = pricing.ProductID\r\n           AND (pricing.ContactID=0)\r\n             AND (pricing.start_date <= NOW() || isnull(pricing.start_date) || pricing.start_date=0) \r\n                      AND (pricing.end_date >= NOW() || isnull(pricing.end_date) || pricing.end_date=0)\r\n                      AND (pricing.start_number <= \\''100\\'' || isnull(pricing.start_number) || pricing.start_number=0)\r\n                      AND (pricing.end_number >= \\''100\\'' || isnull(pricing.end_number) || pricing.end_number=0)\r\n                      AND pricing.price_type=\\''1\\'' \r\nLEFT JOIN pricing MMprice ON  current_product_list.ProductID = MMprice.ProductID\r\n            AND (MMprice.ContactID=\\''3949\\'')\r\n            AND (MMprice.start_date <= NOW() || isnull(MMprice.start_date) || MMprice.start_date=0) \r\n                      AND (MMprice.end_date >= NOW() || isnull(MMprice.end_date) || MMprice.end_date=0)\r\n                      AND (MMprice.start_number <= \\''100\\'' || isnull(MMprice.start_number) || MMprice.start_number=0)\r\n                      AND (MMprice.end_number >= \\''100\\'' || isnull(MMprice.end_number) || MMprice.end_number=0)\r\n                      AND MMprice.price_type=\\''1\\'' \r\nWHERE MerkID=\\''73\\'' and (not Discontinued_yn || pricelist_yn)\r\nGROUP BY current_product_list.ProductID\r\nORDER BY brand.name, current_product_list.ProductID', 140),
('Verschil in stock waarde', 'SELECT current_product_list.ProductID, ProductName,\r\n                      round((stock * IF(buy.purchase_price,\r\n                                   buy.purchase_price * valuta.ValutaXrate,\r\n                                  Purchase_price_home)),2) AS amount,\r\n                                   stock, Purchase_price_home AS WH_cost, extra_cost, buy.purchase_price as buy_price\r\n                     FROM current_product_list\r\n                     LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = 802\r\n                     LEFT JOIN pricing_purchase buy ON buy.productID = current_product_list.ProductID\r\n                        AND (start_date <= NOW() || isnull(start_date) || start_date=0) \r\n                        AND (end_date >= NOW() || isnull(end_date) || end_date=0)\r\n                      LEFT JOIN valuta ON buy.currencyid = valuta.ValutaID\r\n                     WHERE (NOT Discontinued_yn AND (sku=1 OR sku=0)\r\n                                  OR Pricelist_yn AND Discontinued_yn AND location_ID\r\n                                  OR stock AND (sku=1 OR sku=0))\r\n                            AND stock AND Purchase_price_home != buy.purchase_price * valuta.ValutaXrate', 186),
('Media Markt omzet per Q', 'SELECT distinctrow CONCAT(YEAR(transactiondate), \\"-Q\\" , QUARTER(transactiondate)) as Year_q, \r\n  contacts.CompanyName,  \r\n sum((UnitsSold)*UnitPrice) as total, \r\n brand.name\r\nFROM inventory_transactions\r\nLEFT JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE YEAR( transactiondate ) = YEAR (NOW())-1\r\n AND contacts.CompanyName LIKE \\''%media%markt%\\''\r\nGROUP BY Year_q, Adressen.naam\r\nOrder by  Year_q DESC, total ;', 142),
('Watersport catalog', 'SELECT DISTINCTROW \r\n  categories.CategoryName as \\''art_grp\\'',\r\n  \\''iwex b.v.\\'' as leverancier,\r\n  brand.name as producent,\r\n  1 as VPE,\r\n  1 as Pl,\r\n  current_product_list.externalID as \\''Ref. Prod\\'',\r\n  current_product_list.ProductID as \\''Iwex Ref.\\'', \r\n  current_product_list.ProductName, \r\n  current_product_list.Retail_price_ex*1.19 as Verkoop,\r\n  IF(MMprice.amount,MMprice.amount,pricing.amount) as inkoop,\r\n  current_product_list.EAN,\r\nIF(Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage))>=0,Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)),0) as voorraad,\r\n  CONCAT(\\"<A TARGET=\\''_new\\'' HREF=\\''http://www.iwex.nl/component/page,shop.product_details/flypage,shop.flypage_iwex/product_id,\\" , current_product_list.ProductID ,\\"/category_id,3/option,com_phpshop/Itemid,48/\\''>link</A>\\") as link\r\nFROM current_product_list\r\nLEFT JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN categories ON current_product_list.CategoryID = categories.CategoryID\r\nINNER JOIN catalogusdetails ON current_product_list.ProductID = catalogusdetails.ProductID\r\nINNER JOIN catalogus ON catalogusdetails.CatalogusID = catalogus.CatalogusID\r\nINNER JOIN pricing ON  current_product_list.ProductID = pricing.ProductID\r\n           AND (pricing.ContactID=0)\r\n             AND (pricing.start_date <= NOW() || isnull(pricing.start_date) || pricing.start_date=0) \r\n                      AND (pricing.end_date >= NOW() || isnull(pricing.end_date) || pricing.end_date=0)\r\n                      AND (pricing.start_number <= \\''1\\'' || isnull(pricing.start_number) || pricing.start_number=0)\r\n                      AND (pricing.end_number >= \\''1\\'' || isnull(pricing.end_number) || pricing.end_number=0)\r\n                      AND pricing.price_type=\\''1\\'' \r\nLEFT JOIN pricing MMprice ON  current_product_list.ProductID = MMprice.ProductID\r\n            AND (MMprice.ContactID=\\''4286\\'')\r\n            AND (MMprice.start_date <= NOW() || isnull(MMprice.start_date) || MMprice.start_date=0) \r\n                      AND (MMprice.end_date >= NOW() || isnull(MMprice.end_date) || MMprice.end_date=0)\r\n                      AND (MMprice.start_number <= \\''1\\'' || isnull(MMprice.start_number) || MMprice.start_number=0)\r\n                      AND (MMprice.end_number >= \\''1\\'' || isnull(MMprice.end_number) || MMprice.end_number=0)\r\n                      AND MMprice.price_type=\\''1\\'' \r\nWHERE catalogus.ContactID=\\''4501\\''\r\nGROUP BY current_product_list.ProductID\r\nORDER BY brand.name, current_product_list.ProductID\r\n', 145),
('Media Markt omzet per Q keomo', 'SELECT\r\n    YEAR(transactiondate) as Y,\r\n    QUARTER(transactiondate) as Q, \r\n contacts.CompanyName,  \r\n sum((UnitsSold)*UnitPrice) as total\r\nFROM inventory_transactions\r\nLEFT JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE contacts.CompanyName LIKE \\''%media%markt%\\'' OR\r\n      contacts.CompanyName LIKE \\''%saturn%zuidplein%\\''\r\n AND current_product_list.merkID = \\''88\\''\r\nGROUP BY Y, Q, contacts.CompanyName\r\nOrder by  Y DESC, Q DESC, contacts.CompanyName;', 146),
('TomTom sell out Phonehouse', 'SELECT  \r\n  DATE_FORMAT(shipments.Ship_date,\\''%Y-%c\\'') as month, \r\n current_product_list.ProductID, \r\n  current_product_list.externalID, \r\n ProductName, \r\n CompanyName, Country, \r\n  sum(UnitsSold) as total\r\nFROM current_product_list\r\nINNER JOIN inventory_transactions on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\n        AND NOT orders.rma_yn\r\nINNER JOIN shipments ON shipments.Shipment_ID = inventory_transactions.shipmentID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE   YEAR(shipments.Ship_Date) = YEAR(now()) \r\n  AND (Supplier=647 OR Supplier=4210) \r\n        AND orders.ContactID = 3396\r\nGROUP BY month, current_product_list.ProductID\r\nORDER BY month, current_product_list.externalID', 147),
('MM RMA', 'SELECT `RMA`.`ID`, `RMA`.`contacts_id`, `RMA_state`.`State_ID`, `RMA_state`.`State_text`, `RMA`.`Customer_ID`, \r\n`RMA`.`Date_done`, `RMA`.`Date_in` , RMA_product_customer.State_text as customer_State, ProductName,\r\nRMA_actions.Notes\r\nFROM `iwex`.`RMA` `RMA` \r\nINNER JOIN `iwex`.`RMA_state` `RMA_state` ON `RMA_state`.`State_ID` = `RMA`.`State`\r\nINNER JOIN RMA_product_customer on RMA.product_customer = RMA_product_customer.State_ID\r\nINNER JOIN current_product_list on RMA.ProductID = current_product_list.ProductID\r\nINNER JOIN RMA_actions on RMA.ID = RMA_actions.RMAID\r\nWHERE  \r\n`RMA`.`contacts_id` = 88 AND \r\n`RMA_state`.`State_ID` <> 9 AND\r\nRMA.product_customer = 1\r\nGROUP BY RMA.ID\r\nORDER BY RMA.ID,RMA_state.State_text', 154),
('tomtom turnover', 'SELECT distinctrow merk,\r\n  YEAR(inventory_transactions.TransactionDate) as YEAR,\r\n  SUM(UnitsSold) as Aantal, \r\n  SUM(UnitsSold*UnitPrice) as Euros\r\nFROM inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nWHERE merkID=\\''22\\'' AND\r\n   (YEAR(transactiondate) = YEAR(now()) OR YEAR(transactiondate) = (YEAR(now())-1))\r\nGROUP BY year\r\nORDER BY year', 164),
('Tomtom sell out telepointer', 'SELECT  \r\n MONTH(shipments.Ship_date) as month, \r\n current_product_list.ProductID, \r\n  current_product_list.externalID, \r\n ProductName, \r\n CompanyName, Country, \r\n  sum(UnitsSold) as total\r\nFROM current_product_list\r\nINNER JOIN inventory_transactions on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\n        AND NOT orders.rma_yn\r\nINNER JOIN shipments ON shipments.Shipment_ID = inventory_transactions.shipmentID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE   YEAR(shipments.Ship_Date) = YEAR(now()) \r\n  AND (Supplier=647 OR Supplier=4210) \r\n        AND orders.ContactID = 840\r\nGROUP BY month, current_product_list.ProductID\r\nORDER BY month, current_product_list.externalID', 153),
('Euler omzet', 'SELECT sum(Invoice_total) AS omzet, Description,\r\nCountry\r\nFROM invoices\r\nLEFT JOIN paymentterm ON Paymentterm = PaymentTermID\r\nWHERE Invoice_date >= \\''2005-08-01 00:00\\''\r\n AND Invoice_date <  \\''2006-08-01 00:00\\''\r\nGROUP BY Country, PaymentTermID', 155),
('euler', 'SELECT sum(Invoice_total) AS omzet, Description, PaymentTermID,\r\ncontacts.Country\r\nFROM invoices\r\nINNER JOIN  contacts ON ContactID = CustomerID\r\nLEFT JOIN paymentterm ON invoices.Paymentterm = PaymentTermID\r\nWHERE Invoice_date >= \\''2006-08-01 00:00\\''\r\n  AND Invoice_date <  \\''2007-08-01 00:00\\''\r\n  AND Invoice_date < SUBDATE(paid_date, 2)\r\n  AND PaymentTermID != 3\r\n  AND CustomerID != 840\r\n AND CustomerID != 4286\r\n  AND CustomerID != 4275\r\nGROUP BY contacts.Country, PaymentTermID', 156),
('Harense Aantallen Q', 'SELECT distinctrow \r\nYEAR(inventory_transactions.TransactionDate) as Y, \r\nQUARTER(inventory_transactions.TransactionDate) as Q, \r\nAdressen.Naam, \r\nSUM(inventory_transactions.UnitsSold) AS Aantal, SUM(inventory_transactions.UnitPrice*inventory_transactions.UnitsSold) as omzet\r\nfrom inventory_transactions\r\nINNER JOIN shipments ON shipments.Shipment_ID = inventory_transactions.ShipmentID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID\r\nWHERE Adressen.ContactID =\\''4286\\'' AND\r\n      categoryID = 13\r\nGROUP BY YEAR( inventory_transactions.TransactionDate  ), QUARTER( inventory_transactions.TransactionDate  )\r\nOrder by inventory_transactions.TransactionDate ;', 157),
('Harense RMA', 'SELECT  DATE_FORMAT(RMA.Date_in,\\''%b %y\\'') as month,\r\nAVG(TO_DAYS(RMA_actions.ActionDate)-TO_DAYS(RMA.Date_in)) as \\''Avg Responsetime\\''\r\nFROM `iwex`.`RMA` `RMA` \r\nINNER JOIN `iwex`.`RMA_state` `RMA_state` ON `RMA_state`.`State_ID` = `RMA`.`State`\r\nINNER JOIN RMA_product_customer on RMA.product_customer = RMA_product_customer.State_ID\r\nINNER JOIN current_product_list on RMA.ProductID = current_product_list.ProductID\r\nINNER JOIN RMA_actions on RMA.ID = RMA_actions.RMAID\r\nINNER JOIN RMA_subject on RMA_actions.Subject = RMA_subject.Subject_ID AND RMA_subject.Subject_ID = 4\r\nWHERE  \r\nRMA.contacts_id = 4286 AND\r\nRMA.Date_in > \\''2004-01-01\\''\r\nGroup BY month\r\norder by RMA.Date_in', 158),
('Omzet Invoiced', 'SELECT DATE_FORMAT(Invoice_date, \\"%Y-%m\\") as \\''Year_Month\\'',    \r\n  ROUND(sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage)),2) as omzet, \r\n sum((UnitsSold)*(UnitCost)) as inkoop, \r\n ROUND(sum(cost_percentage*UnitsSold),2) as extra_cost,\r\n  ROUND(sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage-UnitCost)) ,2)as marge,\r\n ROUND(100*((sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage))) / (sum((UnitsSold)*(UnitCost)))-1),2) as \\''%\\''\r\nFROM inventory_transactions\r\nINNER JOIN orders on orders.OrderID =  inventory_transactions.OrderID\r\nINNER JOIN order_details ON inventory_transactions.orderdetailsID = order_details.OrderDetailsID\r\nINNER JOIN invoices ON invoices.shipmentID = inventory_transactions.shipmentID\r\nWHERE order_details.stock_owner_id=802 \r\n  AND ( YEAR(Invoice_date) = YEAR(NOW()) -1 OR\r\n      (YEAR(Invoice_date) = YEAR(NOW())))\r\nGROUP BY  YEAR(Invoice_date) , MONTH(Invoice_date)\r\nORDER BY  Invoice_date', 159),
('Omzet op facturen', 'SELECT YEAR(Invoice_date), MONTH(Invoice_date),\r\nIF(invoices.orderID,\r\nSUM(order_details.Quantity*(order_details.UnitPrice+order_details.cost_percentage)),\r\nSUM(inventory_transactions.UnitsSold*(inventory_transactions.UnitPrice+order_details.UnitCost))) as Turnover\r\nFROM invoices\r\nLEFT JOIN order_details ON invoices.orderID = order_details.OrderID\r\nLEFT JOIN inventory_transactions ON invoices.shipmentID = inventory_transactions.shipmentID\r\nLEFT JOIN order_details shipped_details ON inventory_transactions.orderdetailsID = shipped_details.orderdetailsID\r\nWHERE YEAR(Invoice_date) = YEAR(NOW())\r\nGROUP BY MONTH(Invoice_date)\r\nORDER BY  Invoice_date', 160),
('voorraad 1 jan', 'SELECT DISTINCTROW current_product_list.ProductID, current_product_list.ProductName, \r\nSum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)) *UnitPrice AS Stock_value\r\nFROM current_product_list \r\nINNER JOIN inventory_transactions ON current_product_list.ProductID = inventory_transactions.ProductID\r\nGROUP BY current_product_list.ProductID', 161),
('Payments to receive in week', 'SELECT SUM(Invoice_total + Invoice_BTW-paid_amount) AS amount_to_receive, \r\n   DATE_FORMAT(IF(endmonth, \r\n      DATE_ADD(CONCAT(YEAR(Invoice_date),\r\n             \\''-\\'',\r\n            MONTH(Invoice_date),\r\n            \\''-01\\''),\r\n          INTERVAL 1 MONTH) - INTERVAL 1 DAY,\r\n      Invoice_date) + INTERVAL (days + Paymentterm_margin) DAY, \\"%x-%v\\" ) AS dueweek         \r\nFROM invoices \r\nLEFT JOIN paymentterm ON Paymentterm = PaymentTermID\r\nLEFT JOIN contacts ON CustomerID  =  ContactID\r\nWHERE NOT paid_yn AND Invoice_date > DATE_ADD(NOW(), INTERVAL -9 MONTH)\r\nGROUP BY dueweek\r\nORDER BY dueweek', 163),
('TomTom salesthrough', 'SELECT o.ProductID, c.ProductName, WEEK(orders.OrderDate) as Week, (o.Quantity-o.to_deliver)  as SALESTHROUGH\r\nFROM order_details o\r\nINNER JOIN orders ON o.OrderID = orders.OrderID\r\nINNER JOIN current_product_list c ON o.ProductID = c.ProductID\r\nINNER JOIN inventory_transactions i ON o.OrderDetailsID = i.OrderDetailsID\r\nINNER JOIN shipments s ON i.ShipmentID = shipment_ID\r\nWHERE YEAR(orders.OrderDate) = 2006 AND \r\n WEEK(orders.OrderDate) > WEEK(NOW())-10 AND\r\n MerkID = 22 AND\r\n        NOT administration_order\r\nGROUP BY WEEK(orders.OrderDate), o.ProductID\r\nORDER BY o.ProductID, WEEK(orders.OrderDate)', 165),
('Keomo Salesthrough', 'SELECT o.ProductID, c.ProductName, WEEK(orders.OrderDate) as Week, (o.Quantity-o.to_deliver)  as SALESTHROUGH\r\nFROM order_details o\r\nINNER JOIN orders ON o.OrderID = orders.OrderID\r\nINNER JOIN current_product_list c ON o.ProductID = c.ProductID\r\nINNER JOIN inventory_transactions i ON o.OrderDetailsID = i.OrderDetailsID\r\nINNER JOIN shipments s ON i.ShipmentID = shipment_ID\r\nWHERE YEAR(orders.OrderDate) = 2006 AND \r\n  WEEK(orders.OrderDate) > WEEK(NOW())-10 AND\r\n MerkID = 88 AND\r\n        NOT administration_order\r\nGROUP BY WEEK(orders.OrderDate), o.ProductID\r\nORDER BY o.ProductID, WEEK(orders.OrderDate)', 167),
('Voorraad - tijd', 'SELECT \r\n  (DATEDIFF(now(),max(inventory_transactions.TransactionDate))<=30) as \\''<30\\'', \r\n  (DATEDIFF(now(),max(inventory_transactions.TransactionDate))<=60) as \\''<60\\'',\r\n (DATEDIFF(now(),max(inventory_transactions.TransactionDate))<=90) as \\''<90\\'',\r\n (DATEDIFF(now(),max(inventory_transactions.TransactionDate))>90) as \\''>90\\'',\r\n  SUM(product_stock.stock) as \\''#\\'', \r\n SUM(product_stock.stock * current_product_list.Purchase_price_home) as Waarde \r\nFROM inventory_transactions\r\nINNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID\r\nINNER JOIN product_stock ON product_stock.Product_ID = inventory_transactions.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.MerkID\r\nINNER JOIN po_details ON po_details.podetailsID = inventory_transactions.podetailsID\r\nINNER JOIN purchase_orders ON purchase_orders.PurchaseOrderID = po_details.poID\r\nWHERE (product_stock.stock \r\n     OR Pricelist_yn AND Discontinued_yn AND location_ID\r\n     OR stock AND (sku=1 OR sku=0))\r\n    AND (NOT Discontinued_yn AND (sku=1 OR sku=0))\r\n    AND UnitsReceived > 0\r\nGROUP BY YEAR(inventory_transactions.TransactionDate)\r\nORDER BY (DATEDIFF(now(),max(inventory_transactions.TransactionDate))) DESC', 168),
('Media Markt omzet per Q Keomo admin', 'SELECT \r\n  YEAR(orders.OrderDate) as Y,\r\n  QUARTER(orders.OrderDate) as Q, \r\n  contacts.CompanyName,  \r\n  sum((Quantity-to_deliver)*UnitPrice) as total\r\nFROM order_details\r\nINNER JOIN orders on order_details.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nINNER JOIN current_product_list on order_details.ProductID = current_product_list.ProductID\r\nWHERE YEAR( orders.OrderDate) = YEAR (NOW())-1\r\n AND (contacts.CompanyName LIKE \\''%media%markt%\\'' OR\r\n      contacts.CompanyName LIKE \\''%saturn%zuidplein%\\'')\r\n AND administration_order\r\nGROUP BY Y, Q, CompanyName\r\nOrder by Y, Q DESC, CompanyName;', 207),
('pricelist No stock EOL', 'SELECT DISTINCTROW \r\n  current_product_list.ProductID, \r\n  current_product_list.ExternalID, \r\n  current_product_list.ProductName,\r\n  Pricelist_yn,\r\n  Discontinued_yn,\r\n  stock \r\nFROM current_product_list\r\nINNER JOIN product_stock on current_product_list.ProductID = product_stock.Product_ID AND owner_id = \\''802\\''\r\nWHERE current_product_list.Pricelist_yn        \r\n        AND Pricelist_yn\r\n        AND Discontinued_yn\r\n        AND NOT stock\r\nGROUP BY current_product_list.ProductID\r\nORDER BY current_product_list.ExternalID;', 169),
('Media Markt Catalog v2', 'SELECT current_product_list.ProductID, \r\n  brand.name,\r\n  current_product_list.ExternalID,   \r\n  ProductName, \r\n  EAN,\r\n  IF(MMprice.amount,MMprice.amount,pricing.amount) as inkoop, \r\n  IF(MMprice.start_number>1,MMprice.start_number,\\''\\'') as minimum,\r\n  Retail_price_ex as RRP_ex, Retail_price_ex*1.19 as RRP_incl\r\nFROM current_product_list\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN categories ON current_product_list.CategoryID = categories.CategoryID\r\nLEFT JOIN catalogusdetails ON current_product_list.ProductID = catalogusdetails.ProductID\r\nLEFT JOIN catalogus ON catalogusdetails.CatalogusID = catalogus.CatalogusID\r\nLEFT JOIN pricing ON  current_product_list.ProductID = pricing.ProductID\r\n            AND (pricing.ContactID=0)\r\n             AND (pricing.start_date <= NOW() || isnull(pricing.start_date) || pricing.start_date=0) \r\n                      AND (pricing.end_date >= NOW() || isnull(pricing.end_date) || pricing.end_date=0)\r\n                      AND (pricing.start_number <= \\''1\\'' || isnull(pricing.start_number) || pricing.start_number=0)\r\n                      AND (pricing.end_number >= \\''1\\'' || isnull(pricing.end_number) || pricing.end_number=0)\r\n                      AND pricing.price_type=\\''1\\'' \r\nLEFT JOIN pricing MMprice ON  current_product_list.ProductID = MMprice.ProductID\r\n            AND (MMprice.ContactID=\\''3949\\'')\r\n            AND (MMprice.start_date <= NOW() || isnull(MMprice.start_date) || MMprice.start_date=0) \r\n                      AND (MMprice.end_date >= NOW() || isnull(MMprice.end_date) || MMprice.end_date=0)\r\n                      AND MMprice.price_type=\\''1\\'' \r\nWHERE (catalogus.ContactID=\\''3949\\'' OR MerkID=\\''22\\'') AND Pricelist_yn\r\nGROUP BY current_product_list.ProductID\r\nORDER BY brand.name, current_product_list.ExternalID', 170),
('Turnover per brand', 'SELECT distinctrow \r\n  brand.Name,\r\n  SUM(UnitsSold) as Aantal, \r\n  SUM(UnitsSold*order_details.UnitPrice) as Euros,\r\n  SUM(UnitsSold*(order_details.UnitPrice-UnitCost)) as margin\r\nFROM inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN order_details ON order_details.OrderDetailsID = inventory_transactions.orderdetailsID\r\nINNER JOIN orders ON orders.OrderID = order_details.OrderID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.MerkID\r\nWHERE \r\n  YEAR(transactiondate) = YEAR(now())\r\n  AND NOT rma_yn\r\nGROUP BY MerkID\r\nORDER BY Euros DESC', 171),
('TomTom sales out 06', 'SELECT DISTINCTROW DATE_FORMAT(inventory_transactions.TransactionDate,\\''%d/%m/%Y\\'') as date, \r\n  CompanyName, \r\n current_product_list.ProductName, \r\n  sum(UnitsSold) as total, \r\n order_details.UnitPrice as Verkoop,   \r\n  SUM(order_details.UnitPrice*UnitsSold) as turnover, \r\n  current_product_list.externalID \r\nFROM inventory_transactions \r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\n        AND NOT orders.rma_yn\r\nINNER JOIN order_details on orders.OrderID=order_details.OrderID\r\n AND  inventory_transactions.ProductID=order_details.ProductID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE \r\n YEAR(transactiondate) = 2006\r\nGROUP BY date, contacts.contactID, inventory_transactions.ProductID \r\nOrder by date, current_product_list.externalID', 172),
('TomTom sell out 06', 'SELECT  DATE_FORMAT(shipments.Ship_Date,\\''%s\\'') as Week,\r\n  current_product_list.ProductID, \r\n  current_product_list.externalID, \r\n ProductName, \r\n contacts.ContactID, \r\n  CompanyName, Country, \r\n  sum(UnitsSold) as total\r\nFROM current_product_list\r\nINNER JOIN inventory_transactions on inventory_transactions.ProductID=current_product_list.ProductID\r\nLEFT JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\n        AND NOT orders.rma_yn\r\nINNER JOIN shipments ON shipments.Shipment_ID = inventory_transactions.shipmentID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE   YEAR(Ship_Date) = 2006 \r\n  AND (Supplier=647 OR Supplier=4210) \r\nGROUP BY contacts.ContactID, Week, current_product_list.ProductID\r\nORDER BY contacts.CompanyName, Week, current_product_list.externalID', 173),
('Public products EOL', 'SELECT DISTINCTROW \r\n  ProductID,\r\n  current_product_list.Merk, \r\n  MerkID, \r\n  ProductName,\r\n  product_stock.stock,\r\n  pricelist_yn,\r\n  Discontinued_yn,\r\n  public\r\nFROM current_product_list\r\nINNER JOIN product_stock ON product_stock.Product_ID = current_product_list.ProductID\r\nWHERE public\r\n  AND NOT product_stock.stock\r\n  AND Discontinued_yn\r\nORDER BY pricelist_yn, Merk', 198),
('306090', 'SELECT inventory_transactions.ProductID, \r\n DATEDIFF(now(),max(inventory_transactions.TransactionDate)) as dagen,\r\n IF(DATEDIFF(now(),max(inventory_transactions.TransactionDate))<30, product_stock.stock,0) as 30dagen, \r\n  IF(DATEDIFF(now(),max(inventory_transactions.TransactionDate))>=30 AND DATEDIFF(now(),max(inventory_transactions.TransactionDate))<60, product_stock.stock,0) as 60dagen, \r\n  IF(DATEDIFF(now(),max(inventory_transactions.TransactionDate))>=60, product_stock.stock,0) as 90dagen, \r\n (product_stock.stock * current_product_list.Purchase_price_home) as Waarde, \r\n  current_product_list.ProductName, \r\n  brand.name, \r\n  current_product_list.pricelist_yn as On_list, \r\n  Discontinued_yn as EOL\r\nFROM inventory_transactions\r\nINNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID\r\nINNER JOIN product_stock ON product_stock.Product_ID = inventory_transactions.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.MerkID\r\nWHERE (product_stock.stock \r\n     OR Pricelist_yn AND Discontinued_yn AND location_ID\r\n     OR stock AND (sku=1 OR sku=0))\r\n     AND (NOT Discontinued_yn AND (sku=1 OR sku=0))\r\n     AND (CategoryID <> 11 AND CategoryID <> 11)\r\nGROUP BY inventory_transactions.ProductID\r\nORDER BY dagen DESC', 174),
('Searchdog TT omzet', 'SELECT \r\n   ProductName, \r\n   current_product_list.externalID,\r\n   current_product_list.ProductID,\r\n   sum(UnitsSold) as total, \r\n   sum(UnitsSold*UnitPrice) as turnover\r\nfrom inventory_transactions\r\nINNER JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\nINNER JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\n        AND NOT orders.rma_yn\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE \r\n   orders.ContactID =\\''3778\\'' AND \r\n   merkID=\\''22\\'' AND \r\n   YEAR( ship_date) = YEAR(NOW())-1\r\n   AND (Supplier=647 OR Supplier=4210) \r\nGROUP BY current_product_list.externalID\r\nOrder by current_product_list.externalID', 175),
('Ageing Stock', 'SELECT inventory_transactions.ProductID, \r\n DATEDIFF(now(),max(inventory_transactions.TransactionDate)) as dagen,\r\n product_stock.stock,\r\n  (product_stock.stock * \r\n (SELECT max(purchase_price)\r\n     FROM  current_product_list\r\n      LEFT JOIN pricing_purchase pprice ON current_product_list.ProductID = pprice.ProductID\r\n      WHERE inventory_transactions.ProductID = pprice.ProductID\r\n       AND (pprice.start_date <= NOW() || isnull(pprice.start_date) || pprice.start_date=0) \r\n        AND (pprice.end_date >= NOW() || isnull(pprice.end_date) || pprice.end_date=0)))   \r\n   as Waarde, \r\n  current_product_list.ProductName, \r\n  brand.name, \r\n  current_product_list.pricelist_yn as On_list, \r\n  Discontinued_yn as EOL,\r\n  owner_id\r\nFROM inventory_transactions\r\nINNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID\r\nINNER JOIN product_stock ON product_stock.Product_ID = inventory_transactions.ProductID AND owner_id = 802\r\nINNER JOIN brand ON brand.brand_id = current_product_list.MerkID\r\nWHERE ((pricelist_yn = 1 AND location_ID) OR stock)\r\n     AND (sku=1 OR sku=0)\r\n     AND (inventory_transactions.PurchaseOrderID)\r\n     AND NOT categoryID = 6\r\n     AND NOT categoryID = 7\r\n     AND NOT categoryID = 8 \r\n     AND NOT categoryID = 10\r\n     AND NOT categoryID = 11\r\n     AND NOT categoryID = 12\r\nGROUP BY inventory_transactions.ProductID\r\nORDER BY dagen DESC', 176),
('Admin factuur details', 'SELECT `invoices`.`Invoice_date`,\r\norders.OrderID,\r\n`order_details`.`ProductID`,\r\n`order_details`.`ProductName` AS Name ,\r\n SUM(`UnitPrice` * `Quantity`) AS Amount\r\nFROM `iwex`.`orders` AS `orders`, `iwex`.`invoices` AS `invoices`, `iwex`.`order_details` AS `order_details`, `iwex`.`current_product_list` AS `current_product_list`\r\nWHERE ( `orders`.`OrderID` = `invoices`.`orderID`\r\n AND `order_details`.`OrderID` = `orders`.`OrderID` \r\nAND `current_product_list`.`ProductID` = `order_details`.`ProductID` )\r\n AND ( ( `current_product_list`.`CategoryID` = 11 ) OR sku = 3  )\r\nAND invoices.Invoice_Date >= DATE_ADD(CONCAT(YEAR(NOW()),\r\n            \\''-\\'',\r\n            MONTH(NOW()),\r\n           \\''-01\\''), INTERVAL -2 MONTH) \r\nGROUP BY `invoices`.`Invoice_date`, Name, ProductID', 185),
('Productstock_EOL_on-stock', 'SELECT stock, Purchase_price_home as cost, sum(stock*Purchase_price_home) as value, name, ProductID, ProductName, Location\r\nFROM product_stock \r\nLEFT JOIN location ON location.ID = product_stock.location_id\r\nINNER JOIN current_product_list ON current_product_list.ProductID = product_stock.Product_ID\r\nINNER JOIN brand ON brand.brand_ID = current_product_list.merkID\r\nWHERE \r\n  owner_ID = 802\r\n  AND stock\r\nGROUP BY ProductID\r\nORDER BY MerkID', 184),
('No taric code', 'SELECT ProductID, ProductName, euproductcode, Taric FROM current_product_list WHERE !euproductcode AND pricelist_yn', 177),
('Stock from supplier', 'SELECT DISTINCTROW \r\n  current_product_list.ProductID, \r\n  current_product_list.ExternalID, \r\n current_product_list.ProductName,    IF(Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage))<0,0,(Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)))) AS Stock\r\nFROM current_product_list\r\nLEFT JOIN inventory_transactions ON inventory_transactions.ProductID = current_product_list.ProductID\r\nLEFT JOIN orders ON inventory_transactions.OrderID = orders.OrderID \r\n        WHERE (rma_yn <> 1 or rma_yn is Null)\r\n        AND (Supplier=4210) \r\n        AND stock_owner_id = \\''802\\''\r\n    AND current_product_list.ExternalID\r\nGROUP BY current_product_list.ProductID\r\nORDER BY current_product_list.ExternalID;', 178),
('Payments Receiving detail', 'SELECT invoices.InvoiceID, invoices.CompanyName, Invoice_date, \r\n(Invoice_total + Invoice_BTW-paid_amount) AS amount_to_receive, \r\n    DATE_FORMAT(IF(endmonth, \r\n      DATE_ADD(CONCAT(YEAR(Invoice_date),\r\n             \\''-\\'',\r\n            MONTH(Invoice_date),\r\n            \\''-01\\''),\r\n          INTERVAL 1 MONTH) - INTERVAL 1 DAY,\r\n      Invoice_date) + INTERVAL (days + Paymentterm_margin) DAY, \\"%x-%v\\" ) AS dueweek         \r\nFROM invoices \r\nLEFT JOIN paymentterm ON Paymentterm = PaymentTermID\r\nLEFT JOIN contacts ON CustomerID  =  ContactID\r\nWHERE NOT paid_yn AND Invoice_date > DATE_ADD(NOW(), INTERVAL -9 MONTH)\r\nORDER BY dueweek', 179),
('Payments Due per Customer', 'SELECT invoices.CompanyName, Invoice_date, \r\n(Invoice_total + Invoice_BTW-paid_amount) AS amount_to_receive, \r\n    DATE_FORMAT(IF(endmonth, \r\n      DATE_ADD(CONCAT(YEAR(Invoice_date),\r\n             \\''-\\'',\r\n            MONTH(Invoice_date),\r\n            \\''-01\\''),\r\n          INTERVAL 1 MONTH) - INTERVAL 1 DAY,\r\n      Invoice_date) + INTERVAL (days + Paymentterm_margin) DAY, \\"%x-%v\\" ) AS dueweek         \r\nFROM invoices \r\nLEFT JOIN paymentterm ON Paymentterm = PaymentTermID\r\nLEFT JOIN contacts ON CustomerID  =  ContactID\r\nWHERE NOT paid_yn AND Invoice_date > DATE_ADD(NOW(), INTERVAL -9 MONTH)\r\nGROUP BY invoices.Invoice_date, invoices.CompanyName, dueweek\r\nORDER BY dueweek', 180),
('Products on website not on pricelis', 'select ProductID, ProductName, Pricelist_yn, public, Discontinued_yn\r\nFROM current_product_list\r\nWHERE not Pricelist_yn AND public', 181),
('Tomtom tmc stickers', 'SELECT  \r\n  \r\n current_product_list.ProductID, \r\n  current_product_list.externalID, \r\n ProductName, \r\n contacts.ContactID, \r\n  CompanyName, Country, naam, straat, huisnummer, Postcode, Plaats, \r\n  sum(UnitsSold) as total\r\nFROM current_product_list\r\nINNER JOIN inventory_transactions on inventory_transactions.ProductID=current_product_list.ProductID\r\nLEFT JOIN orders on inventory_transactions.OrderID=orders.OrderID\r\n        AND NOT orders.rma_yn\r\nINNER JOIN shipments ON shipments.Shipment_ID = inventory_transactions.shipmentID\r\nINNER JOIN Adressen ON shipments.AdressID = Adressen.AdresID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE   Ship_Date > \\''2007-02-20\\'' \r\nAND (current_product_list.ProductID = 993078 \r\n  OR current_product_list.ProductID = 993079)\r\n  AND (Supplier=647 OR Supplier=4210) \r\nGROUP BY contacts.ContactID, current_product_list.ProductID, Adressen.AdresID\r\nORDER BY contacts.ContactName, Naam, current_product_list.externalID', 182),
('Stock from supplier - EOL', 'SELECT current_product_list.ExternalID,\r\n        inventory_transactions.ProductID, \r\n  DATEDIFF(now(),max(inventory_transactions.TransactionDate)) as dagen, \r\n  product_stock.stock, \r\n (product_stock.stock * current_product_list.Purchase_price_home) as Waarde, \r\n  current_product_list.ProductName, \r\n  brand.name, \r\n  current_product_list.pricelist_yn as On_list, \r\n  Discontinued_yn as EOL\r\nFROM inventory_transactions\r\nINNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID\r\nINNER JOIN product_stock ON product_stock.Product_ID = inventory_transactions.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.MerkID\r\nWHERE (product_stock.stock\r\n     OR Pricelist_yn AND Discontinued_yn AND location_ID\r\n     OR stock AND (sku=1 OR sku=0))\r\n     AND (Discontinued_yn AND (sku=1 OR sku=0))\r\n     AND (CategoryID <> 11 AND CategoryID <> 11)\r\n     AND (Supplier=815)\r\n     AND product_stock.owner_id = \\''802\\'' \r\nGROUP BY inventory_transactions.ProductID\r\nORDER BY dagen DESC', 183),
('Searchdog Turnover YTD', 'SELECT DATE_FORMAT(Invoice_date,\\''%b %Y\\'') as month,\r\nSum(invoices.Invoice_total) AS Omzet,\r\nSum(invoices.Invoice_total)/100*0.95 AS \\"0,95% rebate\\"\r\nFROM invoices\r\nWHERE invoices.customerID=\\''3778\\'' AND  \r\n  YEAR( Invoice_date ) = YEAR(now()) AND\r\n  invoices.Shipname NOT LIKE \\"%Searchdog%\\"\r\nGROUP BY month\r\nOrder by Invoice_date;', 188),
('Searchdog Turnover per BP', 'SELECT \r\ninvoices.Shipname, \r\nsum(invoices.invoice_total) as omzet\r\nfrom invoices\r\nLEFT JOIN shipments ON shipments.Shipment_ID = invoices.ShipmentID\r\nWHERE  invoices.CustomerID =\\''3778\\'' AND \r\n (YEAR( Invoice_date ) = YEAR(NOW()) OR \r\n        YEAR( Invoice_date ) = YEAR(NOW())-1) \r\n        AND\r\n  invoices.Shipname NOT LIKE \\"%Searchdog%\\"\r\nGROUP BY invoices.Shipname\r\nOrder by omzet DESC;', 189),
('Gewicht 0', 'SELECT ProductID, weight_corr, ProductName\r\nFROM current_product_list\r\nWHERE Pricelist_yn = 1 AND weight_corr = 0', 190),
('Marge <> TomTom', 'SELECT \r\nYEAR(orders.orderdate) as YEAR,\r\nMONTH(orders.orderdate) as Month,    ROUND(sum((UnitsSold)*(order_details.UnitPrice+cost_percentage)),2) as omzet, \r\nROUND(sum((UnitsSold)*(UnitCost)),2) as inkoop, \r\nROUND(sum(cost_percentage),2) as \\"added cost\\",  ROUND(sum((UnitsSold)*(order_details.UnitPrice+cost_percentage-UnitCost)) ,2)as marge,\r\nROUND(100*((sum((UnitsSold)*(order_details.UnitPrice+cost_percentage))) / (sum((UnitsSold)*(UnitCost)))-1),2) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID\r\nLEFT JOIN inventory_transactions ON inventory_transactions.orderdetailsID = order_details.OrderDetailsID\r\nWHERE order_details.stock_owner_id=802 \r\n AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate) >= YEAR(now())-3\r\n        AND NOT (administration_order AND order_details.Productdescription LIKE \\"%protection%\\")\r\n  AND merkID <> 22\r\nGROUP BY YEAR(orders.OrderDate),MONTH(orders.OrderDate)\r\nOrder by orders.orderdate', 191),
('pricelist stock EOL not on ', 'SELECT DISTINCTROW \r\n  current_product_list.ProductID, \r\n  current_product_list.ExternalID, \r\n  current_product_list.ProductName,\r\n  Pricelist_yn,\r\n  Discontinued_yn,\r\n  stock  \r\nFROM current_product_list\r\nINNER JOIN product_stock on current_product_list.ProductID = product_stock.Product_ID AND owner_id = \\''802\\''\r\nWHERE current_product_list.Pricelist_yn        \r\n        AND NOT Pricelist_yn\r\n        AND Discontinued_yn\r\n        AND stock\r\nGROUP BY current_product_list.ProductID\r\nORDER BY current_product_list.ExternalID;', 218);
INSERT INTO `query` (`Name`, `statement`, `ID`) VALUES 
('marge TomTom detail ytd', 'SELECT YEAR(orders.orderdate) as YEAR,\r\nMONTH(orders.orderdate) as Month,\r\norders.OrderID,\r\norder_details.ProductID,\r\nROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)),2) as omzet, \r\nROUND(sum((Quantity-to_deliver)*(UnitCost)),2) as inkoop, \r\nROUND(sum(Quantity-to_deliver)*(cost_percentage),2) as AddedCost,\r\nROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)),2) as marge,\r\nFORMAT(100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1),2) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID\r\nWHERE order_details.stock_owner_id=802 \r\n  AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT administration_order\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate) = YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\n        AND merkID = 22\r\nGROUP BY OrderDetailsID\r\nOrder by orders.orderdate', 192),
('marge <> TomTom detail ytd', 'SELECT YEAR(orders.orderdate) as YEAR,\r\nMONTH(orders.orderdate) as Month,\r\norders.OrderID,\r\nadministration_order as admin,\r\norder_details.ProductID,\r\nROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)),2) as omzet, \r\nROUND(sum((Quantity-to_deliver)*(UnitCost)),2) as inkoop, \r\nROUND(sum(cost_percentage),2) as AddedCost,\r\nROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)),2) as marge,\r\nFORMAT(100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1),2) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID\r\nWHERE order_details.stock_owner_id=802 \r\n AND confirmed_yn\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate) = YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\n        AND merkID <> 22\r\nGROUP BY OrderDetailsID\r\nOrder by orders.orderdate', 193),
('orders typed', 'SELECT \r\n  YEAR(OrderDate),\r\n  WEEK(OrderDate),\r\n  employees.FirstName,\r\n  COUNT(OrderID)\r\nFROM orders\r\nINNER JOIN employees ON orders.employee=employees.EmployeeID\r\nWHERE OrderDate > DATE_ADD(NOW(), INTERVAL -24 month) \r\nGROUP BY \r\n employees.EmployeeID,\r\n  YEAR(OrderDate),\r\n  WEEK(OrderDate)\r\nORDER by orderDate\r\n', 217),
('Seialnumbers Coolblue', 'SELECT productID, ExternalID, Serial, TransactionDate\r\nFROM Serialnumbers\r\nINNER JOIN inventory_transactions ON inventory_transactions.TransactionID = Serialnumbers.Inventory_transactionID\r\nINNER JOIN orders ON orders.OrderID = inventory_transactions.OrderID\r\nWHERE\r\n orders.ContactID = 88\r\n AND YEAR(TransactionDate) = 2007;', 194),
('Media Markt marge zonder rma', 'SELECT MONTH(orders.orderdate) as Month,\r\n  ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)),2) as omzet, \r\n  ROUND(sum((Quantity-to_deliver)*(UnitCost)),2) as inkoop, \r\n  ROUND(sum(cost_percentage),2) as \\''added cost\\'',\r\n  ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)),2) as marge,\r\n  ROUND(100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1),2)-7.5 as \\''%\\''\r\nFROM order_details\r\nINNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN contacts on orders.ContactID = contacts.ContactID\r\nWHERE order_details.stock_owner_id=802 \r\n AND confirmed_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\n        AND contacts.CompanyName LIKE \\''%media%markt%arena%\\''\r\n        AND MerkID <> \\''22\\''\r\n        AND NOT rma_yn\r\nGROUP BY MONTH(orders.OrderDate)\r\nOrder by orders.orderdate', 213),
('Stock from all suppliers - EOL', 'SELECT current_product_list.ExternalID,\r\n        inventory_transactions.ProductID, \r\n DATEDIFF(now(),max(inventory_transactions.TransactionDate)) as dagen, \r\n  product_stock.stock, \r\n (product_stock.stock * current_product_list.Purchase_price_home) as Waarde, \r\n  current_product_list.ProductName, \r\n  brand.name, \r\n  current_product_list.pricelist_yn as On_list, \r\n  Discontinued_yn as EOL\r\nFROM inventory_transactions\r\nINNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID\r\nINNER JOIN product_stock ON product_stock.Product_ID = inventory_transactions.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.MerkID\r\nWHERE (product_stock.stock\r\n     OR Pricelist_yn AND Discontinued_yn AND location_ID\r\n     OR stock AND (sku=1 OR sku=0))\r\n     AND (Discontinued_yn AND (sku=1 OR sku=0))\r\n     AND (CategoryID <> 11 AND CategoryID <> 11)\r\n     AND product_stock.owner_id = \\''802\\''\r\n     AND YEAR(transactiondate) <= YEAR(now())-1 \r\nGROUP BY inventory_transactions.ProductID\r\nORDER BY dagen DESC', 195),
('klanten zonder factuur', 'SELECT \r\n  count(contacts.ContactID) as \\''#\\'', \r\n  orders.OrderID, \r\n  contacts.ContactID, \r\n  contacts.CompanyName, \r\n  Phone, \r\n  Naam, \r\n  attn, \r\n  straat, \r\n  huisnummer, \r\n  postcode, \r\n  plaats, \r\n  contacts.country\r\nFROM contacts\r\nINNER JOIN Adressen ON Adressen.ContactID = contacts.ContactID AND adrestitel <>  \r\n7 AND adrestitel <> 8 AND adrestitel <> 5\r\nLEFT JOIN orders ON orders.ContactID = contacts.ContactID\r\nLEFT JOIN country ON contacts.Country = country.country\r\nLEFT JOIN invoices ON invoices.CustomerID = contacts.ContactID\r\nWHERE isnull(orders.OrderID) \r\n  AND isnull(InvoiceID)\r\n  AND dealer_yn\r\nGROUP BY contacts.ContactID\r\nORDER BY ContactID desc', 196),
('Phonehouse margin', 'SELECT MONTH(orders.orderdate) as Month, sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage)) as omzet,   -sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage))*0.02 as bonus_korting, \r\n  -sum((UnitsSold)*(UnitCost)) as inkoop, \r\n  sum(cost_percentage),\r\n sum((UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage-UnitCost)) as bruto_marge,\r\n        sum((inventory_transactions.UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage-UnitCost-(inventory_transactions.UnitPrice*0.02))) as netto_marge,\r\n 100*((sum((inventory_transactions.UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage))) / (sum((inventory_transactions.UnitsSold)*(UnitCost)))-1) as \\''bruto%\\'',\r\n100*((sum((inventory_transactions.UnitsSold)*(inventory_transactions.UnitPrice+cost_percentage-(inventory_transactions.UnitPrice*0.02)))) / (sum((UnitsSold)*(UnitCost)))-1) as \\''netto%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNEr JOIN inventory_transactions ON inventory_transactions.OrderDetailsID = order_details.OrderDetailsID\r\nWHERE order_details.stock_owner_id=802 \r\n AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT administration_order\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\n        AND orders.ContactID = \\''3396\\''\r\nGROUP BY MONTH(orders.OrderDate)\r\nOrder by orders.orderdate', 197),
('Phonehouse TomTom Invoiced ', 'SELECT\r\n  YEAR(TransactionDate) as Y,\r\n  MONTH(TransactionDate) as M,\r\n  ProductName,\r\n  sum(UnitsSold)\r\nFROM inventory_transactions\r\nINNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID\r\nLEFT JOIN invoices ON invoices.shipmentID = inventory_transactions.ShipmentID\r\nWHERE CustomerID = \\''3396\\'' AND \r\n     YEAR(TransactionDate) = YEAR(now())\r\nGROUP BY inventory_transactions.ProductID, YEAR(TransactionDate) ,   MONTH(TransactionDate)', 230),
('Top openstaande facturen', 'SELECT CustomerID AS ContactID, invoices.companyName, \r\n    sum(Invoice_total) AS exc_btw, sum(Invoice_total + Invoice_BTW) AS amount, sum(paid_amount) AS paid_amount, sum(Invoice_total + Invoice_BTW - paid_amount) AS open_amount,  \r\n    invoices.City, invoices.Country\r\n   FROM invoices \r\n    INNER JOIN contacts ON invoices.CustomerID = contacts.ContactID\r\n   LEFT JOIN paymentterm ON invoices.Paymentterm = PaymentTermID\r\nWHERE NOT paid_yn\r\ngroup by CustomerID\r\norder by open_amount desc\r\n', 199),
('Pipeline per week', 'SELECT YEAR(orders.OrderDate) as Year, WEEK(orders.OrderDate) as week,\r\nROUND(SUM(order_details.to_deliver*order_details.unitPrice),2) as pipeline,\r\nROUND(SUM(order_details.to_deliver*order_details.unitCost),2) as Cost,\r\nROUND(SUM(order_details.to_deliver*(order_details.unitPrice+order_details.cost_percentage-order_details.unitCost)),2) as marge\r\nFROM order_details\r\nINNER JOIN orders ON orders.OrderID = order_details.OrderID\r\nLEFT JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE orders.confirmed_yn = 1 \r\n  AND order_details.to_deliver\r\n  AND orders.Confirmed_yn\r\nGROUP BY YEAR(orders.OrderDate), WEEK(orders.OrderDate)\r\nORDER BY orders.OrderDate DESC\r\n', 200),
('Pipeline total', 'SELECT YEAR(orders.OrderDate) as Year,\r\nROUND(SUM(order_details.to_deliver*order_details.unitPrice),2) as pipeline,\r\nROUND(SUM(order_details.to_deliver*order_details.unitCost),2) as Cost,\r\nROUND(SUM(order_details.to_deliver*(order_details.unitPrice+order_details.cost_percentage-order_details.unitCost)),2) as marge\r\nFROM order_details\r\nINNER JOIN orders ON orders.OrderID = order_details.OrderID\r\nLEFT JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE orders.confirmed_yn = 1 \r\n  AND order_details.to_deliver\r\n  AND orders.Confirmed_yn\r\nGROUP BY YEAR(orders.OrderDate)\r\nORDER BY orders.OrderDate DESC\r\n', 201),
('Klanten zonder login', 'SELECT \r\n  contacts.ContactID,\r\n  contacts.CompanyName,\r\n  contacts.email,\r\n  users.uid,\r\n  users.purchase\r\nFROM contacts\r\nleft JOIN users ON users.ContactID = contacts.ContactID\r\nLEFT JOIN branches ON contacts.ContactID = branches.BrancheContactID \r\n  AND branches.MainContactID<>\\''3778\\''\r\nWHERE ISNULL(users.uid) \r\n  AND NOT Supplier_yn \r\nORDER BY contacts.ContactID;', 202),
('Klanten met login', 'SELECT \r\n  contacts.ContactID,\r\n  contacts.CompanyName,\r\n  users.uid,\r\n  users.purchase\r\nFROM contacts\r\nLEFT JOIN users ON users.ContactID = contacts.ContactID\r\nWHERE users.uid < 1\r\nORDER BY contacts.ContactID;', 203),
('mailing test iwex', 'SELECT DISTINCTROW contacts.ContactID, contacts.CompanyName, Personen.email\r\nFROM iwex.contacts\r\nLEFT JOIN iwex.Personen ON contacts.ContactID = Personen.ContactID\r\n                  AND Personen.Personen_type_ID != \\''8\\''\r\nWHERE Personen.email <> \\''\\'' \r\n      AND contacts.Dealer_yn\r\n      AND contacts.mailing \r\n      AND Personen.mailing_yn\r\n      AND Personen.ContactID = 802\r\nORDER BY contacts.CompanyName', 204),
('mailing standaard', 'SELECT DISTINCTROW contacts.ContactID, contacts.CompanyName, Personen.email\r\nFROM iwex.contacts\r\nLEFT JOIN iwex.Personen ON contacts.ContactID = Personen.ContactID\r\n                  AND Personen.Personen_type_ID != \\''8\\''\r\nWHERE Personen.email <> \\''\\'' \r\n      AND contacts.Dealer_yn\r\n      AND contacts.mailing \r\n      AND Personen.mailing_yn\r\nORDER BY contacts.CompanyName', 205),
('Media Markten', 'SELECT DISTINCTROW\r\n    QUARTER(transactiondate) as Q, \r\n    contacts.CompanyName,  \r\n    sum((UnitsSold)*UnitPrice) as total\r\nFROM contacts\r\nLEFT JOIN orders ON contacts.ContactID = orders.ContactID\r\nLEFT JOIN inventory_transactions on inventory_transactions.OrderID=orders.OrderID\r\nLEFT JOIN current_product_list on inventory_transactions.ProductID=current_product_list.ProductID\r\n  AND current_product_list.merkID = \\''88\\''\r\nWHERE \r\n contacts.CompanyName LIKE \\''%media%markt%\\''\r\n AND YEAR(orders.OrderDate) = YEAR(NOW())\r\nGROUP BY Q, contacts.CompanyName\r\nOrder by Q, CompanyName;', 206),
('marge alles ytd', 'SELECT \r\nYEAR(Invoice_date) as Year,\r\nMONTH(Invoice_date) as \\''Month\\'', ROUND(sum((UnitsSold)*(order_details.UnitPrice+cost_percentage)),2) as omzet, \r\nROUND(sum((UnitsSold)*(UnitCost)),2) as inkoop, \r\nROUND(sum(cost_percentage),2) as \\"added cost\\", ROUND(sum((UnitsSold)*(order_details.UnitPrice+cost_percentage-UnitCost)),2)as marge,\r\nROUND(100*((sum((UnitsSold)*(order_details.UnitPrice+cost_percentage)) / sum((UnitsSold)*(UnitCost)))-1),2) as \\''%\\''\r\nFROM invoices\r\nINNER JOIN inventory_transactions ON invoices.ShipmentID = inventory_transactions.shipmentID\r\nINNER JOIN order_details ON inventory_transactions.orderdetailsID = order_details.OrderDetailsID\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\n  AND NOT rma_yn \r\nINNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID\r\nWHERE YEAR(Invoice_date) >= YEAR(NOW())-2\r\nGROUP BY YEAR(Invoice_date), MONTH(Invoice_date)\r\nOrder by Invoice_date', 208),
('Marge alles ytd detail', 'SELECT YEAR(orders.orderdate) as YEAR,\r\nMONTH(orders.orderdate) as Month,\r\norders.OrderID,\r\norder_details.ProductID,\r\nROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)),2) as omzet, \r\nROUND(sum((Quantity-to_deliver)*(UnitCost)),2) as inkoop, \r\nROUND(sum(cost_percentage),2) as AddedCost,\r\nROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)),2) as marge,\r\nFORMAT(100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1),2) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID\r\nWHERE order_details.stock_owner_id=802 \r\n AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT administration_order\r\n  AND NOT rma_yn\r\n  AND YEAR(orders.orderdate) = YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\nGROUP BY OrderDetailsID\r\nOrder by orders.orderdate', 209),
('shippingcost per month ytd', 'SELECT \r\n  MONTH(orders.OrderDate),\r\n  SUM(Shipping_cost)*0.8\r\nFROM order_margin\r\nINNER JOIN orders ON orders.OrderID = order_margin.OrderID\r\nWHERE \r\n  YEAR(orders.OrderDate) = YEAR(now()) \r\n  AND orders.Confirmed_yn\r\nGROUP BY MONTH(orders.OrderDate)', 231),
('MM Arena marge', 'SELECT orders.OrderID, MONTH(orders.orderdate) as Month,\r\n  SUM((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)) as marge\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN contacts on orders.ContactID = contacts.ContactID\r\nWHERE order_details.stock_owner_id=802 \r\n  AND UnitCost\r\n  AND confirmed_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\n        AND contacts.CompanyName LIKE \\''%media%markt%Arena%\\''\r\nGROUP BY MONTH(orders.OrderDate)\r\nOrder by orders.orderdate', 210),
('Media Markt marge ytd detail', 'SELECT MONTH(orders.orderdate) as Month,\r\n  orders.OrderID,\r\n  contacts.CompanyName,\r\n  ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)),2) as omzet, \r\n  ROUND(sum((Quantity-to_deliver)*(UnitCost)),2) as inkoop, \r\n  ROUND(sum(cost_percentage),2) as \\''added cost\\'',\r\n  ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)),2) as marge,\r\n  ROUND(100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1),2) as \\''%\\'',\r\n  administration_order\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN contacts on orders.ContactID = contacts.ContactID\r\nWHERE order_details.stock_owner_id=802 \r\n AND confirmed_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\n        AND contacts.CompanyName LIKE \\''%media%markt%\\''\r\n        AND NOT rma_yn\r\nGROUP BY orders.OrderID\r\nOrder by contacts.CompanyName, orders.orderdate', 211),
('Media Markt marge per vestiging ytd', 'SELECT \r\n  contacts.ContactID,\r\n  contacts.CompanyName,  \r\n  MONTH(orders.OrderDate),\r\n  ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)),2) as omzet, \r\n  ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))/100*10.33,2) as \\''-HQ\\'',\r\n  ROUND(sum((Quantity-to_deliver)*(UnitCost)),2) as inkoop, \r\n ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost-(UnitPrice/100*8.43))),2) as marge\r\nFROM order_details\r\nINNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN contacts on orders.ContactID = contacts.ContactID\r\nWHERE order_details.stock_owner_id=802 \r\n AND confirmed_yn\r\n  AND YEAR(orders.orderdate)=YEAR(NOW())\r\n        AND (Quantity-to_deliver)\r\n        AND contacts.CompanyName LIKE \\''%media%markt%\\''\r\n        AND orders.rma_yn = 0\r\nGROUP BY MONTH(orders.OrderDate), contacts.CompanyName\r\nOrder by contacts.CompanyName, MONTH(orders.OrderDate)', 212),
('marge alles last year', 'SELECT YEAR(orders.orderdate) as YEAR,\r\nMONTH(orders.orderdate) as Month,     \r\nROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)),2) as omzet, \r\nROUND(sum((Quantity-to_deliver)*(UnitCost)),2) as inkoop, \r\nROUND(sum(cost_percentage),2) as AddedCost,\r\nROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)),2) as marge,\r\nFORMAT(100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity-to_deliver)*(UnitCost)))-1),2) as \\''%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID\r\nWHERE order_details.stock_owner_id=802 \r\n  AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT administration_order\r\n  AND NOT rma_yn\r\n  AND (YEAR(orders.orderdate) = YEAR(NOW())-1\r\n             OR YEAR(orders.orderdate) = YEAR(NOW()))\r\n        AND (Quantity-to_deliver)\r\nGROUP BY YEAR(orders.OrderDate),MONTH(orders.OrderDate)\r\nOrder by orders.orderdate', 214),
('Ordermargin < 10%', 'SELECT \r\n  CompanyName,\r\n  orders.OrderID, \r\n  (1-((Purchase_value)/Sales_value))*100 as marge\r\nFROM order_margin\r\nINNER JOIN orders on orders.OrderID = order_margin.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nWHERE YEAR(orders.OrderDate) = YEAR(NOW())\r\n  AND NOT rma_yn\r\nGROUP BY OrderID\r\nHAVING marge < 10\r\nORDER BY marge', 215),
('marge per week', 'SELECT orders.OrderID,\r\nWEEK(orders.orderdate)+1 as WEEK,      \r\nROUND(sum((Quantity)*(UnitPrice+cost_percentage)),2) as omzet, \r\nROUND(sum((Quantity)*(UnitPrice+cost_percentage-UnitCost)),2) as marge,\r\nFORMAT(100*((sum((Quantity)*(UnitPrice+cost_percentage))) / (sum((Quantity)*(UnitCost)))-1),2) as \\''%\\'',\r\nROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage)),2) as Romzet, \r\nROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)),2) as Rmarge,\r\nFORMAT(100*((sum((Quantity-to_deliver)*(UnitPrice+cost_percentage))) / (sum((Quantity)*(UnitCost)))-1),2) as \\''R%\\''\r\nFROM order_details\r\nINNER JOIN orders on orders.OrderID = order_details.OrderID\r\nINNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID\r\nWHERE order_details.stock_owner_id=802 \r\n AND UnitCost\r\n  AND confirmed_yn\r\n  AND NOT rma_yn\r\n        AND YEAR(orders.orderdate) = YEAR(now())\r\nGROUP BY orders.orderID\r\nOrder by orders.orderdate', 216),
('TomTom delivery backorders', 'SELECT \r\n  poID,\r\n  ExternalID,\r\n  ProductName,\r\n  comments,  \r\n  UnitPrice, \r\n  Quantity,\r\n  to_deliver,\r\n  ROUND(to_deliver*UnitPrice) as Euro,\r\n  po_details.last_exp as verwacht\r\nFROM po_details \r\nLEFT JOIN current_product_list ON po_details.ProductID = current_product_list.ProductID INNER JOIN purchase_orders ON PurchaseOrderID = poID \r\nWHERE SupplierID = \\''4210\\'' \r\nAND to_deliver \r\nAND PO_sent\r\nORDER BY po_details.last_exp, poID ASC', 219),
('TomTom delivery next week', 'SELECT \r\n  poID,\r\n  ExternalID,\r\n  ProductName,\r\n  comments,  \r\n  UnitPrice, \r\n  Quantity,\r\n  to_deliver,\r\n  ROUND(to_deliver*UnitPrice) as Euro,\r\n  po_details.last_exp\r\nFROM po_details \r\nLEFT JOIN current_product_list ON po_details.ProductID = current_product_list.ProductID INNER JOIN purchase_orders ON PurchaseOrderID = poID \r\nWHERE SupplierID = \\''4210\\'' \r\nAND to_deliver \r\nAND WEEK(po_details.last_exp) < WEEK(NOW())+1\r\nORDER BY poID ASC, podetailsID ASC', 220),
('TomTom forecast', 'SELECT \r\n  IF(PO_sent,poID,\\''\\'') as PO,\r\n  ExternalID,\r\n  ProductName,\r\n  to_deliver as \\''#\\'',\r\n  ROUND(to_deliver*UnitPrice) as Euro,\r\n  IF(po_details.last_exp,WEEK(po_details.last_exp)+1,\\''TBD\\'') as week\r\nFROM po_details \r\nLEFT JOIN current_product_list ON po_details.ProductID = current_product_list.ProductID INNER JOIN purchase_orders ON PurchaseOrderID = poID \r\nWHERE SupplierID = \\''4210\\'' \r\n  AND to_deliver \r\n  AND categoryID = 13\r\nORDER BY week ASC, poID ASC', 221),
('TomTom forecast all', 'SELECT \r\n  IF(PO_sent,poID,\\''\\'') as PO,\r\n  ExternalID,\r\n  ProductName,\r\n  to_deliver as \\''#\\'',\r\n  ROUND(to_deliver*UnitPrice) as Euro,\r\n  IF(po_details.last_exp,WEEK(po_details.last_exp)+1,\\''TBD\\'') as week\r\nFROM po_details \r\nLEFT JOIN current_product_list ON po_details.ProductID = current_product_list.ProductID INNER JOIN purchase_orders ON PurchaseOrderID = poID \r\nWHERE SupplierID = \\''4210\\'' \r\n  AND to_deliver \r\nORDER BY week ASC, poID ASC', 222),
('Gesprekken since yesterday', 'SELECT \r\n  contacts.ContactID,\r\n  CompanyName,\r\n  YEAR(CallDate) as Y,\r\n  MONTH(CallDate) as M,\r\n  DAY(CallDate) as day,\r\n  CONCAT(employees.FirstName, \\" \\", employees.LastName) as Name,\r\n  Subject,\r\n  SUBSTR(calls.Notes, 1, 120) as notes\r\nFROM calls\r\nINNER JOIN contacts ON contacts.ContactID = calls.ContactID\r\nINNER JOIN employees ON employees.EmployeeID = calls.employee\r\nWHERE YEAR(CallDate) = YEAR( NOW())\r\n  AND MONTH(CallDate) = MONTH( NOW())\r\n  AND DAY(CallDate) > DAY( NOW())-2\r\n\r\n', 224),
('Logins', 'SELECT \r\n  ContactID,\r\n  CompanyName,\r\n  uid,\r\n  email,\r\n  last_online,\r\n  total_logins\r\nFROM users\r\nWHERE total_logins\r\nORDER BY last_online DESC', 225),
('logins <-> orders', 'SELECT \r\n  users.ContactID,\r\n  CompanyName,\r\n  users.uid,\r\n  email,\r\n  last_online,\r\n  total_logins,\r\n  count(orders.OrderID) as \\''# orders\\'',\r\n  FirstName\r\nFROM users\r\nINNER JOIN orders ON orders.ContactID = users.ContactID\r\nINNER JOIN employees ON orders.employee = employees.EmployeeID\r\nWHERE total_logins\r\nGROUP BY users.ContactID, employee\r\nORDER BY last_online DESC,users.ContactID\r\n', 226),
('logins <-> weborders', 'SELECT \r\n  users.ContactID,\r\n  CompanyName,\r\n  users.uid,\r\n  email,\r\n  last_online,\r\n  total_logins,\r\n  if(employees.EmployeeID = 6,count(orders.OrderID),NULL) as \\''# weborders\\''\r\nFROM users\r\nINNER JOIN orders ON orders.ContactID = users.ContactID\r\nINNER JOIN employees ON orders.employee = employees.EmployeeID\r\nWHERE total_logins   \r\nGROUP BY users.ContactID\r\nORDER BY last_online DESC,users.ContactID\r\n', 227),
('gesprekken today', 'SELECT \r\n  contacts.ContactID,\r\n  CompanyName,\r\n  YEAR(CallDate) as Y,\r\n  MONTH(CallDate) as M,\r\n  DAY(CallDate) as day,\r\n  CONCAT(employees.FirstName, \\" \\", employees.LastName) as Name,\r\n  Subject,\r\n  SUBSTR(calls.Notes, 1, 200) as notes\r\nFROM calls\r\nINNER JOIN contacts ON contacts.ContactID = calls.ContactID\r\nINNER JOIN employees ON employees.EmployeeID = calls.employee\r\nWHERE YEAR(CallDate) = YEAR( NOW())\r\n  AND MONTH(CallDate) = MONTH( NOW())\r\n  AND DAY(CallDate) = DAY( NOW())\r\nORDER BY employee\r\n', 228),
('Shop2 catalog', 'SELECT \r\n  current_product_list.ProductID, \r\n  current_product_list.ExternalID, \r\n  ProductName, \r\n  EAN,\r\n  current_product_list.public,\r\n  stock\r\nFROM current_product_list\r\nINNER JOIN brand ON brand.brand_id = current_product_list.merkID\r\nINNER JOIN categories ON current_product_list.CategoryID = categories.CategoryID\r\nLEFT JOIN catalogusdetails ON current_product_list.ProductID = catalogusdetails.ProductID\r\nLEFT JOIN catalogus ON catalogusdetails.CatalogusID = catalogus.CatalogusID\r\nLEFT JOIN product_stock ON product_stock.product_ID = current_product_list.ProductID\r\nWHERE (catalogus.ContactID=\\''4691\\'')\r\nGROUP BY current_product_list.ProductID\r\nORDER BY brand.name, current_product_list.ProductID', 229),
('admin artikelen not RMA', 'SELECT MONTH(Invoice_date) as \\''Month\\'',  \r\n`order_details`.`ProductID`,\r\n`order_details`.`ProductName` AS Name ,\r\nQuantity*UnitPrice as omzet\r\nFROM order_details\r\nINNER JOIN orders ON orders.OrderID = order_details.OrderID\r\nINNER JOIN invoices ON order_details.OrderID = invoices.orderID \r\nWHERE YEAR(Invoice_date) = YEAR(NOW())\r\n  AND NOT (order_details.ProductName LIKE \\"%protecti%\\" OR\r\n     order_details.ProductName LIKE \\"%2006%\\") \r\n  AND NOT rma_yn\r\n#GROUP BY order_details.OrderDetailsID\r\n#InvoiceID\r\n#GROUP BY joop', 232),
('admin RMA artikelen', 'SELECT MONTH(Invoice_date) as \\''Month\\'',  \r\nrma_yn,\r\norders.OrderID,\r\norder_details.ProductID,\r\norder_details.ProductName AS Name,\r\nQuantity,\r\nUnitPrice,\r\nQuantity*UnitPrice as omzet\r\nFROM order_details\r\nINNER JOIN orders ON orders.OrderID = order_details.OrderID\r\nINNER JOIN invoices ON order_details.OrderID = invoices.orderID \r\nWHERE YEAR(Invoice_date) = YEAR(NOW())\r\n  AND NOT (order_details.ProductName LIKE \\"%protecti%\\" OR\r\n     order_details.ProductName LIKE \\"%2006%\\") \r\n  AND rma_yn\r\n', 235),
('admin facturen not RMA', 'SELECT MONTH(Invoice_date) as \\''Month\\'',  \r\nSUM(Quantity*UnitPrice) as omzet\r\nFROM order_details\r\nINNER JOIN orders ON orders.OrderID = order_details.OrderID\r\n  AND NOT rma_yn\r\nINNER JOIN invoices ON order_details.OrderID = invoices.orderID \r\nWHERE YEAR(Invoice_date) = YEAR(NOW())\r\n  AND NOT (order_details.ProductName LIKE \\"%protecti%\\" OR\r\n    order_details.ProductName LIKE \\"%2006%\\") \r\n#GROUP BY order_details.OrderDetailsID\r\n#InvoiceID\r\nGROUP BY MONTH\r\n#GROUP BY YEAR(Invoice_date)', 233),
('margin invoiced (incl admin)', 'SELECT DATE_FORMAT(Invoice_date, \\"%Y-%m\\") as \\''Year_Month\\'',    \r\nROUND(SUM(IF(invoices.orderID, admin_details.Quantity*admin_details.UnitPrice, 0)),2) as adminomzet,\r\nROUND(SUM(IF(invoices.orderID, 0, UnitsSold*(inventory_transactions.UnitPrice+order_details.cost_percentage))),2) as omzet,\r\nROUND(SUM(IF(invoices.orderID, admin_details.Quantity*admin_details.UnitPrice, 0)),2) as adminmarge,\r\nROUND(SUM(IF(invoices.orderID, 0 , UnitsSold*(inventory_transactions.UnitPrice+order_details.cost_percentage-order_details.UnitCost))),2) as marge\r\nFROM invoices \r\nLEFT JOIN inventory_transactions ON invoices.shipmentID = inventory_transactions.shipmentID\r\nLEFT JOIN order_details ON inventory_transactions.orderdetailsID = order_details.OrderDetailsID\r\n  AND order_details.stock_owner_id=802\r\nLEFT JOIN orders on orders.OrderID =  order_details.OrderID\r\n  AND NOT orders.rma_yn\r\nLEFT JOIN orders admin_orders ON admin_orders.OrderID = invoices.orderID \r\n  AND NOT admin_orders.rma_yn\r\nLEFT JOIN order_details admin_details ON admin_orders.orderID = admin_details.orderID\r\n  AND NOT (admin_details.ProductName LIKE \\"%protecti%\\" OR admin_details.ProductName LIKE \\"%2006%\\")  \r\nWHERE YEAR(Invoice_date) = YEAR(NOW())\r\nGROUP BY  MONTH(Invoice_date)\r\nORDER BY  Invoice_date', 234),
('admin RMA facturen', 'SELECT MONTH(Invoice_date) as \\''Month\\'',  \r\nbrand.Name,\r\nSUM(Quantity*UnitPrice) as omzet\r\nFROM order_details\r\nINNER JOIN current_product_list on current_product_list.productID = order_details.ProductID\r\nINNER JOIN brand on brand.brand_id = current_product_list.MerkID\r\nINNER JOIN orders ON orders.OrderID = order_details.OrderID\r\nINNER JOIN invoices ON order_details.OrderID = invoices.orderID \r\nWHERE YEAR(Invoice_date) = YEAR(NOW())\r\n  AND NOT (order_details.ProductName LIKE \\"%protecti%\\" OR\r\n     order_details.ProductName LIKE \\"%2006%\\") \r\n  AND rma_yn\r\nGROUP BY Month, brand.Name', 236),
('producten zonder cost', 'SELECT ProductID, ProductName, stock\r\nFROM current_product_list \r\nINNER JOIN product_stock ON product_stock.Product_ID = current_product_list.ProductID\r\nWHERE (purchase_price_home = 0 or ISNULL(purchase_price_home))\r\n  AND stock \r\n  AND ProductName NOT LIKE \\''%inpakken%\\''', 246),
('Voorraad $ per merk', 'SELECT \r\n  sum(stock * Purchase_price_home) as kostprijs, \r\n  sum(stock) as \\''#\\'', \r\n  brand.Name\r\nFROM current_product_list\r\nLEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = 802\r\nINNER JOIN brand ON brand.brand_id = current_product_list.MerkID\r\nWHERE (NOT Discontinued_yn AND (sku=1 OR sku=0) \r\n              OR Pricelist_yn AND Discontinued_yn AND location_ID\r\n              OR stock AND (sku=1 OR sku=0))\r\n  AND NOT (CategoryID > 10)\r\nGROUP BY current_product_list.MerkID\r\nHAVING kostprijs \r\nORDER BY kostprijs Desc\r\n', 237),
('voorraad histrorical', 'SELECT \r\n current_product_list.ProductID,\r\n  sum(stock) as \\''#\\'', \r\n  if(Purchase_price, purchase_price, purchase_price_home) as kostprijs,\r\n sum(stock * if(Purchase_price, purchase_price, purchase_price_home)) as waarde, \r\n  brand.Name\r\nFROM current_product_list\r\nLEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = 802\r\nINNER JOIN brand ON brand.brand_id = current_product_list.MerkID\r\nLEFT JOIN pricing_purchase pricing ON  current_product_list.ProductID = pricing.ProductID\r\n  AND (pricing.start_date <= NOW() || isnull(pricing.start_date) || pricing.start_date=0) \r\n  AND (pricing.end_date >= NOW() || isnull(pricing.end_date) || pricing.end_date=0)\r\nWHERE stock \r\n      AND (NOT Discontinued_yn AND (sku=1 OR sku=0) \r\n       OR Pricelist_yn AND Discontinued_yn AND location_ID)\r\nGROUP BY current_product_list.ProductID, current_product_list.MerkID\r\nORDER BY MerkID, kostprijs Desc\r\n', 238),
('voorraad historical per brand', 'SELECT \r\n  sum(stock) as \\''#\\'', \r\n  if(Purchase_price, purchase_price, purchase_price_home) as kostprijs,\r\n  sum(stock * if(Purchase_price, purchase_price, purchase_price_home)) as waarde, \r\n  brand.Name\r\nFROM current_product_list\r\nLEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = 802\r\nINNER JOIN brand ON brand.brand_id = current_product_list.MerkID\r\nLEFT JOIN pricing_purchase pricing ON  current_product_list.ProductID = pricing.ProductID\r\n  AND (pricing.start_date <= NOW() || isnull(pricing.start_date) || pricing.start_date=0) \r\n  AND (pricing.end_date >= NOW() || isnull(pricing.end_date) || pricing.end_date=0)\r\nWHERE stock \r\n      AND (NOT Discontinued_yn AND (sku=1 OR sku=0) \r\n       OR Pricelist_yn AND Discontinued_yn AND location_ID)\r\nGROUP BY current_product_list.MerkID\r\nORDER BY waarde Desc\r\n', 239),
('voorraad $ covertec', 'SELECT \r\n#  ProductID,\r\n  externalID,\r\n  stock as \\''#\\'', \r\n  ProductName, \r\n#  sum(stock * Purchase_price_home) as kostprijs, \r\n  location\r\nFROM current_product_list\r\nLEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = 802\r\nLEFT JOIN location ON location_ID = ID\r\nWHERE (NOT Discontinued_yn AND (sku=1 OR sku=0) \r\n              OR Pricelist_yn AND Discontinued_yn AND location_ID\r\n              OR stock AND (sku=1 OR sku=0))\r\n      AND NOT CategoryID = 12\r\n      AND merkID = 73\r\nGROUP BY current_product_list.ProductID\r\nHAVING stock\r\nORDER BY externalID', 240),
('voorraadlijst old covertec', 'SELECT \r\n  ExternalID, \r\n  ProductName,   \r\n  stock as \\''#\\'', \r\n  Purchase_price_home as price, \r\n  ROUND(sum(stock * Purchase_price_home*0.8),2) as total\r\nFROM current_product_list\r\nLEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = 802\r\nLEFT JOIN location ON location_ID = ID\r\nWHERE (Pricelist_yn AND Discontinued_yn AND location_ID)\r\n      AND merkID = 73\r\nGROUP BY current_product_list.ProductID\r\nHAVING stock\r\nORDER BY total Desc', 241),
('voorraad waardeloos', 'SELECT inventory_transactions.ProductID, \r\n  DATEDIFF(now(),max(inventory_transactions.TransactionDate)) as dagen, \r\n  product_stock.stock, \r\n (product_stock.stock * current_product_list.Purchase_price_home) as Waarde, \r\n  current_product_list.ProductName, \r\n  brand.name, \r\n  current_product_list.pricelist_yn as On_list, \r\n  Discontinued_yn as EOL\r\nFROM inventory_transactions\r\nINNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID\r\nINNER JOIN product_stock ON product_stock.Product_ID = inventory_transactions.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.MerkID\r\nWHERE (product_stock.stock \r\n     OR Pricelist_yn AND Discontinued_yn AND location_ID\r\n     OR stock)       \r\n     AND (CategoryID <> 11 AND (sku=1 OR sku=0))\r\n     AND NOT current_product_list.Purchase_price_home\r\nGROUP BY inventory_transactions.ProductID\r\nORDER BY dagen DESC', 242),
('voorraad depreciation', 'DROP TEMPORARY TABLE IF EXISTS temp;\r\n\r\nCREATE TEMPORARY TABLE temp\r\nSELECT \r\n YEAR(product_history.date_modified) as Y,\r\n MONTH(product_history.date_modified) as M,\r\n DAY(product_history.date_modified) as D,\r\n WEEK(product_history.date_modified) as W,\r\n product_history.ProductID,  \r\n CAST(old_value as DECIMAL) as old_value,\r\n CAST(new_value as DECIMAL) as new_value,\r\n ROUND((old_value - new_value),2) as difference,\r\n  Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)) AS Stock,\r\n  ROUND(Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage))*(old_value - new_value),2) AS Value\r\nFROM product_history\r\nLEFT JOIN inventory_transactions ON inventory_transactions.ProductID = product_history.ProductID\r\nLEFT JOIN orders ON inventory_transactions.OrderID = orders.OrderID \r\nWHERE product_history.FieldName = \\''purchase_price_home\\''\r\n AND (rma_yn <> 1 or rma_yn is Null) \r\n  AND stock_owner_id = \\''802\\'' \r\n AND inventory_transactions.TransactionDate < product_history.date_modified\r\n  AND YEAR(product_history.date_modified) = YEAR(NOW())\r\nGROUP BY product_history.ProductHistoryID\r\nORDER BY product_history.date_modified;\r\n\r\nSELECT \r\n  Y, M, D,\r\n  ProductID,\r\n  Stock,\r\n  SUM(Difference),\r\n  SUM(Value)\r\nFROM temp\r\nGROUP BY ProductID\r\nORDER BY Y,M,D;', 243),
('voorraad depreciation detail', 'SELECT \r\n YEAR(product_history.date_modified) as Y,\r\n MONTH(product_history.date_modified) as M,\r\n DAY(product_history.date_modified) as D,\r\n WEEK(product_history.date_modified) as W,\r\n product_history.ProductID,  \r\n CAST(old_value as DECIMAL) as old_value,\r\n CAST(new_value as DECIMAL) as new_value,\r\n ROUND((old_value - new_value),2) as difference,\r\n  Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)) AS Stock,\r\n  ROUND(Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage))*(old_value - new_value),2) AS Value\r\nFROM product_history\r\nLEFT JOIN inventory_transactions ON inventory_transactions.ProductID = product_history.ProductID\r\nLEFT JOIN orders ON inventory_transactions.OrderID = orders.OrderID \r\nWHERE product_history.FieldName = \\''purchase_price_home\\''\r\n AND (rma_yn <> 1 or rma_yn is Null) \r\n  AND stock_owner_id = \\''802\\'' \r\n AND inventory_transactions.TransactionDate < product_history.date_modified\r\n  AND YEAR(product_history.date_modified) = YEAR(NOW())\r\nGROUP BY product_history.ProductHistoryID\r\nORDER BY Y,M,D, ProductID;\r\n', 244),
('voorraadlijst', 'SELECT \r\n  ExternalID, \r\n  ProductName,   \r\n  stock as \\''#\\'', \r\n  Purchase_price_home as price, \r\n  ROUND(sum(stock * Purchase_price_home*0.8),2) as total\r\nFROM current_product_list\r\nLEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = 802\r\nLEFT JOIN location ON location_ID = ID\r\nWHERE stock\r\n  AND NOT (CategoryID > 10)\r\nGROUP BY current_product_list.ProductID\r\nHAVING stock\r\nORDER BY total Desc', 245),
('Keomo voorraad', 'SELECT ProductID, ProductName, sum(stock * Purchase_price_home) as kostprijs, stock as \\''#\\'', location\r\n        FROM current_product_list\r\n        LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = 802\r\n        LEFT JOIN location ON location_ID = ID\r\nWHERE (NOT Discontinued_yn AND (sku=1 OR sku=0) \r\n              OR Pricelist_yn AND Discontinued_yn AND location_ID\r\n              OR stock AND (sku=1 OR sku=0))\r\n      AND NOT CategoryID = 12\r\n      AND merkID = 88\r\nGROUP BY current_product_list.ProductID\r\nHAVING stock\r\nORDER BY kostprijs Desc', 247),
('voorraad geen locatie', 'SELECT ProductID, \r\n product_stock.stock, \r\n current_product_list.ProductName, \r\n  brand.name, \r\n  current_product_list.pricelist_yn as On_list, \r\n  Discontinued_yn as EOL,\r\n        location,\r\n        location_ID\r\nFROM current_product_list\r\nINNER JOIN product_stock ON product_stock.Product_ID = current_product_list.ProductID\r\nINNER JOIN brand ON brand.brand_id = current_product_list.MerkID\r\nLEFT JOIN location ON product_stock.location_id = location.ID\r\nWHERE product_stock.stock \r\n  AND location_id = 0 ', 248),
('TomTom purchasing', 'SELECT \r\n MONTH(TransactionDate) as Month,\r\n SUM(UnitPrice * UnitsReceived) as Value\r\nFROM inventory_transactions\r\nINNER JOIN purchase_orders ON purchase_orders.PurchaseOrderID = inventory_transactions.PurchaseOrderID \r\nWHERE SupplierID = 4210\r\n AND YEAR(TransactionDate) = YEAR(NOW())\r\nGROUP BY Month\r\n', 249),
('Voorraadwaarde per datum', 'SELECT DISTINCTROW \r\n  stock_owner_id,\r\nSum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)) AS value\r\nFROM current_product_list\r\nLEFT JOIN inventory_transactions ON inventory_transactions.ProductID = current_product_list.ProductID\r\nLEFT JOIN orders ON inventory_transactions.OrderID = orders.OrderID \r\nWHERE \r\n  (rma_yn <> 1 or rma_yn is Null) \r\nGROUP BY stock_owner_id;', 251),
('Voorraad $ TomTom', 'SELECT \r\n  ExternalID,\r\n  ProductName, \r\n  stock as \\''#\\'', \r\n  Purchase_price_home,\r\n  sum(stock * Purchase_price_home) as kostprijs\r\n        FROM current_product_list\r\n        LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = 802\r\n        LEFT JOIN location ON location_ID = ID\r\nWHERE (NOT Discontinued_yn AND (sku=1 OR sku=0) \r\n              OR Pricelist_yn AND Discontinued_yn AND location_ID\r\n              OR stock AND (sku=1 OR sku=0))\r\n      AND NOT CategoryID = 12\r\n      AND merkID = 22\r\nGROUP BY current_product_list.ProductID\r\nHAVING stock\r\nORDER BY kostprijs Desc', 252),
('Euler omzet verzekerd', 'SELECT sum(Invoice_total) AS omzet, Description, contacts.Country\r\nFROM invoices\r\nINNER JOIN  contacts ON ContactID = CustomerID\r\nINNER JOIN creditlimits ON  contacts.ContactID = creditlimits.ContactID\r\n  AND (start_date <= Invoice_date || start_date=0) \r\n  AND (end_date >= Invoice_date || end_date=0)\r\nLEFT JOIN paymentterm ON invoices.Paymentterm = PaymentTermID\r\nWHERE Invoice_date >= \\''2007-08-01 00:00\\''\r\n  AND Invoice_date <  \\''2008-08-01 00:00\\''\r\n  AND (Invoice_date < SUBDATE(paid_date, 3) OR Invoice_total <= 0)\r\n  AND PaymentTermID != 3\r\n  AND limit_amount > Invoice_total\r\n  AND CustomerID != 4275\r\nGROUP BY contacts.Country, PaymentTermID', 253),
('Euler omzet onverzekerd', 'SELECT \r\n#contacts.ContactID, contacts.CompanyName, InvoiceID, Invoice_total,\r\nsum(Invoice_total) AS omzet, \r\nDescription, contacts.Country\r\nFROM invoices\r\nINNER JOIN contacts ON ContactID = CustomerID\r\nLEFT JOIN creditlimits ON  contacts.ContactID = creditlimits.ContactID\r\n  AND (start_date <= Invoice_date || start_date=0) \r\n  AND (end_date >= Invoice_date || end_date=0)\r\nLEFT JOIN paymentterm ON invoices.Paymentterm = PaymentTermID\r\nWHERE Invoice_date >= \\''2006-08-01 00:00\\''\r\n  AND Invoice_date <  \\''2007-08-01 00:00\\''\r\n  AND \r\n  NOT (\r\n  (Invoice_date < SUBDATE(paid_date, 3) OR Invoice_total <= 0)\r\n  AND PaymentTermID != 3\r\n  AND limit_amount > Invoice_total\r\n  AND CustomerID != 4275)\r\nGROUP BY contacts.Country, PaymentTermID\r\n#ORDER BY Country, contacts.CompanyName', 254),
('Euler test', 'SELECT \r\n  contacts.CompanyName,\r\n  sum(Invoice_total) AS omzet, \r\n  Description, \r\n  contacts.Country\r\nFROM invoices\r\nINNER JOIN  contacts ON ContactID = CustomerID\r\nINNER JOIN creditlimits ON  contacts.ContactID = creditlimits.ContactID\r\n  AND (start_date <= Invoice_date || start_date=0) \r\n  AND (end_date >= Invoice_date || end_date=0)\r\nLEFT JOIN paymentterm ON invoices.Paymentterm = PaymentTermID\r\nWHERE Invoice_date >= \\''2006-08-01 00:00\\''\r\n  AND Invoice_date <  \\''2007-08-01 00:00\\''\r\n  AND (Invoice_date < SUBDATE(paid_date, 3) OR Invoice_total <= 0)\r\n  AND PaymentTermID != 3\r\n  AND limit_amount > Invoice_total\r\n  AND CustomerID != 4275\r\nGROUP BY \r\n  contacts.Country, \r\n  PaymentTermID,\r\n  contacts.ContactID\r\nORDER BY omzet', 255),
('Euler omzet oud verzekerd', 'SELECT contacts.ContactID, contacts.CompanyName,\r\n\r\nsum(Invoice_total) AS omzet, Description, contacts.Country\r\nFROM invoices\r\nINNER JOIN  contacts ON ContactID = CustomerID\r\nLEFT JOIN paymentterm ON invoices.Paymentterm = PaymentTermID\r\nWHERE Invoice_date >= \\''2006-08-01 00:00\\''\r\n AND Invoice_date <  \\''2007-08-01 00:00\\''\r\n  AND (Invoice_date < SUBDATE(paid_date, 2) OR Invoice_total <= 0)\r\n    AND PaymentTermID != 3\r\n  AND CustomerID != 840\r\n AND CustomerID != 4275\r\n  AND CustomerID != 3645\r\n  AND CustomerID != 107\r\n AND ( contacts.Country = \\''NL\\''\r\n   OR contacts.Country = \\''BE\\''\r\n    OR contacts.Country = \\''DE\\''\r\n    OR contacts.Country = \\''HU\\''\r\n    OR contacts.Country = \\''IT\\''\r\n    OR contacts.Country = \\''PL\\''\r\n    OR contacts.Country = \\''ES\\'')\r\n\r\nGROUP BY contacts.Country, PaymentTermID, contacts.ContactID', 256),
('Euler omzet oud onverzekerd', 'SELECT sum(Invoice_total) AS omzet, Description,\r\ncontacts.Country\r\nFROM invoices\r\nINNER JOIN  contacts ON ContactID = CustomerID\r\nLEFT JOIN paymentterm ON invoices.Paymentterm = PaymentTermID\r\nWHERE Invoice_date >= \\''2006-08-01 00:00\\''\r\n AND Invoice_date <  \\''2007-08-01 00:00\\''\r\n  AND (Invoice_date >= SUBDATE(paid_date, 2)  AND Invoice_total > 0\r\n    OR PaymentTermID = 3\r\n OR CustomerID = 840\r\n OR CustomerID = 4286\r\n  OR CustomerID = 107\r\n    OR CustomerID = 4275\r\n OR !(contacts.Country = \\''NL\\''\r\n    OR contacts.Country = \\''BE\\''\r\n    OR contacts.Country = \\''DE\\''\r\n    OR contacts.Country = \\''HU\\''\r\n    OR contacts.Country = \\''IT\\''\r\n    OR contacts.Country = \\''PL\\''\r\n    OR contacts.Country = \\''ES\\'')\r\n)\r\n\r\n  \r\nGROUP BY contacts.Country, PaymentTermID', 257),
('voorraad $ Keomo', 'SELECT \r\n#  ProductID,\r\n  externalID,\r\n  stock as \\''#\\'', \r\n  ProductName, \r\n#  sum(stock * Purchase_price_home) as kostprijs, \r\n  location\r\nFROM current_product_list\r\nLEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = 802\r\nLEFT JOIN location ON location_ID = ID\r\nWHERE (NOT Discontinued_yn AND (sku=1 OR sku=0) \r\n              OR Pricelist_yn AND Discontinued_yn AND location_ID\r\n              OR stock AND (sku=1 OR sku=0))\r\n      AND NOT CategoryID > 9\r\n      AND merkID = 88\r\nGROUP BY current_product_list.ProductID\r\nHAVING stock\r\nORDER BY externalID', 258),
('voorraad $ HR Richter', 'SELECT \r\n#  ProductID,\r\n  externalID,\r\n  stock as \\''#\\'', \r\n  ProductName, \r\n#  sum(stock * Purchase_price_home) as kostprijs, \r\n  location\r\nFROM current_product_list\r\nLEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = 802\r\nLEFT JOIN location ON location_ID = ID\r\nWHERE (NOT Discontinued_yn AND (sku=1 OR sku=0) \r\n              OR Pricelist_yn AND Discontinued_yn AND location_ID\r\n              OR stock AND (sku=1 OR sku=0))\r\n      AND NOT CategoryID > 9\r\n      AND merkID = 12\r\nGROUP BY current_product_list.ProductID\r\nHAVING stock\r\nORDER BY externalID', 259),
('RMA openstaand', 'SELECT \r\n RMA.ID, \r\n CompanyName,\r\n RMA_state.State_ID,\r\n RMA_state.State_text, \r\n RMA.Customer_ID,\r\n RMA.Date_done,\r\n RMA.Date_in, \r\n RMA_product_customer.State_text as customer_State,\r\n ProductName,\r\n RMA_actions.Notes\r\nFROM iwex.RMA RMA \r\nINNER JOIN iwex.RMA_state RMA_state ON RMA_state.State_ID = RMA.State\r\nINNER JOIN RMA_product_customer on RMA.product_customer = RMA_product_customer.State_ID\r\nINNER JOIN current_product_list on RMA.ProductID = current_product_list.ProductID\r\nINNER JOIN RMA_actions on RMA.ID = RMA_actions.RMAID\r\nINNER JOIN contacts on contacts.ContactID = RMA.contacts_id\r\nWHERE\r\n RMA_state.State_ID <> 9 AND\r\n RMA.product_customer = 1\r\nGROUP BY RMA.ID\r\nORDER BY RMA.ID,RMA_state.State_text', 260),
('Media Markt admin fact per Q', 'SELECT \r\n  YEAR(orders.OrderDate) as Y,\r\n  QUARTER(orders.OrderDate) as Q, \r\n  contacts.CompanyName,  \r\n  sum((Quantity-to_deliver)*UnitPrice) as total\r\nFROM order_details\r\nINNER JOIN orders on order_details.OrderID=orders.OrderID\r\nINNER JOIN contacts ON contacts.ContactID = orders.ContactID\r\nINNER JOIN current_product_list on order_details.ProductID = current_product_list.ProductID\r\nWHERE contacts.CompanyName LIKE \\''%media%markt%\\'' OR\r\n      contacts.CompanyName LIKE \\''%saturn%zuidplein%\\''\r\n AND administration_order\r\nGROUP BY Y, Q, CompanyName\r\nOrder by Y DESC, Q DESC, CompanyName;', 264),
('Media Markt invoiced 2007', 'SELECT \r\n  Invoice_date, \r\n  contacts.CompanyName, \r\n  InvoiceID,\r\n  Invoice_total as Omzet\r\nFROM invoices\r\nINNER JOIN contacts ON contacts.ContactID = invoices.CustomerID\r\nLEFT JOIN branches ON branches.BrancheContactID = contacts.ContactID AND branches.MainContactID = 3949\r\nWHERE (contacts.ContactID = 3949 OR branches.MainContactID = 3949)\r\n  AND YEAR(Invoice_date) = 2007 AND (contacts.CompanyName LIKE \\''%media%markt%\\'' OR\r\n      contacts.CompanyName LIKE \\''%saturn%zuidplein%\\'')\r\nORDER BY InvoiceID;', 265),
('media markt openstaand', 'SELECT \r\n  invoices.companyName, \r\n  CustomerID, \r\n  InvoiceID, \r\n  Invoice_date,\r\n  Invoice_total AS exc_btw, \r\n  (Invoice_total + Invoice_BTW) AS amount, \r\n  paid_amount AS paid_amount,  \r\n  paid_date\r\nFROM invoices \r\nINNER JOIN contacts ON invoices.CustomerID = contacts.ContactID\r\nINNER JOIN branches ON branches.BrancheContactID = contacts.ContactID\r\nLEFT JOIN paymentterm ON invoices.Paymentterm = PaymentTermID\r\nWHERE  \r\n  MainContactID = 3949\r\n  AND\r\n  YEAR(Invoice_date) = YEAR(NOW())-1  \r\n  AND (NOT paid_yn \r\n  OR \r\n  paid_yn AND YEAR(paid_date)=YEAR(NOW()))\r\nORDER BY companyName', 267),
('media markt openstaand', 'SELECT invoices.companyName, CustomerID, InvoiceID, Invoice_date,\r\n   Invoice_total AS exc_btw, (Invoice_total + Invoice_BTW) AS amount, paid_amount AS paid_amount,  paid_date,\r\n    kvk_number, CreditLimit, invoices.Country\r\n   FROM invoices \r\n    INNER JOIN contacts ON invoices.CustomerID = contacts.ContactID\r\n   LEFT JOIN paymentterm ON invoices.Paymentterm = PaymentTermID\r\nWHERE  YEAR(Invoice_date) = YEAR(NOW())-1  \r\n        AND (NOT paid_yn \r\n            OR \r\n             paid_yn AND YEAR(paid_date)=YEAR(NOW()))\r\nORDER BY companyName', 268),
('media markt invoiced q4 2007', 'SELECT \r\n  Invoice_date, \r\n  contacts.CompanyName, \r\n  InvoiceID,\r\n  Invoice_total as Omzet\r\nFROM invoices\r\nINNER JOIN contacts ON contacts.ContactID = invoices.CustomerID\r\nLEFT JOIN branches ON branches.BrancheContactID = contacts.ContactID AND branches.MainContactID = 3949\r\nWHERE (contacts.ContactID = 3949 OR branches.MainContactID = 3949)\r\n  AND YEAR(Invoice_date) = 2007 AND QUARTER(Invoice_date) = 4 AND (contacts.CompanyName LIKE \\''%media%markt%\\'' OR\r\n      contacts.CompanyName LIKE \\''%saturn%zuidplein%\\'')\r\nORDER BY InvoiceID;', 269),
('keomo iwex articles', 'SELECT ProductID, externalID from current_product_list \r\nInner join brand on brand.brand_id = current_product_list.MerkID\r\nwhere brand.name = \\''keomo\\''\r\nAND externalID like \\''23%\\''', 270),
('new', 'SELECT', 271);


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `related_products`
-- 

CREATE TABLE `related_products` (
  `ProductID1` int(10) unsigned NOT NULL default '0',
  `ProductID2` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ProductID1`,`ProductID2`)
) TYPE=MyISAM COMMENT='equal related products';

-- 
-- Gegevens worden uitgevoerd voor tabel `related_products`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `shipments`
-- 

CREATE TABLE `shipments` (
  `Shipment_ID` int(10) unsigned NOT NULL auto_increment,
  `AdressID` int(10) unsigned NOT NULL default '0',
  `Start_date` datetime default NULL,
  `Ship_date` datetime default NULL,
  `InvoiceID` int(10) unsigned default NULL,
  `Tracking` varchar(50) default '0',
  `Cancel` tinyint(3) unsigned NOT NULL default '0',
  `email_send` tinyint(1) unsigned default NULL,
  PRIMARY KEY  (`Shipment_ID`),
  UNIQUE KEY `InvoiceID` (`InvoiceID`),
  KEY `Shipdate` (`Ship_date`),
  KEY `Adress` (`AdressID`)
) TYPE=MyISAM COMMENT='Leveringen op orders' AUTO_INCREMENT=6 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `shipments`
-- 

INSERT INTO `shipments` (`Shipment_ID`, `AdressID`, `Start_date`, `Ship_date`, `InvoiceID`, `Tracking`, `Cancel`, `email_send`) VALUES (1, 1, NULL, '2006-05-19 15:05:27', NULL, 'klaar', 0, NULL),
(2, 2, NULL, '2006-04-19 15:04:23', 1, '0', 0, NULL),
(3, 2, NULL, '2006-03-19 16:04:13', 2, '0', 0, 1),
(4, 7, NULL, NULL, NULL, '0', 0, NULL),
(5, 5, NULL, NULL, NULL, '0', 0, NULL);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `shippers`
-- 

CREATE TABLE `shippers` (
  `ShipperID` int(10) unsigned NOT NULL auto_increment,
  `CompanyName` varchar(50) default NULL,
  `Phone` varchar(50) default NULL,
  PRIMARY KEY  (`ShipperID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `shippers`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `shipping_methods`
-- 

CREATE TABLE `shipping_methods` (
  `ShippingMethodID` int(10) unsigned NOT NULL auto_increment,
  `ShippingMethod` longtext,
  PRIMARY KEY  (`ShippingMethodID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `shipping_methods`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `spending_type`
-- 

CREATE TABLE `spending_type` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `spending_name` varchar(50) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `spending_type`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `status`
-- 

CREATE TABLE `status` (
  `statusID` int(8) unsigned NOT NULL auto_increment,
  `statustext` varchar(40) default '0',
  `category` tinyint(3) unsigned default NULL,
  PRIMARY KEY  (`statusID`)
) TYPE=MyISAM COMMENT='keeps status name info' AUTO_INCREMENT=5 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `status`
-- 

INSERT INTO `status` (`statusID`, `statustext`, `category`) VALUES (1, 'Open', 1),
(2, 'Partial delivery', 1),
(3, 'Delivered', 1),
(4, 'other', 1);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `temp_inv_transactions`
-- 

CREATE TABLE `temp_inv_transactions` (
  `TransactionID` int(10) unsigned NOT NULL auto_increment,
  `TransactionDate` datetime default NULL,
  `ProductID` int(11) default NULL,
  `Description` varchar(255) default NULL,
  `OrderID` int(10) unsigned default NULL,
  `orderdetailsID` int(10) unsigned default '0',
  `shipmentID` int(10) unsigned NOT NULL default '0',
  `UnitPrice` decimal(10,2) default NULL,
  `UnitsSold` int(11) default '0',
  `btw_percentage` decimal(4,2) NOT NULL default '0.00',
  `added_cost` float NOT NULL default '0',
  `box_ID` int(10) unsigned default NULL,
  `employee` tinyint(3) unsigned default NULL,
  `stock_owner_id` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`TransactionID`),
  KEY `ProductID` (`ProductID`),
  KEY `Boxid` (`box_ID`),
  KEY `shipmentid` (`shipmentID`),
  KEY `OrderID` (`OrderID`),
  KEY `OrderDetailsID` (`orderdetailsID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `temp_inv_transactions`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `text`
-- 

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

INSERT INTO `text` (`textID`, `categoryID`, `languageID`, `subject`, `text`) VALUES (1, 1, 1, 'Nieuwe dealer', 'Allereerst dank ik u voor uw interesse in onze producten en organisatie en voor het toezenden van uw KVK gegevens. Hierbij vindt u in het kort wat informatie.\r\n\r\nIwex is een Groothandel en doet als zodanig alleen zaken met bedrijven. Er is geen minimum voorraadeis of bestelaantal. Bij grotere aantallen gaat echter wel de prijs omlaag. Voor iedereen geld dat de eerste drie maanden alle orders onder rembours of vooruitbetaling geschieden, daarna eventueel met 14 dagen betalingstermijn. Verder kunnen wij u ondersteunen door het voorzien in beeldmateriaal, eventueel foldermateriaal. Boven de 400 euro (online 300) worden zendingen tot de Nederlandse grens franco geleverd, daaronder worden 13,50 (online 12,50) kosten berekend. Indien u kiest voor rembours rekenen wij 10 euro extra.\r\n\r\nWij zijn specialist in mobiele navigatie en communicatie oplossingen. Wij hebben daarvoor dan ook alle kennis in huis. Naast de bekende merken kunnen wij u ook op maat oplossingen bieden. \r\n\r\nDe meest recente prijslijst vindt u op: http://iwex.serveftp.net/prijslijst/ \r\nusername: customer \r\npassword: go35700\r\nDit password kan wijzigen dus raadpleeg uw laatste prijslijst email voor het juiste wachtwoord.\r\n\r\nOm naast online artikelen en prijzen te bekijken ook online te bestellen zouden we u willen vragen dit http://iwex.serveftp.org/prijslijst/Overeenkomst%20elektronische%20handel.pdf formulier ondertekend aan ons terug te sturen.\r\n\r\nMet vriendelijke groeten,\r\n\r\nIwex\r\nDorpsstraat 115\r\nNL 1733 AG NIEUWE NIEDORP \r\n\r\nTel: +31 (0) 226 411 299\r\nFax: +31 (0) 842 216 330\r\n\r\nMailto:verkoop@iwex.nl\r\nhttp://www.iwex.nl'),
(2, 2, 1, 'Order confirm', 'Beste inkoop van varCustomer,\r\n\r\nvarCreditText<p>Hieronder vindt u uw varComfirmType met prijsinformatie, met uw referentie: ''varCustorderID''.</p>\r\n<p>Wij vragen u deze te controleren op juistheid en volledigheid. Wanneer er geen onregelmatigheden zijn, hoeft u niet te reageren.</p> \r\n\r\nWilt u deze varComfirmType online inzien en volgen, klik op: varOnlineOrderText\r\n<br>\r\n\r\nvarOrderdetails\r\n\r\n<p>Uw betalingsconditie: varPaymentTerm</p>\r\n\r\n<p>Aflever adres is:<br>\r\nvarShipTo</p>\r\n\r\n<p>Met vriendelijke groeten,</p>\r\n\r\n<p>varEmployee<br>\r\n_varcompanyname_ verkoop<br>\r\n_varaddress_<br>\r\n_varzipcode_ _varcity_<br>\r\nTel. _vartelephone_<br>\r\nFax. _varfaxnumber_<br>\r\n<a href=''_varwebsite_''>_varcompanyname_</a></p>\r\n\r\n<p>Op al onze diensten en leveringen zijn onze <a href="http://iwex.serveftp.org/prijslijst/Leveringsvoorwaarden.pdf">\r\n<img src="http://iwex.serveftp.org/images/pdficon.gif" alt="PDF file" border="0" height="15"> leveringsvoorwaarden</a> van toepassing.</p>\r\n'),
(3, 3, 1, 'Openstaande Facturen', 'Beste administratie van varCustomer,\r\n\r\n<p>Volgens onze administratie heeft uw bedrijf de volgende factuur(en) nog niet voldaan.</p>\r\n\r\n<p>varInvoiceTable</p>\r\n\r\n<p>Wij verzoeken u vriendelijk de openstaande factuur z.s.m. te voldoen.<br>\r\nWanneer deze factuur reeds voldaan is, kunt u deze email als niet verzonden beschouwen.</p>\r\n\r\n<p>Met vriendelijke groeten,</p>\r\n\r\n<p>varEmployee</p>\r\nAdministratie: <a href="mailto:administratie@iwex.nl">administratie@iwex.nl</a><br>\r\nTel: _vartelephone_<br>\r\n_varcompanyname_'),
(4, 4, 1, 'Password changed', 'Geachte Heer/Mevrouw,\r\n\r\nUw wachtwoord op de website van http://iwex.serveftp.org/prijslijst is succes vol gewijzigd.'),
(5, 5, 1, 'Nieuw wachtwoord', 'Geacht Heer/Mevrouw,\r\n\r\nEr is een nieuw wachtwoord aangemaakt op de website van http://iwex.serveftp.org/prijslijst.\r\n\r\nUw nieuwe wachtwoord is: pwnew\r\n\r\nN.b. Uit veiligheidsoverwegingen is er geen username meegestuurd.'),
(6, 6, 1, 'User blocked', 'Geachte Heer/Mevrouw,\r\n\r\nEr is drie keer fout ingelogd op de dealer site van Iwex met de webuser: USER.\r\n\r\nUw account is nu geblokkeerd. U kunt hier: http://iwex.serveftp.org/prijslijst/get_password.php een nieuw wachtwoord aanvragen.\r\n\r\nHet volgende ip adres is hiervoor gebruikt IP. '),
(7, 7, 1, 'Uw factuur', 'Beste varCustomer,<br /><br />  Bij deze uw factuur.<br />'),
(8, 8, 1, 'Home pagina text', '<h2>Asterisk start guide</h2><p>0 buiten lijn via ISDN</p><p>8 buiten lijn via VoipBuster (zo intikken 80031226411299)</p><p><a target="_blank" href="http://192.168.0.8/amp/admin/reports.php?">Gesprekken overzicht </a></p><p><a target="_blank" href="http://192.168.0.8/amp/recordings/">Voicemail menu </a></p>      <table border="0"><tbody>  <tr><th class="mceVisualAid">Snel keuze toetsen</th><th class="mceVisualAid">Toestel nummers</th></tr>     <tr>    <td>     <p>#70 On hold/parkeren. Daarna hoor je de parkeerplaats meestal 71<br />     #xx Direct doorverbinden naar toestel ''xx''<br />     #*xx Direct doorverbinden naar de voicemail </p>         <p>*43       Echo Test<br />      </p>              <p class="\\"><!--[if !supportEmptyParas]--> <!--[endif]--></p>              <p class="\\"> *60       Time<br />       *61        Weather<br />        *62       Schedule wakeup call<br />       *65       Festival test (your extension is XXX)</p>              <p class="\\">*69       Last Caller number/ID<br />       *70       Activate Call Waiting (deactivated by default)<br />        *71       Deactivate Call Waiting<br />       *72       Call Forwarding System<br />       *73       Disable Call Forwarding<br />       *77       IVR Recording<br />       *78       Enable Do-Not-Disturb<br />        *79       Disable Do-Not-Disturb<br />*8   Pickup extern<br />       *90       Call Forward on Busy<br />       *91       Disable Call Forward on Busy<br />       *97       Message Center (does no ask for extension)<br />       *98       Enter Message Center<br />        *99       Playback IVR Recording</p>              <p class="\\">*411     Directory<br />       666      Test Fax</p>              <p class="\\">888      Barge in (there are variations)<br />        7777    Simulate incoming call</p>     </td>       <td valign="top">   <p>11<br />     12<br />   13 Henri (RMA)<br />   14 Menno<br />   21 Fred<br />   22 Els<br />   23 Alex & Iwan<br />   24 Peter<br />   </p><p>Soft phones<br />32 Iwan<br />37 Henri<br />41 Mathieu<br /></p><p> </p></td>     </tr>    </tbody></table>'),
(9, 9, 1, 'Overdue Letter', '_varcity_, _varletterdateText_\r\n\r\nvarCustomer\r\n_varletterTo_\r\n\r\nBetreft: Openstaande facturen \r\n\r\nOns referentie nummer: _varletterrefNum_\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoormiddel van dit schrijven wil ik u er op wijzen dat uw firma varCustomer, nog een bedrag van � _varlettertotal_ bij ons heeft openstaan.\r\n\r\n_varstringbreak_\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van 14 dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nBij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze � _varlettertotal_ alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben ge�nformeerd.\r\n\r\nHoogachtend,\r\n_varcompanyname_\r\n\r\n\r\n\r\n\r\n\r\n\r\n_varEmployee_\r\nHoofd administratie'),
(10, 10, 1, 'Overdue letter aangetekend', '_varcity_, _varletterdateText_\r\n\r\nvarCustomer\r\n_varletterTo_\r\n\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: _varletterrefNum_\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nOp _varletterletterdateText_ hebben wij u verzocht om onze facturen met nr. _varlettertotalinvoices_ ten bedrage van � _varlettertotal_ (incl. BTW) binnen tien kalenderdagen te voldoen. Tot op heden hebben wij echter nog geen betaling mogen ontvangen. \r\n\r\n_varstringbreak_\r\n\r\nGelet op het feit dat u niet antwoordde op ons vorige schrijven, noch de ontvangst daarvan bevestigde, zijn wij thans genoodzaakt u dit aangetekende schrijven te sturen. \r\n\r\nWij verzoeken u, en voor zover nodig sommeren u, om binnen tien dagen na dagtekening van dit schrijven het verschuldigde bedrag ad � _varlettertotal_ alsnog over te maken op een van onze rekening nummers. Geeft u aan deze sommatie geen gevolg, dan bent u aan het einde van de sommatie termijn van rechtswege in verzuim.\r\n\r\nVanaf dat moment bent u ook de wettelijke rente verschuldigd op basis van de toepasselijke algemene voorwaarden en reeds nu voor alsdan in gebreke. Wij zullen alsdan overgaan tot het nemen van rechtsmaatregelen, waarbij alle gerechtelijke en buitengerechtelijke kosten voor uw rekening komen. \r\n\r\nOm strikt formele redenen wordt een kopie van deze brief u ook per gewone post toegezonden.\r\n\r\nOnder voorbehoud van alle rechten en weren, \r\n\r\nhoogachtend, \r\n\r\n\r\n\r\n\r\n_varEmployee_\r\nDirecteur _varcompanyname_'),
(11, 11, 1, 'Overdue Fax', '_varcity_, _varletterdateText_\r\n\r\nvarCustomer\r\n_varfaxnumber_\r\n\r\nBetreft: Openstaande facturen\r\n\r\nOns referentie nummer: _varletterrefNum_\r\n\r\n\r\nGeachte heer/mevrouw,\r\n\r\nDoor middel van dit schrijven wil ik u er op wijzen dat uw firma varCustomer, nog een bedrag van � _varlettertotal_ bij ons heeft openstaan. Dit is geresulteerd uit de facturen met nummers:\r\n\r\n_varstringbreak_\r\n\r\nDaarnaast wil ik u er op wijzen dat de betalingstermijn van 14 dagen al is verstreken. Hierdoor zou het bedrag, conform onze leveringsvoorwaarden, verhoogd worden met 1% rente per maand.\r\n\r\nnij wijze van tegemoetkoming geef ik u hierbij de mogelijkheid om deze � _varlettertotal_ alsnog te voldoen binnen 7 dagen na dagtekening. Indien u dit verzuimt zullen wij de rente (1% per maand) in rekening brengen zo als beschreven in onze leveringsvoorwaarden.\r\n\r\nIk vertrouw erop u hiermee voldoende te hebben ge�nformeerd.\r\n\r\nMet vriendelijke groeten,\r\n_varEmployee_'),
(12, 12, 1, 'Uw login aanvraag op iwex.nl', 'Geachte Heer/Mevrouw\r\n\r\nBij deze is er een nieuwe account voor u aangemaakt op _vardealerlogin_\r\n\r\nU kunt nu inloggen met de volgende login gegevens\r\n\r\nUsername: _varnewusername_\r\nPassword: _varnewuserpass_\r\n\r\nOp de website van _varcompanyname_ kunt u uw wachtwoord wijzigen. Deze moet echter wel \r\nmeer dan 8 characters lang zijn en minimaal 1 hoofdletter bevatten\r\n\r\nLet op! Het is niet mogelijk om dit wachtwoord opnieuw op te vragen.\r\n\r\nMet vriendelijke groeten,\r\n_varcompanyname_ verkoop '),
(13, 1, 2, 'New dealer', 'Thank you for you interest in our products. Iwex is a distribution company and will only sell to their dealers. First orders will go under rembours or payment upfront. After that we will use a 14 days payment term. We can help you with images and other material. Online orders are shipped to the Dutch border for free above 300 euro. Other orders are free Dutch border for above 400 euro. Below this amount we invoice 12,50 order cost for online and 13,50 for other order methods. Rembours will cost an extra 10 euro. The most recent price list can be found on : http://iwex.serveftp.net/prijslijst/ username: customer password: 35700 This password can change so check our latest mailing for the correct one. Kind regards, Iwex Dorpsstraat 115 NL 1733 AG NIEUWE NIEDORP Tel: +31 (0) 226 411 299 Fax: +31 (0) 842 216 330 Mailto:verkoop@iwex.nl http://www.iwex.nl ');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `text_categories`
-- 

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
-- Tabel structuur voor tabel `users`
-- 

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `ContactID` int(10) default NULL,
  `CompanyName` varchar(50) default NULL,
  `uid` varchar(30) NOT NULL default '',
  `pwd` varchar(30) default NULL,
  `email` varchar(50) default NULL,
  `languageID` tinyint(3) unsigned NOT NULL default '0',
  `rma` tinyint(1) NOT NULL default '0',
  `purchase` tinyint(1) unsigned NOT NULL default '0',
  `stock` tinyint(1) unsigned NOT NULL default '0',
  `logins` int(10) unsigned default '0',
  `login_attempts` tinyint(3) unsigned default '0',
  `passw_change_attempts` tinyint(3) unsigned default '0',
  `last_online` datetime default NULL,
  `total_logins` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uid` (`uid`),
  KEY `contactid` (`ContactID`),
  KEY `languageID` (`languageID`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `users`
-- 

INSERT INTO `users` (`id`, `ContactID`, `CompanyName`, `uid`, `pwd`, `email`, `languageID`, `rma`, `purchase`, `stock`, `logins`, `login_attempts`, `passw_change_attempts`, `last_online`, `total_logins`) VALUES (1, 2, 'Klant 1', 'rita', '21AQJdvT9Yqzs', 'richard@iwex.nl', 1, 0, 0, 0, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `valuta`
-- 

CREATE TABLE `valuta` (
  `ValutaID` int(3) unsigned NOT NULL auto_increment,
  `ValutaName` char(3) NOT NULL default '',
  `ValutaNameLong` char(25) default NULL,
  `ValutaXrate` decimal(7,5) NOT NULL default '0.00000',
  `ValutaDate` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`ValutaID`),
  UNIQUE KEY `ValutaID` (`ValutaID`),
  KEY `ValutaID_2` (`ValutaID`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `valuta`
-- 

INSERT INTO `valuta` (`ValutaID`, `ValutaName`, `ValutaNameLong`, `ValutaXrate`, `ValutaDate`) VALUES (1, 'USD', 'US Dollar', 0.83690, '2005-10-20'),
(2, 'EUR', 'Euro', 1.00000, '2002-01-01'),
(3, 'GBP', 'Brittish Pound', 1.47623, '2005-09-07');
