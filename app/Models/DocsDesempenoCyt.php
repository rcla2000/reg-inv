<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DocsDesempenoCyt
 * 
 * @property int $id_documento
 * @property int $id_tipo
 * @property string $archivo
 * @property int $id_investigador
 * 
 * @property DesempenoCyt $desempeno_cyt
 * @property Investigadore $investigadore
 *
 * @package App\Models
 */
class DocsDesempenoCyt extends Model
{
	protected $table = 'docs_desempeno_cyt';
	protected $primaryKey = 'id_documento';
	public $timestamps = false;

	protected $casts = [
		'id_tipo' => 'int',
		'id_investigador' => 'int'
	];

	protected $fillable = [
		'id_tipo',
		'archivo',
		'id_investigador'
	];

	public function tipo()
	{
		return $this->belongsTo(DesempenoCyt::class, 'id_tipo');
	}

	public function investigadore()
	{
		return $this->belongsTo(Investigador::class, 'id_investigador');
	}
}
