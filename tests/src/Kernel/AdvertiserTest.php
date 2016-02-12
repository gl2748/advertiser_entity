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
            'advertiser_name' => $label,
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
            'advertiser_name' => $label,
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
            'advertiser_name' => $label,
            'advertiser_website' => $website,
          ]
      );

    // Save it.
    $entity->save();

    // Get the id.
    $id = $entity->id();

    // Load the saved entity.
    $saved_entity = Advertiser::load($id);

    // Get the website address from the website field using the getWebsite method.
    $weburl = $saved_entity->getWebsite();

    // Check the website field matches.
    $this->assertEquals($website, $weburl);
  }
  /**
   * Saves an advertiser & checks the image field is set.
   */
  public function testAdvertiserImage() {

    $imageSrc  = file_unmanaged_copy('https://placeholdit.imgix.net/~text?txtsize=33&txt=350%C3%97150&w=350&h=150', 'public://destination.jpg', FILE_EXISTS_REPLACE);
    
    // Create an entity.
    $entity = Advertiser::create(
          [
            'advertiser_image' => $imageSrc,
          ]
      );

  }

}
