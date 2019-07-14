<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vtManageArticlesFormAdmin
 *
 * @author ngoctv1
 */
class adArticlesEditorFormAdmin extends BaseAdArticleForm
{
    public function configure()
    {
        parent::setup();
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_by'], $this['updated_by'], $this['created_at'], $this['updated_at'], $this['lang'],
            $this['hit_count'], $this['meta'], $this['keywords']);
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'title' => new sfWidgetFormInputText(array(), array('style' => 'width:690px')),
            'slug' => new sfWidgetFormInputText(array(), array('style' => 'width:690px')),
            'alttitle' => new sfWidgetFormInputText(array(), array('style' => 'width:690px')),
            'header' => new sfWidgetFormTextarea(array(), array('style' => 'width:690px')),
            'meta' => new sfWidgetFormTextarea(array(), array('style' => 'width:690px')),
            'keywords' => new sfWidgetFormTextarea(array(), array('style' => 'width:690px')),
            'body' => new sfWidgetFormCKEditor(
                array(
                    'jsoptions' => array('toolbar' => 'Full',
                        'width' => '700',
                        'height' => '200'),
                )),

            'image_path' => new sfWidgetFormInputFileEditable(array(
                'label' => ' ',
                'file_src' => VtHelper::getUrlImagePathThumb(sfConfig::get('app_article_images'), $this->getObject()->getImagePath()),
                'is_image' => true,
                'edit_mode' => !$this->isNew(),
                'template' => '<div>%file%<br />%input%</div>',
            )),
            'attributes' => new sfWidgetFormChoice(array('choices' => $this->getAttrs(),
                'multiple' => true,
                'expanded' => true)),
            'priority' => new sfWidgetFormInputText(array('default' => 0), array('size' => 5, 'maxlength' => 5)),

            'author' => new sfWidgetFormInputText(),
            'other_link' => new sfWidgetFormTextarea(),
            'is_active' => new sfWidgetFormChoice(array(
                'choices' => $this->getStatus(),
                'multiple' => false,
                'expanded' => false)),
            'is_hot' => new sfWidgetFormInputCheckbox(),

