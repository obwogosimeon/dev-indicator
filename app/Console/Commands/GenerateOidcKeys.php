<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateOidcKeys extends Command
{
    protected $signature = 'oidc:keys {--force : Replace an existing OIDC key pair}';
    protected $description = 'Generate an RSA signing key pair for the OIDC provider';

    public function handle()
    {
        $privatePath = config('oidc.private_key');
        $publicPath = config('oidc.public_key');
        if ((file_exists($privatePath) || file_exists($publicPath)) && !$this->option('force')) {
            $this->error('An OIDC key already exists. Use --force only when you intend to rotate it.');
            return 1;
        }

        $directory = dirname($privatePath);
        if (!is_dir($directory) && !mkdir($directory, 0700, true) && !is_dir($directory)) {
            $this->error('Unable to create the OIDC key directory.');
            return 1;
        }
        $publicDirectory = dirname($publicPath);
        if (!is_dir($publicDirectory) && !mkdir($publicDirectory, 0755, true) && !is_dir($publicDirectory)) {
            $this->error('Unable to create the OIDC public key directory.');
            return 1;
        }

        $key = openssl_pkey_new(['private_key_type' => OPENSSL_KEYTYPE_RSA, 'private_key_bits' => 2048]);
        if (!$key || !openssl_pkey_export($key, $privatePem)) {
            $this->error('Unable to generate an RSA private key.');
            return 1;
        }
        $details = openssl_pkey_get_details($key);
        if (!$details || !file_put_contents($privatePath, $privatePem) || !file_put_contents($publicPath, $details['key'])) {
            @unlink($privatePath);
            $this->error('Unable to write the OIDC key pair.');
            return 1;
        }
        chmod($privatePath, 0600);
        chmod($publicPath, 0644);
        $this->info('OIDC RSA key pair created. Keep the private key file secret and backed up.');
        return 0;
    }
}
