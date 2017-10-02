<a href="https://travis-ci.org/sadok-f/docker-secrets"><img alt="Build Status" src="https://travis-ci.org/sadok-f/docker-secrets.svg?branch=master"></a>
<a href="https://codeclimate.com/github/sadok-f/docker-secrets><img alt="Code Climate" src="https://codeclimate.com/github/sadok-f/docker-secrets/badges/gpa.svg"></a>
# Docker Secrets

A simple PHP library to read [docker secrets](https://docs.docker.com/engine/swarm/secrets/) from a Swarm cluster

# Usage

### Read All

```php
$dockerSecretes = new DockerSecrets\Reader\SecretsReader();
$dockerSecretes->readAll();
```

### Read a single secret

```php
$dockerSecretes = new DockerSecrets\Reader\SecretsReader();
$dockerSecretes->read('my_secret');
```


# PHPUnit

```bash
./vendor/bin/phpunit
```