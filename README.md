POLICAT 
=======

General information
-------------------
- the application is split in 2 apps based on [Symfony Framework version 1](https://symfony.com/legacy)
- the _frontend_ app is responsible for the policat.org website, the configuration backend and admin area
- the _widget_ app is responsible for widgets integrated on other websites
- a third app based on [Symfony Framework version 5 LTS](https://symfony.com/) is utilized by the _frontend_ app for large file exports

System Requirements
-------------------
- PHP 7.2
- MySQL 8
- node.js 12
- nginx with php-fpm

Hosting
-------
- policat.org is hosted on [gridscale](https://gridscale.io/)
- the application is running in a docker environment
  - all docker configuration is found in the `/docker/` directory
  - `policat-live/` and `policat-staging/` contain configuration for www.policat.org and staging.policat.org 
  - `mysql/` contains the configuration for the database 
  - `proxy/` contains the nginx configuration for all sites
- the docker environments currently use docker images provided by git.webvariants.de

Deployment Process
------------------
- the current deployment process is tied to git.webvariants.de and therefore **deprecated**
- application docker images are generated using Gitlab CI and stored in the Gitlab docker registry
- releases (staging and live) are tagged in the Gitlab docker registry
- the deployment is triggered manually in the CI pipeline
- a gitlab-runner process running on the gridscale server is connecting to the Gitlab docker registry, pulling the current tagged image and restarting the docker container

Development
-----------
- local development is based on docker-compose
- [setup instructions](doc/docker-develop.md)

### Repository structure
- `api/`: a Symfony 5 LTS application providing a simple api for large file exports
- `apps/frontend/`: configuration and files for _frontend_ app
- `apps/widget/`: configuration and files for _widget_ app
- `config/`: shared configuration for _frontend_ and _widget_ apps
- `doc/`: some developer documentation
- `lib/`: shared code for _frontend_ and _widget_ apps
- `plugins/`: shared resources for _frontend_ and _widget_ apps
- `web/`: web root containing public resources and php init files for all apps

