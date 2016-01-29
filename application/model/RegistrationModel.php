<?php

/**
 * Class RegistrationModel
 *
 * Everything registration-related happens here.
 */
class RegistrationModel
{
	/**
	 * Handles the entire registration process for DEFAULT users (not for people who register with
	 * 3rd party services, like facebook) and creates a new user in the database if everything is fine
	 *
	 * @return boolean Gives back the success status of the registration
	 */
	public static function registerNewUser($user_account_type)
	{
		if(empty($user_account_type) || is_null($user_account_type) || !isset($user_account_type)){
      $user_account_type = 1;
    }

    // clean the input
		$user_name = strip_tags(Request::post('user_name'));
		$user_email = strip_tags(Request::post('user_email'));
    $user_email_repeat = strip_tags(Request::post('user_email_repeat'));
		$user_password_new = Request::post('user_password_new');
		$user_password_repeat = Request::post('user_password_repeat');

		$name = Request::post('name', true);
		$user_surname1 = Request::post('user_surname1', true);
		$user_surname2 = Request::post('user_surname2', true);
		$user_address = Request::post('user_address', true);
		$user_city = Request::post('user_city', true);
		$user_province = Request::post('user_province', true);
		$user_NIF = Request::post('user_NIF', true);
		$user_phone = Request::post('user_phone', true);
    $user_contract_date = Request::post('user_contract_date', true);

		// stop registration flow if registrationInputValidation() returns false (= anything breaks the input check rules)
		$validation_result = self::registrationInputValidation(Request::post('captcha'), $user_name, $user_password_new, $user_password_repeat, $user_email, $user_email_repeat);
		$validation_others_inputs = self::registrationOthersInputValidation($name, $user_surname1, $user_surname2, $user_address, $user_city, $user_province, $user_NIF, $user_phone, $user_contract_date);
		if (!$validation_result && !$validation_others_inputs) {
			return false;
		}

		// crypt the password with the PHP 5.5's password_hash() function, results in a 60 character hash string.
		// @see php.net/manual/en/function.password-hash.php for more, especially for potential options
		$user_password_hash = password_hash($user_password_new, PASSWORD_DEFAULT);

        // make return a bool variable, so both errors can come up at once if needed
        $return = true;

		// check if username already exists
		if (UserModel::doesUsernameAlreadyExist($user_name)) {
			Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_ALREADY_TAKEN'));
			$return = false;
		}

		// check if email already exists
		if (UserModel::doesEmailAlreadyExist($user_email)) {
			Session::add('feedback_negative', Text::get('FEEDBACK_USER_EMAIL_ALREADY_TAKEN'));
			$return = false;
		}

        	// if Username or Email were false, return false
        	if(!$return) return false;

		// generate random hash for email verification (40 char string)
		$user_activation_hash = sha1(uniqid(mt_rand(), true));

		// write user data to database
		if (!self::writeNewUserToDatabase($user_name, $user_password_hash, $user_email, time(), $user_activation_hash, $name, $user_surname1, $user_surname2, $user_address, $user_city, $user_province, $user_NIF, $user_phone, $user_contract_date, $user_account_type)) {
			Session::add('feedback_negative', Text::get('FEEDBACK_ACCOUNT_CREATION_FAILED'));
            return false; // no reason not to return false here
		}

		// get user_id of the user that has been created, to keep things clean we DON'T use lastInsertId() here
		$user_id = UserModel::getUserIdByUsername($user_name);

		if (!$user_id) {
			Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
			return false;
		}

		// send verification email
		if (self::sendVerificationEmail($user_id, $user_email, $user_activation_hash)) {
			Session::add('feedback_positive', Text::get('FEEDBACK_ACCOUNT_SUCCESSFULLY_CREATED'));
			return true;
		}

		// if verification email sending failed: instantly delete the user
		self::rollbackRegistrationByUserId($user_id);
		Session::add('feedback_negative', Text::get('FEEDBACK_VERIFICATION_MAIL_SENDING_FAILED'));
		return false;
	}

