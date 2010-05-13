<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Users filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseUsersFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'             => new sfWidgetFormFilterInput(),
      'companyname'           => new sfWidgetFormFilterInput(),
      'uid'                   => new sfWidgetFormFilterInput(),
      'pwd'                   => new sfWidgetFormFilterInput(),
      'email'                 => new sfWidgetFormFilterInput(),
      'languageid'            => new sfWidgetFormFilterInput(),
      'rma'                   => new sfWidgetFormFilterInput(),
      'purchase'              => new sfWidgetFormFilterInput(),
      'stock'                 => new sfWidgetFormFilterInput(),
      'logins'                => new sfWidgetFormFilterInput(),
      'login_attempts'        => new sfWidgetFormFilterInput(),
      'passw_change_attempts' => new sfWidgetFormFilterInput(),
      'last_online'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'total_logins'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contactid'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'companyname'           => new sfValidatorPass(array('required' => false)),
      'uid'                   => new sfValidatorPass(array('required' => false)),
      'pwd'                   => new sfValidatorPass(array('required' => false)),
      'email'                 => new sfValidatorPass(array('required' => false)),
      'languageid'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rma'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'purchase'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stock'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'logins'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'login_attempts'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'passw_change_attempts' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'last_online'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'total_logins'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('users_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Users';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'contactid'             => 'Number',
      'companyname'           => 'Text',
      'uid'                   => 'Text',
      'pwd'                   => 'Text',
      'email'                 => 'Text',
      'languageid'            => 'Number',
      'rma'                   => 'Number',
      'purchase'              => 'Number',
      'stock'                 => 'Number',
      'logins'                => 'Number',
      'login_attempts'        => 'Number',
      'passw_change_attempts' => 'Number',
      'last_online'           => 'Date',
      'total_logins'          => 'Number',
    );
  }
}
