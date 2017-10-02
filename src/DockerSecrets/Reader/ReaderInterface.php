<?php

namespace DockerSecrets\Reader;

interface ReaderInterface
{
    public function readAll();

    public function read($secretName);
}
