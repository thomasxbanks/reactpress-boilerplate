# `LXLReactPress` Boilerplate

A highly-opinionated boilerplate for creating a headless [WordPress](http://wordpress.org) installation using [React](http://reactjs.org) as the frontend.

## Prerequisites
- [Composer]() for package management
- [Robo](https://robo.li) for task running
- [Node](https://nodejs.org)
- [npm](https://www.npmjs.com) (bundled with Node)

## Installation
### 1. Install the composer dependencies by running this command in your `root` directory:
```bash
  composer install
```

### 2. Update your variables in the `wp-cli.yml` file

```yaml
path: backend
config create:
    dbhost: localhost
    dbname: lxl_reactpress
    dbuser: root
    dbpass: 
    extra-php: |
        define( 'WP_DEBUG', true );
        define( 'WP_POST_REVISIONS', 50 );
core install:
    url: backend.bedrock.txb
    title: Lxl ReactPress
    admin_user: thomas.banks
    admin_email: thomas.banks@havas.com
color: true
disabled_commands:
  - db drop
```


### 3. Install the application by running this command in your `root` directory:
```bash
robo install
```

Robo will do everything to give you a clean basic project.
- WordPress: optimized to remove default themes and plugins
- A collection of handy single-function plugins to reduce the WP footprint in the database
- A "nothing" theme with almost zero functionality to stop WP complaining but save server space
- A clean install of the `frontend` folder

### 4. Set up your `.hosts` to find the installation.

Using Valet, for example.
```bash
  cd backend
  valet link backend.SITE_URL
```

<!-- @TODO: React/WP-REST boilerplate -->
<!-- @TODO: Install plugins config -->