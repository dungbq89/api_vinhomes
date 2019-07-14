<?php

require_once dirname(__FILE__).'/../lib/adReportTotalRecordGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/adReportTotalRecordGeneratorHelper.class.php';

/**
 * adReportTotalRecord actions.
 *
 * @package    web_Portals
 * @subpackage adReportTotalRecord
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adReportTotalRecordActions extends autoAdReportTotalRecordActions
{
    public function generateChart($filterValues){

        $from_date=$filterValues['date_time']['from'];
        $to_date=$filterValues['date_time']['to'];
        $catId=$filterValues['category_id'];
        if ($from_date===null || $to_date===null){
            $this->getUser()->setFlash('notice', 'bạn phải chọn ngày tháng để thống kê.');
            $this->redirect('@ad_report_total_record');
        }
        // Khoi tao bieu do
        $graph = new Graph(600,450);
        $graph->SetScale("textlin");

        $theme_class=new UniversalTheme;

        $graph->SetTheme($theme_class);
        $graph->SetBox(false);

        $graph->img->SetAntiAliasing();

        $graph->yaxis->HideZeroLabel();
        $graph->yaxis->HideLine(false);
        $graph->yaxis->HideTicks(false,false);
        /**
         * thuc hien do du lieu
         *
         */
        $arrX=array(); //Khai bao mang thoi gian
        $time=''; //Bien thoi gian
        //lay gia tri du lieu
        $result=AdReportTotalRecordTable::getReport($catId,$from_date,$to_date);
        if(count($result)==0){
            $this->getUser()->setFlash('notice', 'Không có dữ liệu.');
            $this->redirect('@ad_report_total_record');
        }
        $data=array();//Khai bao mang du lieu chuyen muc
        for ($j=0;$j<count($result);$j++){
            //day time vao mang
            if ($time!=$result[$j]['date_time']){
                array_push($arrX,date('d-m',strtotime($result[$j]['date_time'])));
                $time=$result[$j]['date_time'];
            }
            $data[$result[$j]['category_id']]=array();
        }
        //set gia tri cho truc X
        $graph->xgrid->Show();
        $graph->xgrid->SetLineStyle("solid");
        $graph->xaxis->SetTickLabels($arrX);
        $graph->xgrid->SetColor('#E3E3E3');
        $graph->xaxis->SetPos('min');

        //Day gia tri vao chuyen muc
        $time='';
        for ($j=0;$j<count($result);$j++){
            foreach($data as $key=>$value){
                if($key==$result[$j]['category_id']){
                    array_push($data[$key],$result[$j]['total_record']);
                }else{
                    if ($time!=$result[$j]['date_time']){
                        array_push($data[$key],0);
                        $time=$result[$j]['date_time'];
                    }
                }
            }
        }
//        var_dump($data);die;
        //Chuyen muc
        $arrCat=AdCategoryTable::getCategoryNameReport($catId);
        $cl=0;//bien chay mau
        $color=array('#6495ED','#B22222','#Aa1493','#54A954','#0055CC','#FF5722','#E91E63','#673AB7','#FF9800');
        foreach($data as $key=>$value){
            $p = new LinePlot($value);
            $graph->Add($p);
            $p->SetColor($color[$cl]);
            $p->SetLegend($arrCat[$key]);
            $cl=$cl+1;
        }

        $graph->legend->SetFrameWeight(1);

        $graph->yaxis->title->Set('Tổng số tin bài');
        $graph->xaxis->title->Set('Thời gian');
        $graph->title->Set('Thống kê bài viết trong chuyên mục');
        // Display the graph
        //        $graph->Stroke();
        $user = sfContext::getInstance()->getUser();
        $sFileName = '/total_record/'  . $user->getGuardUser()->getId(). '_total_record.png';
        if (is_file(sfConfig::get('app_upload_media_file') . $sFileName)) {

            unlink(sfConfig::get('app_upload_media_file') . $sFileName);

        }
        $graph->Stroke('uploads' .$sFileName);

    }

    public function executeFilter(sfWebRequest $request)
    {
        //ngoctv: xoa file bieu do
        $user = sfContext::getInstance()->getUser();
        $sFileName = '/total_record/'  . $user->getGuardUser()->getId(). '_total_record.png';
        if (is_file(sfConfig::get('app_upload_media_file') . $sFileName)) {

            unlink(sfConfig::get('app_upload_media_file') . $sFileName);

        }
        //end delete file
        $this->setPage(1);

        if ($request->hasParameter('_reset'))
        {
            $this->setFilters($this->configuration->getFilterDefaults());
            $this->redirect('@ad_report_total_record');
        }

        $this->filters = $this->configuration->getFilterForm($this->getFilters());
        $filterValues = $request->getParameter($this->filters->getName());
        //ngoctv fix lỗi khi truyen action len url url/filter/action
        if($filterValues==null){
            $this->redirect('@ad_report_total_record');
        }
        //end
        foreach ($filterValues as $key => $value)
        {
            if (isset($filterValues[$key]['text']))
            {
                $filterValues[$key]['text'] = trim($filterValues[$key]['text']);
            }
        }

        $this->filters->bind($filterValues);
        if ($this->filters->isValid())
        {
            $this->setFilters($this->filters->getValues());

            self::generateChart($this->filters->getValues()); //ngoctv: tao bieu do thong ke
            $this->redirect('@ad_report_total_record');
        }
        $this->sidebar_status =  $this->configuration->getListSidebarStatus();
        $this->pager = $this->getPager();
        $this->sort = $this->getSort();

        $this->setTemplate('index');
    }


    public function executeIndex(sfWebRequest $request)
    {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
        {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page'))
        {
            $this->setPage($request->getParameter('page'));
        }
        else
        {
            $this->setPage(1);
        }

        // max per page
        if ($request->getParameter('max_per_page'))
        {
            $this->setMaxPerPage($request->getParameter('max_per_page'));
        }

        $this->sidebar_status = $this->configuration->getListSidebarStatus();
        $this->pager = $this->getPager();

        //Start - thongnq1 - 03/05/2013 - fix loi xoa du lieu tren trang danh sach
        if ($request->getParameter('current_page'))
        {
            $current_page = $request->getParameter('current_page');
            $this->setPage($current_page);
            $this->pager = $this->getPager();
        }
        //end thongnq1
        $this->sort = $this->getSort();
    }

}
