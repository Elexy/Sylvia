<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * PaymentsLink filter form base class.
 *
 * @package    filters
 * @subpackage PaymentsLink *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BasePaymentsLinkFormFilter extends BaseFormFilterDoctrine
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