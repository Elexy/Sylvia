<?php

/**
 * Personen form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePersonenForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'persoonid'        => new sfWidgetFormInputHidden(),
      'contactid'        => new sfWidgetFormInputText(),
      'personen_type_id' => new sfWidgetFormInputText(),
      'titel'            => new sfWidgetFormInputText(),
      'voornaam'         => new sfWidgetFormInputText(),
      'achternaam'       => new sfWidgetFormInputText(),
      'tussenvoegsel'    => new sfWidgetFormInputText(),
      'languageid'       => new sfWidgetFormInputText(),
      'email'            => new sfWidgetFormInputText(),
      'mailing_yn'       => new sfWidgetFormInputText(),
      'tel'              => new sfWidgetFormInputText(),
      'fax'              => new sfWidgetFormInputText(),
      'aanhef'           => new sfWidgetFormInputText(),
      'gender'           => new sfWidgetFormInputText(),
      'notes'            => new sfWidgetFormInputText(),
      'mobile'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'persoonid'        => new sfValidatorPropelChoice(array('model' => 'Personen', 'column' => 'persoonid', 'required' => false)),
      'contactid'        => new sfValidatorInteger(),
      'personen_type_id' => new sfValidatorInteger(),
      'titel'            => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'voornaam'         => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'achternaam'       => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'tussenvoegsel'    => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'languageid'       => new sfValidatorInteger(),
      'email'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'mailing_yn'       => new sfValidatorInteger(array('required' => false)),
      'tel'              => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'fax'              => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'aanhef'           => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'gender'           => new sfValidatorInteger(array('required' => false)),
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
