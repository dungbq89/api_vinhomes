<?php

/**
 * Description of VtHelper
 * @author pmdv_hoannv13
 */
class VtHelper
{
    const MOBILE_09x = 12;
    const MOBILE_9x = 13;
    const MOBILE_849x = 14;
    const MOBILE_SIMPLE = '09x';
    const MOBILE_GLOBAL = '849x';
    const USERNAME_PATTERN = '/^([a-zA-Z])+([a-zA-Z0-9_]){5,29}$/';
    const VT_MSISDN_PATTERN = '/^8496\d{7}$|^0?96\d{7}$|^8497\d{7}$|^0?97\d{7}$|^8498\d{7}$|^0?98\d{7}$|^8416\d{8}$|^0?16\d{8}$/'; // So dien thoai viettel
    const VT_NOT_UNICODE_PATTERN = '/^[A-Za-z0-9\-\_\]{1,255}$/';
    const VT_NOT_UNICODE_SPECIAL_CHAR_PATTERN = '/^[0-9A-Za-z\_\s\!\@\#\$\%\^\&\*\(\)\[\]\{\}\,\.\<\>\?\/\|\:\;\-\+\|\\\]*$/';

    // huync2: lay random ma OTP
    public static function genRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }

    //ngoctv login: 20140610
    public static function encryptPassword($username, $password)
    {
        $toLowerUsername = strtolower($username);
        $passwordVal = $toLowerUsername . $password;
        return base64_encode(sha1(mb_convert_encoding($passwordVal, 'utf-16le', 'ascii'), true));
    }

    public static function SHA1EncryptPassword($algorithm, $salt, $password)
    {

        if (false !== $pos = strpos($algorithm, '::')) {
            $algorithm = array(substr($algorithm, 0, $pos), substr($algorithm, $pos + 2));
        }
        if (!is_callable($algorithm)) {
            throw new sfException(sprintf('The algorithm callable "%s" is not callable.', $algorithm));
        }

        return call_user_func_array($algorithm, array($salt . $password));

//        $passwordVal = $username . $password;
//        return sha1($passwordVal);
    }


    public static function convertTypeTransaction($type)
    {
        $types = array('CHTT' => 'Cửa hàng',
            'ST' => 'Siêu thị',
            'ĐLUQ' => 'Đại lý ủy quyền',
            'NVBHV' => 'Nhân viên bán hàng');
        return isset($types[$type]) ? $types[$type] : '';
    }

    public static function getOriginalBccsGW($val, $tagOpenName, $tagCloseName)
    {
        $pos1 = strpos($val, $tagOpenName); //tag open
        $pos2 = strpos($val, $tagCloseName); //tag close
        $source = substr($val, $pos1, $pos2 - $pos1 + strlen($tagCloseName));
        return json_decode(json_encode(simplexml_load_string($source)));
    }


    public static function formatMobileNumber($phone, $type = self::MOBILE_09x)
    {
        $phone = (string)$phone;
        // Bo het cac ky tu khong phai so
        $phone = preg_replace('@[^0-9]@', '', $phone);
        if ($type == self::MOBILE_09x) {
            if (substr($phone, 0, 1) == '0') { #0975292582
                # do nothing
            } elseif (substr($phone, 0, 2) == '84') { #+84975292582
                $phone = '0' . substr($phone, 2);
            } else { #975292582
                $phone = '0' . $phone;
            }
        } elseif ($type == self::MOBILE_849x) {
            if (substr($phone, 0, 1) == '0') { #0975292582
                $phone = '84' . substr($phone, 1);
            } elseif (substr($phone, 0, 2) == '84') { #+84975292582
                # do nothing
            } else { #975292582
                $phone = '84' . $phone;
            }
        } elseif ($type == self::MOBILE_9x) {
            if (substr($phone, 0, 1) == '0') { #0975292582
                $phone = substr($phone, 1);
            } elseif (substr($phone, 0, 2) == '84') { #+84975292582
                $phone = substr($phone, 2);
            } else { #975292582
                # do nothing
            }
        } else {
            throw new Exception('Format dien thoai khong hop le', 113);
        }

        return $phone;
    }


    /**
     * Kiểm tra số điện thoại viettel theo pattern
     * Mac dinh su dung pattern Viettel trong VtHelper,
     * config = true, su dung pattern trong file config
     * setting = true,
     * @param type $phone_no - so dien thoai can kiem tra
     * @param type $config - pattern lay tu file cau hinh, default su dung tu cau hinh
     * @param type $setting - nhap mot patter cu the
     * @param type $patternName - ten pattern can lay tu file cau hinh hoac tu setting, mac dinh ten lay tu cau hinh
     * @return boolean
     *
     */
    public static function isViettelPhoneNumber($phone_no, $config = true, $setting = false, $patternName = 'app_mobile_pattern', $trim = true)
    {
        $pattern = self::VT_MSISDN_PATTERN;
        if ($config) {
            $pattern = sfConfig::get($patternName, $pattern);
        } else if ($setting) {
            $pattern = VtHelper::getSystemSetting($patternName, true, $pattern);
        }
        if ($trim) {
            $phone_no = trim($phone_no);
        }
        preg_match($pattern, $phone_no, $matches);
        if (count($matches) > 0)
            return true;
        return false;
    }

    public static function setAuthenticated($member, $firstLogin = false)
    {
        sfcontext::getinstance()->getuser()->setMember($member);
        sfcontext::getinstance()->getuser()->setAuthenticated(true);
//        sfcontext::getinstance()->getuser()->setFirstLogin($firstLogin);
        sfcontext::getinstance()->getuser()->setIpAddress(sfContext::getInstance()->getRequest()->getHttpHeader('addr', 'remote'));
        sfcontext::getinstance()->getuser()->setUserAgent(sfContext::getInstance()->getRequest()->getHttpHeader('User-Agent'));
        //    sfcontext::getinstance()->getuser()->setAttribute("logging", true);
        //    sfcontext::getinstance()->getuser()->setAttribute("fulname", $member->getFullname());
        //    sfcontext::getinstance()->getuser()->setAttribute("username", $member->getUsername());
        //    sfcontext::getinstance()->getuser()->setAttribute("username", $member->getUsername());
    }

    /**
     * @author ngoctv
     * @return  ham kiem tra token
     * @param $token can kiem tra
     */
    public static function validateToken($token)
    {
        $formValid = new BaseForm();
        if ($token == $formValid->getCSRFToken())
            return true;
        else
            return false;
    }

    public static function validateNullParams($arrayParams)
    {
        foreach ($arrayParams as $key => $values) {
            if (!$values && $values != '0')
                return $key;
        }
        return false;
    }

    public static function getAppConfigValue($appConfigAdd)
    {
        return sfConfig::get($appConfigAdd);
    }

    public static function convertToDateLocal($date, $lang = null)
    {
        switch ($lang) {
            case "vi":
                $date = date('d \t\h\a\n\g m, Y', $date);
                return str_replace('thang', 'tháng', $date);
                break;
            default:
                return date('jS F Y', $date);
                break;
        }

    }

    /**
     * Tra ve IP cua thiet bi truy cap
     * @author diepth2
     * @created June Mar 17, 2014
     * @return string
     */
    public static function getDeviceIp()
    {

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $mobileIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $mobileIp = $_SERVER['REMOTE_ADDR'];
        }

        return trim($mobileIp);
        /*
          $ipString=@getenv("HTTP_X_FORWARDED_FOR");
          if(!empty($ipString)){
          $addr = explode(",",$ipString);
          return $addr[0];
          }else{
          return $_SERVER['REMOTE_ADDR'];
          }
         */
    }

    public static function isV_internetIp($ip)
    {
        $vInternetRange = sfConfig::get('app_ip_pool_v_internet');
        if (!empty($vInternetRange)) {
            foreach ($vInternetRange as $range) {
                $netArr = explode("/", $range);
                if (self::ipInNetwork($ip, $netArr[0], $netArr[1])) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Ham kiem tra Ip co nam trong dai V-internet cua viettel khong
     * @author NamDT5
     * @created on 17/01/2013
     * @param $ip
     * @return bool
     */
    public static function isV_wapIp($ip)
    {
        $vInternetRange = sfConfig::get('app_ip_pool_v_wap');
        if (!empty($vInternetRange)) {
            foreach ($vInternetRange as $range) {
                $netArr = explode("/", $range);
                if (self::ipInNetwork($ip, $netArr[0], $netArr[1])) {
                    return true;
                }
            }
        }
        return false;
    }

    /*
    * Ham kiem tra IP co nam trong dai IP cho phep khong
    * Tham khao: http://php.net/manual/en/function.ip2long.php
    * @author NamDT5
    * @created on 17/01/2013
    * @param $ip
    * @param $netAddr
    * @param $netMask
    * @return bool
    */
    public static function ipInNetwork($ip, $netAddr, $netMask)
    {
        if ($netMask <= 0) {
            return false;
        }
        $ipBinaryString = sprintf("%032b", ip2long($ip));
        $netBinaryString = sprintf("%032b", ip2long($netAddr));
        return (substr_compare($ipBinaryString, $netBinaryString, 0, $netMask) === 0);
    }

    public static function getMobileNumber($msisdn, $type)
    {
        if (empty($type))
            $type = self::MOBILE_SIMPLE;

        //loai bo so + dau tien doi voi dinh dang +84
        if ($msisdn[0] == '+') {
            $msisdn = substr($msisdn, 1);
        }
        switch ($type) {
            case self::MOBILE_GLOBAL:
                if ($msisdn[0] == '0')
                    return '84' . substr($msisdn, 1);
                else if ($msisdn[0] . $msisdn[1] != '84')
                    return '84' . $msisdn;
                else
                    return $msisdn;
                break;
            case self::MOBILE_SIMPLE:
                if ($msisdn[0] != '0')
                    return '0' . substr($msisdn, 2);
                else
                    return $msisdn;
                break;
            case self::MOBILE_NOTPREFIX:
                if ($msisdn[0] == '0')
                    return substr($msisdn, 1);
                elseif ($msisdn[0] . $msisdn[1] == '84')
                    return substr($msisdn, 2);
                else
                    return $msisdn;
                break;
        }
    }

    public static function getUrlImagePath($objectStr, $imageName, $configDefaultImage = "app_url_media_default_file")
    {
        try {
            if (strlen($imageName) == 0) {
                return sfConfig::get($configDefaultImage);
            } else {

                $filename = sfConfig::get("app_upload_media_file") . "/" . $objectStr . "/" . $imageName;
                if (is_file($filename)) {
                    return sfConfig::get('app_url_media_file') . "/" . $objectStr . "/" . $imageName;
                } else {
                    return sfConfig::get($configDefaultImage);
                }
            }
        } catch (Exception $e) {
            return sfConfig::get($configDefaultImage);
        }
    }
    //tuanbm
    //ham su dung de generate ra the Embed Flash player(Su dung cho backend)
    public static function generateEmbedJwplayer($url, $width = "300", $height = "20", $img = '')
    {
        return '<embed id="player" height="' . $height . '" width="' . $width . '"
              flashvars="file=' . $url . '&controlbar=bottom&image=' . $img . '" wmode="transparent" allowfullscreen="true"
              allowscriptaccess="always" bgcolor="undefined"
              src="/js/jwplayer/player.swf" name="player"  type="application/x-shockwave-flash">';
    }

    /**
     * @author tuanbm2
     * Ham loai bo tat ca cac the html mac dinh loai bo array('script', 'iframe', 'noscript')
     * @static
     * @param       $str - Xau can loai bo tag
     * @param array $tags - Mang cac tag se strip, vi du: array('a', 'b')
     * @param bool $stripContent
     * @example: echo VtHelper::strip_html_default_tags($article->getBody())
     * @return mixed|string
     */
    public static function strip_html_default_tags($str)
    {
        return VtHelper::strip_html_tags($str, array('script', 'iframe', 'noscript'));
    }

    //diepth
    public static function htmlToView($html)
    {
        $str = html_entity_decode(html_entity_decode($html));
        return VtHelper::strip_html_tags($str);
    }

    /**
     * @author tuanbm2
     * Ham loai bo tat ca cac the html mac dinh loai bo array('script', 'iframe', 'noscript')
     * @static
     * @param $str - Ham nay chi duoc dung doi voi  sf_escaping_strategy = 1 va sf_escaping_method=ESC_SPECIALCHARS
     * @return string
     */
    public static function strip_html_tags_and_decode($str)
    {
        //Ham nay chi duoc dung doi voi get du lieu hien thi sf_escaping_strategy = 1 va sf_escaping_method=ESC_SPECIALCHARS
        //tuyet doi ko dung de remove truoc khi save du lieu
        //do symfony tu dong encode HTML nen phai decode truoc khi remove Script
        $str = htmlspecialchars_decode($str); //co the dung ham $object->getSomething(ESC_RAW);//htmlspecialchars_decode($str, ENT_QUOTES);
        $str = VtHelper::strip_html_tags($str, array('script', 'iframe', 'noscript', 'embed'));
        return str_replace('<embed ', '', $str);
    }
    /*
     * @author tuanbm
     * Ham get Image Thumbnail, de tra ve duong dan tuyet doi (Anh Thumbnail)
     * @static
     * return: link day du ca http://server/media/....
     */
    /**
     * @author hoangl
     * Ham loai bo tat ca cac the html
     * @static
     * @param       $str - Xau can loai bo tag
     * @param array $tags - Mang cac tag se strip, vi du: array('a', 'b')
     * @param bool $stripContent
     * @example: <?php echo VtHelper::strip_html_tags($article->getBody(), array('script', 'iframe', 'noscript'))?>
     * @return mixed|string
     */
    public static function strip_html_tags($str, $tags = array(), $stripContent = false)
    {
        if (empty($tags)) {
            $tags = array("br/", "hr/", "!--...--", '!doctype', 'a', 'abbr', 'address', 'area', 'article', 'aside', 'audio', 'b', 'base', 'bb', 'bdo', 'blockquote', 'body', 'br', 'button', 'canvas', 'caption', 'cite', 'code', 'col', 'colgroup', 'command', 'datagrid', 'datalist', 'dd', 'del', 'details', 'dfn', 'div', 'dl', 'dt', 'em', 'embed', 'eventsource', 'fieldset', 'figcaption', 'figure', 'footer', 'form', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'head', 'header', 'hgroup', 'hr', 'html', 'i', 'iframe', 'img', 'input', 'ins', 'kbd', 'keygen', 'label', 'legend', 'li', 'link', 'mark', 'map', 'menu', 'meta', 'meter', 'nav', 'noscript', 'object', 'ol', 'optgroup', 'option', 'output', 'p', 'param', 'pre', 'progress', 'q', 'ruby', 'rp', 'rt', 'samp', 'script', 'section', 'select', 'small', 'source', 'span', 'strong', 'style', 'sub', 'summary', 'sup', 'table', 'tbody', 'td', 'textarea', 'tfoot', 'th', 'thead', 'time', 'title', 'tr', 'ul', 'var', 'video', 'wbr');
        }
        $content = '';
        if (!is_array($tags)) {
            $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
            if (end($tags) == '')
                array_pop($tags);
        }
        foreach ($tags as $tag) {
            if ($stripContent)
                $content = '(.+</' . $tag . '(>|\s[^>]*>)|)';
            $str = preg_replace('#</?' . $tag . '(>|\s[^>]*>)' . $content . '#is', '', $str);
        }

        $str = trim($str, ' ');

        return $str;
    }

    /*
     * duynt10
     */

    public static function strip_html_tags_p($str, $tags = array(), $stripContent = false)
    {
        if (empty($tags)) {
            $tags = array("br/", "hr/", "!--...--", '!doctype', 'a', 'abbr', 'address', 'area', 'article', 'aside', 'audio', 'b', 'base', 'bb', 'bdo', 'blockquote', 'body', 'br', 'button', 'canvas', 'caption', 'cite', 'code', 'col', 'colgroup', 'command', 'datagrid', 'datalist', 'dd', 'del', 'details', 'dfn', 'div', 'dl', 'dt', 'em', 'embed', 'eventsource', 'fieldset', 'figcaption', 'figure', 'footer', 'form', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'head', 'header', 'hgroup', 'hr', 'html', 'i', 'iframe', 'img', 'input', 'ins', 'kbd', 'keygen', 'label', 'legend', 'li', 'link', 'mark', 'map', 'menu', 'meta', 'meter', 'nav', 'noscript', 'object', 'ol', 'optgroup', 'option', 'output', 'param', 'pre', 'progress', 'q', 'ruby', 'rp', 'rt', 'samp', 'script', 'section', 'select', 'small', 'source', 'span', 'strong', 'style', 'sub', 'summary', 'sup', 'table', 'tbody', 'td', 'textarea', 'tfoot', 'th', 'thead', 'time', 'title', 'tr', 'ul', 'var', 'video', 'wbr');
        }
        $content = '';
        if (!is_array($tags)) {
            $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
            if (end($tags) == '')
                array_pop($tags);
        }
        foreach ($tags as $tag) {
            if ($stripContent)
                $content = '(.+</' . $tag . '(>|\s[^>]*>)|)';
            $str = preg_replace('#</?' . $tag . '(>|\s[^>]*>)' . $content . '#is', '', $str);
        }

        $str = trim($str, ' ');

        return $str;
    }

    public static function strip_html_tags_no_script($str)
    {
        $str = VtHelper::strip_html_tags($str, array('script', 'iframe'));
        return $str;
    }

    public static function getUrlImagePathThumb($objectStr, $imageName, $width = 100, $height = 100, $configDefaultImage = "app_url_media_default_file")
    {
        try {

            if (strlen($imageName) == 0) {
                return sfConfig::get($configDefaultImage);
            } else {

                //them 1 doan code check exits file, neu ko ton tai thi cung hidden di
                //u01/apps/imuzik/cms-web/web/uploads/images
                $imageName = ltrim($imageName, "/");
                $filename = sfConfig::get("app_upload_media_file") . "/" . $objectStr . "/thumbs/" . $width . $height . "/" . $imageName;
                if (is_file($filename)) {
                    return sfConfig::get('app_url_media_file') . "/" . $objectStr . "/thumbs/" . $width . $height . "/" . $imageName;
                } else {
                    return self::createImageThumbnail($objectStr, $imageName, "thumbs", $width, $height, $configDefaultImage);
                }
            }
        } catch (Exception $e) {
            /* rethrow it */
            return sfConfig::get($configDefaultImage);
        }
    }

    //$folderThumb="thumbnail",$width=150,$height=150,$configDefaultImage = "app_url_media_default_file"
    public static function createImageThumbnail($objectStr, $imageName, $folderThumbName, $width, $height, $configDefaultImage = "app_url_media_default_file")
    {
        try {
            $full_path_file = sfConfig::get("app_upload_media_file") . "/" . $objectStr . "/" . $folderThumbName . "/" . $width . $height . "/" . $imageName;
            $originalImage = sfConfig::get("app_upload_media_file") . "/" . $objectStr . "/" . $imageName;

            if (is_file($originalImage)) {
                $file_name = basename($full_path_file); //test.jpg
                $folderThumb = str_replace($file_name, "", $full_path_file); //duong dan file
                if (!is_dir($folderThumb)) {
                    @mkdir($folderThumb, 0777, true);
                }
                //neu ton tai $originalImage thi generate no ra anh thumbnail
                $thumbnail = new sfThumbnail($width, $height, false);
                $thumbnail->loadFile($originalImage);
                $thumbnail->save($full_path_file, 'image/jpeg');
                return sfConfig::get('app_url_media_file') . "/" . $objectStr . "/" . $folderThumbName . "/" . $width . $height . '/' . $imageName;
            }
            return sfConfig::get($configDefaultImage);
        } catch (Exception $ex) {
            return sfConfig::get($configDefaultImage);
        }
    }

    /***
     * @author ngoctv
     * Ham resize anh dung theo ti le
     * @static
     * @param $file
     * @param $w
     * @param $h
     * @param bool $crop
     * @return resource
     */
    public static function resize_image($dir_root, $dir_module, $filename, $w, $h, $crop = FALSE)
    {
        $in_filename = $dir_root . $dir_module . $filename;
        $out_filename = $dir_root . $dir_module . "thumbs/" . $filename;
        $file_name = basename($out_filename); //test.jpg
        $folderThumb = str_replace($file_name, "", $out_filename); //duong dan file
        if (!is_dir($folderThumb)) {
            @mkdir($folderThumb, 0777, true);
        }
        //write file theo kich thuoc
        $out_filename = $folderThumb . $w . '_' . $h . '_' . $file_name;

        list($width, $height) = getimagesize($in_filename);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w / $h > $r) {
                $newwidth = $h * $r;
                $newheight = $h;
            } else {
                $newheight = $w / $r;
                $newwidth = $w;
            }
        }
        $src = imagecreatefromjpeg($in_filename);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        $quality = sfConfig::get("app_thumbs_images_quality") ? sfConfig::get("app_thumbs_images_quality") : 100;
        ImageJpeg($dst, $out_filename, $quality);
        ImageDestroy($dst);
        ImageDestroy($src);
        return $out_filename;//tra ra duong dan thumbs
    }

    /**
     * @author ngoctv1
     * Ham encode the iframe trong truong hop insert truc tiep vao db
     * @static
     * @param       $str - Xau can encode
     * @param array $tags - Mang cac tag se strip, vi du: array('a', 'b')
     * @return mixed|string
     */
    public static function strip_html_tags_iframe($string, $tags = array())
    {
        if (!empty($tags)) {
            $str = '';
            foreach ($tags as $tag) {
                $str = str_replace('<' . $tag, '&lt;' . $tag, str_replace('</' . $tag, '&lt;/' . $tag, str_replace('<' . strtoupper($tag), '&lt;' . strtoupper($tag), str_replace('</' . strtoupper($tag), '&lt;/' . strtoupper($tag), $string))));
            }
            return $str;
        } else {
            return $string;
        }
    }

    /**
     * @author hoangl
     * Ham loai bo tat ca cac the html
     * @static
     * @param       $str - Xau can loai bo tag
     * @param array $tags - Mang cac tag se strip, vi du: array('a', 'b')
     * @param bool $stripContent
     * @return mixed|string
     */
    public static function encodeOutput($string, $force = FALSE)
    {

        if (sfConfig::get('sf_escaping_strategy') == "1" && sfConfig::get('sf_escaping_method') == "ESC_SPECIALCHARS" && $force == false) {
            return htmlentities($string, ENT_QUOTES, 'UTF-8');//self::strip_html_tags_iframe($string, array('iframe','textarea'));
//            return $string;
        } else {
            //ngoctv them ham strip_html_tags_iframe
            return htmlspecialchars(self::strip_html_tags_iframe($string, array('iframe')), ENT_COMPAT, sfConfig::get('sf_charset'));
            //        return htmlentities($string, ENT_QUOTES, 'UTF-8');
        }
    }

    /**
     * Ham tra cat ky tu tieng viet
     * @param string $text
     * @param int $length
     * @param string $truncateString
     * @param string $truncateLastspace
     * @throws dmException
     */
    public static function truncate($text, $length = 30, $truncateString = '...', $truncateLastspace = false)
    {
        /**
         * Ham tra cat ky tu tieng viet
         * @param $text
         * @param int $length
         * @param string $truncateString
         * @param bool $truncateLastspace
         * @return string
         * @throws dmException
         */
        if (sfConfig::get('sf_escaping_method') == 'ESC_SPECIALCHARS') {
            $text = htmlspecialchars_decode($text, ENT_QUOTES);
        }

        if (is_array($text)) {
            throw new dmException('Can not truncate an array: ' . implode(', ', $text));
        }

        $text = (string)$text;

        if (extension_loaded('mbstring')) {
            $strlen = 'mb_strlen';
            $substr = 'mb_substr';
            //hatt12 them dong nay de dem ky tu tieng viet
            $countStr = $strlen($text, 'utf-8');
            if ($countStr > $length) {
                $text = $substr($text, 0, $length, 'utf-8');

                if ($truncateLastspace) {
                    $text = preg_replace('/\s+?(\S+)?$/', '', $text);
                }

                $text = $text . $truncateString;
            }
        } else {
            $strlen = 'strlen';
            $substr = 'substr';
            $countStr = $strlen($text);
            if ($countStr > $length) {
                $text = $substr($text, 0, $length);

                if ($truncateLastspace) {
                    $text = preg_replace('/\s+?(\S+)?$/', '', $text);
                }

                $text = $text . $truncateString;
            }
        }


        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    public static function replaceSpecialChar($str)
    {
        $specialChar = array(
            unichr(160), //'\xA0',     // space
            # '\x60',     //
            # '\xB4',     //
            unichr(8216), // '\x2018',   // left single quotation mark
            unichr(8217), // '\x2019',   // right single quotation mark
            unichr(8220), // '\x201C',   // left double quotation mark
            unichr(8221), // '\x201D'    // right double quotation mark
            unichr(130), // baseline single quote
            unichr(145), // left single quote
            unichr(146), // right single quote)
            unichr(147), // right single quote)
            unichr(148), // right single quote)
        );
        $specialCharReplace = array(
            ' ', // space
            # '\x60',     //
            # '\xB4',     //
            "'", // left single quotation mark
            "'", // right single quotation mark
            '"', // left double quotation mark
            '"', // right double quotation mark
            ',', // baseline single quote
            "'", // 145
            "'", // 146
            '"', // 147
            '"', // 148
        );
        return str_replace($specialChar, $specialCharReplace, $str);
    }

    /**
     * @author ngoctv
     * Ham format lai gia theo dang {aa,aaa,aaa}
     * @param int $price
     * @param int $number So ky tu sau dau $char
     * @param char $char Ky tu phan cach
     * @param type $unit Don vi tien te
     * @param type $default Chuoi mac dinh khi gia = 0
     * @return type
     */
    public static function generatePriceToString($price, $number = 3, $char = ',', $unit = 'đ', $default = 'Miễn phí')
    {
        if ($price > 0) {
            $count = strlen($price);
            $result = $price;
            while ($count > $number) {
                $substr = substr($price, $count - $number, $number);
                $result = $char . $substr . $result;
                $count = $count - $number;
                if ($count <= $number) {
                    $substr = substr($price, 0, $count);
                    $result = $substr . $result;
                }
            }
            return $result . " (" . $unit . ")";
        } else {
            return $default;
        }
    }

    public static function generateNumber()
    {

        $string = "";
        $possible = "012346789";
        $length = sfConfig::get('app_lenght_reg_code', 8);
        $maxlength = strlen($possible);

        if ($length > $maxlength) {
            $length = $maxlength;
        }
        // set up a counter for how many characters are in
        $i = 0;
        // add random characters until $length is reached
        while ($i < $length) {
            // pick a random character from the possible ones
            $char = substr($possible, mt_rand(0, $maxlength - 1), 1);
            // have we already used this character?
            if (!strstr($string, $char)) {
                // no, so it's OK to add it onto the end of whatever we've already got...
                $string .= $char;

                $i++;
            }
        }
        return $string;

    }

    /**
     * @author: ngoctv
     * Ham tao anh thumbnail co text Watermark ghi len anh
     * @param type $dir_root
     * @param type $dir_module
     * @param type $filename
     * @param type $width
     * @param type $height
     */
    public static function createImage($dir_root, $dir_module, $filename, $width, $height)
    {
        $in_filename = $dir_root . $dir_module . $filename;
        $out_filename = $dir_root . $dir_module . "thumbs/" . $filename;
        //var_dump($in_filename);die; file_exists
        if (!is_file($in_filename)) {
            return sfConfig::get("app_url_media_default_file");
        } else {
            $src_img = ImageCreateFromJpeg($in_filename);
            $old_x = ImageSX($src_img);
            $old_y = ImageSY($src_img);
            $dst_img = ImageCreateTrueColor($width, $height);
            ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $width, $height, $old_x, $old_y);

            self::addWatermark($dst_img);
            $quality = sfConfig::get("app_thumbs_images_quality") ? sfConfig::get("app_thumbs_images_quality") : 80;
            ImageJpeg($dst_img, $out_filename, $quality);
            ImageDestroy($dst_img);
            ImageDestroy($src_img);
            return sfConfig::get("app_url_media_file") . $dir_module . "thumbs/" . $filename;
        }
    }

    /**
     * @author: ngoctv
     * Ham tao text Watermark
     * @param type $image
     * @return type
     */
    static function addWatermark($image)
    {
        $text = sfConfig::get("app_watermark_images_text");

        $font = realpath($_SERVER["DOCUMENT_ROOT"] . sfConfig::get("app_watermark_font_name")); // case sensitive
        if ($font == false) return;

        $fontSize = sfConfig::get("app_watermark_font_size");
        $borderOffset = sfConfig::get("app_watermark_font_border");

        $dimensions = ImageTtfBBox($fontSize, 0, $font, $text . "@");
        $lineWidth = ($dimensions[2] - $dimensions[0]);

        $textX = (ImageSx($image) - $lineWidth) / 2;
        $textY = $borderOffset - $dimensions[7];
        $red = sfConfig::get("app_watermark_color_red");
        $green = sfConfig::get("app_watermark_color_green");
        $blue = sfConfig::get("app_watermark_color_blue");
        $color = ImageColorAllocate($image, $red, $green, $blue);
        ImageTtfText($image, $fontSize, 0, $textX, $textY, $color, $font, $text);
    }

    /**
     * @author ngoctv
     * Ham kiem tra mot ky tu hay mot chuoi co trong phan dau cua chuoi khac hay khong, neu co thi tra ve true nguoc lai la false
     * @param type $haystack
     * @param type $needle
     * @return type
     */
    public static function startsWith($haystack, $needle)
    {
        return !strncmp($haystack, $needle, strlen($needle));
    }

    /**
     * @author ngoctv
     * Ham kiem tra mot ky tu hay mot chuoi co trong phan duoi cua chuoi khac hay khong, neu co thi tra ve true nguoc lai la false
     * @param type $haystack
     * @param type $needle
     * @return boolean
     */
    public static function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }
        return (substr($haystack, -$length) === $needle);
    }

    /**
     * @author ngoctv
     * ham tra ve so ngay trong thang
     * @param type $month
     * @param type $year
     * @return type
     */
    public static function days_of_month($month, $year)
    {
        // calculate number of days in a month
        return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
    }

    /**
     * @des:sub_string trong popup
     * @author: loilv4
     * @created: 22/04/2013
     * @param: $str, $length, $truncateString, $truncateLastspace
     * @return: $str
     */
    public static function subString($str, $length = 22, $truncateString = '...', $truncateLastspace = true)
    {
        $str = self::replaceSpecialCharsFromWord($str);
        $str = (string)$str;
        if (extension_loaded('mbstring')) {
            $strlen = 'mb_strlen';
            $substr = 'mb_substr';
        } else {
            $strlen = 'strlen';
            $substr = 'substr';
        }

        if ($strlen($str) > $length) {
            if ($substr == 'mb_substr') {
                $str = $substr($str, 0, $length - $strlen($truncateString), 'UTF-8');
            } else {
                $str = $substr($str, 0, $length - $strlen($truncateString));
            }
            if ($truncateLastspace) {
                $str = preg_replace('/\s+?(\S+)?$/', '', $str);
            }
            $str = $str . $truncateString;
        }
        return $str;
    }

    /**
     * @des:replace trong popup
     * @author: loilv4
     * @created: 22/04/2013
     * @param: $strInput, $limit
     * @return: $resultReturn
     */
    public static function replaceSpecialCharsFromWord($strInput)
    {
        $strInput = str_replace('“', '"', $strInput);
        $strInput = str_replace('”', '"', $strInput);
        return $strInput;
    }

    /**
     * @des:cat dong thoi encode trong popup
     * @author: loilv4
     * @created: 22/04/2013
     * @param: $strInput, $limit
     * @return: $resultReturn
     */
    //truong hop $strInput ko bi encode boi symfony, return tu dong encode anti XSS
    public static function getLimitStringWithoutEncode($strInput, $limit = 10)
    {
        $strInput = self::replaceSpecialCharsFromWord($strInput);

        $resultReturn = vtSecurity::encodeOutput(VtHelper::subString($strInput, $limit, '...', true));
        return $resultReturn;
    }

    public static function generateString($length = 8)
    {

        $string = "";
        $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

        $maxlength = strlen($possible);

        if ($length > $maxlength) {
            $length = $maxlength;
        }
        // set up a counter for how many characters are in
        $i = 0;
        // add random characters until $length is reached
        while ($i < $length) {
            // pick a random character from the possible ones
            $char = substr($possible, mt_rand(0, $maxlength - 1), 1);
            // have we already used this character?
            if (!strstr($string, $char)) {
                // no, so it's OK to add it onto the end of whatever we've already got...
                $string .= $char;

                $i++;
            }
        }
        return $string;
    }

    public static function getImagePath($source, $type = '')
    {
        if ($type != '') {
            $defaultImage = sfConfig::get('app_image_default_' . $type);
        } else {
            $defaultImage = sfConfig::get('app_image_default');
        }
        return (file_exists(sfConfig::get('sf_web_dir') . $source) && is_file(sfConfig::get('sf_web_dir') . $source)) ? $source : $defaultImage;
    }

    /**
     * Lay link anh thumbnail<br />
     * Vi du su dung:<br />
     * <img src="<?php VtHelper::getThumbUrl('/medias/huypv/2011/06/15/abc.jpg', 90, 60); ?>" />
     * @param string $source /medias/huypv/2011/06/15/abc.jpg (nam trong thu muc web!)
     * @author huypv
     * @param int $width
     * @param int $height
     * @return string /medias/huypv/2011/06/15/thumbs/abc_90_60.jpg
     */
    public static function getThumbUrl($source, $width = null, $height = null, $type = '')
    {
        if ($type != '') {
            $defaultImage = sfConfig::get('app_image_default_' . $type);
        } else {
            $defaultImage = sfConfig::get('app_image_default');
        }

        if ($width == null && $height == null)
            return (file_exists(sfConfig::get('sf_web_dir') . $source)) ? $source : $defaultImage;
        if (empty($source)) {
            return $defaultImage;
        }
        $mediasDir = sfConfig::get('sf_web_dir');
        $fullPath = $mediasDir . $source;
        $pos = strrpos($source, '/');
        if ($pos !== false) {
            $filename = substr($source, $pos + 1);

            $app = sfContext::getInstance()->getConfiguration()->getApplication();
            switch ($app) {
                default:
                    $dir = '/cache/' . substr($source, 1, $pos);
            }
        } else {
            return $defaultImage;
        }
        $pos = strrpos($filename, '.');
        if ($pos !== false) {
            $basename = substr($filename, 0, $pos);
            $extension = substr($filename, $pos + 1);

            if (strtolower($extension) == 'bmp') {
                $fullPath = VtBmpImageConvert::ImageCreateFromBmp(sfConfig::get('sf_web_dir') . $source);
                $extension = 'jpg';
            }
        } else {
            return $defaultImage;
        }

        if ($width == null) {
            $thumbName = $basename . '_auto_' . $height . '.' . $extension;
        } else if ($height == null) {
            $thumbName = $basename . '_' . $width . '_auto.' . $extension;
        } else {
            $thumbName = $basename . '_' . $width . '_' . $height . '.' . $extension;
        }

        $fullThumbPath = $mediasDir . $dir . $thumbName;
# Neu thumbnail da ton tai roi thi khong can generate
        if (file_exists($fullThumbPath)) {
            return $dir . $thumbName;
        }
# Neu thumbnail chua ton tai thi su dung plugin de tao ra
        $scale = ($width != null && $height != null) ? false : true;
        $thumbnail = new sfThumbnail($width, $height, $scale, true, 100);
        if (!is_file($fullPath)) {
            return $defaultImage;
        }
        $thumbnail->loadFile($fullPath);

        if (!is_dir($mediasDir . $dir))
            mkdir($mediasDir . $dir, 0777, true);
        $thumbnail->save($fullThumbPath, 'image/jpeg');
        return (file_exists(sfConfig::get('sf_web_dir') . $dir . $thumbName)) ? $dir . $thumbName : $defaultImage;
    }

    /**
     * Tra ve dinh dang thoi gian: Thứ 4, 07/05/2014 14:22
     * @author NamDT5
     * @created on Jul 12, 2012
     * @param unknown_type $string
     * @param unknown_type $encoding
     */
    public static function getFormatDate($datetime)
    {
        $datearr = array(
            "Monday" => "Thứ hai",
            "Tuesday" => "Thứ ba",
            "Wednesday" => "Thứ tư",
            "Thursday" => "Thứ năm",
            "Friday" => "Thứ sáu",
            "Saturday" => "Thứ bảy",
            "Sunday" => "Chủ nhật"
        );
        $date = date("l", strtotime($datetime));
        return $datearr[$date] . ', ' . date(' d/m/Y', strtotime($datetime));
    }

    public static function reFormatDate($datetime, $format)
    {
        return (isset($datetime) & ($datetime != '0000-00-00 00:00:00')) ? date($format, strtotime($datetime)) : '';
    }

    /**
     * preProcess query search backsplash (\) tat ca doan code search like trong PHP ma can tim ky tu dac biet deu phai goi ham nay
     * @author tuanbm
     * @modifier chuyennv2
     * @date 2012/06/27
     * @return string
     */
    public static function preProcessForSearchLike($param)
    {
        $param = addslashes($param);
        if (($param != '')) {
            $param = str_replace("%", "\\%", $param);
            $param = str_replace("_", "\\_", $param);
        }
        return vtSecurity::decodeInput($param);
    }

    //get guild
    public static function getGUID()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double)microtime() * 10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = substr($charid, 0, 8) . $hyphen
                . substr($charid, 8, 4) . $hyphen
                . substr($charid, 12, 4) . $hyphen
                . substr($charid, 16, 4) . $hyphen
                . substr($charid, 20, 12);
            return $uuid;
        }
    }

    public static function translateQuery($str, $trim = true)
    {
        if ($str == null || $str == '')
            return $str;
        $str = $trim ? trim($str) : $str;
        $str = addcslashes($str, "\\%_");
        return $str;
    }

    //check format date
    public static function  validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }


    public static function generateUniqueFileName($ext)
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),
            // 16 bits for "time_hi_and_version",
