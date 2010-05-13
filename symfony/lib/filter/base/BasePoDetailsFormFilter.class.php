<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * PoDetails filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePoDetailsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'poid'           => new sfWidgetFormFilterInput(),
      'podate'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'productid'      => new sfWidgetFormFilterInput(),
      'unitprice'      => new sfWidgetFormFilterInput(),
      'quantity'       => new sfWidgetFormFilterInput(),
      'to_deliver'     => new sfWidgetFormFilterInput(),
      'tax_percentage' => new sfWidgetFormFilterInput(),
      'added_cost'     => new sfWidgetFormFilterInput(),
      'last_exp'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'comments'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'poid'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'podate'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'productid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'unitprice'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'quantity'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'to_deliver'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tax_percentage' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'added_cost'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
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
      'podate'         => 'Date',
      'productid'      => 'Number',
      'unitprice'      => 'Number',
      'quantity'       => 'Number',
      'to_deliver'     => 'Number',
      'tax_percentage' => 'Number',
      'added_cost'     => 'Number',
      'last_exp'       => 'Date',
      'comments'       => 'Text',
    );
  }
}
