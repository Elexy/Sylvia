<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ExtraProductText filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseExtraProductTextFormFilter extends BaseFormFilterPropel
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
