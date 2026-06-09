<?php
// File: database/migrations/xxxx_create_debts_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('sale_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);        // total utang awal
            $table->decimal('paid', 15, 2)->default(0); // sudah dibayar
            $table->decimal('remaining', 15, 2);     // sisa
            $table->text('note')->nullable();
            $table->enum('status', ['unpaid','partial','paid'])->default('unpaid');
            $table->timestamp('due_date')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('debts'); }
};
