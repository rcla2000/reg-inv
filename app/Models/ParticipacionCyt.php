<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ParticipacionCyt
 * 
 * @property int $id_concepto
 * @property string $descripcion
 * @property string|null $comentario_archivo
 * @property int|null $padre
 * @property int $medicion
 * 
 * @property ParticipacionCyt|null $participacion_cyt
 * @property Collection|DocsParticipacionCyt[] $docs_participacion_cyts
 * @property Collection|ParticipacionCyt[] $participacion_cyts
 *
 * @package App\Models
 */
class ParticipacionCyt extends Model
{
	protected $table = 'participacion_cyt';
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

	public function participacion_cyt()
	{
		return $this->belongsTo(ParticipacionCyt::class, 'padre');
	}

	public function docs_participacion_cyts()
	{
		return $this->hasMany(DocsParticipacionCyt::class, 'id_tipo');
	}

	public function participacion_cyts()
	{
		return $this->hasMany(ParticipacionCyt::class, 'padre');
	}
}
