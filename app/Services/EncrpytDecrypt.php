<?php

namespace App\Services;

/**
 * Class EncryptDecrypt
 * @package App\Services
 */


class EncrpytDecrypt
{
    protected $ciphering = "AES-128-CTR";



    public function encrypt($string)
    {
        $key = env('ENCRYPT_KEY');
        $iv = env('ENCRYPT_IV');

        return openssl_encrypt(
            $string,
            $this->ciphering,
            $key,
            0,
            $iv
        );
    }

    public function decrpyt($string)
    {
        $key = env('ENCRYPT_KEY');
        $iv = env('ENCRYPT_IV');

        return openssl_decrypt(
            $string,
            $this->ciphering,
            $key,
            0,
            $iv
        );
    }
}
