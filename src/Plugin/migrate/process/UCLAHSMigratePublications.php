<?php

namespace Drupal\uclahs_migrate_profiles\Plugin\migrate\process;

use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;

/**
 * Provides a 'UCLAHSMigratePublications' migrate process plugin.
 *
 * @MigrateProcessPlugin(
 *  id = "uclahs_publications",
 *  handle_multiples = TRUE
 * )
 */
class UCLAHSMigratePublications extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    // Plugin logic goes here.
    if (empty($value)) {
      return '';
    }
    $output = '<h3>Publications</h3><ul>';
    $i = 0;
    foreach ($value as $pub) {
      if (!empty($pub['citation'])) {
        $citation = $pub['citation'];
        $url = $pub['pubmedUrl'];
        $output .= "<li>$citation (<a href=\"$url\">view article</a>)</li>";
        $i++;
      }
      if ($i >= 10) {
        // Only display first 10 publications
        break;
      }
    }
    $output .= '</ul>';
    return $output;
  }

}
