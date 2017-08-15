<?php
/**
 * @package     mod_sp_vmajaxsearch
 *
 * @copyright   Copyright (C) 2010 - 2016 JoomShaper. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('jquery.framework');
require_once __DIR__ . '/helper.php';
if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR . '/components/com_virtuemart/helpers/config.php');
if (!class_exists('ShopFunctions')) require(VMPATH_ADMIN . '/helpers/shopfunctions.php');

$item_id = $params->get('item_id', 0);
$active_category_id = JRequest::getInt('virtuemart_category_id', '0');

// Get VM Categories Model
$category_model = VmModel::getModel('Category');

// Get VM Categories
$vendor_id = '1';
$categories = $category_model->getChildCategoryList($vendor_id, 0);

if(empty($categories)) return false;

$modSpVmajaxsearchHelper = new modSpVmajaxsearchHelper();
$modSpVmajaxsearchHelper->categoryModel = $category_model;
$cat_trees =  $modSpVmajaxsearchHelper->generateTree($categories, $active_category_id, 0);


$doc = JFactory::getDocument();
$doc->addScript( JURI::base(true) . '/modules/'.$module->module .'/assets/js/spvmajax-search.js' );

require JModuleHelper::getLayoutPath('mod_sp_vmajaxsearch', $params->get('layout'));