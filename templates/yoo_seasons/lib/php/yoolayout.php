<?php
/**
 * YOOLayout setup
 *
 * @version		1.0.0 (06.05.2007)
 * @author		yootheme.com
 * @copyright	Copyright (C) 2007 YOOtheme Ltd & Co. KG. All rights reserved.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$yTools = &YOOTools::getInstance();

// set css-class for topbox
$topmodules = 0;
if($this->countModules('user1')) $topmodules += 1;
if($this->countModules('user2')) $topmodules += 1;
if($this->countModules('user3')) $topmodules += 1;
switch ($topmodules) {
	case 1:
		$topboxwidth = "width100";
		break;
	case 2:
		$topboxwidth = "width50";
		break;
	case 3:
		$topboxwidth = "width33";
		break;
	default:
		$topboxwidth = "";
}

// set css-class for maintopbox
$maintopmodules = 0;
if($this->countModules('user4')) $maintopmodules += 1;
if($this->countModules('user5')) $maintopmodules += 1;
switch ($maintopmodules) {
	case 1:
		$maintopboxwidth = "width100";
		break;
	case 2:
		$maintopboxwidth = "width50";
		break;
	default:
		$maintopboxwidth = "";
}

// set css-class for contenttopbox
$contenttopmodules = 0;
if($this->countModules('advert1')) $contenttopmodules += 1;
if($this->countModules('advert2')) $contenttopmodules += 1;
switch ($contenttopmodules) {
	case 1:
		$contenttopboxwidth = "width100";
		break;
	case 2:
		$contenttopboxwidth = "width50";
		break;
	default:
		$contenttopboxwidth = "";
}

// set css-class for contentbottombox
$contentbottommodules = 0;
if($this->countModules('advert3')) $contentbottommodules += 1;
if($this->countModules('advert4')) $contentbottommodules += 1;
switch ($contentbottommodules) {
	case 1:
		$contentbottomboxwidth = "width100";
		break;
	case 2:
		$contentbottomboxwidth = "width50";
		break;
	default:
		$contentbottomboxwidth = "";
}

// set css-class for mainbottombox
$mainbottommodules = 0;
if($this->countModules('user6')) $mainbottommodules += 1;
if($this->countModules('user7')) $mainbottommodules += 1;
switch ($mainbottommodules) {
	case 1:
		$mainbottomboxwidth = "width100";
		break;
	case 2:
		$mainbottomboxwidth = "width50";
		break;
	default:
		$mainbottomboxwidth = "";
}

// set css-class for bottombox
$bottommodules = 0;
if($this->countModules('user8')) $bottommodules += 1;
if($this->countModules('bottom')) $bottommodules += 1;
if($this->countModules('user9')) $bottommodules += 1;
switch ($bottommodules) {
	case 1:
		$bottomboxwidth = "width100";
		break;
	case 2:
		$bottomboxwidth = "width50";
		break;
	case 3:
		$bottomboxwidth = "width33";
		break;
	default:
		$bottomboxwidth = "";
}

// set css-class for topbox seperators
$topbox12seperator = "";
$topbox23seperator = "";
if ($this->countModules('user1') && ($this->countModules('user2') || $this->countModules('user3'))) {
	$topbox12seperator = "topboxseperator";
}
if ($this->countModules('user2') && $this->countModules('user3')) {
	$topbox23seperator = "topboxseperator";
}

// set css-class for maintopbox seperators
$maintopbox12seperator = "";
if ($this->countModules('user4') && $this->countModules('user5')) {
	$maintopbox12seperator = "maintopboxseperator";
}

// set css-class for mainbottombox seperators
$mainbottombox12seperator = "";
if ($this->countModules('user6') && $this->countModules('user7')) {
	$mainbottombox12seperator = "mainbottomboxseperator";
}

// set css-class for contenttopbox seperators
$contenttopbox12seperator = "";
if ($this->countModules('advert1') && $this->countModules('advert2')) {
	$contenttopbox12seperator = "contenttopboxseperator";
}

// set css-class for contentbottombox seperators
$contentbottombox12seperator = "";
if ($this->countModules('advert3') && $this->countModules('advert4')) {
	$contentbottombox12seperator = "contentbottomboxseperator";
}

// set css-class for bottombox seperators
$bottombox12seperator = "";
$bottombox23seperator = "";
if ($this->countModules('user8') && ($this->countModules('bottom') || $this->countModules('user9'))) {
	$bottombox12seperator = "bottomboxseperator";
}
if ($this->countModules('bottom') && $this->countModules('user9')) {
	$bottombox23seperator = "bottomboxseperator";
}

// set css-class for layoutstyle
if($this->countModules('left')) {
	if($this->params->get('layout') == "left") {
		$layoutstyle = "layoutleft";
	} else {
		$layoutstyle = "layoutright";
	}
} else {
	$layoutstyle = "withoutleft";
}

// set css-class for rightbackground
if($this->countModules('right')) {
	$rightbackground = "withright";
} else {
	$rightbackground = "withoutright";
}

// set color (depending on active item)
$itemcolor = "";
if ($itemnum = $yTools->getActiveMenuItemNumber('mainmenu', 0)) {
	$itemcolor = $this->params->get('item' . $itemnum . 'Color');
}

// initialize date
jimport('joomla.utilities.date');
$config =& JFactory::getConfig();
$date = new JDate('now', $config->getValue('config.offset'));

?>