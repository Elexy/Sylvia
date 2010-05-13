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
      'contactid'        => new sfWidgetFormInput(),
      'personen_type_id' => new sfWidgetFormInput(),
      'titel'            => new sfWidgetFormInput(),
      'voornaam'         => new sfWidgetFormInput(),
      'achternaam'       => new sfWidgetFormInput(),
      'tussenvoegsel'    => new sfWidgetFormInput(),
      'languageid'       => new sfWidgetFormInput(),
      'email'            => new sfWidgetFormInput(),
      'mailing_yn'       => new sfWidgetFormInput(),
      'tel'              => new sfWidgetFormInput(),
      'fax'              => new sfWidgetFormInput(),
      'aanhef'           => new sfWidgetFormInput(),
      'gender'           => new sfWidgetFormInput(),
      'notes'            => new sfWidgetFormInput(),
      'mobile'           => new sfWidgetFormInput(),
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
