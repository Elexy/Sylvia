<?php

/**
 * RelatedProducts form base class.
 *
 * @method RelatedProducts getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRelatedProductsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid1' => new sfWidgetFormInputHidden(),
      'productid2' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'productid1' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'productid1', 'required' => false)),
      'productid2' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'productid2', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('related_products[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RelatedProducts';
  }

}
