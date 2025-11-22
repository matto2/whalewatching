<?php

	namespace App\Http\Requests\User;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class UserActivateRequest extends FormRequest {

		public function rules() {
			return [
				'email'    => 'email|exists:user,email',
				'password' => 'string|min:' . setting( 'userPasswordLengthMin' ) . '|max:' . setting( 'userPasswordLengthMax' ),
			];
		}

		public function messages() {
			return [
				'email.email'  => 'Please enter a valid e-mail address.',
				'email.exists' => 'There was no account found with that e-mail address that has not been activated.',
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