<?php

function getCirclecoordinates($lat, $long, $meter, $inc = 3) {
        // convert coordinates to radians
        $lat1 = deg2rad($lat);
        $long1 = deg2rad($long);
        $d_rad = $meter/6378137;

        $coordinatesList = "";
        // loop through the array and write path linestrings
        for($i = 0; $i <= 360; $i += $inc) {
                $radial = deg2rad($i);
                $lat_rad = asin(sin($lat1)*cos($d_rad) + cos($lat1)*sin($d_rad)*cos($radial));
                $dlon_rad = atan2(sin($radial)*sin($d_rad)*cos($lat1), cos($d_rad)-sin($lat1)*sin($lat_rad));
                $lon_rad = fmod(($long1+$dlon_rad + M_PI), 2*M_PI) - M_PI;
                $coordinatesList .= rad2deg($lon_rad).",".rad2deg($lat_rad).",0 ";
        }
        return $coordinatesList;
}

function lineAt($lat, $lon)
{
	$kml = "${lon},${lat},0 ${lon},${lat},100000";
	return $kml;
}

function stdHeader($color = "ff0000ff", $width = "3") {
        return '
        <Style id="id-A">
                <LineStyle>
                        <color>ff' . $color . '</color>
                        <width>'.$width.'</width>
                </LineStyle>
                <PolyStyle>
                        <fill>0</fill>
                </PolyStyle>
        </Style>
        <Style id="id-B">
                <LineStyle>
                        <color>ff' . $color . '</color>
                        <width>'.$width.'</width>
                </LineStyle>
                <PolyStyle>
                        <fill>0</fill>
                </PolyStyle>
        </Style>
        <StyleMap id="id-style">
                <Pair>
                        <key>normal</key>
                        <styleUrl>#id-A</styleUrl>
                </Pair>
                <Pair>
                        <key>highlight</key>
                        <styleUrl>#id-B</styleUrl>
                </Pair>
        </StyleMap>
        ';
}
