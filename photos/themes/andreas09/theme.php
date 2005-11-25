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
  Coppermine version: 1.4.4
  $Source:
  $Revision:
  $Author:
  $Date:
**********************************************/

/*
Ported to Coppermine Photo Gallery by Billy Bullock - Oct. 2, 2006 : Last Update - Oct. 7, 2006
Porter URL: http://www.billygbullock.com
Coppermine Theme Version: 1.1
*/

define('THEME_HAS_RATING_GRAPHICS', 1);
define('THEME_HAS_NAVBAR_GRAPHICS', 1);
define('THEME_HAS_FILM_STRIP_GRAPHIC', 1);
define('THEME_IS_XHTML10_TRANSITIONAL',1); // Remove this if you edit this template until
                                           // you have validated it. See docs/theme.htm.
define('THEME_HAS_NO_SUB_MENU_BUTTONS', 1);

$CONFIG['max_film_strip_items'] = 4; //overrides the number of thumbnails set in the admin configuration
$CONFIG['thumbcols'] = 4; //overrides the number of columns for thumbnails set in the admin configuration


// HTML template for sys menu
$template_sys_menu = <<<EOT
                                        <ul class="level1">

<!-- BEGIN home -->
                                                <li><a href="{HOME_TGT}" title="{HOME_TITLE}">{HOME_LNK}</a></li>
<!-- END home -->
<!-- BEGIN my_gallery -->
                                                <li><a href="{MY_GAL_TGT}" title="{MY_GAL_TITLE}">{MY_GAL_LNK}</a></li>
<!-- END my_gallery -->
<!-- BEGIN allow_memberlist -->
                                                <li><a href="{MEMBERLIST_TGT}" title="{MEMBERLIST_TITLE}">{MEMBERLIST_LNK}</a></li>
<!-- END allow_memberlist -->
<!-- BEGIN my_profile -->
                                                <li><a href="{MY_PROF_TGT}" title="{MY_PROF_LNK}">{MY_PROF_LNK}</a></li>
<!-- END my_profile -->
<!-- BEGIN faq -->
                                                <li><a href="{FAQ_TGT}" title="{FAQ_TITLE}">{FAQ_LNK}</a></li>
<!-- END faq -->
<!-- BEGIN enter_admin_mode -->
                                                <li><a href="{ADM_MODE_TGT}" title="{ADM_MODE_TITLE}">{ADM_MODE_LNK}</a></li>
<!-- END enter_admin_mode -->
<!-- BEGIN leave_admin_mode -->
                                                <li><a href="{USR_MODE_TGT}" title="{USR_MODE_TITLE}">{USR_MODE_LNK}</a></li>
<!-- END leave_admin_mode -->
<!-- BEGIN upload_pic -->
                                                <li><a href="{UPL_PIC_TGT}" title="{UPL_PIC_TITLE}">{UPL_PIC_LNK}</a></li>
<!-- END upload_pic -->
<!-- BEGIN register -->
                                                <li><a href="{REGISTER_TGT}" title="{REGISTER_TITLE}">{REGISTER_LNK}</a></li>
<!-- END register -->
<!-- BEGIN login -->
                                                <li><a href="{LOGIN_TGT}" title="{LOGIN_LNK}">{LOGIN_LNK}</a></li>
<!-- END login -->
<!-- BEGIN logout -->
                                                <li><a href="{LOGOUT_TGT}" title="{LOGOUT_LNK}">{LOGOUT_LNK}</a></li>
<!-- END logout -->
                                        </ul>

EOT;


// HTML template for sub menu
$template_sub_menu = <<<EOT
                                        <ul>
<!-- BEGIN custom_link -->
                                            <li><a href="{CUSTOM_LNK_TGT}" title="{CUSTOM_LNK_TITLE}">{CUSTOM_LNK_LNK}</a></li>
