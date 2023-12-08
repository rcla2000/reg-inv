<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstadosInvestigador
 * 
 * @property int $id_estado
 * @property string $nombre
 * 
 * @property Collection|Investigadore[] $investigadores
 *
 * @package App\Models
 */
class EstadosInvestigador extends Model
{
	protected $table = 'estados_investigadores';
	protected $primaryKey = 'id_estado';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

	public function investigadores()
	{
		return $this->hasMany(Investigador::class, 'id_estado');
	}
}
