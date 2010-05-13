<?php

/**
 * ExtraProductInfo form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseExtraProductInfoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid'          => new sfWidgetFormInputHidden(),
      'best_syst_id'       => new sfWidgetFormInput(),
      'processor_snelheid' => new sfWidgetFormInput(),
      'processor_type'     => new sfWidgetFormInput(),
      'afmetingx'          => new sfWidgetFormInput(),
      'afmetingy'          => new sfWidgetFormInput(),
      'afmetingz'          => new sfWidgetFormInput(),
      'afm_schermx'        => new sfWidgetFormInput(),
      'afm_schermy'        => new sfWidgetFormInput(),
      'resolutiex'         => new sfWidgetFormInput(),
      'resolutiey'         => new sfWidgetFormInput(),
      'kleuren'            => new sfWidgetFormInput(),
      'backlite_yn'        => new sfWidgetFormInput(),
      'infrarood_yn'       => new sfWidgetFormInput(),
      'bluetooth_yn'       => new sfWidgetFormInput(),
      'wlan_yn'            => new sfWidgetFormInput(),
      'gsm_gprs_yn'        => new sfWidgetFormInput(),
      'type_aansluiting'   => new sfWidgetFormTextarea(),
      'accu_type_id'       => new sfWidgetFormInput(),
      'accu_duur'          => new sfWidgetFormInput(),
      'accu_size'          => new sfWidgetFormInput(),
      'geheugen_int'       => new sfWidgetFormInput(),
      'geheugen_ext'       => new sfWidgetFormInput(),
      'geheugen_slot'      => new sfWidgetFormTextarea(),
      'gewicht'            => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'productid'          => new sfValidatorPropelChoice(array('model' => 'ExtraProductInfo', 'column' => 'productid', 'required' => false)),
      'best_syst_id'       => new sfValidatorInteger(),
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
      'backlite_yn'        => new sfValidatorInteger(array('required' => false)),
      'infrarood_yn'       => new sfValidatorInteger(array('required' => false)),
      'bluetooth_yn'       => new sfValidatorInteger(array('required' => false)),
      'wlan_yn'            => new sfValidatorInteger(array('required' => false)),
      'gsm_gprs_yn'        => new sfValidatorInteger(array('required' => false)),
      'type_aansluiting'   => new sfValidatorString(array('required' => false)),
      'accu_type_id'       => new sfValidatorInteger(array('required' => false)),
      'accu_duur'          => new sfValidatorInteger(array('required' => false)),
      'accu_size'          => new sfValidatorInteger(array('required' => false)),
      'geheugen_int'       => new sfValidatorNumber(array('required' => false)),
      'geheugen_ext'       => new sfValidatorNumber(array('required' => false)),
      'geheugen_slot'      => new sfValidatorString(array('required' => false)),
      'gewicht'            => new sfValidatorNumber(array('required' => false)),
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
