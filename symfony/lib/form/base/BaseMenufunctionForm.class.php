<?php

/**
 * Menufunction form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseMenufunctionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'menucategoryid' => new sfWidgetFormInput(),
      'name'           => new sfWidgetFormInput(),
      'imagename'      => new sfWidgetFormInput(),
      'link'           => new sfWidgetFormInput(),
      'orderflag'      => new sfWidgetFormInput(),
      'access_s'       => new sfWidgetFormInput(),
      'access_a'       => new sfWidgetFormInput(),
      'access_v'       => new sfWidgetFormInput(),
      'access_r'       => new sfWidgetFormInput(),
      'setup_s'        => new sfWidgetFormInput(),
      'setup_a'        => new sfWidgetFormInput(),
      'setup_v'        => new sfWidgetFormInput(),
      'setup_r'        => new sfWidgetFormInput(),
      'supervisor'     => new sfWidgetFormInput(),
      'nonsupervisor'  => new sfWidgetFormInput(),
      'extvend'        => new sfWidgetFormInput(),
      'extcust'        => new sfWidgetFormInput(),
      'nonext'         => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'Menufunction', 'column' => 'id', 'required' => false)),
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

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Menufunction', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('menufunction[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Menufunction';
  }


}
