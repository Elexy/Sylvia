<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Shipments filter form base class.
 *
 * @package    filters
 * @subpackage Shipments *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseShipmentsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'adressid'    => new sfWidgetFormFilterInput(),
      'invoiceid'   => new sfWidgetFormFilterInput(),
      'tracking'    => new sfWidgetFormFilterInput(),
      'dummy'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'cancel'      => new sfWidgetFormFilterInput(),
      'email_send'  => new sfWidgetFormFilterInput(),
      'start_date'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'ship_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'adressid'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'invoiceid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tracking'    => new sfValidatorPass(array('required' => false)),
      'dummy'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'cancel'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'email_send'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'start_date'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'ship_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('shipments_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Shipments';
  }

  public function getFields()
  {
    return array(
      'shipment_id' => 'Number',
      'adressid'    => 'Number',
      'invoiceid'   => 'Number',
      'tracking'    => 'Text',
      'dummy'       => 'Date',
      'cancel'      => 'Number',
      'email_send'  => 'Number',
      'start_date'  => 'Date',
      'ship_date'   => 'Date',
    );
  }
}