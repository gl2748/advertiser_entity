<?php

namespace Drupal\advertiser\Plugin\GroupContentEnabler;

use Drupal\node\Entity\NodeType;
use Drupal\Component\Plugin\Derivative\DeriverBase;

class AdvertiserEntityDeriver extends DeriverBase {

  /**
   * {@inheritdoc}.
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
//    foreach (NodeType::loadMultiple() as $name => $node_type) {
//      $label = $node_type->label();
//      $this->derivatives[$name] = [
//        'entity_bundle' => $name,
//        'label' => t('Group node') . " ($label)",
//        'description' => t('Adds %type content to groups both publicly and privately.', ['%type' => $label]),
//      ] + $base_plugin_definition;
//    }
//
//    return $this->derivatives;

    $this->derivatives['advertiser'] = [
        'entity_bundle' => 'advertiser',
        'label' => t('Group content: Advertiser'),
        'description' => t('Adds advertiser content to groups both publicly and privately.'),
      ] + $base_plugin_definition;

    return $this->derivatives;

  }

}
