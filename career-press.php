<?php
/**
 * Created by PhpStorm.
 * User: azeem
 * Date: 1/20/2018
 * Time: 6:28 PM
 */
/*
Plugin Name:  CareerPress
Plugin URI:   https://developer.wordpress.org/plugins/the-basics/
Description:  Add Jobs to your website
Version:      1.0.0
Author:       Azeem Mirza
Author URI:   https://azeemirza.com/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  career-press
Domain Path:  /languages
*/
require_once 'CareerPress.php';

if(is_admin()){

}else{
	require_once 'CareerPressView.php';
}
