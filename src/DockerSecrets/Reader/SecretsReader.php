<?php

namespace DockerSecrets\Reader;

use DockerSecrets\Exception\SecretDirNotExistException;
use DockerSecrets\Exception\EmptyNameException;
use DockerSecrets\Exception\SecretFileNotFoundException;

/**
 * Class SecretsReader
 * @package DockerSecrets\Reader
 */
class SecretsReader implements ReaderInterface
{
    const SECRETS_DIR = '/run/secrets';

    /**
     * @param $secretFile
     *
     * @return string
     * @throws Exception
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
        return self::SECRETS_DIR;
    }

    /**
     * @return array
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
     */
    final public function read($secretName)
    {
        $secretPath = $this->getSecretsDir().'/'.$secretName;

        return $this->getSecretContent($secretPath);
    }
}
