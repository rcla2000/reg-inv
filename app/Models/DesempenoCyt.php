<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DesempenoCyt
 * 
 * @property int $id_concepto
 * @property string $descripcion
 * @property string|null $comentario_archivo
 * @property int|null $padre
 * @property int $medicion
 * 
 * @property DesempenoCyt|null $desempeno_cyt
 * @property Collection|DesempenoCyt[] $desempeno_cyts
 * @property Collection|DocsDesempenoCyt[] $docs_desempeno_cyts
 *
 * @package App\Models
 */
class DesempenoCyt extends Model
{
	protected $table = 'desempeno_cyt';
	protected $primaryKey = 'id_concepto';
	public $timestamps = false;

	protected $casts = [
		'padre' => 'int',
		'medicion' => 'int'
	];

	protected $fillable = [
		'descripcion',
		'comentario_archivo',
		'padre',
		'medicion'
	];

	public function desempeno_cyt()
	{
		return $this->belongsTo(DesempenoCyt::class, 'padre');
	}

	public function desempeno_cyts()
	{
		return $this->hasMany(DesempenoCyt::class, 'padre');
	}

	public function docs_desempeno_cyts()
	{
		return $this->hasMany(DocsDesempenoCyt::class, 'id_tipo');
	}
}
