<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;

    public $table = 'document_types';

    public $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function crmDocuments()
    {
        return $this->hasMany(CrmDocument::class, 'document_type_id', 'id');
    }

}
