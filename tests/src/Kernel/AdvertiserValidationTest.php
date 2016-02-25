<?php

/**
 * @file
 * Contains \Drupal\Tests\advertiser\Kernel\AdvertiserValidationTest.
 */

namespace Drupal\Tests\advertiser\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\advertiser\Entity\Advertiser;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Url;

/**
 * Verify that advertiser validity checks behave as designed.
 *
 * @coversDefaultClass \Drupal\advertiser\Entity\Advertiser
 *
 * @group advertiser
 */
class AdvertiserValidationTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
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
   * Runs entity validation checks.
   */
  public function testAdvertiserUrls() {
    $advertiser = Advertiser::create([
      'advertiser_website' => 'http://testing.com',
    ]);
    $violations = $advertiser->validate();
    $this->assertEqual(count($violations), 0, 'No violations when validating a legit url.');

    
    // Testing some invalid urls here, TODO the rest.
    // Limit is set to 2083 so this is going to be too long.
    $longstring = $this->randomMachineName(2084);
    $longurl = "http://www." . $longstring . ".com";
    $advertiser->set('advertiser_website', $longurl);
    $violations = $advertiser->validate();
    $this->assertEqual(count($violations), 1, 'Violation found when url is too long.');


    //Test the url constraint.
    $advertiser->set('advertiser_website', "FTP://notgonnawork.com");
    $violations = $advertiser->validate();
    $this->assertEqual(count($violations), 1, 'Violation found when url is not valid http / https.');
 
  }

}
