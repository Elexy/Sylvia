<?php

/**
 * Shipments filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseShipmentsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'adressid'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'invoiceid'   => new sfWidgetFormFilterInput(),
      'tracking'    => new sfWidgetFormFilterInput(),
      'dummy'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'cancel'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email_send'  => new sfWidgetFormFilterInput(),
      'start_date'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ship_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'adressid'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'invoiceid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tracking'    => new sfValidatorPass(array('required' => false)),
      'dummy'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'cancel'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'email_send'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'start_date'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ship_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('shipments_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
