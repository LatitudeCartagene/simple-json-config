<?php

namespace Simple\Config\Parser;

use Simple\Config\Exception\ParseException;

class JSONParser
{
  /**
   * [parse description]
   * @param  [type] $path [description]
   * @return [type]       [description]
   */
  public function parse($path)
  {
    $data = json_decode(file_get_contents($path), true);

    if (function_exists('json_last_error_msg')) {
      $error_message = json_last_error_msg();
    } else {
      $error_message  = 'Syntax error';
    }

    if (json_last_error() !== JSON_ERROR_NONE) {
      $error = array(
        'message' => $error_message,
        'type'    => json_last_error(),
        'file'    => $path,
      );

      throw new ParseException($error);
    }

    return $data;
  }

  /**
   * [extenstion description]
   * @return [type] [description]
   */
  public function extension()
  {
    return array('json');
  }
}
