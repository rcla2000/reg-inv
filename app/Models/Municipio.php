<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Municipio
 * 
 * @property int $id_municipio
 * @property int $id_departamento
 * @property string $nombre
 * 
 * @property Departamento $departamento
 * @property Collection|Investigadore[] $investigadores
 *
 * @package App\Models
 */
class Municipio extends Model
{
	protected $table = 'municipios';
	protected $primaryKey = 'id_municipio';
	public $timestamps = false;

	protected $casts = [
		'id_departamento' => 'int'
	];

	protected $fillable = [
		'id_departamento',
		'nombre'
	];

	public function departamento()
	{
		return $this->belongsTo(Departamento::class, 'id_departamento');
	}

	public function investigadores()
	{
		return $this->hasMany(Investigador::class, 'id_municipio');
	}
}
