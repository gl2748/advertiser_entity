<?php

/**
 * @file
 * Unit tests for the Advertiser Entity.
 *
 * Intro: https://api.drupal.org/api/drupal/core!core.api.php/group/testing/8.
 */

/**
 * @file
 * Contains \Drupal\Tests\advertiser\Kernel\AdvertiserTest.
 */

namespace Drupal\advertiser\Tests;

use \Drupal\file\Tests\FileManagedUnitTestBase;
use \Drupal\file\Entity\File;
use \Drupal\advertiser\Entity\Advertiser;

/**
 * @coversDefaultClass \Drupal\advertiser\Entity\Advertiser
 * @group advertiser
 */
class AdvertiserTest extends FileManagedUnitTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['advertiser', 'file', 'system'];

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
    $entity = Advertiser::create([
      'advertiser_name' => $label,
    ]);

    // Save it.
    $entity->save();

    // Get the id.
    $id = $entity->id();

    // Load the saved entity.
    $saved_entity = Advertiser::load($id);

    // Check label.
    $this->assertEqual($label, $saved_entity->label(), 'Label created successfully', 'label');
  }

  /**
   * Saves an advertiser & makes sure the uuid is set.
   */
  public function testAdvertiserUuid() {

    $label = 'This is Test Content';

    // Create an entity.
    $entity = Advertiser::create([
      'advertiser_name' => $label,
    ]);

    // Save it.
    $entity->save();

    // Get the uuid.
    $uuid = $entity->uuid();

    // Get the id.
    $id = $entity->id();

    // Load the saved entity.
    $saved_entity = Advertiser::load($id);

    // Check UUID.
    $this->assertEqual($uuid, $saved_entity->uuid(), 'UUID created successfully', 'uuid');

    // Check the string length of uuid is 36.
    $this->assertEqual(strlen($uuid), 36, 'UUID length is 36', 'uuid');
  }

  /**
   * Saves an advertiser & makes sure the website address field is set.
   */
  public function testAdvertiserUrl() {
    $website = 'www.helloeveryone.org';
    $label = 'not-so-random label';

    // Create an entity.
    $entity = Advertiser::create([
      'advertiser_name' => $label,
      'advertiser_website' => $website,
    ]);

    // Save it.
    $entity->save();

    // Get the id.
    $id = $entity->id();

    // Load the saved entity.
    $saved_entity = Advertiser::load($id);

    // Get the website address from the website.
    $weburl = $saved_entity->getWebsite();

    // Check the website field matches.
    $this->assertEqual($website, $weburl, 'Website field saved', 'website');
  }

  /**
   * Saves an advertiser & checks the image field is set.
   */
  public function testAdvertiserImage() {
    // Download an example image from the internet.
    $test_data = file_get_contents('https://www.drupal.org/sites/all/modules/drupalorg/drupalorg/images/qmark-400x684-2x.png');

    //Save the file to the temporary scheme.
    $image_file = file_save_data($test_data, 'temporary://test_test_test.png', FILE_EXISTS_REPLACE);
    $image_file_uri = $image_file->getFileUri();

    // Create an entity.
    $entity = Advertiser::create([
      'advertiser_image' => $image_file_uri,
    ]);

    // Save it.
    $entity->save();

    // Get the id.
    $id = $entity->id();

    // Load the saved entity.
    $saved_entity = Advertiser::load($id);

    // Get the imageUri from the entity's image field using the getImage method defined in our entity.
    $image_uri = $saved_entity->getImage();

    // Check the imageUri field matches.
    $this->assertEqual($image_file_uri, $image_uri, 'Image successfully saved', 'image');
  }

  /**
   * Saves an advertiser & makes sure the body field is set.
   */
  public function testAdvertiserBody() {
    $body = 'A reasonably long chunk of text representing a description of this particular advertiser. A bit like the blurb on the back of a book.';

    // Create an entity.
    $entity = Advertiser::create([
      'advertiser_body' => $body,
    ]);

    // Save it.
    $entity->save();

    // Get the id.
    $id = $entity->id();

    // Load the saved entity.
    $saved_entity = Advertiser::load($id);

    // Get the website address from the website.
    $advertiser_body = $saved_entity->getBody();

    // Check the website field matches.
    $this->assertEqual($body, $advertiser_body, 'Body field successfully set', 'body');
  }

}
