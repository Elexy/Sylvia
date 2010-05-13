<?php

/**
 * UserOptions form base class.
 *
 * @package    form
 * @subpackage user_options
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseUserOptionsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_options_id' => new sfWidgetFormInputHidden(),
      'userid'          => new sfWidgetFormInputText(),
      'brancheadmin'    => new sfWidgetFormInputText(),
      'rma'             => new sfWidgetFormInputText(),
      'purchase'        => new sfWidgetFormInputText(),
      'stock'           => new sfWidgetFormInputText(),
      'catalogus'       => new sfWidgetFormInputText(),
      'add_users'       => new sfWidgetFormInputText(),
      'retail_price'    => new sfWidgetFormInputText(),
      'warehouseprice'  => new sfWidgetFormInputText(),
      'template'        => new sfWidgetFormInputText(),
      'rights'          => new sfWidgetFormInputText(),
      'margins'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'user_options_id' => new sfValidatorDoctrineChoice(array('model' => 'UserOptions', 'column' => 'user_options_id', 'required' => false)),
      'userid'          => new sfValidatorInteger(array('required' => false)),
      'brancheadmin'    => new sfValidatorInteger(array('required' => false)),
      'rma'             => new sfValidatorInteger(array('required' => false)),
      'purchase'        => new sfValidatorInteger(array('required' => false)),
      'stock'           => new sfValidatorInteger(array('required' => false)),
      'catalogus'       => new sfValidatorInteger(array('required' => false)),
      'add_users'       => new sfValidatorInteger(array('required' => false)),
      'retail_price'    => new sfValidatorInteger(array('required' => false)),
      'warehouseprice'  => new sfValidatorInteger(array('required' => false)),
      'template'        => new sfValidatorInteger(array('required' => false)),
      'rights'          => new sfValidatorInteger(array('required' => false)),
      'margins'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_options[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserOptions';
  }

}