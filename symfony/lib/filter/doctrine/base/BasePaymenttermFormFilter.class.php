<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Paymentterm filter form base class.
 *
 * @package    filters
 * @subpackage Paymentterm *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BasePaymenttermFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'   => new sfWidgetFormFilterInput(),
      'days'          => new sfWidgetFormFilterInput(),
      'endmonth'      => new sfWidgetFormFilterInput(),
      'incasso'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'description'   => new sfValidatorPass(array('required' => false)),
      'days'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'endmonth'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'incasso'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('paymentterm_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Paymentterm';
  }

  public function getFields()
  {
    return array(
      'paymenttermid' => 'Number',
      'description'   => 'Text',
      'days'          => 'Number',
      'endmonth'      => 'Number',
      'incasso'       => 'Number',
    );
  }
}