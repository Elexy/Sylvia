<?php

/**
 * Status form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseStatusForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'statusid'   => new sfWidgetFormInputHidden(),
      'statustext' => new sfWidgetFormInput(),
      'category'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'statusid'   => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'statusid', 'required' => false)),
      'statustext' => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'category'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Status', 'column' => array('statusid')))
    );

    $this->widgetSchema->setNameFormat('status[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Status';
  }


}
