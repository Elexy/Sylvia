<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * PaymentsLink filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePaymentsLinkFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'banktransactionid' => new sfWidgetFormFilterInput(),
      'invoiceid'         => new sfWidgetFormFilterInput(),
      'link_amount'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'banktransactionid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'invoiceid'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'link_amount'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('payments_link_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PaymentsLink';
  }

  public function getFields()
  {
    return array(
      'link_id'           => 'Number',
      'banktransactionid' => 'Number',
      'invoiceid'         => 'Number',
      'link_amount'       => 'Number',
    );
  }
}
