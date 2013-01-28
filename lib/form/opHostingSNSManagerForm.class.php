<?php

class opHostingSNSManagerForm extends sfForm
{
  public function configure()
  {
    $this->widgetSchema['name'] = new sfWidgetFormInputText();
 
    $this->widgetSchema->setLabels(array(
       'name' => 'SNS名',
    ));

    $this->widgetSchema->setNameFormat('manager[%s]');

    $this->setValidators(array(
        'name' => new sfValidatorString(array('required' => true), array('required' => 'SNS名を入力してください')),
    ));
  }

}
