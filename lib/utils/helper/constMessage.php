<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Dinh nghia text cua message
 *
 * @author ngoctv1
 */
class constMessage {
    //put your code here
    /**
     * @author ngoctv 
     * Ham thong bao khi nguoi dung nhap gia tri % khong hop le
     * @return type
     */
    public static function getMessegaPercentError(){
        $i18n = sfContext::getInstance()->getI18N();
        return $i18n->__('Giá trị phải năm trong khoảng [1,100].');
    }
    /**
     * @author ngoctv 
     * Ham thong bao khi nguoi dung nhap so nguyen duong nho hon hoac bang 0
     * @return type
     */
    public static function getMessegaIntegerError(){
        $i18n = sfContext::getInstance()->getI18N();
        return $i18n->__('Giá trị phải lớn hơn 1.');
    }
    /**
     * @author ngoctv
     * Ham thong bao khi nhap ngay ket thuc nho hon ngay bat dau
     * @return type
     */
     public static function getMessegaBeginEndDateError(){
        $i18n = sfContext::getInstance()->getI18N();
        return $i18n->__('Ngày kết thúc phải lớn hơn ngày bắt đầu.');
    }
    /**
     * @author ngoctv
     * Ham thong bao khi nhap ngay khuyen mai nho hon ngay ket thuc khuyen mai
     * @return type
     */
    public static function getMessegaPromotionEndDateError(){
        $i18n = sfContext::getInstance()->getI18N();
        return $i18n->__('Ngày hết khuyến mại phải lớn hơn ngày kết thúc đăng ký.');
    }
    
   public static function getNoResultText(){
        $i18n = sfContext::getInstance()->getI18N();
        return $i18n->__('Không có bản ghi nào dùng phù hợp.');
    }
}