// four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
// 8 bits for "clk_seq_low",
// two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,
            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        ) . '.' . $ext;
    }

    public static function getPathImage($link, $prefix)
    {
//        var_dump(sfConfig::get('app_url_media_file') . '/' . $prefix . $link);
//        die;
        $defaultImage = sfConfig::get('app_url_media_default_file');
//        var_dump(file_exists(sfConfig::get('app_upload_media_file') . '/' . $prefix . $link));
//        die;
        return file_exists(sfConfig::get('app_upload_media_file') . '/' . $prefix . $link) ? (sfConfig::get('app_url_media_file') . '/' . $prefix . $link) : $defaultImage;
        return sfConfig::get('app_url_media_file') . '/' . $prefix . $link;
    }


    public static function getDateNew($date, $format = 'd-m-')
    {
        return date('d-m-Y', strtotime($date));
    }

}

/**
 * Chuyen doi ky tu ASCII ve dang chuan UNICODE
 * @author NamDT5
 * @created on Jul 12, 2012
 * @param unknown_type $unicode
 * @param unknown_type $encoding
 */
function unichr($unicode, $encoding = 'UTF-8')
{
    return mb_convert_encoding("&#{$unicode};", $encoding, 'HTML-ENTITIES');
}

/**
 * Tra ve ma ASCII
 * @author NamDT5
 * @created on Jul 12, 2012
 * @param unknown_type $string
 * @param unknown_type $encoding
 */
function uniord($string, $encoding = 'UTF-8')
{
    $entity = mb_encode_numericentity($string, array(0x0, 0xffff, 0, 0xffff), $encoding);
    return preg_replace('`^&#([0-9]+);.*$`', '\\1', $entity);
}



