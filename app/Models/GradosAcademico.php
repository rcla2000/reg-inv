<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GradosAcademico
 * 
 * @property int $id_grado
 * @property string $nombre
 * @property int $medicion
 * 
 * @property Collection|DocsGradosAcademico[] $docs_grados_academicos
 *
 * @package App\Models
 */
class GradosAcademico extends Model
{
	protected $table = 'grados_academicos';
	protected $primaryKey = 'id_grado';
	public $timestamps = false;

	protected $casts = [
		'medicion' => 'int'
	];

	protected $fillable = [
		'descripcion',
		'medicion',
		'comentario_archivo'
	];

	public function docs_grados_academicos()
	{
		return $this->hasMany(DocsGradosAcademico::class, 'id_tipo');
	}
}
