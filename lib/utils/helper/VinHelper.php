<?php

/**
 * Created by PhpStorm.
 * User: conghuyvn8x
 * Date: 3/11/2020
 * Time: 9:01 PM
 */
class VinHelper
{
    public static function getVinModel($key = false)
    {
        // ApartmentCategory, floorsCategory
        $arrModel = [
            'ApartmentCategory' => 'Căn hộ (Ví dụ: 1 P. Ngủ, 3 P. Ngủ ..)',
            'floorsCategory' => 'Tòa nhà (Ví dụ: L1, L2...)',
            'zoneCategory' => 'Khu nhà (Ví dụ: Hải âu, The park)',
            'subdivisionCategory' => 'Phân khu (Ví dụ: Cao tầng, thấp tầng, ..)',
        ];
        if ($key) {
            return isset($arrModel[$key]) ? $arrModel[$key] : '';
        }
        return $arrModel;
    }

    public static function getParentAparmentCat($parent = false, $vinModel = false)
    {
        $listCat = VinApartmentCateTable::getInstance()->getAllApartmentCat($parent, $vinModel);
        $arrCat = ['0' => 'Chọn danh mục cha'];
        if ($listCat) {
            foreach ($listCat as $cat) {
                $arrCat[$cat->id] = sprintf('%s - %s', $cat->name, VinHelper::getVinModel($cat->vin_model));
            }
        }
        return $arrCat;
    }

    public static function getParentAparmentType()
    {
        $listCat = VinApartmentTypeTable::getInstance()->getAllApartmentType();
        $arrCat = ['0' => 'Chọn danh mục'];
        if ($listCat) {
            foreach ($listCat as $cat) {
                $arrCat[$cat->id] = sprintf('%s', $cat->name_type);
            }
        }
        return $arrCat;
    }

    public static function getParentAparmentCatBase64($parent = false, $vinModel = false)
    {
        $listCat = VinApartmentCateTable::getInstance()->getAllApartmentCat($parent, $vinModel);
        $arrCat = ['0' => 'Chọn danh mục cha'];
        if ($listCat) {
            foreach ($listCat as $cat) {
                $catId = base64_encode(json_encode([
                    'id' => $cat->id,
                    'name' => $cat->name,
                ]));
                $arrCat[$catId] = sprintf('%s - %s', $cat->name, VinHelper::getVinModel($cat->vin_model));
            }
        }
        return $arrCat;
    }

    const doamin = 'admin.vinhanoi.com';

    public static function getImage($image, $prefix = false)
    {
        if (substr($image, 0, 4) == 'http') {
            return $image;
        }
        if ($prefix) {
            return sprintf('%s/%s/%s', sfConfig::get('app_url_media_file'), $prefix, $image);
        }
        return sprintf('%s/%s', sfConfig::get('app_url_media_file'), $image);
//        if (strlen($image) > strlen(str_replace(self::doamin, '', $image))) {
//            // anh upload tu sev
//            return $image;
//        }
//        return $image;
    }

    public static function getImageGroup($id = false)
    {
        // 1: 360, 2: walk, 3: thiet ke, 4: anh demo
        $arrGroup = [
            '1' => '360',
            '2' => 'Walk',
            '3' => 'Ảnh thiết kế',
            '4' => 'Ảnh demo',
        ];
        if ($id) return !empty($arrGroup[$id]) ? $arrGroup[$id] : '';
        return $arrGroup;
    }
}