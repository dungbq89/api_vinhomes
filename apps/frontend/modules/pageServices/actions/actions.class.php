<?php

/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 6/13/15
 * Time: 11:17 PM
 */
class pageServicesActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $html = AdHtmlTable::getHtmlByRouting('services');
        if ($html) {
            $this->html = $html;
        } else {
            return $this->redirect404();
        }
    }
}