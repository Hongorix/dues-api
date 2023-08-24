# Dues API

API with CRUD operations, filtering and authorization with Sanctum.

To use this API you need make sure that you have
installed [php8+](https://www.php.net/) and [Laravel](https://laravel.com/) Framework.

# Getting started

1. Clone repository.
2. Set up new database using docker-compose file, or connect exiting one.
3. Run `php artisan migrate:refresh --seed` to fill your database.
4. Run `php artisan serve` to launch API.

# Database structure

<img src="https://i.imgur.com/f6lFVGG.png">

In this project we use two main tables: collections, contributions. Users table only for authorization and creating new collections.

# Avaible requests

<img src="https://i.imgur.com/Yldd4dY.png">

Assume we have variable called {{BASE_URL}}.

{{BASE_URL}} = `http://127.0.0.1:8000/api/` - it will be our variable for endpoints.

## API calls:

**Obtain token** - `{{BASE_URL}}login`, method POST, require JSON body with "email" and "password". You can obtain token for user from users table. Take email from users table, password by default will be "password"(if you fill DB via seeding).

**Create new collections** - `{{BASE_URL}}collections`, method POST, require JSON body with "title","description","target_amount" and "link". Also only authorized users can create collections (Bearer Token).

**Get list of all collections** - `{{BASE_URL}}collections`, method GET, does not require authorization.

**Add contribution** - `{{BASE_URL}}collections/{collections_id}/contributors`, method POST, require JSON body with "user_name" and "amount", does not require authorization.

**View collection details** - `{{BASE_URL}}collections/{collections_id}`, method GET, does not require authorization. View collection data and all contributors("user_name" and "amount") in this collection.

**Contribution filtering** - `{{BASE_URL}}collections?ShowOnlyUnfinished`, method GET, does not require authorization. Will display only unfinished collections(all contribution amount less that target_amount). You will view collections data with all contributors in it.

**Edit collection** - `{{BASE_URL}}collections/{collections_id}`, method PUT, require authorization and JSON body with one or more parameters: "title","description","target_amount" and "link".

**Delete collection** - `{{BASE_URL}}collections/{collections_id}`, method DELETE, require authorization. Will return 204 status code if deleted successfully.

**Edit contribution** - `{{BASE_URL}}collections/{collections_id}/contributors/{contributors_id}`, method PUT, require authorization and JSON body with one or two parameters: "user_name","amount".

**Delete contribution** - `{{BASE_URL}}collections/{collections_id}/contributors/{contributors_id}`, method DELETE, require authorization. Will return 204 status code if deleted successfully.

If you entering parameters make sure that you input valid data. All parameters have validation.
