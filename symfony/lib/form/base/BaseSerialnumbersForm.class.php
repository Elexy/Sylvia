<?php

/**
 * Serialnumbers form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSerialnumbersForm extends BaseFormPropel
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
      'serialrecordid'          => new sfValidatorPropelChoice(array('model' => 'Serialnumbers', 'column' => 'serialrecordid', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Serialnumbers', 'column' => array('inventory_transactionid', 'serial')))
    );

    $this->widgetSchema->setNameFormat('serialnumbers[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Serialnumbers';
  }


}
