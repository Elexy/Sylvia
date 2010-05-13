<?php

/**
 * Menucategory form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseMenucategoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'orderflag'     => new sfWidgetFormInputText(),
      'menu'          => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormInputText(),
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
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'Menucategory', 'column' => 'id', 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 50)),
      'orderflag'     => new sfValidatorInteger(),
      'menu'          => new sfValidatorInteger(),
      'description'   => new sfValidatorPass(array('required' => false)),
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
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Menucategory', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('menucategory[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Menucategory';
  }


}
