<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Serialnumbers filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSerialnumbersFormFilter extends BaseFormFilterPropel
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
