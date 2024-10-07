<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LigneCommande extends Model
{
    use HasFactory;

    protected $fillable = [
        'qte_ligne',
        'montant',
        'prod_id',
        'cmd_id',
    ];

    protected $table = 'lignes_commandes';


    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class,'cmd_id');
    }

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class,'prod_id');
    }
}
