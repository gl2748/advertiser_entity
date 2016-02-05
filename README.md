### Drupal 8 Barebones Entity

This is a barebones drupal 8 entity with tests.

#### Requirements
* Composer
* Drush 8.x.x

#### Helpful Hints.

Tests start from scratch - hence no need for `drush pm-uninstall; drush en advertiser`
when you have updated the meta-properties of your entity.
Tests don't give you a verbose output, to test specific stuff in terminal:

`drush php-eval '$entity = \Drupal\advertiser\Entity\Advertiser::create(); $entity->save();'`
`drush php-eval '$entity = \Drupal\advertiser\Entity\Advertiser::create(); print($entity->uuid()."\n"); $entity->save();'`



#### Running Tests

```
composer create-project drupal-composer/drupal-project:8.x-dev drupal --stability dev --no-interaction
cd drupal/web
drush si testing --db-url=mysql://root@localhost/rrre --account-name=admin --account-pass=admin
drush en simpletest -y
cd modules
git clone https://github.com/gl2748/advertiser_entity advertiser
cd ..
php core/scripts/run-tests.sh --module advertiser
```
### Helpful hints
*  Tests run from scratch - hence no need for `drush pm-uninstall advertiser; drush en advertiser` (altough you may want to do that after changing your entity).
*  Tests don't give verbose output, figure things out in the cli with something like - `drush php-eval '$entity = \Drupal\advertiser\Entity\Advertiser::create(); print($entity->uuid()."\n"); $entity->save();`
