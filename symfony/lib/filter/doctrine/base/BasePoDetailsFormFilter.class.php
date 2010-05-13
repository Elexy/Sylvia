<?php

/**
 * PoDetails filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePoDetailsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'poid'           => new sfWidgetFormFilterInput(),
      'productid'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'unitprice'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'to_deliver'     => new sfWidgetFormFilterInput(),
      'tax_percentage' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'added_cost'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'podate'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'quantity'       => new sfWidgetFormFilterInput(),
      'last_exp'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'comments'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'poid'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'productid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'unitprice'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'to_deliver'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tax_percentage' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'added_cost'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'podate'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'quantity'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'last_exp'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'comments'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('po_details_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
