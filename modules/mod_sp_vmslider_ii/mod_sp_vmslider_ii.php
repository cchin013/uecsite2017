<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_sp_vmslider_ii
 * @copyright	Copyright (C) 2010 - 2016 JoomShaper. All rights reserved.
 * @license		GNU General Public License version 2 or later; 
 */

// no direct access
defined('_JEXEC') or die('Direct access not allowed');

require('helper.php');

// Load the method jquery script.
JHtml::_('jquery.framework');

$doc = JFactory::getDocument();
$doc->addScript( JURI::base(true) . '/modules/'.$module->module .'/assets/js/jquery.countdown.min.js' );
$doc->addScript( JURI::base(true) . '/modules/'.$module->module .'/assets/js/owl.carousel.min.js' );
$doc->addScript( JURI::base(true) . '/modules/'.$module->module .'/assets/js/main.js' );
$doc->addStylesheet( JURI::root(true) . '/modules/'.$module->module .'/assets/css/owl.carousel.css' );
$doc->addStylesheet( JURI::root(true) . '/modules/'.$module->module .'/assets/css/style.css' );
$doc->addStylesheet( JURI::root(true) . '/modules/'.$module->module .'/assets/css/animate.css' );

$modSpVmsliderIiHelper = new modSpVmsliderIiHelper();

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR . '/components/com_virtuemart/helpers/config.php');

//load virtuemart config
VmConfig::loadConfig();

$max_items 		= $params->get( 'max_items', 2 ); //maximum number of items to display
$category_id 	= $params->get( 'virtuemart_category_id', null ); 
$show_price 	= (bool)$params->get( 'show_price', 1 );
$show_addtocart = (bool)$params->get( 'show_addtocart', 1 );
$show_details 	= (bool)$params->get( 'show_details', 1 );
$show_countdown = (bool)$params->get( 'show_countdown', 1 );
$Product_group 	= $params->get( 'product_group', 'featured');
$layout_name	= str_replace('_:', '', $params->get('layout'));

$filter_category = ($category_id) ? true : false ;

$cache 		= $params->get( 'vmcache', true );
$cachetime 	= $params->get( 'vmcachetime', 300 );

$mainframe = Jfactory::getApplication();
$virtuemart_currency_id = $mainframe->getUserStateFromRequest( "virtuemart_currency_id", 'virtuemart_currency_id',vRequest::getInt('virtuemart_currency_id',0) );

if ($show_addtocart) {
	vmJsApi::jPrice();
	vmJsApi::cssSite();
}

if($cache){
	vmdebug('Use cache for mod products');
	$key = 'products'.$category_id.'.'.$max_items.'.'.$filter_category.'.'.$show_price.'.'.$show_addtocart.'.'.$Product_group.'.'.$virtuemart_currency_id.'.'.$category_id;
	$cache	= JFactory::getCache('mod_sp_vmslider_ii', 'output');
	$cache->setCaching(1);
	$cache->setLifeTime($cachetime);

	if ($output = $cache->get($key)) {
		echo $output;
		vmdebug('Use cached mod products');
		return true;
	}
}

$productModel = VmModel::getModel('Product');

$products = $productModel->getProductListing($Product_group, $max_items, $show_price, true, false, $filter_category, $category_id);

$productModel->addImages($products);

foreach ($products as &$product) {
	$product->image = (isset($product->images[0]) && $product->images[0]) ? $product->images[0]->displayMediaThumb ('class="ProductImage"', FALSE) : '' ; 
	$product->url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id);

	$product_adate = JHTML::date($product->product_available_date, 'Y-m-d');
	$today = JHTML::date(JFactory::getDate(), 'Y-m-d');
	if ($today < $product_adate) {
		$product->available_date = JHTML::date($product->product_available_date, 'Y-m-d');
	} else {
		$product->available_date = JHTML::date(JFactory::getDate(), 'Y-m-d');
	}
}


if (!class_exists('CurrencyDisplay')) require(VMPATH_ADMIN .'/helpers/currencydisplay.php');
$currency = CurrencyDisplay::getInstance( );

if($cache){
	$cache->store($output, $key);
}

echo vmJsApi::writeJS();

require JModuleHelper::getLayoutPath('mod_sp_vmslider_ii', $params->get('layout'));