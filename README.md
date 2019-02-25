## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Features](#features)
* [Usage](#usage)

## General info
Symfony command which tests website loading speed.
	
## Technologies
Project is created with:
* Symfony 3.4
* Guzzlehttp/guzzle 6.3

## Features
* Testing loading speed of two websites using Gruzzle library
* Information which webside was slower and by how much
* Logging benchmark result to the file

## Usage
* Clone the repository
* Run composer. Once the dependencies are installed you can use following command:
```
php bin/console app:benchmark https://www.quora.com https://www.pinterest.co.uk
```
Result:
```
First URL total Request time:0.1640100479126
Second URL total Request time:0.16700887680054
Second URL was loading slower by: 0.0029988288879395
``` 
