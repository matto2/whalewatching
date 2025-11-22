<?php

	namespace App\Http\Requests\Admin\User\Payment;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class UserPaymentCardAddRequest extends FormRequest {

		public function rules() {
			return [
				'token' => 'required|string',
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