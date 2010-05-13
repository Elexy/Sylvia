<?php

/**
 * Contacts form base class.
 *
 * @method Contacts getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseContactsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'           => new sfWidgetFormInputHidden(),
      'country'             => new sfWidgetFormInputText(),
      'languageid'          => new sfWidgetFormInputText(),
      'use_btw'             => new sfWidgetFormInputText(),
      'paymentterm'         => new sfWidgetFormInputText(),
      'paymentterm_margin'  => new sfWidgetFormInputText(),
      'contacttypeid'       => new sfWidgetFormInputText(),
      'dummy'               => new sfWidgetFormDateTime(),
      'pricelevel'          => new sfWidgetFormInputText(),
      'ordercosts'          => new sfWidgetFormInputText(),
      'transportcost'       => new sfWidgetFormInputText(),
      'ordercost_type_id'   => new sfWidgetFormInputText(),
      'creditlimit'         => new sfWidgetFormInputText(),
      'warehouse_customer'  => new sfWidgetFormInputText(),
      'consignment'         => new sfWidgetFormInputText(),
      'invoice_copies'      => new sfWidgetFormInputText(),
      'invoice_copies_iwex' => new sfWidgetFormInputText(),
      'invoice_option'      => new sfWidgetFormInputText(),
      'confirm_delivery'    => new sfWidgetFormInputText(),
      'companyname'         => new sfWidgetFormInputText(),
      'contactfirstname'    => new sfWidgetFormInputText(),
      'contacttussenvoegs'  => new sfWidgetFormInputText(),
      'contactname'         => new sfWidgetFormInputText(),
      'contacttitle'        => new sfWidgetFormInputText(),
      'address'             => new sfWidgetFormInputText(),
      'city'                => new sfWidgetFormInputText(),
      'region'              => new sfWidgetFormInputText(),
      'postalcode'          => new sfWidgetFormInputText(),
      'phone'               => new sfWidgetFormInputText(),
      'fax'                 => new sfWidgetFormInputText(),
      'mobilephone'         => new sfWidgetFormInputText(),
      'email'               => new sfWidgetFormInputText(),
      'website'             => new sfWidgetFormInputText(),
      'kvk_number'          => new sfWidgetFormInputText(),
      'btw_number'          => new sfWidgetFormInputText(),
      'bankinfo'            => new sfWidgetFormInputText(),
      'upsaccount'          => new sfWidgetFormInputText(),
      'conditions_ok_yn'    => new sfWidgetFormInputText(),
      'mailing'             => new sfWidgetFormInputText(),
      'dealer_yn'           => new sfWidgetFormInputText(),
      'auto_yn'             => new sfWidgetFormInputText(),
      'watersport_yn'       => new sfWidgetFormInputText(),
      'foto_yn'             => new sfWidgetFormInputText(),
      'supplier_yn'         => new sfWidgetFormInputText(),
      'aanhef'              => new sfWidgetFormInputText(),
      'phoneextention'      => new sfWidgetFormInputText(),
      'notes'               => new sfWidgetFormInputText(),
      'uid'                 => new sfWidgetFormInputText(),
      'pwd'                 => new sfWidgetFormInputText(),
      'groupid'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'contactid'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'contactid', 'required' => false)),
      'country'             => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'languageid'          => new sfValidatorInteger(array('required' => false)),
      'use_btw'             => new sfValidatorInteger(array('required' => false)),
      'paymentterm'         => new sfValidatorInteger(array('required' => false)),
      'paymentterm_margin'  => new sfValidatorInteger(array('required' => false)),
      'contacttypeid'       => new sfValidatorInteger(array('required' => false)),
      'dummy'               => new sfValidatorDateTime(),
      'pricelevel'          => new sfValidatorInteger(array('required' => false)),
      'ordercosts'          => new sfValidatorInteger(array('required' => false)),
      'transportcost'       => new sfValidatorInteger(array('required' => false)),
      'ordercost_type_id'   => new sfValidatorInteger(array('required' => false)),
      'creditlimit'         => new sfValidatorInteger(array('required' => false)),
      'warehouse_customer'  => new sfValidatorInteger(array('required' => false)),
      'consignment'         => new sfValidatorInteger(array('required' => false)),
      'invoice_copies'      => new sfValidatorInteger(array('required' => false)),
      'invoice_copies_iwex' => new sfValidatorInteger(array('required' => false)),
      'invoice_option'      => new sfValidatorInteger(array('required' => false)),
      'confirm_delivery'    => new sfValidatorInteger(),
      'companyname'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'contactfirstname'    => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'contacttussenvoegs'  => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'contactname'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'contacttitle'        => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'address'             => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'city'                => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'region'              => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'postalcode'          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'phone'               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'fax'                 => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'mobilephone'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'email'               => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'website'             => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'kvk_number'          => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'btw_number'          => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'bankinfo'            => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'upsaccount'          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'conditions_ok_yn'    => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'mailing'             => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'dealer_yn'           => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'auto_yn'             => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'watersport_yn'       => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'foto_yn'             => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'supplier_yn'         => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'aanhef'              => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'phoneextention'      => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'notes'               => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'uid'                 => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'pwd'                 => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'groupid'             => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contacts[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contacts';
  }

}
