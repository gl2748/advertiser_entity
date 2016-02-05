<?php

/**
 * @file
 * Contains \Drupal\Tests\advertiser\Kernel\AdvertiserTest.
 */

namespace Drupal\Tests\advertiser\Kernel;

use Drupal\KernelTests\KernelTestBase;

use \Drupal\advertiser\Entity\Advertiser;

/**
 * @coversDefaultClass \Drupal\advertiser\Entity\Advertiser
 * @group advertiser
 */
class AdvertiserTest extends KernelTestBase {

  /**
   * {@inheritDoc}
   */
  public static $modules = ['advertiser', 'system'];

  /**
   * {@inheritDoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->installEntitySchema('advertiser');
  }

  /**
   * Saves an advertiser & make sure values are properly set.
   */
  public function testSaveAdvertiser() {
    $label = 'ADM: Supermarket to the World';

    // Create an entity.
    $entity = Advertiser::create([
      'name' => $label,
    ]);

    // Save it.
    $entity->save();

    // Get the id.
    $id = $entity->id();

    // Get the uuid.
    $uuid = $entity->uuid();

    // Load the saved entity.
    $saved_entity = Advertiser::load($id);

    // Check label
    $this->assertEquals($label, $saved_entity->label());

    // Check UUID
    $this->assertEquals($uuid, $saved_entity->uuid());
    
    // Check the string length of uuid is 36.
    $this->assertEquals(strlen($saved_entity->uuid()), 36);

  }

}
