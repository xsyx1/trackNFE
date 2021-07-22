<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    protected $fillable = [
        'id','contact', 'state_registration', 'contact_phone',
        'person_id', 'debit_id', 'is_enabled',
    ];


    public function getInfoAttribute()
    {
        return $this->people->nif . ' - ' . $this->people->name;
    }

    public function people()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    /**
     * Scope a query to include people information.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePerson($query)
    {
        return $query->select(
            'clients.*',
            'people.name',
            'people.nickname',
            'people.phone',
            'people.nif',
            'people.email',
            'people.address',
            'people.zip_code',
            'people.city_id',
            DB::raw("concat(cities.title, ' - ', states.letter) as city")
        )
            ->join('people', 'people.id', '=', 'clients.person_id')
            ->join('cities', 'cities.id', '=', 'people.city_id')
            ->join('states', 'states.id', '=', 'cities.state_id');
    }
}
