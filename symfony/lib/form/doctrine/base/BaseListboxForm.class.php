<?php

/**
 * Listbox form base class.
 *
 * @package    form
 * @subpackage listbox
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseListboxForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'value'    => new sfWidgetFormInputText(),
      'category' => new sfWidgetFormInputText(),
      'text'     => new sfWidgetFormInputText(),
      'comments' => new sfWidgetFormInputText(),
      'color'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorDoctrineChoice(array('model' => 'Listbox', 'column' => 'id', 'required' => false)),
      'value'    => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'category' => new sfValidatorInteger(array('required' => false)),
      'text'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'comments' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'color'    => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('listbox[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Listbox';
  }

}