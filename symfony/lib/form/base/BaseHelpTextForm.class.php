<?php

/**
 * HelpText form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseHelpTextForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'file'            => new sfWidgetFormInput(),
      'title'           => new sfWidgetFormInput(),
      'text_dutch'      => new sfWidgetFormTextarea(),
      'last_changed_by' => new sfWidgetFormInput(),
      'change_date'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'HelpText', 'column' => 'id', 'required' => false)),
      'file'            => new sfValidatorString(array('max_length' => 30)),
      'title'           => new sfValidatorString(array('max_length' => 100)),
      'text_dutch'      => new sfValidatorString(),
      'last_changed_by' => new sfValidatorInteger(),
      'change_date'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'HelpText', 'column' => array('file')))
    );

    $this->widgetSchema->setNameFormat('help_text[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'HelpText';
  }


}
