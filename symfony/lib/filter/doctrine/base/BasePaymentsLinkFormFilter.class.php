<?php

/**
 * PaymentsLink filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePaymentsLinkFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'banktransactionid' => new sfWidgetFormFilterInput(array('with_empty' => false)),
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

    $this->setupInheritance();

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
