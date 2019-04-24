<?php
/**
 * Created by PhpStorm.
 * User: olga
 * Date: 24.04.19
 * Time: 17:21
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Users
 * @package App\Models
 * @property string name
 * @property string phone
 */
class Users extends Model
{
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'phone'];

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @param array $attributes
     * @return int
     */
    public static function create(array $attributes) : int
    {
        $movieModel = self::query()->firstOrCreate($attributes);
        $movieId = $movieModel->getAttribute('id');
        return $movieId;
    }
}