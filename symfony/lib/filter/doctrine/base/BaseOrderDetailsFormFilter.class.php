<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * OrderDetails filter form base class.
 *
 * @package    filters
 * @subpackage OrderDetails *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseOrderDetailsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'orderid'            => new sfWidgetFormFilterInput(),
      'productid'          => new sfWidgetFormFilterInput(),
      'unitprice'          => new sfWidgetFormFilterInput(),
      'unitcost'           => new sfWidgetFormFilterInput(),
      'unitbtw'            => new sfWidgetFormFilterInput(),
      'quantity'           => new sfWidgetFormFilterInput(),
      'to_deliver'         => new sfWidgetFormFilterInput(),
      'extended_price'     => new sfWidgetFormFilterInput(),
      'dummy'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'contactid'          => new sfWidgetFormFilterInput(),
      'btw_percentage'     => new sfWidgetFormFilterInput(),
      'cost_percentage'    => new sfWidgetFormFilterInput(),
      'manual_price'       => new sfWidgetFormFilterInput(),
      'rma_actionid'       => new sfWidgetFormFilterInput(),
      'stock_owner_id'     => new sfWidgetFormFilterInput(),
      'productname'        => new sfWidgetFormFilterInput(),
      'productdescription' => new sfWidgetFormFilterInput(),
      'discount'           => new sfWidgetFormFilterInput(),
      'serialnb'           => new sfWidgetFormFilterInput(),
      'orderdate'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'custorderrowid'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'orderid'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'productid'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'unitprice'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'unitcost'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'unitbtw'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'quantity'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'to_deliver'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'extended_price'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'dummy'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'contactid'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'btw_percentage'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cost_percentage'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'manual_price'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rma_actionid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stock_owner_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'productname'        => new sfValidatorPass(array('required' => false)),
      'productdescription' => new sfValidatorPass(array('required' => false)),
      'discount'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'serialnb'           => new sfValidatorPass(array('required' => false)),
      'orderdate'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'custorderrowid'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_details_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderDetails';
  }

  public function getFields()
  {
    return array(
      'orderdetailsid'     => 'Number',
      'orderid'            => 'Number',
      'productid'          => 'Number',
      'unitprice'          => 'Number',
      'unitcost'           => 'Number',
      'unitbtw'            => 'Number',
      'quantity'           => 'Number',
      'to_deliver'         => 'Number',
      'extended_price'     => 'Number',
      'dummy'              => 'Date',
      'contactid'          => 'Number',
      'btw_percentage'     => 'Number',
      'cost_percentage'    => 'Number',
      'manual_price'       => 'Number',
      'rma_actionid'       => 'Number',
      'stock_owner_id'     => 'Number',
      'productname'        => 'Text',
      'productdescription' => 'Text',
      'discount'           => 'Number',
      'serialnb'           => 'Text',
      'orderdate'          => 'Date',
      'custorderrowid'     => 'Text',
    );
  }
}