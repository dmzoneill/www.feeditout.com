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

define('IN_COPPERMINE', true);
require('include/init.inc.php');
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);


$redirect = "index.php";
$message = <<< EOT
You are trying to access a file that has been removed from the coppermine package for security reasons (details can be read on the Coppermine support board announcement thread "<a href="http://coppermine-gallery.net/forum/index.php?topic=24217.0" rel="external" class="external">Remove relocate_server.php file from your website</a>").<br />
You are now being redirected to your gallery's start page.
EOT;
pageheader($lang_info, "<meta http-equiv=\"refresh\" content=\"120;url=$redirect\" />");
msg_box($lang_info, $message, $lang_continue, $redirect);
pagefooter();
ob_end_flush();
?>