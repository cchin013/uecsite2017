<?php
/**
 * @package     mod_sp_vmajaxsearch
 *
 * @copyright   Copyright (C) 2010 - 2016 JoomShaper. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

defined('_JEXEC') or die;

if( !class_exists( 'VmConfig' ) ) require(JPATH_ADMINISTRATOR . '/components/com_virtuemart/helpers/config.php');
VmConfig::loadConfig();

class modSpVmajaxsearchHelper {

	public static function getAjax(){

		$input  = JFactory::getApplication()->input;
		$catid 	= $input->post->get('catid', '', 'INT');
		$word 	= $input->post->get('query', '', 'STRING');

		if($word == '') return;

		$results = self::getSearchedItems($word, $catid);

		$layout = new JLayoutFile('results', $basePath = JPATH_ROOT .'/modules/mod_sp_vmajaxsearch/layouts');
		$html = $layout->render(array('results'=>$results));

		$output = array(
			'status'=>'true',
			'content'=>$html
			);

		echo json_encode($output);
		die;
	}

	private static function getSearchedItems($word, $catid = 0){

		$media_model 	= VmModel::getModel('media');
		//$porduct_model 	= VmModel::getModel('product');

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$search = preg_replace('#\xE3\x80\x80#s', " ", trim($word));
		$search_array = explode(" ", $search);

		$query->select(array('a.*', 'b.virtuemart_category_id', 'c.product_price', 'c.product_override_price', 'd.published'));
		$query->from($db->quoteName('#__virtuemart_products_'.VmConfig::$vmlang, 'a'));

		$query->join('LEFT', $db->quoteName('#__virtuemart_product_categories', 'b') . ' ON (' . $db->quoteName('a.virtuemart_product_id') . ' = ' . $db->quoteName('b.virtuemart_product_id') . ')');

		$query->join('LEFT', $db->quoteName('#__virtuemart_product_prices', 'c') . ' ON (' . $db->quoteName('a.virtuemart_product_id') . ' = ' . $db->quoteName('c.virtuemart_product_id') . ')');

		$query->join('LEFT', $db->quoteName('#__virtuemart_products', 'd') . ' ON (' . $db->quoteName('a.virtuemart_product_id') . ' = ' . $db->quoteName('d.virtuemart_product_id') . ')');
		$query->where($db->quoteName('b.virtuemart_category_id') . '!=""');
		$query->group($db->quoteName('a.virtuemart_product_id'));

		if ($catid) {
			$query->where($db->quoteName('b.virtuemart_category_id')." = " . $catid);
		}

		$query->where($db->quoteName('a.product_name') . " LIKE '%" . implode("%' OR " . $db->quoteName('a.product_name') . " LIKE '%", $search_array) . "%'");
		$query->where($db->quoteName('d.published')." = 1");
		$query->setLimit(10);
		$db->setQuery($query);
		$results = $db->loadObjectList();

		foreach ($results as &$result) {
			$result->images  = $media_model->getFiles(false, 1, $result->virtuemart_product_id);
			$result->url  	 = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $result->virtuemart_product_id . '&virtuemart_category_id=' . $result->virtuemart_category_id);
		}

		return $results;
	}

	public $categoryModel;
    private $sptree;
    public function generateTree($categories, $selectedId=0, $deep=0){
        foreach ($categories as $category) {

            $this->sptree .= '<option '. (($category->virtuemart_category_id==$selectedId) ? 'selected="selected"':'') .' value="'.$category->virtuemart_category_id.'" data-name="'.$category->category_name.'">'. str_repeat('-', $deep*2) . ' ' . $category->category_name . '</option>';

            $child =  $this->categoryModel->getChildCategoryList(1, $category->virtuemart_category_id);

            if( is_array($child) and !empty($child) ){
                $this->generateTree($child, $selectedId, $deep+1 );
            }
        }

        return $this->sptree;
    }

}
