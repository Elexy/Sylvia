<?php

/**
 * Serialnumbers form base class.
 *
 * @package    form
 * @subpackage serialnumbers
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseSerialnumbersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'inventory_transactionid' => new sfWidgetFormInputText(),
      'serial'                  => new sfWidgetFormInputText(),
      'serialrecordid'          => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'inventory_transactionid' => new sfValidatorInteger(),
      'serial'                  => new sfValidatorString(array('max_length' => 50)),
      'serialrecordid'          => new sfValidatorDoctrineChoice(array('model' => 'Serialnumbers', 'column' => 'serialrecordid', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('serialnumbers[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Serialnumbers';
  }

}