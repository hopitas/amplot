<?php

include('readdir.php');

$fieldseparator = ",";
$lineseparator = "\n";
$dirs = array();
$dirs = dir_list('data'); // reads files in a directory to array
$linearray = array();
$csvcontent = array();
$i=0;

// ks vielä läpi miten importtaa datan. lähtien readdirista. ks myös miten data menee csvcontenttiin, ks foreach miten toimii jne
//chmod("$csvfile",0644);
//ini_set("memory_limit","2G");
//miten saadaan oikeudet lukea webbisoftan kautta? Ei mitenkään?
/*
 * 
PHP resource limits!
;;;;;;;;;;;;;;;;;;;
; Resource Limits ;
;;;;;;;;;;;;;;;;;;;

max_execution_time = 60     ; Maximum execution time of each script, in seconds
max_input_time = 120    ; Maximum amount of time each script may spend parsing request data
memory_limit =    2G ; 128M      ; Maximum amount of memory a script may consume (8MB)

 * 
 */

// create class to store the data later

class Data {

    public $name = "";
    public $tooltip = "";
    public $type = "";
    public $yaxis = "";
    public $data = "";

}


/*
 *  Goes through files in directory array. First loop saves file content to an array, second loop parses the array and saves array
 * with separate time stamp and concentration value
 */

foreach ($dirs as $key => $value) {
    $csvfile = "data/" . $dirs[$key][name];
    $csvcontent = file($csvfile);
    foreach ($csvcontent as $key => $value) {
        $line = $csvcontent[$key];
        $linearray = explode($fieldseparator, $line);
        if ($linearray[0] != 0) { // strip zero time stamps
            $rowsdata[$i] = array(strtotime($linearray[0]) * 1000, intval($linearray[1]));
$i++;
            }
        }
}

//json encoding the data

$data = new Data();
$data->name = "data";
$data->tooltip = "valueDecimals: 2";
$data->type = "";
$data->yaxis = 0;
$data->data = $rowsdata;


$datas = array();

array_push($datas, $data);

echo json_encode($datas);
?>
