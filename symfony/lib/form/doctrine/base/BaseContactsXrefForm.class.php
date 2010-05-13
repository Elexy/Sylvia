<?php

/**
 * ContactsXref form base class.
 *
 * @package    form
 * @subpackage contacts_xref
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseContactsXrefForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid' => new sfWidgetFormInputText(),
      'otherid'   => new sfWidgetFormInputText(),
      'id'        => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'contactid' => new sfValidatorInteger(array('required' => false)),
      'otherid'   => new sfValidatorInteger(array('required' => false)),
      'id'        => new sfValidatorDoctrineChoice(array('model' => 'ContactsXref', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contacts_xref[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContactsXref';
  }

}