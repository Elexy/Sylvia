<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Contacts filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseContactsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'companyname'         => new sfWidgetFormFilterInput(),
      'contactfirstname'    => new sfWidgetFormFilterInput(),
      'contacttussenvoegs'  => new sfWidgetFormFilterInput(),
      'contactname'         => new sfWidgetFormFilterInput(),
      'contacttitle'        => new sfWidgetFormFilterInput(),
      'address'             => new sfWidgetFormFilterInput(),
      'city'                => new sfWidgetFormFilterInput(),
      'region'              => new sfWidgetFormFilterInput(),
      'postalcode'          => new sfWidgetFormFilterInput(),
      'country'             => new sfWidgetFormFilterInput(),
      'languageid'          => new sfWidgetFormFilterInput(),
      'phone'               => new sfWidgetFormFilterInput(),
      'fax'                 => new sfWidgetFormFilterInput(),
      'mobilephone'         => new sfWidgetFormFilterInput(),
      'email'               => new sfWidgetFormFilterInput(),
      'website'             => new sfWidgetFormFilterInput(),
      'kvk_number'          => new sfWidgetFormFilterInput(),
      'use_btw'             => new sfWidgetFormFilterInput(),
      'btw_number'          => new sfWidgetFormFilterInput(),
      'bankinfo'            => new sfWidgetFormFilterInput(),
      'paymentterm'         => new sfWidgetFormFilterInput(),
      'paymentterm_margin'  => new sfWidgetFormFilterInput(),
      'upsaccount'          => new sfWidgetFormFilterInput(),
      'conditions_ok_yn'    => new sfWidgetFormFilterInput(),
      'mailing'             => new sfWidgetFormFilterInput(),
      'dealer_yn'           => new sfWidgetFormFilterInput(),
      'auto_yn'             => new sfWidgetFormFilterInput(),
      'watersport_yn'       => new sfWidgetFormFilterInput(),
      'foto_yn'             => new sfWidgetFormFilterInput(),
      'supplier_yn'         => new sfWidgetFormFilterInput(),
      'contacttypeid'       => new sfWidgetFormFilterInput(),
      'aanhef'              => new sfWidgetFormFilterInput(),
      'phoneextention'      => new sfWidgetFormFilterInput(),
      'notes'               => new sfWidgetFormFilterInput(),
      'pricelevel'          => new sfWidgetFormFilterInput(),
      'uid'                 => new sfWidgetFormFilterInput(),
      'pwd'                 => new sfWidgetFormFilterInput(),
      'groupid'             => new sfWidgetFormFilterInput(),
      'ordercosts'          => new sfWidgetFormFilterInput(),
      'transportcost'       => new sfWidgetFormFilterInput(),
      'ordercost_type_id'   => new sfWidgetFormFilterInput(),
      'creditlimit'         => new sfWidgetFormFilterInput(),
      'warehouse_customer'  => new sfWidgetFormFilterInput(),
      'consignment'         => new sfWidgetFormFilterInput(),
      'invoice_copies'      => new sfWidgetFormFilterInput(),
      'invoice_copies_iwex' => new sfWidgetFormFilterInput(),
      'invoice_option'      => new sfWidgetFormFilterInput(),
      'confirm_delivery'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'companyname'         => new sfValidatorPass(array('required' => false)),
      'contactfirstname'    => new sfValidatorPass(array('required' => false)),
      'contacttussenvoegs'  => new sfValidatorPass(array('required' => false)),
      'contactname'         => new sfValidatorPass(array('required' => false)),
      'contacttitle'        => new sfValidatorPass(array('required' => false)),
      'address'             => new sfValidatorPass(array('required' => false)),
      'city'                => new sfValidatorPass(array('required' => false)),
      'region'              => new sfValidatorPass(array('required' => false)),
      'postalcode'          => new sfValidatorPass(array('required' => false)),
      'country'             => new sfValidatorPass(array('required' => false)),
      'languageid'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'phone'               => new sfValidatorPass(array('required' => false)),
      'fax'                 => new sfValidatorPass(array('required' => false)),
      'mobilephone'         => new sfValidatorPass(array('required' => false)),
      'email'               => new sfValidatorPass(array('required' => false)),
      'website'             => new sfValidatorPass(array('required' => false)),
      'kvk_number'          => new sfValidatorPass(array('required' => false)),
      'use_btw'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'btw_number'          => new sfValidatorPass(array('required' => false)),
      'bankinfo'            => new sfValidatorPass(array('required' => false)),
      'paymentterm'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'paymentterm_margin'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'upsaccount'          => new sfValidatorPass(array('required' => false)),
      'conditions_ok_yn'    => new sfValidatorPass(array('required' => false)),
      'mailing'             => new sfValidatorPass(array('required' => false)),
      'dealer_yn'           => new sfValidatorPass(array('required' => false)),
      'auto_yn'             => new sfValidatorPass(array('required' => false)),
      'watersport_yn'       => new sfValidatorPass(array('required' => false)),
      'foto_yn'             => new sfValidatorPass(array('required' => false)),
      'supplier_yn'         => new sfValidatorPass(array('required' => false)),
      'contacttypeid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'aanhef'              => new sfValidatorPass(array('required' => false)),
      'phoneextention'      => new sfValidatorPass(array('required' => false)),
      'notes'               => new sfValidatorPass(array('required' => false)),
      'pricelevel'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'uid'                 => new sfValidatorPass(array('required' => false)),
      'pwd'                 => new sfValidatorPass(array('required' => false)),
      'groupid'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ordercosts'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'transportcost'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ordercost_type_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'creditlimit'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'warehouse_customer'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'consignment'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'invoice_copies'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'invoice_copies_iwex' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'invoice_option'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'confirm_delivery'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('contacts_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contacts';
  }

  public function getFields()
  {
    return array(
      'contactid'           => 'Number',
      'companyname'         => 'Text',
      'contactfirstname'    => 'Text',
      'contacttussenvoegs'  => 'Text',
      'contactname'         => 'Text',
      'contacttitle'        => 'Text',
      'address'             => 'Text',
      'city'                => 'Text',
      'region'              => 'Text',
      'postalcode'          => 'Text',
      'country'             => 'Text',
      'languageid'          => 'Number',
      'phone'               => 'Text',
      'fax'                 => 'Text',
      'mobilephone'         => 'Text',
      'email'               => 'Text',
      'website'             => 'Text',
      'kvk_number'          => 'Text',
      'use_btw'             => 'Number',
      'btw_number'          => 'Text',
      'bankinfo'            => 'Text',
      'paymentterm'         => 'Number',
      'paymentterm_margin'  => 'Number',
      'upsaccount'          => 'Text',
      'conditions_ok_yn'    => 'Text',
      'mailing'             => 'Text',
      'dealer_yn'           => 'Text',
      'auto_yn'             => 'Text',
      'watersport_yn'       => 'Text',
      'foto_yn'             => 'Text',
      'supplier_yn'         => 'Text',
      'contacttypeid'       => 'Number',
      'aanhef'              => 'Text',
      'phoneextention'      => 'Text',
      'notes'               => 'Text',
      'pricelevel'          => 'Number',
      'uid'                 => 'Text',
      'pwd'                 => 'Text',
      'groupid'             => 'Number',
      'ordercosts'          => 'Number',
      'transportcost'       => 'Number',
      'ordercost_type_id'   => 'Number',
      'creditlimit'         => 'Number',
      'warehouse_customer'  => 'Number',
      'consignment'         => 'Number',
      'invoice_copies'      => 'Number',
      'invoice_copies_iwex' => 'Number',
      'invoice_option'      => 'Number',
      'confirm_delivery'    => 'Number',
    );
  }
}
