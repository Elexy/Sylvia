<?php

/**
 * Brand form base class.
 *
 * @package    form
 * @subpackage brand
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseBrandForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'brand_id' => new sfWidgetFormInputHidden(),
      'name'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'brand_id' => new sfValidatorDoctrineChoice(array('model' => 'Brand', 'column' => 'brand_id', 'required' => false)),
      'name'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('brand[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Brand';
  }

}