	/**
	 * Validates the registration input
	 *
	 * @param $captcha
	 * @param $user_name
	 * @param $user_password_new
	 * @param $user_password_repeat
	 * @param $user_email
   * @param $user_email_repeat
	 *
	 * @return bool
	 */
	public static function registrationInputValidation($captcha, $user_name, $user_password_new, $user_password_repeat, $user_email, $user_email_repeat)
	{
        $return = true;

		// perform all necessary checks
		if (!CaptchaModel::checkCaptcha($captcha)) {
			Session::add('feedback_negative', Text::get('FEEDBACK_CAPTCHA_WRONG'));
            $return = false;
		}

    // if username, email and password are all correctly validated, but make sure they all run on first sumbit
    if (self::validateUserName($user_name) AND self::validateUserEmail($user_email, $user_email_repeat) AND self::validateUserPassword($user_password_new, $user_password_repeat) AND $return) {
        return true;
    }

		// otherwise, return false
		return false;
	}

    /**
     * Validates the username
     *
     * @param $user_name
     * @return bool
     */
    public static function validateUserName($user_name)
    {
        if (empty($user_name)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_FIELD_EMPTY'));
            return false;
        }

        // if username is too short (2), too long (64) or does not fit the pattern (aZ09)
        if (!preg_match('/[a-zA-Z0-9]{2,64}/', $user_name)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_DOES_NOT_FIT_PATTERN'));
            return false;
        }

        return true;
    }

    /**
     * Validates the email
     *
     * @param $user_email
     * @return bool
     */
    public static function validateUserEmail($user_email, $user_email_repeat)
    {
        if (empty($user_email)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_FIELD_EMPTY'));
            return false;
        }
        if ($user_email !== $user_email_repeat) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_REPEAT_WRONG'));
            return false;
       }


