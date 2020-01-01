<?php namespace Gabriel\EncryptUtil;

use http\Exception\InvalidArgumentException;

/**
 * Cipher Class
 *   - This class is responsible for ...
 *
 * @author  Gabriel Lucernas Pascual <me@ghabxph.info>
 * @version 0.0.1
 */
class Cipher
{

    /**
     * Raw String
     *
     * @var String
     */
    private $_rawString;

    /**
     * Cipher constructor.
     */
    public function __construct()
    {
        switch (func_num_args()) {
            case 1:
                $this->_rawString = func_get_arg(0);
                break;
            case 3:
                $this->_rawString = func_get_arg(0) . func_get_arg(1) . func_get_arg(2);
                break;
            default:
                throw new InvalidArgumentException("Number of arguments can only be 3 or 1.");
        }
    }

    /**
     * Returns the ciphertext
     *
     * @return String
     */
    public function cipher(): String
    {
        $cipher = $this->_rawString;
        $cipher = substr($cipher, 0, strlen($cipher) - 48);
        return $cipher;
    }

    /**
     * Returns the IV
     *
     * @return String
     */
    public function iv(): String
    {
        $iv = $this->_rawString;
        $iv = substr($iv, strlen($this->cipher()), 16);
        return $iv;
    }

    /**
     * @return String
     */
    public function salt(): String
    {
        $salt = $this->_rawString;
        $salt = substr($salt, strlen($salt) - 32, 32);
        return $salt;
    }

    /**
     * Returns the raw string
     *
     * @return String
     */
    public function rawString(): String
    {
        return $this->_rawString;
    }
}
