<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Models\Station;

class JsonController extends Controller
{
    //
    public function test () 
    {
        $array = Array (
            "0" => Array (
                "id" => "01",
                "name" => "Olivia Mason",
                "designation" => "System Architect"
            ),
            "1" => Array (
                "id" => "02",
                "name" => "Jennifer Laurence",
                "designation" => "Senior Programmer"
            ),
            "2" => Array (
                "id" => "03",
                "name" => "Medona Oliver",
                "designation" => "Office Manager"
            )
        );
        
        // encode array to json
        $json = json_encode($array);
        $bytes = file_put_contents("json/myfile.json", $json); 
        echo "The number of bytes written are $bytes.";
    }

    public function station () 
    {
        $array = Array();

        $prefectures = config('prefectures');
        $mdStation= new Station();
        foreach($prefectures as $key => $prefecture){
            $StationData[$key] = $mdStation->getStationByPrefectureKey($key);
            foreach($StationData[$key] as $station){
                //路線の都道府県でのグループ化
                if(!isset($linesData[$key][$station["line_cd"]])){
                    $linesData[$key][$station["line_cd"]] = $station["line_name"];
                }
                //駅の都道府県別の路線でのグループ化
                $stationDataGroupByLines[$station["line_cd"]][$station["station_cd"]] = $station; 
            }

        }
        // encode array to json
        $jsonLines = json_encode($linesData);
        $bytesLines = file_put_contents("json/lines.json", $jsonLines); 
        $jsonStations = json_encode($stationDataGroupByLines);
        $bytesStations = file_put_contents("json/stations.json", $jsonStations); 
        echo "The number of bytes written are $bytesLines.and.$bytesStations";
    }
}
