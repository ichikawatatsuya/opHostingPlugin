<?php

/**
 * プラグインだとロードの関係でsymfony標準のカスタムヘルパーを作成できないみたいなので、
 * ヘルパークラスを作成した
 */
class opHostingHelper
{
  public static function create_community_info_data($params)
  {
    extract($params);

    $list = array(__('%community% Name', array('%community%' => $op_term['community']->titleize())) => $community->getName());
    if ($community->community_category_id)
    {
      $list[__('%community% Category', array('%community%' => $op_term['community']->titleize()))] = $community->getCommunityCategory();
    }
    $list += array(__('Date Created') => op_format_date($community->getCreatedAt(), 'D'),
        __('Administrator') => link_to($communityAdmin->getName(), '@member_profile?id='.$communityAdmin->getId()),
    );
    $subAdminCaption = '';
    foreach ($communitySubAdmins as $m)
    {
      $subAdminCaption .= "<li>".link_to($m->getName(), '@member_profile?id='.$m->getId())."</li>\n";
    }
    if ($subAdminCaption)
    {
      $list[__('Sub Administrator')] = '<ul>'.$subAdminCaption.'</ul>';
    }
    $list[__('Count of Members')] = $community->countCommunityMembers();
    foreach ($community->getConfigs() as $key => $config)
    {
      if ('%community% Description' === $key)
      {
        $list[__('%community% Description', array('%community%' => $op_term['community']->titleize()), 'form_community')] = op_url_cmd(nl2br($community->getConfig('description')));
      }
      else
      {
        $list[__($key, array(), 'form_community')] = $config;
      }
    }
    $list[__('Register policy', array(), 'form_community')] = __($community->getRawValue()->getRegisterPolicy());

    $options = array(
        'title' => __('%community%', array('%community%' => $op_term['community']->titleize())),
        'list' => $list,
    );

    return $options;
  }
}