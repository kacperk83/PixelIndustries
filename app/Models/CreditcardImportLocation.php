<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImportLocation
 *
 * @package App\Models
 *
 * @author  Kacper Kowalski kacperk83@gmail.com
 */
class CreditcardImportLocation extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
            return $this->belongsTo(Creditcard::class);
    }
}