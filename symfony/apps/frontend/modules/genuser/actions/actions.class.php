<?php

/**
 * genuser actions.
 *
 * @package    andrea
 * @subpackage genuser
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class genuserActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->genuser_list = GenuserPeer::doSelect(new Criteria());
  }

    /**
   * An action multiplying two numbers.
   *
   * @ws-enable
   *
   * @return wsGenuser[] The users
   */

  public function executeGetAll()
  {
    $genusers = wsGenuser::getAll();
    if($genusers) {
      $this->result = $genusers;
      return sfView::SUCCESS;
    } else {
      return sfView::ERROR;
    }
  }


  public function executeNew(sfWebRequest $request)
  {
    $this->form = new GenuserForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new GenuserForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($genuser = GenuserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object genuser does not exist (%s).', $request->getParameter('id')));
    $this->form = new GenuserForm($genuser);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($genuser = GenuserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object genuser does not exist (%s).', $request->getParameter('id')));
    $this->form = new GenuserForm($genuser);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($genuser = GenuserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object genuser does not exist (%s).', $request->getParameter('id')));
    $genuser->delete();

    $this->redirect('genuser/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $genuser = $form->save();

      $this->redirect('genuser/edit?id='.$genuser->getId());
    }
  }

  /**
   * An action multiplying any number of factors.
   *
   * @ws-enable
   * @ws-method SimpleMultiply
   *
   * @param double $a factor a
   * @param double $b factor b
   *
   * @return double The result
   */
  public function executeMultiply($request)
  {
    $factorA = $request->getParameter('a');
    $factorB = $request->getParameter('b');

    if(is_numeric($factorA) && is_numeric($factorB))
    {
      $this->result = $factorA * $factorB;

      return sfView::SUCCESS;
    }
    else
    {
      return sfView::ERROR;
    }
  }

}
