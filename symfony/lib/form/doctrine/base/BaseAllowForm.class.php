<?php

/**
 * Allow form base class.
 *
 * @package    form
 * @subpackage allow
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseAllowForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'contactid'      => new sfWidgetFormInputText(),
      'grant_shipment' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => 'Allow', 'column' => 'id', 'required' => false)),
      'contactid'      => new sfValidatorInteger(array('required' => false)),
      'grant_shipment' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('allow[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Allow';
  }

}