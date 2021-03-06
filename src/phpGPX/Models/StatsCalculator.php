<?php
/**
 * Created            17/02/2017 18:36
 * @author            Jakub Dubec <jakub.dubec@gmail.com>
 */

namespace phpGPX\Models;


interface StatsCalculator
{

	/**
	 * Recalculate stats objects.
	 * @return void
	 */
	function recalculateStats();

}