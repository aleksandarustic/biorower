<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class UserEditPostRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
				'first_name' 	=> 'required|min:2|max:255',
				'last_name' 	=> 'required|min:2|max:255',
				'email' 		=> 'required|email|max:255|unique:users,email,'.Auth::id(),
				'display_name' 	=> 'required|min:4|max:120|unique:users,display_name,'.Auth::id(),
				'month'			=> 'date_format:m',
				'day'			=> 'date_format:d',
				'year'			=> 'date_format:Y',
		];
	}

}
