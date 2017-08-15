<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2016 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined ('_JEXEC') or die ('restricted aceess');
class SppagebuilderAddonMegadeal_title extends SppagebuilderAddons{
	public function render() {
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$icon  = (isset($this->addon->settings->icon) && $this->addon->settings->icon) ? $this->addon->settings->icon : '';
		$icon_color  = (isset($this->addon->settings->icon_color) && $this->addon->settings->icon_color) ? $this->addon->settings->icon_color : '';
		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';

		if($title) {
				$output  = '<div class="sppb-addon-megadeal-title clearfix">';

				if($icon) {
					$style = ($icon_color) ? ' style="color: '. $icon_color .'"' : '';
					$output .= '<i class="fa ' . $icon . ' pull-left"' . $style . '></i>';
				}

				$output .= '<h3 class="sppb-addon-title pull-left">' . $title . '</h3>';
				$output .= '</div>';
				return $output;
		}

		return false;

	}
}
