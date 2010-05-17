<?php

/**
 * Valuta form base class.
 *
 * @method Valuta getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseValutaForm extends BaseFormDoctrine
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
      'valutaid'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'valutaid', 'required' => false)),
      'valutaname'     => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'valutanamelong' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'valutaxrate'    => new sfValidatorNumber(array('required' => false)),
      'valutadate'     => new sfValidatorDate(array('required' => false)),
      'dummy'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('valuta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Valuta';
  }

}
