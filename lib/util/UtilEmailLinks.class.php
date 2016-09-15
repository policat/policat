<?php

/*
 * Copyright (c) 2016, webvariants GmbH <?php Co. KG, http://www.webvariants.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

class UtilEmailLinks {

  const VALIDATION = 1;
  const DISCONFIRMATION = 2;
  const REFERER = 3;
  const READMORE = 4;
  const PLEDGE = 5;
  const UNSUBSCRIBE = 6;
  const EDIT = 7;

  static $NAME = array(
      self::VALIDATION => 'Validation URL',
      self::DISCONFIRMATION => 'Disconfirmation URL',
      self::REFERER => 'Referer URL',
      self::READMORE => 'Read more URL',
      self::PLEDGE => 'Pledge URL',
      self::UNSUBSCRIBE => 'Unsubscribe URL',
      self::EDIT => 'Edit URL'
  );
  static $TEXT = array(
      self::VALIDATION => 'Confirm your email address',
      self::DISCONFIRMATION => 'Revoke participation & delete my data',
      self::REFERER => 'Take action',
      self::READMORE => 'Read more',
      self::PLEDGE => 'Pledge now',
      self::UNSUBSCRIBE => 'Unsubscribe',
      self::EDIT => 'Edit widget'
  );
  static $SHORTCUT = array(
      self::VALIDATION => '#VALIDATION-URL#', // LARGE BUTTON
      self::DISCONFIRMATION => '#DISCONFIRMATION-URL#', // LINK
      self::REFERER => '#REFERER-URL#', // LINK
      self::READMORE => '#READMORE-URL#', // LINK
      self::PLEDGE => '#PLEDGE-URL#', // LARGE BUTTON
      self::UNSUBSCRIBE => '#UNSUBSCRIBE-URL#', // LINK
      self::EDIT => '#EDIT-URL#'  // BUTTON
  );
  static $PATH = array(
      self::VALIDATION => array('/validate/', '/widgetval/', '/register/', '/forgotten/'),
      self::DISCONFIRMATION => array('/delete/'),
      self::REFERER => null,
      self::READMORE => null,
      self::PLEDGE => array('/pledge/'),
      self::UNSUBSCRIBE => array('/unsubscribe/'),
      self::EDIT => array('/widgetedit/')
  );

  public static function dataMarkupSet($links = array()) {
    $menu = array();
    foreach ($links as $link) {
      $menu[] = array(
          'name' => self::$NAME[$link],
          'openWith' => '[',
          'placeHolder' => self::$TEXT[$link],
          'closeWith' => '](' . self::$SHORTCUT[$link] . ')'
      );
    }

    $menuBlocks = array(
        array('name' => 'Footer', 'openWith' => "\n<div markdown=\"1\" class=\"footer\">\n", 'closeWith' => "\n</div>\n"),
        array('name' => 'Align right', 'openWith' => "\n<div markdown=\"1\" class=\"align-right\">\n", 'closeWith' => "\n</div>\n"),
        array('name' => 'Align justify', 'openWith' => "\n<div markdown=\"1\" class=\"align-justify\">\n", 'closeWith' => "\n</div>\n"),
        array('name' => 'Image left', 'openWith' => "\n<div markdown=\"1\" class=\"image-left\">\n", 'closeWith' => "\n</div>\n"),
        array('name' => 'Image right', 'openWith' => "\n<div markdown=\"1\" class=\"image-right\">\n", 'closeWith' => "\n</div>\n"),
        array('name' => 'Image center', 'openWith' => "\n<div markdown=\"1\" class=\"image-center\">\n", 'closeWith' => "\n</div>\n")
    );

    return json_encode(array(
        array('separator' => '---------------'),
        array('name' => 'Links', 'className' => 'policat-links', 'dropMenu' => $menu),
        array('name' => 'Blocks', 'className' => 'policat-blocks', 'dropMenu' => $menuBlocks)
    ));
  }

  public static function generateEmailCss($options) {
    $homeurl = sfContext::getInstance()->getRouting()->generate('homepage', array(), true);

    $subst = array('http://POLICAT-HOST/' => $homeurl);
    if (is_array($options)) {
      if (array_key_exists('petition', $options)) {
        $petition = $options['petition'];
        /* @var $petition Petition */
        $subst['#b7d9f9'] = $petition->getEmailButtonColor();
      }
    }

    $css = file_get_contents(sfConfig::get('sf_web_dir') . '/css/email.css');

    return strtr($css, $subst);
  }

}
