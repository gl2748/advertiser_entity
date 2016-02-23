<?php

/**
 * @file
 * Contains \Drupal\Tests\advertiser\Kernel\AdvertiserValidationTest.
 */

namespace Drupal\Tests\advertiser\Kernel;

use \Drupal\KernelTests\KernelTestBase;
use \Drupal\advertiser\Entity\Advertiser;

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
    $entity = Advertiser::create([
      'advertiser_website' => 'www.testing.com',
    ]);
    $violations = $entity->validate();
    $this->assertEqual(count($violations), 0, 'No violations when validating a legit url.');
    /*
    // Only test one example invalid name here, TODO the rest.
    $longstring = $this->randomMachineName(2084); //Limit is set to 2083 so this is going to be too long.
    $longurl = "http://" . $longstring . ".com";
    $advertiser->set('advertiser_website', $longurl);
    $violations = $advertiser->validate();

    $this->assertEqual(count($violations), 1, 'Violation found when url is too long.');
    $this->assertEqual($violations[0]->getPropertyPath(), 'advertiser_website');
    $this->assertEqual($violations[0]->getMessage(), t('The url %longurl is too long: it must be %max characters or less.', array('%longurl' => $longurl, '%max' => 2083)));
     */
  }

}
