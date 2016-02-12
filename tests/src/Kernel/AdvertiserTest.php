<?php

/**
 * @file
 * Unit tests for the Advertiser Entity.
 */

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
   * {@inheritDoc}.
   */
  public static $modules = ['advertiser', 'system'];

  /**
   * {@inheritDoc}.
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
    $entity = Advertiser::create(
          [
            'name' => $label,
          ]
      );

    // Save it.
    $entity->save();

    // Get the id.
    $id = $entity->id();

    // Load the saved entity.
    $saved_entity = Advertiser::load($id);

    // Check label.
    $this->assertEquals($label, $saved_entity->label());

  }

  /**
   * Saves an advertiser & makes sure the uuid is set.
   */
  public function testAdvertiserUuid() {

    $label = 'Random Test Content';

    // Create an entity.
    $entity = Advertiser::create(
          [
            'name' => $label,
          ]
      );

    // Save it.
    $entity->save();

    // Get the uuid.
    $uuid = $entity->uuid();

    // Get the id.
    $id = $entity->id();

    // Load the saved entity.
    $saved_entity = Advertiser::load($id);

    // Check UUID.
    $this->assertEquals($uuid, $saved_entity->uuid());

    // Check the string length of uuid is 36.
    $this->assertEquals(strlen($uuid), 36);
  }

  /**
   * Saves an advertiser & makes sure the website address field is set.
   */
  public function testAdvertiserUrl() {

    $website = 'www.helloeveryone.org';
    $label = 'random label';

    // Create an entity.
    $entity = Advertiser::create(
          [
            'name' => $label,
            'website' => $website,
          ]
      );

    // Save it.
    $entity->save();

    // Get the id.
    $id = $entity->id();

    // Load the saved entity.
    $saved_entity = Advertiser::load($id);

    // Get the website address from the website field using the website method
    // ddefined in our advertiser class.
    $weburl = $saved_entity->website();

    // Check the website field matches.
    $this->assertEquals($website, $weburl);
  }

}
