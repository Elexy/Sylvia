<?php

/**
 * Personen form base class.
 *
 * @method Personen getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePersonenForm extends BaseFormDoctrine
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
      'persoonid'        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'persoonid', 'required' => false)),
      'contactid'        => new sfValidatorInteger(array('required' => false)),
      'personen_type_id' => new sfValidatorInteger(array('required' => false)),
      'languageid'       => new sfValidatorInteger(array('required' => false)),
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

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Personen';
  }

}
