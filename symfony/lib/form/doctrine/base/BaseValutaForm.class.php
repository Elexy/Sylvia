<?php

/**
 * Valuta form base class.
 *
 * @package    form
 * @subpackage valuta
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseValutaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'valutaid'       => new sfWidgetFormInputHidden(),
      'valutaname'     => new sfWidgetFormInputText(),
      'valutanamelong' => new sfWidgetFormInputText(),
      'valutaxrate'    => new sfWidgetFormInputText(),
      'valutadate'     => new sfWidgetFormDate(),
      'dummy'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'valutaid'       => new sfValidatorDoctrineChoice(array('model' => 'Valuta', 'column' => 'valutaid', 'required' => false)),
      'valutaname'     => new sfValidatorString(array('max_length' => 3)),
      'valutanamelong' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'valutaxrate'    => new sfValidatorNumber(),
      'valutadate'     => new sfValidatorDate(),
      'dummy'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('valuta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Valuta';
  }

}