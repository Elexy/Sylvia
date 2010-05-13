<?php

/**
 * HelpText form base class.
 *
 * @package    form
 * @subpackage help_text
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseHelpTextForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'file'            => new sfWidgetFormInputText(),
      'title'           => new sfWidgetFormInputText(),
      'text_dutch'      => new sfWidgetFormTextarea(),
      'last_changed_by' => new sfWidgetFormInputText(),
      'change_date'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => 'HelpText', 'column' => 'id', 'required' => false)),
      'file'            => new sfValidatorString(array('max_length' => 30)),
      'title'           => new sfValidatorString(array('max_length' => 100)),
      'text_dutch'      => new sfValidatorString(array('max_length' => 2147483647)),
      'last_changed_by' => new sfValidatorInteger(),
      'change_date'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('help_text[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'HelpText';
  }

}