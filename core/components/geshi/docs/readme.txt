------------------------
Snippet & Plugin : GeSHI
------------------------

Version: 0.1 RC1
Since: October 22th, 2010
Author: lossendae
License: GNU GPLv2 (or later at your option)

PHP Syntax highlighter for MODx Revolution. 

Usage:

The plugin will search for <pre> or <pre class="{my code name (php, js, html, xml...)}"> tags before the content being parsed and return the text highlighted and escaped.
MODx Tags will be converted as well automatically.

However, for listing components like with getResources or Ditto, the content will not be highlighted since it was not retreived on the load document event (firing before any tags are parsed).
Therefore, there is an additional snippet helper.

Example with getResources(or Ditto) [[+content]] placeholder:

[[!GeSHI? &highlight=`[[+content]]`]]

The GeSHI Snippet is output filter ready, so you can also use it like the following example:

[[+content:GeSHI]] 

The defaut theme is zenburnesque inspired by zenburn theme.
There is 2 other theme supplied:
- geshi
- Rdark

To switch theme, go to MODx setting table and search for geshi.theme entry.

Note: GeSHI don't use the <code> tag

Discuss Ready