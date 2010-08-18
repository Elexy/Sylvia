<?php

/**
 * RMA filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRMAFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contacts_id'      => new sfWidgetFormFilterInput(),
      'productid'        => new sfWidgetFormFilterInput(),
      'aantal'           => new sfWidgetFormFilterInput(),
      'sn'               => new sfWidgetFormFilterInput(),
      'aticle_code'      => new sfWidgetFormFilterInput(),
      'factuurid'        => new sfWidgetFormFilterInput(),
      'dummy'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'state'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'product_customer' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'product_location' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'product_state'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'valid'            => new sfWidgetFormFilterInput(),
      'customer_id'      => new sfWidgetFormFilterInput(),
      'supplierid'       => new sfWidgetFormFilterInput(),
      'date_in'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'reason'           => new sfWidgetFormFilterInput(),
      'date_done'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'additional_items' => new sfWidgetFormFilterInput(),
      'article_name'     => new sfWidgetFormFilterInput(),
      'webuser'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contacts_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'productid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'aantal'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sn'               => new sfValidatorPass(array('required' => false)),
      'aticle_code'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'factuurid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dummy'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'state'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'product_customer' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'product_location' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'product_state'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'valid'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'customer_id'      => new sfValidatorPass(array('required' => false)),
      'supplierid'       => new sfValidatorPass(array('required' => false)),
      'date_in'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'reason'           => new sfValidatorPass(array('required' => false)),
      'date_done'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'additional_items' => new sfValidatorPass(array('required' => false)),
      'article_name'     => new sfValidatorPass(array('required' => false)),
      'webuser'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RMA';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'contacts_id'      => 'Number',
      'productid'        => 'Number',
      'aantal'           => 'Number',
      'sn'               => 'Text',
      'aticle_code'      => 'Number',
      'factuurid'        => 'Number',
      'dummy'            => 'Date',
      'state'            => 'Number',
      'product_customer' => 'Number',
      'product_location' => 'Number',
      'product_state'    => 'Number',
      'valid'            => 'Number',
      'customer_id'      => 'Text',
      'supplierid'       => 'Text',
      'date_in'          => 'Date',
      'reason'           => 'Text',
      'date_done'        => 'Date',
      'additional_items' => 'Text',
      'article_name'     => 'Text',
      'webuser'          => 'Text',
    );
  }
}
