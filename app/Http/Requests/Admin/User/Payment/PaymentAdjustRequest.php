<?php

	namespace App\Http\Requests\Admin\User\Payment;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class PaymentAdjustRequest extends FormRequest {

		public function rules() {
			return [
				'action' => 'required|alpha|in:charge,credit,set',
				'value'  => 'required|numeric',
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