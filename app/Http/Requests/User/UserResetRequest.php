<?php

	namespace App\Http\Requests\User;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class UserResetRequest extends FormRequest {

		public function rules() {
			return [
				'step'     => 'in:1,2',
				'email'    => 'email|exists:user,email',
				'password' => 'required_if:step,2',
			];
		}

		public function messages() {
			return [
				'email.exists'         => 'There is no account associated with that e-mail address.',
				'email.email'          => 'You must enter a valid e-mail address.',
				'password.required_if' => 'You must enter a valid password.',
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