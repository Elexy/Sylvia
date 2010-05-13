<?php

/**
 * Adressen form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseAdressenForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'adresid'     => new sfWidgetFormInputHidden(),
      'contactid'   => new sfWidgetFormInputText(),
      'adrestitel'  => new sfWidgetFormInputText(),
      'naam'        => new sfWidgetFormInputText(),
      'attn'        => new sfWidgetFormInputText(),
      'straat'      => new sfWidgetFormInputText(),
      'huisnummer'  => new sfWidgetFormInputText(),
      'postcode'    => new sfWidgetFormInputText(),
      'postbus'     => new sfWidgetFormInputText(),
      'plaats'      => new sfWidgetFormInputText(),
      'land'        => new sfWidgetFormInputText(),
      'email'       => new sfWidgetFormInputText(),
      'telefoon'    => new sfWidgetFormInputText(),
      'prive_adres' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'adresid'     => new sfValidatorPropelChoice(array('model' => 'Adressen', 'column' => 'adresid', 'required' => false)),
      'contactid'   => new sfValidatorInteger(array('required' => false)),
      'adrestitel'  => new sfValidatorInteger(array('required' => false)),
      'naam'        => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'attn'        => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'straat'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'huisnummer'  => new sfValidatorString(array('max_length' => 18, 'required' => false)),
      'postcode'    => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'postbus'     => new sfValidatorInteger(),
      'plaats'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'land'        => new sfValidatorString(array('max_length' => 2)),
      'email'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'telefoon'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'prive_adres' => new sfValidatorInteger(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Adressen', 'column' => array('adresid')))
    );

    $this->widgetSchema->setNameFormat('adressen[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Adressen';
  }


}
