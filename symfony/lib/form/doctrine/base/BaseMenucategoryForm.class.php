<?php

/**
 * Menucategory form base class.
 *
 * @package    form
 * @subpackage menucategory
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseMenucategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'orderflag'     => new sfWidgetFormInputText(),
      'menu'          => new sfWidgetFormInputText(),
      'access_s'      => new sfWidgetFormInputText(),
      'access_a'      => new sfWidgetFormInputText(),
      'access_v'      => new sfWidgetFormInputText(),
      'access_r'      => new sfWidgetFormInputText(),
      'setup_s'       => new sfWidgetFormInputText(),
      'setup_a'       => new sfWidgetFormInputText(),
      'setup_v'       => new sfWidgetFormInputText(),
      'setup_r'       => new sfWidgetFormInputText(),
      'supervisor'    => new sfWidgetFormInputText(),
      'nonsupervisor' => new sfWidgetFormInputText(),
      'extvend'       => new sfWidgetFormInputText(),
      'extcust'       => new sfWidgetFormInputText(),
      'nonext'        => new sfWidgetFormInputText(),
      'companyid'     => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorDoctrineChoice(array('model' => 'Menucategory', 'column' => 'id', 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 50)),
      'orderflag'     => new sfValidatorInteger(),
      'menu'          => new sfValidatorInteger(),
      'access_s'      => new sfValidatorInteger(),
      'access_a'      => new sfValidatorInteger(),
      'access_v'      => new sfValidatorInteger(),
      'access_r'      => new sfValidatorInteger(),
      'setup_s'       => new sfValidatorInteger(),
      'setup_a'       => new sfValidatorInteger(),
      'setup_v'       => new sfValidatorInteger(),
      'setup_r'       => new sfValidatorInteger(),
      'supervisor'    => new sfValidatorInteger(),
      'nonsupervisor' => new sfValidatorInteger(),
      'extvend'       => new sfValidatorInteger(),
      'extcust'       => new sfValidatorInteger(),
      'nonext'        => new sfValidatorInteger(),
      'companyid'     => new sfValidatorInteger(),
      'description'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('menucategory[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Menucategory';
  }

}