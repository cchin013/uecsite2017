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

    	<div id="sp-vmslider-ii-slide<?php echo $module->id; ?>" class="sp-vmslider-ii-small-countdown carousel slide" data-ride="spvmslider-carousel">
			<?php foreach ($products as $item) { ?>
			<div class="item">
				<div class="sp-vmslider-ii-image">					
					<?php echo $item->image; ?>
				</div> <!-- /.sp-vmslider-ii-image -->
				
				<div class="sp-vmslider-ii-info">
					<div class="content">
						<?php if ($show_price) { ?>	                    
						<?php if($show_countdown){ ?>
						<div class="sp-price-discount-time">
							<p class="title">Time Left to buy</p>
							<div class="sp-vmslider-countdown" data-countdown="<?php echo $item->available_date; ?>"></div>
						</div> <!-- //sp-price-discount-time -->
						<?php } ?>

						<?php } ?>
						<div class="clearfix"></div>
						<?php if($show_details){?>
						<a href="<?php echo $item->url ?>" class="btn btn-default">
							<?php echo jText::_('MOD_SP_VM_SLIDER_II_DETAILS'); ?>
						</a>
						<?php } ?>
					</div>
				</div> <!-- /.sp-vmslider-ii-info -->
				
			</div> <!-- /.item -->
			<?php } ?>

    	</div> <!-- /.sp-vmslider-ii-slide -->

	</div> <!-- /.sp-vmslider-wrapper -->
</div> <!-- /.p-vmslider-ii -->