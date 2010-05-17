<?php

/**
 * ExtraProductText filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseExtraProductTextFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'text'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'productid' => new sfValidatorPass(array('required' => false)),
      'text'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('extra_product_text_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
