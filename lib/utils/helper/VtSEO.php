<?php
/**
Muc dich cua class:
-  Tao ra cac ham SEO ung voi cac trang rieng biet chung
-  Tao ra cac function de tao cac SEO Keyword, SEO Description , ...
-  Quan ly ro rang...
 */
class VtSEO
{

    /**
     * Mo ta: Seo trang chu
     * @return array
     */
    public static function getSeoHomepage(){
        $listAllConfig = AdConfigTable::getAllConfig();
        $listConfig = array();
        if($listAllConfig){
            foreach ($listAllConfig as $val){
                $listConfig[$val['config_key']] = $val['config_val'];
            }
        }
        $meta = array();
        $meta['title'] = !empty($listConfig['fb_title'])?$listConfig['fb_title']:'';
        $meta['description'] = !empty($listConfig['fb_description'])?$listConfig['fb_description']:'';
        $meta['keywords'] = !empty($listConfig['fb_keywords'])?$listConfig['fb_keywords']:'';
        $meta['og_image'] = !empty($listConfig['fb_imgage'])?$listConfig['fb_imgage']:'';
        $meta['og:image'] = !empty($listConfig['fb_imgage'])?$listConfig['fb_imgage']:'';
        $meta['og_url'] = !empty($listConfig['fb_url'])?$listConfig['fb_url']:'';
        $meta['og_description'] = !empty($listConfig['fb_description'])?$listConfig['fb_description']:'';
        $meta['og_title'] = !empty($listConfig['fb_title'])?$listConfig['fb_title']:'';
        $meta['og_site_name'] =!empty($listConfig['fb_site_name'])?$listConfig['fb_site_name']:'';
        $meta['dc_title'] = !empty($listConfig['fb_title'])?$listConfig['fb_title']:'';
        $meta['dc_keywords'] = !empty($listConfig['fb_keywords'])?$listConfig['fb_keywords']:'';
        $meta['news_keywords'] = !empty($listConfig['fb_keywords'])?$listConfig['fb_keywords']:'';
        return $meta;
    }

    public static function getSeoDetailMassage($massage){
        $listAllConfig = AdConfigTable::getAllConfig();
        $listConfig = array();
        if($listAllConfig){
            foreach ($listAllConfig as $val){
                $listConfig[$val['config_key']] = $val['config_val'];
            }
        }
//        $seoOgImage = $listConfig['domain'].sfConfig::get('app_article_images'), $massage['image'];
        $seoOgImage = $listConfig['domain'].'/uploads/' . sfConfig::get('app_article_images').'/'. $massage['image'];
        $meta = array();
        $meta['title'] = !empty($massage['name'])?$massage['name']:'';
        $meta['description'] = !empty($massage['description'])?$massage['description']:'';
        $meta['keywords'] = !empty($listConfig['fb_keywords'])?$listConfig['fb_keywords']:'';
        $meta['og_image'] = $seoOgImage;
        $meta['og:image'] = $seoOgImage;
        $meta['og_url'] = $listConfig['domain'].'/chi-tiet/'.$massage['slug'];
        $meta['og_description'] = !empty($massage['description'])?$massage['description']:'';
        $meta['og_title'] = !empty($massage['name'])?$massage['name']:'';
        $meta['og_site_name'] =!empty($listConfig['fb_site_name'])?$listConfig['fb_site_name']:'';
        $meta['dc_title'] = !empty($massage['name'])?$massage['name']:'';
        $meta['dc_keywords'] = !empty($listConfig['fb_keywords'])?$listConfig['fb_keywords']:'';
        $meta['news_keywords'] = !empty($listConfig['fb_keywords'])?$listConfig['fb_keywords']:'';
        return $meta;
    }

