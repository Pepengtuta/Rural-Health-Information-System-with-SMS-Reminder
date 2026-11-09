<?php
// Example of processing the AJAX request in report.php

include('includes/connection.php');

// Initialize immunization data...
// Your code for fetching and calculating immunization data goes here...

// Prepare the output HTML for both tables
$output = '';

// Child Care and Services Table
$output .= '<div id="child-table" class="service-table">';
$output .= '<label style="font-size: 16px;">Child Care and Services</label>';
$output .= '<label style="font-size: 14px;">(Immunization Services)</label>';
$output .= '<div class="row"><div class="col-12"><div class="table-responsive">';
$output .= '<table class="table table-sm table-bordered table-striped"><thead class="thead-light"><tr>';
$output .= '<th class="text-center">Indicators</th>';
$output .= '<th class="text-center">Eligible<br> Population</th>';
$output .= '<th class="text-center">Male</th>';
$output .= '<th class="text-center">Female</th>';
$output .= '<th class="text-center">Total</th>';
$output .= '<th class="text-center">%</th>';
$output .= '<th class="text-center">Remarks</th>';
$output .= '</tr></thead><tbody>';

foreach ($immunization_data as $vaccine => $data) {
    $output .= '<tr>';
    $output .= '<td>' . $vaccine . '</td>';
    $output .= '<td></td>'; // Eligible Population placeholder
    $output .= '<td>' . $data['male'] . '</td>';
    $output .= '<td>' . $data['female'] . '</td>';
    $output .= '<td>' . $data['total'] . '</td>';
    $output .= '<td></td>'; // Percentage placeholder
    $output .= '<td></td>'; // Remarks placeholder
    $output .= '</tr>';
}

$output .= '</tbody></table></div></div></div></div>';

// Similarly, generate the HTML for the maternal table...

// Return the output
echo $output;
?>
