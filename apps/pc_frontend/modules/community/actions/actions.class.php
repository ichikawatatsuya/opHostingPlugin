<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * community actions.
 *
 * @package    OpenPNE
 * @subpackage community
 * @author     Kousuke Ebihara <ebihara@tejimaya.com>
 */
class communityActions extends opCommunityAction
{
  const VIEW_SNS_MANAGER = 'SnsManager';

 /**
  * Executes home action
  *
  * @param opWebRequest $request A request object
  */
  public function executeHome(opWebRequest $request)
  {
    $this->forwardIf($request->isSmartphone(), 'community', 'smtHome');

    if (opHostingUtil::isSNSManagerCommunity())
    {
      $this->_operateSNSManagerForm($request);
    }

    return parent::executeHome($request);
  }

 /**
  * Executes smtHome action
  *
  * @param opWebRequest $request A request object
  */
  public function executeSmtHome(opWebRequest $request)
  {
    $gadgets = Doctrine::getTable('Gadget')->retrieveGadgetsByTypesName('smartphoneCommunity');
    $this->contentsGadgets = $gadgets['smartphoneCommunityContents'];

    $this->community = Doctrine::getTable('Community')->find($this->id);
    $this->forward404Unless($this->community);

    opSmartphoneLayoutUtil::setLayoutParameters(array('community' => $this->community));

    return sfView::SUCCESS;
  }

  private function _operateSNSManagerForm(opWebRequest $request)
  {

    $this->form = new opHostingSNSManagerForm();
  }

}
