# Miranj Craft Boilerplate Changelog

Release notes for Miranj's Craft Boilerplate starter project.

## Unreleased 3.0.0

### Craft

- Added Craft 5 compatibility.
- Added a default HTML Purifier config.
- [Prevent user enumeration](https://craftcms.com/docs/5.x/reference/config/general.html#preventuserenumeration) on production via the _Forgot Password_ flow.
- Simplified [Redis and App Cache config](https://craftcms.com/docs/5.x/reference/config/app.html#redis-example).
- Updated Craft to 5.2.
- Updated Child Me! to 2.2.2.
- Updated CKEditor to 4.1.0.
- Updated CP Field Inspect to 2.0.1.
- Updated Element Index Defaults to 4.0.0.
- Updated Environment Label to 5.0.0.
- Updated Field Manager to 4.0.1.
- Updated Image Resizer to 4.0.0.
- Updated Imager X to 5.0.1.
- Updated Minify to 5.0.0.
- Updated No-Cache to 3.0.2.
- Updated Obfuscator to 1.2.0.
- Updated Retcon to 3.1.1.
- Updated SEOMate to 3.0.0-beta.6.
- Updated Twig Perversion to 5.0.0.
- Updated Typogrify to 5.0.1.
- Removed Inventory.

### DevOps

- Simplified `.env` config by assigning common default values.
- Simplified Apache config for dev environments.
- Refactored custom `.env` url and path variables to drop the `CRAFT_` prefix.

### System

- Added a Changelog to track updates to the boilerplate.
- Added `package-lock.json` lockfile to keep track of exact Node packages.
- Added [PHPStan](https://github.com/craftcms/phpstan) for PHP code quality audits.
- Updated Node version to 20 LTS “Iron”.
- Updated Prettier to 3.3.2.
- Updated Prettier PHP plugin to 0.22.2.
- Updated PHP to 8.2.
- The Field Library folder will now be purged in the post-install sequence.
- Removed `./craft setup` from the project post-install sequence.
- Removed legacy and redundant `.gitignore` rules.

## 2.0.0

- Craft 4 starter project.

## 1.0.0

- Craft 3 starter project.
