<?php

	namespace App\Http\Requests\Admin\Blog;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class BlogEntryAdminAddRequest extends FormRequest {

		public function rules() {
			return [
				'name'           => 'required|string',
				'slug'           => 'required|string|unique:blog_entry,slug',
				'content'        => 'required|string',
				'active'         => 'in:0,1',
				'hidden'         => 'in:0,1',
				'restricted'     => 'in:0,1',
				'allow_comments' => 'in:0,1',
				'categories'     => 'nullable|array',
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
