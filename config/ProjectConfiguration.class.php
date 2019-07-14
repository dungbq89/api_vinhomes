<?php

require_once dirname(__FILE__) . '/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration {

    public function setup() {
        $this->enablePlugins(array('sfThumbnailPlugin',
                                    'sfDoctrinePlugin',
                                    'sfCKEditorPlugin',
                                    'sfDatePickerTimePlugin',
                                    'sfDoctrineGuardPlugin',
                                    'sfFormExtraPlugin',
                                    'tmcTwitterBootstrapPlugin',
                                    'sfCaptchaGDPlugin',
                                    'sfPhpExcelPlugin'
//                                    'vtAdvertisePlugin'
                                    ));
//    $this->setWebDir(sfConfig::get('sf_root_dir').'/web');
//    $this->registerZend();
      $this->enablePlugins('sfDoctrineGuardPlugin');
      $this->registerSolarium();
  }
    static protected $zendLoaded = false;
    static protected $solariumLoaded = false;
  
  public function configure()
  {
  }
  
  static public function registerZend()
  {
    if (self::$zendLoaded)
    {
    		return;
    }
    set_include_path(sfConfig::get('sf_lib_dir').'/vendor'.PATH_SEPARATOR.get_include_path());
    require_once sfConfig::get('sf_lib_dir').'/vendor/Zend/Loader/Autoloader.php';
    Zend_Loader_Autoloader::getInstance();
    self::$zendLoaded = true;
  }

    static public function registerSolarium()
    {
        if (self::$solariumLoaded)
        {
            return;
        }
        set_include_path(sfConfig::get('sf_lib_dir').'/vendor'.PATH_SEPARATOR.get_include_path());
        require_once sfConfig::get('sf_lib_dir').'/vendor/Solarium/Autoloader.php';
        Solarium_Autoloader::register();
        //    Solarium_Autoloader::getInstance();
        self::$solariumLoaded = true;
    }
}
