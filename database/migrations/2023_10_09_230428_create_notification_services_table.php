<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notification_services', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('client_id')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('worker_id')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('service_id')->constrained();
            $table->boolean('read')->default(false);
            $table->string('for'); //Para saber se é para o cliente ou para o trabalhador
            $table->string('message'); //Mensagem da notificação
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_services');
    }
};
