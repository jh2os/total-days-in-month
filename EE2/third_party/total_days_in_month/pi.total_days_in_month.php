<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Return The total days in a given month and takes into account the year for leap year
 * 
 * @package 	Total Days in Month
 * @category	Plugin
 * @author		Johnathan Waters
 * @copyright	2013-2014, Johnathan Waters
 * @link 		http://johnathan-waters.com/
 */

$plugin_info = array (
	'pi_name'		=> 'Total Days in Month',
	'pi_version'	=> '1.1.2',
	'pi_author'		=> 'Johnathan Waters',
	'pi_author_url'	=> 'http://www.papercutinteractive.com',
	'pi_usage'		=> Total_days_in_month::usage()
);

class Total_days_in_month
{  			
	/**
	  *  Returns the total number of days in a month
	  *  
	  */
	function Total_days_in_month()
	{
		// make a local reference to the ExpressionEngine super object
		$this->EE =& get_instance();
		$month = strtolower($this->EE->TMPL->fetch_param('month'));
		
		$year = ($this->EE->TMPL->fetch_param('year') ? $this->EE->TMPL->fetch_param('year') : date("Y"));
		
		switch($month) {
			case '01':
			case 'jan':
			case 'january':
			case '03':
			case 'mar':
			case 'march':
			case '05':
			case 'may':
			case '07':
			case 'jul':
			case 'july':
			case '08':
			case 'aug':
			case 'august':
			case '10':
			case 'oct':
			case 'october':
			case '12':
			case 'dec':
			case 'december':
				$this->return_data = 31;
				break;
				
			case '04':
			case 'Apr':
			case 'April':
			case '06':
			case 'Jun':
			case 'June':
			case '09':
			case 'Sep':
			case 'Sept':
			case 'September':
			case '11':
			case 'Nov':
			case 'November':
				$this->return_data = 30;
				break;
				
			case '02':
			case 'Feb':
			case 'February':				
				if ( ((int)$year % 4)  == 0) {
					$this->return_data=29;
				} else {
						$this->return_data="28";
					}

			default:
				return 0;
				break;
		}
	}
	
	// --------------------------------------------------------------------	
		
// ----------------------------------------
//  Plugin Usage
// ----------------------------------------

// This function describes how the plugin is used.
//  Make sure and use output buffering
	public static function usage()
	{
		ob_start(); ?>
This plugin returns the total number of days in a given month.
It takes in month and year, if no year is specified, it will
assume it is the current year

Month can take in any of the EE month date formats.
	
	{exp:total_days_in_month month="Feb" year="2016"}
	
	Will output: 29
	
	
This plugin is especially useful when dealing with the solspace plugin calendar:

	{exp:total_days_in_month month='{date format="%m"}' year='{date format="%Y"}'}
	

Or you can also use the current date:

	{exp:total_days_in_month month='{current_time format="%m"}' year='{current_time format="%Y"}'}

	
	<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		
		return $buffer;
	}
	
}
// END CLASS

/* End of file pi.total_days_in_month.php */
/* Location: ./system/expressionengine/third_party/total_days_in_month/pi.total_days_in_month.php */
