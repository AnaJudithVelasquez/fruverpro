<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('compras', function (Blueprint $table) {
        $table->id();
        $table->date('fecha');
        $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
        $table->string('proveedor');
        $table->integer('cantidad');
        $table->decimal('costo_unitario', 10, 2);
        $table->decimal('costo_total', 10, 2);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
