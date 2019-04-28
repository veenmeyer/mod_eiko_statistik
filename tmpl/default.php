<?php
/**
 * @version     1.0.0
 * @package     mod_eiko_statistik
 * @copyright   Copyright (C) 2013 by Ralf Meyer. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ralf Meyer <webmaster@feuerwehr-veenhusen.de> - http://einsatzkomponente.de
 */


defined('_JEXEC') or die;


		$database			= JFactory::getDBO();
		$query = 'SELECT COUNT(r.data1) as total,r.data1,rd.marker,rd.title as einsatzart FROM #__eiko_einsatzberichte r ';
		$query.='JOIN #__eiko_einsatzarten rd ON r.data1 = rd.id WHERE r.date1 LIKE "2%" AND (r.state = "1" OR r.state ="2") AND rd.state = "1" and r.data1 !="'.$ex_einsatzart.'"';
	          $query.=' GROUP BY r.data1 ' ;
	          $query.=' ORDER BY rd.ordering DESC ' ;
		$database->setQuery( $query );
		$total = $database->loadObjectList();
	
	
		$database			= JFactory::getDBO();
		$query = 'SELECT Year(date1) as id, Year(date1) as title FROM `#__eiko_einsatzberichte` GROUP BY title';
		$database->setQuery( $query );
		$totalyears = $database->loadObjectList();
		
$zufall = rand(1,100000);
   
	   
$Column = '';
$Colors = '';
for($i=0; $i < count($total); $i++)
   {
   $Column.='data.addColumn("number", "'.$total[$i]->einsatzart.'");';
   $Colors.='"'.$total[$i]->marker.'",';
   }
   $Colors=substr($Colors,0,strlen($Colors)-1);
   
  
  
$Rows = '';
$Rows ='[["'.$totalyears[count($totalyears)-$zeige]->title.'",';
for($n = count($totalyears)-$zeige; $n < count($totalyears); $n++)
   {
   
   
   
$rows = array();
for($i=0; $i < count($total); $i++)
   {
		$database			= JFactory::getDBO();
		$query = 'SELECT COUNT(*) AS total FROM #__eiko_einsatzberichte r ';
		$query.=' WHERE r.date1 LIKE "'.$totalyears[$n]->title.'%" AND r.data1 = "'.$total[$i]->data1.'" AND (r.state = "1" OR r.state="2")  and r.data1 !="'.$ex_einsatzart.'"';
	          $query.='' ;
		$database->setQuery( $query );
		$rows = $database->loadObjectList();	
		//print_r ($rows2);
        $Rows .=$rows['0']->total;
	    $Rows .=',';
        //echo '<br/>'.$total[$i]->data1.' '.$rows[0]->total;
   }
$Rows=substr($Rows,0,strlen($Rows)-1);
@$Rows.='],["'.$totalyears[$n+1]->title.'",';
  
   }
$Rows=substr($Rows,0,strlen($Rows)-5);
$Rows.=']';

echo '<br/>';

// Load the AJAX API
echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
echo '<script type="text/javascript">';
// Load the Visualization API and the piechart package.
echo 'google.load("visualization", "1", {packages:["corechart"]});';    
// Set a callback to run when the Google Visualization API is loaded.
echo 'google.setOnLoadCallback(drawChart);';
// Callback that creates and populates a data table, 
// instantiates the pie chart, passes in the data and
// draws it.
echo 'function drawChart() {';   
// Create the data table.
echo 'var data = new google.visualization.DataTable();';       
echo 'data.addColumn("string", "Jahr");';    
echo $Column;    
echo 'data.addRows('.$Rows.');'; 
// Set chart options

if ($transparent == 'true') :
$background = 'transparent';
endif;

if (!$show_titel) :$titel = '';endif;

echo "var options = {  
                     isStacked: ".$stapeln.",
                     backgroundColor: '".$background."',
                     width: '100%', 
					 height: ".$height.",  
					 colors:[".$Colors."], 
					 legend: {position: '".$legend."', textStyle: {color: '".$legendtextcolor."', fontSize: '".$legendsize."'}},
					 title: '".$titel."', 
					 titlePosition: 'out',
					 titleTextStyle: {color: '".$titeltextcolor."', fontSize: '".$titelsize."'}, 
					 hAxis: {title: 'Einsätze pro Jahr ( unterteilt nach Einsatzarten )', titleTextStyle: {color: '".$titeltextcolor."', fontSize: 12}}					 
					     };"; 
// Instantiate and draw our chart, passing in some options.
echo 'var chart = new google.visualization.ColumnChart(document.getElementById("chart_div_'.$zufall.'")); ';       
echo 'chart.draw(data, options);      } ';  
echo '$(window).resize(function(){drawChart();});'; 
echo '</script>';   

//<!--Div that will hold the pie chart-->
echo '<div class="'.$moduleclass_sfx.'" style=" border:'.$border.'px solid #000;width:100%; min-height:'.$height.';" align="center" id="chart_div_'.$zufall.'"></div> '; 




?>