    //seo trang chuyen muc tin tuc
    public static function getSeoCategory($category){
        $meta = array();
        if($category->name){
            $seo_title = htmlspecialchars($category->name);
        }
        else{
            $seo_title = VtHelper::truncate(sfConfig::get('app_seo_title'),90,'...');
        }
        $meta['title'] = $seo_title;
        if($category->meta){
            $seo_description = htmlspecialchars($category->meta);
        }
        else{
            $seo_description = VtHelper::truncate(sfConfig::get('app_seo_description'),160,'...');
        }
        $meta['description'] = $seo_description;
        if($category->keywords){
            $seo_keywords = htmlspecialchars($category->keywords);
        }
        else{
            $seo_keywords = VtSEO::getPlainText(sfConfig::get('app_seo_keywords'),160);
        }
        $meta['keywords'] = $seo_keywords;
        if($category->image_path){
            $path = '/uploads/' . sfConfig::get('app_category_images') . $category->image_path;
            $meta['og_image'] = sfConfig::get('app_domain').VtHelper::getThumbUrl($path, 200, 200, 'article_default');
        }
        else{
            $meta['og_image'] = sfConfig::get('app_seo_ogImage');
        }

        $meta['og_url'] =sfConfig::get('app_domain').'/tin-tuc/'.$category->slug;
        $meta['og_description'] = $seo_description;
        $meta['og_title'] = $seo_title;
        $meta['og_site_name'] = $seo_title;
        $meta['dc_title'] = $seo_title;
        $meta['dc_keywords'] = $seo_keywords;
        $meta['news_keywords'] = $seo_keywords;
        return $meta;
    }

    //seo trang chi tiet tin tuc
    public static function getSeoArticle($article){
        $meta = array();
        if($article->title){
            $seo_title = htmlspecialchars($article->title);
        }
        else{
            $seo_title = VtHelper::truncate(sfConfig::get('app_seo_title'),150,'...');
        }
        $meta['title'] = $seo_title;
        if($article->meta){
            $seo_description = htmlspecialchars($article->meta);
        }
        else{
            $seo_description = VtHelper::truncate(sfConfig::get('app_seo_description'),250,'...');
        }
        $meta['description'] = $seo_description;
        if($article->keywords){
            $seo_keywords = htmlspecialchars($article->keywords);
        }
        else{
            $seo_keywords = VtSEO::getPlainText(sfConfig::get('app_seo_keywords'),250);
        }
        $meta['keywords'] = $seo_keywords;
        if($article->image_path){
            $path = '/uploads/' . sfConfig::get('app_article_images') . $article->image_path;
            $seoOgImage = sfConfig::get('app_domain').VtHelper::getThumbUrl($path, 200, 200, 'article_default');
        }
        else{
            $seoOgImage = sfConfig::get('app_seo_ogImage');
        }

        $meta['og_url'] =sfConfig::get('app_domain').'/chi-tiet-tin-tuc/'.$article->slug;
        $meta['og_description'] = $seo_description;
        $meta['og_title'] = $seo_title;
        $meta['og_image'] = $seoOgImage;
        $meta['og:image'] = $seoOgImage;
        $meta['og_site_name'] = $seo_title;
        $meta['dc_title'] = $seo_title;
        $meta['dc_keywords'] = $seo_keywords;
        $meta['news_keywords'] = $seo_keywords;
        return $meta;
    }


    //seo trang dien thoai thiet bi
    public static function getSeoProductCategory($object){
        $meta = array();
        if($object->name){
            $seo_title = htmlspecialchars($object->name);
        }
        else{
            $seo_title = VtHelper::truncate(sfConfig::get('app_seo_title'),90,'...');
        }
        $meta['title'] = $seo_title;
        if($object->meta){
            $seo_description = htmlspecialchars($object->meta);
        }
        else{
            $seo_description = VtSEO::getPlainText(sfConfig::get('app_seo_description'),160);
        }
        $meta['description'] = $seo_description;
        if($object->keywords){
            $seo_keywords = htmlspecialchars($object->keywords);
        }
        else{
            $seo_keywords = VtHelper::truncate(sfConfig::get('app_seo_keywords'),160,'...');
        }
        $meta['keywords'] = $seo_keywords;
        if($object->image_path){
            $path = '/uploads/' . sfConfig::get('app_category_images') . $object->image_path;
            $meta['og_image'] = sfConfig::get('app_domain').VtHelper::getThumbUrl($path, 200, 200, 'article_default');
        }
        else{
            $meta['og_image'] = sfConfig::get('app_seo_ogImage');
        }

        $meta['og_url'] =sfConfig::get('app_domain').'/danh-sach-sam-pham/'.$object->slug;
        $meta['og_description'] = $seo_description;
        $meta['og_title'] = $seo_title;
        $meta['og_site_name'] = $seo_title;
        $meta['dc_title'] = $seo_title;
        $meta['dc_keywords'] = $seo_keywords;
        $meta['news_keywords'] = $seo_keywords;
        return $meta;
    }

