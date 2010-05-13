<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Shipments filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseShipmentsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'adressid'    => new sfWidgetFormFilterInput(),
      'start_date'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'ship_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'invoiceid'   => new sfWidgetFormFilterInput(),
      'tracking'    => new sfWidgetFormFilterInput(),
      'cancel'      => new sfWidgetFormFilterInput(),
      'email_send'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'adressid'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'start_date'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'ship_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'invoiceid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tracking'    => new sfValidatorPass(array('required' => false)),
      'cancel'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'email_send'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'start_date'  => 'Date',
      'ship_date'   => 'Date',
      'invoiceid'   => 'Number',
      'tracking'    => 'Text',
      'cancel'      => 'Number',
      'email_send'  => 'Number',
    );
  }
}
