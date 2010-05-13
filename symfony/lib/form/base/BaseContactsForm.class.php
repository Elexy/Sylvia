<?php

/**
 * Contacts form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseContactsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'           => new sfWidgetFormInputHidden(),
      'companyname'         => new sfWidgetFormInput(),
      'contactfirstname'    => new sfWidgetFormInput(),
      'contacttussenvoegs'  => new sfWidgetFormInput(),
      'contactname'         => new sfWidgetFormInput(),
      'contacttitle'        => new sfWidgetFormInput(),
      'address'             => new sfWidgetFormInput(),
      'city'                => new sfWidgetFormInput(),
      'region'              => new sfWidgetFormInput(),
      'postalcode'          => new sfWidgetFormInput(),
      'country'             => new sfWidgetFormInput(),
      'languageid'          => new sfWidgetFormInput(),
      'phone'               => new sfWidgetFormInput(),
      'fax'                 => new sfWidgetFormInput(),
      'mobilephone'         => new sfWidgetFormInput(),
      'email'               => new sfWidgetFormInput(),
      'website'             => new sfWidgetFormInput(),
      'kvk_number'          => new sfWidgetFormInput(),
      'use_btw'             => new sfWidgetFormInput(),
      'btw_number'          => new sfWidgetFormInput(),
      'bankinfo'            => new sfWidgetFormInput(),
      'paymentterm'         => new sfWidgetFormInput(),
      'paymentterm_margin'  => new sfWidgetFormInput(),
      'upsaccount'          => new sfWidgetFormInput(),
      'conditions_ok_yn'    => new sfWidgetFormInput(),
      'mailing'             => new sfWidgetFormInput(),
      'dealer_yn'           => new sfWidgetFormInput(),
      'auto_yn'             => new sfWidgetFormInput(),
      'watersport_yn'       => new sfWidgetFormInput(),
      'foto_yn'             => new sfWidgetFormInput(),
      'supplier_yn'         => new sfWidgetFormInput(),
      'contacttypeid'       => new sfWidgetFormInput(),
      'aanhef'              => new sfWidgetFormInput(),
      'phoneextention'      => new sfWidgetFormInput(),
      'notes'               => new sfWidgetFormTextarea(),
      'pricelevel'          => new sfWidgetFormInput(),
      'uid'                 => new sfWidgetFormInput(),
      'pwd'                 => new sfWidgetFormInput(),
      'groupid'             => new sfWidgetFormInput(),
      'ordercosts'          => new sfWidgetFormInput(),
      'transportcost'       => new sfWidgetFormInput(),
      'ordercost_type_id'   => new sfWidgetFormInput(),
      'creditlimit'         => new sfWidgetFormInput(),
      'warehouse_customer'  => new sfWidgetFormInput(),
      'consignment'         => new sfWidgetFormInput(),
      'invoice_copies'      => new sfWidgetFormInput(),
      'invoice_copies_iwex' => new sfWidgetFormInput(),
      'invoice_option'      => new sfWidgetFormInput(),
      'confirm_delivery'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'contactid'           => new sfValidatorPropelChoice(array('model' => 'Contacts', 'column' => 'contactid', 'required' => false)),
      'companyname'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'contactfirstname'    => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'contacttussenvoegs'  => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'contactname'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'contacttitle'        => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'address'             => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'city'                => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'region'              => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'postalcode'          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'country'             => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'languageid'          => new sfValidatorInteger(),
      'phone'               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'fax'                 => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'mobilephone'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'email'               => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'website'             => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'kvk_number'          => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'use_btw'             => new sfValidatorInteger(),
      'btw_number'          => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'bankinfo'            => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'paymentterm'         => new sfValidatorInteger(array('required' => false)),
      'paymentterm_margin'  => new sfValidatorInteger(array('required' => false)),
      'upsaccount'          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'conditions_ok_yn'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mailing'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dealer_yn'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'auto_yn'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'watersport_yn'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'foto_yn'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'supplier_yn'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'contacttypeid'       => new sfValidatorInteger(array('required' => false)),
      'aanhef'              => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'phoneextention'      => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'notes'               => new sfValidatorString(array('required' => false)),
      'pricelevel'          => new sfValidatorInteger(array('required' => false)),
      'uid'                 => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'pwd'                 => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'groupid'             => new sfValidatorInteger(array('required' => false)),
      'ordercosts'          => new sfValidatorInteger(array('required' => false)),
      'transportcost'       => new sfValidatorInteger(array('required' => false)),
      'ordercost_type_id'   => new sfValidatorInteger(),
      'creditlimit'         => new sfValidatorInteger(array('required' => false)),
      'warehouse_customer'  => new sfValidatorInteger(),
      'consignment'         => new sfValidatorInteger(),
      'invoice_copies'      => new sfValidatorInteger(),
      'invoice_copies_iwex' => new sfValidatorInteger(),
      'invoice_option'      => new sfValidatorInteger(array('required' => false)),
      'confirm_delivery'    => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('contacts[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contacts';
  }


}
