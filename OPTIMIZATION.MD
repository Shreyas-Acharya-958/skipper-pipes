# Laravel HTML Optimization Guide

This guide explains how to enable **HTML minification and compression** in a Laravel application using the `vrkansagara/lara-out-press` package.

---

## 1. Install Package

Install the package via Composer:

```bash
composer require vrkansagara/lara-out-press
```

---

## 2. Configure Environment Variables

Add the following variables to your `.env` file:

```env
MINIFY_ENABLED=true
VRKANSAGARA_COMPRESS_ENABLED=true
VRKANSAGARA_COMPRESS_ENVIRONMENT='prod,testing,dev,local'
```

### Variable Explanation

| Variable                           | Description                                                              |
| ---------------------------------- | ------------------------------------------------------------------------ |
| `MINIFY_ENABLED`                   | Enables HTML minification to remove unnecessary whitespace and comments. |
| `VRKANSAGARA_COMPRESS_ENABLED`     | Enables response compression for optimized output.                       |
| `VRKANSAGARA_COMPRESS_ENVIRONMENT` | Defines environments where compression is active.                        |

---

## 3. Refresh Composer Autoload

Run the following command to rebuild the Composer autoload files:

```bash
composer dumpautoload
```

---

## 4. Clear Laravel Optimization Cache

Clear Laravel caches to ensure the new configuration is applied:

```bash
php artisan optimize:clear
```

---

## Result

After completing these steps:

* HTML output will be **minified**
* Responses will be **compressed**
* Page load performance will improve
* Bandwidth usage will decrease

---

## Recommended (Optional)

For additional performance improvements you may also run:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

These commands cache Laravel configuration, routes, and compiled Blade templates for faster execution in production environments.
