<?php

/**
 * AssociatedProducts form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseAssociatedProductsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid_main' => new sfWidgetFormInputHidden(),
      'productid_acc'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'productid_main' => new sfValidatorPropelChoice(array('model' => 'AssociatedProducts', 'column' => 'productid_main', 'required' => false)),
      'productid_acc'  => new sfValidatorPropelChoice(array('model' => 'AssociatedProducts', 'column' => 'productid_acc', 'required' => false)),
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
