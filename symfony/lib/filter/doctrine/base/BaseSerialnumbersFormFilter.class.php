<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Serialnumbers filter form base class.
 *
 * @package    filters
 * @subpackage Serialnumbers *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseSerialnumbersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'inventory_transactionid' => new sfWidgetFormFilterInput(),
      'serial'                  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'inventory_transactionid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'serial'                  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('serialnumbers_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Serialnumbers';
  }

  public function getFields()
  {
    return array(
      'inventory_transactionid' => 'Number',
      'serial'                  => 'Text',
      'serialrecordid'          => 'Number',
    );
  }
}