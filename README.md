<p align="center">
<a href="https://travis-ci.org/sadok-f/docker-secrets"><img alt="Build Status" src="https://travis-ci.org/sadok-f/docker-secrets.svg?branch=master"></a>
<a href="https://codeclimate.com/github/sadok-f/docker-secrets"><img alt="Code Climate" src="https://codeclimate.com/github/sadok-f/docker-secrets/badges/gpa.svg"></a>
</p>

# Docker Secrets

A simple PHP library to read [docker secrets](https://docs.docker.com/engine/swarm/secrets/) from a Swarm cluster.

# Installation

```bash
 composer require sadok-f/docker-secrets
```

# Usage

### Read All

```php
$dockerSecretes = new DockerSecrets\Reader\SecretsReader();
$dockerSecretes->readAll();
```
return:
```
Array
(
    [my_secret_data_1] => testSecretDataContent1
    [my_secret_data_2] => testSecretDataContent2
)
```

### Read a single secret

```php
$dockerSecretes = new DockerSecrets\Reader\SecretsReader();
$dockerSecretes->read('my_secret');
```

### Custom Location
The default location for secrets folder is to `/run/secrets/` in Linux containers.
if you're using Docker 17.06 and higher with custom location you can use the library like this example:

```php
$dockerSecretes = new DockerSecrets\Reader\SecretsReader('/var/myCustomLocation');
$dockerSecretes->read('my_secret');
```

### Read secrets in Windows containers

```php
$dockerSecretes = new DockerSecrets\Reader\SecretsReader('C:\ProgramData\Docker\secrets');
$dockerSecretes->read('my_secret');
```

# PHPUnit

```bash
./vendor/bin/phpunit
```