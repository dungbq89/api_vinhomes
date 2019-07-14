<?php

/**
 * ParameterCategory form.
 *
 * @package    Web_Portals
 * @subpackage form
 * @author     ngoctv1
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ParameterCategoryFormAdmin extends BaseParameterCategoryForm
{
  public function configure()
  {
    unset( $this['created_at'],$this['updated_at']);
  }
}
