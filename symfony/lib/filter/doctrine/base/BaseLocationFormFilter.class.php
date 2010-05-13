<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Location filter form base class.
 *
 * @package    filters
 * @subpackage Location *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseLocationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'location'   => new sfWidgetFormFilterInput(),
      'walk_order' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'location'   => new sfValidatorPass(array('required' => false)),
      'walk_order' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('location_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Location';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'location'   => 'Text',
      'walk_order' => 'Number',
    );
  }
}