<?php

class CommanetTransform {

  private $csv_path;
  private $commaet_tables = ['photo','13','15','17','rem'];

  private $items = [];

  private $locations = [];

  public function __construct()
  {
    global $argv;
    
    $this->csv_path = $argv[1];

    // Create an array from all the photos
    $this->createPhotosArray();

    // Add dates to the photos
    $this->addDates();

    // Add a title to the photos
    $this->addTitle();

    // Add author and description to the photos
    $this->addAuthorDescription();
 
    // Add a location to the photos
    $this->addLocation();
  }


  /**
   *
   */
  private function createPhotosArray()
  {
    $data = $this->csv_to_array($this->csv_path . '/photo.csv');

    foreach($data as $d) {
      $this->items[$d['recid']]['file'] = $d['photo_file'];
    }
  }


  /**
   *
   */
  private function addDates()
  {
    $data = $this->csv_to_array($this->csv_path . '/13.csv');
    foreach($data as $d) {
      $this->items[$d['recid']]['date'] = $d['item'];
    }
  }


  /**
   *
   */
  private function addLocation()
  {
    $data = $this->csv_to_array($this->csv_path . '/15.csv');

    foreach($data as $d) {
      $location = $d['item'];
      if(in_array($location, $this->locations)) {
        echo 'noooo';
        $this->items[$d['recid']]['location'] = ['location' => $location , 'lat_lng' => $this->locations[$location]];
      }else{
        $geo_data = $this->getLatLng($location);
        $this->locations[$location] = $geo_data;
        $this->items[$d['recid']]['location'] = ['location' => $location , 'lat_lng' => $geo_data];
      }
    }
  }

  /**
   *
   */
  private function addTitle()
  {
    $data = $this->csv_to_array($this->csv_path . '/17.csv');
    foreach($data as $d) {
      $this->items[$d['recid']]['title'] = $d['item'];
    }
  }


  /**
   *
   */
  private function addAuthorDescription()
  {
    $data = $this->csv_to_array($this->csv_path . '/rem.csv');
    foreach($data as $d) {
      $this->items[$d['recid']]['author'] = $d['author'];
      $this->items[$d['recid']]['description'] = $d['RemText'];
    }
  }


  /**
   * Convert a comma separated file into an associated array.
   * The first row should contain the array keys.
   * 
   * Example:
   * 
   * @param string $filename Path to the CSV file
   * @param string $delimiter The separator used in the file
   * @return array
   * @link http://gist.github.com/385876
   * @author Jay Williams <http://myd3.com/>
   * @copyright Copyright (c) 2010, Jay Williams
   * @license http://www.opensource.org/licenses/mit-license.php MIT License
   */
  private function csv_to_array($filename='', $delimiter=',')
  {
    if(!file_exists($filename) || !is_readable($filename))
      return FALSE;
    
    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
      while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
      {
        if(!$header)
          $header = $row;
        else
          $data[] = array_combine($header, $row);
      }
      fclose($handle);
    }
    return $data;
  }



  /**
   *
   * @param $place string - place name
   * @param return string - lat lng of the placename
   */
  private function getLatLng($place)
  {
    sleep(2);

    $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$place.'%20wales&sensor=false';

    $ch = curl_init();
    $timeout = 0;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $file_contents = curl_exec($ch);
    curl_close($ch);

    $geoArr = json_decode($file_contents,true);
    // echo '<pre>' , print_r($geoArr) , '</pre>';
    $geoLocation = $geoArr['results'][0]['geometry']['location'];
    $lat = $geoLocation['lat'];
    $lng = $geoLocation['lng'];

    return $lat.','.$lng;
  }

}

new CommanetTransform();