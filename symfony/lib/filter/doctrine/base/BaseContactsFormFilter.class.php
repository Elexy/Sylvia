<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Contacts filter form base class.
 *
 * @package    filters
 * @subpackage Contacts *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseContactsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'country'             => new sfWidgetFormFilterInput(),
      'languageid'          => new sfWidgetFormFilterInput(),
      'use_btw'             => new sfWidgetFormFilterInput(),
      'paymentterm'         => new sfWidgetFormFilterInput(),
      'paymentterm_margin'  => new sfWidgetFormFilterInput(),
      'contacttypeid'       => new sfWidgetFormFilterInput(),
      'dummy'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'pricelevel'          => new sfWidgetFormFilterInput(),
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
      'companyname'         => new sfWidgetFormFilterInput(),
      'contactfirstname'    => new sfWidgetFormFilterInput(),
      'contacttussenvoegs'  => new sfWidgetFormFilterInput(),
      'contactname'         => new sfWidgetFormFilterInput(),
      'contacttitle'        => new sfWidgetFormFilterInput(),
      'address'             => new sfWidgetFormFilterInput(),
      'city'                => new sfWidgetFormFilterInput(),
      'region'              => new sfWidgetFormFilterInput(),
      'postalcode'          => new sfWidgetFormFilterInput(),
      'phone'               => new sfWidgetFormFilterInput(),
      'fax'                 => new sfWidgetFormFilterInput(),
      'mobilephone'         => new sfWidgetFormFilterInput(),
      'email'               => new sfWidgetFormFilterInput(),
      'website'             => new sfWidgetFormFilterInput(),
      'kvk_number'          => new sfWidgetFormFilterInput(),
      'btw_number'          => new sfWidgetFormFilterInput(),
      'bankinfo'            => new sfWidgetFormFilterInput(),
      'upsaccount'          => new sfWidgetFormFilterInput(),
      'conditions_ok_yn'    => new sfWidgetFormFilterInput(),
      'mailing'             => new sfWidgetFormFilterInput(),
      'dealer_yn'           => new sfWidgetFormFilterInput(),
      'auto_yn'             => new sfWidgetFormFilterInput(),
      'watersport_yn'       => new sfWidgetFormFilterInput(),
      'foto_yn'             => new sfWidgetFormFilterInput(),
      'supplier_yn'         => new sfWidgetFormFilterInput(),
      'aanhef'              => new sfWidgetFormFilterInput(),
      'phoneextention'      => new sfWidgetFormFilterInput(),
      'notes'               => new sfWidgetFormFilterInput(),
      'uid'                 => new sfWidgetFormFilterInput(),
      'pwd'                 => new sfWidgetFormFilterInput(),
      'groupid'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'country'             => new sfValidatorPass(array('required' => false)),
      'languageid'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'use_btw'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'paymentterm'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'paymentterm_margin'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'contacttypeid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dummy'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'pricelevel'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'companyname'         => new sfValidatorPass(array('required' => false)),
      'contactfirstname'    => new sfValidatorPass(array('required' => false)),
      'contacttussenvoegs'  => new sfValidatorPass(array('required' => false)),
      'contactname'         => new sfValidatorPass(array('required' => false)),
      'contacttitle'        => new sfValidatorPass(array('required' => false)),
      'address'             => new sfValidatorPass(array('required' => false)),
      'city'                => new sfValidatorPass(array('required' => false)),
      'region'              => new sfValidatorPass(array('required' => false)),
      'postalcode'          => new sfValidatorPass(array('required' => false)),
      'phone'               => new sfValidatorPass(array('required' => false)),
      'fax'                 => new sfValidatorPass(array('required' => false)),
      'mobilephone'         => new sfValidatorPass(array('required' => false)),
      'email'               => new sfValidatorPass(array('required' => false)),
      'website'             => new sfValidatorPass(array('required' => false)),
      'kvk_number'          => new sfValidatorPass(array('required' => false)),
      'btw_number'          => new sfValidatorPass(array('required' => false)),
      'bankinfo'            => new sfValidatorPass(array('required' => false)),
      'upsaccount'          => new sfValidatorPass(array('required' => false)),
      'conditions_ok_yn'    => new sfValidatorPass(array('required' => false)),
      'mailing'             => new sfValidatorPass(array('required' => false)),
      'dealer_yn'           => new sfValidatorPass(array('required' => false)),
      'auto_yn'             => new sfValidatorPass(array('required' => false)),
      'watersport_yn'       => new sfValidatorPass(array('required' => false)),
      'foto_yn'             => new sfValidatorPass(array('required' => false)),
      'supplier_yn'         => new sfValidatorPass(array('required' => false)),
      'aanhef'              => new sfValidatorPass(array('required' => false)),
      'phoneextention'      => new sfValidatorPass(array('required' => false)),
      'notes'               => new sfValidatorPass(array('required' => false)),
      'uid'                 => new sfValidatorPass(array('required' => false)),
      'pwd'                 => new sfValidatorPass(array('required' => false)),
      'groupid'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'country'             => 'Text',
      'languageid'          => 'Number',
      'use_btw'             => 'Number',
      'paymentterm'         => 'Number',
      'paymentterm_margin'  => 'Number',
      'contacttypeid'       => 'Number',
      'dummy'               => 'Date',
      'pricelevel'          => 'Number',
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
      'companyname'         => 'Text',
      'contactfirstname'    => 'Text',
      'contacttussenvoegs'  => 'Text',
      'contactname'         => 'Text',
      'contacttitle'        => 'Text',
      'address'             => 'Text',
      'city'                => 'Text',
      'region'              => 'Text',
      'postalcode'          => 'Text',
      'phone'               => 'Text',
      'fax'                 => 'Text',
      'mobilephone'         => 'Text',
      'email'               => 'Text',
      'website'             => 'Text',
      'kvk_number'          => 'Text',
      'btw_number'          => 'Text',
      'bankinfo'            => 'Text',
      'upsaccount'          => 'Text',
      'conditions_ok_yn'    => 'Text',
      'mailing'             => 'Text',
      'dealer_yn'           => 'Text',
      'auto_yn'             => 'Text',
      'watersport_yn'       => 'Text',
      'foto_yn'             => 'Text',
      'supplier_yn'         => 'Text',
      'aanhef'              => 'Text',
      'phoneextention'      => 'Text',
      'notes'               => 'Text',
      'uid'                 => 'Text',
      'pwd'                 => 'Text',
      'groupid'             => 'Number',
    );
  }
}