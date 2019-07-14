<?php

require_once dirname(__FILE__).'/../lib/adReportHicounterGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/adReportHicounterGeneratorHelper.class.php';

/**
 * adReportHicounter actions.
 *
 * @package    web_Portals
 * @subpackage adReportHicounter
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adReportHicounterActions extends autoAdReportHicounterActions
{

    public function generateChart($filterValues){

        $catId=$filterValues['category_id'];
        $arrX=array();
        $datay=array();
        $result=AdReportHicounterTable::getReport($catId);
        $data=array();//Khai bao mang du lieu chuyen muc
        for ($j=0;$j<count($result);$j++){
            array_push($datay,$result[$j]['hitcounter']);
            $data[$result[$j]['category_id']]=array();
        }

        $arrCat=AdCategoryTable::getCategoryNameReport($catId);
        foreach($data as $key=>$value){
            array_push($arrX,$arrCat[$key]);
        }

// Create the graph. These two calls are always required
        $graph = new Graph(600,450,'auto');
        $graph->SetScale("textlin");
        $graph->SetBox(false);

//$graph->ygrid->SetColor('gray');
        $graph->ygrid->SetFill(false);
        $graph->xaxis->SetTickLabels($arrX);
        $graph->yaxis->HideLine(false);
        $graph->yaxis->HideTicks(false,false);

// Create the bar plots
        $b1plot = new BarPlot($datay);

// ...and add it to the graPH
        $graph->Add($b1plot);

        $b1plot->SetColor("white");
//        $b1plot->SetFillGradient("#4B0082","white",GRAD_LEFT_REFLECTION);
        $b1plot->SetFillColor("#99D4E5");
        $b1plot->SetWidth(35);
        $graph->title->Set("Biểu đồ cột số lượng");

// Display the graph
       // $graph->Stroke();

        // Display the graph
        //        $graph->Stroke();
        $user = sfContext::getInstance()->getUser();
        $sFileName = '/hitcounter/'  . $user->getGuardUser()->getId(). '_bar_hitcounter.png';
        if (is_file(sfConfig::get('app_upload_media_file') . $sFileName)) {

            unlink(sfConfig::get('app_upload_media_file') . $sFileName);

        }
        $graph->Stroke('uploads' .$sFileName);


// Create the Pie Graph.
        $graph = new PieGraph(600,450);

        //$graph->SetTheme(new $theme_class());

// Set A title for the plot
        $graph->title->Set("Biểu đồ tỷ lệ %");
        $graph->SetBox(true);

// Create
        $p1 = new PiePlot($datay);
        $graph->Add($p1);
        $color=array('#6495ED','#B22222','#Aa1493','#54A954','#0055CC','#FF5722','#E91E63','#673AB7','#FF9800','#ADFF2F','#BA55D3');
        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetSliceColors($color);

        $user = sfContext::getInstance()->getUser();
        $sFileName = '/hitcounter/'  . $user->getGuardUser()->getId(). '_pie_hitcounter.png';
        if (is_file(sfConfig::get('app_upload_media_file') . $sFileName)) {

            unlink(sfConfig::get('app_upload_media_file') . $sFileName);

        }
        $graph->Stroke('uploads' .$sFileName);
    }

    public function executeFilter(sfWebRequest $request)
    {
        //ngoctv: xoa file bieu do
        $user = sfContext::getInstance()->getUser();
        $sFileName = '/hitcounter/'  . $user->getGuardUser()->getId(). '_bar_hitcounter.png';
        if (is_file(sfConfig::get('app_upload_media_file') . $sFileName)) {

            unlink(sfConfig::get('app_upload_media_file') . $sFileName);

        }

        $sFileName = '/hitcounter/'  . $user->getGuardUser()->getId(). '_pie_hitcounter.png';
        if (is_file(sfConfig::get('app_upload_media_file') . $sFileName)) {

            unlink(sfConfig::get('app_upload_media_file') . $sFileName);

        }

        //end delete file
        $this->setPage(1);

        if ($request->hasParameter('_reset'))
        {
            $this->setFilters($this->configuration->getFilterDefaults());
            $this->redirect('@ad_report_hicounter');
        }

        $this->filters = $this->configuration->getFilterForm($this->getFilters());
        $filterValues = $request->getParameter($this->filters->getName());
        //ngoctv fix lỗi khi truyen action len url url/filter/action
        if($filterValues==null){
            $this->redirect('@ad_report_hicounter');
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
            $this->redirect('@ad_report_hicounter');
        }
        $this->sidebar_status =  $this->configuration->getListSidebarStatus();
        $this->pager = $this->getPager();
        $this->sort = $this->getSort();

        $this->setTemplate('index');
    }
}
