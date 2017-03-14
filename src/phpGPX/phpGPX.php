<?php
/**
 * Created            26/08/16 13:45
 * @author            Jakub Dubec <jakub.dubec@gmail.com>
 */

namespace phpGPX;


use phpGPX\Models\GpxFile;
use phpGPX\Parsers\MetadataParser;
use phpGPX\Parsers\RouteParser;
use phpGPX\Parsers\TrackParser;
use phpGPX\Parsers\WaypointParser;

class phpGPX
{
	const JSON_FORMAT = 'json';
	const XML_FORMAT = 'xml';

	const PACKAGE_NAME = 'phpGPX';
	const VERSION = '1.0-RC1';

	/**
	 * Create Stats object for each track, segment and route
	 * @var bool
	 */
	public static $CALCULATE_STATS = true;

	/**
	 * Additional sort based on timestamp in Routes & Tracks on XML read.
	 * Disabled by default, data should be already sorted.
	 * @var bool
	 */
	public static $SORT_BY_TIMESTAMP = false;

	/**
	 * Default DateTime output format in JSON serialization.
	 * @var string
	 */
	public static $DATETIME_FORMAT = 'c';

	/**
	 * Default timezone for display.
	 * Data are always stored in UTC timezone.
	 * @var string
	 */
	public static $DATETIME_TIMEZONE_OUTPUT = 'UTC';

	/**
	 * Pretty print.
	 * @var bool
	 */
	public static $PRETTY_PRINT = true;

	/**
	 * @param $path
	 * @return GpxFile
	 */
	public static function load($path)
	{
		$xml = simplexml_load_file($path);
		$gpx = new GpxFile();

		// Parse creator
		$gpx->creator = isset($xml['creator']) ? (string) $xml['creator'] : null;

		// Parse metadata
		$gpx->metadata = isset($xml->metadata) ? MetadataParser::parse($xml->metadata) : null;

		// Parse waypoints
		$gpx->waypoints = isset($xml->wpt) ? WaypointParser::parse($xml->wpt) : [];

		// Parse tracks
		$gpx->tracks = isset($xml->trk) ? TrackParser::parse($xml->trk) : [];

		// Parse routes
		$gpx->routes = isset($xml->rte) ? RouteParser::parse($xml->rte) : [];

		return $gpx;
	}
	
	public static function loadString($string)
	{
		$xml = simplexml_load_string($string);
		$gpx = new GpxFile();

		// Parse creator
		$gpx->creator = isset($xml['creator']) ? (string) $xml['creator'] : null;

		// Parse metadata
		$gpx->metadata = isset($xml->metadata) ? MetadataParser::parse($xml->metadata) : null;

		// Parse waypoints
		$gpx->waypoints = isset($xml->wpt) ? WaypointParser::parse($xml->wpt) : [];

		// Parse tracks
		$gpx->tracks = isset($xml->trk) ? TrackParser::parse($xml->trk) : [];

		// Parse routes
		$gpx->routes = isset($xml->rte) ? RouteParser::parse($xml->rte) : [];

		return $gpx;
	}

	/**
	 * Create library signature from name and version.
	 * @return string
	 */
	public static function getSignature()
	{
		return sprintf("%s/%s", self::PACKAGE_NAME, self::VERSION);
	}


}
