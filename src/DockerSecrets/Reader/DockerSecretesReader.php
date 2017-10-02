<?php

namespace DockerSecrets\Reader;

/**
 * Class DockerSecretesReader
 * @package DockerSecrets\Reader
 */
class DockerSecretesReader
{
    const SECRETS_DIR = '/run/secrets';

    /**
     * @param $file
     *
     * @return string
     * @throws Exception
     */
    private function getFileContent($file)
    {
        if (empty($file)) {
            throw new \Exception('File name empty');
        }

        if (!file_exists($file)) {
            throw new \Exception('File do not exist: '.$file);
        }

        return \file_get_contents($file);
    }

    /**
     * @return array
     */
    final public function readAll()
    {
        $secretFiles = array_diff(scandir($this->getSecretsDir()), ['..', '.']);
        $allSecrets = [];
        foreach ($secretFiles as $secretFile) {
            $allSecrets[$secretFile] = $this->getFileContent($secretPath = $this->getSecretsDir().'/'.$secretFile);
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

        return $this->getFileContent($secretPath);
    }

    /**
     * @return string
     */
    public function getSecretsDir()
    {
        return self::SECRETS_DIR;
    }
}
