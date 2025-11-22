<?php

	namespace App\Http\Requests\Admin\Blog;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class BlogCategoryAdminViewRequest extends FormRequest {

		public function rules() {
			return [
				'name'    => 'required|string',
				'slug'    => 'required|string',
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