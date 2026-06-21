<?php
// database/migrations/xxxx_add_nonmember_prices_to_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('margin_nonmember_dus',  8, 2)->default(0)->after('harga_jual_pcs');
            $table->string('margin_nonmember_dus_type', 10)->default('percent')->after('margin_nonmember_dus');
            $table->decimal('margin_nonmember_pcs',  8, 2)->default(0)->after('margin_nonmember_dus_type');
            $table->string('margin_nonmember_pcs_type', 10)->default('percent')->after('margin_nonmember_pcs');
            $table->bigInteger('harga_nonmember_dus')->default(0)->after('margin_nonmember_pcs_type');
            $table->bigInteger('harga_nonmember_pcs')->default(0)->after('harga_nonmember_dus');
        });
    }
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'margin_nonmember_dus','margin_nonmember_dus_type',
                'margin_nonmember_pcs','margin_nonmember_pcs_type',
                'harga_nonmember_dus','harga_nonmember_pcs',
            ]);
        });
    }
};
