<?php

/**
 * AssociatedProducts form base class.
 *
 * @method AssociatedProducts getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAssociatedProductsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid_main' => new sfWidgetFormInputHidden(),
      'productid_acc'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'productid_main' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'productid_main', 'required' => false)),
      'productid_acc'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'productid_acc', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('associated_products[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AssociatedProducts';
  }

}
