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

/*

        Exifer

        Extracts EXIF information from digital photos.



        Copyright � 2003 Jake Olefsky

        http://www.offsky.com/software/exif/index.php

        jake@olefsky.com



        Please see exif.php for the complete information about this software.



        ------------



        This program is free software; you can redistribute it and/or modify it under the terms of

        the GNU General Public License as published by the Free Software Foundation; either version 2

        of the License, or (at your option) any later version.



        This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;

        without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

        See the GNU General Public License for more details. http://www.gnu.org/copyleft/gpl.html

*/


//=================

// Looks up the name of the tag for the MakerNote (Depends on Manufacturer)

//====================================================================

function lookup_Canon_tag($tag) {



        switch($tag) {

                case "0001": $tag = "Settings 1";break;

                case "0004": $tag = "Settings 4";break;

                case "0006": $tag = "ImageType";break;

                case "0007": $tag = "FirmwareVersion";break;

                case "0008": $tag = "ImageNumber";break;

                case "0009": $tag = "OwnerName";break;

                case "000c": $tag = "CameraSerialNumber";break;

                case "000f": $tag = "CustomFunctions";break;



                default: $tag = "unknown:".$tag;break;

        }



        return $tag;

}



//=================

// Formats Data for the data type

//====================================================================

function formatCanonData($type,$tag,$intel,$data,&$result) {

        $place = 0;





        if($type=="ASCII") {

                $result = $data;

        } else if($type=="URATIONAL" || $type=="SRATIONAL") {

                $data = bin2hex($data);

                if($intel==1) $data = intel2Moto($data);

                $top = hexdec(substr($data,8,8));

                $bottom = hexdec(substr($data,0,8));

                if($bottom!=0) $data=$top/$bottom;

                else if($top==0) $data = 0;

                else $data=$top."/".$bottom;



                if($tag=="0204") { //DigitalZoom

                        $data=$data."x";

                }



        } else if($type=="USHORT" || $type=="SSHORT" || $type=="ULONG" || $type=="SLONG" || $type=="FLOAT" || $type=="DOUBLE") {



                $data = bin2hex($data);

                $result['RAWDATA'] = $data;



                if($tag=="0001") { //first chunk

                        $result['Bytes']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//0

                        $result['Macro']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//1

                                if($result['Macro']==1) $result['Macro'] = "Macro";

                                if($result['Macro']==2) $result['Macro'] = "Normal";

                        $result['SelfTimer']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//2

                                if($result['SelfTimer']==0) $result['SelfTimer'] = "Off";

                        $result['Quality']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//3

                                if($result['Quality']==2) $result['Quality'] = "Normal";

                                if($result['Quality']==3) $result['Quality'] = "Fine";

                                if($result['Quality']==5) $result['Quality'] = "Superfine";

                        $result['Flash']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//4

                                if($result['Flash']==0) $result['Flash'] = "Off";

                                if($result['Flash']==1) $result['Flash'] = "Auto";

                                if($result['Flash']==2) $result['Flash'] = "On";

                                if($result['Flash']==3) $result['Flash'] = "Red Eye Reduction";

                                if($result['Flash']==4) $result['Flash'] = "Slow Synchro";

                                if($result['Flash']==5) $result['Flash'] = "Auto + Red Eye Reduction";

                                if($result['Flash']==6) $result['Flash'] = "On + Red Eye Reduction";

                                if($result['Flash']==16) $result['Flash'] = "External Flash";

                        $result['DriveMode']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//5

                                if($result['DriveMode']==0) $result['DriveMode'] = "Single/Timer";

                                if($result['DriveMode']==1) $result['DriveMode'] = "Continuous";

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//6

                        $result['FocusMode']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//7

                                if($result['FocusMode']==0) $result['FocusMode'] = "One-Shot";

                                if($result['FocusMode']==1) $result['FocusMode'] = "AI Servo";

                                if($result['FocusMode']==2) $result['FocusMode'] = "AI Focus";

                                if($result['FocusMode']==3) $result['FocusMode'] = "Manual Focus";

                                if($result['FocusMode']==4) $result['FocusMode'] = "Single";

                                if($result['FocusMode']==5) $result['FocusMode'] = "Continuous";

                                if($result['FocusMode']==6) $result['FocusMode'] = "Manual Focus";

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//8

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//9

                        $result['ImageSize']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//10

                                if($result['ImageSize']==0) $result['ImageSize'] = "Large";

                                if($result['ImageSize']==1) $result['ImageSize'] = "Medium";

                                if($result['ImageSize']==2) $result['ImageSize'] = "Small";

                        $result['EasyShooting']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//11

                                if($result['EasyShooting']==0) $result['EasyShooting'] = "Full Auto";

                                if($result['EasyShooting']==1) $result['EasyShooting'] = "Manual";

                                if($result['EasyShooting']==2) $result['EasyShooting'] = "Landscape";

                                if($result['EasyShooting']==3) $result['EasyShooting'] = "Fast Shutter";

                                if($result['EasyShooting']==4) $result['EasyShooting'] = "Slow Shutter";

                                if($result['EasyShooting']==5) $result['EasyShooting'] = "Night";

                                if($result['EasyShooting']==6) $result['EasyShooting'] = "Black & White";

                                if($result['EasyShooting']==7) $result['EasyShooting'] = "Sepia";

                                if($result['EasyShooting']==8) $result['EasyShooting'] = "Portrait";

                                if($result['EasyShooting']==9) $result['EasyShooting'] = "Sport";

                                if($result['EasyShooting']==10) $result['EasyShooting'] = "Macro/Close-Up";

                                if($result['EasyShooting']==11) $result['EasyShooting'] = "Pan Focus";

                        $result['DigitalZoom']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//12

                                if($result['DigitalZoom']==0) $result['DigitalZoom'] = "No Digital Zoom";

                        if($result['DigitalZoom']==1) $result['DigitalZoom'] = "2x";

                        if($result['DigitalZoom']==2) $result['DigitalZoom'] = "4x";

                                if($result['DigitalZoom']==65535) $result['DigitalZoom'] = "No Digital Zoom";

                        $result['Contrast']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//13

                                if($result['Contrast']==0) $result['Contrast'] = "Normal";

                                if($result['Contrast']==1) $result['Contrast'] = "High";

                                if($result['Contrast']==65535) $result['Contrast'] = "Low";

                        $result['Saturation']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//14

                                if($result['Saturation']==0) $result['Saturation'] = "Normal";

                                if($result['Saturation']==1) $result['Saturation'] = "High";

                                if($result['Saturation']==65535) $result['Saturation'] = "Low";

                        $result['Sharpness']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//15

                                if($result['Sharpness']==0) $result['Sharpness'] = "Normal";

                                if($result['Sharpness']==1) $result['Sharpness'] = "High";

                                if($result['Sharpness']==65535) $result['Sharpness'] = "Low";

                        $result['ISO']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//16

                                if($result['ISO']==15) $result['ISO'] = "Auto";

                                if($result['ISO']==16) $result['ISO'] = "50";

                                if($result['ISO']==17) $result['ISO'] = "100";

                                if($result['ISO']==18) $result['ISO'] = "200";

                                if($result['ISO']==19) $result['ISO'] = "400";

                        $result['MeteringMode']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//17

                                if($result['MeteringMode']==3) $result['MeteringMode'] = "Evaluative";

                                if($result['MeteringMode']==4) $result['MeteringMode'] = "Partial";

                                if($result['MeteringMode']==5) $result['MeteringMode'] = "Center-weighted";

                        $result['FocusType']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//18

                                if($result['FocusType']==0) $result['FocusType'] = "Manual";

                                if($result['FocusType']==1) $result['FocusType'] = "Auto";

                                if($result['FocusType']==3) $result['FocusType'] = "Close-up (Macro)";

                                if($result['FocusType']==8) $result['FocusType'] = "Locked (Pan Mode)";

                        $result['AFPointSelected']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//19

                                if($result['AFPointSelected']==12288) $result['AFPointSelected'] = "Manual Focus";

                                if($result['AFPointSelected']==12289) $result['AFPointSelected'] = "Auto Selected";

                                if($result['AFPointSelected']==12290) $result['AFPointSelected'] = "Right";

                                if($result['AFPointSelected']==12291) $result['AFPointSelected'] = "Center";

                                if($result['AFPointSelected']==12292) $result['AFPointSelected'] = "Left";

                        $result['ExposureMode']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//20

                                if($result['ExposureMode']==0) $result['ExposureMode'] = "EasyShoot";

                                if($result['ExposureMode']==1) $result['ExposureMode'] = "Program";

                                if($result['ExposureMode']==2) $result['ExposureMode'] = "Tv";

                                if($result['ExposureMode']==3) $result['ExposureMode'] = "Av";

                                if($result['ExposureMode']==4) $result['ExposureMode'] = "Manual";

                                if($result['ExposureMode']==5) $result['ExposureMode'] = "Auto-DEP";

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//21

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//22

                        $result['LongFocalLength']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//23

                        $result['ShortFocalLength']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//24

                        $result['FocalUnits']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//25

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//26

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//27

                        $result['FlashActivity']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//28

                                if($result['FlashActivity']==0) $result['FlashActivity'] = "Flash Did Not Fire";

                                if($result['FlashActivity']==1) $result['FlashActivity'] = "Flash Fired";

                        $result['FlashDetails']=str_pad(base_convert(intel2Moto(substr($data,$place,4)), 16, 2), 16, "0", STR_PAD_LEFT);$place+=4;//29

                                $flashDetails = array();

                                if (substr($result['FlashDetails'], 1, 1) == 1) { $flashDetails[] = 'External E-TTL'; }

                                if (substr($result['FlashDetails'], 2, 1) == 1) { $flashDetails[] = 'Internal Flash'; }

                                if (substr($result['FlashDetails'], 4, 1) == 1) { $flashDetails[] = 'FP sync used'; }

                                if (substr($result['FlashDetails'], 8, 1) == 1) { $flashDetails[] = '2nd("rear")-curtin sync used'; }

                                if (substr($result['FlashDetails'], 12, 1) == 1) { $flashDetails[] = '1st curtin sync'; }

                                $result['FlashDetails']=implode(",", $flashDetails);

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//30

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//31

                        $result['FocusMode']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//32



                } else if($tag=="0004") { //second chunk

                        $result['Bytes']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//0

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//1

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//2

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//3

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//4

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//5

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//6

                        $result['WhiteBalance']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//7

                                if($result['WhiteBalance']==0) $result['WhiteBalance'] = "Auto";

                                if($result['WhiteBalance']==1) $result['WhiteBalance'] = "Sunny";

                                if($result['WhiteBalance']==2) $result['WhiteBalance'] = "Cloudy";

                                if($result['WhiteBalance']==3) $result['WhiteBalance'] = "Tungsten";

                                if($result['WhiteBalance']==4) $result['WhiteBalance'] = "Flourescent";

                                if($result['WhiteBalance']==5) $result['WhiteBalance'] = "Flash";

                                if($result['WhiteBalance']==6) $result['WhiteBalance'] = "Custom";

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//8

                        $result['SequenceNumber']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//9

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//10

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//11

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//12

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//13

                        $result['AFPointUsed']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//14

                        $result['FlashBias']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//15

                                $result['FlashBias'].="EV";//15

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//16

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//17

                        $result['Unknown']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//18

                        $result['SubjectDistance']=hexdec(intel2Moto(substr($data,$place,4)));$place+=4;//19



                } else if($tag=="0008") { //image number

                        if($intel==1) $data = intel2Moto($data);

                        $data=hexdec($data);

                        $result = round($data/1000)."-".$data%1000;

                } else if($tag=="000c") { //camera serial number

                        if($intel==1) $data = intel2Moto($data);

                        $data=hexdec($data);

                        $result = "#".bin2hex(substr($data,0,16)).substr($data,16,16);

                }



        } else if($type=="UNDEFINED") {







        } else {

                $data = bin2hex($data);

                if($intel==1) $data = intel2Moto($data);

        }



        return $data;

}







