<?php

	namespace App\Http\Requests\Admin\Blog;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class BlogSettingsAdminRequest extends FormRequest {

		public function rules() {
			return [

				'blogCommentEnable'             => 'in:0,1',
				'blogCommentLoginRequired'      => 'in:0,1',

				'blogEntryActiveDefault'        => 'in:0,1',
				'blogEntryAllowCommentsDefault' => 'in:0,1',
				'blogEntryRestrictedDefault'    => 'in:0,1',

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