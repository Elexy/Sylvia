<?php

/**
 * ExtraProductText form base class.
 *
 * @package    form
 * @subpackage extra_product_text
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseExtraProductTextForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'productid' => new sfWidgetFormInputText(),
      'text'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorDoctrineChoice(array('model' => 'ExtraProductText', 'column' => 'id', 'required' => false)),
      'productid' => new sfValidatorString(array('max_length' => 10)),
      'text'      => new sfValidatorString(array('max_length' => 2147483647)),
    ));

    $this->widgetSchema->setNameFormat('extra_product_text[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExtraProductText';
  }

}