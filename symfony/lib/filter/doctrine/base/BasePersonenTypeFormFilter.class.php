<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * PersonenType filter form base class.
 *
 * @package    filters
 * @subpackage PersonenType *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BasePersonenTypeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'desctription'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'desctription'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('personen_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PersonenType';
  }

  public function getFields()
  {
    return array(
      'personen_type_id' => 'Number',
      'desctription'     => 'Text',
    );
  }
}