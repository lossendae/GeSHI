--------------------
Snippet & Plugin : GeSHI
--------------------
Version: 0.1 beta 1
Since: May 22th, 2010
Author: lossendae <lossendae@gmail.com>
License: GNU GPLv2 (or later at your option)

PHP Syntax highlighter for MODx Revolution. 


Usage:
The plugin will search for <pre></pre> or <pre class="{my code nme (php, js, html, xml...)}"></pre> before the content being parsed and return the text highligted and escaped.

MODx Tags will be converted to their html entities as well.

However, for listed content like with getResources or Ditto, the content will not be highlighted since it was not retreived.
Therefore, there is an additional snippet which do basicallly the same thing as the Plugin but for parsed content.

Example with getResources [[+content]] placeholder:

[[!GeSHI? &highlight=`[[+content]]`]]

GeSHI Snippet is ouput filter ready, so you can also do it like that:

[[+content:GeSHI]] 

Note: GeSHI don't use the <code> tag.







680-1240
