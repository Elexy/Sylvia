<?php

/**
 * RelatedProducts form base class.
 *
 * @package    form
 * @subpackage related_products
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseRelatedProductsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid1' => new sfWidgetFormInputHidden(),
      'productid2' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'productid1' => new sfValidatorDoctrineChoice(array('model' => 'RelatedProducts', 'column' => 'productid1', 'required' => false)),
      'productid2' => new sfValidatorDoctrineChoice(array('model' => 'RelatedProducts', 'column' => 'productid2', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('related_products[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RelatedProducts';
  }

}