<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    if(isset($vtp_products)){
        echo  link_to('<img align="middle" style="width: 100px; height: 100px;" src="' . VtHelper::getUrlImagePathThumb(sfConfig::get('app_product_images'), $vtp_product_image->getFilePath()) . '"/>','vtp_product_image_edit',array('id'=>$vtp_product_image->getId(),'default_product_id'=>$vtp_products->getId()));
    }
    else{
        echo '<img align="middle" style="width: 100px; height: 100px;" src="' . VtHelper::getUrlImagePathThumb(sfConfig::get('app_product_images'), $vtp_product_image->getFilePath()) . 'width=100 height =100/>';
    }
?>
