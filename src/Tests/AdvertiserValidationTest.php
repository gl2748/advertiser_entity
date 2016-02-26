<?php

/**
 * @file
 * Contains \Drupal\Tests\advertiser\Kernel\AdvertiserValidationTest.
 */

namespace Drupal\advertiser\Tests;

// Use Drupal\KernelTests\KernelTestBase;.
use Drupal\advertiser\Entity\Advertiser;

// https://api.drupal.org/api/drupal/core%21modules%21file%21src%21Tests%21FileManagedUnitTestBase.php/8
use \Drupal\file\Tests\FileManagedUnitTestBase;

// Use Symfony\Component\Validator\Validation;
// https://api.drupal.org/api/drupal/namespace/Symfony!Component!Validator!Constraints/8
/**
 * Verify that advertiser validity checks behave as designed.
 *
 * @coversDefaultClass \Drupal\advertiser\Entity\Advertiser
 *
 * @group advertiser
 */
class AdvertiserValidationTest extends FileManagedUnitTestBase {

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
   * Runs entity validation checks.
   */
  public function testAdvertiserUrls() {
    $advertiser = Advertiser::create([
      'advertiser_website' => 'http://testing.com',
    ]);
    $violations = $advertiser->validate();
    $this->assertEqual(count($violations), 0, 'No violations when validating a legit url.');

    // Testing some invalid urls here, TODO the rest.
    // Url Length is set to 2083 so this is going to be too long.
    $longstring = $this->randomMachineName(2084);
    $longurl = "http://www." . $longstring . ".com";
    $advertiser->set('advertiser_website', $longurl);
    $violations = $advertiser->validate();
    $this->assertEqual(count($violations), 1, 'Violation found when url is too long.');

    // Test the url constraint.
    $advertiser->set('advertiser_website', "FTP://notgonnawork.com");
    $violations = $advertiser->validate();
    $this->assertEqual(count($violations), 1, 'Violation found when url has invalid protocol - FTP');
  }


  /**
   *
   */
  public function testAdvertiserImages() {

    // Download an example image from the internet.
    $test_data = file_get_contents('https://www.drupal.org/sites/all/modules/drupalorg/drupalorg/images/qmark-400x684-2x.png');

    // Save the file to the temporary scheme, let's save it as a .txt so the validation fails...
    $image_file = file_save_data($test_data, 'temporary://test_test_test.txt', FILE_EXISTS_REPLACE);
    $image_file_uri = $image_file->getFileUri();

    // Create an entity and set the image file..
    $entity = Advertiser::create([
      'advertiser_image' => $image_file_uri,
    ]);
    $violations = $entity->validate();
    $this->assertEqual(count($violations), 1, 'Violation found when non-image filename.');

  }

}
