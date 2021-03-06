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
        Auth::checkAuthentication();
    }

    /**
     * This method controls what happens when you move to /note/index in your app.
     * Gets all notes (of the user).
     */
    public function index($pageToShow)
    {
      $itemsToShow = 3;
      $page = false;
      if(isset($pageToShow)){
        $page = $pageToShow;
      }
      if(!$page){
        $start = 0;
        $page = 1;
      }else{
        $start = ($page - 1) * $itemsToShow;
      }
      $numTotalRegister = MaterialModel::getNumRowAllMaterials();
      $totalPages = ceil($numTotalRegister / $itemsToShow);
      $this->View->render('material/index', array(
          'totalPages' => $totalPages,
          'page' => $page,
          'itemsToShow' => $itemsToShow,
          'orderBy' => "material_id",
          'materials' => MaterialModel::getAllMaterialsPaginated($start, $itemsToShow)
      ));
    }

    public function indexOrderByAndItemsToshow($pageToShow,$itemsToShow,$orderBy)
    {
      $page = false;
      if(isset($pageToShow)){
        $page = $pageToShow;
      }
      if(isset($_POST['itemsToShow'])){
        $itemsToShow = $_POST['itemsToShow'];
      }
      if(isset($_POST['orderBy'])){
        $orderBy = $_POST['orderBy'];
      }
      if(!$page){
        $start = 0;
        $page = 1;
      }else{
        $start = ($page - 1) * $itemsToShow;
      }
      $numTotalRegister = MaterialModel::getNumRowAllMaterials();
      $totalPages = ceil($numTotalRegister / $itemsToShow);
      $this->View->render('material/index', array(
          'totalPages' => $totalPages,
          'page' => $page,
          'itemsToShow' => $itemsToShow,
          'orderBy' => $orderBy,
          'materials' => MaterialModel::getAllMaterialsPaginatedOrderBy($start, $itemsToShow, $orderBy)
      ));
    }

    /**
     * This method controls what happens when you move to /dashboard/create in your app.
     * Creates a new note. This is usually the target of form submit actions.
     * POST request.
     */
    public function create()
    {
        // All methods inside this controller are only accessible for admins (= users that have role type 7)
        Auth::checkAdminAuthentication();
        MaterialModel::createMaterial();
        Redirect::to('material/index/0');
    }

    /**
     * This method controls what happens when you move to /note/edit(/XX) in your app.
     * Shows the current content of the note and an editing form.
     * @param $note_id int id of the note
     */
    public function edit($material_id)
    {
        // All methods inside this controller are only accessible for admins (= users that have role type 7)
        Auth::checkAdminAuthentication();
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
        // All methods inside this controller are only accessible for admins (= users that have role type 7)
        Auth::checkAdminAuthentication();
        materialModel::updateMaterial();
        Redirect::to('material/index/0');
    }

    /**
     * This method controls what happens when you move to /note/delete(/XX) in your app.
     * Deletes a note. In a real application a deletion via GET/URL is not recommended, but for demo purposes it's
     * totally okay.
     * @param int $note_id id of the note
     */
    public function delete($material_id)
    {
        // All methods inside this controller are only accessible for admins (= users that have role type 7)
        Auth::checkAdminAuthentication();
        MaterialModel::deleteMaterial($material_id);
        Redirect::to('material/index/0');
    }

    public function deleteSelect()
    {
        // All methods inside this controller are only accessible for admins (= users that have role type 7)
        Auth::checkAdminAuthentication();
        $idArray = $_POST['check_list'];
        foreach($idArray as $material_id){
          MaterialModel::deleteMaterial($material_id);
        }
        Redirect::to('material/index/0');
    }

    public function deletePhotoMaterial_action($material_id)
    {
        // All methods inside this controller are only accessible for admins (= users that have role type 7)
        Auth::checkAdminAuthentication();
        MaterialModel::deletePhotoMaterial($material_id);
        Redirect::to('material/index/0');
    }
}
