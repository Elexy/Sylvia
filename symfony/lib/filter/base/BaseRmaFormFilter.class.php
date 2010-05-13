<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Rma filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseRmaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'contacts_id'      => new sfWidgetFormFilterInput(),
      'productid'        => new sfWidgetFormFilterInput(),
      'aantal'           => new sfWidgetFormFilterInput(),
      'customer_id'      => new sfWidgetFormFilterInput(),
      'supplierid'       => new sfWidgetFormFilterInput(),
      'date_in'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'sn'               => new sfWidgetFormFilterInput(),
      'reason'           => new sfWidgetFormFilterInput(),
      'date_done'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'additional_items' => new sfWidgetFormFilterInput(),
      'aticle_code'      => new sfWidgetFormFilterInput(),
      'article_name'     => new sfWidgetFormFilterInput(),
      'factuurid'        => new sfWidgetFormFilterInput(),
      'state'            => new sfWidgetFormFilterInput(),
      'product_customer' => new sfWidgetFormFilterInput(),
      'product_location' => new sfWidgetFormFilterInput(),
      'product_state'    => new sfWidgetFormFilterInput(),
      'valid'            => new sfWidgetFormFilterInput(),
      'webuser'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contacts_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'productid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'aantal'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'customer_id'      => new sfValidatorPass(array('required' => false)),
      'supplierid'       => new sfValidatorPass(array('required' => false)),
      'date_in'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'sn'               => new sfValidatorPass(array('required' => false)),
      'reason'           => new sfValidatorPass(array('required' => false)),
      'date_done'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'additional_items' => new sfValidatorPass(array('required' => false)),
      'aticle_code'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'article_name'     => new sfValidatorPass(array('required' => false)),
      'factuurid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'state'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'product_customer' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'product_location' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'product_state'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'valid'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'webuser'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rma';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'contacts_id'      => 'Number',
      'productid'        => 'Number',
      'aantal'           => 'Number',
      'customer_id'      => 'Text',
      'supplierid'       => 'Text',
      'date_in'          => 'Date',
      'sn'               => 'Text',
      'reason'           => 'Text',
      'date_done'        => 'Date',
      'additional_items' => 'Text',
      'aticle_code'      => 'Number',
      'article_name'     => 'Text',
      'factuurid'        => 'Number',
      'state'            => 'Number',
      'product_customer' => 'Number',
      'product_location' => 'Number',
      'product_state'    => 'Number',
      'valid'            => 'Number',
      'webuser'          => 'Text',
    );
  }
}
