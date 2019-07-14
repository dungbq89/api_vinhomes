<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorEmail validates emails.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfValidatorEmail.class.php 22149 2009-09-18 14:09:53Z Kris.Wallsmith $
 */
class sfValidatorEmail extends sfValidatorRegex {
  /**
   * Sua lai regex validate email 
   * @author NamDT5
   * @modified on 22/11/2013
   */
  //const REGEX_EMAIL = '/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/i';

  const REGEX_EMAIL = '/^((?:(?:(?:[a-zA-Z0-9][\.\+_]?)*)[a-zA-Z0-9])+)\@((?:(?:(?:[a-zA-Z0-9][\.\-_]?){0,62})[a-zA-Z0-9])+)\.([a-zA-Z0-9]{2,6})$/';

  /**
   * @see sfValidatorRegex
   */
  protected function configure($options = array(), $messages = array()) {
    parent::configure($options, $messages);

    $this->setOption('pattern', self::REGEX_EMAIL);
  }

}
