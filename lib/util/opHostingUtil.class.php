<?php

class opHostingUtil
{
  public static function isLoggedInPage()
  {
    //ログインしていない場合は強制的にログインページを表示している
    $memberInstance = sfContext::getInstance()->getUser()->getMember();
    return (get_class($memberInstance) !== 'opAnonymousMember');
  }
}
