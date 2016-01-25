<?php

class EmployeeController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // special authentication check for the entire controller: Note the check-ADMIN-authentication!
        // All methods inside this controller are only accessible for admins (= users that have role type 7)
        Auth::checkAdminAuthentication();
    }

    /**
     * This method controls what happens when you move to /admin or /admin/index in your app.
     */
    public function index()
    {
	    $this->View->render('employee/index', array(
			    'users' => UserModel::getPublicProfilesOfEmployeeUsers())
	    );
    }

	public function actionAccountSettings()
	{
  	if ((Request::post('suspension') > 0) || (Request::post('softDelete')=="on" )){
      AdminModel::setAccountSuspensionAndDeletionStatus(
  			Request::post('suspension'), Request::post('softDelete'), Request::post('user_id')
      );
    }
    if(Request::post('resetUser')=="on"){
      AdminModel::setActiveUserAndResetLoginFailed(Request::post('user_id'), Request::post('resetUser'));
    }

		Redirect::to("employee");
	}

   /**
     * This method controls what happens when you move to /employee/edit(/XX) in your app.
     * Shows the current content of the employee and an editing form.
     * @param $employee_id int id of the employee
     */
    public function edit($user_id)
    {
        $this->View->render('user/edit', array(
            'user' => UserModel::getPrivateProfileOfUser($user_id)
        ));
    }

    /**
     * This method controls what happens when you move to /employee/editSave in your app.
     * Edits a employee (performs the editing after form submit).
     * POST request.
     */
    public function editSave()
    {
        EmployeeModel::updateEmployee(Request::post('user_account_type'));
        Redirect::to('employee');
    }

}
