<?php
/**
 * Created by JetBrains PhpStorm.
 * User: chuyennv2
 * Date: 14/9/13
 * Time: 13:30 AM
 * To change this template use File | Settings | File Templates.
 */
class defaultActions extends sfActions
{
  public function executeError404()
  {
      $this->setTemplate('error404','default');
  }
}
