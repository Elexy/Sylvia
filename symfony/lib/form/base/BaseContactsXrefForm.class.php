<?php

/**
 * ContactsXref form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseContactsXrefForm extends BaseFormPropel
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
      'id'        => new sfValidatorPropelChoice(array('model' => 'ContactsXref', 'column' => 'id', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'ContactsXref', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('contacts_xref[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContactsXref';
  }


}
