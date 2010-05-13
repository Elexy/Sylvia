<?php

/**
 * FieldsTextLanguages form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseFieldsTextLanguagesForm extends BaseFormPropel
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
      'fieldid'    => new sfValidatorPropelChoice(array('model' => 'FieldsTextLanguages', 'column' => 'fieldid', 'required' => false)),
      'categoryid' => new sfValidatorInteger(),
      'languageid' => new sfValidatorPropelChoice(array('model' => 'FieldsTextLanguages', 'column' => 'languageid', 'required' => false)),
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
