<?php

/**
 * Catalogus filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCatalogusFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'catalogusdesc' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'contactid'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'catalogusdesc' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('catalogus_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