    //seo trang chi tiet dien thoai thiet bi
    public static function getSeoProductDetail($object){
        $meta = array();
        if($object->product_name){
            $seo_title = htmlspecialchars($object->product_name);
        }
        else{
            $seo_title = VtSEO::getPlainText(sfConfig::get('app_seo_title'),90);
        }
        $meta['title'] = $seo_title;
        if($object->meta){
            $seo_description = htmlspecialchars($object->meta);
        }
        else{
            $seo_description = VtSEO::getPlainText(sfConfig::get('app_seo_description'),160);
        }
        $meta['description'] = $seo_description;
        if($object->keywords){
            $seo_keywords = htmlspecialchars($object->keywords);
        }
        else{
            $seo_keywords = VtSEO::getPlainText(sfConfig::get('app_seo_keywords'),160);
        }
        $meta['keywords'] = $seo_keywords;
        if($object->image_path){
            $path = '/uploads/' . sfConfig::get('app_product_images') . $object->image_path;
            $meta['og_image'] = sfConfig::get('app_domain').VtHelper::getThumbUrl($path, 200, 200, 'article_default');
        }
        else{
            $meta['og_image'] = sfConfig::get('app_seo_ogImage');
        }

        $meta['og_url'] =sfConfig::get('app_domain').'/danh-sach-sam-pham/'.$object->slug;
        $meta['og_description'] = $seo_description;
        $meta['og_title'] = $seo_title;
        $meta['og_site_name'] = $seo_title;
        $meta['dc_title'] = $seo_title;
        $meta['dc_keywords'] = $seo_keywords;
        $meta['news_keywords'] = $seo_keywords;
        return $meta;
    }


    //seo trang dien thoai thiet bi
    public static function getSeoCatDocument($object){
        $object = (array)$object;
        $meta = array();
        $seo_title = $meta['title'] = ($object['name'])?htmlspecialchars($object['name']):VtHelper::truncate(sfConfig::get('app_seo_title'),190,'...');
        $seo_description = $meta['description'] = ($object['description'])?$object['description']:VtSEO::getPlainText(sfConfig::get('app_seo_description'),160);
        $seo_keywords = $meta['keywords'] = ($object['keywords'])?$object['keywords']: VtHelper::truncate(sfConfig::get('app_seo_keywords'),160,'...');
        $path = '/uploads/' . sfConfig::get('app_album_images') . $object['image_path'];
        $meta['og_image'] = ($object['image_path'])?sfConfig::get('app_domain').VtHelper::getThumbUrl($path, 200, 200, 'article_default'):sfConfig::get('app_seo_ogImage');
        $meta['og_url']  = sfConfig::get('app_domain').'/kho-tai-lieu?cat='.$object['id'];
        $meta['og_description'] = $seo_description;
        $meta['og_title'] = $seo_title;
        $meta['og_site_name'] = $seo_title;
        $meta['dc_title'] = $seo_title;
        $meta['dc_keywords'] = $seo_keywords;
        $meta['news_keywords'] = $seo_keywords;
        return $meta;
    }


    public static function getPlainText($str,$limit){
        $str = str_replace(array("\r\n", "\r"), "\n", strip_tags($str));
        $lines = explode("\n", $str);
        $new_lines = array();

        foreach ($lines as $i => $line) {
            if(!empty($line))
                $new_lines[] = trim($line);
        }
        $str = implode($new_lines);
        return VtHelper::substring($str,$limit);
    }


    public static function getContenSeoByKey($key){
        $listAllConfig = AdConfigTable::getAllConfig();
        $listConfig = array();
        if($listAllConfig){
            foreach ($listAllConfig as $val){
                $listConfig[$val['config_key']] = $val['config_val'];
            }
        }
        return !empty($listConfig[$key])?$listConfig[$key]:'';
    }
}