<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Valuta filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseValutaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'valutaname'     => new sfWidgetFormFilterInput(),
      'valutanamelong' => new sfWidgetFormFilterInput(),
      'valutaxrate'    => new sfWidgetFormFilterInput(),
      'valutadate'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'valutaname'     => new sfValidatorPass(array('required' => false)),
      'valutanamelong' => new sfValidatorPass(array('required' => false)),
      'valutaxrate'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'valutadate'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('valuta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

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
    );
  }
}
