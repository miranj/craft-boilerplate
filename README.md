<img align="right" src="https://cdn.miranj.in/mc3/img/apple-touch-icon-precomposed.png" width="57" height="57" alt="Miranj">

# Miranj Craft Boilerplate

A [Craft CMS](https://craftcms.com/) 4 starter project based on [Miranj’s](https://miranj.in)
project boilerplate (see [`craft3`](https://github.com/miranj/craft-boilerplate/tree/craft3) for the older version). It includes:

- Our [modular templating architecture](https://miranj.in/blog/2019/modular-architecture-for-building-content-websites).
- A [Gulp](https://gulpjs.com/) based build process that uses
  - [Font Face Observer](https://github.com/bramstein/fontfaceobserver)
  - [Fontloader](https://gist.github.com/rungta/fa39058f1d15d6d4ea95)
  - [Instant.page](https://github.com/instantpage/instant.page)
  - [LazySizes](https://github.com/aFarkas/lazysizes)
  - [PhotoSwipe](https://github.com/dimsemenov/photoswipe)
  - [Pjax](https://github.com/MoOx/pjax)
  - [Tailwind CSS](https://tailwindcss.com/)
- Server configuration files for Apache (dev) and Nginx (staging, production).
- A few Craft plugins, along with their config files:
  - [CacheFlag](https://github.com/mmikkel/CacheFlag-Craft3)
  - [Child Me](https://github.com/mmikkel/ChildMe-Craft)
  - [CP Field Inspect](https://github.com/mmikkel/CpFieldInspect-Craft)
  - [Element Index Defaults](https://github.com/verbb/element-index-defaults)
  - [Environment Label](https://github.com/TopShelfCraft/Environment-Label)
  - [Field Manager](https://github.com/verbb/field-manager)
  - [Imager](https://github.com/aelvan/Imager-Craft)
  - [Image Resizer](https://github.com/verbb/image-resizer)
  - [Inventory](https://github.com/doublesecretagency/craft-inventory)
  - [Minify](https://github.com/nystudio107/craft-minify)
  - [No-Cache](https://github.com/ttempleton/craft-nocache)
  - [Redactor](https://github.com/craftcms/redactor)
  - [SEOMate](https://github.com/vaersaagod/seomate)
  - [Twig Perversion](https://github.com/marionnewlevant/craft-twig_perversion)
  - [Typogrify](https://github.com/nystudio107/craft-typogrify)
- [Prettier](https://prettier.io/) for auto-formatting (all non-Twig) code.
- Ready made fields to import to speed up the project development process.

## Usage

1.  Open your terminal and run the following command:

        composer create-project miranj/craft-boilerplate /path/to/project "dev-dev"

2.  Replace instances of "miranj/craft-boilerplate" and "boilerplate"
    with the handle of the new project in the following locations:

    - `composer.json`
    - `assets/package.json`
    - `config/app.php`
    - `src/Module.php`
    - `serverconfigs/envs/production/env.conf`
    - `serverconfigs/envs/production/setup.conf`
    - `serverconfigs/envs/staging/env.conf`
    - `serverconfigs/envs/staging/setup.conf`

3.  Replace instances of "Miranj Craft Boilerplate" / and "Boilerplate"
    with the title of the new project.

4.  Inspect all FIXME comments in the project and take necessary action.

5.  Assign values to all shared environment variables in .env.example.

6.  Run `composer dump-autoload`
