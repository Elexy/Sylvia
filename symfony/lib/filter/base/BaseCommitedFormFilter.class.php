<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Commited filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCommitedFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'productname'        => new sfWidgetFormFilterInput(),
      'productdescription' => new sfWidgetFormFilterInput(),
      'unitprice'          => new sfWidgetFormFilterInput(),
      'unitbtw'            => new sfWidgetFormFilterInput(),
      'quantity'           => new sfWidgetFormFilterInput(),
      'extended_price'     => new sfWidgetFormFilterInput(),
      'discount'           => new sfWidgetFormFilterInput(),
      'serialnb'           => new sfWidgetFormFilterInput(),
      'shipid'             => new sfWidgetFormFilterInput(),
      'orderdate'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'btw_percentage'     => new sfWidgetFormFilterInput(),
      'cost_percentage'    => new sfWidgetFormFilterInput(),
      'delivered'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'productname'        => new sfValidatorPass(array('required' => false)),
      'productdescription' => new sfValidatorPass(array('required' => false)),
      'unitprice'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'unitbtw'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'quantity'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'extended_price'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'discount'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'serialnb'           => new sfValidatorPass(array('required' => false)),
      'shipid'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orderdate'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'btw_percentage'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cost_percentage'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'delivered'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('commited_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

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
      'productname'        => 'Text',
      'productdescription' => 'Text',
      'unitprice'          => 'Number',
      'unitbtw'            => 'Number',
      'quantity'           => 'Number',
      'extended_price'     => 'Number',
      'discount'           => 'Number',
      'serialnb'           => 'Text',
      'shipid'             => 'Number',
      'orderdate'          => 'Date',
      'btw_percentage'     => 'Number',
      'cost_percentage'    => 'Number',
      'delivered'          => 'Number',
    );
  }
}
