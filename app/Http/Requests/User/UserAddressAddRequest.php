<?php

	namespace App\Http\Requests\User;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class UserAddressAddRequest extends FormRequest {

		public function rules() {
			return [
				'addressName'            => 'required|string|unique:user_address,name',
				'addressDefaultBilling'  => 'in:0,1',
				'addressDefaultShipping' => 'in:0,1',
				'addressCompanyName'     => 'nullable|string',
				'addressFirstName'       => 'required|string',
				'addressLastName'        => 'required|string',
				'addressStreet1'         => 'required|string',
				'addressStreet2'         => 'nullable|string',
				'addressCity'            => 'required|string',
				'addressState'           => 'required|string',
				'addressPostalCode'      => 'required|string',
				'addressCountry'         => 'required|numeric|exists:country,id',
				'addressPhone'           => 'required|string',
			];
		}

		public function messages() {
			return [
				'addressName.unique' => 'This address name is already in use.',
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