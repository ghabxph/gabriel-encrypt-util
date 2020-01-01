<?php namespace Gabriel\EncryptUtil;

/**
 * EncryptUtil Class
 *   - This class is responsible for ...
 *
 * @author  Gabriel Lucernas Pascual <me@ghabxph.info>
 * @version 0.0.1
 */
class EncryptUtil
{
    /**
     * Performs encryption
     *
     * @param String $data       Data to encrypt
     * @param String $password   Password used for encrypting the data
     * @param String $salt       Salt of $password for PBKDF2
     * @return Cipher
     * @throws \Exception
     */
    public static function e($data, $password, $salt)
    {
        $method = 'aes-256-cbc';
        $options = OPENSSL_RAW_DATA;
        $password = hash_pbkdf2('sha256', $password, $salt, 100000, 32, true);
        $iv = random_bytes(openssl_cipher_iv_length($method));
        return new Cipher(openssl_encrypt($data, $method, $password, $options, $iv), $iv, $salt);
    }

    /**s
     * Performs decryption
     *
     * @param String $data      Data to decrypt (with IV)
     * @param String $password  Password used for decrypting the data
     * @return string
     */
    public static function d($data, $password)
    {
        $cipher = new Cipher($data);
        list ($data, $iv, $salt) = [
            $cipher->cipher(),
            $cipher->iv(),
            $cipher->salt()
        ];
        $method = 'aes-256-cbc';
        $options = OPENSSL_RAW_DATA;
        $password = hash_pbkdf2('sha256', $password, $salt, 100000, 32, true);
        return openssl_decrypt($data, $method, $password, $options, $iv);
    }
}
