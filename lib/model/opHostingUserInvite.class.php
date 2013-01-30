<?php

class opHostingUserInvite
{

  /**
   * 　ユーザーを招待するメンバーID
   */
  private $_memberId;
  /**
   * @var MemberConfig
   */
  private $_memberConfig;

  const INVITE_TOKEN_KEY = 'invite_token';

  public function __construct($memberId)
  {
    $this->_memberId = $memberId;
    $this->_memberConfig = Doctrine::getTable('MemberConfig');
  }

  public static function createInstanceByToken($token)
  {
    $tokenConfig = Doctrine::getTable('MemberConfig')->retrieveByNameAndValue(self::INVITE_TOKEN_KEY, $token);

    if ($tokenConfig === false)
    {
      return false;
    }

    $instance = new opHostingUserInvite((int) $tokenConfig->getMemberId());

    return $instance;
  }

  public function hasInviteToken()
  {
    return!(is_null($this->_findTokenConfig()));
  }

  public function makeInviteToken()
  {
    $this->_memberConfig->setValue($this->_memberId, self::INVITE_TOKEN_KEY, $this->_createToken());
  }

  /**
   * @todo 5桁にして同じトークンを生成しないようにする
   */
  private function _createToken()
  {
    if ($this->hasInviteToken())
    {
      $tokenConfig = $this->_findTokenConfig();
      return $tokenConfig->getValue();
    }

    $token = md5($this->_memberId);

    return $token;
  }

  public function isCorrectInviteToken($checkToken)
  {
    if (!$this->hasInviteToken())
    {
      return false;
    }

    $tokenConfig = $this->_findTokenConfig();
    $token = $tokenConfig->getValue();

    return ($token === $checkToken);
  }

  public function createInviteUrl()
  {
    $url = 'member/invited/'.$this->_createToken();

    return $url;
  }

  public function registerInvitedMemberByInputParam($param)
  {
    $this->_registInvitedBaseData($param);

    throw new RuntimeException('ユーザー情報登録は未実装');

  }

  private function _registInvitedBaseData($param)
  {
    $inviteForm = new InviteForm(null, array('invited' => true));
    $inviteForm->setOption('is_link', true);
    $inviteForm->bind($param);
    $inviteForm->save();
  }

  private function _findTokenConfig()
  {
    return $this->_memberConfig->retrieveByNameAndMemberId(self::INVITE_TOKEN_KEY, $this->_memberId);
  }

}
