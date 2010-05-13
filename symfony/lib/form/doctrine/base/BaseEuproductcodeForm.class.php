<?php

/**
 * Euproductcode form base class.
 *
 * @package    form
 * @subpackage euproductcode
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEuproductcodeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'euproductcode' => new sfWidgetFormInputHidden(),
      'taxrate'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'euproductcode' => new sfValidatorDoctrineChoice(array('model' => 'Euproductcode', 'column' => 'euproductcode', 'required' => false)),
      'taxrate'       => new sfValidatorNumber(),
    ));

    $this->widgetSchema->setNameFormat('euproductcode[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Euproductcode';
  }

}