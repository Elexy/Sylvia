<?php

/**
 * HelpText form base class.
 *
 * @method HelpText getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseHelpTextForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'file'            => new sfWidgetFormInputText(),
      'title'           => new sfWidgetFormInputText(),
      'text_dutch'      => new sfWidgetFormInputText(),
      'last_changed_by' => new sfWidgetFormInputText(),
      'change_date'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'file'            => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'title'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'text_dutch'      => new sfValidatorString(array('max_length' => 6)),
      'last_changed_by' => new sfValidatorInteger(array('required' => false)),
      'change_date'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('help_text[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HelpText';
  }

}
