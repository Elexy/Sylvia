<?php

/**
 * ExtraProductText form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseExtraProductTextForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'productid' => new sfWidgetFormInput(),
      'text'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'ExtraProductText', 'column' => 'id', 'required' => false)),
      'productid' => new sfValidatorString(array('max_length' => 10)),
      'text'      => new sfValidatorString(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'ExtraProductText', 'column' => array('productid')))
    );

    $this->widgetSchema->setNameFormat('extra_product_text[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExtraProductText';
  }


}
