<?php

	namespace App\Http\Requests\User;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class UserSetPasswordRequest extends FormRequest {

		public function rules() {
			return [
				'password' => 'string|min:' . setting( 'userPasswordLengthMin' ) . '|max:' . setting( 'userPasswordLengthMax' ),
			];
		}

		public function messages() {
			return [
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