//=================

// Cannon Special data section

// Useful:  http://www.burren.cx/david/canon.html

// http://www.burren.cx/david/canon.html

// http://www.ozhiker.com/electronics/pjmt/jpeg_info/canon_mn.html

//====================================================================

function parseCanon($block,&$result,$seek, $globalOffset) {

        $place = 0; //current place



        if($result['Endien']=="Intel") $intel=1;

        else $intel=0;



        $model = $result['IFD0']['Model'];



                //Get number of tags (2 bytes)

        $num = bin2hex(substr($block,$place,2));$place+=2;

        if($intel==1) $num = intel2Moto($num);

        $result['SubIFD']['MakerNote']['MakerNoteNumTags'] = hexdec($num);



        //loop thru all tags  Each field is 12 bytes

        for($i=0;$i<hexdec($num);$i++) {



                        //2 byte tag

                $tag = bin2hex(substr($block,$place,2));$place+=2;

                if($intel==1) $tag = intel2Moto($tag);

                $tag_name = lookup_Canon_tag($tag);



                        //2 byte type

                $type = bin2hex(substr($block,$place,2));$place+=2;

                if($intel==1) $type = intel2Moto($type);

                lookup_type($type,$size);



                        //4 byte count of number of data units

                $count = bin2hex(substr($block,$place,4));$place+=4;

                if($intel==1) $count = intel2Moto($count);

                $bytesofdata = $size*hexdec($count);



                if($bytesofdata<=0) {

                        return; //if this value is 0 or less then we have read all the tags we can

                }



                        //4 byte value of data or pointer to data

                $value = substr($block,$place,4);$place+=4;



                if($bytesofdata<=4) {

                        $data = $value;

                } else {

                        $value = bin2hex($value);

                        if($intel==1) $value = intel2Moto($value);

                        $v = fseek($seek,$globalOffset+hexdec($value));  //offsets are from TIFF header which is 12 bytes from the start of the file

                        if($v==0) {

                                $data = fread($seek, $bytesofdata);

                        } else if($v==-1) {

                                $result['Errors'] = $result['Errors']++;

                        }

                }

                $formated_data = formatCanonData($type,$tag,$intel,$data,$result['SubIFD']['MakerNote'][$tag_name]);



                if($result['VerboseOutput']==1) {

                        //$result['SubIFD']['MakerNote'][$tag_name] = $formated_data;

                        if($type=="URATIONAL" || $type=="SRATIONAL" || $type=="USHORT" || $type=="SSHORT" || $type=="ULONG" || $type=="SLONG" || $type=="FLOAT" || $type=="DOUBLE") {

                                $data = bin2hex($data);

                                if($intel==1) $data = intel2Moto($data);

                        }

                        $result['SubIFD']['MakerNote'][$tag_name."_Verbose"]['RawData'] = $data;

                        $result['SubIFD']['MakerNote'][$tag_name."_Verbose"]['Type'] = $type;

                        $result['SubIFD']['MakerNote'][$tag_name."_Verbose"]['Bytes'] = $bytesofdata;

                } else {

                        //$result['SubIFD']['MakerNote'][$tag_name] = $formated_data;

                }

        }

}





?>