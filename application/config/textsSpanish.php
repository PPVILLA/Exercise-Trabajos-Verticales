<?php

/**
 * Texts used in the application.
 * These texts are used via Text::get('FEEDBACK_USERNAME_ALREADY_TAKEN').
 * Could be extended to i18n etc.
 */
return array(
	"FEEDBACK_UNKNOWN_ERROR" => "Se ha producido un error desconocido!",
	"FEEDBACK_DELETED" => "Tu cuenta ha sido eliminada.",
	"FEEDBACK_ACCOUNT_SUSPENDED" => "Cuenta suspendida por ",
	"FEEDBACK_ACCOUNT_SUSPENSION_DELETION_STATUS" => "Estado de suspensión / eliminación de este usuario ha sido editado.",
	"FEEDBACK_PASSWORD_WRONG_3_TIMES" => "Se ha escrito una contraseña incorrecta 3 o más veces. Por favor, espere 30 segundos para volver a intentarlo.",
	"FEEDBACK_ACCOUNT_NOT_ACTIVATED_YET" => "Su cuenta no está activada todavía. Por favor, haga clic en el enlace de confirmación en el correo.",
	"FEEDBACK_USERNAME_OR_PASSWORD_WRONG" => "El nombre de usuario o contraseña es incorrecto. Por favor, vuelva a intentarlo.",
	"FEEDBACK_USER_DOES_NOT_EXIST" => "Este usuario no existe.",
	"FEEDBACK_LOGIN_FAILED" => "El Login ha fallado",
	"FEEDBACK_LOGIN_FAILED_3_TIMES" => "El Login ya ha fallado 3 o más veces. Por favor, espere 30 segundos para volver a intentarlo",
	"FEEDBACK_USERNAME_FIELD_EMPTY" => "El Campo Usuario esta vacío..",
	"FEEDBACK_PASSWORD_FIELD_EMPTY" => "El Campo Contraseña esta vacío..",
	"FEEDBACK_USERNAME_OR_PASSWORD_FIELD_EMPTY" => "El Campo Usuario  o el Campo Contraseña esta vacío.",
	"FEEDBACK_USERNAME_EMAIL_FIELD_EMPTY" => "campo Usuario / email esta vacío.",
	"FEEDBACK_EMAIL_FIELD_EMPTY" => "Campo Correo electrónico esta vacía.",
	"FEEDBACK_EMAIL_AND_PASSWORD_FIELDS_EMPTY" => "Campos de correo electrónico y contraseña estan vacías.",
	"FEEDBACK_USERNAME_SAME_AS_OLD_ONE" => "Lo siento, ese nombre de usuario es el mismo que el actual. Por favor elija otro.",
	"FEEDBACK_USERNAME_ALREADY_TAKEN" => "Lo siento, ese nombre de usuario ya está en uso. Por favor elija otro.",
	"FEEDBACK_USER_EMAIL_ALREADY_TAKEN" => "Lo siento, ese email ya está en uso. Por favor elija otro.",
	"FEEDBACK_USERNAME_CHANGE_SUCCESSFUL" => "Su nombre de usuario se ha cambiado correctamente.",
	"FEEDBACK_USERNAME_AND_PASSWORD_FIELD_EMPTY" => "Username and password fields were empty.",
	"FEEDBACK_USERNAME_DOES_NOT_FIT_PATTERN" => "Nombre de usuario no se ajusta al patrón de nombre: Sólo a-Z y los números están permitidos, de 2 a 64 caracteres",
	"FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN" => "Lo siento, su correo electrónico elegido no encaja en el correo electrónico de nombres de patrones.",
	"FEEDBACK_EMAIL_SAME_AS_OLD_ONE" => "Lo siento, esa dirección de correo electrónico es la misma que la actual. Por favor elija otro.",
	"FEEDBACK_EMAIL_CHANGE_SUCCESSFUL" => "Su dirección de correo electrónico ha sido cambiado con éxito.",
	"FEEDBACK_CAPTCHA_WRONG" => "Los caracteres de seguridad Captcha introducidos estaban equivocados.",
	"FEEDBACK_PASSWORD_REPEAT_WRONG" => "Contraseña y repetir contraseña no son los mismos.",
	"FEEDBACK_PASSWORD_TOO_SHORT" => "Contraseña tiene una longitud mínima de 6 caracteres.",
	"FEEDBACK_USERNAME_TOO_SHORT_OR_TOO_LONG" => "Nombre de usuario no puede ser inferior a 2 o más de 64 caracteres.",
	"FEEDBACK_ACCOUNT_SUCCESSFULLY_CREATED" => "Su cuenta ha sido creada con éxito y le hemos enviado un correo electrónico. Por favor, haga clic en el enlace de verificación dentro de ese correo.",
	"FEEDBACK_VERIFICATION_MAIL_SENDING_FAILED" => "Lo siento, no podríamos enviarte un correo de verificación. Su cuenta no ha sido creado.",
	"FEEDBACK_ACCOUNT_CREATION_FAILED" => "Lo sentimos, tu inscripción no pudo. Por favor, vuelve y vuelve a intentarlo.",
	"FEEDBACK_VERIFICATION_MAIL_SENDING_ERROR" => "correo de verificación no se pudo enviar debido a: ",
	"FEEDBACK_VERIFICATION_MAIL_SENDING_SUCCESSFUL" => "Un mail de verificación ha sido enviado con éxito.",
	"FEEDBACK_ACCOUNT_ACTIVATION_SUCCESSFUL" => "La activación se realizó correctamente! Ahora puede entrar.",
	"FEEDBACK_ACCOUNT_ACTIVATION_FAILED" => "Lo siento, no hay tal combinación código de identificación / verificación aquí ...",
	"FEEDBACK_AVATAR_UPLOAD_SUCCESSFUL" => "La carga del avatar se ha realizado correctamente.",
	"FEEDBACK_AVATAR_UPLOAD_WRONG_TYPE" => "Sólo los archivos JPEG y PNG son compatibles.",
	"FEEDBACK_AVATAR_UPLOAD_TOO_SMALL" => "Anchura / altura del archivo de origen Avatar es demasiado pequeña. Necesita un mínimo de 100x100 píxeles.",
	"FEEDBACK_AVATAR_UPLOAD_TOO_BIG" => "Archivo de origen del Avatar es demasiado grande. 5 Megabyte es el máximo.",
	"FEEDBACK_AVATAR_FOLDER_DOES_NOT_EXIST_OR_NOT_WRITABLE" => "Avatar folder does not exist or is not writable. Please change this via chmod 775 or 777.",
	"FEEDBACK_AVATAR_IMAGE_UPLOAD_FAILED" => "Algo salió mal con la carga de imágenes.",
	"FEEDBACK_AVATAR_IMAGE_DELETE_SUCCESSFUL" => "Ha eliminado con éxito su avatar.",
    "FEEDBACK_AVATAR_IMAGE_DELETE_NO_FILE" => "Usted no tiene un avatar personalizado.",
    "FEEDBACK_AVATAR_IMAGE_DELETE_FAILED" => "Algo salió mal al eliminar tu avatar.",
	"FEEDBACK_PASSWORD_RESET_TOKEN_FAIL" => "No se pudo escribir el TOKEN a la base de datos.",
	"FEEDBACK_PASSWORD_RESET_TOKEN_MISSING" => "No restablecimiento de contraseñas token.",
	"FEEDBACK_PASSWORD_RESET_MAIL_SENDING_ERROR" => "Restablecimiento de contraseña de correo no pudo ser enviado debido a: ",
	"FEEDBACK_PASSWORD_RESET_MAIL_SENDING_SUCCESSFUL" => "El mensaje de restablecimiento de contraseña ha sido enviado con éxito.",
	"FEEDBACK_PASSWORD_RESET_LINK_EXPIRED" => "Su enlace de restablecimiento ha expirado. Por favor, utilice el enlace de restablecimiento en una hora.",
	"FEEDBACK_PASSWORD_RESET_COMBINATION_DOES_NOT_EXIST" => "No existe combinación de código nombre de usuario / Verificación",
	"FEEDBACK_PASSWORD_RESET_LINK_VALID" => "enlace de validación de restablecimiento de contraseña es válida. Por favor, cambiar la contraseña ahora.",
	"FEEDBACK_PASSWORD_CHANGE_SUCCESSFUL" => "Contraseña cambiada con éxito.",
	"FEEDBACK_PASSWORD_CHANGE_FAILED" => "Lo siento, tu cambio de contraseña falló.",
	"FEEDBACK_PASSWORD_NEW_SAME_AS_CURRENT" => "La nueva contraseña es la misma que la contraseña actual.",
	"FEEDBACK_PASSWORD_CURRENT_INCORRECT" => "La contraseña actual introducida es incorrecta.",
	"FEEDBACK_ACCOUNT_TYPE_CHANGE_SUCCESSFUL" => "El cambio de Tipo de Cuenta realizado con éxito",
	"FEEDBACK_ACCOUNT_TYPE_CHANGE_FAILED" => "No se pudo cambiar tipo de cuenta",
	"FEEDBACK_NOTE_CREATION_FAILED" => "ha fallado la creación Nota.",
	"FEEDBACK_NOTE_EDITING_FAILED" => "La edición de nota falló",
	"FEEDBACK_NOTE_DELETION_FAILED" => "el borrado de nota falló.",
	"FEEDBACK_COOKIE_INVALID" => "Tu remember-me-cookie no es válido.",
	"FEEDBACK_COOKIE_LOGIN_SUCCESSFUL" => "Inició de sesión con éxito hecho con remember-me-cookie.",
);