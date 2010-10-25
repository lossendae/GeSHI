<?php
/**
 * Loads system settings
 *
 * @package geshi
 * @subpackage build
 */
$settings = array();

$settings['geshi.theme']= $modx->newObject('modSystemSetting');
$settings['geshi.theme']->fromArray(array(
    'key' => 'geshi.theme',
    'value' => 'zenburnesque',
    'xtype' => 'textfield',
    'namespace' => 'geshi',
    'area' => 'Syntax highlighting',
),'',true,true);

return $settings;