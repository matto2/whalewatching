<?php

	namespace App\Http\Requests\User;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class UserSignupRequest extends FormRequest {

		public function rules() {
			return [
				'firstName' => 'required|string',
				'lastName'  => 'required|string',
				'email'     => 'required|email',
				'password'  => 'string|min:' . setting( 'userPasswordLengthMin' ) . '|max:' . setting( 'userPasswordLengthMax' ),
			];
		}

		public function messages() {
			return [
				'email.unique' => 'This email address is already in use.',
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