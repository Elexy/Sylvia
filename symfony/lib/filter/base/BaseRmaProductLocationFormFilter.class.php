<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * RmaProductLocation filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseRmaProductLocationFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'state_id'   => new sfWidgetFormFilterInput(),
      'state_text' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'state_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'state_text' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_product_location_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RmaProductLocation';
  }

  public function getFields()
  {
    return array(
      'state_id'   => 'Number',
      'state_text' => 'Text',
      'id'         => 'Number',
    );
  }
}
