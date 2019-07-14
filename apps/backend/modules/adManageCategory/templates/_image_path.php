<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//echo '<img width ="70" height = "68"  src="' . sfConfig::get('app_url_media_file') . sfConfig::get('app_category_images'). $vtp_category->getImagePath() . '"/>'
  echo '<img align="middle" src="' . VtHelper::getUrlImagePathThumb(sfConfig::get('app_category_images'), $vtp_category->getImagePath()) . '"/>';
?>
