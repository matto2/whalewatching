<?php

	namespace App\Http\Requests\Admin\User;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class UserAdminPasswordRequest extends FormRequest {

		public function rules() {
			return [
				'action'          => 'required|string|in:expire,history.clear,reset,set',
				'password'        => 'string|min:' . setting( 'userPasswordLengthMin' ) . '|max:' . setting( 'userPasswordLengthMax' ),
				'change_password' => 'numeric|in:0,1',
			];
		}

		public function messages() {
			return [
				'action.in'    => 'The specified action is invalid.',
				'password.min' => 'Passwords must be at least ' . setting( 'userPasswordLengthMin' ) . ' characters long.',
				'password.max' => 'Passwords cannot be longer than ' . setting( 'userPasswordLengthMax' ) . ' characters.',
			];
		}

		public function authorize() {
			return true;
		}

		public function response( array $errors ) {
			return new JsonResponse([ 'success' => 'false', 'message' => 'Please correct the errors listed below.', 'errors' => $errors ]);
		}

	}

?>