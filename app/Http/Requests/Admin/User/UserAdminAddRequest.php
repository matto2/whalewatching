<?php

	namespace App\Http\Requests\Admin\User;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class UserAdminAddRequest extends FormRequest {

		public function rules() {
			return [
				'firstName'            => 'required',
				'lastName'             => 'required',
				'email'                => 'required|email|unique:user,email',
				'password'             => 'nullable|string|min:' . setting( 'userPasswordLengthMin' ) . '|max:' . setting( 'userPasswordLengthMax' ),
				'isAdministrator'      => 'numeric|in:0,1',
				'hidden'               => 'numeric|in:0,1',
				'sendWelcome'          => 'numeric|in:0,1',
				'changePassword'       => 'numeric|in:0,1',
				'verifyUser'           => 'numeric|in:0,1',
				'passwordNeverExpires' => 'numeric|in:0,1',
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