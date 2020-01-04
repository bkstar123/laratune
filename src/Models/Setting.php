<?php
/**
 * Setting model
 *
 * @author: tuanha
 * @last-mod: 04-Jan-2020
 */
namespace Bkstar123\LaraTune\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	/**
	 * @var bool
	 */
	public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'settings';

    /**
     * @var array
     */
    protected $fillable = ['key', 'value'];
}
