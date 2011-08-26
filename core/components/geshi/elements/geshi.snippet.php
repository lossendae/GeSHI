<?php
/**
 * GeSHI Syntax highlighter - Snippet for MODx Revolution
 *
 * Copyright 2010 by lossendae <lossendae@gmail.com>
 *
 * GeSHI Syntax highlighter is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * GeSHI Syntax highlighter is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * GeSHI Syntax highlighter; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package geshi
 */
/**
 * @package geshi
 */

$geshiLoader = $modx->getService('geshi','GeshiLoader',$modx->getOption('geshi.core_path',null,$modx->getOption('core_path').'components/geshi/').'model/geshi/',$scriptProperties);
if (!($geshiLoader instanceof GeshiLoader)) return 'GeshiLoader controller could not be loaded';

$content = $modx->getOption('input', $scriptProperties, $modx->getOption('highlight', $scriptProperties, '');
$loadTheme = $modx->getOption('loadTheme', $scriptProperties, false);

/* Useful when the CSS has already been loaded via the plugin */
$geshiLoader->loadTheme($loadTheme);
		
if(preg_match("/<pre class=\"(.*)\"\>(.*)<\/pre>/Uis", $output)){
	$output = preg_replace_callback("/<pre class=\"(.*)\"\>(.*)<\/pre>/Uis", array(&$geshiLoader,'setLanguage'), $output);
}

if(preg_match("/<pre>(.*)<\/pre>/Uis", $output)){
	$output = preg_replace_callback("/<pre>(.*)<\/pre>/Uis", array(&$geshiLoader,'parse'), $output);
}

return $content;