<?php

/**
 * Status form base class.
 *
 * @package    form
 * @subpackage status
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseStatusForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'statusid'   => new sfWidgetFormInputHidden(),
      'statustext' => new sfWidgetFormInputText(),
      'category'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'statusid'   => new sfValidatorDoctrineChoice(array('model' => 'Status', 'column' => 'statusid', 'required' => false)),
      'statustext' => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'category'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('status[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Status';
  }

}