<!-- END custom_link -->
<!-- BEGIN album_list -->
                                            <li><a href="{ALB_LIST_TGT}" title="{ALB_LIST_TITLE}">{ALB_LIST_LNK}</a></li>
<!-- END album_list -->
                                            <li><a href="{LASTUP_TGT}" title="{LASTUP_LNK}">{LASTUP_LNK}</a></li>
                                            <li><a href="{LASTCOM_TGT}" title="{LASTCOM_LNK}">{LASTCOM_LNK}</a></li>
                                            <li><a href="{TOPN_TGT}" title="{TOPN_LNK}">{TOPN_LNK}</a></li>
                                            <li><a href="{TOPRATED_TGT}" title="{TOPRATED_LNK}">{TOPRATED_LNK}</a></li>
                                            <li><a href="{FAV_TGT}" title="{FAV_LNK}">{FAV_LNK}</a></li>
                                            <li><a href="{SEARCH_TGT}" title="{SEARCH_LNK}">{SEARCH_LNK}</a></li>
                                        </ul>

EOT;

// HTML template for gallery admin menu
$template_gallery_admin_menu = <<<EOT

                            <ul class="level1">
<!-- BEGIN admin_approval -->
                                <li><a href="editpics.php?mode=upload_approval" title="{UPL_APP_TITLE}">{UPL_APP_LNK}</a></li>
<!-- END admin_approval -->
                                <li><a href="admin.php" title="{ADMIN_TITLE}">{ADMIN_LNK}</a></li>
                                <li><a href="catmgr.php" title="{CATEGORIES_TITLE}">{CATEGORIES_LNK}</a></li>
                                <li><a href="albmgr.php{CATL}" title="{ALBUMS_TITLE}">{ALBUMS_LNK}</a></li>
                                <li><a href="groupmgr.php" title="{GROUPS_TITLE}">{GROUPS_LNK}</a></li>
                                <li><a href="usermgr.php" title="{USERS_TITLE}">{USERS_LNK}</a></li>
                                <li><a href="banning.php" title="{BAN_TITLE}">{BAN_LNK}</a></li>
                                <li><a href="reviewcom.php" title="{COMMENTS_TITLE}">{COMMENTS_LNK}</a></li>
<!-- BEGIN log_ecards -->
                                <li><a href="db_ecard.php" title="{DB_ECARD_TITLE}">{DB_ECARD_LNK}</a></li>
<!-- END log_ecards -->
                            </ul>
                            <ul class="level1">
                                <li><a href="picmgr.php" title="{PICTURES_TITLE}">{PICTURES_LNK}</a></li>
                                <li><a href="searchnew.php" title="{SEARCHNEW_TITLE}">{SEARCHNEW_LNK}</a></li>
                                <li><a href="util.php" title="{UTIL_TITLE}">{UTIL_LNK}</a></li>
                                <li><a href="profile.php?op=edit_profile" title="{MY_PROF_TITLE}">{MY_PROF_LNK}</a></li>
<!-- BEGIN documentation -->
                                <li><a href="{DOCUMENTATION_HREF}" title="{DOCUMENTATION_TITLE}" target="cpg_documentation">{DOCUMENTATION_LNK}</a></li>
<!-- END documentation -->
                            </ul>
EOT;

// HTML template for user admin menu
$template_user_admin_menu = <<<EOT

                        <ul>
                                <li><a href="albmgr.php" title="{ALBMGR_TITLE}" class="navmenu">{ALBMGR_LNK}</a></li>
                                <li><a href="modifyalb.php" title="{MODIFYALB_TITLE}" class="navmenu">{MODIFYALB_LNK}</a></li>
                                <li><a href="profile.php?op=edit_profile" title="{MY_PROF_TITLE}" class="navmenu">{MY_PROF_LNK}</a></li>
                                <li><a href="picmgr.php" title="{PICTURES_TITLE}" class="navmenu">{PICTURES_LNK}</a></li>
                        </ul>

EOT;

