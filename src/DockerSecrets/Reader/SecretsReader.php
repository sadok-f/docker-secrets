<?php

namespace DockerSecrets\Reader;

use DockerSecrets\Exception\SecretDirNotExistException;
use DockerSecrets\Exception\SecretFileNotFoundException;

/**
 * Class SecretsReader
 * @package DockerSecrets\Reader
 */
class SecretsReader
{
    /** @var string */
    protected $secretsDir;

    /** @var  array */
    protected $secrets;

    /**
     * SecretsReader constructor.
     *
     * @param $secretsDir
     */
    public function __construct($secretsDir = '/run/secrets')
    {
        $this->secretsDir = $secretsDir;
        $this->secrets = $this->readAll();
    }

    /**
     * @param $secretFile
     *
     * @return string
     * @throws SecretFileNotFoundException
     */
    protected function getSecretContent($secretFile)
    {
        if (!file_exists($secretFile)) {
            throw new SecretFileNotFoundException('Secret file do not exist: '.$secretFile);
        }

        return \file_get_contents($secretFile);
    }

    /**
     * @return string
     */
    protected function getSecretsDir()
    {
        return $this->secretsDir;
    }

    /**
     * @return array
     * @throws SecretDirNotExistException
     */
    final public function readAll()
    {
        $secretDir = $this->getSecretsDir();

        if (!is_dir($secretDir)) {
            throw new SecretDirNotExistException('Secret Dir not exist '.$secretDir);
        }

        $secretFiles = array_diff(scandir($secretDir), ['..', '.']);
        $allSecrets = [];
        foreach ($secretFiles as $secretFile) {
            $allSecrets[$secretFile] = $this->getSecretContent($secretDir.'/'.$secretFile);
        }

        return $allSecrets;
    }

    /**
     * @param $secretName
     *
     * @return string
     * @throws SecretFileNotFoundException
     */
    final public function read($secretName)
    {
        if (empty($this->secrets[$secretName])) {
            throw new SecretFileNotFoundException('Secret file do not exist: '.$secretName);
        }

        return $this->secrets[$secretName];
    }
}
