<?php

/**
 * @file
 * Contains \Drupal\advertiser\Plugin\Validation\Constraint\UrlConstraint.
 */

namespace Drupal\advertiser\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraints\Url;

/**
 * Checks if a value is a valid Url.
 *
 * @Constraint(
 *   id = "Url",
 *   label = @Translation("Url Value", context = "Validation")
 * )
 */

class UrlConstraint extends Url {
  
  public $message = 'The url is not valid.';

  public function validatedBy() {
    return '\Symfony\Component\Validator\Constraints\UrlValidator';
  }
}