// HTML template for title row of the thumbnail view (album title + sort options)
$template_thumb_view_title_row = <<<EOT

                        <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                                <td width="100%" class="statlink"><h2>{ALBUM_NAME}</h2></td>
                        </tr>
                        </table>

EOT;


// HTML template for the image rating box
$template_image_rating = <<<EOT
<table align="center" width="{WIDTH}" cellspacing="1" cellpadding="0" class="maintable">
        <tr>
                <td colspan="6" class="tableh2_compact"><b>{TITLE}</b> {VOTES}</td>
        </tr>
        <tr>
                <td class="tableb_compact" width="17%" align="center"><a href="{RATE0}" title="{RUBBISH}" rel="nofollow">RUBBISH<br /></a></td>
                <td class="tableb_compact" width="17%" align="center"><a href="{RATE1}" title="{POOR}" rel="nofollow">POOR<br /></a></td>
                <td class="tableb_compact" width="17%" align="center"><a href="{RATE2}" title="{FAIR}" rel="nofollow">FAIR<br /></a></td>
                <td class="tableb_compact" width="17%" align="center"><a href="{RATE3}" title="{GOOD}" rel="nofollow">GOOD<br /></a></td>
                <td class="tableb_compact" width="17%" align="center"><a href="{RATE4}" title="{EXCELLENT}" rel="nofollow">EXCELLENT<br /></a></td>
                <td class="tableb_compact" width="17%" align="center"><a href="{RATE5}" title="{GREAT}" rel="nofollow">GREAT<br /></a></td>
        </tr>
</table>
EOT;

function theme_html_picinfo(&$info)
{
    global $lang_picinfo;

    $html = '';

    $html .= "        <tr><td colspan=\"2\" class=\"tableh2_compact\"><b>{$lang_picinfo['title']}</b></td></tr>\n";
    $template = "        <tr><td class=\"tableb_compact\" valign=\"top\" >%s:</td><td class=\"tableb_compact\">%s</td></tr>\n";
    foreach ($info as $key => $value) $html .= sprintf($template, $key, $value);

    return $html;
}

/* Image scaled version
* Uses new function: compute_img_size_max() to set max intermediate image size for narrow themes
*/

