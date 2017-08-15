<?php
/**
 * @subpackage	mod_sp_vmslider_ii
 * @copyright	Copyright (C) 2010 - 2016 JoomShaper. All rights reserved.
 * @license		GNU General Public License version 2 or later; 
 */

// no direct access
defined('_JEXEC') or die;
$slide_no = 4;
?>

<div id="sp-vmslider-ii-<?php echo $module->id; ?>" class="sp-vmslider-ii layout-<?php echo $layout_name; ?> <?php echo $params->get('moduleclass_sfx') ?>">
    <div class="sp-vmslider-wrapper">

    	<div id="sp-vmslider-ii-slide<?php echo $module->id; ?>" class="sp-vmslider-ii-slide-layout-2 owl-carousel" data-ride="spvmslider-carousel">
    	<?php $item_count = 0;
    		  $total_item_calculate = 1;
    		  $total_item 	= count($products);
    		foreach(array_chunk($products, $slide_no) as $products) { ?>
    		<div class="row">
			<?php
				foreach ($products as $item) {
				$item_count 	= ($item_count == $slide_no) ? 0 : $item_count;
				$item_float		= ($item_count != 0) ? 'pull-left': '';
				$item_type = ($item_count == 0) ? 'col-sm-8 leading-item' : 'subleading-item' ;
			?>

				<?php if($item_count == 1){ ?>
					<div class="col-sm-4 subleading-items">
				<?php }?>

				<div class="<?php echo $item_type; ?>">
					<div class="sp-vmproduct-image <?php echo $item_float; ?>">					
						<?php echo $item->image; ?>
					</div> <!-- /.sp-vmproduct-image -->
					
					<div class="sp-vmproduct-info <?php echo $item_float; ?>">
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

			                   	<?php if($item_count == 0 && $item->product_in_stock !=0){ ?>
			                   		<?php echo str_replace('-', '', round((($item->prices['discountAmount']*100)/$item->prices['product_price']))); ?>% <?php echo jText::_('MOD_SP_VM_SLIDER_II_DISCOUNT'); ?>
			                   			<div class="sp-vmslider-countdown" data-countdown="<?php echo $item->available_date; ?>"></div>
			                   	<?php } ?>

			                <?php } else{ //has/not discount price ?>
		                   		<ins>
					                <?php echo $currency->createPriceDiv ('salesPrice', '', $item->prices, FALSE, FALSE, 1.0, TRUE); ?>
					            </ins>
		                   	<?php } ?>
			                   	
	                    <?php } // show price ?>

	                    </div> <!-- //sp-price-box -->

	                    <?php if($item_count == 0){ ?>
							<?php if ($show_addtocart && $item->prices['salesPrice']) {
								echo $modSpVmsliderIiHelper->addtocart($item);
							} ?>

							<?php if($show_details){ ?>
								<a href="<?php echo $item->url ?>" class="btn btn-default">
									<?php echo JText::_('MOD_SP_VM_SLIDER_II_DETAILS'); ?>
								</a>
							<?php } ?>
						<?php } // if item key is 0 ?>
					</div> <!-- /.sp-vmproduct-info -->
				</div> <!-- /.item -->

				<?php if( ($item_count == round($slide_no-1)) || ($total_item_calculate ==  $total_item && $item_count > 0) ){ ?>
					</div> <!-- /.col-sm-6 subleading-item -->
				<?php }?>

				<?php $total_item_calculate ++; $item_count ++; } ?>
			</div> <!-- /.item -->
			<?php } //array_chunk ?>

    	</div> <!-- /.sp-vmslider-ii-slide -->

	</div> <!-- /.sp-vmslider-wrapper -->
</div> <!-- /.p-vmslider-ii -->