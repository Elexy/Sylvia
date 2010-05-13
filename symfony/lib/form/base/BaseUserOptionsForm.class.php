<?php

/**
 * UserOptions form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseUserOptionsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_options_id' => new sfWidgetFormInputHidden(),
      'userid'          => new sfWidgetFormInput(),
      'brancheadmin'    => new sfWidgetFormInput(),
      'rma'             => new sfWidgetFormInput(),
      'purchase'        => new sfWidgetFormInput(),
      'stock'           => new sfWidgetFormInput(),
      'catalogus'       => new sfWidgetFormInput(),
      'add_users'       => new sfWidgetFormInput(),
      'retail_price'    => new sfWidgetFormInput(),
      'warehouseprice'  => new sfWidgetFormInput(),
      'template'        => new sfWidgetFormInput(),
      'rights'          => new sfWidgetFormInput(),
      'margins'         => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'user_options_id' => new sfValidatorPropelChoice(array('model' => 'UserOptions', 'column' => 'user_options_id', 'required' => false)),
      'userid'          => new sfValidatorInteger(array('required' => false)),
      'brancheadmin'    => new sfValidatorInteger(array('required' => false)),
      'rma'             => new sfValidatorInteger(array('required' => false)),
      'purchase'        => new sfValidatorInteger(array('required' => false)),
      'stock'           => new sfValidatorInteger(array('required' => false)),
      'catalogus'       => new sfValidatorInteger(array('required' => false)),
      'add_users'       => new sfValidatorInteger(array('required' => false)),
      'retail_price'    => new sfValidatorInteger(array('required' => false)),
      'warehouseprice'  => new sfValidatorInteger(array('required' => false)),
      'template'        => new sfValidatorInteger(array('required' => false)),
      'rights'          => new sfValidatorInteger(array('required' => false)),
      'margins'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'UserOptions', 'column' => array('user_options_id')))
    );

    $this->widgetSchema->setNameFormat('user_options[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserOptions';
  }


}
