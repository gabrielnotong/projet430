<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require 'base/BaseController.php';

/**
 * Class : Lesson (LessonController)
 */
class Lesson extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();

        $this->datas();

        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('login');
        } else {
            if ($this->isManagerOrTeacher() == TRUE) {
                $this->accesslogincontrol();
            }
        }
    }

    /**
     * This function used to show resources
     */
    public function list()
    {
        $data['lessons'] = $this->lesson_model->getAll();
        $this->global['pageTitle'] = 'UY1: Cours';

        $this->loadViews("lesson/list", $this->global, $data, NULL);
    }

    /**
     * This function is used to load the add new resource
     */
    private function newLessonForm()
    {
        $data['levels'] = $this->level_model->getAll();

        $this->global['pageTitle'] = 'UY1: Ajouter un cours';

        $this->loadViews("lesson/form_add_lesson", $this->global, $data, NULL);
    }

    /**
     * This function is used to add new resource to the system
     */
    public function add()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('label', 'Libellé', 'required');
        $this->form_validation->set_rules('level', 'Niveaux d\'études', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->newLessonForm();
        } else {
            $label = $this->input->post('label');
            $code = $this->input->post('code');
            $levelId = $this->input->post('level');

            $lessonId = $this->lesson_model->add(['label' => $label, 'code' => $code]);

            if ($lessonId > 0) {
                $this->lesson_model->addLevelLesson(['level_id' => $levelId, 'lesson_id' => $lessonId]);

                $process = 'Ajouter un cours';
                $processFunction = 'Lesson/add';
                $this->log($process, $processFunction);

                $this->session->set_flashdata('success', 'Cours créée avec succès');
            } else {
                $this->session->set_flashdata('error', "La création du cours $label a échouée !!");
            }

            redirect('add_lesson');
        }
    }

    /**
     * @param int $lessonId
     */
    private function editLessonForm(int $lessonId)
    {
        $data['lesson'] = $this->lesson_model->getLessonById($lessonId);
        $data['levels'] = $this->level_model->getAll();

        $this->global['pageTitle'] = 'UY1 : Modifier la resource';

        $this->loadViews("lesson/form_edit_lesson", $this->global, $data, NULL);
    }

    /**
     * This function is used to edit resource
     * @param int $lessonId
     */
    public function edit(int $lessonId = NULL): void
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('label', 'Libellé', 'required');
        $this->form_validation->set_rules('level', 'Niveaux d\'études', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->editLessonForm($lessonId);
        } else {

            $label = $this->input->post('label');
            $code = $this->input->post('code');
            $lessonId = $this->input->post('lessonId');
            $levelId = $this->input->post('level');

            $updated = $this->lesson_model->update(['label' => $label, 'code' => $code], $lessonId);

            if ($updated) {

                $this->lesson_model->updateLevelLesson(['level_id' => $levelId, 'lesson_id' => $lessonId], $lessonId);

                $process = 'Edition d\'un cours';
                $processFunction = 'Lesson/edit';
                $this->log($process, $processFunction);
                $this->session->set_flashdata('success', 'Cours modifiée avec succès');
            } else {
                $this->session->set_flashdata('error', 'La modification du cours a échoué');
            }
            redirect('lessons');

        }
    }

    /**
     * @param int $lessonId
     */
    public function delete(int $lessonId = NULL): void
    {
        if ($lessonId == null) {
            redirect('lessons');
        }

        $deleted = $this->lesson_model->delete($lessonId);

        if ($deleted) {
            $process = 'Suprpession de cours';
            $processFunction = 'Lesson/delete';
            $this->log($process, $processFunction);

            $this->session->set_flashdata('success', 'Cours supprimées avec succès');
        } else {
            $this->session->set_flashdata('error', 'Erreur de suppression du cours');
        }
        redirect('lessons');
    }

}