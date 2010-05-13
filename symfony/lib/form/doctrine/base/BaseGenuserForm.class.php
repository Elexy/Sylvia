<?php

/**
 * Genuser form base class.
 *
 * @package    form
 * @subpackage genuser
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseGenuserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'uid'            => new sfWidgetFormInputText(),
      'raccess_s'      => new sfWidgetFormInputText(),
      'raccess_a'      => new sfWidgetFormInputText(),
      'raccess_v'      => new sfWidgetFormInputText(),
      'raccess_r'      => new sfWidgetFormInputText(),
      'waccess_s'      => new sfWidgetFormInputText(),
      'waccess_a'      => new sfWidgetFormInputText(),
      'waccess_v'      => new sfWidgetFormInputText(),
      'waccess_r'      => new sfWidgetFormInputText(),
      'saccess_s'      => new sfWidgetFormInputText(),
      'saccess_a'      => new sfWidgetFormInputText(),
      'saccess_v'      => new sfWidgetFormInputText(),
      'saccess_r'      => new sfWidgetFormInputText(),
      'supervisor'     => new sfWidgetFormInputText(),
      'email'          => new sfWidgetFormInputText(),
      'logon_attempts' => new sfWidgetFormInputText(),
      'active'         => new sfWidgetFormInputText(),
      'stylesheetid'   => new sfWidgetFormInputText(),
      'deflanguage'    => new sfWidgetFormInputText(),
      'contactid'      => new sfWidgetFormInputText(),
      'employee_id'    => new sfWidgetFormInputText(),
      'pwd'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => 'Genuser', 'column' => 'id', 'required' => false)),
      'uid'            => new sfValidatorString(array('max_length' => 50)),
      'raccess_s'      => new sfValidatorInteger(),
      'raccess_a'      => new sfValidatorInteger(),
      'raccess_v'      => new sfValidatorInteger(),
      'raccess_r'      => new sfValidatorInteger(),
      'waccess_s'      => new sfValidatorInteger(),
      'waccess_a'      => new sfValidatorInteger(),
      'waccess_v'      => new sfValidatorInteger(),
      'waccess_r'      => new sfValidatorInteger(),
      'saccess_s'      => new sfValidatorInteger(),
      'saccess_a'      => new sfValidatorInteger(),
      'saccess_v'      => new sfValidatorInteger(),
      'saccess_r'      => new sfValidatorInteger(),
      'supervisor'     => new sfValidatorInteger(),
      'email'          => new sfValidatorString(array('max_length' => 100)),
      'logon_attempts' => new sfValidatorInteger(),
      'active'         => new sfValidatorInteger(),
      'stylesheetid'   => new sfValidatorInteger(),
      'deflanguage'    => new sfValidatorInteger(),
      'contactid'      => new sfValidatorInteger(),
      'employee_id'    => new sfValidatorInteger(array('required' => false)),
      'pwd'            => new sfValidatorString(array('max_length' => 64, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('genuser[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Genuser';
  }

}