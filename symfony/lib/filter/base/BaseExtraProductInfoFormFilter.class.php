<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ExtraProductInfo filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseExtraProductInfoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'best_syst_id'       => new sfWidgetFormFilterInput(),
      'processor_snelheid' => new sfWidgetFormFilterInput(),
      'processor_type'     => new sfWidgetFormFilterInput(),
      'afmetingx'          => new sfWidgetFormFilterInput(),
      'afmetingy'          => new sfWidgetFormFilterInput(),
      'afmetingz'          => new sfWidgetFormFilterInput(),
      'afm_schermx'        => new sfWidgetFormFilterInput(),
      'afm_schermy'        => new sfWidgetFormFilterInput(),
      'resolutiex'         => new sfWidgetFormFilterInput(),
      'resolutiey'         => new sfWidgetFormFilterInput(),
      'kleuren'            => new sfWidgetFormFilterInput(),
      'backlite_yn'        => new sfWidgetFormFilterInput(),
      'infrarood_yn'       => new sfWidgetFormFilterInput(),
      'bluetooth_yn'       => new sfWidgetFormFilterInput(),
      'wlan_yn'            => new sfWidgetFormFilterInput(),
      'gsm_gprs_yn'        => new sfWidgetFormFilterInput(),
      'type_aansluiting'   => new sfWidgetFormFilterInput(),
      'accu_type_id'       => new sfWidgetFormFilterInput(),
      'accu_duur'          => new sfWidgetFormFilterInput(),
      'accu_size'          => new sfWidgetFormFilterInput(),
      'geheugen_int'       => new sfWidgetFormFilterInput(),
      'geheugen_ext'       => new sfWidgetFormFilterInput(),
      'geheugen_slot'      => new sfWidgetFormFilterInput(),
      'gewicht'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'best_syst_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'processor_snelheid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'processor_type'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'afmetingx'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'afmetingy'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'afmetingz'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'afm_schermx'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'afm_schermy'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'resolutiex'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'resolutiey'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'kleuren'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'backlite_yn'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'infrarood_yn'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'bluetooth_yn'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'wlan_yn'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'gsm_gprs_yn'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type_aansluiting'   => new sfValidatorPass(array('required' => false)),
      'accu_type_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'accu_duur'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'accu_size'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'geheugen_int'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'geheugen_ext'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'geheugen_slot'      => new sfValidatorPass(array('required' => false)),
      'gewicht'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('extra_product_info_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExtraProductInfo';
  }

  public function getFields()
  {
    return array(
      'productid'          => 'Number',
      'best_syst_id'       => 'Number',
      'processor_snelheid' => 'Number',
      'processor_type'     => 'Number',
      'afmetingx'          => 'Number',
      'afmetingy'          => 'Number',
      'afmetingz'          => 'Number',
      'afm_schermx'        => 'Number',
      'afm_schermy'        => 'Number',
      'resolutiex'         => 'Number',
      'resolutiey'         => 'Number',
      'kleuren'            => 'Number',
      'backlite_yn'        => 'Number',
      'infrarood_yn'       => 'Number',
      'bluetooth_yn'       => 'Number',
      'wlan_yn'            => 'Number',
      'gsm_gprs_yn'        => 'Number',
      'type_aansluiting'   => 'Text',
      'accu_type_id'       => 'Number',
      'accu_duur'          => 'Number',
      'accu_size'          => 'Number',
      'geheugen_int'       => 'Number',
      'geheugen_ext'       => 'Number',
      'geheugen_slot'      => 'Text',
      'gewicht'            => 'Number',
    );
  }
}
