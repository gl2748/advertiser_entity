### Drupal 8 Barebones Entity.

This is a barebones drupal 8 entity with tests.

#### Running Tests. 

`drush en simpletest -y`
`php core/scripts/run-tests.sh --module advertiser`

#### Helpful Hints.

Tests start from scratch - hence no need for `drush pm-uninstall; drush en advertiser`
when you have updated the meta-properties of your entity.
Tests don't give you a verbose output, to test specific stuff in terminal:
`drush php-eval '$entity = \Drupal\advertiser\Entity\Advertiser::create(); $entity->save();'`
`drush php-eval '$entity = \Drupal\advertiser\Entity\Advertiser::create(); print($entity->uuid()."\n"); $entity->save();'`
