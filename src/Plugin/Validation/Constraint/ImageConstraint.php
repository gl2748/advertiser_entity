<?php

/**
 * @file
 * Contains \Drupal\advertiser\Plugin\Validation\Constraint\ImageConstraint.
 */

namespace Drupal\advertiser\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraints\Image;

/**
 * Checks if a value is a valid Image.
 *
 * @Constraint(
 *   id = "Image",
 *   label = @Translation("Image", context = "Validation")
 * )
 */
class ImageConstraint extends Image {
  /**
   *
   */
  public function validatedBy() {
    return '\Symfony\Component\Validator\Constraints\ImageValidator';
  }

}
