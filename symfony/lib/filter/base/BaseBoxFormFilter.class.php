<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Box filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBoxFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'shipment_id'      => new sfWidgetFormFilterInput(),
      'tracking'         => new sfWidgetFormFilterInput(),
      'weight_kg'        => new sfWidgetFormFilterInput(),
      'length_cm'        => new sfWidgetFormFilterInput(),
      'width_cm'         => new sfWidgetFormFilterInput(),
      'height_cm'        => new sfWidgetFormFilterInput(),
      'volume_weight_kg' => new sfWidgetFormFilterInput(),
      'box_number'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'shipment_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tracking'         => new sfValidatorPass(array('required' => false)),
      'weight_kg'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'length_cm'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'width_cm'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'height_cm'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'volume_weight_kg' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'box_number'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('box_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Box';
  }

  public function getFields()
  {
    return array(
      'box_id'           => 'Number',
      'shipment_id'      => 'Number',
      'tracking'         => 'Text',
      'weight_kg'        => 'Number',
      'length_cm'        => 'Number',
      'width_cm'         => 'Number',
      'height_cm'        => 'Number',
      'volume_weight_kg' => 'Number',
      'box_number'       => 'Number',
    );
  }
}