            'category_id' => new sfWidgetFormChoice(array(
                'choices' => $this->getParentByType(),
                'multiple' => false,
                'expanded' => false
            )),

        ));


        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'title' => new sfValidatorString(array('max_length' => 255, 'required' => true, 'trim' => true)),
            'slug' => new sfValidatorString(array('max_length' => 255, 'required' => !$this->isNew(), 'trim' => true)),
            'alttitle' => new sfValidatorString(array('max_length' => 255, 'required' => false, 'trim' => true)),
            'header' => new sfValidatorString(array('max_length' => 1000, 'required' => true, 'trim' => true)),
            'meta' => new sfValidatorString(array('max_length' => 1000, 'required' => false, 'trim' => true)),
            'keywords' => new sfValidatorString(array('max_length' => 1000, 'required' => false, 'trim' => true)),
            'body' => new sfValidatorString(
                array(
                    'required' => false,
                    'trim' => true,
                )),

            'image_path' => new sfValidatorFileViettel(
                array(
                    'validated_file_class' => 'sfResizeMediumThumbnailImage',
                    'max_size' => sfConfig::get('app_image_maxsize', 999999),
                    'mime_types' => array('image/jpeg', 'image/jpg', 'image/png', 'image/gif'),
                    'path' => sfConfig::get("sf_upload_dir") . '/' . sfConfig::get('app_article_images'),
                    'required' => false
                ),
                array(
                    'mime_types' => $i18n->__('Chỉ được upload các file có định dạng .jpg, .gif, .png'),
                    'max_size' => $i18n->__('Dung lượng tối đa 5MB'),
                    'invalid' => $i18n->__('Chỉ được upload các file có định dạng .jpg, .gif, .png')
                )),
            'attributes' => new sfValidatorInteger(array('required' => false)),
            'priority' => new sfValidatorInteger(array('required' => false, "min" => 0, 'max' => 99999, 'trim' => true), array('min' => $i18n->__('Thứ tự phải là số nguyên dương'), 'max' => $i18n->__('Tối đa 5 ký tự'), 'invalid' => $i18n->__('Thứ tự phải là số nguyên dương'))),

            'author' => new sfValidatorString(array('max_length' => 255, 'required' => false, 'trim' => true)),
            'other_link' => new sfValidatorString(array('required' => false, 'trim' => true)),
            'is_active' => new sfValidatorChoice(array(
                'required' => false,
                'choices' => array_keys($this->getStatus()),)),
            'is_hot' => new sfValidatorBoolean(array('required' => false)),
            'category_id' => new sfValidatorChoice(array(
                'required' => true,
                'choices' => array_keys($this->getParentByType()),)),

        ));
        if ($this->isNew()) {
            unset($this['slug']);
        }


        //Kiểm soát thời hạn bản tin thông qua quyền admin và duyệt
        if (sfContext::getInstance()->getUser()->isSuperAdmin() || sfContext::getInstance()->getUser()->hasCredential('admin') || sfContext::getInstance()->getUser()->hasCredential('news_public')) {
            $this->widgetSchema['published_time'] = new sfWidgetFormVnDatePicker(array(), array('readonly' => true));
            $this->widgetSchema['expiredate_time'] = new sfWidgetFormVnDatePicker(array(), array('readonly' => true));
            $this->validatorSchema['published_time'] = new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d H:i:s'));
            $this->validatorSchema['expiredate_time'] = new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d H:i:s'));
        }
        $this->widgetSchema['item_list'] = new sfWidgetFormViettelTable(array(
            'label' => 'Tin liên quan',
            'model' => 'AdArticle',
            'table_method' => 'getArticleArrayId',
            'relation_type' => 'ONE2MANY',
            'search_method' => 'LoadArticle',
            'visible_columns' => array('name'),
            'button_text' => $i18n->__('Chọn tin liên quan'),
            'modal_header' => $i18n->__('Tin liên quan'),
            'visible_column_text' => array($i18n->__('Tiêu đề')),
            'no_result_text' => $i18n->__('Không có kết quả tìm kiếm.')
        ));
        $this->validatorSchema['item_list'] = new sfValidatorString(array('required' => false));
        // $this->validatorSchema->setPostValidator(new sfValidatorDoctrineUnique(array('model' => 'VtpArticle', 'column' => array('slug'))));

        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'checkValidator'))));
        $this->widgetSchema->setNameFormat('ad_article[%s]');
    }


    protected function getStatus()
    {
        $i18n = sfContext::getInstance()->getI18N();
        $arrStatus = array();
        $arrStatus['-1'] = $i18n->__('Bản nháp');
        if (sfContext::getInstance()->getUser()->isSuperAdmin() || sfContext::getInstance()->getUser()->hasCredential('admin')) {
            $arrStatus['0'] = $i18n->__('Chờ duyệt');
            $arrStatus['1'] = $i18n->__('Phê duyệt');
            $arrStatus['2'] = $i18n->__('Đăng bài');
        } else {

            if (sfContext::getInstance()->getUser()->hasCredential('news_editor')) {
                $arrStatus['0'] = $i18n->__('Chờ duyệt');
            }
            if (sfContext::getInstance()->getUser()->hasCredential('news_approved')) {
                $arrStatus['1'] = $i18n->__('Phê duyệt');
            }
            if (sfContext::getInstance()->getUser()->hasCredential('news_public')) {
                $arrStatus['2'] = $i18n->__('Đăng bài');
            }
        }
        return $arrStatus;
    }

    public static function getCategoryByParent($category_id){
        $strCat=$category_id;
        $lstCat=VtpCategoryTable::getCategoryByParentID(VtCommonEnum::NewCategory,$category_id,sfContext::getInstance()->getUser()->getAttribute('portal',0));
        if(count($lstCat)>0){
            foreach($lstCat as $item){
                $strCat .=','. self::getCategoryByParent($item->id);
            }
        }
        if (VtHelper::endsWith($strCat,',')){
            $strCat=substr($strCat, 0 ,strlen($strCat)-1);
        }
        return $strCat;
    }

    protected function getParentByType($id=null)
    {
        $lstChild='';
        if($id!=null){
            $lstChild=self::getCategoryByParent($id);
        }
        $result=VtpCategoryTable::getCategoryByType(VtCommonEnum::NewCategory,sfContext::getInstance()->getUser()->getAttribute('portal',0),$lstChild);
        return $result;
    }

    public function getAttrs()
    {
        $articleAttr = Attributes::getAttributesList('promotion_attributes');

        return $articleAttr;
    }

    private function doBindAttributes(&$values)
    {
        $values['title'] = trim($values['title']);
        $values['header'] = trim($values['header']);

        if (empty($values['attributes']))
            return;
        $attrs = $values['attributes'];
        $total = 0;
        if (is_array($attrs)) {
            foreach ($attrs as $val) {
                $total += intval($val);
            }
        }
        $values['attributes'] = $total;
        return $total;
    }

    private function doBindItem(&$values)
    {
        if (empty($values['item_list']))
            return;
        $item = $values['item_list'];
        $strItem = "";
        if (is_array($item)) {
            foreach ($item as $val) {
                $strItem = $strItem . $val . ',';
            }
        }
        // kiem tra xem ket thuc chuoi co phai la ',' khong, neu dung thi thuc hien replace di
        if (VtHelper::endsWith($strItem, ',')) {
            $strItem = substr($strItem, 0, strlen($strItem) - 1);
        }
        //var_dump($strItem); die;
        $values['item_list'] = $strItem;
        return $strItem;
    }

    protected function doBind(array $values)
    {

        $this->doBindAttributes($values);
        $this->doBindItem($values);
        parent::doBind($values);
    }

    /**
     *
     * Ham tra ve cac attribute hien tai
     */
    public function getCurrentAttributes()
    {
        $attributes = $this->object->getAttributes();
        $choices = $this->getAttrs();

        $result = array();

        if (!empty($choices)) {
            foreach ($choices as $key => $choice) {
                if (($attributes & $key))
                    $result[] = $key;
            }
        }
        return $result;
    }

    public function updateDefaultsFromObject()
    {
        parent::updateDefaultsFromObject();
        $this->setDefault('attributes', $this->getCurrentAttributes());
        if (!$this->isNew()) {
            $item_list = AdArticlesRelatedTable::getArticleRelated($item_list = $this->object->id);
            if (!empty($item_list)) {
                $this->setDefault('item_list', explode(",", $item_list));
            }
        }
    }


    public function checkValidator($validator, $values)
    {
        //
        $i18n = sfContext::getInstance()->getI18N();
        $error1 = "";

        if ($values['published_time'] != null && $values['expiredate_time'] != null) {
            if (strtotime($values['published_time']) > strtotime($values['expiredate_time'])) {
                $error1 = new sfValidatorError($validator, $i18n->__('Ngày đăng bài phải nhỏ hơn ngày kết thúc.'));
            }
        }
        if ($error1 != "") {
            throw new sfValidatorErrorSchema($validator, array('expiredate_time' => $error1));
        }
        return $values;
    }
}
