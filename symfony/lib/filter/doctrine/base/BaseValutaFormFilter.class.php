<?php

/**
 * Valuta filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseValutaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'valutaname'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'valutanamelong' => new sfWidgetFormFilterInput(),
      'valutaxrate'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'valutadate'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'dummy'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'valutaname'     => new sfValidatorPass(array('required' => false)),
      'valutanamelong' => new sfValidatorPass(array('required' => false)),
      'valutaxrate'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'valutadate'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'dummy'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('valuta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Valuta';
  }

  public function getFields()
  {
    return array(
      'valutaid'       => 'Number',
      'valutaname'     => 'Text',
      'valutanamelong' => 'Text',
      'valutaxrate'    => 'Number',
      'valutadate'     => 'Date',
      'dummy'          => 'Date',
    );
  }
}
