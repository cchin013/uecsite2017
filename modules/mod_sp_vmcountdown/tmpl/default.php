<?php
/**
 * @subpackage	mod_sp_vmslider_ii
 * @copyright	Copyright (C) 2010 - 2016 JoomShaper. All rights reserved.
 * @license		GNU General Public License version 2 or later; 
 */

// no direct access
defined('_JEXEC') or die;

?>

<div id="sp-vmcountdown-<?php echo $module->id; ?>" class="sp-vmcountdown <?php echo $params->get('moduleclass_sfx') ?>">
    <div class="sp-vmcountdown-wrapper">
    	<div class="row-fluid">
	    	<div class="sp-vmcountdown-slide owl-carousel">
				<?php foreach ($products as $item) { 
					$askquestion_url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&task=askquestion&virtuemart_product_id=' . $item->virtuemart_product_id . '&virtuemart_category_id=' . $item->virtuemart_category_id . '&tmpl=component', FALSE);
					?>
					<div class="item">

						<div class="sp-vmcountdown-image col-sm-7">					
							<?php echo $item->image; ?>
						</div>
						
						<div class="sp-vmcountdown-info col-sm-5">
							<h1 class="sp-item-title"><a href="<?php echo $item->url ?>"><?php echo $item->product_name ?></a></h1>
							<?php if ($show_price) { ?>
								<div class="sp-price-box">
		                    	<?php if ( isset($item->prices['product_override_price']) && round($item->prices['product_override_price']) != 0) { ?>
						                <ins><?php echo $currency->createPriceDiv ('salesPrice', '', $item->prices, FALSE, FALSE, 1.0, TRUE); ?></ins>
						                <del><?php echo $currency->createPriceDiv ('product_price', '', $item->prices, FALSE, FALSE, 1.0, TRUE); ?></del>
						        <?php } else{ ?>
						        	<ins><?php echo $currency->createPriceDiv ('salesPrice', '', $item->prices, FALSE, FALSE, 1.0, TRUE); ?></ins>       
						        <?php } ?>        
					            </div> <!-- //sp-price-box -->

								<div class="sp-price-info">
				                   	<?php if($show_countdown && $item->product_in_stock !=0){ ?>
				                   		<div class="sp-price-discount-time">
				                   			<p class="title">
				                   				<?php echo JText::_('MOD_SP_VM_SLIDER_II_TIME_LEFT_TO_BUY'); ?>
				                   			</p>
				                   			<div class="sp-vmslider-countdown" data-countdown="<?php echo $item->available_date; ?>"></div>
				                   		</div> <!-- //sp-price-discount-time -->
				                   	<?php } ?>
				                   	<?php if ( isset($item->prices['product_override_price']) && round($item->prices['product_override_price']) != 0 ) { ?>
				                   		<div class="sp-price-discount">
				                   			<p class="title">
				                   				<?php echo JText::_('MOD_SP_VM_SLIDER_II_DISCOUNT'); ?>
				                   			</p>
				                   			<?php echo str_replace('-', '', round((($item->prices['discountAmount']*100)/$item->prices['product_price']))); ?>%
				                  		</div> <!-- //sp-price-discount -->
						                <div class="sp-price-save">
						                	<div class="spvmcountdown-save">
						                		<p class="title">
						                			<?php echo JText::_('MOD_SP_VM_SLIDER_II_YOU_SAVE'); ?>
						                		</p>
						                		<?php echo str_replace('-', '', $currency->createPriceDiv ('discountAmount', '', $item->prices, FALSE, FALSE, 1.0, TRUE)); ?>
						                	</div>
						                </div> <!-- //sp-price-save -->
						            <?php } ?>
								</div> <!-- //sp-price-info -->
		                    <?php } ?>

		                    <div class="spvmcountdown-btn-group">
								<?php if ($show_addtocart && $item->prices['salesPrice']) {
									echo $modSpVmCountdownHelper->addtocart($item);
								} ?>

								<a href="<?php echo $item->url ?>" class="btn btn-border">
									<?php echo JText::_('MOD_SP_VM_SLIDER_II_DETAILS'); ?>
								</a>
							</div> <!-- /.spvmcountdown-btn-group -->
						</div>
					</div>
				<?php } ?>

	    		</div> <!-- /.sp-vmcountdown-slide -->

    	</div> <!-- /.row-fluid-->
	</div>
</div>