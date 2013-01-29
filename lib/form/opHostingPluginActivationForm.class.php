<?php

/**
 * Plugin Activation Form
 *
 * @package    OpenPNE
 * @subpackage form
 * @author     Kousuke Ebihara <ebihara@tejimaya.com>
 * @author     Shogo Kawahara <kawahara@bucyou.net>
 */
class opHostingPluginActivationForm extends PluginActivationForm
{

  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
    //必須プラグインを変更しようとしたら例外を発生させる

    $choisedPluginNames = $taintedValues['plugin'];

    foreach (opHostingSnsManager::getRequiredPlugin() as $pluginName)
    {
      if (in_array($pluginName, $choisedPluginNames))
      {
        throw new RuntimeException('不正な操作がされました');
      }
    }

    return parent::bind($taintedValues, $taintedFiles);
  }

}
