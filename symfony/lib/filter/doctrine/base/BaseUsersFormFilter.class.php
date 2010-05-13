<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Users filter form base class.
 *
 * @package    filters
 * @subpackage Users *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseUsersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'uid'                   => new sfWidgetFormFilterInput(),
      'languageid'            => new sfWidgetFormFilterInput(),
      'rma'                   => new sfWidgetFormFilterInput(),
      'purchase'              => new sfWidgetFormFilterInput(),
      'stock'                 => new sfWidgetFormFilterInput(),
      'logins'                => new sfWidgetFormFilterInput(),
      'login_attempts'        => new sfWidgetFormFilterInput(),
      'passw_change_attempts' => new sfWidgetFormFilterInput(),
      'total_logins'          => new sfWidgetFormFilterInput(),
      'contactid'             => new sfWidgetFormFilterInput(),
      'companyname'           => new sfWidgetFormFilterInput(),
      'pwd'                   => new sfWidgetFormFilterInput(),
      'email'                 => new sfWidgetFormFilterInput(),
      'last_online'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'uid'                   => new sfValidatorPass(array('required' => false)),
      'languageid'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rma'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'purchase'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stock'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'logins'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'login_attempts'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'passw_change_attempts' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total_logins'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'contactid'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'companyname'           => new sfValidatorPass(array('required' => false)),
      'pwd'                   => new sfValidatorPass(array('required' => false)),
      'email'                 => new sfValidatorPass(array('required' => false)),
      'last_online'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
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
      'uid'                   => 'Text',
      'languageid'            => 'Number',
      'rma'                   => 'Number',
      'purchase'              => 'Number',
      'stock'                 => 'Number',
      'logins'                => 'Number',
      'login_attempts'        => 'Number',
      'passw_change_attempts' => 'Number',
      'total_logins'          => 'Number',
      'contactid'             => 'Number',
      'companyname'           => 'Text',
      'pwd'                   => 'Text',
      'email'                 => 'Text',
      'last_online'           => 'Date',
    );
  }
}