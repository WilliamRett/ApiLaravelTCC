<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'corporate_name',
        'fantasy_name',
        'cnpj',
        'road',
        'state',
        'cep',
        'number',
        'complement',
        'business_segment',
        'user_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'foreign_key');
    }
}
