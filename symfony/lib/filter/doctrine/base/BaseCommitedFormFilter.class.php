<?php

/**
 * Commited filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCommitedFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'unitprice'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'unitbtw'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'extended_price'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'discount'           => new sfWidgetFormFilterInput(),
      'dummy'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'shipid'             => new sfWidgetFormFilterInput(),
      'btw_percentage'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cost_percentage'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'delivered'          => new sfWidgetFormFilterInput(),
      'productname'        => new sfWidgetFormFilterInput(),
      'productdescription' => new sfWidgetFormFilterInput(),
      'quantity'           => new sfWidgetFormFilterInput(),
      'serialnb'           => new sfWidgetFormFilterInput(),
      'orderdate'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'unitprice'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'unitbtw'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'extended_price'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'discount'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'dummy'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'shipid'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'btw_percentage'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cost_percentage'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'delivered'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'productname'        => new sfValidatorPass(array('required' => false)),
      'productdescription' => new sfValidatorPass(array('required' => false)),
      'quantity'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'serialnb'           => new sfValidatorPass(array('required' => false)),
      'orderdate'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('commited_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Commited';
  }

  public function getFields()
  {
    return array(
      'orderdetailsid'     => 'Number',
      'orderid'            => 'Number',
      'productid'          => 'Number',
      'unitprice'          => 'Number',
      'unitbtw'            => 'Number',
      'extended_price'     => 'Number',
      'discount'           => 'Number',
      'dummy'              => 'Date',
      'shipid'             => 'Number',
      'btw_percentage'     => 'Number',
      'cost_percentage'    => 'Number',
      'delivered'          => 'Number',
      'productname'        => 'Text',
      'productdescription' => 'Text',
      'quantity'           => 'Number',
      'serialnb'           => 'Text',
      'orderdate'          => 'Date',
    );
  }
}
