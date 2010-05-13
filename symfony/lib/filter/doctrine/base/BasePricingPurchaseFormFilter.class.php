<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * PricingPurchase filter form base class.
 *
 * @package    filters
 * @subpackage PricingPurchase *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BasePricingPurchaseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'purchase_price' => new sfWidgetFormFilterInput(),
      'currencyid'     => new sfWidgetFormFilterInput(),
      'start_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'end_date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'     => new sfWidgetFormFilterInput(),
      'contactid'      => new sfWidgetFormFilterInput(),
      'productid'      => new sfWidgetFormFilterInput(),
      'price_type'     => new sfWidgetFormFilterInput(),
      'start_number'   => new sfWidgetFormFilterInput(),
      'end_number'     => new sfWidgetFormFilterInput(),
      'modified'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'modified_by'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'purchase_price' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'currencyid'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'start_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'end_date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_by'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'contactid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'productid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'price_type'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'start_number'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'end_number'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'modified'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'modified_by'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('pricing_purchase_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricingPurchase';
  }

  public function getFields()
  {
    return array(
      'recordid'       => 'Number',
      'purchase_price' => 'Number',
      'currencyid'     => 'Number',
      'start_date'     => 'Date',
      'end_date'       => 'Date',
      'created'        => 'Date',
      'created_by'     => 'Number',
      'contactid'      => 'Number',
      'productid'      => 'Number',
      'price_type'     => 'Number',
      'start_number'   => 'Number',
      'end_number'     => 'Number',
      'modified'       => 'Date',
      'modified_by'    => 'Number',
    );
  }
}