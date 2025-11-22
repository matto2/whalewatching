<?php

	namespace App\Http\Requests\Admin\User;

	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Http\JsonResponse;

	class UserAdminSettingsRequest extends FormRequest {

		public function rules() {
			return [
				'userEmailSenderName'                   => 'required|string',
				'userEmailSenderAddress'                => 'required|email',
				'userEmailAdminSenderName'              => 'required|string',
				'userEmailAdminSenderAddress'           => 'required|email',

				'userSignupEnable'                      => 'in:0,1',
				'userEmailWelcomeEnable'                => 'in:0,1',
				'userEmailWelcomeSubject'               => 'required_if:userEmailWelcomeEnable,1|string',
				'userEmailWelcomeAdminEnable'           => 'in:0,1',
				'userEmailWelcomeAdminSubject'          => 'required_if:userEmailWelcomeEnable,1|string',
				'userEmailAdminNotifyEnable'            => 'in:0,1',
				'userEmailAdminNotifyInterval'          => 'in:immediate,daily,weekly',
				'userEmailAdminNotifyRecipient'         => 'required_if:userEmailAdminNotifyEnable,1|string',
				'userEmailAdminNotifyRecipientCC'       => 'string|nullable',
				'userEmailAdminNotifyRecipientBCC'      => 'string|nullable',
				'userEmailAdminNotifySubject'           => 'required_if:userEmailAdminNotifyEnable,1|string',

				'userActivateEnable'                    => 'in:0,1',
				'userActivateEmailSubject'              => 'required_if:userActivateEnable,1|string',
				'userActivateEmailAdminSubject'         => 'required_if:userActivateEnable,1|string',
				'userActivateEmailCompleteSubject'      => 'required_if:userActivateEnable,1|string',

				'userLockoutEnable'                     => 'in:0,1',
				'userLockoutAttempts'                   => 'required_if:userLockutEnable,1|numeric|min:0',
				'userLockoutWindow'                     => 'required_if:userLockutEnable,1|numeric|min:0',
				'userLockoutDuration'                   => 'required_if:userLockutEnable,1|numeric|min:0',

				'userSingleLogin'                       => 'in:0,1',

				'userPasswordNoExpireEnable'            => 'in:0,1',
				'userPasswordLengthMin'                 => 'required|numeric|min:1',
				'userPasswordLengthMax'                 => 'required|numeric|min:0|max:255',
				'userPasswordAgeMin'                    => 'required|numeric|min:0',
				'userPasswordAgeMax'                    => 'required|numeric|min:0',
				'userPasswordRemember'                  => 'required|numeric|min:0',
				'userPasswordChangedEmailEnable'        => 'in:0,1',
				'userPasswordChangedEmailSubject'       => 'required|string',
				'userPasswordChangedEmailAdminEnable'   => 'in:0,1',
				'userPasswordChangedEmailAdminSubject'  => 'required|string',

				'userPasswordResetEmailSubject'         => 'required|string',
				'userPasswordResetEmailAdminSubject'    => 'required|string',

				'userEmailChangedEmailEnable'           => 'in:0,1',
				'userEmailChangedEmailSubject'          => 'required_if:userEmailChangedEmailEnable,1|string',
				'userEmailChangedEmailAdminEnable'      => 'in:0,1',
				'userEmailChangedEmailAdminSubject'     => 'required_if:userEmailChangedEmailEnable,1|string',

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