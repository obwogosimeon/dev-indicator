<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOidcAuthorizationTables extends Migration
{
    public function up()
    {
        Schema::create('oidc_authorization_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code_hash', 64)->unique();
            $table->unsignedInteger('user_id')->index();
            $table->string('client_id');
            $table->string('redirect_uri', 2048);
            $table->string('scope', 255);
            $table->string('nonce', 255)->nullable();
            $table->string('state', 512)->nullable();
            $table->timestamp('expires_at')->index();
            $table->timestamp('consumed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('oidc_access_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->char('token_hash', 64)->unique();
            $table->unsignedInteger('user_id')->index();
            $table->string('client_id');
            $table->string('scope', 255);
            $table->timestamp('expires_at')->index();
            $table->timestamp('revoked_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('oidc_access_tokens');
        Schema::dropIfExists('oidc_authorization_codes');
    }
}
