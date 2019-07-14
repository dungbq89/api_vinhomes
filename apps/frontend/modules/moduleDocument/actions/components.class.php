<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 5/7/14
 * Time: 2:56 PM
 * To change this template use File | Settings | File Templates.
 */
class moduleDocumentComponents extends sfComponents
{
    public function executeHotDocument(sfWebRequest $request){
        $limit = $this->getVar('limit');
        if (!isset($limit))
            $limit = 6;
        $listDocument = AdDocumentTable::getDocumentHot($limit)->fetchArray();
        if($listDocument){
            $this->listDocument = $listDocument;
        }
        else{
            return sfView::NONE;
        }
    }


}