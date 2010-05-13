<?php

/**
 * user actions.
 *
 * @package    andrea
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class userActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->users_list = UsersPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new UsersForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new UsersForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($users = UsersPeer::retrieveByPk($request->getParameter('id')), sprintf('Object users does not exist (%s).', $request->getParameter('id')));
    $this->form = new UsersForm($users);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($users = UsersPeer::retrieveByPk($request->getParameter('id')), sprintf('Object users does not exist (%s).', $request->getParameter('id')));
    $this->form = new UsersForm($users);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($users = UsersPeer::retrieveByPk($request->getParameter('id')), sprintf('Object users does not exist (%s).', $request->getParameter('id')));
    $users->delete();

    $this->redirect('user/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $users = $form->save();

      $this->redirect('user/edit?id='.$users->getId());
    }
  }
}
