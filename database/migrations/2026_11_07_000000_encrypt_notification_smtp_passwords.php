<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EncryptNotificationSmtpPasswords extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('notifications')) {
            return;
        }

        $driver = DB::connection()->getDriverName();
        if ($driver === 'mysql') {
            $this->widenMysqlPasswordColumn();
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE notifications ALTER COLUMN password TYPE TEXT');
        } elseif ($driver !== 'sqlite') {
            throw new RuntimeException('Unsupported database driver for encrypting SMTP passwords: ' . $driver);
        }

        DB::table('notifications')
            ->select('id', 'password')
            ->orderBy('id')
            ->chunk(100, function ($notifications) {
                foreach ($notifications as $notification) {
                    if ($notification->password === null || $notification->password === '') {
                        continue;
                    }

                    try {
                        Crypt::decrypt($notification->password);
                    } catch (DecryptException $exception) {
                        DB::table('notifications')
                            ->where('id', $notification->id)
                            ->update(['password' => Crypt::encrypt($notification->password)]);
                    }
                }
            });
    }

    public function down()
    {
        // Encrypted SMTP passwords remain encrypted on rollback.
    }

    private function widenMysqlPasswordColumn()
    {
        $originalSqlMode = DB::select('SELECT @@SESSION.sql_mode AS sql_mode')[0]->sql_mode;
        $modes = array_filter(explode(',', $originalSqlMode), function ($mode) {
            return !in_array($mode, [
                'STRICT_TRANS_TABLES',
                'STRICT_ALL_TABLES',
                'NO_ZERO_DATE',
                'NO_ZERO_IN_DATE',
            ], true);
        });
        $pdo = DB::connection()->getPdo();

        DB::statement('SET SESSION sql_mode = ' . $pdo->quote(implode(',', $modes)));

        try {
            DB::statement('ALTER TABLE notifications MODIFY password TEXT NULL');
        } finally {
            DB::statement('SET SESSION sql_mode = ' . $pdo->quote($originalSqlMode));
        }
    }
}
