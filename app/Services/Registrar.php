<?php namespace App\Services;

use App\Http\Helper\Utility;
use App\User;
use App\Models\AbonnerInfo;
use Validator;
use Illuminate\Support\Facades\Input;
use Session;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
			'tel' => 'required|max:10',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		$user_data = [];
		$user = null;
		$role = isset($data['role'])? $data['role'] : 1;
		$user_id = Utility::generateUserID();
		switch ($role){
			case 2:  // Paid employer
			case 3: // Employer
				$user_data = [
					'id' => $user_id,
					'name' => $data['name'],
					'surname' => $data['surname'],
					'email' => $data['email'],
					'role_id' => $data['role'],
					'password' => bcrypt($data['password']),
				];
				$user = User::create($user_data);
				//EmployerInfo::create(['user_id' => $user->id, 'tel' => $data['tel'], 'post' => $data['post'], 'company' => $data['company']]);
				break;

			case 4: // Admin
				break;
			default: // abonner
				//Save the abonner Information

				$user_data = [
					'id'   => $user_id,
					'name' => $data['name'],
					'email' => $data['email'],
					'role_id' => 1,
					'password' => bcrypt($data['password']),
				];
				$user = User::create($user_data);

				/*Upload the CV of the candidate*/
				if (Input::hasFile('cv'))
				{

					$file                  = Input::file('cv'); // here is the uploaded file
					$file_extension        = $file->getClientOriginalExtension();
					$destFolderName        = 'cvrepository';             // the name of the folder you want to keep your uploaded CVs
					$objectId              = $user->id;    // here the id of the new object you just saved
					$filename              = Utility::handleCv($file, $destFolderName, $objectId, $file_extension);
					$cv_link               = 'uploads/'.$filename;
					if ($filename == 'failed') {
						Session::flash('error_message', "Your CV/Resume should be less than 2Mo");
						return;
						}
					}else{
						Session::flash('error_message', "Please select a file");
						return;
					}
				AbonnerInfo::create(['user_id' => $user->id, 'sign_up_type' => 'G',
					'tel' => '00'.$data['country_code'].$data['tel'], 'cv_link' => $cv_link]);


				break;
		}

		/* Send mail
		$mail_parameters = ["sender_email" => env('MAIL_USERNAME', "cct@cctjobs.com"),
			"sender_name" => env('MAIL_USERNAME', "cct@cctjobs.com"),
			"receiver_email" => $user->email, "receiver_name" => $user->name, "subject" => trans('general.welcome_message_title')];
		Utility::SendSimpleMail(($data['role'] == 1)? trans('general.welcome_message') : trans('general.welcome_message_employer'), $mail_parameters );
		*/


		return $user;
	}

	/*
	public function create(array $data)
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
	}
	*/
}



