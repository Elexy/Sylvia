<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * ExtraProductText filter form base class.
 *
 * @package    filters
 * @subpackage ExtraProductText *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseExtraProductTextFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid' => new sfWidgetFormFilterInput(),
      'text'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'productid' => new sfValidatorPass(array('required' => false)),
      'text'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('extra_product_text_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExtraProductText';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'productid' => 'Text',
      'text'      => 'Text',
    );
  }
}