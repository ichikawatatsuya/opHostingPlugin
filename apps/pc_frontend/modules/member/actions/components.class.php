<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class memberComponents extends opMemberComponents
{
  public function executeShowInviteUrl($request)
  {
    $userInvite = new opHostingUserInvite((int)$this->getUser()->getMemberId());

    if (!$userInvite->hasInviteToken())
    {
      $userInvite->makeInviteToken();
    }

    $this->inviteUrl = sfContext::getInstance()->getRequest()->getUriPrefix();
    $this->inviteUrl .= '/'.$userInvite->createInviteUrl();
  }
}
