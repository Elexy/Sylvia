<?php

/**
 * Menufunction form base class.
 *
 * @package    form
 * @subpackage menufunction
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseMenufunctionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'menucategoryid' => new sfWidgetFormInputText(),
      'name'           => new sfWidgetFormInputText(),
      'imagename'      => new sfWidgetFormInputText(),
      'link'           => new sfWidgetFormInputText(),
      'orderflag'      => new sfWidgetFormInputText(),
      'access_s'       => new sfWidgetFormInputText(),
      'access_a'       => new sfWidgetFormInputText(),
      'access_v'       => new sfWidgetFormInputText(),
      'access_r'       => new sfWidgetFormInputText(),
      'setup_s'        => new sfWidgetFormInputText(),
      'setup_a'        => new sfWidgetFormInputText(),
      'setup_v'        => new sfWidgetFormInputText(),
      'setup_r'        => new sfWidgetFormInputText(),
      'supervisor'     => new sfWidgetFormInputText(),
      'nonsupervisor'  => new sfWidgetFormInputText(),
      'extvend'        => new sfWidgetFormInputText(),
      'extcust'        => new sfWidgetFormInputText(),
      'nonext'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => 'Menufunction', 'column' => 'id', 'required' => false)),
      'menucategoryid' => new sfValidatorInteger(),
      'name'           => new sfValidatorString(array('max_length' => 50)),
      'imagename'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'link'           => new sfValidatorString(array('max_length' => 50)),
      'orderflag'      => new sfValidatorInteger(),
      'access_s'       => new sfValidatorInteger(),
      'access_a'       => new sfValidatorInteger(),
      'access_v'       => new sfValidatorInteger(),
      'access_r'       => new sfValidatorInteger(),
      'setup_s'        => new sfValidatorInteger(),
      'setup_a'        => new sfValidatorInteger(),
      'setup_v'        => new sfValidatorInteger(),
      'setup_r'        => new sfValidatorInteger(),
      'supervisor'     => new sfValidatorInteger(),
      'nonsupervisor'  => new sfValidatorInteger(),
      'extvend'        => new sfValidatorInteger(),
      'extcust'        => new sfValidatorInteger(),
      'nonext'         => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('menufunction[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Menufunction';
  }

}