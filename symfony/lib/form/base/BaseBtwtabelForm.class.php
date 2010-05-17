<?php

/**
 * Btwtabel form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBtwtabelForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'btw_class'     => new sfWidgetFormInputHidden(),
      'btwpercentage' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'btw_class'     => new sfValidatorPropelChoice(array('model' => 'Btwtabel', 'column' => 'btw_class', 'required' => false)),
      'btwpercentage' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('btwtabel[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Btwtabel';
  }


}
