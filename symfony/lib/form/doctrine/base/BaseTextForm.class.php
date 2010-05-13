<?php

/**
 * Text form base class.
 *
 * @method Text getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTextForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'textid'     => new sfWidgetFormInputHidden(),
      'categoryid' => new sfWidgetFormInputText(),
      'languageid' => new sfWidgetFormInputText(),
      'subject'    => new sfWidgetFormInputText(),
      'text'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'textid'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'textid', 'required' => false)),
      'categoryid' => new sfValidatorInteger(array('required' => false)),
      'languageid' => new sfValidatorInteger(array('required' => false)),
      'subject'    => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'text'       => new sfValidatorString(array('max_length' => 6)),
    ));

    $this->widgetSchema->setNameFormat('text[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Text';
  }

}