function theme_html_picture()
{
    global $CONFIG, $CURRENT_PIC_DATA, $CURRENT_ALBUM_DATA, $USER;
    global $album, $comment_date_fmt, $template_display_media;
    global $lang_display_image_php, $lang_picinfo;

    $pid = $CURRENT_PIC_DATA['pid'];
    $pic_title = '';

    if (!isset($USER['liv']) || !is_array($USER['liv'])) {
        $USER['liv'] = array();
    }
    // Add 1 to hit counter
    if (!USER_IS_ADMIN && !in_array($pid, $USER['liv']) && isset($_COOKIE[$CONFIG['cookie_name'] . '_data'])) {
        add_hit($pid);
        if (count($USER['liv']) > 4) array_shift($USER['liv']);
        array_push($USER['liv'], $pid);
    }

    if($CURRENT_PIC_DATA['pwidth'] > $CONFIG['picture_width']){
      $condition = true;
    }else{
     $condition = false;
    }

    if ($CURRENT_PIC_DATA['title'] != '') {
        $pic_title .= $CURRENT_PIC_DATA['title'] . "\n";
    }
    if ($CURRENT_PIC_DATA['caption'] != '') {
        $pic_title .= $CURRENT_PIC_DATA['caption'] . "\n";
    }
    if ($CURRENT_PIC_DATA['keywords'] != '') {
        $pic_title .= $lang_picinfo['Keywords'] . ": " . $CURRENT_PIC_DATA['keywords'];
    }

    if (!$CURRENT_PIC_DATA['title'] && !$CURRENT_PIC_DATA['caption']) {
        template_extract_block($template_display_media, 'img_desc');
    } else {
        if (!$CURRENT_PIC_DATA['title']) {
            template_extract_block($template_display_media, 'title');
        }
        if (!$CURRENT_PIC_DATA['caption']) {
            template_extract_block($template_display_media, 'caption');
        }
    }

    $CURRENT_PIC_DATA['menu'] = html_picture_menu(); //((USER_ADMIN_MODE && $CURRENT_ALBUM_DATA['category'] == FIRST_USER_CAT + USER_ID) || ($CONFIG['users_can_edit_pics'] && $CURRENT_PIC_DATA['owner_id'] == USER_ID && USER_ID != 0) || GALLERY_ADMIN_MODE) ? html_picture_menu($pid) : '';

    if ($CONFIG['make_intermediate'] && $condition ) {
        $picture_url = get_pic_url($CURRENT_PIC_DATA, 'normal');
    } else {
        $picture_url = get_pic_url($CURRENT_PIC_DATA, 'fullsize');
    }

    $image_size = compute_img_size_max($CURRENT_PIC_DATA['pwidth'], $CURRENT_PIC_DATA['pheight']);

    $pic_title = '';
    $mime_content = cpg_get_type($CURRENT_PIC_DATA['filename']);


    if ($mime_content['content']=='movie' || $mime_content['content']=='audio') {

        if ($CURRENT_PIC_DATA['pwidth']==0 || $CURRENT_PIC_DATA['pheight']==0) {
            $CURRENT_PIC_DATA['pwidth']  = 320; // Default width

            // Set default height; if file is a movie
            if ($mime_content['content']=='movie') {
                $CURRENT_PIC_DATA['pheight'] = 240; // Default height
            }
        }

        $ctrl_offset['mov']=15;
        $ctrl_offset['wmv']=45;
        $ctrl_offset['swf']=0;
        $ctrl_offset['rm']=0;
        $ctrl_offset_default=45;
        $ctrl_height = (isset($ctrl_offset[$mime_content['extension']]))?($ctrl_offset[$mime_content['extension']]):$ctrl_offset_default;
        $image_size['whole']='width="'.$CURRENT_PIC_DATA['pwidth'].'" height="'.($CURRENT_PIC_DATA['pheight']+$ctrl_height).'"';
    }

    if ($mime_content['content']=='image') {
        if (isset($image_size['reduced'])) {
            $winsizeX = $CURRENT_PIC_DATA['pwidth']+5;  //the +'s are the mysterious FF and IE paddings
            $winsizeY = $CURRENT_PIC_DATA['pheight']+3; //the +'s are the mysterious FF and IE paddings
            $pic_html = "<a href=\"javascript:;\" onclick=\"MM_openBrWindow('displayimage.php?pid=$pid&amp;fullsize=1','" . uniqid(rand()) . "','scrollbars=yes,toolbar=no,status=no,resizable=yes,width=$winsizeX,height=$winsizeY')\">";
            $pic_title = $lang_display_image_php['view_fs'] . "\n==============\n" . $pic_title;
            $pic_html .= "<img src=\"" . $picture_url . "\" {$image_size['geom']} class=\"intermed_image\" border=\"0\" alt=\"{$lang_display_image_php['view_fs']}\" /><br />";
            $pic_html .= "</a>\n";
        } else {
            $pic_html = "<img src=\"" . $picture_url . "\" {$image_size['geom']} class=\"intermed_image\" border=\"0\" alt=\"\" /><br />\n";
        }
    } elseif ($mime_content['content']=='document') {
        $pic_thumb_url = get_pic_url($CURRENT_PIC_DATA,'thumb');
        $pic_html = "<a href=\"{$picture_url}\" target=\"_blank\" class=\"document_link\"><img src=\"".$pic_thumb_url."\" border=\"0\" class=\"intermed_image\" /></a>\n<br />";
    } else {
        $autostart = ($CONFIG['media_autostart']) ? ('true'):('false');

        $players['WMP'] = array('id' => 'MediaPlayer',
                                'clsid' => 'classid="" ',
                                'codebase' => 'codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701" ',
                                'mime' => 'type="application/x-mplayer2" ',
                               );
        $players['RMP'] = array('id' => 'RealPlayer',
                                'clsid' => 'classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" ',
                                'codebase' => '',
                                'mime' => 'type="audio/x-pn-realaudio-plugin" '
                               );
        $players['QT']  = array('id' => 'QuickTime',
                                'clsid' => 'classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" ',
                                'codebase' => 'codebase="http://www.apple.com/qtactivex/qtplugin.cab" ',
                                'mime' => 'type="video/x-quicktime" '
                               );
        $players['SWF'] = array('id' => 'SWFlash',
                                'clsid' => ' classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ',
                                'codebase' => 'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" ',
                                'mime' => 'type="application/x-shockwave-flash" '
                               );
        $players['UNK'] = array('id' => 'DefaultPlayer',
                                'clsid' => '',
                                'codebase' => '',
                                'mime' => ''
                               );

        if (isset($_COOKIE[$CONFIG['cookie_name'].'_'.$mime_content['extension'].'player'])) {
            $user_player = $_COOKIE[$CONFIG['cookie_name'].'_'.$mime_content['extension'].'player'];
        } else {
            $user_player = $mime_content['player'];
        }

                // There isn't a player selected or user wants client-side control
        if (!$user_player) {
            $user_player = 'UNK';
        }

        $player = $players[$user_player];

        $pic_html  = '<object id="'.$player['id'].'" '.$player['clsid'].$player['codebase'].$player['mime'].$image_size['whole'].'>';
        $pic_html .= "<param name=\"autostart\" value=\"$autostart\" /><param name=\"src\" value=\"". $picture_url . "\" />";
        $pic_html .= '<embed '.$image_size['whole'].' src="'. $picture_url . '" autostart="'.$autostart.'" '.$player['mime'].'></embed>';
        $pic_html .= "</object><br />\n";
    }

    $CURRENT_PIC_DATA['html'] = $pic_html;
    $CURRENT_PIC_DATA['header'] = '';
    $CURRENT_PIC_DATA['footer'] = '';

    $CURRENT_PIC_DATA = CPGPluginAPI::filter('file_data',$CURRENT_PIC_DATA);

    $params = array('{CELL_HEIGHT}' => '100',
        '{IMAGE}' => $CURRENT_PIC_DATA['header'].$CURRENT_PIC_DATA['html'].$CURRENT_PIC_DATA['footer'],
        '{ADMIN_MENU}' => $CURRENT_PIC_DATA['menu'],
        '{TITLE}' => bb_decode($CURRENT_PIC_DATA['title']),
        '{CAPTION}' => bb_decode($CURRENT_PIC_DATA['caption']),
        );

    return template_eval($template_display_media, $params);
}

function compute_img_size_max($width, $height)
{
         global $CONFIG;
        $thumb_use=$CONFIG['thumb_use'];
        $max = 420;
        if($thumb_use=='ht') {
          $ratio = $height / $max;
        } elseif($thumb_use=='wd') {
          $ratio = $width / $max;
        } else {
          $ratio = max($width, $height) / $max;
        }
        if ($ratio > 1.0) {
                $image_size['reduced'] = true;
        }
        $ratio = max($ratio, 1.0);
        $image_size['width'] = ceil($width / $ratio);
        $image_size['height'] = ceil($height / $ratio);
        $image_size['whole'] = 'width="'.$image_size['width'].'" height="'.$image_size['height'].'"';
        if($thumb_use=='ht') {
          $image_size['geom'] = ' height="'.$image_size['height'].'"';
        } elseif($thumb_use=='wd') {
          $image_size['geom'] = 'width="'.$image_size['width'].'"';
        } else {
          $image_size['geom'] = 'width="'.$image_size['width'].'" height="'.$image_size['height'].'"';
        }



        return $image_size;
}

?>