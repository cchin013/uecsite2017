<?php
/**
 * @package     mod_sp_vmajaxsearch
 *
 * @copyright   Copyright (C) 2010 - 2016 JoomShaper. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

// no direct access
defined('_JEXEC') or die;

$results = $displayData['results'];

if (!class_exists('CurrencyDisplay')) require(VMPATH_ADMIN . DS . 'helpers' . DS . 'currencydisplay.php');
$currency = CurrencyDisplay::getInstance();

?>

<ul class="sp-vmajax-courses-search results-list">
	<?php if(count($results)) {

		$is_published = array_map(function ($entry) {
			return $entry->published;
		}, $results);
		
		$is_published = array_diff($is_published,['0']);

		if(empty($is_published)){ ?>
			<li>
				<?php echo JText::_('MOD_SP_VMAJAXSEARCH_NO_ITEM_FOUND'); ?>
			</li>
		<?php } ?>

		<?php foreach ($results as $key => $result) {
			$description = ($result->product_s_desc) ? $result->product_s_desc : $result->product_desc;
			// product discount price
			$has_discount = (round($result->product_override_price) != 0) ? 'price-discounted' : '' ;
			if ($result->published) { ?>
				<li>
				<div class="media">
					<div class="pull-left">
						<?php
							if(isset($result->images[0]) && $result->images[0]) {
								echo $result->images[0]->displayMediaThumb ('class="ProductImage"', FALSE);
							}
						?>
					</div>
					<div class="media-body">
						<a class="sp-vmajax-search-product-title" href="<?php echo $result->url; ?>">
							<?php echo $result->product_name; ?>
						</a>
						<div class="sp-vmajax-search-product-price">
							<span class="sp-product-price <?php echo $has_discount; ?>">
								<?php echo $currency->priceDisplay($result->product_price); ?>
							</span>
							<?php if(round($result->product_override_price) != 0){?>
								<span class="sp-product-discount"><?php echo $currency->priceDisplay($result->product_override_price); ?></span>
							<?php } ?>
						</div>
					</div>
				</div>
				</li>
			<?php } ?>
		<?php } ?>
	<?php } else { ?>
		<li>
			<?php echo JText::_('MOD_SP_VMAJAXSEARCH_NO_ITEM_FOUND'); ?>
		</li>
	<?php } ?>
</ul>
