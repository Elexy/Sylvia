<?php

/**
 * Text form base class.
 *
 * @package    form
 * @subpackage text
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTextForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'textid'     => new sfWidgetFormInputHidden(),
      'categoryid' => new sfWidgetFormInputText(),
      'languageid' => new sfWidgetFormInputText(),
      'subject'    => new sfWidgetFormInputText(),
      'text'       => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'textid'     => new sfValidatorDoctrineChoice(array('model' => 'Text', 'column' => 'textid', 'required' => false)),
      'categoryid' => new sfValidatorInteger(),
      'languageid' => new sfValidatorInteger(),
      'subject'    => new sfValidatorString(array('max_length' => 30)),
      'text'       => new sfValidatorString(array('max_length' => 2147483647)),
    ));

    $this->widgetSchema->setNameFormat('text[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Text';
  }

}