<?php

/**
 * brand module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage brand
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseBrandGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'brand' : 'brand_'.$action;
  }
}
