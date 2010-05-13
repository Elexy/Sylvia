<?php

/**
 * Listbox form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseListboxForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'value'    => new sfWidgetFormInput(),
      'text'     => new sfWidgetFormInput(),
      'category' => new sfWidgetFormInput(),
      'comments' => new sfWidgetFormInput(),
      'color'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorPropelChoice(array('model' => 'Listbox', 'column' => 'id', 'required' => false)),
      'value'    => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'text'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'category' => new sfValidatorInteger(array('required' => false)),
      'comments' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'color'    => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Listbox', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('listbox[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Listbox';
  }


}
