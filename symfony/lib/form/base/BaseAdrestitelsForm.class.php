<?php

/**
 * Adrestitels form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseAdrestitelsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'titelid' => new sfWidgetFormInputHidden(),
      'titel'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'titelid' => new sfValidatorPropelChoice(array('model' => 'Adrestitels', 'column' => 'titelid', 'required' => false)),
      'titel'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Adrestitels', 'column' => array('titelid')))
    );

    $this->widgetSchema->setNameFormat('adrestitels[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Adrestitels';
  }


}
