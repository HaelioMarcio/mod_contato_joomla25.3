<?php
/**
 * Form Contato! Module Entry Point
 * 
 * @package    Joomla.Modules.HM
 * @subpackage Modules
 * @license    GNU/GPL, see LICENSE.php
 *
 */
 
// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';
 
$hello = modcontatoHelper::getHello($params);
require JModuleHelper::getLayoutPath('mod_contato');