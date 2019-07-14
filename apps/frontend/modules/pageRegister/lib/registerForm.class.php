<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 7/28/15
 * Time: 11:36 PM
 */

class registerForm extends Basecsdl_lylichhoivienForm
{
    public function configure()
    {
        $years = range(date('Y'), date('Y') - 75);
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_at'], $this['updated_at']);
        $this->widgetSchema['hodem'] = new sfWidgetFormInputText(array());
        $this->validatorSchema['hodem'] = new sfValidatorString(array('required' => true, 'trim' => true, 'max_length' => 255));

        $this->widgetSchema['ngaysinh'] =new sfWidgetFormDateTime(array(
            'date' => array(
                'format' => '%day%/%month%/%year%',
                'can_be_empty' => false,
                'years' => array_combine($years, $years)
            ),
            'format' => '%date%',
            'default' => date('Y/m/d H:i', time())
        ));
        $this->validatorSchema['ngaysinh'] =  new sfValidatorDateTime(array('required' => true));

        $this->widgetSchema['gioitinh'] = new sfWidgetFormChoice(array(
            'choices' => $this->getSex(),
            'multiple' => false,
            'expanded' => false));
        $this->validatorSchema['gioitinh'] = new sfValidatorChoice(array(
            'required' => false,
            'choices' => array_keys($this->getSex()),));

        $this->widgetSchema['nghenghiep_id'] = new sfWidgetFormChoice(array(
        'choices' => $this->getJob(),
        'multiple' => false,
        'expanded' => false));
        $this->validatorSchema['nghenghiep_id'] = new sfValidatorChoice(array(
            'required' => false,
            'choices' => array_keys($this->getJob()),));

        $this->widgetSchema['donvi_id'] = new sfWidgetFormChoice(array(
            'choices' => $this->getDonVi(),
            'multiple' => false,
            'expanded' => false));
        $this->validatorSchema['donvi_id'] = new sfValidatorChoice(array(
            'required' => false,
            'choices' => array_keys($this->getDonVi()),));

        $this->widgetSchema['matinh'] = new sfWidgetFormChoice(array(
            'choices' => $this->getCity(),
            'multiple' => false,
            'expanded' => false));
        $this->validatorSchema['matinh'] = new sfValidatorChoice(array(
            'required' => false,
            'choices' => array_keys($this->getCity()),));

        $this->widgetSchema['maquan'] = new sfWidgetFormChoice(array(
            'choices' => $this->getProvince(),
            'multiple' => false,
            'expanded' => false));
        $this->validatorSchema['maquan'] = new sfValidatorChoice(array(
            'required' => false,
            'choices' => array_keys($this->getProvinceKey()),));

        $this->widgetSchema['images'] = new sfWidgetFormInputFileEditable(array(
            'label' => ' ',
            'file_src' => VtHelper::getUrlImagePathThumb(sfConfig::get('app_member_images'), $this->getObject()->getImages()),
            'is_image' => true,
            'edit_mode' => !$this->isNew(),
            'template' => '<div>%file%<br />%input%</div>',
        ));

        $this->validatorSchema['images'] = new sfValidatorFileViettel(
            array(
                'max_size' => sfConfig::get('app_image_maxsize', 999999),
                'mime_types' => array('image/jpeg','image/jpg', 'image/png', 'image/gif'),
                'path' => sfConfig::get("app_upload_member") . '/' . sfConfig::get('app_member_images'),
                'required' => false
            ),
            array(
                'mime_types' => $i18n->__('Bạn phải tải lên file hình ảnh.'),
                'max_size' => $i18n->__('Tối đa 5MB')
            ));

        $this->widgetSchema->setNameFormat('csdl_lylichhoivien[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

    protected function getSex()
    {
        return array(
            '0' => 'Nữ',
            '1' => 'Nam'
        );
    }

    protected function getJob(){
        $arrJobs = array(''=>'----- Chọn nghề nghiệp -----');
        $jobs = csdl_dmnghenghiepTable::getJob()->fetchArray();
        if(count($jobs)>0){
            foreach($jobs as $value){
                $arrJobs[$value['id']] = $value['tendanhmuc'];
            }
        }
        return $arrJobs;
    }

    protected function getDonVi(){
        $arrJobs = array(''=>'----- Chọn đơn vị -----');
        $jobs = csdl_coquanbaochiTable::getJob()->fetchArray();
        if(count($jobs)>0){
            foreach($jobs as $value){
                $arrJobs[$value['id']] = $value['tendonvi'];
            }
        }
        return $arrJobs;
    }

    protected function getCity(){
        $arrJobs = array(''=>'----- Chọn tỉnh/thành phố -----');
        $jobs = csdl_areaTable::getCity()->fetchArray();
        if(count($jobs)>0){
            foreach($jobs as $value){
                $arrJobs[$value['PROVINCE']] = $value['NAME'];
            }
        }
        return $arrJobs;
    }

    protected function getProvince(){
        $arrJobs = array(''=>'----- Chọn quận/huyện -----');
        return $arrJobs;
    }
    protected function getProvinceKey(){
        $arrJobs = array(''=>'----- Chọn quận/huyện -----');
        $jobs = csdl_areaTable::getProvinceKey()->fetchArray();
        if(count($jobs)>0){
            foreach($jobs as $value){
                $arrJobs[$value['DISTRICT']] = $value['NAME'];
            }
        }
        return $arrJobs;
    }
}
