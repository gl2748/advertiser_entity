<?php
/**
 * @file
 * Contains \Drupal\advertiser\Entity\Advertiser.
 */

namespace Drupal\advertiser\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\advertiser\AdvertiserInterface;

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
 *     "label" = "name"
 *   },
 * )
 */
class Advertiser extends ContentEntityBase implements AdvertiserInterface
{
    public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
    {
        // Standard field, used as unique if primary index.
        $fields['id'] = BaseFieldDefinition::create('integer')
            ->setLabel(t('ID'))
            ->setDescription(t('The ID of the Advertiser entity.'))
            ->setReadOnly(true);
 
        $fields['name'] = BaseFieldDefinition::create('string')
            ->setLabel(t("The advertiser's name"))
            ->setDescription(t('The name of the advertiser.'));
        
        return $fields;
    }
}
