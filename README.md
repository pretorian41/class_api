# class_api
* clone project 

git clone git@github.com:pretorian41/class_api.git 

* init project

``` bash
cd class_api
cp .env.dist .env
docker-compose build
docker-compose up -d
docker-compose exec php bash /usr/src/app/class/make.sh
```
* example
https://madeye.pp.ua/