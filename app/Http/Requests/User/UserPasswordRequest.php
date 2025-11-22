<?php

	namespace App\Http\Requests\User;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class UserPasswordRequest extends FormRequest {

		public function rules() {
			return [
				'password'    => 'required',
				'newPassword' => 'required|different:password',
				'newPassword' => 'required|different:password,string|min:' . setting( 'userPasswordLengthMin' ) . '|max:' . setting( 'userPasswordLengthMax' ),
			];
		}

		public function messages() {
			return [
				'newPassword.different' => 'Your new password must be different than your current password.',
				'newPassword.min'       => 'Your new password must be at least ' . setting( 'userPasswordLengthMin' ) . ' characters long.',
				'newPassword.max'       => 'Your new password cannot be longer than ' . setting( 'userPasswordLengthMax' ) . ' characters.',
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