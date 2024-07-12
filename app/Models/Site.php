<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Site extends Model
{
    use HasFactory;
    protected $table = 'site';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Ambil semua kolom kecuali id_penilaian
        $columns = Schema::getColumnListing($this->table);
        $this->fillable = array_diff($columns, [$this->primaryKey]);
    }

    public function getBase64ImageAttribute()
    {
        return 'data:image/jpeg;base64,' . base64_encode($this->attributes['logo']);
    }
}
