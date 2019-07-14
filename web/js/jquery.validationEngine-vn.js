(function($){
    $.fn.validationEngineLanguage = function(){
    };
    $.validationEngineLanguage = {
        newLang: function(){
            $.validationEngineLanguage.allRules = {
                "required": { // Add your regex rules here, you can take telephone as an example
                    "regex": "none",
                    "alertText": "* Trường bắt buộc",
                    "alertTextCheckboxMultiple": "* Trường phải chọn",
                    "alertTextCheckboxe": "* Checkbox này phải chọn"
                },
                "requiredWhenRelated": { // Add your regex rules here, you can take telephone as an example
                    "regex": "none",
                    "alertText": "* Trường bắt buộc",
                    "alertTextCheckboxMultiple": "* Trường phải chọn",
                    "alertTextCheckboxe": "* Checkbox này phải chọn"
                },
                "validateSpecialCharater": {
                    "regex": "none",
                    "alertText": "* Các kí tự đặc biệt !#$^*[]\\\'{}\"? bị giới hạn trong hệ thống",
                    "alertText2": " ký tự"
                },
                "minSize": {
                    "regex": "none",
                    "alertText": "* Ngắn nhất ",
                    "alertText2": " ký tự"
                },
                "maxSize": {
                    "regex": "none",
                    "alertText": "* Dài nhất ",
                    "alertText2": " ký tự"
                },
                "maxFileSize": {
                    "regex": "none",
                    "alertText": "* Dung lượng file lớn nhất ",
                    "alertText2": " MB (thực tế ",
                    "alertText3": " MB)"
                },
                "groupRequired": {
                    "regex": "none",
                    "alertText": "* You must fill one of the following fields"
                },
                "min": {
                    "regex": "none",
                    "alertText": "* Giá trị nhỏ nhất là "
                },
                "max": {
                    "regex": "none",
                    "alertText": "* Giá trị lớn nhất là "
                },
                "greater": {
                    "regex": "none",
                    "alertText": "* Giá trị phải lớn hơn ",
                    "alertTextObject":"* Giá trị phải lớn hơn trường '"
                },
                "greaterEqual": {
                    "regex": "none",
                    "alertText": "* Giá trị phải lớn hơn hoặc bằng",
                    "alertTextObject":"* Giá trị phải lớn hơn hoặc bằng trường '"
                },
                "less": {
                    "regex": "none",
                    "alertText": "* Giá trị phải nhỏ hơn "
                },
                "past": {
                    "regex": "none",
                    "alertText": "* Trước ngày "
                },
                "future": {
                    "regex": "none",
                    "alertText": "* Sau ngày "
                },	
                "maxCheckbox": {
                    "regex": "none",
                    "alertText": "* Nhiều nhất ",
                    "alertText2": " lựa chọn"
                },
                "minCheckbox": {
                    "regex": "none",
                    "alertText": "* Ít nhất ",
                    "alertText2": " lựa chọn"
                },
                "equals": {
                    "regex": "none",
                    "alertText": "* Các trường không trùng nhau"
                },
                "notequals": {
                    "regex": "none",
                    "alertText": "* Các bản ghi trùng nhau"
                },
                "phone": {
                    // credit: jquery.h5validate.js / orefalo
                    //"regex": /^([\+][0-9]{1,3}[ \.\-])?([\(]{1}[0-9]{2,6}[\)])?([0-9 \.\-\/]{3,20})((x|ext|extension)[ ]?[0-9]{1,4})?$/,
                    "regex":/^([\+])?(\d([.\s])?){1,15}$/,
                    "alertText": "* Số điện thoại không hợp lệ"
                },
                "email": {
                    // Shamelessly lifted from Scott Gonzalez via the Bassistance Validation plugin http://projects.scottsplayground.com/email_address_validation/
                    "regex": /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i,
                    "alertText": "* Email không hợp lệ"
                },
                "integer": {
                    "regex": /^[\-\+]?\d+$/,
                    "alertText": "* Không phải là số nguyên"
                },
                "positiveInteger": {
                    "regex": /^[\+]?\d+$/,
                    "alertText": "* Không phải là số nguyên dương"
                },
                "negativeInteger": {
                    "regex": /^[\-]?\d+$/,
                    "alertText": "* Không phải là số nguyên âm"
                },
                "number": {
                    // Number, including positive, negative, and floating decimal. credit: orefalo
                    "regex": /^[\-\+]?(([0-9]+)([\.,]([0-9]+))?|([\.,]([0-9]+))?)$/,
//                    "regex": /^[\+]?\d+$/,
                    "alertText": "* Không phải là số"
                },
                "positiveNumber": {
                    // Number, including positive, negative, and floating decimal. credit: orefalo
                    "regex": /^[\+]?(([0-9]+)([\.,]([0-9]+))?|([\.,]([0-9]+))?)$/,
                    "alertText": "* Không phải là số dương"
                },
                "date": {
                    "regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/,
                    "alertText": "* Định dạng ngày sai, phải là YYYY-MM-DD"
                },
                "ipv4": {
                    "regex": /^((([01]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))[.]){3}(([0-1]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))$/,
                    "alertText": "* IP không hợp lệ"
                },
                "url": {
                    "regex": /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i,
                    "alertText": "* URL không hợp lệ"
                },
                "onlyNumberSp": {
                    "regex": /^[0-9\ ]+$/,
                    "alertText": "* Chỉ được nhập số"
                },
                "onlyLetterSp": {
                    "regex": /^[a-zA-Z\ \']+$/,
                    "alertText": "* Chỉ được nhập chữ"
                },
                "onlyLetterNumber": {
                    "regex": /^[0-9a-zA-Z]+$/,
                    "alertText": "* Bạn chỉ được nhập số và chữ không dấu"
                },
                "onlyLetterNumberSp": {
                    "regex": /^[0-9a-zA-Z\ ]+$/,
                    "alertText": "* Bạn chỉ được nhập số và chữ không dấu"
                },
                "excelFile": {
                    /* Chi can duoi la .xls, khong can validate toan bo ten file (do minh chon file, khong phai danh vao) */
                    "regex": /^(.)+.xls$/i,
                    "alertText": "* Bạn chỉ được nhập file có đuôi xls"
                },
                // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
                "ajaxUserCall": {
                    "url": "ajaxValidateFieldUser",
                    // you may want to pass extra data on the ajax call
                    "extraData": "name=eric",
                    "alertText": "* This user is already taken",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxUserCallPhp": {
                    "url": "phpajax/ajaxValidateFieldUser.php",
                    // you may want to pass extra data on the ajax call
                    "extraData": "name=eric",
                    // if you provide an "alertTextOk", it will show as a green prompt when the field validates
                    "alertTextOk": "* This username is available",
                    "alertText": "* This user is already taken",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxNameCall": {
                    // remote json service location
                    "url": "ajaxValidateFieldName",
                    // error
                    "alertText": "* This name is already taken",
                    // if you provide an "alertTextOk", it will show as a green prompt when the field validates
                    "alertTextOk": "* This name is available",
                    // speaks by itself
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxNameCallPhp": {
                    // remote json service location
                    "url": "phpajax/ajaxValidateFieldName.php",
                    // error
                    "alertText": "* This name is already taken",
                    // speaks by itself
                    "alertTextLoad": "* Validating, please wait"
                },
                "validate2fields": {
                    "alertText": "* Please input HELLO"
                },
                "validateStartDatEndDate": {
                    "alertText": "* Trường từ ngày phải nhỏ hơn hoặc bằng trường đến ngày"
                },
                "validateEffectiveDateExpiryDate": {
                    "alertText": "* Ngày hiệu lực phải nhỏ hơn hoặc bằng Ngày hết hiệu lực"
                },
                "validateDestOrgSrcOrg": {
                    "alertText": "* Đơn vị đích phải khác đơn vị nguồn"
                },
                "validateDecidedDate": {
                    "alertText": "* Ngày quyết định không được lớn hơn ngày hiện tại"
                },
                "validateLessThanNow": {
                    "alertText": "* Ngày hết hiệu lực phải nhỏ hơn hoặc bằng ngày hiện tại"
                },
                "validateStartDatEndDateEffect": {
                    "alertText": "* Ngày bắt đầu hiệu lực phải nhỏ hơn hoặc bằng ngày hết hiệu lực"
                },
                "validateAccountNumber": {
                    "alertText": "* Số tài khoản không được trùng nhau"
                },
                "personalIdNumber": {
                    "regex": /^[0-9a-zA-Z]{8,15}$/,
                    "alertText": "* Số CMND phải từ 8 đến 15 ký tự chữ và số"
                },
                //tls warning:homegrown not fielded 
                "dateFormat":{
                    "regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:0?[1-9]|1[0-2])(\/|-)(?:0?[1-9]|1\d|2[0-8]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(0?2(\/|-)29)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/,
                    "alertText": "* Ngày sai"
                },
                //tls warning:homegrown not fielded 
                "dateTimeFormat": {
                    "regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1}$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^((1[012]|0?[1-9]){1}\/(0?[1-9]|[12][0-9]|3[01]){1}\/\d{2,4}\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1})$/,
                    "alertText": "* Invalid Date or Date Format\nExpected Format: mm/dd/yyyy hh:mm:ss AM|PM or yyyy-mm-dd hh:mm:ss AM|PM"
                },
                "older": {
                    "regex": "none",
                    "alertText": "* Không được sau ",
                    "alertTextNow": " hiện tại"
                },
                  "after": {
                    "regex": "none",
                    "alertText": "* Không được trước ",
                    "alertTextNow": " hiện tại"
                },
                "dateChooser": {
                    "regex": /^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}$/,
                    "invalidFormat": "* Ngày không đúng định dạng (dd/mm/yyyy)",
                    "invalidValue": "* Ngày không hợp lệ"
                },
                "uploadFileAccepted": {
                    "regex": /^.+\.(txt|doc|docx|rar|zip|xls|xlsx|pdf|jpg|gif)$/,
                    "alertText": "* Phải là định dạng (txt| doc| docx| rar| zip| xls| xlsx| pdf| jpg| gif)."
                },
                // truongtx5: them cac dieu kien validate
                "beforeCurrentDate":{
                    "alertText": "* Không được lớn hơn ngày hiện tại"
                },
                "emailViettel": {
                    // Shamelessly lifted from Scott Gonzalez via the Bassistance Validation plugin http://projects.scottsplayground.com/email_address_validation/
                    "regex": /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@viettel.com.vn?$/i,
                    "alertText": "* Email nhập vào phải là email Viettel"
                },
                "startDateEndDate": {
                    "alertText": "* Giá trị Từ ngày phải nhỏ hơn hoặc bằng giá trị Đến ngày"
                },
                "customRegex": {
                    "alertText": "* Phải là số Viettel"
                },
                "viettelPhonenumber": {
                    "regex": /^8496\d{7}$|^0?96\d{7}$|^8497\d{7}$|^0?97\d{7}$|^8498\d{7}$|^0?98\d{7}$|^8416\d{8}$|^0?16\d{8}$/,
                    "alertText": "* Phải là số Viettel"
                }
                
                // end truongtx5: them cac dieu kien validate
            };
        }
    };
    $.validationEngineLanguage.newLang();
})(jQuery);