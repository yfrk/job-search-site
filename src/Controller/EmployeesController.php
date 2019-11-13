<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 *
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $employees = $this->paginate($this->Employees);

        $this->set(compact('employees'));
    }

    public function initialize()
    {
      parent::initialize();
      $this->Auth->allow(['view']);
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => ['Users', 'Skills']
        ]);

        $this->set('employee', $employee);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $employee = $this->Employees->newEntity();
    //     if ($this->request->is('post')) {
    //         $employee = $this->Employees->patchEntity($employee, $this->request->getData());
    //         if ($this->Employees->save($employee)) {
    //             $this->Flash->success(__('The employee has been saved.'));
    //
    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The employee could not be saved. Please, try again.'));
    //     }
    //     $users = $this->Employees->Users->find('list', ['limit' => 200]);
    //     $this->set(compact('employee', 'users'));
    // }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userId = $this->Auth->user('id');
        $employee = $this->Employees->find('all', [
            'contain' => ['Users', 'Skills'] ])
                                    ->where(['Employees.user_id' => $userId])
                                    ->firstOrFail();

        // image uploading
        $postData = $this->request->getData();
        if (isset($postData['upload']) && $postData['upload']['error'] == 0) { // no errors
            $filename = $postData['upload']['tmp_name'];
            $filename = hash_file('md5', $filename);
            $file_path =   WWW_ROOT  . 'img/' . $filename;
            move_uploaded_file($postData['upload']['tmp_name'], $file_path);
            $postData['image_path'] = $filename;
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $postData);
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('Changes had been saved successfully.'));
            } else {
                $this->Flash->error(__('Changes could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('employee'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        $slug = $this->request->getParam('pass.0');
        if (!$slug) {
            return false;
        }

        return $user['id'] == $slug;
    }
}
