<?php
class Crawler {
  /**
   * -- Stub fnctions for simple_html_dom
   */
  public function __construct() {
    require_once LIB_DIR . DS . 'simple_html_dom.php';
  }
  
  function file_get_html($url, $use_include_path = false, $context=null, $offset = -1, $maxLen=-1, $lowercase = true, $forceTagsClosed=true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN=true, $defaultBRText=DEFAULT_BR_TEXT, $defaultSpanText=DEFAULT_SPAN_TEXT) {
    return file_get_html($url, $use_include_path        , $context     , $offset     , $maxLen   , $lowercase       , $forceTagsClosed     , $target_charset                         , $stripRN     , $defaultBRText                , $defaultSpanText);
  }
  
  function str_get_html($str, $lowercase=true, $forceTagsClosed=true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN=true, $defaultBRText=DEFAULT_BR_TEXT, $defaultSpanText=DEFAULT_SPAN_TEXT) {
    return str_get_html($str, $lowercase     , $forceTagsClosed     , $target_charset                         , $stripRN     , $defaultBRText                , $defaultSpanText);
  }
  
  function dump_html_tree($node, $show_attr=true, $deep=0) {
           dump_html_tree($node, $show_attr     , $deep);
  }
  
  function clear() {
    $this->dom->clear();
  }

  /**
   * -- Class Specific functions
   */
  
  
}

?>
