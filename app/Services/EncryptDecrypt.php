<?php

namespace App\Services;

class EncrpytDecrypt
{
    protected $ciphering = "AES-128-CTR";

    protected $encryption_key = "YardimYeriEncrypted";

    protected $iv = "5749278910190532";

    public function encrypt($string)
    {
        return openssl_encrypt(
            $string,
            $this->ciphering,
            $this->encryption_key,
            0,
            $this->iv
        );
    }

    public function decrpyt($string)
    {
        return openssl_decrypt(
            $string,
            $this->ciphering,
            $this->encryption_key,
            0,
            $this->iv
        );
    }
}