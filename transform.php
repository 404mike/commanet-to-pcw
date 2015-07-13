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

    // Create CSV
    $this->createCsv();
  }


  /**
   *
   */
  private function createPhotosArray()
  {
    $data = $this->csv_to_array($this->csv_path . '/photo.csv');

    foreach($data as $d) {
      $this->items[$d['recid']]['file'] = $d['photo_file'];
      $this->items[$d['recid']]['id'] = $d['recid'];
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
        // echo 'noooo';
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

    $geoLocation = $geoArr['results'][0]['geometry']['location'];
    $lat = $geoLocation['lat'];
    $lng = $geoLocation['lng'];

    return $lat.','.$lng;
  }

  /**
   *
   */
  public function createCsv()
  {
    $list = array(
      array(
        'UC1',
        'UC2',
        'UC3',
        'UC4',
        'UC5',
        'UC6',
        'UC7',
        'UC8',
        'UC9',
        'UC10',
        'UC11',
        'UC12',
        'UC13',
        'UC14',
        'UC15',
        'UC16',
        'UC17',
        'UC18',
        'UC19',
        'UC20',
        'UC21',
        'UC22',
        'UC23',
        'UC24',
        'UC25',
        'UC26',
        'UC27',
        'UC28',
        'UC29',
        'UC30',
        'UC31',
        'UC32',
        'UC33',
        'UC34',
        'all_images'
      ),
      
      array(
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        ''
      ),
      
      array(
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        ''
      ),
      
      
      array(
        'Image Identifier',
        'Parent ID*',
        'Page Order*',
        'Image/File Name',
        'Title EN',
        'Title CY',
        'Description EN',
        'Description CY',
        'Item type',
        'Tags EN',
        'Tags CY',
        'Date',
        'Owner',
        'Creator',
        'Website en',
        'Website cy',
        'What facet',
        'When facet',
        'Location (lat, lon)',
        'Location description en',
        'Location description cy',
        'Right Type 1',
        'Right Holder 1 EN',
        'Right Holder 1 CY',
        'Begin Date 1',
        'Right Type 2',
        'Right Holder 2 EN',
        'Right Holder 2 CY',
        'Begin Date 2',
        'Right Type 3',
        'Right Holder 3 EN',
        'Right Holder 3 CY',
        'Begin Date 3',
        'Addional rights'
      )
    );
    
    foreach ($this->items as $item => $value) {
      
      $date = $value['date'];
      
      $dateFacet = substr_replace($date , '0' , -1 , 4);  
      $dateFacetArr = [
        '17' => '1800',
        '18' => '1810',
        '19' => '1820',
        '20' => '1830',
        '21' => '1840',
        '22' => '1850',
        '23' => '1860',
        '24' => '1870',
        '25' => '1880',
        '26' => '1890',
        '28' => '1900',
        '29' => '1910',
        '30' => '1920',
        '31' => '1930',
        '32' => '1940',
        '33' => '1950',
        '34' => '1960',
        '35' => '1970',
        '36' => '1980',
        '37' => '1990',
        '39' => '2000',
        '40' => '2010'
      ];
      $dateFacetFinal = array_search($dateFacet , $dateFacetArr);

      if(isset($value['description'])) {
        $description = $value['description'];
      }else{
        $description = $value['title'];
      }


      if(isset($value['author'])) {
        $author = $value['author'];
      }else{
        $author = 'unknown';
      }
      
      array_push($list, array(
        $value['id'], // Image Identifier
        '', // Parent ID*
        '', // Page Order*
        $value['file'], // Image/File Name
        $value['title'], // Title EN
        $value['title'], // Title CY
        $description, // Description EN
        $description, // Description CY
        '', // Item type
        '', // Tags EN
        '', // Tags CY
        $value['date'].'-01-01', // Date
        $author, // Owner
        $author, // Creator
        '', // Website en
        '', // Website cy
        '', // What facet
        $dateFacetFinal, // When facet
        '', // Location (lat, lon)
        '', // Location description en
        '', // Location description cy
        '', // Right Type 1
        '', // Right Holder 1 EN
        '', // Right Holder 1 CY
        '', // Begin Date 1
        '', // Right Type 2
        '', // Right Holder 2 EN
        '', // Right Holder 2 CY
        '', // Begin Date 2
        '', // Right Type 3
        '', // Right Holder 3 EN
        '', // Right Holder 3 CY
        '', // Begin Date 3
        ''  // Addional rights
      ));
    }
    
    $title = (string) $value['title'];
    $title = strtolower($title);
    $title = str_replace(array(
      '/',
      ',',
      '-',
      '.'
    ), '', $title);
    $title = str_replace(' ', '_', $title);
    
    $fp = fopen($this->csv_path . '/' . $title . '.csv', 'w');
    
    foreach ($list as $fields) {
      fputcsv($fp, $fields , ',' , '"');
    }
    
    fclose($fp);
    
  }


}

new CommanetTransform();