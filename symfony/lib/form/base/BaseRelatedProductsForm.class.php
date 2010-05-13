<?php

/**
 * RelatedProducts form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseRelatedProductsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid1' => new sfWidgetFormInputHidden(),
      'productid2' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'productid1' => new sfValidatorPropelChoice(array('model' => 'RelatedProducts', 'column' => 'productid1', 'required' => false)),
      'productid2' => new sfValidatorPropelChoice(array('model' => 'RelatedProducts', 'column' => 'productid2', 'required' => false)),
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
