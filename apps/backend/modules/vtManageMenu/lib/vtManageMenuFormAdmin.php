<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 12/16/13
 * Time: 2:45 PM
 * To change this template use File | Settings | File Templates.
 */
class vtManageMenuFormAdmin extends BaseVtpMenuForm
{
    public function configure()
    {
        $i18n = sfContext::getInstance()->getI18N();

        unset($this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by'], $this['slug'], $this['priority']);

        $arr = array(
            '-1' => $i18n->__('Loại Menu'),
            '0' => $i18n->__('Menu chính'),
            '1' => $i18n->__('Menu footer'),
        );
        $this->widgetSchema['type'] = new sfWidgetFormSelect(array(
            'choices' => $arr,
            'multiple' => false,
        ));
        $this->validatorSchema['type'] = new sfValidatorChoice(array(
            'required' => true,
            'choices' => array_keys($arr),
        ));
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
                'max_size' => sfConfig::get('app_image_maxsize', 999999),
                'mime_types' => array('image/jpeg','image/jpg', 'image/png', 'image/gif'),
                'path' => sfConfig::get("sf_upload_dir") . '/' . sfConfig::get('app_category_images'),
                'required' => false
            ),
            array(
                'mime_types' =>$i18n->__('Dữ liệu không hợp lệ hoặc định dạng không đúng.'),
                'max_size' =>$i18n->__('Tối đa 5MB')
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
        $arrType=array('1'=>$i18n->__('Bài viết'),'0'=>$i18n->__('Link'),'2'=>$i18n->__('Trang'));
        $this->widgetSchema['type_link'] = new sfWidgetFormChoice(array(
            'choices' => $arrType,
            'multiple' => false,
            'expanded' => false
        ),array('onchange'=>'changeSelectLink()', 'class' =>'changeLink'));
        $this->validatorSchema['type_link'] = new sfValidatorChoice(array(
            'required' => true,
            'choices' => array_keys($arrType),
        ));

        $this->widgetSchema['link_content'] = new sfWidgetFormChoice(array(
            'choices' => $this->getHtmlContent(),
            'multiple' => false,
            'expanded' => false
        ));
        $this->validatorSchema['link_content'] = new sfValidatorChoice(array(
            'required' => false,
            'choices' => array_keys($this->getHtmlContent()),
        ));
        $this->widgetSchema['link_text'] = new sfWidgetFormInputText(array(),array('disabled'=>'false','style' => 'width:500px'));
        $this->validatorSchema['link_text'] = new sfValidatorString(array('max_length' => 255, 'required' => false,'trim'=>true));
        $this->widgetSchema['link'] = new sfWidgetFormInputText(array(),array('disabled'=>'false','style' => 'width:500px'));

        $this->widgetSchema['page'] = new sfWidgetFormChoice(array(
            'choices' => $this->getPage(),
            'multiple' => false,
            'expanded' => false
        ),array('disabled'=>'false'));
        $this->validatorSchema['page'] = new sfValidatorChoice(array(
            'required' => false,
            'choices' => array_keys($this->getPage()),
        ));
        
        $this->widgetSchema['description'] = new sfWidgetFormTextarea();
        $this->validatorSchema['description'] = new sfValidatorString(array('max_length'=> 1000, 'required' => false, 'trim'=>true));

        $this->widgetSchema['portal_id'] = new sfWidgetFormInputText(array(),array('disabled'=>'false'));
        $this->validatorSchema['portal_id'] = new sfValidatorString(array('max_length' => 25, 'required' => false,'trim'=>true));
        
    }
    public function getPage() {
        $i18n = sfContext::getInstance()->getI18N();
        $result=array();
        $result['']=$i18n->__('--Chọn trang hiển thị--');
        if(sfContext::getInstance()->getUser()->getAttribute('portal')==VtCommonEnum::portalDefault){
            $pageAttr = Attributes::getAttributesList('view_page');
        }elseif(sfContext::getInstance()->getUser()->getAttribute('portal')==VtCommonEnum::portalKhdn){
            $pageAttr = Attributes::getAttributesList('view_page_dn');
        }
        foreach ($pageAttr as $key=>$value){
            $result[$key]=$value;
        }

        return $result;
    }
    public function getHtmlContent()
    {
        $i18n = sfContext::getInstance()->getI18N();
        $result=array();
        $result['']=$i18n->__('--Chọn bài viết nội dung--');
        $lstHtml=AdHtmlTable::getAllHtml(sfContext::getInstance()->getUser()->getCulture(),sfContext::getInstance()->getUser()->getAttribute('portal',0));
        foreach ($lstHtml as $item){
            $link= '@'.$item->prefix_path .'?slug='.$item->slug;
            $result[$link]=$item->getName();
        }
        return $result;
    }

    //Hàm đệ quy lấy các chuyên mục con
    public static function getMenuByParent($menu_id){
        $strCat=$menu_id;
        $lstCat=VtpMenuTable::getMenuByParentID(VtCommonEnum::MainMenu,$menu_id,sfContext::getInstance()->getUser()->getAttribute('portal',0));
        if(count($lstCat)>0){
            foreach($lstCat as $item){
                $strCat .=','. self::getMenuByParent($item->id);
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
            $lstChild=self::getMenuByParent($id);
        }

        $result=VtpMenuTable::getMenuByType(VtCommonEnum::MainMenu,$lstChild,sfContext::getInstance()->getUser()->getAttribute('portal',0));
        return $result;
    }

    private function doBindType(&$values) {

        $values['type'] = VtCommonEnum::MainMenu;
        $values['portal_id'] = sfContext::getInstance()->getUser()->getAttribute('portal',0);

        $item = $values['type_link'];
        $strItem="";
        if ($item=='1'){
            $strItem=$values['link_content'];
        }elseif ($item=='0'){
            $strItem=$values['link_text'];
        }
        if (strlen($strItem) <256)
            $values['link'] = $strItem;

        $values['name']=trim($values['name']);
        $values['description']=trim($values['description']);
    }

    protected function doBind(array $values) {
        $this->doBindType($values);
        parent::doBind($values);
    }
    
}
