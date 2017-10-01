# Journals

### Instalation

(Assuming docker and docker-compose is installed)
- Clone repository
- Enter root dir in shell
- Run command to build docker services
```bash
php phing.phar docker:build
```
- Run command to start docker containers
```bash
php phing.phar docker:build
```
- Wait until dependencies installation is finished. You can check progress using command:
```bash
docker logs -f journals-php-fpm
```
- Seed database using command:
```bash
docker exec -it journals-php-fpm bash -c 'php phing.phar database:reseed'
```
- Open [http://localhost:8081](http://localhost:8081)

