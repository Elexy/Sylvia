<?php

/**
 * Shippers filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseShippersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'companyname' => new sfWidgetFormFilterInput(),
      'phone'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'companyname' => new sfValidatorPass(array('required' => false)),
      'phone'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shippers_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Shippers';
  }

  public function getFields()
  {
    return array(
      'shipperid'   => 'Number',
      'companyname' => 'Text',
      'phone'       => 'Text',
    );
  }
}
