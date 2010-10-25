<?php
/**
 * @package geshi
 * @subpackage build
 */
$events = array();

$events['OnLoadWebDocument'] = $modx->newObject('modPluginEvent');
$events['OnLoadWebDocument']->fromArray(array(
    'event' => 'OnLoadWebDocument',
    'priority' => 0,
    'propertyset' => 0,
),'',true,true);

$events['OnDiscussPostFetchContent'] = $modx->newObject('modPluginEvent');
$events['OnDiscussPostFetchContent']->fromArray(array(
    'event' => 'OnDiscussPostFetchContent',
    'priority' => 0,
    'propertyset' => 0,
),'',true,true);

return $events;