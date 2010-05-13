<?php
/**
 * This file is part of the ckWebServicePlugin
 *
 * @package   ckWebServicePlugin
 * @author    Christian Kerl <christian-kerl@web.de>
 * @copyright Copyright (c) 2008, Christian Kerl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @version   SVN: $Id: soapFaultNoDebugTest.php 14026 2008-12-14 17:02:31Z chrisk $
 */

$app = 'frontend';
$debug = false;

include_once(dirname(__FILE__).'/../bootstrap/functional.php');

$c = new ckTestSoapClient();

// test executeException
$c->test_exception()
  ->hasFault('Internal Server Error');

// test executeSoapFault
$c->test_soapFault()
  ->hasFault('TestSoapFault');