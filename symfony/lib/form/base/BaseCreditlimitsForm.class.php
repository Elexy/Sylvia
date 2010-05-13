<?php

/**
 * Creditlimits form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCreditlimitsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'creditlimit_id' => new sfWidgetFormInputHidden(),
      'limit_amount'   => new sfWidgetFormInputText(),
      'own_limit'      => new sfWidgetFormInputText(),
      'currencyid'     => new sfWidgetFormInputText(),
      'start_date'     => new sfWidgetFormDate(),
      'end_date'       => new sfWidgetFormDate(),
      'created'        => new sfWidgetFormDateTime(),
      'created_by'     => new sfWidgetFormInputText(),
      'contactid'      => new sfWidgetFormInputText(),
      'modified'       => new sfWidgetFormDateTime(),
      'modified_by'    => new sfWidgetFormInputText(),
      'notes'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'creditlimit_id' => new sfValidatorPropelChoice(array('model' => 'Creditlimits', 'column' => 'creditlimit_id', 'required' => false)),
      'limit_amount'   => new sfValidatorNumber(),
      'own_limit'      => new sfValidatorInteger(),
      'currencyid'     => new sfValidatorInteger(),
      'start_date'     => new sfValidatorDate(),
      'end_date'       => new sfValidatorDate(),
      'created'        => new sfValidatorDateTime(),
      'created_by'     => new sfValidatorInteger(),
      'contactid'      => new sfValidatorInteger(),
      'modified'       => new sfValidatorDateTime(),
      'modified_by'    => new sfValidatorInteger(),
      'notes'          => new sfValidatorString(array('max_length' => 30)),
    ));

    $this->widgetSchema->setNameFormat('creditlimits[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Creditlimits';
  }


}
