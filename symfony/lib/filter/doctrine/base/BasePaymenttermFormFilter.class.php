<?php

/**
 * Paymentterm filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePaymenttermFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'days'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'endmonth'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'incasso'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'description'   => new sfValidatorPass(array('required' => false)),
      'days'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'endmonth'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'incasso'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('paymentterm_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
