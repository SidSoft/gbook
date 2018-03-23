<?php

namespace App\Http\Controllers\Api;

use App\Signature;
use App\Http\Controllers\Controller;

class ReportSignature extends Controller
{
	/**
	 * Flag the given signature.
	 *
	 * @param Signature $signature
	 * @return Signature
	 */
	public function update(Signature $signature)
	{
		if ($signature->flagged_at === null) {
			$signature->flag();
		} else {
			$signature->unflag();
		}

		return $signature;
	}
}
