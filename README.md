#Quick start
- **Step1:** : Git clone : `https://github.com/10102004tan/Job-oishi-api.git`
- **Step2:** : Turn on docker on desktop
- **Step3:** : In cmd run `docker-compose up -d`
- **Step4:** : In brower enter host : `http://localhost:3001/`

#CMD option
- Open data database : `docker-compose exec mysqldb mysql -u root -p`
- Show data in mysql : `SHOW DATABASES;`(required login)
- Migrate cmd in laravel : `docker-compose exec app php artisan migrate`
