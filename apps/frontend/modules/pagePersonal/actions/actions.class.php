<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 6/11/15
 * Time: 11:29 PM
 */

class pagePersonalActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $form =new personalForm();
        $user = sfContext::getInstance()->getUser();
        if ($request->hasParameter('page') && $user->getAttribute('search', false)) {
            $values = $request->getParameter($form->getName());
            $values['full_name']=$user->getAttribute('full_name');
             $values['phone_number']=$user->getAttribute('phone_number');
             $values['email']=$user->getAttribute('email');
            $form->bind($values);
            $limit = 20;
            $user->setAttribute('search', true);
            $user->setAttribute('full_name', $values['full_name']);
            $user->setAttribute('phone_number', $values['phone_number']);
            $user->setAttribute('email', $values['email']);

            $this->page = $request->getParameter('page', 1);
            $query = csdl_lylichhoivienTable::getListPerson($values['full_name'],$values['phone_number'],$values['email'],$limit);
            $pager = new sfDoctrinePager('sfGuardUserHNB', $limit);
            $pager->setQuery($query);
            $pager->setPage($this->page);
            $pager->init();
            $this->pager = $pager;
            $this->listPersonal = $this->pager->getResults();
        }
        if($request->isMethod('POST')){
            $values = $request->getParameter($form->getName());
            $form->bind($values);
            $limit = 20;
            $user->setAttribute('search', true);
            $user->setAttribute('full_name', $values['full_name']);
            $user->setAttribute('phone_number', $values['phone_number']);
            $user->setAttribute('email', $values['email']);

            $this->page = $request->getParameter('page', 1);
            $query = csdl_lylichhoivienTable::getListPerson($values['full_name'],$values['phone_number'],$values['email'],$limit);
            $pager = new sfDoctrinePager('sfGuardUserHNB', $limit);
            $pager->setQuery($query);
            $pager->setPage($this->page);
            $pager->init();
            $this->pager = $pager;
            $this->listPersonal = $this->pager->getResults();
        }
        $this->form=$form;
    }
}