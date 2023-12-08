<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TiposUsuario
 * 
 * @property int $id_tipo
 * @property string $nombre
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class TiposUsuario extends Model
{
	protected $table = 'tipos_usuarios';
	protected $primaryKey = 'id_tipo';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

	public function users()
	{
		return $this->hasMany(User::class, 'user_type');
	}
}
