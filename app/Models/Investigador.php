<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Investigador
 * 
 * @property int $id_investigador
 * @property string $dui
 * @property string $primer_nombre
 * @property string $segundo_nombre
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property int $id_departamento
 * @property int $id_municipio
 * @property string $direccion
 * @property string $telefono
 * @property string $email
 * @property int $id_estado
 * @property int|null $puntaje
 * @property int $id_categoria
 * 
 * @property Departamento $departamento
 * @property EstadosInvestigadore $estados_investigadore
 * @property Municipio $municipio
 * @property Collection|DocsDesempenoCyt[] $docs_desempeno_cyts
 * @property Collection|DocsGradosAcademico[] $docs_grados_academicos
 * @property Collection|DocsParticipacionCyt[] $docs_participacion_cyts
 * @property Collection|DocsPublicacionesCyt[] $docs_publicaciones_cyts
 * @property Collection|Observacione[] $observaciones
 *
 * @package App\Models
 */
class Investigador extends Model
{
	protected $table = 'investigadores';
	protected $primaryKey = 'id_investigador';
	public $timestamps = false;

	protected $casts = [
		'id_departamento' => 'int',
		'id_municipio' => 'int',
		'id_estado' => 'int',
		'puntaje' => 'int',
		'id_categoria' => 'int'
	];

	protected $fillable = [
		'dui',
		'primer_nombre',
		'segundo_nombre',
		'primer_apellido',
		'segundo_apellido',
		'id_departamento',
		'id_municipio',
		'direccion',
		'telefono',
		'email',
		'id_estado',
		'puntaje',
		'id_categoria'
	];

	public function puntaje()
	{
		return $this->belongsTo(Puntaje::class, 'id_categoria');
	}

	public function departamento()
	{
		return $this->belongsTo(Departamento::class, 'id_departamento');
	}

	public function estados_investigadore()
	{
		return $this->belongsTo(EstadosInvestigador::class, 'id_estado');
	}

	public function municipio()
	{
		return $this->belongsTo(Municipio::class, 'id_municipio');
	}

	public function docs_desempeno_cyts()
	{
		return $this->hasMany(DocsDesempenoCyt::class, 'id_investigador');
	}

	public function docs_grados_academicos()
	{
		return $this->hasMany(DocsGradosAcademico::class, 'id_investigador');
	}

	public function docs_participacion_cyts()
	{
		return $this->hasMany(DocsParticipacionCyt::class, 'id_investigador');
	}

	public function docs_publicaciones_cyts()
	{
		return $this->hasMany(DocsPublicacionesCyt::class, 'id_investigador');
	}

	public function observaciones()
	{
		return $this->hasMany(Observacion::class, 'id_investigador');
	}
}
