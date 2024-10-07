<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_cmd',
        'montant_total',
        'client_id',
        'vendeur_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendeur_id');
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function lignescommandes(): HasMany {

        return $this->hasMany(LigneCommande::class, "cmd_id");

    }

    protected function casts(): array
    {
        return [
            'date_cmd' => 'datetime',
        ];
    }

}
