<?php
/**
 * @package     mod_sp_vmajaxsearch
 *
 * @copyright   Copyright (C) 2010 - 2016 JoomShaper. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

// no direct access
defined('_JEXEC') or die;

$input = JFactory::getApplication()->input;
$cmcat = $input->get('virtuemart_category_id', '', 'INT');
$keyword = $input->get('keyword', '', 'STRING');
?>

<div id="mod_sp_vmajaxsearch<?php echo $module->id; ?>" class="mod-sp-vmajaxsearch <?php echo $params->get('moduleclass_sfx') ?>">
<form action="<?php echo JRoute::_('index.php?option=com_virtuemart&view=category&search=true&limitstart=0&virtuemart_category_id='.$cmcat ); ?>" method="get">
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">
					<select name="virtuemart_category_id" id="virtuemart_category_id" class="form-control">
						<option value="" <?php echo ($cmcat == '') ? 'selected="selected"': '';?>>
							<?php echo JText::_('MOD_SP_VMAJAXSEARCH_ALL'); ?>
						</option>
						<?php echo $cat_trees; ?>
					</select>
				</div>

				<div class="sp-form-control-container">
					<input type="text" name="keyword" id="mod_virtuemart_search" class="sp-vmajax-search-input form-control" value="<?php echo $keyword; ?>" placeholder="<?php echo JText::_('MOD_SP_VMAJAXSEARCH_PLACEHOLDER'); ?>" autocomplete="off">
					<a href="#" class="sp-vmajaxsearch-clear" style="display: none;"><i class="fa fa-times-circle"></i></a>
					<div class="sp-vmajaxsearch-results" style="display: none;"></div>
				</div>

				<div class="input-group-addon">
					<button type="submit" class="sp-vmajax-search-submit btn btn-primary">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</div>
		</div>
		<input type="hidden" name="limitstart" value="0" />
		<input type="hidden" name="option" value="com_virtuemart" />
		<input type="hidden" name="view" value="category" />
		<input type="hidden" name="Itemid" value="<?php echo $item_id; ?>" />
	</form>
</div>