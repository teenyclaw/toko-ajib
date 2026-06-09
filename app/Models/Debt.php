<?php
// app/Models/Debt.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = [
        'customer_id','sale_id','amount','paid','remaining','note','status','due_date'
    ];

    protected $casts = ['due_date' => 'datetime'];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function sale()     { return $this->belongsTo(Sale::class); }

    // Auto-set status
    public function recalcStatus(): void
    {
        if ($this->remaining <= 0)          $this->status = 'paid';
        elseif ($this->paid > 0)            $this->status = 'partial';
        else                                $this->status = 'unpaid';
        $this->save();
    }
}
