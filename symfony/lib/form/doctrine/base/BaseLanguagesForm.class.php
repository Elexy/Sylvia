<?php

/**
 * Languages form base class.
 *
 * @method Languages getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseLanguagesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'languageid' => new sfWidgetFormInputHidden(),
      'language'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'languageid' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'languageid', 'required' => false)),
      'language'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('languages[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Languages';
  }

}
