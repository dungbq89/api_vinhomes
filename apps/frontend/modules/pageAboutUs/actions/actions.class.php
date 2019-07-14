<?php

/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 6/13/15
 * Time: 11:17 PM
 */
class pageAboutUsActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $html = AdHtmlTable::getHtmlByRouting('about_us');
        if ($html) {
            $this->html = $html;
        } else {
            return $this->redirect404();
        }
    }
}