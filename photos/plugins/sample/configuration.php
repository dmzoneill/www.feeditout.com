<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2006 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.10
  $Source$
  $Revision: 3275 $
  $Author: gaugau $
  $Date: 2006-09-03 12:10:47 +0200 (So, 03 Sep 2006) $
**********************************************/

$name='Sample Plugin';
$description='This is a sample plugin.';
$author='Coppermine Development Team';
$version='1.0';
/*
 * $extra_info is displayed with the title of a plugin that is NOT installed and
 * can be used to present extra information.  In this case I show a complex
 * example that forms a button the user can click.
 */
$extra_info = <<<EOT
    <table border="0" cellspacing="0" cellpadding="0"> 
    <tr>
        <td class="admin_menu"><a target="_blank" href="docs/index.htm#plugin" title="Plugin Documentation">Documentation</a></td>
    </tr>
    </table>
EOT;
/*
 * $install_info is displayed with the title of a plugin that IS installed and
 * can be used to present extra information. In this case I show a complex
 * example that forms a button the user can click.
 */
$install_info=<<<EOT
    <table border="0" cellspacing="0" cellpadding="0"> 
    <tr>
        <td class="admin_menu"><a target="_blank" href="http://coppermine-gallery.net/forum/index.php?board=53.0" title="Plugin Support">Support</a></td>
    </tr>
    </table>
EOT;
?>
