<?php
// app/Models/Customer.php  — update model lama
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name','phone','address'];

    public function debts()
    {
        return $this->hasMany(Debt::class);
    }

    public function activeDebts()
    {
        return $this->hasMany(Debt::class)->whereIn('status',['unpaid','partial']);
    }

    public function getTotalDebtAttribute(): float
    {
        return (float) $this->activeDebts()->sum('remaining');
    }
}
