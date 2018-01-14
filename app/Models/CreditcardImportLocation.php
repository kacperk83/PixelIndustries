<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserImportLocation
 *
 * @property string file_path
 * @property int document_id
 *
 * @package App\Models
 *
 * @author  Kacper Kowalski kacperk83@gmail.com
 */
class CreditcardImportLocation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['file_path', 'document_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creditcard()
    {
        return $this->belongsTo(Creditcard::class);
    }
}
