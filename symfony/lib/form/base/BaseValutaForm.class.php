<?php

/**
 * Valuta form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseValutaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'valutaid'       => new sfWidgetFormInputHidden(),
      'valutaname'     => new sfWidgetFormInput(),
      'valutanamelong' => new sfWidgetFormInput(),
      'valutaxrate'    => new sfWidgetFormInput(),
      'valutadate'     => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'valutaid'       => new sfValidatorPropelChoice(array('model' => 'Valuta', 'column' => 'valutaid', 'required' => false)),
      'valutaname'     => new sfValidatorString(array('max_length' => 3)),
      'valutanamelong' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'valutaxrate'    => new sfValidatorNumber(),
      'valutadate'     => new sfValidatorDate(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Valuta', 'column' => array('valutaid')))
    );

    $this->widgetSchema->setNameFormat('valuta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Valuta';
  }


}
