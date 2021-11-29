<?php
require_once("kml.php");

$data = [
	'boat' => [
		'type' => 'point',
		'height' => 3.0,
		'lat' =>  33.094125,
		'lon' => -43.05944167,
	],
	'markab' => [
		'type' => 'star',
		'Ho' => 69.85209,
		'lat' => 15.32398,
		'lon' => -32.56784,
		'utc' => '2021-11-29T20:40:17',
		'radius' => 2241,
		'color' => '00ffff', //'ffff00',
	],
	'deneb' => [
		'type' => 'star',
		'Ho' => 66.78473,
		'lat' => 45.36159,
		'lon' => -68.75340,
		'utc' => '2021-11-29T20:41:20',
		'radius' => 2583,
		'color' => '00aa00', //'00aa00',
	],
	'alpheratz' => [
		'type' => 'star',
		'Ho' => 67.60867,
		'lat' => 29.21289,
		'lon' => -17.21684,
		'utc' => '2021-11-29T20:42:33',
		'radius' => 2490,
		'color' => '0000ff', //'ff0000',
	],
];

foreach($data as $name => $element) {
	if($element['type'] == "boat") continue;
	$coordinatesList = getCirclecoordinates($element['lat'], $element['lon'], $element['radius']*1000);
	$kml = "";
	$kml = '<' . '?'. 'xml ' . 'version="1.0" encoding="UTF-8"' . '?' . '>' . "\n";
	$kml .= '<kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2" xmlns:kml="http://www.opengis.net/kml/2.2" xmlns:atom="http://www.w3.org/2005/Atom">'."\r\n";
	$kml .= "<Document>\r\n";
	$kml .= stdHeader($element['color']);
	$kml .= "    <Placemark>\r\n";
	$kml .= "    <styleUrl>#id-style</styleUrl>\r\n";
	$kml .= "    <Polygon>\r\n";
	$kml .= "     <tessellate>1</tessellate>\r\n";
	$kml .= "     <outerBoundaryIs>\r\n";
	$kml .= "      <LinearRing>\r\n";
	$kml .= "       <coordinates>".$coordinatesList."</coordinates>\r\n";
	$kml .= "      </LinearRing>\r\n";
	$kml .= "     </outerBoundaryIs>\n";
	$kml .= "    </Polygon>\n";
	$kml .= "    </Placemark>\r\n";
	$kml .= "</Document>\r\n";
	$kml .= "</kml>\r\n";
	$fname = "artifacts/" .$name . "-" . $element['type'] . ".kml";
	file_put_contents($fname, $kml);
	$coordinatesList = lineAt($element['lat'], $element['lon']);
	$kml = '<' . '?'. 'xml ' . 'version="1.0" encoding="UTF-8"' . '?' . '>' . "\n";
	$kml .= '<kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2" xmlns:kml="http://www.opengis.net/kml/2.2" xmlns:atom="http://www.w3.org/2005/Atom">'."\r\n";
	$kml .= "<Document>\r\n";
	$kml .= stdHeader($element['color'], 10);
	$kml .= "    <Placemark>\r\n";
	$kml .= "    <styleUrl>#id-style</styleUrl>\r\n";
	$kml .= "    <LineString>\r\n";
	$kml .= "     <extrude>1</extrude>\r\n";
	$kml .= "     <tessellate>1</tessellate>\r\n";
	$kml .= "     <altitudeMode>absolute</altitudeMode>\r\n";
	$kml .= "       <coordinates>".$coordinatesList."</coordinates>\r\n";
	$kml .= "    </LineString>\n";
	$kml .= "    </Placemark>\r\n";
	$kml .= "</Document>\r\n";
	$kml .= "</kml>\r\n";
	$fname = "artifacts/" . $name . "-point.kml";
	file_put_contents($fname, $kml);	
	//echo $kml . "\r\n";
}



