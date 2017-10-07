# Wordpress on Dokku

- [Wordpress](http://wordpress.org)
- [Dokku](http://dokku.viewdocs.io/dokku)

## How-to

### For the Wordpress developer

1. Remove (`git rm --cached`) everything from your Wordpress installation with the exception of `wp-content`.
2. Download and put the following files present in this repository along with `wp-content`:
    - `.htaccess`
    - `.user.ini`
    - `index.php`
    - `wp-config.php`
    - `composer.json`
    - `composer.lock`
3. Remove `wp-config.php` and `.htaccess` from your `.gitignore` and add these lines:
    ```
    wordpress/
    vendor/
    wp-content/plugins/*
    wp-content/uploads/*
    !wp-content/plugins/index.php
    !wp-content/uploads/index.php
    ```
4. Commit everything.

### For the system administrator

1. Make sure you have support for `dokku storage` and the plugin for MariaDB installed.
2. Create a new application and mount two storage points:
    - `/var/lib/dokku/data/storage/<application>/plugins:/app/wp-content/plugins`
    - `/var/lib/dokku/data/storage/<application>/uploads:/app/wp-content/uploads`
3. Create and link a new database instance.
4. Move `nginx.conf.d/wordpress.conf` to `/home/dokku/<application>/nginx.conf.d/wordpress.conf` and restart nginx.
5. Deploy and profit.

You should set the following environment variables:

- `WP_AUTH_KEY`
- `WP_SECURE_AUTH_KEY`
- `WP_LOGGED_IN_KEY`
- `WP_NONCE_KEY`
- `WP_AUTH_SALT`
- `WP_SECURE_AUTH_SALT`
- `WP_LOGGED_IN_SALT`
- `WP_NONCE_SALT`

The database connection info is parsed from the `DATABASE_URL` set by the database plugin, so you don't have to worry. Optionally you can also set `WP_DEBUG` to `true`.

## Important

Please note that there are some considerations in this setup:

- Plugins are managed by Wordpress and not added to your repository.
- The Wordpress installation is managed by Composer and not added to your repository.
- You can't have plugins that write outside `wp-content/plugins` and `wp-content/uploads` since anything except these mount points will be erased on each deploy.
- Whenever you need to sync your development environment use a migration plugin to get a dump of the database as well as the uploaded assets.

## References

- https://github.com/dokku-community/dokku-wordpress
