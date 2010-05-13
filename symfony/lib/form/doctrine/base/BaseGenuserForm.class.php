<?php

/**
 * Genuser form base class.
 *
 * @method Genuser getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseGenuserForm extends BaseFormDoctrine
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
      'id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'uid'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'raccess_s'      => new sfValidatorInteger(array('required' => false)),
      'raccess_a'      => new sfValidatorInteger(array('required' => false)),
      'raccess_v'      => new sfValidatorInteger(array('required' => false)),
      'raccess_r'      => new sfValidatorInteger(array('required' => false)),
      'waccess_s'      => new sfValidatorInteger(array('required' => false)),
      'waccess_a'      => new sfValidatorInteger(array('required' => false)),
      'waccess_v'      => new sfValidatorInteger(array('required' => false)),
      'waccess_r'      => new sfValidatorInteger(array('required' => false)),
      'saccess_s'      => new sfValidatorInteger(array('required' => false)),
      'saccess_a'      => new sfValidatorInteger(array('required' => false)),
      'saccess_v'      => new sfValidatorInteger(array('required' => false)),
      'saccess_r'      => new sfValidatorInteger(array('required' => false)),
      'supervisor'     => new sfValidatorInteger(array('required' => false)),
      'email'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'logon_attempts' => new sfValidatorInteger(array('required' => false)),
      'active'         => new sfValidatorInteger(array('required' => false)),
      'stylesheetid'   => new sfValidatorInteger(array('required' => false)),
      'deflanguage'    => new sfValidatorInteger(array('required' => false)),
      'contactid'      => new sfValidatorInteger(array('required' => false)),
      'employee_id'    => new sfValidatorInteger(array('required' => false)),
      'pwd'            => new sfValidatorString(array('max_length' => 64, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('genuser[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Genuser';
  }

}
