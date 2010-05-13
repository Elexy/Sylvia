<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Orders filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseOrdersFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'             => new sfWidgetFormFilterInput(),
      'contactsorderid'       => new sfWidgetFormFilterInput(),
      'employeeid'            => new sfWidgetFormFilterInput(),
      'orderdate'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'requireddate'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'shippeddate'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'xp_no'                 => new sfWidgetFormFilterInput(),
      'mailtable'             => new sfWidgetFormFilterInput(),
      'shipvia'               => new sfWidgetFormFilterInput(),
      'shipid'                => new sfWidgetFormFilterInput(),
      'shipname'              => new sfWidgetFormFilterInput(),
      'shipaddress'           => new sfWidgetFormFilterInput(),
      'shipcity'              => new sfWidgetFormFilterInput(),
      'shipregion'            => new sfWidgetFormFilterInput(),
      'shippostalcode'        => new sfWidgetFormFilterInput(),
      'shipcountry'           => new sfWidgetFormFilterInput(),
      'locked_yn'             => new sfWidgetFormFilterInput(),
      'comments'              => new sfWidgetFormFilterInput(),
      'confirmed_yn'          => new sfWidgetFormFilterInput(),
      'blockorder'            => new sfWidgetFormFilterInput(),
      'confirmed_how'         => new sfWidgetFormFilterInput(),
      'endcustomer_yn'        => new sfWidgetFormFilterInput(),
      'paymentterm_yn'        => new sfWidgetFormFilterInput(),
      'trackingnummer'        => new sfWidgetFormFilterInput(),
      'btw_yn'                => new sfWidgetFormFilterInput(),
      'price_level'           => new sfWidgetFormFilterInput(),
      'complete_yn'           => new sfWidgetFormFilterInput(),
      'transportcosts'        => new sfWidgetFormFilterInput(),
      'manual_transportcosts' => new sfWidgetFormFilterInput(),
      'ordercosts'            => new sfWidgetFormFilterInput(),
      'manual_ordercosts'     => new sfWidgetFormFilterInput(),
      'employee'              => new sfWidgetFormFilterInput(),
      'in_one_delivery_yn'    => new sfWidgetFormFilterInput(),
      'rma_yn'                => new sfWidgetFormFilterInput(),
      'consignment_order'     => new sfWidgetFormFilterInput(),
      'administration_order'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contactid'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'contactsorderid'       => new sfValidatorPass(array('required' => false)),
      'employeeid'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orderdate'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'requireddate'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'shippeddate'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'xp_no'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mailtable'             => new sfValidatorPass(array('required' => false)),
      'shipvia'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'shipid'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'shipname'              => new sfValidatorPass(array('required' => false)),
      'shipaddress'           => new sfValidatorPass(array('required' => false)),
      'shipcity'              => new sfValidatorPass(array('required' => false)),
      'shipregion'            => new sfValidatorPass(array('required' => false)),
      'shippostalcode'        => new sfValidatorPass(array('required' => false)),
      'shipcountry'           => new sfValidatorPass(array('required' => false)),
      'locked_yn'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'comments'              => new sfValidatorPass(array('required' => false)),
      'confirmed_yn'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'blockorder'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'confirmed_how'         => new sfValidatorPass(array('required' => false)),
      'endcustomer_yn'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'paymentterm_yn'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'trackingnummer'        => new sfValidatorPass(array('required' => false)),
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
    ));

    $this->widgetSchema->setNameFormat('orders_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

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
      'contactid'             => 'Number',
      'contactsorderid'       => 'Text',
      'employeeid'            => 'Number',
      'orderdate'             => 'Date',
      'requireddate'          => 'Date',
      'shippeddate'           => 'Date',
      'xp_no'                 => 'Number',
      'mailtable'             => 'Text',
      'shipvia'               => 'Number',
      'shipid'                => 'Number',
      'shipname'              => 'Text',
      'shipaddress'           => 'Text',
      'shipcity'              => 'Text',
      'shipregion'            => 'Text',
      'shippostalcode'        => 'Text',
      'shipcountry'           => 'Text',
      'locked_yn'             => 'Number',
      'comments'              => 'Text',
      'confirmed_yn'          => 'Number',
      'blockorder'            => 'Number',
      'confirmed_how'         => 'Text',
      'endcustomer_yn'        => 'Number',
      'paymentterm_yn'        => 'Number',
      'trackingnummer'        => 'Text',
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
    );
  }
}
