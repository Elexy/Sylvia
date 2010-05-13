<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Paymentterm filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePaymenttermFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'paymenttermid' => new sfWidgetFormFilterInput(),
      'description'   => new sfWidgetFormFilterInput(),
      'days'          => new sfWidgetFormFilterInput(),
      'endmonth'      => new sfWidgetFormFilterInput(),
      'incasso'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'paymenttermid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'id'            => 'Number',
    );
  }
}
