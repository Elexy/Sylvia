<?php

/**
 * Serialnumbers form base class.
 *
 * @method Serialnumbers getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSerialnumbersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'inventory_transactionid' => new sfWidgetFormInputText(),
      'serial'                  => new sfWidgetFormInputText(),
      'serialrecordid'          => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'inventory_transactionid' => new sfValidatorInteger(array('required' => false)),
      'serial'                  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'serialrecordid'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'serialrecordid', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('serialnumbers[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Serialnumbers';
  }

}
