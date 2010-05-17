<?php

/**
 * FieldsTextLanguages form base class.
 *
 * @method FieldsTextLanguages getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFieldsTextLanguagesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fieldid'    => new sfWidgetFormInputHidden(),
      'categoryid' => new sfWidgetFormInputText(),
      'languageid' => new sfWidgetFormInputHidden(),
      'text'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'fieldid'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'fieldid', 'required' => false)),
      'categoryid' => new sfValidatorInteger(array('required' => false)),
      'languageid' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'languageid', 'required' => false)),
      'text'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fields_text_languages[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FieldsTextLanguages';
  }

}
