<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'libelle',
        'prix_unitaire',
        'qte_stock',
        'marque',
        'categorie_id',
    ];

    public function lignescomandes(): HasMany {

        return $this->hasMany(LigneCommande::class);

    }

    public function lignesapprovisionements(): HasMany {

        return $this->hasMany(LigneApprovisionement::class);

    }

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }
}
