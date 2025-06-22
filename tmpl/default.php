<?php
/*------------------------------------------------------------------------
# mod_jocustomcode - JO's Custom Code
# ------------------------------------------------------------------------
# author    JL TRYOEN / RBO Team > Project::: RumahBelanja.com & AppsNity.com
# Copyright (C) 2025 www.jltryoen.fr All Rights Reserved.
# @license  http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
# Websites: http://www.jltryoen.fr 
-------------------------------------------------------------------------*/
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Plugin\PluginHelper;
use JLTRY\Module\JOCustomCode\Site\Helper\JOCustomCodeHelper;

// no direct access
defined('_JEXEC') or die('Restricted access');

//Parameters
$codearea 	= $params->get( 'code_area' );
$clean_js 	= $params->get( 'clean_js' );
$clean_css 	= $params->get( 'clean_css' );
$clean_all 	= $params->get( 'clean_all' );
$userlevel 	= $params->get('userlevel');
$use_php 	= $params->get( 'use_php' );
$load_plugincontent	= $params->get( 'load_plugincontent',0 );

$user = Factory::getUser();
$mylevel 	= (!$user->get('guest')) ? 'logout' : 'login';

//Clean CSS & JS  & All
if (!$clean_all) {
	if ($clean_js) {
		preg_match("/<script(.*)>(.*)<\/script>/i", $codearea, $matches);
		if ($matches) {
			foreach ($matches as $i=>$match) {
				$clean_js = str_replace('<br />', '', $match);
				$codearea = str_replace($match, $clean_js, $codearea);
			}
		}
	}
	if ($clean_css) {
		preg_match("/<style(.*)>(.*)<\/style>/i", $codearea, $matches);
		if ($matches) {
			foreach ($matches as $i=>$match) {
				$clean_js = str_replace('<br />', '', $match);
				$codearea = str_replace($match, $clean_js, $codearea);
			}
		}
	}
} else {
	$codearea = str_replace('<br />', '', $codearea);
}

//To Load Content Plugin
	if ($load_plugincontent){
		PluginHelper::importPlugin('content');
		$codearea = HTMLHelper::_('content.prepare', $codearea, '', 'mod_custom.content');
	}
//End Load Content Plugin
	
switch($userlevel) {
	case 1: //All Visitors
		if (($mylevel == 'logout') or ($mylevel == 'login')){
			if ($use_php == 1) { JOCustomCodeHelper::parsePHPviaFile($codearea); }
				else {	echo $codearea; }
		}
		break;
	case 2: //Guest Visitors
		if ($mylevel == 'login'){
			if ($use_php == 1) { JOCustomCodeHelper::parsePHPviaFile($codearea); }
				else {	echo $codearea; }
		}
		break;
	case 0: //Registered Visitors
	default:
		if ($mylevel == 'logout'){
			if ($use_php == 1) { JOCustomCodeHelper::parsePHPviaFile($codearea); }
				else {	echo $codearea; }
		}
		break;
	}
 ?>