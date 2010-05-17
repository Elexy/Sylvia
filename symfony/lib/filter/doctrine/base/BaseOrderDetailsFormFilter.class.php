<?php

/**
 * OrderDetails filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseOrderDetailsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'orderid'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'productid'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'unitprice'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'unitcost'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'unitbtw'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'quantity'           => new sfWidgetFormFilterInput(),
      'to_deliver'         => new sfWidgetFormFilterInput(),
      'extended_price'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dummy'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'contactid'          => new sfWidgetFormFilterInput(),
      'btw_percentage'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cost_percentage'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'manual_price'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'rma_actionid'       => new sfWidgetFormFilterInput(),
      'stock_owner_id'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'productname'        => new sfWidgetFormFilterInput(),
      'productdescription' => new sfWidgetFormFilterInput(),
      'discount'           => new sfWidgetFormFilterInput(),
      'serialnb'           => new sfWidgetFormFilterInput(),
      'orderdate'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
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
      'dummy'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
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
      'orderdate'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'custorderrowid'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_details_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
