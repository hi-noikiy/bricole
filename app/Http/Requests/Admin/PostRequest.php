<?php
/**
 * LaraClassified - Geo Classified Ads CMS
 * Copyright (c) BedigitCom. All Rights Reserved
 *
 * Website: http://www.bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from Codecanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
 */

namespace App\Http\Requests\Admin;

class PostRequest extends Request
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'category_id'  => 'required|not_in:0',
			'post_type_id' => 'required|not_in:0',
			'title'        => 'required|mb_between:2,200',
			'description'  => 'required|mb_between:5,3000',
			'contact_name' => 'required|mb_between:2,200',
			'email'        => 'required|email|max:100',
		];
		
		// Tags (Only allow letters, numbers, spaces and ',' and ';' symbols)
		if ($this->filled('tags')) {
			$rules['tags'] = 'regex:/^[a-z0-9 ,;\-]+$/i';
		}
		
		return $rules;
	}
}
