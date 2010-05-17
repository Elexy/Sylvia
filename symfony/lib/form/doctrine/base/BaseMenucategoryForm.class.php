<?php

/**
 * Menucategory form base class.
 *
 * @method Menucategory getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMenucategoryForm extends BaseFormDoctrine
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
      'id'            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'orderflag'     => new sfValidatorInteger(array('required' => false)),
      'menu'          => new sfValidatorInteger(array('required' => false)),
      'access_s'      => new sfValidatorInteger(array('required' => false)),
      'access_a'      => new sfValidatorInteger(array('required' => false)),
      'access_v'      => new sfValidatorInteger(array('required' => false)),
      'access_r'      => new sfValidatorInteger(array('required' => false)),
      'setup_s'       => new sfValidatorInteger(array('required' => false)),
      'setup_a'       => new sfValidatorInteger(array('required' => false)),
      'setup_v'       => new sfValidatorInteger(array('required' => false)),
      'setup_r'       => new sfValidatorInteger(array('required' => false)),
      'supervisor'    => new sfValidatorInteger(array('required' => false)),
      'nonsupervisor' => new sfValidatorInteger(array('required' => false)),
      'extvend'       => new sfValidatorInteger(array('required' => false)),
      'extcust'       => new sfValidatorInteger(array('required' => false)),
      'nonext'        => new sfValidatorInteger(array('required' => false)),
      'companyid'     => new sfValidatorInteger(array('required' => false)),
      'description'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('menucategory[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Menucategory';
  }

}
