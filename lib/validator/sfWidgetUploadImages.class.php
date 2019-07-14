<?php

class sfWidgetUploadImages extends sfWidgetForm {

  protected function configure($options = array(), $attributes = array()) {
    $this->addOption('has_edit', true);
//        $this->setOption('type', 'hidden');
//    $this->addOption('hideRequiredChar', false);
  }

  public function render($name, $value = null, $attributes = array(), $errors = array()) {
    sfContext::getInstance()->getConfiguration()->loadHelpers("Partial");

//    print_r($value);exit;
    if (count($value['id']) > 0) {
      $value_arr = $value['id'];
      $files = Doctrine_Query::create()
              ->from("AdChainImage a")
              ->whereIn("a.id", $value_arr)
              ->orderBy('a.priority ASC')
              ->fetchArray();
    } else {
      $files = array();
    }

    $array_plus = array('value' => $value, 'name' => $name, 'files' => $files);
//    $array_plus = array('value' => $value, 'name' => $name, 'files' => $model->fetchArray());
    $opt = array_merge($this->getOptions(), $array_plus);
    $content = get_partial('VtNewsWidgetTemplate/partialUploadImages', $opt);
//    print_r($opt);exit;

    return $content;
  }

}
