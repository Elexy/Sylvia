<?php

/**
 * PersonenType filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePersonenTypeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'desctription'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'desctription'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('personen_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
