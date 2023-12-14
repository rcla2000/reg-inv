<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Observacion
 * 
 * @property int $id_observacion
 * @property int $id_investigador
 * @property string|null $observacion
 * 
 * @property Investigadore $investigadore
 *
 * @package App\Models
 */
class Observacion extends Model
{
	protected $table = 'observaciones';
	protected $primaryKey = 'id_observacion';
	public $timestamps = false;

	protected $casts = [
		'id_investigador' => 'int'
	];

	protected $fillable = [
		'id_investigador',
		'observacion'
	];

	public function investigadore()
	{
		return $this->belongsTo(Investigador::class, 'id_investigador', 'id_investigador');
	}
}
