

## Installation 

Download or clone repo

`git clone git@github.com:kloshar4o/crm.git`

### Local environment 
Navigate to `src` folder

`composer install`

Setup database connection values in `.env` and run migration:

`php artisan migrate --seed`

Done.


### Docker

Make sure these ports are free:

    nginx - :8080
    mysql - :3306
    php - :9000

If they are not, change them in `docker-compose.yml`

---

If you already have **php** (7.4+), **composer**, run:

`docker-compose up -d --build site`

this will bring up **nginx**, **mysql** and **php** containers


Navigate to `src` folder

`composer install`

`php artisan migrate --seed`

Done

----

If you don't have **php** (7.4+) and **composer** installed locally run:

`docker-compose up -d --build`

additional containers are included **composer**, **npm** and **artisan** as well us the above **nginx**, **mysql** and **php**

`docker-compose run --rm composer install`

`docker-compose run --rm  artisan migrate --seed`

Done


## Application description

If installed via **Docker** the application will run on http://localhost:8080/ by default 

##### Client user:
Every client user has a dedicated **company**, 
where he can CRUD **users** and **addresses**, 
related only to his **company** 


Login: `user@user.com`

Password: `user`

----

##### Admin user:
Admin has all the above client user capabilities, as also can CRUD **companies**.
Admin has additional views, for viewing all the **companies** and all the **users**. 

Login: `admin@admin.com`

Password: `admin`


## Developers

Installing dependencies: `npm install` or with docker `docker-compose run --rm npm install`

Hot reload: `npm run hot` or with docker `docker-compose run --rm npm run hot`

Build: `npm run dev` or with docker `docker-compose run --rm npm run dev`


----

Bringing up the Docker Compose network with `site` instead of just using `up`, ensures that only our site's containers are brought up at the start, instead of all of the command containers as well. The following are built for our web server, with their exposed ports detailed:

- **nginx** - `:8080`
- **mysql** - `:3306`
- **php** - `:9000`

Three additional containers are included that handle Composer, NPM, and Artisan commands *without* having to have these platforms installed on your local computer. Use the following command examples from your project root, modifying them to fit your particular use case.

- `docker-compose run --rm composer update`
- `docker-compose run --rm npm run dev`
- `docker-compose run --rm artisan migrate` 

### Persistent MySQL Storage

By default, whenever you bring down the Docker network, your MySQL data will be removed after the containers are destroyed. If you would like to have persistent data that remains after bringing containers down and back up, do the following:

1. Create a `mysql` folder in the project root, alongside the `nginx` and `src` folders.
2. Under the mysql service in your `docker-compose.yml` file, add the following lines:

```
volumes:
  - ./mysql:/var/lib/mysql
```
