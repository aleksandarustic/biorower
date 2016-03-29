<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterUserPostRequest extends Request {

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
			/*'name' => 'required|alpha_num|max:255',*/
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		];
	}

}
