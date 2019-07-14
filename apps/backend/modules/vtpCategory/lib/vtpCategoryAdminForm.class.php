<?php

/**
 * vtpCategory form.
 *
 * @package    vtp
 * @subpackage form
 * @author     LamNQ
 * @version    2
 */
class vtpCategoryAdminForm extends BaseVtpCategoryForm
{

    public function configure()
    {
        $i18n = sfContext::getInstance()->getI18N();

        unset($this['created_at'], $this['updated_at'], $this['slug'], $this['priority']);//

        $arr = array(
          '' => $i18n->__('Loại chuyên mục'),
          'N' => $i18n->__('Tin tức'),
          'S' => $i18n->__('Dịch vụ'),
        );
        $this->widgetSchema['type'] = new sfWidgetFormSelect(array(
            'choices' => $arr,
            'multiple' => false,
          ));
        $this->validatorSchema['type'] = new sfValidatorChoice(array(
            'required' => true,
            'choices' => array_keys($arr),
          ));

        $this->widgetSchema['description'] =   new sfWidgetFormTextarea();
        $this->validatorSchema['description'] = new sfValidatorString(array('required' => false, 'trim'=>true, 'max_length' => 1000));
        
        $this->widgetSchema['name'] = new sfWidgetFormInput();
        $this->validatorSchema['name'] = new sfValidatorString(array('required'=> true, 'max_length'=>255, 'trim'=>true));
        
        $this->widgetSchema['link'] = new sfWidgetFormInput();
        $this->validatorSchema['link'] = new sfValidatorString(array('required'=> false, 'trim'=>true));

        //ngoctv sua image_path
        $this->widgetSchema['image_path'] = new sfWidgetFormInputFileEditable(array(
            'label' => ' ',
            'file_src' => VtHelper::getUrlImagePathThumb(sfConfig::get('app_category_images'), $this->getObject()->getImagePath()),
            'is_image' => true,
            'edit_mode' => !$this->isNew(),
            'template' => '<div>%file%<br />%input%</div>',
          ));
        $this->validatorSchema['image_path'] = new sfValidatorFileViettel(
            array(
              'validated_file_class' => 'sfResizeMediumThumbnailImage',
              'max_size' => sfConfig::get('app_image_maxsize', 5242880),
              'mime_types' => array('image/jpeg','image/jpg', 'image/png', 'image/gif'), 
              'path' => sfConfig::get("sf_upload_dir") . '/' . sfConfig::get('app_category_images'),
              'required' => false
            ),
            array(
              'mime_types' =>  $i18n->__('Dữ liệu không hợp lệ hoặc định dạng không đúng.'),
              'max_size' =>  $i18n->__('Tối đa 5MB')
            )
        );
        $this->widgetSchema['parent_id'] = new sfWidgetFormChoice(array(
                                    'choices' => $this->getParentByType($this->getObject()->get('id')),
                                    'multiple' => false,
                                    'expanded' => false    
          ));
        $this->validatorSchema['parent_id'] = new sfValidatorChoice(array(
            'required' => FALSE,
            'choices' => array_keys($this->getParentByType($this->getObject()->get('id'))),
          ));
        //ngoctv them permission
        $this->widgetSchema['permission'] = new sfWidgetFormChoice(array(
                                    'choices' => $this->getPermission(),
                                    'multiple' => true,
                                    'expanded' => true    
          ));
        $this->validatorSchema['permission'] = new sfValidatorString(array('required' => false));
        if(!$this->isNew()){
            $this->widgetSchema['slug'] = new sfWidgetFormPlainText(array(
                'value_data' => $this->getObject()->getSlug()
            ));
        }
        $this->widgetSchema['portal_id'] = new sfWidgetFormInputText(array(),array('disabled'=>'false'));
        $this->validatorSchema['portal_id'] = new sfValidatorString(array('max_length' => 25, 'required' => false,'trim'=>true));

//        $this->widgetSchema['meta'] = new sfWidgetFormTextarea();
//        $this->validatorSchema['meta'] = new sfValidatorString(array('required' => false, 'max_length' => 255));

//        $this->widgetSchema['keywords'] = new sfWidgetFormTextarea();
//        $this->validatorSchema['keywords'] = new sfValidatorString(array('required' => false, 'max_length' => 1000));

        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'checkValidator'))));
    }

    public function checkValidator($validator, $values){
        //
        $i18n = sfContext::getInstance()->getI18N();

//        if (empty($values['permission'])){
//            $error1 = new sfValidatorError($validator,$i18n->__('Bạn phải chọn quyền cho chuyên mục.'));
//            throw new sfValidatorErrorSchema($validator, array('permission' => $error1));
//        }

        return $values;
    }
//Hàm đệ quy lấy các chuyên mục con
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
     protected function getParentByType($id){
         $lstChild='';
         if($id!=null){
             $lstChild=self::getCategoryByParent($id);
         }
        $result=VtpCategoryTable::getCategoryByType(VtCommonEnum::NewCategory,sfContext::getInstance()->getUser()->getAttribute('portal',0),$lstChild);
        return $result;
    }
    
    protected function getPermission()
    {
        $arrPermission=  sfGuardPermissionTable::getListPermission();
        $result=array();
        foreach ($arrPermission as $permission)
        {
            $result[$permission->id]=$permission->name;
        }
        return $result;
    }

    private function doBindPermission(&$values) {
        if (empty($values['permission']))
            return;
        $attrs = $values['permission'];
        $total = '';
        if (is_array($attrs)) {
            foreach ($attrs as $val) {
                $total = $total . $val . ',';
            }
        }
        $values['permission'] = $total;
        $values['type'] = VtCommonEnum::NewCategory;
        $values['name']=trim($values['name']);
        $values['description']=trim($values['description']);

        return $total;
    }

    protected function doBind(array $values) {
        $values['portal_id'] = sfContext::getInstance()->getUser()->getAttribute('portal',0);
        $this->doBindPermission($values);
        parent::doBind($values);
    }
    
    public function getCurrentPermission() {
        $arrPermission = VtpCategoryPermissionTable::getPermissionByCategory($this->object->getId());
        $strPermission='';
        foreach ($arrPermission as $permission){
            $strPermission = $strPermission . $permission->permission_id . ',';
        }
        $result = array();
        if ($strPermission!=''){
             if(VtHelper::endsWith($strPermission,',')){
                $strPermission= substr($strPermission, 0 ,strlen($strPermission)-1);
            }
            $arrPer= explode( ',',$strPermission);
            $choices = $this->getPermission();
        
            if (!empty($choices)) {
                foreach ($choices as $key => $choice) {
                    foreach ($arrPer as $permission){
                        if($key==$permission){
                            $result[] = $key;
                            
                        }
                    }
                }
            }
        }
        return $result;
    }
    
    public function updateDefaultsFromObject() {
        parent::updateDefaultsFromObject();
        $this->setDefault('permission', $this->getCurrentPermission());
    }
}
