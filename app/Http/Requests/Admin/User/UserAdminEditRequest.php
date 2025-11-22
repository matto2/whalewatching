<?php

	namespace App\Http\Requests\Admin\User;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class UserAdminEditRequest extends FormRequest {

		public function rules() {
			return [
				'firstName'       => 'required',
				'lastName'        => 'required',
				'email'           => 'required|email|unique:user,email,' . $this->segment(3),
				'neverExpire'     => 'boolean',
				'isAdministrator' => 'boolean',
				'hidden'          => 'numeric|in:0,1',
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