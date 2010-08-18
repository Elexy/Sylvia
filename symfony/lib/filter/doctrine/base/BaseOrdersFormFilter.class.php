<?php

/**
 * Orders filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseOrdersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'xp_no'                 => new sfWidgetFormFilterInput(),
      'shipvia'               => new sfWidgetFormFilterInput(),
      'shipid'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'locked_yn'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dummy'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'confirmed_yn'          => new sfWidgetFormFilterInput(),
      'blockorder'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'endcustomer_yn'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'paymentterm_yn'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'btw_yn'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'price_level'           => new sfWidgetFormFilterInput(),
      'complete_yn'           => new sfWidgetFormFilterInput(),
      'transportcosts'        => new sfWidgetFormFilterInput(),
      'manual_transportcosts' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ordercosts'            => new sfWidgetFormFilterInput(),
      'manual_ordercosts'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'employee'              => new sfWidgetFormFilterInput(),
      'in_one_delivery_yn'    => new sfWidgetFormFilterInput(),
      'rma_yn'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'consignment_order'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'administration_order'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'contactid'             => new sfWidgetFormFilterInput(),
      'contactsorderid'       => new sfWidgetFormFilterInput(),
      'employeeid'            => new sfWidgetFormFilterInput(),
      'orderdate'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'requireddate'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'shippeddate'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'mailtable'             => new sfWidgetFormFilterInput(),
      'shipname'              => new sfWidgetFormFilterInput(),
      'shipaddress'           => new sfWidgetFormFilterInput(),
      'shipcity'              => new sfWidgetFormFilterInput(),
      'shipregion'            => new sfWidgetFormFilterInput(),
      'shippostalcode'        => new sfWidgetFormFilterInput(),
      'shipcountry'           => new sfWidgetFormFilterInput(),
      'comments'              => new sfWidgetFormFilterInput(),
      'confirmed_how'         => new sfWidgetFormFilterInput(),
      'trackingnummer'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'xp_no'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'shipvia'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'shipid'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'locked_yn'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dummy'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'confirmed_yn'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'blockorder'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'endcustomer_yn'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'paymentterm_yn'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'btw_yn'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'price_level'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'complete_yn'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'transportcosts'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'manual_transportcosts' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ordercosts'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'manual_ordercosts'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'employee'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'in_one_delivery_yn'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rma_yn'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'consignment_order'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'administration_order'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'contactid'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'contactsorderid'       => new sfValidatorPass(array('required' => false)),
      'employeeid'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orderdate'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'requireddate'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'shippeddate'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'mailtable'             => new sfValidatorPass(array('required' => false)),
      'shipname'              => new sfValidatorPass(array('required' => false)),
      'shipaddress'           => new sfValidatorPass(array('required' => false)),
      'shipcity'              => new sfValidatorPass(array('required' => false)),
      'shipregion'            => new sfValidatorPass(array('required' => false)),
      'shippostalcode'        => new sfValidatorPass(array('required' => false)),
      'shipcountry'           => new sfValidatorPass(array('required' => false)),
      'comments'              => new sfValidatorPass(array('required' => false)),
      'confirmed_how'         => new sfValidatorPass(array('required' => false)),
      'trackingnummer'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('orders_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Orders';
  }

  public function getFields()
  {
    return array(
      'orderid'               => 'Number',
      'xp_no'                 => 'Number',
      'shipvia'               => 'Number',
      'shipid'                => 'Number',
      'locked_yn'             => 'Number',
      'dummy'                 => 'Date',
      'confirmed_yn'          => 'Number',
      'blockorder'            => 'Number',
      'endcustomer_yn'        => 'Number',
      'paymentterm_yn'        => 'Number',
      'btw_yn'                => 'Number',
      'price_level'           => 'Number',
      'complete_yn'           => 'Number',
      'transportcosts'        => 'Number',
      'manual_transportcosts' => 'Number',
      'ordercosts'            => 'Number',
      'manual_ordercosts'     => 'Number',
      'employee'              => 'Number',
      'in_one_delivery_yn'    => 'Number',
      'rma_yn'                => 'Number',
      'consignment_order'     => 'Number',
      'administration_order'  => 'Number',
      'contactid'             => 'Number',
      'contactsorderid'       => 'Text',
      'employeeid'            => 'Number',
      'orderdate'             => 'Date',
      'requireddate'          => 'Date',
      'shippeddate'           => 'Date',
      'mailtable'             => 'Text',
      'shipname'              => 'Text',
      'shipaddress'           => 'Text',
      'shipcity'              => 'Text',
      'shipregion'            => 'Text',
      'shippostalcode'        => 'Text',
      'shipcountry'           => 'Text',
      'comments'              => 'Text',
      'confirmed_how'         => 'Text',
      'trackingnummer'        => 'Text',
    );
  }
}
