<?php

/**
 * Euproductcode form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseEuproductcodeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'euproductcode' => new sfWidgetFormInputHidden(),
      'taxrate'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'euproductcode' => new sfValidatorPropelChoice(array('model' => 'Euproductcode', 'column' => 'euproductcode', 'required' => false)),
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
