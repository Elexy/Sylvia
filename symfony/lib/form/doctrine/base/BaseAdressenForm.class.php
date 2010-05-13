<?php

/**
 * Adressen form base class.
 *
 * @package    form
 * @subpackage adressen
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseAdressenForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'adresid'     => new sfWidgetFormInputHidden(),
      'contactid'   => new sfWidgetFormInputText(),
      'adrestitel'  => new sfWidgetFormInputText(),
      'straat'      => new sfWidgetFormInputText(),
      'postcode'    => new sfWidgetFormInputText(),
      'postbus'     => new sfWidgetFormInputText(),
      'plaats'      => new sfWidgetFormInputText(),
      'land'        => new sfWidgetFormInputText(),
      'dummy'       => new sfWidgetFormDateTime(),
      'prive_adres' => new sfWidgetFormInputText(),
      'naam'        => new sfWidgetFormInputText(),
      'attn'        => new sfWidgetFormInputText(),
      'huisnummer'  => new sfWidgetFormInputText(),
      'email'       => new sfWidgetFormInputText(),
      'telefoon'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'adresid'     => new sfValidatorDoctrineChoice(array('model' => 'Adressen', 'column' => 'adresid', 'required' => false)),
      'contactid'   => new sfValidatorInteger(array('required' => false)),
      'adrestitel'  => new sfValidatorInteger(array('required' => false)),
      'straat'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'postcode'    => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'postbus'     => new sfValidatorInteger(),
      'plaats'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'land'        => new sfValidatorString(array('max_length' => 2)),
      'dummy'       => new sfValidatorDateTime(),
      'prive_adres' => new sfValidatorInteger(),
      'naam'        => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'attn'        => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'huisnummer'  => new sfValidatorString(array('max_length' => 18, 'required' => false)),
      'email'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'telefoon'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('adressen[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Adressen';
  }

}