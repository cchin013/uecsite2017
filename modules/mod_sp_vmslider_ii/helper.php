<?php

/**
 * @package		Joomla.Site
 * @subpackage	mod_sp_vmslider_ii
 * @copyright	Copyright (C) 2010 - 2016 JoomShaper. All rights reserved.
 * @license		GNU General Public License version 2 or later; 
 */

// no direct access
defined('_JEXEC') or die('Direct access not allowed');

if( !class_exists( 'VmConfig' ) ) require(JPATH_ADMINISTRATOR . '/components/com_virtuemart/helpers/config.php');

if( !class_exists( 'modSpVmsliderIiHelper') ) {
	
	class modSpVmsliderIiHelper {

		public function addtocart($product) {

		    if (!VmConfig::get ('use_as_catalog', 0)) {
		        $stockhandle = VmConfig::get ('stockhandle', 'none');
		        if (($stockhandle == 'disableit' or $stockhandle == 'disableadd') and ($product->product_in_stock - $product->product_ordered) < 1) {
		            $button_lbl = JText::_ ('COM_VIRTUEMART_CART_NOTIFY');
		            $button_cls = 'notify-button';
		            $button_name = 'notifycustomer';
		        ?>
		        <div style="display:inline-block;">
		            <a href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&layout=notify&virtuemart_product_id=' . $product->virtuemart_product_id); ?>" class="notify"><?php echo JText::_ ('COM_VIRTUEMART_CART_NOTIFY') ?></a>
		        </div>
		        <?php
		        } else { ?>
		        <form method="post" class="product" action="index.php">
		            <input type="hidden" class="quantity-input" name="quantity[]" value="1"/>
		            <?php
		                // Add the button
		                $button_lbl = JText::_ ('COM_VIRTUEMART_CART_ADD_TO');
		                $button_cls = ''; //$button_cls = 'addtocart_button';
		            ?>
		            <button type="submit" name="addtocart" class="addtocart-button btn btn-gray" value="<?php echo $button_lbl ?>"><?php echo $button_lbl ?></button>
		            <input type="hidden" class="pname" value="<?php echo $product->product_name ?>"/>
		            <input type="hidden" name="option" value="com_virtuemart"/>
		            <input type="hidden" name="view" value="cart"/>
		            <noscript><input type="hidden" name="task" value="add"/></noscript>
		            <input type="hidden" name="virtuemart_product_id[]" value="<?php echo $product->virtuemart_product_id ?>"/>
		            <input type="hidden" name="virtuemart_category_id[]" value="<?php echo $product->virtuemart_category_id ?>"/>
		        </form>
		        <?php
		        }
		    }
		}
		
	}

}