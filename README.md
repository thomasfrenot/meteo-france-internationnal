#MOUNTAIN PEAK

## exercice demandé
```
Mountain Peak (Fullstack)

The context of this test is to provide a simple web service for storing and retrieving moutain peaks.
Using PHP (use of a PHP framework is possible but not mandatory) 
and a postgresql database (postGIS can be used for geo features), 

implement the following features:
- models/db tables for storing a peak location and attribute: lat, lon, altitude, name
- REST api endpoints to :
  - create/read/update/delete a peak
  - retrieve a list of peaks in a given geographical bounding box

Then using Js or Jquery (no JS Framework required) 
implement the following features:
- Display some mountain locations on a map
- On click on a mountain location, display mountain attributes: lat, lon, altitude, name

Deploy all this stack using docker and docker-compose
The source code should be delivered using github with detailed explanations on how to deploy and launch the project.
```

## Instalation du projet
Pré-requis pour le projet avoir docker, composer, node et npm d'installer sur la machine

cloner le projet sur votre local : `git clone git@github.com:thomasfrenot/meteo-france-internationnal.git`

### Back office

se rendre dans le répertoire /back et lancer la commande `composer install` 
puis `docker-compose up -d` pour lancer les containers NGINX / PostgreSQL et PHP
A présent vous pouvez utiliser l'api via postman par exemple.
la structure de la base de données est importé, ainsi que quelques sommets européens.

l'API est consommable sur l'URL : `http://localhost:52000`

Endpoints : 
- GET `/` : liste l'ensemble des sommets
- GET `/read/{id}` : récupère l'information pour un sommet donné
- POST `/create` : créé un nouveau sommet en base de donnée, il faut envoyer les données suivantes en POST form-data
    
    - lat *(float)*
    - lon *(float)*
    - altitude *(int)*
    - name *(string)*
- POST `/update/{id}` : mise à jour d'un sommet donné, il faut envoyer les données suivantes en POST form-data

    - lat *(float)*
    - lon *(float)*
    - altitude *(int)*
    - name *(string)*
- DELETE `/delete/{id}` : supprime le sommet donné

### Front office

se rendre dans le répertoire /front et lancer la commande `npm install`
puis `npm run build`

enfin ouvrir dans le navigateur : `http://localhost:8080/`
