<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Puntaje
 * 
 * @property int $id_puntaje
 * @property int $puntaje_min
 * @property int $puntaje_max
 * @property string|null $categoria
 * 
 * @property Collection|Investigadore[] $investigadores
 *
 * @package App\Models
 */
class Puntaje extends Model
{
	protected $table = 'puntajes';
	protected $primaryKey = 'id_puntaje';
	public $timestamps = false;

	protected $casts = [
		'puntaje_min' => 'int',
		'puntaje_max' => 'int'
	];

	protected $fillable = [
		'puntaje_min',
		'puntaje_max',
		'categoria'
	];

	public function investigadores()
	{
		return $this->hasMany(Investigador::class, 'id_categoria');
	}
}
