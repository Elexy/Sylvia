<?php

/**
 * ExtraProductInfo form base class.
 *
 * @package    form
 * @subpackage extra_product_info
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseExtraProductInfoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid'          => new sfWidgetFormInputHidden(),
      'best_syst_id'       => new sfWidgetFormInputText(),
      'backlite_yn'        => new sfWidgetFormInputText(),
      'infrarood_yn'       => new sfWidgetFormInputText(),
      'bluetooth_yn'       => new sfWidgetFormInputText(),
      'wlan_yn'            => new sfWidgetFormInputText(),
      'gsm_gprs_yn'        => new sfWidgetFormInputText(),
      'accu_size'          => new sfWidgetFormInputText(),
      'geheugen_int'       => new sfWidgetFormInputText(),
      'geheugen_ext'       => new sfWidgetFormInputText(),
      'gewicht'            => new sfWidgetFormInputText(),
      'processor_snelheid' => new sfWidgetFormInputText(),
      'processor_type'     => new sfWidgetFormInputText(),
      'afmetingx'          => new sfWidgetFormInputText(),
      'afmetingy'          => new sfWidgetFormInputText(),
      'afmetingz'          => new sfWidgetFormInputText(),
      'afm_schermx'        => new sfWidgetFormInputText(),
      'afm_schermy'        => new sfWidgetFormInputText(),
      'resolutiex'         => new sfWidgetFormInputText(),
      'resolutiey'         => new sfWidgetFormInputText(),
      'kleuren'            => new sfWidgetFormInputText(),
      'type_aansluiting'   => new sfWidgetFormTextarea(),
      'accu_type_id'       => new sfWidgetFormInputText(),
      'accu_duur'          => new sfWidgetFormInputText(),
      'geheugen_slot'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'productid'          => new sfValidatorDoctrineChoice(array('model' => 'ExtraProductInfo', 'column' => 'productid', 'required' => false)),
      'best_syst_id'       => new sfValidatorInteger(),
      'backlite_yn'        => new sfValidatorInteger(array('required' => false)),
      'infrarood_yn'       => new sfValidatorInteger(array('required' => false)),
      'bluetooth_yn'       => new sfValidatorInteger(array('required' => false)),
      'wlan_yn'            => new sfValidatorInteger(array('required' => false)),
      'gsm_gprs_yn'        => new sfValidatorInteger(array('required' => false)),
      'accu_size'          => new sfValidatorInteger(array('required' => false)),
      'geheugen_int'       => new sfValidatorNumber(array('required' => false)),
      'geheugen_ext'       => new sfValidatorNumber(array('required' => false)),
      'gewicht'            => new sfValidatorNumber(array('required' => false)),
      'processor_snelheid' => new sfValidatorInteger(array('required' => false)),
      'processor_type'     => new sfValidatorInteger(array('required' => false)),
      'afmetingx'          => new sfValidatorNumber(array('required' => false)),
      'afmetingy'          => new sfValidatorNumber(array('required' => false)),
      'afmetingz'          => new sfValidatorNumber(array('required' => false)),
      'afm_schermx'        => new sfValidatorNumber(array('required' => false)),
      'afm_schermy'        => new sfValidatorNumber(array('required' => false)),
      'resolutiex'         => new sfValidatorInteger(array('required' => false)),
      'resolutiey'         => new sfValidatorInteger(array('required' => false)),
      'kleuren'            => new sfValidatorInteger(array('required' => false)),
      'type_aansluiting'   => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'accu_type_id'       => new sfValidatorInteger(array('required' => false)),
      'accu_duur'          => new sfValidatorInteger(array('required' => false)),
      'geheugen_slot'      => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('extra_product_info[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExtraProductInfo';
  }

}