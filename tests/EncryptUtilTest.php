<?php

use Gabriel\EncryptUtil\Cipher;
use PHPUnit\Framework\TestCase;
use Gabriel\EncryptUtil\EncryptUtil;

/**
 * EncryptUtilTest Class
 *   - This class is responsible for ...
 *
 * @author  Gabriel Lucernas Pascual <me@ghabxph.info>
 * @version 0.0.1
 */
final class EncryptUtilTest extends TestCase
{

    /**
     * Tests EncryptUtil::e()
     *
     * @dataProvider dataProviderTestE
     * @param String $data       Plaintext data to encrypt
     * @param String $password   Password
     * @param String $salt       Salt for password
     * @throws Exception
     * @return Cipher
     */
    public function testE(String $data, String $password, String $salt)
    {
        $cipher = EncryptUtil::e($data, $password, $salt);
        self::assertInstanceOf(Cipher::class, $cipher);
        self::assertFalse(openssl_error_string());
        return $cipher;
    }

    /**
     * Tests EncryptUtil::d()
     *
     * @dataProvider dataProviderTestE
     * @param String $data       Plaintext data to encrypt
     * @param String $password   Password
     * @param String $salt       Salt for password
     * @throws Exception
     */
    public function testD(String $data, String $password, String $salt)
    {
        $cipher = $this->testE($data, $password, $salt);
        self::assertEquals($data, EncryptUtil::d($cipher->rawString(), $password));
    }

    /**
     * Data provider for testE() unit test
     * @return array
     * @throws Exception
     */
    public function dataProviderTestE()
    {
        return [
            ['Some nice data', 'Some nice password', random_bytes(32)],
        ];
    }
}
