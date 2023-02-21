<?php 
//checkboxes
/**
* Replace FacetWP default HTML output for "Checkboxes" with Bootstrap custom checkbox markup
*/
add_filter('facetwp_facet_html', function ($output, $params) {
    // Check that this facet is a "checkboxes" type facet before proceeding.
    if ('checkboxes' == $params['facet']['type'] && $params['facet']['name'] == 'tile_color') {
        // Initialize variables
        $output = '';
        $items = [];
        $color_map = [
          "red" => "background-color:#f87171",
          "orange" => "background-color:#f59e0b",
          "yellow" => "background-color:#fcd34d",
          "green" => "background-color:#22c55e",
          "blue" => "background-color:#1e3a8a",
          "indigo" => "background-color:#6366f1",
          "violet" => "background-color:#8b5cf6",
          "white" => "background-color:#e2e8f0",
          'multi' => "background-color: #bbff99; background-image: linear-gradient(319deg, #bbff99 0%, #ffec99 37%, #ff9999 100%) !important",
          'metallic' => "background-image: linear-gradient(to right, #ca8a04 , #facc15) !important",
          'grey' => "background-color: #d1d5db",
          'pink' => "background-color: #fda4af",
          'brown' => "background-color: #7f1d1d",
        ];

        // Get the selected values for the facet
        $selected_values = $params['selected_values'];
      
        // Get all the values for the facet
        $values = $params['values'];

        // Loop through the values and create items, marking them as "checked" or "disabled" as needed
        foreach ($values as $value) {
            // Write the markup for each item
            $items[] = sprintf(
                '<div class="custom-control tw-flex tw-items-center custom-checkbox tw-pb-2">
                  <input type="checkbox" class="tw-hidden facetwp-checkbox %2$s %4$s" id="%1$s" data-value="%1$s" %2$s %4$s>
                  <label class="tw-flex custom-control-label tw-cursor-pointer" for="%1$s">
                    <div style="%5$s;" class="th-color-bullet tw-w-6 tw-h-6 tw-rounded-full tw-inline tw-mr-2 %2$s %4$s"></div>
                    <div>%3$s</div>
                  </label>
                </div>',
                $value['facet_value'], // The facet value
                in_array($value['facet_value'], $selected_values) ? 'checked' : '', // If this item is selected, add the "checked" class and attribute
                $value['facet_display_value'], // The facet display value
                ($value['counter']) ? '' : 'disabled', // Disable the item if its count is zero
                $color_map[$value['facet_value']] ? 
                  $color_map[$value['facet_value']] : 'background-color:black',
            );
        }
    } else {
      // Initialize variables
      $output = '';
      $items = [];

      // Get the selected values for the facet
      $selected_values = $params['selected_values'];
    
      // Get all the values for the facet
      $values = $params['values'];

      // Loop through the values and create items, marking them as "checked" or "disabled" as needed
      foreach ($values as $value) {
          // Write the markup for each item
          $items[] = sprintf(
              '<div class="tw-flex tw-items-center">
                <input type="checkbox" class="th-checkbox facetwp-checkbox custom-control-input %2$s %4$s" id="%1$s" data-value="%1$s" %2$s %4$s>
                <label class="custom-control-label" for="%1$s">%3$s</label>
              </div>',
              $value['facet_value'], // The facet value
              in_array($value['facet_value'], $selected_values) ? 'checked' : '', // If this item is selected, add the "checked" class and attribute
              $value['facet_display_value'], // The facet display value
              ($value['counter']) ? '' : 'disabled', // Disable the item if its count is zero
          );
      }
    }
    // Write the markup for the whole facet
    $output = sprintf(
        '%s',
        implode($items),
    );

    // Return the whole darn thing
    return $output;
}, 10, 2);