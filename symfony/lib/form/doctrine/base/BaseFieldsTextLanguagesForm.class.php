<?php

/**
 * FieldsTextLanguages form base class.
 *
 * @package    form
 * @subpackage fields_text_languages
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseFieldsTextLanguagesForm extends BaseFormDoctrine
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
      'fieldid'    => new sfValidatorDoctrineChoice(array('model' => 'FieldsTextLanguages', 'column' => 'fieldid', 'required' => false)),
      'categoryid' => new sfValidatorInteger(),
      'languageid' => new sfValidatorDoctrineChoice(array('model' => 'FieldsTextLanguages', 'column' => 'languageid', 'required' => false)),
      'text'       => new sfValidatorString(array('max_length' => 50)),
    ));

    $this->widgetSchema->setNameFormat('fields_text_languages[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FieldsTextLanguages';
  }

}