<?php
/**
 * @package geshi
 */
class GeshiLoader {
    /**
     * @var array $config The configuration array for GeshiLoader.
     * @access private
     */
    public $config = array();
    public $language;
	
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
			'class_path' => $corePath.'class/',
			'assets_path' => $assetsPath,
			'assets_url' => $assetsUrl,
			
			'style' => 'geshi',			
			'language' => 'php',
			'enableClasses' => true,
			'tabWidth' => 2,
			'lineNumbers' => false,
			'lineNumberStyle' => 'normal',
		),$config);
	}
	
	/**
     * Initializes GeSHI.
     *
     * @access public
     * @param string $match The string to highlight.
     * @return string The processed content.
     */
	public function initialize($match) 
	{	
		include_once($this->config['class_path'].'geshi.php');		
		
		$language = $this->config['language'];
		
		$geshi = new GeSHi(trim($match[1]),$language);
		
		if($this->config['enableClasses'])
		{
			$this->modx->regClientCSS($this->config['assets_url'].'css/'.$this->config['style'].'.css');
			$geshi->enable_classes();
		}
		else
		{
			$geshi->enable_classes(false);
		}
		
		$geshi->set_tab_width($this->config['tabWidth']);	
		
		if($this->config['lineNumbers'])
		{
			if($this->config['lineNumberStyle'] == 'normal')
			{
				$flag = GESHI_NORMAL_LINE_NUMBERS;
			}
			elseif($this->config['lineNumberStyle'] == 'fancy')
			{
				$flag = GESHI_FANCY_LINE_NUMBERS;
			}
			$geshi->enable_line_numbers($flag);
		}
		
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
		$this->config['language'] = $matches[1];
		$match = array(1 => $matches[2]);
	
		return $this->initialize($match);
	}
}
