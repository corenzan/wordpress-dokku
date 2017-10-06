# Wordpress on Dokku

- [Wordpress](http://wordpress.org)
- [Dokku](http://dokku.viewdocs.io/dokku)

## How-to

### For the Wordpress developer

1. Move your Wordpress files with the exception of `index.php` and `wp-content` into a sub-directory named `wp`.
2. Download and put the following files present in this repository along with `index.php`:
    - `wp-config.php`
    - `composer.json`
    - `composer.lock`
3. Make sure `wp-config.php` isn't being ignored. i.e. remove it from `.gitignore`.
4. Add the `wp` directory to your `.gitignore` and make sure `wp-content/uploads` and `wp-content/plugins` are there too.
5. Commit everything.

### For the system administrator

1. Make sure you have support for `dokku storage` and the plugin for MariaDB installed.
2. Create a new application and mount two storage points:
    - `wp-content/plugins`
    - `wp-content/uploads`
    - `wp`
3. Create and link a new database instance.
4. Deploy and profit.

Also you should set the following environment variables:

- `WP_AUTH_KEY`
- `WP_SECURE_AUTH_KEY`
- `WP_LOGGED_IN_KEY`
- `WP_NONCE_KEY`
- `WP_AUTH_SALT`
- `WP_SECURE_AUTH_SALT`
- `WP_LOGGED_IN_SALT`
- `WP_NONCE_SALT`

The database connection info is parsed from the `DATABASE_URL` set by the database plugin, so you don't have to worry. Optionally you can set `WP_DEBUG` to `true`.

## Important

Please note that there are some considerations in this setup:

- Plugins are managed by Wordpress and not added to your repository.
- The Wordpress installation is managed by Composer and not added to your repository.
- You can't have plugins that write outside the `plugins` or `uploads` since anything except these mount points will be erased on each deploy.
