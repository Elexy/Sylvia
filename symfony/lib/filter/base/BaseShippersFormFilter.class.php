<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Shippers filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseShippersFormFilter extends BaseFormFilterPropel
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
