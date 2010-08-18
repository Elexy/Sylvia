<?php

/**
 * Listbox form base class.
 *
 * @method Listbox getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseListboxForm extends BaseFormDoctrine
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
      'id'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'value'    => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'category' => new sfValidatorInteger(array('required' => false)),
      'text'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'comments' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'color'    => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('listbox[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Listbox';
  }

}
