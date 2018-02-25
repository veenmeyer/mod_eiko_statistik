<?php
/**
 * @version     1.0.0
 * @package     mod_eiko_statistik
 * @copyright   Copyright (C) 2013 by Ralf Meyer. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ralf Meyer <webmaster@feuerwehr-veenhusen.de> - http://einsatzkomponente.de
 */


defined('_JEXEC') or die;


$moduleclass_sfx = $params->get('moduleclass_sfx', '');

$width            = intval( $params->get( 'width', 0 ) );
$height           = $params->get( 'min-height', 0 ) ;
$background       = $params->get( 'background', '#ffffff' );


$stapeln       = $params->get( 'stapeln', 'true' );
$transparent       = $params->get( 'transparent', 'true' );
$titel       =  $params->get( 'titel', 'Einsatzstatistik' );
$show_titel       =  $params->get( 'show_titel', '1' );
$legend       =  $params->get( 'legend', 'right' );
$legendsize       =  $params->get( 'legendsize', '10' );
$titelsize       =  $params->get( 'titelsize', '16' );
$titeltextcolor       =  $params->get( 'titeltextcolor', '#000000' );
$legendtextcolor       =  $params->get( 'legendtextcolor', '#000000' );
$zeige       =  $params->get( 'zeige', '2' );
$border       =  $params->get( 'border', '1' );
require( JModuleHelper::getLayoutPath('mod_eiko_statistik') );
?>