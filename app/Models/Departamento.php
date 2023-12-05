<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Departamento
 * 
 * @property int $id_departamento
 * @property string $nombre
 * 
 * @property Collection|Investigadore[] $investigadores
 * @property Collection|Municipio[] $municipios
 *
 * @package App\Models
 */
class Departamento extends Model
{
	protected $table = 'departamentos';
	protected $primaryKey = 'id_departamento';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

	public function investigadores()
	{
		return $this->hasMany(Investigador::class, 'id_departamento');
	}

	public function municipios()
	{
		return $this->hasMany(Municipio::class, 'id_departamento');
	}
}
