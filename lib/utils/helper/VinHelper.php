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
            'subdivisionCategory' => 'Loại tòa nhà (Ví dụ: Cao tầng, thấp tầng, ..)',
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

    public static function getImage($image)
    {
        if (strlen($image) > strlen(str_replace(self::doamin, '', $image))) {
            // anh upload tu sev
            return $image;
        }
        return $image;
    }
}