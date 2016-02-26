<?php
/**
 * @file
 * Contains \Drupal\advertiser\Entity\Advertiser.
 */

namespace Drupal\advertiser\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Defines the Advertiser entity.
 *
 * @ingroup advertiser
 *
 * @ContentEntityType(
 *   id = "advertiser",
 *   label = @Translation("Advertiser"),
 *   base_table = "advertiser",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "advertiser_name",
 *     "uuid" = "uuid",
 *   },
 * )
 */
class Advertiser extends ContentEntityBase implements ContentEntityInterface {

  /**
   * Gets the value for the advertiser_website field of an advertiser entity.
   */
  public function getWebsite() {
    return $this->get('advertiser_website')->get(0)->get('value')->getValue();
  }

  /**
   * Sets the value for the advertiser_website field of an advertiser entity.
   */
  public function setWebsite($advertiser_website) {
    $this->get('advertiser_website')->value = $advertiser_website;
    return $this;
  }

  /**
   * Gets the value for the advertiser_image field of an advertiser entity.
   */
  public function getImage() {
    return $this->get('advertiser_image')->value;
  }

  /**
   * Sets the value for the advertiser_image field of an advertiser entity.
   */
  public function setImage($advertiser_image) {
    $this->get('advertiser_image')->value = $advertiser_image;
    return $this;
  }

  /**
   * Gets the value for the advertiser_body field of an advertiser entity.
   */
  public function getBody() {
    return $this->get('advertiser_body')->value;
  }

  /**
   * Sets the value for the body field of an advertiser entity.
   */
  public function setBody($body) {
    $this->get('advertiser_body')->value = $body;
    return $this;
  }

  /**
   * Determines the schema for the base_table property defined above.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    // Standard field, used as unique if primary index.
    $fields['id'] = BaseFieldDefinition::create('integer')
        ->setLabel(t('ID'))
        ->setDescription(t('The ID of the Advertiser entity.'))
        ->setReadOnly(TRUE);

    // Standard field, unique outside of the scope of the current project.
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Contact entity.'))
      ->setReadOnly(TRUE);

    // Name field for the advertiser.
    $fields['advertiser_name'] = BaseFieldDefinition::create('string')
        ->setLabel(t("The advertiser's name"))
        ->setDescription(t('The name of the advertiser.'))
        ->setSettings(array(
          'default_value' => '',
          'max_length' => 255,
          'text_processing' => 0,
        ));

    // Body field for the advertiser.
    $fields['advertiser_body'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Body'))
      ->setDescription(t('A descriptive blurb for the advertiser.'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ));

    // Website field for the advertiser.
    $fields['advertiser_website'] = BaseFieldDefinition::create('string')
        ->setLabel(t("The advertiser's website"))
        ->setDescription(t('The website address of the advertiser.'))
        ->setSettings(array(
          'default_value' => '',
          'max_length' => 2083,
          'text_processing' => 0,
        ))
    // https://drupalwatchdog.com/volume-5/issue-2/introducing-drupal-8s-entity-validation-api
        ->addPropertyConstraints('value', ['Url' => []]);

    // Logo image field for the advertiser.
    $fields['advertiser_image'] = BaseFieldDefinition::create('uri')
      ->setLabel(t('Image'))
      ->setDescription(t('An image representing the feed.'))
      ->addPropertyConstraints('value', ['Image' => []]);
    return $fields;
  }

}
