<?php

namespace Simple\Config;

use Simple\Config\Parser\JSONParser;
use Simple\Config\Exception\FileNotFoundException;

class Config
{
  /**
   * [$data description]
   * @var [type]
   */
  private $data = null;

  /**
   * [__construct description]
   * @param Array $data [description]
   */
  public function __construct($path)
  {
    $path = $this->validPath($path);

    $info      = pathinfo($path);
    $extension = isset($info['extension']) ? $info['extension'] : '';
    $parser    = new JSONParser();

    if (!in_array($extension, $parser->extension())) {
      throw new UnsupportedFormatException('Unsupported configuration format. At this moment, only JSON file is supported');
    }

    $this->data = $parser->parse($path);
  }

  /**
   * [get description]
   * @param  [type] $key [description]
   * @return [type]      [description]
   */
  public function get($key)
  {
    $nested = explode('.', $key);
    $base = $this->data;

    foreach ($nested as $part) {
      if (isset($base[$part])) {
        $base = $base[$part];
        continue;
      }
    }

    return $base;
  }

  /**
   * [validPath description]
   * @param  [type] $path [description]
   * @return [type]       [description]
   */
  private function validPath($path)
  {
    if (!file_exists($path)) {
      throw new FileNotFoundException("Configuration file: [$path] cannot be found");
    }

    return $path;
  }
}
