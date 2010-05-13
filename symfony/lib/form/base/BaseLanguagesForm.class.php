<?php

/**
 * Languages form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseLanguagesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'languageid' => new sfWidgetFormInputHidden(),
      'language'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'languageid' => new sfValidatorPropelChoice(array('model' => 'Languages', 'column' => 'languageid', 'required' => false)),
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
