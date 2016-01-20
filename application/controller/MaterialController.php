<?php

/**
 * The note controller: Just an example of simple create, read, update and delete (CRUD) actions.
 */
class MaterialController extends Controller
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
     * This method controls what happens when you move to /note/index in your app.
     * Gets all notes (of the user).
     */
    public function index()
    {
        $this->View->render('material/index', array(
            'materials' => MaterialModel::getAllMaterials()
        ));
    }

    /**
     * This method controls what happens when you move to /dashboard/create in your app.
     * Creates a new note. This is usually the target of form submit actions.
     * POST request.
     */
    public function create()
    {
        MaterialModel::createMaterial();
        Redirect::to('material');
    }

    /**
     * This method controls what happens when you move to /note/edit(/XX) in your app.
     * Shows the current content of the note and an editing form.
     * @param $note_id int id of the note
     */
    public function edit($material_id)
    {
        $this->View->render('material/edit', array(
            'material' => materialModel::getMaterial($material_id)
        ));
    }

    /**
     * This method controls what happens when you move to /note/editSave in your app.
     * Edits a note (performs the editing after form submit).
     * POST request.
     */
    public function editSave()
    {
        materialModel::updateMaterial();
        Redirect::to('material');
    }

    /**
     * This method controls what happens when you move to /note/delete(/XX) in your app.
     * Deletes a note. In a real application a deletion via GET/URL is not recommended, but for demo purposes it's
     * totally okay.
     * @param int $note_id id of the note
     */
    public function delete($material_id)
    {
        MaterialModel::deleteMaterial($material_id);
        Redirect::to('material');
    }

    public function deletePhotoMaterial_action()
    {
        MaterialModel::deletePhotoMaterial(Session::get("material_id"));
        Redirect::to('material');
    }
}
