<?php

/**
 * Months form base class.
 *
 * @package    form
 * @subpackage months
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseMonthsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'    => new sfWidgetFormInputHidden(),
      'month' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'    => new sfValidatorDoctrineChoice(array('model' => 'Months', 'column' => 'id', 'required' => false)),
      'month' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('months[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Months';
  }

}