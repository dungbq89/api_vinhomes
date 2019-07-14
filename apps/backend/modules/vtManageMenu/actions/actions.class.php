<?php

require_once dirname(__FILE__).'/../lib/vtManageMenuGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/vtManageMenuGeneratorHelper.class.php';

/**
 * vtManageMenu actions.
 *
 * @package    Vt_Portals
 * @subpackage vtManageMenu
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vtManageMenuActions extends autoVtManageMenuActions
{
    //chuyển sang trang sửa
    protected function executeBatchEdit(sfWebRequest $request)
    {

        $ids = $request->getParameter('ids');
        $vtp_menu=VtpMenuTable::getInstance()->createQuery()
            ->select('name, parent_id, level, priority')
            ->Where('id=?',$ids[0])->fetchOne();
        $this->redirect(array('sf_route' => 'vtp_menu_edit', 'sf_subject' => $vtp_menu));
    }
    //Lên trên
    protected function executeBatchUp(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids');
        $this->MoveMenu($ids[0],'UP');
    }
    //Xuống dưới
    protected function executeBatchDown(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids');
        $this->MoveMenu($ids[0],'DOWN');
    }
    //Sang trái
    protected function executeBatchLeft(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids');
        $this->MoveMenu($ids[0],'LEFT');
    }
    //Sang phải
    protected function executeBatchRight(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids');
        $this->MoveMenu($ids[0],'RIGHT');
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

    //Hàm di chuyển
    public static function MoveMenu($menu_id,$type)
    {
        //$type: UP,DOWN,LEFT,RIGHT

        $catFirst=0;
        $catLast=0;
        $catLeft=0;
        $strCat=self::getMenuByParent($menu_id);
        $lstMenu=VtpMenuTable::getListMenu(VtCommonEnum::MainMenu,$strCat);
        $parent_id=0;
        foreach ($lstMenu as $vtp_menu){
            if ($vtp_menu->id==$menu_id){
                $parent_id=$vtp_menu->parent_id;
            }
        }
        //Lay danh sach chuyen muc cung mức
        $lstMenuLevel=VtpMenuTable::getMenuByLevel(VtCommonEnum::MainMenu,$parent_id);
        $i=1;
        foreach ($lstMenuLevel as $item){
            if($i==1){
                $catFirst=$item->id;
            }
            if($i==count($lstMenuLevel)){
                $catLast=$item->id;
            }
            if($item->level==0){
                $catLeft=$item->id;
            }
            $i=$i+1;
        }
        //        echo $catLeft;die;
        switch ($type){
            case "UP":
                //Nếu đã là bản ghi đầu tiên cùng cấp thì không thực hiện di chuyển lên trên
                if($catFirst==$menu_id){
                    break;
                }
                foreach ($lstMenuLevel as $item ){
                    if ($item->id!==$menu_id){
                        $priority=$item->priority;
                        $catUp=$item->id;
                    }
                    if ($item->id==$menu_id){
                        break;
                    }
                }
//
                foreach ($lstMenu as $vtp_menu){
                    if ($vtp_menu->id==$menu_id){
                        $vtp_menu->priority= $priority;
                        $vtp_menu->save();
                        $priority=$priority+1;
                    }else{
                        $vtp_menu->priority= $priority;
                        $vtp_menu->save();
                        $priority=$priority+1;
                    }
                }
//
                $strCat=self::getMenuByParent($catUp);
                $lstMenu=VtpMenuTable::getListMenu(VtCommonEnum::MainMenu,$strCat);
                foreach ($lstMenu as $vtp_menu){
                    if ($vtp_menu->id==$catUp){
                        $vtp_menu->priority= $priority;
                        $vtp_menu->save();
                        $priority=$priority+1;
                    }else{
                        $vtp_menu->priority= $priority;
                        $vtp_menu->save();
                        $priority=$priority+1;
                    }
                }

                break;
            case "DOWN":
                //Neu la ban ghi cuoi cung trong mot cap thi khong thuc hien di chuyen xuong duoi
                if($catLast==$menu_id){
                    break;
                }
                $flag=false;
                foreach ($lstMenuLevel as $item ){
                    if ($flag==true){
                        $catDown=$item->id;
                        break;
                    }
                    if ($item->id==$menu_id){
                        $priority=$item->priority;
                        $flag=true;
                    }
                }
//                var_dump($menu_id);die;
                $strCat=self::getMenuByParent($catDown);

                $lstCatDown=VtpMenuTable::getListMenu(VtCommonEnum::MainMenu,$strCat);
                foreach ($lstCatDown as $vtp_menu){
                    if ($vtp_menu->id==$catDown){
                        $vtp_menu->priority= $priority;
                        $vtp_menu->save();
                        $priority=$priority+1;
                    }else{
                        $vtp_menu->priority= $priority;
                        $vtp_menu->save();
                        $priority=$priority+1;
                    }
                }
//
                foreach ($lstMenu as $vtp_menu){
                    if ($vtp_menu->id==$menu_id){
                        $vtp_menu->priority= $priority;
                        $vtp_menu->save();
                        $priority=$priority+1;
                    }else{
                        $vtp_menu->priority= $priority;
                        $vtp_menu->save();
                        $priority=$priority+1;
                    }
                }
                break;
            case "LEFT":
                //Nếu đã là root thì không thực hiện dịch trái
                if($catLeft>0){
                    break;
                }
                //Lay danh sách category cung mức cha
                foreach ($lstMenu as $vtp_menu){
                    if($vtp_menu->id==$menu_id){
                        $parent=VtpMenuTable::getMenuById($vtp_menu->parent_id);
                        $lstCat=VtpMenuTable::getMenuByParentID(VtCommonEnum::MainMenu,$parent->parent_id,sfContext::getInstance()->getUser()->getAttribute('portal',0));
                    }
                }
                $i=1;
                $menu_id_last='0';
                foreach ($lstCat as $item)
                {
                    if($i==count($lstCat)){
                        $menu_id_last=$item->id;//dung de lay ra cac con chau cua menu cuoi cung trong danh sach level moi
                        $priority=$item->priority;
                    }
                    $i=$i+1;
                }
                //Lấy ra tất cả menu con của menu cuối cùng trong mức mới
                $strCat=self::getMenuByParent($menu_id_last);
                if ($menu_id_last!=$strCat){
                    $i=1;
                    $lstCatLast=VtpMenuTable::getListMenu(VtCommonEnum::MainMenu,$strCat);
                    foreach ($lstCatLast as $item)
                    {
                        if($i==count($lstCatLast)){
                            $priority=$item->priority;
                        }
                        $i=$i+1;
                    }
                }

//                echo $priority; die;
                //Lay danh sach category đứng sau vị trí cần chèn
                $lstParent=VtpMenuTable::getMenuByPriority(VtCommonEnum::MainMenu,$priority);

                //Chèn danh sách category vào cuối danh sách cùng mức được dịch trái
                foreach ($lstMenu as $vtp_menu){
                    if ($vtp_menu->id!=$menu_id){
                        $vtp_menu->level=$vtp_menu->level-1;
                    }elseif($vtp_menu->id==$menu_id){
                        $objCat=VtpMenuTable::getMenuById($vtp_menu->parent_id);
                        $vtp_menu->parent_id=$objCat->parent_id;
                        $vtp_menu->level=$vtp_menu->level-1;
                    }
                    $priority=$priority+1;
                    $vtp_menu->priority=$priority;
                    $vtp_menu->save();
                }

                //cập nhật lại thứ tự của các category đứng sau parent
                foreach ($lstParent as $item){
                    $priority=$priority+1;
                    $item->priority=$priority;
                    $item->save();
                }

                break;
            case "RIGHT":
                //Nếu là bản ghi đầu tiên trong danh sách thì không thực hiện dịch phải
                if($catFirst==$menu_id){
                    break;
                }
                foreach ($lstMenuLevel as $item ){
                    if ($item->id!==$menu_id){
                        $catRight=$item->id;
                    }
                    if ($item->id==$menu_id){
                        break;
                    }
                }

                foreach ($lstMenu as $vtp_menu){
                    if ($vtp_menu->id!=$menu_id){
                        $vtp_menu->level=$vtp_menu->level+1;
                        $vtp_menu->save();
                    }elseif($vtp_menu->id==$menu_id){
                        $vtp_menu->parent_id=$catRight;
                        $vtp_menu->level=$vtp_menu->level+1;
                        $vtp_menu->save();
                    }
                }
                break;
        }

    }

    public function executeIndex(sfWebRequest $request)
    {

        $this->sidebar_status = $this->configuration->getListSidebarStatus();
        $this->pager = $this->getMenuListBox();

    }

    protected function executeBatchDelete(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids');
        $i18n=sfContext::getInstance()->getI18N();
        $records = Doctrine_Query::create()
            ->from('VtpMenu')
            ->whereIn('id', $ids)
            ->andWhere('lang=?',sfContext::getInstance()->getUser()->getCulture())
            ->execute();

        foreach ($records as $record)
        {
            //Kiem tra chuyen muc duoc xoa co chuyen muc con hay khong
            $check=VtpMenuTable::getMenuByParentID(VtCommonEnum::MainMenu,$record->id,sfContext::getInstance()->getUser()->getAttribute('portal',0));
            if(count($check)<=0){
                $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $record)));
                $record->delete();
                $this->getUser()->setFlash('success', 'The selected items have been deleted successfully.');
            }else{
                $this->getUser()->setFlash('notice', $i18n->__('Bạn phải xóa các chuyên mục con trước.'));
            }
        }
        $this->redirect('@vtp_menu');
    }


    public function executeDelete(sfWebRequest $request)
    {
//        $request->checkCSRFProtection();
        $i18n = sfContext::getInstance()->getI18N();
        $form = new BaseForm();
        $form->bind($form->isCSRFProtected() ? array($form->getCSRFFieldName() => $request->getParameter($form->getCSRFFieldName())) : array());
        if (!$form->isValid())
        {
            $this->getUser()->setFlash('error', $i18n->__('Token không hợp lệ'));
            $this->redirect('@vtp_menu');
        }
        $check=VtpMenuTable::getMenuByParentID(VtCommonEnum::MainMenu,$this->getRoute()->getObject()->getId(),sfContext::getInstance()->getUser()->getAttribute('portal',0));
        if(count($check)<=0){
            $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
            if ($this->getRoute()->getObject()->delete())
            {
                $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
            }
        }else{
            $this->getUser()->setFlash('notice', $i18n->__('Bạn phải xóa các chuyên mục con trước.'));
            $this->redirect(array('sf_route' => 'vtp_menu_edit', 'sf_subject' => $this->getRoute()->getObject()));
        }
        $this->redirect('@vtp_menu');
    }
    
    public function executeBatch(sfWebRequest $request)
    {
      
        $i18n = sfContext::getInstance()->getI18N();
        $form = new BaseForm();
        $form->bind($form->isCSRFProtected() ? array($form->getCSRFFieldName() => $request->getParameter($form->getCSRFFieldName())) : array());
        if (!$form->isValid())
        {
            $this->getUser()->setFlash('error', $i18n->__('Token không hợp lệ'));
            $this->redirect('@vtp_menu');
        }
      if (!$ids = $request->getParameter('ids'))
      {
        $this->getUser()->setFlash('error', 'You must at least select one item.');

        $this->redirect('@vtp_menu');
      }

      if (!$action = $request->getParameter('batch_action'))
      {
        $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

        $this->redirect('@vtp_menu');
      }

      if (!method_exists($this, $method = 'execute'.ucfirst($action)))
      {
        throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
      }

      if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
      {
        $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
      }

      $validator = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'VtpMenu'));
      try
      {
        // validate ids
        $ids = $validator->clean($ids);

        // execute batch
        $this->$method($request);
      }
      catch (sfValidatorError $e)
      {
        $this->getUser()->setFlash('error','A problem occurs when deleting the selected items some items do not exist anymore.');
      }

      $this->redirect('@vtp_menu');
    }

    protected function getMenuListBox()
    {
        $query = $this->buildQuery();
        $query->where('type=?',VtCommonEnum::MainMenu);
//        $query->andWhere('portal_id=?',sfContext::getInstance()->getUser()->getAttribute('portal',0));
        $query->andWhere('lang=?',sfContext::getInstance()->getUser()->getCulture());
        $query->orderby('priority asc');
        $arrCat= $query->execute();

        $arrResult=array();

        foreach ($arrCat as $cat){
            $strTab='';
            if ($cat->level>0){
                for ($i=0;$i<$cat->level;$i++){
                    $strTab=$strTab.'...';
                }
            }
            $arrResult[$cat->id] = $strTab. $cat->name;
        }

        return $arrResult;
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
            $isNew= $form->getObject()->isNew();
            $oldParent_id=$form->getObject()->getParentId();
            $vals = $form->getValues();
            $oldLevel=$form->getObject()->getLevel();
            $newLevel=0;
            if( $isNew || $oldParent_id != $vals['parent_id']){
                $strCat=self::getMenuByParent($vals['parent_id']);
                if(!$isNew && $oldParent_id != $vals['parent_id']){
                    //Lay ra danh sach category chuyen muc con bị thay doi
                    $strCatNew=self::getMenuByParent($form->getObject()->getId());
                    $listChild=VtpMenuTable::getListMenu(VtCommonEnum::MainMenu,$strCatNew);
                }
            }

            try {
                $vtp_menu = $form->save();
                if ($isNew || $oldParent_id != $vals['parent_id']){
                    //Sắp xếp lại thứ tự hiển thị
                    $i=1;
                    $priority=0;
                    //Lấy các category con cùng mức
//                    $strCat=self::getMenuByParent($vtp_menu->parent_id);
                    $lstMenu=VtpMenuTable::getListMenu(VtCommonEnum::MainMenu,$strCat);
                    //Lấy thứ tự của category cuối cùng trowng danh sách
                    $count=count($lstMenu);
                    if ($count>0){
                        foreach($lstMenu as $item){
                            if($i==$count){
                                $priority=$item->priority;
                            }
                            $i=$i+1;
                        }
                    }
                    //end
                    $level=0;
                    if($vtp_menu->parent_id>0){
                        $objParent=  VtpMenuTable::getMenuById($vtp_menu->parent_id);
                        $newLevel=$objParent->level;
                        $level=$newLevel+1;
                        if($priority==0){
                            $priority=$objParent->priority;
                        }
                    }
                    //Lay danh sach category đứng sau parent
                    $lstParent=VtpMenuTable::getMenuByPriority(VtCommonEnum::MainMenu,$priority);
                    //save category
                    $vtp_menu->priority=$priority+1;
                    $vtp_menu->level=$level;
                }else{
                    if($vtp_menu->parent_id>0){
                        $objParent=  VtpMenuTable::getMenuById($vtp_menu->parent_id);
                        $newLevel=$objParent->level;
                        $level=$newLevel+1;
                        $vtp_menu->level=$level;
                    }
                }

                //Ngôn ngữ
                $vtp_menu->lang=sfContext::getInstance()->getUser()->getCulture();
                //slug

                $slug=removeSignClass::removeSign($vtp_menu->name);
                if ($slug==''){
                    $slug=VtHelper::generateString(5);
                }
                $objCat = count(VtpMenuTable::checkSlug($slug,sfContext::getInstance()->getUser()->getAttribute('portal',0),VtCommonEnum::MainMenu, $vtp_menu->id));
                while ($objCat>0){
                    $slug=$slug.'_'.VtHelper::generateString(5);
                    $objCat = count(VtpMenuTable::checkSlug($slug,sfContext::getInstance()->getUser()->getAttribute('portal',0),VtCommonEnum::MainMenu,$vtp_menu->id));
                }
                $vtp_menu->slug=$slug;
                //xử lý đường link khi chọn Trang
                $vals = $form->getValues();
                if($vals['type_link']=='2'){
                    $id_cat = $request->getParameter('category_type');
                    $slug_category = '';
                    if(!empty($id_cat) && $id_cat !=null){
                        $vtp_menu->link='@'.$vals['page'].'?slug='.$id_cat;
                    }
//                    elseif($id_cat==0 && $id_cat !=null){
                    else{
                        $vtp_menu->link='@'.$vals['page'];
                    }
//                    else{
//                        $vtp_menu->link='@'.$vals['page'].'?slug='.$slug;
//                    }
                }
                $vtp_menu->save();
                //Ngoctv: 01/07/2014
                $priority=$vtp_menu->priority;
                //Edit thay doi cha: Cap nhat lai thu thu cua chuyen muc con ben trong
                if (!$isNew && $oldParent_id != $vals['parent_id']){
                    if(isset($listChild)){

                        foreach ($listChild as $item){
                            if($vtp_menu->id!=$item->id){
                                if($vtp_menu->level<$oldLevel){
                                    //giam level
                                    $item->level=($item->level-1)?:0;
                                }
                                if($vtp_menu->level>$oldLevel){
                                    //tang level
                                    $item->level=$item->level+$newLevel+1;
                                }
                                $priority =$priority+1;
                                $item->priority=$priority;
                                $item->save();
                            }
                        }
                    }
                }
                //cập nhật lại thứ tự của các category đứng sau parent
                if(isset($lstParent)){
                    foreach ($lstParent as $item){
                        if (!isset($strCatNew) || !in_array($item->id,explode(',',$strCatNew))) {
                            $priority=$priority+1;
                            $item->priority=$priority;
                            $item->save();
                        }

                    }
                }

            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('form' => $form, 'object' => $vtp_menu)));

            if ($request->hasParameter('_save_and_exit'))
            {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect('@vtp_menu');
            } elseif ($request->hasParameter('_save_and_add'))
            {
                $this->getUser()->setFlash('success', $notice.' You can add another one below.');

                $this->redirect('@vtp_menu_new');
            }
            else
            {
                $this->getUser()->setFlash('success', $notice);

                $this->redirect(array('sf_route' => 'vtp_menu_edit', 'sf_subject' => $vtp_menu));
            }
        }
        else
        {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }
}
