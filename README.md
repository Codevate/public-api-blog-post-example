# Public OAuth API

A companion Symfony project for our blog post on securing client-side public API access with OAuth 2 and Symfony.

## Getting started

Install dependencies:

```
composer install
```

Create the database and setup the schema:

```
php app/console doctrine:database:create --if-not-exists
php app/console doctrine:schema:update --force
```

Create a new company in the database, then generate an OAuth client:

```
php app/console app:oauth-client:create <company-id>
```

Create a new restaurant in the database, then generate a hashid for it:

```
php app/console app:restaurant:encode-id <restaurant-id>
```

Start the server:

```
php app/console server:run
```

Then follow the "Calling the API" section in the blog post.

## About Codevate
Codevate is a specialist [UK mobile app development company](https://www.codevate.com/) that builds cloud-connected software. This repository was created for a blog post about a [custom web application development](https://www.codevate.com/services/web-development) project and was written by [Chris Lush](https://github.com/lushc).
