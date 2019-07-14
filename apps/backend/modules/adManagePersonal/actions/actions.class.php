<?php

require_once dirname(__FILE__).'/../lib/adManagePersonalGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/adManagePersonalGeneratorHelper.class.php';

/**
 * adManagePersonal actions.
 *
 * @package    Vt_Portals
 * @subpackage adManagePersonal
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adManagePersonalActions extends autoAdManagePersonalActions
{
//import file excel

    public function executeImport(sfWebRequest $request)
    {
        $this->form = new adManagePersonalImport();
        if ($request->isMethod("POST")) {
            $i18n = sfContext::getInstance()->getI18N();
            $form = new BaseForm();
            $form->bind($form->isCSRFProtected() ? array($form->getCSRFFieldName() => $request->getParameter($form->getCSRFFieldName())) : array());

            if (!$form->isValid()) {
                $this->getUser()->setFlash('error', $i18n->__('Token không hợp lệ.'));
                $this->redirect('@ad_personal_import');
            }
            $this->executeImportFile($request, $this->form);
        }


    }

    public function executeImportFile(sfWebRequest $request, sfForm $form)
    {
        ini_set('max_execution_time', 360);
        ini_set('memory_limit', '-1');

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {

            try {
                //save file lên thư mục temp
                $files = $request->getFiles($form->getName());
                $file = $files['file_excel'];
                $extension = pathinfo($files['file_excel']['name'], PATHINFO_EXTENSION);
                if ($extension == 'xls' || $extension == 'xlsx') {
                    $folder = sfConfig::get('sf_cache_dir') . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR;
                    if (!is_dir($folder)) {
                        mkdir($folder, 0777, true);
                    }
                    if (move_uploaded_file($file['tmp_name'], $folder . $file['name'])) {
                        $fileUploaded = $folder . $file['name'];
                        $this->retrievingData($fileUploaded, $files);
                    }
                }
            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ? 's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            //        $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('form' => $form, 'object' => $vt_fq_as)));
        }
        else
        {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }



    }


    private function retrievingData($filePath, $files) {
        $i18n = sfContext::getInstance()->getI18N();
        $extension = pathinfo($files['file_excel']['name'], PATHINFO_EXTENSION);
        if ($extension == 'xls') {
            $objReader = PHPExcel_IOFactory::createReader('Excel5');
        } else {
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        }
        $objReader->setReadDataOnly(true);

        $objPHPExcel = $objReader->load($filePath);
        $objWorksheet = $objPHPExcel->getActiveSheet();

        $highestRow = $objWorksheet->getHighestRow(); // e.g. 10
        $col_success = 0;
        $import_error = array();
        $ad_personal = array();
        $col=0;
        for ($row = 2; $row <= $highestRow; $row++) {
            $full_name = trim($objWorksheet->getCellByColumnAndRow(1, $row)->getValue());
            $birthday = trim($objWorksheet->getCellByColumnAndRow(2, $row)->getValue());
            $sex = trim($objWorksheet->getCellByColumnAndRow(3, $row)->getValue());
            $phone_number = trim($objWorksheet->getCellByColumnAndRow(4, $row)->getValue());
            $email = trim($objWorksheet->getCellByColumnAndRow(5, $row)->getValue());
            $address = trim($objWorksheet->getCellByColumnAndRow(6, $row)->getValue());
            $introduction = trim($objWorksheet->getCellByColumnAndRow(7, $row)->getValue());

            try{
                $col_success++;
                $ad_personal[$col]['full_name'] =  $full_name;
                $ad_personal[$col]['birthday'] = $this->dateValidate($birthday)? date("Y-m-d",  strtotime($birthday)):null;
                $ad_personal[$col]['sex'] = $sex;
                $ad_personal[$col]['phone_number'] = $phone_number;
                $ad_personal[$col]['email'] = $email;
                $ad_personal[$col]['address'] = $address;
                $ad_personal[$col]['introduction'] = $introduction;

                $col++;
            } catch (Exception $ex) {
            }
        }
        if($ad_personal){
            //insert data
            AdPersonalTable::insertMultiPersonal($ad_personal);
        }

        //xoa file
        unlink($filePath);
        if($col_success > 0){
            $this->getUser()->setFlash('success', $i18n->__('Thêm mới thành công '). $col_success . $i18n->__(' hội viên'));
            if($import_error)
                $this->getUser()->setFlash('error', $i18n->__(count($import_error).$i18n->__(' Hội viên không hợp lệ. STT: '). implode(",", $import_error)));
            $this->redirect('@ad_personal');
        }else{
            $this->getUser()->setFlash('error', $i18n->__('Imports thất bại. Không có hội viên nào hợp lệ'));
            $this->redirect('@ad_personal_import');
        }
    }

    public function executeBatch(sfWebRequest $request)
    {
        if ($request->hasParameter('_export')) {
            $i18n = sfContext::getInstance()->getI18N();
            $form = new BaseForm();
            $form->bind($form->isCSRFProtected() ? array($form->getCSRFFieldName() => $request->getParameter($form->getCSRFFieldName())) : array());

            if (!$form->isValid()) {
                $this->getUser()->setFlash('error', $i18n->__('Token không hợp lệ.'));
                $this->redirect('@ad_personal');
            }
            $this->executeExportExcel();
        }

        if (!$ids = $request->getParameter('ids'))
        {
            $this->getUser()->setFlash('error', 'You must at least select one item.');

            $this->redirect('@ad_personal');
        }

        if (!$action = $request->getParameter('batch_action'))
        {
            $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

            $this->redirect('@ad_personal');
        }

        if (!method_exists($this, $method = 'execute'.ucfirst($action)))
        {
            throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
        }

        if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
        {
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }

        $validator = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'AdPersonal'));
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

        $this->redirect('@ad_personal');
    }

    public function executeExportExcel()
    {
        $results = AdPersonalTable::getListPersonal();
        $numResult   = count($results);
        $i18n = $this->getContext()->getI18N();

        //lay ra so dong cho 1 sheet tu file app.yml
        $maxRow=  sfConfig::get('app_excel_max_row',1000);
        //xac dinh so sheet can tao
        $numSheet=ceil($numResult/$maxRow);
        var_dump($numSheet);
        $objPHPExcel = new sfPhpExcel();
        if ($numResult > 0) {
            ini_set('max_execution_time', 3000);
            ini_set('memory_limit', '-1');
            for($j=0; $j<$numSheet; $j++) {
                $result = AdPersonalTable::getListPersonal($maxRow,$j*$maxRow);
                //do report
                $objPHPExcel->setActiveSheetIndex($j);
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize('11');
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth('20');
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth('20');
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth('20');
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth('20');
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth('20');
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth('30');
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth('40');
                // $objPHPExcel->setActiveSheetIndex(0);

                // Noinh edit
                $objPHPExcel->getActiveSheet()->setCellValue('E2', $i18n->__('DANH SÁCH HỘI VIÊN'));
                //$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('E2')->getFont()->setBold(true);
                //$objPHPExcel->getActiveSheet()->mergeCells('A4:D4');
                $objPHPExcel->getActiveSheet()->setCellValue('A6', $i18n->__('STT'));
                $objPHPExcel->getActiveSheet()->setCellValue('B6', $i18n->__('Họ tên'));
                $objPHPExcel->getActiveSheet()->setCellValue('C6', $i18n->__('Ngày sinh'));
                $objPHPExcel->getActiveSheet()->setCellValue('D6', $i18n->__('Giới tính'));
                $objPHPExcel->getActiveSheet()->setCellValue('E6', $i18n->__('Điện thoại'));
                $objPHPExcel->getActiveSheet()->setCellValue('F6', $i18n->__('Email'));
                $objPHPExcel->getActiveSheet()->setCellValue('G6', $i18n->__('Địa chỉ'));
                $objPHPExcel->getActiveSheet()->setCellValue('H6', $i18n->__('Giới thiệu'));

                $objPHPExcel->getActiveSheet()->duplicateStyleArray(
                    array('fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID),
                        'borders' => array(
                            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                        ),
                        'font' => array('bold' => true),
                        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
                    ), "A6:H6"
                );

                foreach ($result as $key => $personal) {
                    $index = $key + 7;
                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $index, $key + 1 + $j*$maxRow);
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $index, $personal['full_name']);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $index, $personal['birthday']);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $index, $personal['sex'] );
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $index, $personal['phone_number'] ,PHPExcel_Cell_DataType::TYPE_STRING );
                    $objPHPExcel->getActiveSheet()->setCellValueExplicit('F' . $index, $personal['email']);
                    $objPHPExcel->getActiveSheet()->setCellValueExplicit('G' . $index, $personal['address']);
                    $objPHPExcel->getActiveSheet()->setCellValueExplicit('H' . $index, $personal['introduction']);

                }
                $objPHPExcel->getActiveSheet()->setTitle('Sheet ' . ($j+1));
                //tao sheet
                $objPHPExcel->createSheet();
            }

        } else {
            $objPHPExcel->getActiveSheet()->mergeCells('A7:D7');
            $objPHPExcel->getActiveSheet()->setCellValue('A7', $i18n->__('Không có dữ liệu'));
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $fileName = date('Ymd') . '_danh_sach_hoi_vien.xlsx';
        $path = sfConfig::get('sf_cache_dir') . '/' . $fileName;
        $objWriter->save($path);
        @header('Content-type: application/octetstream');
        @header("Pragma: public");
        @header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        @header('Content-Disposition: attachment; filename="' . $fileName . '"');
        ob_end_clean();
        ob_start();
        readfile($path);
        $size = ob_get_length();
        header("Content-Length: $size");
        ob_end_flush();
        unlink($path);
        die;
    }

    public function dateValidate($pDate) {
        $chDate = date('Y-m-d', strtotime($pDate));
        if($chDate != '1970-01-01')
            return true;
        else
            return false;
    }
}
