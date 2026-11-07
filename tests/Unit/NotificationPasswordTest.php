<?php

namespace Tests\Unit;

use App\Notification;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class NotificationPasswordTest extends TestCase
{
    public function test_password_is_encrypted_before_persistence_and_decrypted_when_read()
    {
        $notification = new Notification();
        $notification->password = 'smtp-secret';

        $storedPassword = $notification->getAttributes()['password'];

        $this->assertNotSame('smtp-secret', $storedPassword);
        $this->assertSame('smtp-secret', Crypt::decrypt($storedPassword));
        $this->assertSame('smtp-secret', $notification->password);
    }

    public function test_plaintext_passwords_remain_readable_during_migration()
    {
        $notification = new Notification();
        $notification->setRawAttributes(['password' => 'legacy-smtp-secret']);

        $this->assertSame('legacy-smtp-secret', $notification->password);
    }

    public function test_null_password_remains_null()
    {
        $notification = new Notification();
        $notification->password = null;

        $this->assertNull($notification->getAttributes()['password']);
    }
}
