<?php
/**
 * GeSHI Syntax highlighter - Plugin for MODx Revolution
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
if (!($geshiLoader instanceof GeshiLoader)) return 'GeshiLoader could not be loaded';

$eventName = $modx->event->name;

switch ($eventName) 
{
	case 'OnLoadWebDocument': 
		//Get the current resource - Content is not yet parsed, so listing snippet like Ditto or getResource will not be highlighted
		$content = $modx->resource->get('content');
		
		if(preg_match("/<pre class=\"(.*)\"\>(.*)<\/pre>/Uis", $content)){
			$content = preg_replace_callback("/<pre class=\"(.*)\"\>(.*)<\/pre>/Uis", array(&$geshiLoader,'setLanguage'), $content);
		}
		 
		if(preg_match("/<pre>(.*)<\/pre>/Uis", $content)){
			$content = preg_replace_callback("/<pre>(.*)<\/pre>/Uis", array(&$geshiLoader,'initialize'), $content);
		}
		$modx->resource->set('content',$content);
	break;
	default: break;	
}
return;