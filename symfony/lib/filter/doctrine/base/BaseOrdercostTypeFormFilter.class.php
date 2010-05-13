<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * OrdercostType filter form base class.
 *
 * @package    filters
 * @subpackage OrdercostType *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseOrdercostTypeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'       => new sfWidgetFormFilterInput(),
      'webordercost'      => new sfWidgetFormFilterInput(),
      'minweborderamount' => new sfWidgetFormFilterInput(),
      'ordercost'         => new sfWidgetFormFilterInput(),
      'minorderamount'    => new sfWidgetFormFilterInput(),
      'shippingcost'      => new sfWidgetFormFilterInput(),
      'realcost'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'description'       => new sfValidatorPass(array('required' => false)),
      'webordercost'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'minweborderamount' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'ordercost'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'minorderamount'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'shippingcost'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'realcost'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ordercost_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrdercostType';
  }

  public function getFields()
  {
    return array(
      'ordercostid'       => 'Number',
      'description'       => 'Text',
      'webordercost'      => 'Number',
      'minweborderamount' => 'Number',
      'ordercost'         => 'Number',
      'minorderamount'    => 'Number',
      'shippingcost'      => 'Number',
      'realcost'          => 'Number',
    );
  }
}