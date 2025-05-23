<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class My_Parent extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasTranslations;
    public $translatable = ['Name_Father', 'Job_Father', 'Name_Mother', 'Job_Mother'];
    protected $table = 'my__parents';
    protected $guarded = [];
}
