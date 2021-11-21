<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    public function getStationByPrefectureKey($key)
    {
        $columnList = [
            "stations.id",
            "stations.station_cd",
            "stations.station_name",
            "stations.line_cd",
            "lines.line_name",
            "stations.pref_cd",
            "stations.lon",
            "stations.lat",
            "stations.status",
        ];

        $whereList = [
            ["stations.pref_cd","=",$key],
            ["stations.status","=", 0],
        ];

        $dispData =$this::from("stations")
                    -> join('lines', 'stations.line_cd', '=', 'lines.line_cd')
                    ->where($whereList)
                    ->get($columnList);

        $aList = $dispData;

        return $aList;
    }

}
