<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PublicacionesCyt
 * 
 * @property int $id_publicacion
 * @property string $descripcion
 * @property string|null $comentario_archivo
 * @property int $medicion
 * 
 * @property Collection|DocsPublicacionesCyt[] $docs_publicaciones_cyts
 *
 * @package App\Models
 */
class PublicacionesCyt extends Model
{
	protected $table = 'publicaciones_cyt';
	protected $primaryKey = 'id_publicacion';
	public $timestamps = false;

	protected $casts = [
		'medicion' => 'int'
	];

	protected $fillable = [
		'descripcion',
		'comentario_archivo',
		'medicion'
	];

	public function docs_publicaciones_cyts()
	{
		return $this->hasMany(DocsPublicacionesCyt::class, 'id_tipo');
	}
}
