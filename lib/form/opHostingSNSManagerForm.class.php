<?php

class opHostingSNSManagerForm extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'name' => new sfWidgetFormInputText()
    ));


  }

}
