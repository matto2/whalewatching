<?php

	namespace App\Http\Requests\Admin\User\Address;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class UserAdminAddressEditRequest extends FormRequest {

		public function rules() {
			return [
				'addressName'            => 'required|string|unique:user_address,name,' . $this->segment(5),
				'addressDefaultBilling'  => 'in:0,1',
				'addressDefaultShipping' => 'in:0,1',
				'addressCompanyName'     => 'string',
				'addressFirstName'       => 'required|string',
				'addressLastName'        => 'required|string',
				'addressStreet1'         => 'required|string',
				'addressStreet2'         => 'string',
				'addressStreet3'         => 'string',
				'addressCity'            => 'required|string',
				'addressState'           => 'required|string',
				'addressPostalCode'      => 'required|string',
				'addressCountry'         => 'required|string',
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