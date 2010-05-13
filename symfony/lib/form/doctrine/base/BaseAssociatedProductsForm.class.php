<?php

/**
 * AssociatedProducts form base class.
 *
 * @package    form
 * @subpackage associated_products
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseAssociatedProductsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid_main' => new sfWidgetFormInputHidden(),
      'productid_acc'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'productid_main' => new sfValidatorDoctrineChoice(array('model' => 'AssociatedProducts', 'column' => 'productid_main', 'required' => false)),
      'productid_acc'  => new sfValidatorDoctrineChoice(array('model' => 'AssociatedProducts', 'column' => 'productid_acc', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('associated_products[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AssociatedProducts';
  }

}