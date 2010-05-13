<?php

/**
 * Users form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseUsersForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'contactid'             => new sfWidgetFormInput(),
      'companyname'           => new sfWidgetFormInput(),
      'uid'                   => new sfWidgetFormInput(),
      'pwd'                   => new sfWidgetFormInput(),
      'email'                 => new sfWidgetFormInput(),
      'languageid'            => new sfWidgetFormInput(),
      'rma'                   => new sfWidgetFormInput(),
      'purchase'              => new sfWidgetFormInput(),
      'stock'                 => new sfWidgetFormInput(),
      'logins'                => new sfWidgetFormInput(),
      'login_attempts'        => new sfWidgetFormInput(),
      'passw_change_attempts' => new sfWidgetFormInput(),
      'last_online'           => new sfWidgetFormDateTime(),
      'total_logins'          => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'contactid'             => new sfValidatorInteger(array('required' => false)),
      'companyname'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'uid'                   => new sfValidatorString(array('max_length' => 30)),
      'pwd'                   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'email'                 => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'languageid'            => new sfValidatorInteger(),
      'rma'                   => new sfValidatorInteger(),
      'purchase'              => new sfValidatorInteger(),
      'stock'                 => new sfValidatorInteger(),
      'logins'                => new sfValidatorInteger(array('required' => false)),
      'login_attempts'        => new sfValidatorInteger(array('required' => false)),
      'passw_change_attempts' => new sfValidatorInteger(array('required' => false)),
      'last_online'           => new sfValidatorDateTime(array('required' => false)),
      'total_logins'          => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Users', 'column' => array('uid')))
    );

    $this->widgetSchema->setNameFormat('users[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Users';
  }


}
