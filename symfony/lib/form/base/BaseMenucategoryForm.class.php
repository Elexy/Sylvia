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
      'name'          => new sfWidgetFormInput(),
      'orderflag'     => new sfWidgetFormInput(),
      'menu'          => new sfWidgetFormInput(),
      'description'   => new sfWidgetFormInput(),
      'access_s'      => new sfWidgetFormInput(),
      'access_a'      => new sfWidgetFormInput(),
      'access_v'      => new sfWidgetFormInput(),
      'access_r'      => new sfWidgetFormInput(),
      'setup_s'       => new sfWidgetFormInput(),
      'setup_a'       => new sfWidgetFormInput(),
      'setup_v'       => new sfWidgetFormInput(),
      'setup_r'       => new sfWidgetFormInput(),
      'supervisor'    => new sfWidgetFormInput(),
      'nonsupervisor' => new sfWidgetFormInput(),
      'extvend'       => new sfWidgetFormInput(),
      'extcust'       => new sfWidgetFormInput(),
      'nonext'        => new sfWidgetFormInput(),
      'companyid'     => new sfWidgetFormInput(),
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
