<?php

/**
 * Rma form base class.
 *
 * @package    form
 * @subpackage rma
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseRmaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'contacts_id'      => new sfWidgetFormInputText(),
      'productid'        => new sfWidgetFormInputText(),
      'aantal'           => new sfWidgetFormInputText(),
      'sn'               => new sfWidgetFormInputText(),
      'aticle_code'      => new sfWidgetFormInputText(),
      'factuurid'        => new sfWidgetFormInputText(),
      'dummy'            => new sfWidgetFormDateTime(),
      'state'            => new sfWidgetFormInputText(),
      'product_customer' => new sfWidgetFormInputText(),
      'product_location' => new sfWidgetFormInputText(),
      'product_state'    => new sfWidgetFormInputText(),
      'valid'            => new sfWidgetFormInputText(),
      'customer_id'      => new sfWidgetFormInputText(),
      'supplierid'       => new sfWidgetFormInputText(),
      'date_in'          => new sfWidgetFormDate(),
      'reason'           => new sfWidgetFormTextarea(),
      'date_done'        => new sfWidgetFormDate(),
      'additional_items' => new sfWidgetFormInputText(),
      'article_name'     => new sfWidgetFormInputText(),
      'webuser'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => 'Rma', 'column' => 'id', 'required' => false)),
      'contacts_id'      => new sfValidatorInteger(array('required' => false)),
      'productid'        => new sfValidatorInteger(array('required' => false)),
      'aantal'           => new sfValidatorInteger(array('required' => false)),
      'sn'               => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'aticle_code'      => new sfValidatorInteger(array('required' => false)),
      'factuurid'        => new sfValidatorInteger(array('required' => false)),
      'dummy'            => new sfValidatorDateTime(),
      'state'            => new sfValidatorInteger(),
      'product_customer' => new sfValidatorInteger(),
      'product_location' => new sfValidatorInteger(),
      'product_state'    => new sfValidatorInteger(),
      'valid'            => new sfValidatorInteger(array('required' => false)),
      'customer_id'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'supplierid'       => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'date_in'          => new sfValidatorDate(array('required' => false)),
      'reason'           => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'date_done'        => new sfValidatorDate(array('required' => false)),
      'additional_items' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'article_name'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'webuser'          => new sfValidatorString(array('max_length' => 30, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rma';
  }

}