<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Shippers filter form base class.
 *
 * @package    filters
 * @subpackage Shippers *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseShippersFormFilter extends BaseFormFilterDoctrine
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