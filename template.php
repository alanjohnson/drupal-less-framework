<?php

function less_table($header, $rows, $attributes = array(), $caption = NULL) {
  // Add sticky headers, if applicable.
  if (count($header)) {
    drupal_add_js('misc/tableheader.js');
    // Add 'sticky-enabled' class to the table to identify it for JS.
    // This is needed to target tables constructed by this function.
    $attributes['class'] = empty($attributes['class']) ? 'sticky-enabled' : ($attributes['class'] .' sticky-enabled');
  }

  $output = '<table'. drupal_attributes($attributes) .">\n";
  
  if (isset($caption)) {
    $output .= '<caption>'. $caption ."</caption>\n";
  }

  // Format the table header:
  if (count($header)) {
    $ts = tablesort_init($header);
    // HTML requires that the thead tag has tr tags in it followed by tbody
    // tags. Using ternary operator to check and see if we have any rows.
    $output .= (count($rows) ? ' <thead><tr>' : ' <tr>');
    foreach ($header as $cell) {
      $cell = tablesort_header($cell, $header, $ts);
      //  Adjusting heading text output to minimize td width for checkboxes and radio buttons
      //  Turning them into titled links instead so they stand out and have mouseover titles.
        // array of heading titles you want affected
        $truncatArray = array('Version', 'Enabled', 'Default', 'Operations');
        $newCell = $tmpCell = is_array($cell) ? $cell[data] : $cell;
        
        // apply change to all titles in $truncated array, as well as all titles in the permissions table (except the permission title)
        if (strpos(drupal_attributes($attributes), 'permissions') && ($tmpCell != 'Permission') || in_array($tmpCell,$truncatArray)){
          $newCell = '<div class="verticaltext"><a title="'.$tmpCell.'">'.substr($tmpCell, 0, 4).'</a></div>';
        }
      // END Adjusting headign text output
      
      $output .= _theme_table_cell($newCell, TRUE);
    }
    // Using ternary operator to close the tags based on whether or not there are rows
    $output .= (count($rows) ? " </tr></thead>\n" : "</tr>\n");
  }
  else {
    $ts = array();
  }

  // Format the table rows:
  if (count($rows)) {
    $output .= "<tbody>\n";
    $flip = array('even' => 'odd', 'odd' => 'even');
    $class = 'even';
    foreach ($rows as $number => $row) {
      $attributes = array();

      // Check if we're dealing with a simple or complex row
      if (isset($row['data'])) {
        foreach ($row as $key => $value) {
          if ($key == 'data') {
            $cells = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $cells = $row;
      }
      if (count($cells)) {
        // Add odd/even class
        $class = $flip[$class];
        if (isset($attributes['class'])) {
          $attributes['class'] .= ' '. $class;
        }
        else {
          $attributes['class'] = $class;
        }

        // Build row
        $output .= ' <tr'. drupal_attributes($attributes) .'>';
        $i = 0;
        foreach ($cells as $cell) {
          $cell = tablesort_cell($cell, $header, $ts, $i++);
          $output .= _theme_table_cell($cell);
        }
        $output .= " </tr>\n";
      }
    }
    $output .= "</tbody>\n";
  }

  $output .= "</table>\n";
  return $output;
}
?>
