<a href="https://travis-ci.org/sadok-f/docker-secrets"><img alt="Build Status" src="https://travis-ci.org/sadok-f/docker-secrets.svg?branch=master"></a>

# Docker Secrets

A simple PHP library to read [docker secrets](https://docs.docker.com/engine/swarm/secrets/) from a Swarm cluster

# Usage

### Read All

```php
$dockerSecretesReader = new DockerSecrets\Reader\DockerSecretesReader();
$dockerSecretesReader->readAll();
```

### Read a single secret

```php
$dockerSecretesReader = new DockerSecrets\Reader\DockerSecretesReader();
$dockerSecretesReader->read('my_secret');
```


