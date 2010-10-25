<?php
/**
 * GeSHI Snippet
 *
 * @package geshi
 * @subpackage build
 */
$snippets = array();

$snippets[1]= $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
    'id' => 1,
    'name' => PKG_NAME,
    'description' => 'GeSHI Syntax highlighter',
    'snippet' => getSnippetContent($sources['source_core'] . '/elements/geshi.snippet.php'),
));
// $properties = include $sources['build'].'properties/properties.snippet.php';
// $snippets[1]->setProperties($properties);
return $snippets;