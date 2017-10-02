<?php

namespace Tests\DockerSecrets\Reader;


use DockerSecrets\Reader\DockerSecretesReader;

class DockerSecretesReaderTest extends \PHPUnit_Framework_TestCase
{

    /** @var  DockerSecretesReader */
    protected $dockerSecretInstance;

    protected function setUp()
    {
        $this->dockerSecretInstance = $this->getMock('DockerSecrets\Reader\DockerSecretesReader', ['getSecretsDir']);
        $this->dockerSecretInstance->expects($this->any())
            ->method('getSecretsDir')
            ->willReturn(__DIR__.'/../../test-secrets-dir');
    }


    public function testReadAll()
    {

        $allSecrets = $this->dockerSecretInstance->readAll();
        $this->assertNotEmpty($allSecrets);
    }

    public function testOneSecret()
    {
        $myTestSecret = $this->dockerSecretInstance->read('my_secret_data');
        $this->assertNotEmpty($myTestSecret);
    }
}
