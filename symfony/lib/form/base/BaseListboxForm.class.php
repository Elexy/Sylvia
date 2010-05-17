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
      'value'    => new sfWidgetFormInputText(),
      'text'     => new sfWidgetFormInputText(),
      'category' => new sfWidgetFormInputText(),
      'comments' => new sfWidgetFormInputText(),
      'color'    => new sfWidgetFormInputText(),
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