        // validate the email with PHP's internal filter
        // side-fact: Max length seems to be 254 chars
        // @see http://stackoverflow.com/questions/386294/what-is-the-maximum-length-of-a-valid-email-address
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN'));
            return false;
        }

        return true;
    }

    /**
     * Validates the password
     *
     * @param $user_password_new
     * @param $user_password_repeat
     * @return bool
     */
    public static function validateUserPassword($user_password_new, $user_password_repeat)
    {
        if (empty($user_password_new) OR empty($user_password_repeat)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PASSWORD_FIELD_EMPTY'));
            return false;
        }

        if ($user_password_new !== $user_password_repeat) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PASSWORD_REPEAT_WRONG'));
            return false;
        }

        if (strlen($user_password_new) < 6) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PASSWORD_TOO_SHORT'));
            return false;
        }

        return true;
    }

	/**
	 * Validates registration of other inputs
	 *
	 * @param $name
	 * @param $user_surname1
	 * @param $user_surname2
	 * @param $user_address
	 * @param $user_city
	 * @param $user_province
	 * @param $user_NIF
	 * @param $user_phone
	 *
	 * @return bool
	 */
	public static function registrationOthersInputValidation($name, $user_surname1, $user_surname2, $user_address, $user_city, $user_province, $user_NIF, $user_phone, $user_contract_date)
	{
        return true;

        if (empty($name)) {
            Session::add('feedback_negative', 'El campo Nombre está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/[A-Za-záéíóúÁÉÍÓÚñÑ\.\s-]{2,64}/', $name)) {
            Session::add('feedback_negative', 'El campo Nombre no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }

		    if (empty($user_surname1)) {
            Session::add('feedback_negative', 'El campo Primer Apellido está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/[A-Za-záéíóúÁÉÍÓÚñÑ\.\s-]{2,64}/', $user_surname1)) {
            Session::add('feedback_negative', 'El campo Primer Apellido no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }

        if (empty($user_surname2)) {
            Session::add('feedback_negative', 'El campo Segundo Apellido está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/[A-Za-záéíóúÁÉÍÓÚñÑ\.\s-]{2,64}/', $user_surname2)) {
            Session::add('feedback_negative', 'El campo Segundo Apellido no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }

        if (empty($user_address)) {
            Session::add('feedback_negative', 'El campo Direccion está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\.\/\s,-]{2,64}/', $user_address)) {
            Session::add('feedback_negative', 'El campo Direccion no se ajusta al patrón: Sólo mayusculas, minusculas, numeros, espacios comas y guiones, de 2 a 64 caracteres');
            return false;
        }

        if (empty($user_city)) {
            Session::add('feedback_negative', 'El campo Poblacion está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/[A-Za-záéíóúÁÉÍÓÚñÑ\.\/\s,-]{2,64}/', $user_city)) {
            Session::add('feedback_negative', 'El campo Poblacion no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }

        if (empty($user_province)) {
            Session::add('feedback_negative', 'El campo Provincia está vacío');
            return false;
        }
        // if name is too short (2), too long (64) or does not fit the pattern (aZ)
        if (!preg_match('/[A-Za-záéíóúÁÉÍÓÚñÑ\.\/\s,-]{2,64}/', $user_province)) {
            Session::add('feedback_negative', 'El campo Provincia no se ajusta al patrón: Sólo mayusculas y minusculas y espacios, de 2 a 64 caracteres');
            return false;
        }
        // if NIF does not fit the pattern (12345678A) 8 digits and 1 character upercase.
        if (empty($user_NIF)) {
            Session::add('feedback_negative', 'El campo NIF está vacío');
            return false;
        }

        if (!preg_match('/^([0-9]{8,8})([A-Z])$/', $user_NIF)) {
            Session::add('feedback_negative', 'El campo NIF no se ajusta al patrón: 8 digitos y una letra mayuscula');
            return false;
        }

        if (empty($user_phone)) {
            Session::add('feedback_negative', 'El campo Telefono está vacío');
            return false;
        }
        // if phone does not fit the pattern (+34923456789 +34 923456789 923456789 +34623456789+34 623456789 623456789)
        if (!preg_match('/^([9|6][0-9]{8})$/', $user_phone)) {
            Session::add('feedback_negative', 'El campo Telefono no se ajusta al patrón: el nº telefono debe de empezar por 9 o por 6 hasta alcanzar 9 digitos.');
            return false;
        }
        if(!is_null($user_contract_date)){
          if (empty($user_contract_date)){
              Session::add('feedback_negative', 'El campo Fecha Contratacion está vacío');
              return false;
          }

          if (!preg_match('/(\d{4})(-)([0][1-9]|[1][0-2])\2([0][1-9]|[12][0-9]|3[01])/', $user_contract_date)) {
              Session::add('feedback_negative', 'El campo Fecha Contratacion no se ajusta al patrón de fecha DD/MM/AAAA');
              return false;
          }
        }
	}

	/**
	 * Writes the new user's data to the database
	 *
	 * @param $user_name
	 * @param $user_password_hash
	 * @param $user_email
	 * @param $user_creation_timestamp
	 * @param $user_activation_hash
	 *
	 * @return bool
	 */
	public static function writeNewUserToDatabase($user_name, $user_password_hash, $user_email, $user_creation_timestamp, $user_activation_hash, $name, $user_surname1, $user_surname2, $user_address, $user_city, $user_province, $user_NIF, $user_phone, $user_contract_date, $user_account_type)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

		// write new users data into database
		$sql = "INSERT INTO users (user_name, user_password_hash, user_email, user_creation_timestamp, user_activation_hash, user_provider_type, name, user_surname1, user_surname2, user_address, user_city, user_province, user_NIF, user_phone, user_contract_date, user_account_type)
                    VALUES (:user_name, :user_password_hash, :user_email, :user_creation_timestamp, :user_activation_hash, :user_provider_type, :name, :user_surname1, :user_surname2, :user_address, :user_city, :user_province, :user_NIF, :user_phone, :user_contract_date, :user_account_type)";
		$query = $database->prepare($sql);
		$query->execute(array(':user_name' => $user_name,
		                      ':user_password_hash' => $user_password_hash,
		                      ':user_email' => $user_email,
		                      ':user_creation_timestamp' => $user_creation_timestamp,
		                      ':user_activation_hash' => $user_activation_hash,
		                      ':user_provider_type' => 'DEFAULT',
		                      ':name' => $name,
		                      ':user_surname1' => $user_surname1,
		                      ':user_surname2' => $user_surname2,
		                      ':user_address' => $user_address,
		                      ':user_city' => $user_city,
		                      ':user_province' => $user_province,
		                      ':user_NIF' => $user_NIF,
                          ':user_phone' => $user_phone,
                          ':user_contract_date' => $user_contract_date,
		                      ':user_account_type' => $user_account_type));
		$count =  $query->rowCount();
		if ($count == 1) {
			return true;
		}

		return false;
	}

	/**
	 * Deletes the user from users table. Currently used to rollback a registration when verification mail sending
	 * was not successful.
	 *
	 * @param $user_id
	 */
	public static function rollbackRegistrationByUserId($user_id)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

		$query = $database->prepare("DELETE FROM users WHERE user_id = :user_id");
		$query->execute(array(':user_id' => $user_id));
	}

	/**
	 * Sends the verification email (to confirm the account).
	 * The construction of the mail $body looks weird at first, but it's really just a simple string.
	 *
	 * @param int $user_id user's id
	 * @param string $user_email user's email
	 * @param string $user_activation_hash user's mail verification hash string
	 *
	 * @return boolean gives back true if mail has been sent, gives back false if no mail could been sent
	 */
	public static function sendVerificationEmail($user_id, $user_email, $user_activation_hash)
	{
		$body = Config::get('EMAIL_VERIFICATION_CONTENT') . Config::get('URL') . Config::get('EMAIL_VERIFICATION_URL')
		        . '/' . urlencode($user_id) . '/' . urlencode($user_activation_hash);

		$mail = new Mail;
		$mail_sent = $mail->sendMail($user_email, Config::get('EMAIL_VERIFICATION_FROM_EMAIL'),
			Config::get('EMAIL_VERIFICATION_FROM_NAME'), Config::get('EMAIL_VERIFICATION_SUBJECT'), $body
		);

		if ($mail_sent) {
			Session::add('feedback_positive', Text::get('FEEDBACK_VERIFICATION_MAIL_SENDING_SUCCESSFUL'));
			return true;
		} else {
			Session::add('feedback_negative', Text::get('FEEDBACK_VERIFICATION_MAIL_SENDING_ERROR') . $mail->getError() );
			return false;
		}
	}

	/**
	 * checks the email/verification code combination and set the user's activation status to true in the database
	 *
	 * @param int $user_id user id
	 * @param string $user_activation_verification_code verification token
	 *
	 * @return bool success status
	 */
	public static function verifyNewUser($user_id, $user_activation_verification_code)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "UPDATE users SET user_active = 1, user_activation_hash = NULL
                WHERE user_id = :user_id AND user_activation_hash = :user_activation_hash LIMIT 1";
		$query = $database->prepare($sql);
		$query->execute(array(':user_id' => $user_id, ':user_activation_hash' => $user_activation_verification_code));

		if ($query->rowCount() == 1) {
			Session::add('feedback_positive', Text::get('FEEDBACK_ACCOUNT_ACTIVATION_SUCCESSFUL'));
			return true;
		}

		Session::add('feedback_negative', Text::get('FEEDBACK_ACCOUNT_ACTIVATION_FAILED'));
		return false;
	}
}
