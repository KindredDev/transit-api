<?php

final class Connections {

  public static function Instance() {
      static $instance = null;
      if ($instance === null) {
          $instance = new Connections();
      }
      return $instance;
  }

  private function __construct() {

  }

  private $mysql = null;
  public function getMySqlConnection() {
    if (!$this->mysql){
        $config = Config::Instance();
        $this->mysql = new PDO( implode('', array(
          'mysql:dbname=',
          $config->settings['database']['mysql']['name'],
          ';host=',
          $config->settings['database']['mysql']['server'],
          ';port=',
          $config->settings['database']['mysql']['port']
        )),
        $config->settings['database']['mysql']['username'],
        $config->settings['database']['mysql']['password']
      );
    }

    return $this->mysql;
  }

}

?>
