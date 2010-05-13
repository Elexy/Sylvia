<?php

/**
 * Users form base class.
 *
 * @method Users getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseUsersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'uid'                   => new sfWidgetFormInputText(),
      'languageid'            => new sfWidgetFormInputText(),
      'rma'                   => new sfWidgetFormInputText(),
      'purchase'              => new sfWidgetFormInputText(),
      'stock'                 => new sfWidgetFormInputText(),
      'logins'                => new sfWidgetFormInputText(),
      'login_attempts'        => new sfWidgetFormInputText(),
      'passw_change_attempts' => new sfWidgetFormInputText(),
      'total_logins'          => new sfWidgetFormInputText(),
      'contactid'             => new sfWidgetFormInputText(),
      'companyname'           => new sfWidgetFormInputText(),
      'pwd'                   => new sfWidgetFormInputText(),
      'email'                 => new sfWidgetFormInputText(),
      'last_online'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'uid'                   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'languageid'            => new sfValidatorInteger(array('required' => false)),
      'rma'                   => new sfValidatorInteger(array('required' => false)),
      'purchase'              => new sfValidatorInteger(array('required' => false)),
      'stock'                 => new sfValidatorInteger(array('required' => false)),
      'logins'                => new sfValidatorInteger(array('required' => false)),
      'login_attempts'        => new sfValidatorInteger(array('required' => false)),
      'passw_change_attempts' => new sfValidatorInteger(array('required' => false)),
      'total_logins'          => new sfValidatorInteger(array('required' => false)),
      'contactid'             => new sfValidatorInteger(array('required' => false)),
      'companyname'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'pwd'                   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'email'                 => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'last_online'           => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('users[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Users';
  }

}
