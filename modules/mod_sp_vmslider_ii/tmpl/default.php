<?php
/**
 * @subpackage	mod_sp_vmslider_ii
 * @copyright	Copyright (C) 2010 - 2016 JoomShaper. All rights reserved.
 * @license		GNU General Public License version 2 or later; 
 */

// no direct access
defined('_JEXEC') or die;

?>

<div id="sp-vmslider-ii-<?php echo $module->id; ?>" class="sp-vmslider-ii layout-<?php echo $layout_name; ?> <?php echo $params->get('moduleclass_sfx') ?>">
    <div class="sp-vmslider-wrapper">

    	<div id="sp-vmslider-ii-slide<?php echo $module->id; ?>" class="sp-vmslider-ii-slide carousel slide" data-ride="spvmslider-carousel">
			<?php foreach ($products as $item) {
				$quick_view_url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $item->virtuemart_product_id . '&virtuemart_category_id=' . $item->virtuemart_category_id . '&tmpl=component', FALSE);
				?>
			<div class="item sp-vmproduct-wrapper">
				<div class="sp-vmproduct-image">					
					<?php echo $item->image; ?>
					<div class="vmproduct-more-action">
						<ul>
							<?php if ($show_addtocart && $item->prices['salesPrice']) { ?>
								<li><?php echo $modSpVmsliderIiHelper->addtocart($item); ?></li>
							<?php } ?>
							<li><a href="<?php echo $item->url ?>"><i class="megadeal-icon-eye"></i></a></li>
						</ul>
					</div> <!-- //vmproduct-more-action -->
				</div> <!-- /.sp-vmslider-ii-image -->
				
				<div class="sp-vmproduct-info">
					<h3 class="sp-item-title"><a href="<?php echo $item->url ?>"><?php echo $item->product_name ?></a></h3>
					<?php if ($show_price) { ?>
						<div class="sp-price-box">					
	                    <?php if ( isset($item->prices['product_override_price']) && round($item->prices['product_override_price']) != 0) { ?>
	                    	<ins>
				                <?php echo $currency->createPriceDiv ('salesPrice', '', $item->prices, FALSE, FALSE, 1.0, TRUE); ?>
				            </ins>
				            <del>    
				                <?php echo $currency->createPriceDiv ('product_price', '', $item->prices, FALSE, FALSE, 1.0, TRUE); ?>
				            </del>
                    	<?php } else{ ?>
                    		<ins>
				                <?php echo $currency->createPriceDiv ('salesPrice', '', $item->prices, FALSE, FALSE, 1.0, TRUE); ?>
				            </ins>
                    	<?php } ?>
                    	</div> <!-- //sp-price-box -->
                    <?php } // show price ?>

                	<?php if($show_countdown && $item->product_in_stock !=0){ ?>                  
                   		<div class="sp-vmslider-countdown" data-countdown="<?php echo $item->available_date; ?>"></div>
            		<?php } ?>

					<?php if ($show_addtocart && $item->prices['salesPrice']) {
						echo $modSpVmsliderIiHelper->addtocart($item);
					} ?>

					<?php if($show_details){?>
						<a href="<?php echo $item->url ?>" class="btn btn-default">
							<?php echo jText::_('MOD_SP_VM_SLIDER_II_DETAILS'); ?>
						</a>
					<?php } ?>
				</div> <!-- /.sp-vmslider-ii-info -->
				
			</div> <!-- /.item -->
			<?php } ?>

    	</div> <!-- /.sp-vmslider-ii-slide -->

	</div> <!-- /.sp-vmslider-wrapper -->
</div> <!-- /.p-vmslider-ii -->