<?php

class CommanetTransform {

  private $csv_path;
  private $commaet_tables = [
    'score','rem','LPlan','comms','album','albums','audio','passwords',
    'harbour','photo','donor','1','2','3','4', '5', '6', '7', '8', '9', 
    '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', 
    '21', '22', '23'
  ];

  public function __construct()
  {
    global $argv;
    
    $this->csv_path = $argv[1];

    $this->getCsvFiles();
  }

  /**
   * Loop through all the csv files
   */
  public function getCsvFiles()
  {
    foreach($this->commaet_tables as $tables) {
      echo file_get_contents($this->csv_path . '/' . $tables . '.csv');
    }
  }

}

new CommanetTransform();