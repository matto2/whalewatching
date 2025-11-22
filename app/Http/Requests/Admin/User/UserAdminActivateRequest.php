<?php

	namespace App\Http\Requests\Admin\User;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class UserAdminActivateRequest extends FormRequest {

		public function rules() {
			return [
				'action'          => 'required|alpha|in:activate,deactivate,resend',
			];
		}

		public function messages() {
			return [
				'action.in' => 'The specified action is invalid.',
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