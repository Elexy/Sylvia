<?php

/**
 * Gender form base class.
 *
 * @package    form
 * @subpackage gender
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseGenderForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gender' => new sfWidgetFormInputText(),
      'id'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'gender' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'id'     => new sfValidatorDoctrineChoice(array('model' => 'Gender', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('gender[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gender';
  }

}