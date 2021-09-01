#Build up:
1. Clone repo
2. Select repo dir
3. Run bash command: `cp .env.test .env`
4. Set your password for DB in file `.env`
5. Write new line in `/etc/hosts`: `127.0.1.1 symfony.localhost`
6. Enter the command and run it: `./export_variables.sh && source ~/.bashrc && ./setup.sh`
7. After those actions you need change cur dir on project dir: `cd app/server`
8. Run bash command: `cp .env.test .env` and change its content on follows:
   - Set in `APP_SECRET` content from https://coderstoolbox.online/toolbox/generate-symfony-secret
   - Set random string value in `API_TOKEN`
   - Update DB connection in `DATABASE_URL`
9. Go back: `cd ..`
10. Optionally you may create specific database:
    - Run bash command: `docker exec -ti mysql bash`
    - Authorize and create database
11. Run bash command: `docker exec -ti php-fpm bash`
12. Go to the project-core dir: `cd ..`
13. Run bash command: `COMPOSER_MEMORY_LIMIT=-1 composer i --ignore-platform-reqs`
14. Execute migrations: `php bin/console doctrine:migrations:migrate`

#Console task (getting customers):
1. Run bash command: `php bin/console customers.import 100`

#Routes:
1. `/api/v1/customers/`
2. `/api/v1/customers/{id}/`

I'm terrible sorry for that I'm not included this section on swagger documentation(
