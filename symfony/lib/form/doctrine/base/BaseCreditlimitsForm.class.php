<?php

/**
 * Creditlimits form base class.
 *
 * @method Creditlimits getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCreditlimitsForm extends BaseFormDoctrine
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
      'updated_at'     => new sfWidgetFormDateTime(),
      'updated_at_by'  => new sfWidgetFormInputText(),
      'notes'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'creditlimit_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'creditlimit_id', 'required' => false)),
      'limit_amount'   => new sfValidatorNumber(array('required' => false)),
      'own_limit'      => new sfValidatorInteger(array('required' => false)),
      'currencyid'     => new sfValidatorInteger(array('required' => false)),
      'start_date'     => new sfValidatorDate(array('required' => false)),
      'end_date'       => new sfValidatorDate(array('required' => false)),
      'created'        => new sfValidatorDateTime(array('required' => false)),
      'created_by'     => new sfValidatorInteger(array('required' => false)),
      'contactid'      => new sfValidatorInteger(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at_by'  => new sfValidatorInteger(array('required' => false)),
      'notes'          => new sfValidatorString(array('max_length' => 30)),
    ));

    $this->widgetSchema->setNameFormat('creditlimits[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Creditlimits';
  }

}
