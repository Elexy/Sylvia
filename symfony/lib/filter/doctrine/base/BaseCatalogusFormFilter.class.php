<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Catalogus filter form base class.
 *
 * @package    filters
 * @subpackage Catalogus *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseCatalogusFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'     => new sfWidgetFormFilterInput(),
      'catalogusdesc' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contactid'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'catalogusdesc' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('catalogus_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Catalogus';
  }

  public function getFields()
  {
    return array(
      'contactid'     => 'Number',
      'catalogusid'   => 'Number',
      'catalogusdesc' => 'Text',
    );
  }
}