<?php

	namespace App\Http\Requests\User;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class UserLoginRequest extends FormRequest {

		public function rules() {
			return [
				'email'    => 'required|email',
				'password' => 'required|string',
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