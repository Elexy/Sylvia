<?php

/**
 * Personen form base class.
 *
 * @package    form
 * @subpackage personen
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePersonenForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'persoonid'        => new sfWidgetFormInputHidden(),
      'contactid'        => new sfWidgetFormInputText(),
      'personen_type_id' => new sfWidgetFormInputText(),
      'languageid'       => new sfWidgetFormInputText(),
      'mailing_yn'       => new sfWidgetFormInputText(),
      'gender'           => new sfWidgetFormInputText(),
      'dummy'            => new sfWidgetFormDateTime(),
      'titel'            => new sfWidgetFormInputText(),
      'voornaam'         => new sfWidgetFormInputText(),
      'achternaam'       => new sfWidgetFormInputText(),
      'tussenvoegsel'    => new sfWidgetFormInputText(),
      'email'            => new sfWidgetFormInputText(),
      'tel'              => new sfWidgetFormInputText(),
      'fax'              => new sfWidgetFormInputText(),
      'aanhef'           => new sfWidgetFormInputText(),
      'notes'            => new sfWidgetFormInputText(),
      'mobile'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'persoonid'        => new sfValidatorDoctrineChoice(array('model' => 'Personen', 'column' => 'persoonid', 'required' => false)),
      'contactid'        => new sfValidatorInteger(),
      'personen_type_id' => new sfValidatorInteger(),
      'languageid'       => new sfValidatorInteger(),
      'mailing_yn'       => new sfValidatorInteger(array('required' => false)),
      'gender'           => new sfValidatorInteger(array('required' => false)),
      'dummy'            => new sfValidatorDateTime(),
      'titel'            => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'voornaam'         => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'achternaam'       => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'tussenvoegsel'    => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'email'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'tel'              => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'fax'              => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'aanhef'           => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'notes'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mobile'           => new sfValidatorString(array('max_length' => 30, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('personen[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Personen';
  }

}