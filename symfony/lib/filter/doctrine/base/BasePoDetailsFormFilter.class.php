<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * PoDetails filter form base class.
 *
 * @package    filters
 * @subpackage PoDetails *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BasePoDetailsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'poid'           => new sfWidgetFormFilterInput(),
      'productid'      => new sfWidgetFormFilterInput(),
      'unitprice'      => new sfWidgetFormFilterInput(),
      'to_deliver'     => new sfWidgetFormFilterInput(),
      'tax_percentage' => new sfWidgetFormFilterInput(),
      'added_cost'     => new sfWidgetFormFilterInput(),
      'podate'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'quantity'       => new sfWidgetFormFilterInput(),
      'last_exp'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'comments'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'poid'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'productid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'unitprice'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'to_deliver'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tax_percentage' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'added_cost'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'podate'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'quantity'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'last_exp'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'comments'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('po_details_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PoDetails';
  }

  public function getFields()
  {
    return array(
      'podetailsid'    => 'Number',
      'poid'           => 'Number',
      'productid'      => 'Number',
      'unitprice'      => 'Number',
      'to_deliver'     => 'Number',
      'tax_percentage' => 'Number',
      'added_cost'     => 'Number',
      'podate'         => 'Date',
      'quantity'       => 'Number',
      'last_exp'       => 'Date',
      'comments'       => 'Text',
    );
  }
}