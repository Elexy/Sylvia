<?php

/**
 * Btwtabel form base class.
 *
 * @package    form
 * @subpackage btwtabel
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseBtwtabelForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'btw_class'     => new sfWidgetFormInputHidden(),
      'btwpercentage' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'btw_class'     => new sfValidatorDoctrineChoice(array('model' => 'Btwtabel', 'column' => 'btw_class', 'required' => false)),
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