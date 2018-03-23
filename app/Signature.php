<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Signature
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $body
 * @property string|null $flagged_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Signature whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Signature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Signature whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Signature whereFlaggedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Signature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Signature whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Signature whereUpdatedAt($value)
 */
class Signature extends Model
{
	/**
	 * Field to be mass-assigned.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'body', 'flagged_at'];

	/**
	 * Ignore flagged signatures.
	 *
	 * @param $query
	 * @return mixed
	 */
	public function scopeIgnoreFlagged($query)
	{
		return $query->where('flagged_at', null);
	}

	/**
	 * Flag the given signature.
	 *
	 * @return bool
	 */
	public function flag()
	{
		return $this->update(['flagged_at' => \Carbon\Carbon::now()]);
	}

	public function unflag()
	{
		return $this->update(['flagged_at' => null]);
	}

	/**
	 * Get the user Gravatar by their email address.
	 *
	 * @return string
	 */
	public function getAvatarAttribute()
	{
		return sprintf('https://www.gravatar.com/avatar/%s?s=100', md5($this->email));
	}

}
