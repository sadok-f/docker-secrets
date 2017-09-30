# Docker Secrets

A simple PHP library to read [docker secrets](https://docs.docker.com/engine/swarm/secrets/) from a Swarm cluster

# Usage

### Read All

```php
$dockerSecretesReader = new DockerSecretesReader();
$dockerSecretesReader->readAll();
```

### Read a single secret

```php
$dockerSecretesReader = new DockerSecretesReader();
$dockerSecretesReader->read('my_secret');
```


