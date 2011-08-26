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

$e = $modx->event;

switch ($e->name) 
{		
	case 'OnLoadWebDocument': 
		$is_cacheable = $modx->resource->get('cacheable');
		$id = $modx->resource->get('id');
		$cacheKey = $modx->context->get('key') . "/resources/{$id}";
		
		/* This might be not the best way performance wise but it's the only one that works each time */
		$cachedResource = $modx->cacheManager->get($cacheKey, array(
			xPDO::OPT_CACHE_KEY => $modx->getOption('cache_resource_key', null, 'resource'),
			xPDO::OPT_CACHE_HANDLER => $modx->getOption('cache_resource_handler', null, $modx->getOption(xPDO::OPT_CACHE_HANDLER)),
			xPDO::OPT_CACHE_FORMAT => (integer) $modx->getOption('cache_resource_format', null, $modx->getOption(xPDO::OPT_CACHE_FORMAT, null, xPDOCacheManager::CACHE_PHP)),
		));
		
		/* Only parse if the document is not cacheable, or cacheable but not yet cached ( feature request ? ) */
		if($is_cacheable && !is_array($cachedResource) || !$is_cacheable){
			$output = $modx->resource->get('content');

			if(preg_match("/<pre class=\"(.*)\"\>(.*)<\/pre>/Uis", $output)){
				$output = preg_replace_callback("/<pre class=\"(.*)\"\>(.*)<\/pre>/Uis", array(&$geshiLoader,'setLanguage'), $output);
			}

			if(preg_match("/<pre>(.*)<\/pre>/Uis", $output)){
				$output = preg_replace_callback("/<pre>(.*)<\/pre>/Uis", array(&$geshiLoader,'parse'), $output);
			}
			$modx->resource->set('content',$output);	
		}		
	break;	
	/* Postponed until Discuss next alpha/beta/rc/pl (?) release */
	// case 'OnDiscussPostFetchContent': 	
		// $output = $e->params['content'];
		
		// if(preg_match("/<pre class=\"(.*)\"\>(.*)<\/pre>/Uis", $output)){
			// $output = preg_replace_callback("/<pre class=\"(.*)\"\>(.*)<\/pre>/Uis", array(&$geshiLoader,'setLanguage'), $output);
		// }
		 
		// if(preg_match("/<pre>(.*)<\/pre>/Uis", $output)){
			// $output = preg_replace_callback("/<pre>(.*)<\/pre>/Uis", array(&$geshiLoader,'parse'), $output);
		// }	
		
		// $e->_output = $output;	
		// return;		
	// break;
	default: break;	
}