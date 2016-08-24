<?php

class Data {

  static function prepare($sql) {
    $mysql  = Connections::Instance()->getMySqlConnection();

    $stm = $mysql->prepare($sql);
    if ($stm)
      return $stm;
    else {
      Log::error("PDO::errorInfo():");
      return false;
    }
  }

  static function insert($table, $data) {
    try {
      $stm = Data::prepare('INSERT INTO '.$table.' (`'.implode('`,`', array_keys($data)).'`) VALUES (:'.implode(',:', array_keys($data)).')');
      if (!$stm) { return false; }

      $stm->execute($data);
    } catch (Exception $e) {
      Log::error($e->getMessage());
      return false;
    }

    return true;
  }

}

?>
