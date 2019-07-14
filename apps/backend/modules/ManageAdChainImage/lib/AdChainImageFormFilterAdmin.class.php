<?php

/**
 * AdChainImage filter form.
 *
 * @package    Web_Portals
 * @subpackage filter
 * @author     ngoctv1
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdChainImageFormFilterAdmin extends BaseAdChainImageFormFilter
{
    public function configure()
    {
        $product = VtpProductsCategoryTable::getInstance()->getListChain(true, false);

        $this->setWidgets(array(
            'product' => new sfWidgetFormChoice(array(
                'choices' => $product,
                'multiple' => false,
                'expanded' => false,
            ), array()),
            'is_active' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
        ));

        $this->setValidators(array(
            'product' => new sfValidatorPass(),
            'is_active' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
        ));

        $this->widgetSchema->setNameFormat('AdChainImageFormFilterAdmin[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

    public function addProductColumnQuery(Doctrine_Query $query, $field, $values)
    {
        $alias = $query->getRootAlias();
        if ($values != '0') {
            $query->andwhere("$alias.product = ?", $values);
        }
    }
}
