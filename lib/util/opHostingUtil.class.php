<?php

class opHostingUtil
{
  

  public static function isLoggedInPage()
  {
    //ログインしていない場合は強制的にログインページを表示している
    $memberInstance = sfContext::getInstance()->getUser()->getMember();
    return (get_class($memberInstance) !== 'opAnonymousMember');
  }

  public static function isSNSManagerCommunityURL()
  {
   
    //commnunityデータ表示画面以外ではアクセスできないようにする
    if (sfContext::getInstance()->getModuleName() !== 'community')
    {
      return false;
    }

    if (sfContext::getInstance()->getActionName() === 'sNSManage')
    {
      return true;
    }

    if (sfContext::getInstance()->getActionName() !== 'home')
    {
      return false;
    }

    return ((int)sfContext::getInstance()->getRequest()->getParameter('id') === opHostingSnsManager::COMMUNITY_ID);
  }

}
