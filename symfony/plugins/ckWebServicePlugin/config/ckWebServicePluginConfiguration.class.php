<?php
/**
 * This file is part of the ckWebServicePlugin
 *
 * @package   ckWebServicePlugin
 * @author    Christian Kerl <christian-kerl@web.de>
 * @copyright Copyright (c) 2008, Christian Kerl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @version   SVN: $Id: ckWebServicePluginConfiguration.class.php 14825 2009-01-16 22:26:54Z chrisk $
 */

/**
 * Plugin configuration.
 *
 * @package    ckWebServicePlugin
 * @subpackage config
 * @author     Christian Kerl <christian-kerl@web.de>
 */
class ckWebServicePluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function configure()
  {
    $this->dispatcher->connect('component.method_not_found', array('ckComponentEventListener', 'listenToComponentMethodNotFoundEvent'));
  }
}
