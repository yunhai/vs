<?php

/**
 * Project:     Securimage: A PHP class for creating and managing form CAPTCHA images<br />
 * File:        securimage_show.php<br />
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or any later version.<br /><br />
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.<br /><br />
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA<br /><br />
 *
 * Any modifications to the library should be indicated clearly in the source code
 * to inform users that the changes are not a part of the original software.<br /><br />
 *
 * If you found this script useful, please take a quick moment to rate it.<br />
 * http://www.hotscripts.com/rate/49400.html  Thanks.
 *
 * @link http://www.phpcaptcha.org Securimage PHP CAPTCHA
 * @link http://www.phpcaptcha.org/latest.zip Download Latest Version
 * @link http://www.phpcaptcha.org/Securimage_Docs/ Online Documentation
 * @copyright 2009 Drew Phillips
 * @author drew010 <drew@drew-phillips.com>
 * @version 2.0.1 BETA (December 6th, 2009)
 * @package Securimage
 *
 */

include 'securimage.php';

$img = new securimage();

// Change some settings
//
//$img->image_width = 150;
//$img->image_height = 35;
//$img->perturbation = 1; // 1.0 = high distortion, higher numbers = more distortion
////$img->image_bg_color = new Securimage_Color("#ffffff");
//$img->text_color = new Securimage_Color("#8B8B8B");
//$img->num_lines = 8;
////$img->use_transparent_text = true;
////$img->text_transparency_percentage = 40; // 100 = completely transparent
//$img->signature_color = new Securimage_Color(rand(0, 64), rand(64, 128), rand(128, 255));
////$img->image_type = SI_IMAGE_PNG;
////$img->text_color = new Securimage_Color("#000000");
//$img->line_color = new Securimage_Color("#ccc");
$img->image_width = 190;
$img->image_height = 60;
$img->perturbation = 0.5;
//$img->image_bg_color = new Securimage_Color("#f6f6f6");
$img->multi_text_color = array(new Securimage_Color("#3399ff"),
                               new Securimage_Color("#3300cc"),
                               new Securimage_Color("#3333cc"),
                               new Securimage_Color("#6666ff"),
                               new Securimage_Color("#99cccc"),
                               new Securimage_Color("#8B8B8B")
                               );
$img->use_multi_text = true;
$img->text_angle_minimum = -5;
$img->text_angle_maximum = 5;
$img->use_transparent_text = true;
$img->text_transparency_percentage = 30; // 100 = completely transparent
$img->num_lines = 7;
$img->line_color = new Securimage_Color("#eaeaea");
$img->image_signature = '';
$img->signature_color = new Securimage_Color(rand(0, 64), rand(64, 128), rand(128, 255));
$img->use_wordlist = true; 


$img->show(); // alternate use:  $img->show('/path/to/background_image.jpg');
