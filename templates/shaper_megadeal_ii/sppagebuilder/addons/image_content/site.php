<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

class SppagebuilderAddonImage_content extends SppagebuilderAddons{
	public function render() {
		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		//Options
		$image = (isset($this->addon->settings->image) && $this->addon->settings->image) ? $this->addon->settings->image : '';
		$image_width = (isset($this->addon->settings->image_width) && $this->addon->settings->image_width) ? $this->addon->settings->image_width : '';
		$image_alignment = (isset($this->addon->settings->image_alignment) && $this->addon->settings->image_alignment) ? $this->addon->settings->image_alignment : '';
		$text = (isset($this->addon->settings->text) && $this->addon->settings->text) ? $this->addon->settings->text : '';
		$button_text = (isset($this->addon->settings->button_text) && $this->addon->settings->button_text) ? $this->addon->settings->button_text : '';

		$button_url = (isset($this->addon->settings->button_url) && $this->addon->settings->button_url) ? $this->addon->settings->button_url : '';
		$button_size = (isset($this->addon->settings->button_size) && $this->addon->settings->button_size) ? $this->addon->settings->button_size : '';
		$button_type = (isset($this->addon->settings->button_type) && $this->addon->settings->button_type) ? $this->addon->settings->button_type : '';
		$button_icon = (isset($this->addon->settings->button_icon) && $this->addon->settings->button_icon) ? $this->addon->settings->button_icon : '';
		$button_block = (isset($this->addon->settings->button_block) && $this->addon->settings->button_block) ? $this->addon->settings->button_block : '';
		$button_target = (isset($this->addon->settings->button_target) && $this->addon->settings->button_target) ? $this->addon->settings->button_target : '';


			if($image_alignment=='left') {
				$eontent_class = ' sppb-col-sm-offset-6';
			} else {
				$eontent_class = '';
			}


			if($image && $title) {

				$output  = '<div class="sppb-addon sppb-addon-image-content aligment-'. $image_alignment .' clearfix ' . $class . '">';

				//Image
				$output .= '<div style="background-image: url(' . JURI::root() .  $image . ');" class="sppb-image-holder">';
				$output .= '</div>';

				//Content
				//$output .= '<div class="sppb-container">';
				$output .= '<div class="sppb-row">';

				$output .= '<div class="sppb-col-sm-6'. $eontent_class .'">';
				$output .= '<div class="sppb-content-holder">';

				$output .= '<'.$heading_selector.' class="sppb-image-content-title">' . $title . '</'.$heading_selector.'>';

				if($text) $output .= '<p class="sppb-image-content-text">' . $text . '</p>';

				if($button_icon) {
					$button_text = '<i class="fa ' . $button_icon . '"></i> ' . $button_text;
				}

				if($button_text) {
					$output .= '<a target="' . $button_target . '" href="' . $button_url . '" class="sppb-btn sppb-btn-' . $button_type . ' sppb-btn-' . $button_size . ' ' . $button_block . '" role="button">' . $button_text . '</a>';
				}

				$output .= '</div>';
				$output .= '</div>';
				//$output .= '</div>';
				$output .= '</div>';

				$output .= '</div>';

				return $output;
			}

			return;
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';
		$css_path = new JLayoutFile('addon.css.button', $layout_path);
		return $css_path->render(array('addon_id' => $addon_id, 'options' => $this->addon->settings, 'id' => 'btn-' . $this->addon->id));
	}
	
}

// AddonParser::addAddon('sp_image_content','sp_image_content_addon');
//
// function sp_image_content_addon($atts){
//
// 	extract(spAddonAtts(array(
// 		"image" 				=> '',
// 		"image_width" 			=> '',
// 		"image_alignment"		=> '',
// 		"title" 				=> '',
// 		"heading_selector" 		=> 'h3',
// 		"title_fontsize" 		=> '',
// 		"title_fontweight" 		=> '',
// 		"title_text_color" 		=> '',
// 		"title_margin_top" 		=> '',
// 		"title_margin_bottom" 	=> '',
// 		"text" 					=> '',
// 		"button_text"			=> '',
// 		"button_url"			=> '',
// 		"button_size"			=> '',
// 		"button_type"			=> '',
// 		"button_icon"			=> '',
// 		"button_block"			=> '',
// 		"button_target"			=> '',
// 		"class"=>'',
// 		), $atts));
//
//
// 	if($image_alignment=='left') {
// 		$eontent_class = ' sppb-col-sm-offset-6';
// 	} else {
// 		$eontent_class = '';
// 	}
//
//
// 	if($image && $title) {
//
// 		$output  = '<div class="sppb-addon sppb-addon-image-content aligment-'. $image_alignment .' clearfix ' . $class . '">';
//
// 		//Image
// 		$output .= '<div style="background-image: url(' .  $image . ');" class="sppb-image-holder">';
// 		$output .= '</div>';
//
// 		//Content
// 		//$output .= '<div class="sppb-container">';
// 		$output .= '<div class="sppb-row">';
//
// 		$output .= '<div class="sppb-col-sm-6'. $eontent_class .'">';
// 		$output .= '<div class="sppb-content-holder">';
//
// 		$title_style = '';
// 		if($title_margin_top !='') $title_style .= 'margin-top:' . (int) $title_margin_top . 'px;';
// 		if($title_margin_bottom !='') $title_style .= 'margin-bottom:' . (int) $title_margin_bottom . 'px;';
// 		if($title_text_color) $title_style .= 'color:' . $title_text_color  . ';';
// 		if($title_fontsize) $title_style .= 'font-size:'.$title_fontsize.'px;line-height:'.$title_fontsize.'px;';
// 		if($title_fontweight) $title_style .= 'font-weight:'.$title_fontweight.';';
//
// 		$output .= '<'.$heading_selector.' class="sppb-image-content-title" style="' . $title_style . '">' . $title . '</'.$heading_selector.'>';
//
// 		if($text) $output .= '<p class="sppb-image-content-text">' . $text . '</p>';
//
// 		if($button_icon) {
// 			$button_text = '<i class="fa ' . $button_icon . '"></i> ' . $button_text;
// 		}
//
// 		if($button_text) {
// 			$output .= '<a target="' . $button_target . '" href="' . $button_url . '" class="sppb-btn sppb-btn-' . $button_type . ' sppb-btn-' . $button_size . ' ' . $button_block . '" role="button">' . $button_text . '</a>';
// 		}
//
// 		$output .= '</div>';
// 		$output .= '</div>';
// 		//$output .= '</div>';
// 		$output .= '</div>';
//
// 		$output .= '</div>';
//
// 		return $output;
// 	}
//
// 	return;
//
// }
