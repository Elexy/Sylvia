<?php

/**
 * Rma form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseRmaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'contacts_id'      => new sfWidgetFormInput(),
      'productid'        => new sfWidgetFormInput(),
      'aantal'           => new sfWidgetFormInput(),
      'customer_id'      => new sfWidgetFormInput(),
      'supplierid'       => new sfWidgetFormInput(),
      'date_in'          => new sfWidgetFormDate(),
      'sn'               => new sfWidgetFormInput(),
      'reason'           => new sfWidgetFormTextarea(),
      'date_done'        => new sfWidgetFormDate(),
      'additional_items' => new sfWidgetFormInput(),
      'aticle_code'      => new sfWidgetFormInput(),
      'article_name'     => new sfWidgetFormInput(),
      'factuurid'        => new sfWidgetFormInput(),
      'state'            => new sfWidgetFormInput(),
      'product_customer' => new sfWidgetFormInput(),
      'product_location' => new sfWidgetFormInput(),
      'product_state'    => new sfWidgetFormInput(),
      'valid'            => new sfWidgetFormInput(),
      'webuser'          => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'Rma', 'column' => 'id', 'required' => false)),
      'contacts_id'      => new sfValidatorInteger(array('required' => false)),
      'productid'        => new sfValidatorInteger(array('required' => false)),
      'aantal'           => new sfValidatorInteger(array('required' => false)),
      'customer_id'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'supplierid'       => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'date_in'          => new sfValidatorDate(array('required' => false)),
      'sn'               => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'reason'           => new sfValidatorString(array('required' => false)),
      'date_done'        => new sfValidatorDate(array('required' => false)),
      'additional_items' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'aticle_code'      => new sfValidatorInteger(array('required' => false)),
      'article_name'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'factuurid'        => new sfValidatorInteger(array('required' => false)),
      'state'            => new sfValidatorInteger(),
      'product_customer' => new sfValidatorInteger(),
      'product_location' => new sfValidatorInteger(),
      'product_state'    => new sfValidatorInteger(),
      'valid'            => new sfValidatorInteger(array('required' => false)),
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
