### Drupal 8 Barebones Entity

This is a barebones drupal 8 entity with tests.

#### Requirements

* Composer
* Drush 8.x.x

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
