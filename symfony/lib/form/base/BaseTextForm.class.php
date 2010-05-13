<?php

/**
 * Text form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseTextForm extends BaseFormPropel
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
      'textid'     => new sfValidatorPropelChoice(array('model' => 'Text', 'column' => 'textid', 'required' => false)),
      'categoryid' => new sfValidatorInteger(),
      'languageid' => new sfValidatorInteger(),
      'subject'    => new sfValidatorString(array('max_length' => 30)),
      'text'       => new sfValidatorString(),
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
