<?php

class opHostingSnsManager
{
  const COMMUNITY_ID = 1;

  public function updateSNSInfoByInputData(array $inputData)
  {
    $nameConfig = Doctrine::getTable('SnsConfig')->retrieveByName('sns_name');
    $nameConfig->setValue($inputData['name']);
    $nameConfig->save();

    return true;
  }

  public function isCommunityMemberByMemberId($memberId)
  {
    return (Doctrine::getTable('CommunityMember')->isMember($memberId, self::COMMUNITY_ID));
  }

}

