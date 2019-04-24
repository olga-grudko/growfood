<?php
/**
 * Created by PhpStorm.
 * User: olga
 * Date: 24.04.19
 * Time: 17:18
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tarif
 * @package App\Models
 * @property string name
 * @property int price
 */
class Tarif extends Model
{
    /**
     * @var string
     */
    protected $table = 'tarifs';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'price'];

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return array
     */
    public static function getTarifsNames() : array
    {
        return Tarif::query()->select('id', 'name')
            ->get()
            ->toArray();
    }
}