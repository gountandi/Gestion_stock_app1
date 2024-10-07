<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Approvisionement extends Model
{
    use HasFactory;

    protected $fillable = [
        'prix_achat_unitaire',
        'gerant_id',
        "fournisseur_id",
        "date_livraison",

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'gerant_id');
    }

    public function fournisseur(): BelongsTo
    {
        return $this->belongsTo(Fournisseur::class,"fournisseur_id");
    }

    public function lignesapprovisionements(): HasMany {

        return $this->hasMany(LigneApprovisionement::class);

    }

    protected function casts(): array
    {
        return [
            'date_livraison' => 'datetime',
        ];
    }
}
