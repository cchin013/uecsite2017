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

    	<?php $item_count = 0;
    		foreach(array_chunk($products, 3) as $products) { ?>
    		<div class="spvmslider-ii-items">
			<?php foreach ($products as $item) { ?>
				<div class="spvmslider-ii-item">
					<div class="sp-vmproduct-image pull-left">					
						<?php echo $item->image; ?>
					</div> <!-- /.sp-vmslider-ii-image -->
					
					<div class="sp-vmproduct-info pull-left">
						<a href="<?php echo $item->url ?>"><?php echo $item->product_name ?></a>
						<div class="sp-price-box">	
						<?php if ($show_price) { ?>
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

	                    <?php } ?>
						</div> <!-- //sp-price-box -->
					</div> <!-- /.sp-vmslider-ii-info -->
				</div> <!-- /.item -->
				<?php $item_count ++; } ?>
			</div> <!-- /.item -->
			<?php } //array_chunk ?>

    	</div> <!-- /.sp-vmslider-ii-slide -->

	</div> <!-- /.sp-vmslider-wrapper -->
</div> <!-- /.p-vmslider-ii -->