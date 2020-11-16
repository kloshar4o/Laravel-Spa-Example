

## Installation 

Download or clone repo

`git clone git@github.com:kloshar4o/crm.git`

### Local environment 
Navigate to `src` folder

`composer install`

`npm install && npm run dev`

Setup database values in `.env` 

`php artisan migrate --seed`

### Docker

To get started, make sure you have [Docker installed](https://docs.docker.com/docker-for-mac/install/) on your system, and then clone this repository.

---

If you already have **php** (7.4+), **composer** and **npm**, run:

`docker-compose up -d --build site`

this will install  **nginx**, **mysql**, **php**


Navigate to `src` folder

`composer install`

`npm install && npm run dev`

`php artisan migrate --seed`


Done

----

If you don't have **php** (7.4+), **composer** and **npm** installed locally run:

`docker-compose up -d --build`

this will install  **nginx**, **mysql**, **php**, **composer**, **npm** and **artisan**


`docker-compose run --rm composer install`

`docker-compose run --rm npm install && npm run dev`

`docker-compose run --rm  artisan migrate --seed`

Done

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

## Application description

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
