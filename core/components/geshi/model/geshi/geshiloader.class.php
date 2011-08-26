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
class GeshiLoader {
    /**
     * @var array $config The configuration array for GeshiLoader.
     * @access private
     */
    public $config = array();
    private $_language;
    private $_loadTheme = true;
	
	/**
     * The GeshiLoader constructor.
     *
     * @param modX $modx A reference to the modX constructor.
     */
	function __construct(modX &$modx,array $config = array()) {
		$this->modx =& $modx;

		$assetsUrl = $this->modx->getOption('geshi.assets_url',$config,$this->modx->getOption('assets_url').'components/geshi/');
		$assetsPath = $this->modx->getOption('geshi.assets_path',$config,$this->modx->getOption('assets_path').'components/geshi/');
		$corePath = $this->modx->getOption('geshi.core_path',$config,$this->modx->getOption('core_path').'components/geshi/');
		$this->config = array_merge(array(
			'core_path' => $corePath,
			'lib_path' => $corePath.'lib/',
			'assets_path' => $assetsPath,
			'assets_url' => $assetsUrl,
			
			'enable_line_numbers' => false,
			'theme' => 'geshi',
		),$config);
	}
	
	/**
     * Initializes GeSHI.
     *
     * No need to escape MODx tags beforehand, they are automatically escaped by GeSHI
     *
     * @access public
     * @param array $content The string to highlight.
     * @return string The processed content.
     */
	public function parse($content) 
	{		
		/* Load CSS from the plugin */
		if($this->_loadTheme){
			$this->modx->regClientCSS($this->config['assets_url'].'css/'. $this->config['theme'] .'.css');
		}
		
		/* Load the GeSHI class */
		if (!$this->modx->loadClass('geshi',$this->config['lib_path'],true,true)) {
			return 'Could not load the GeSHI class.';		
		}	
		
		$language = $this->_language;
		
		/**/
		if(empty($language)){
			$language = 'html4strict';			
		}
		
		$content = str_replace('&gt;','>', $content[1]);
		$content = str_replace('&lt;','<', $content);		
		
		$geshi = new GeSHi(trim($content), $this->_language);	
		$geshi->enable_classes();

		$lineNumbers = $this->config['enable_line_numbers'];
		$geshi->enable_line_numbers($lineNumbers);
		$geshi->set_tab_width(2);
		
		$string = $geshi->parse_code();
		
		return $string;
	}
	
	/**
     * Set the language highlighted by GeSHI.
     *
     * @access public
     * @param array $matches The array containing both the string to highlight and the language name.
     * @return funtion initialize Geshi.
     */
	public function setLanguage($matches)
	{
		$this->_language = $matches[1];		
		$match = array(1 => $matches[2]);
	
		return $this->parse($match);
	}
	
	public function loadTheme($value = false)
	{
		$this->_loadTheme = $value;
	}
}
