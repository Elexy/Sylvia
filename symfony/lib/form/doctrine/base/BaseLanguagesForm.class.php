<?php

/**
 * Languages form base class.
 *
 * @package    form
 * @subpackage languages
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseLanguagesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'languageid' => new sfWidgetFormInputHidden(),
      'language'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'languageid' => new sfValidatorDoctrineChoice(array('model' => 'Languages', 'column' => 'languageid', 'required' => false)),
      'language'   => new sfValidatorString(array('max_length' => 50)),
    ));

    $this->widgetSchema->setNameFormat('languages[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Languages';
  }

}