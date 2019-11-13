<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Employers Controller
 *
 * @property \App\Model\Table\EmployersTable $Employers
 *
 * @method \App\Model\Entity\Employer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployersController extends AppController
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
        $employers = $this->paginate($this->Employers);

        $this->set(compact('employers'));
    }

    public function initialize()
    {
      parent::initialize();
      $this->Auth->allow(['view']);
    }
    /**
     * View method
     *
     * @param string|null $id Employer id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employer = $this->Employers->get($id, [
            'contain' => ['Users', 'Vacancies']
        ]);

        $this->set('employer', $employer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $employer = $this->Employers->newEntity();
    //     if ($this->request->is('post')) {
    //         $employer = $this->Employers->patchEntity($employer, $this->request->getData());
    //         if ($this->Employers->save($employer)) {
    //             $this->Flash->success(__('The employer has been saved.'));
    //
    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The employer could not be saved. Please, try again.'));
    //     }
    //     $users = $this->Employers->Users->find('list', ['limit' => 200]);
    //     $this->set(compact('employer', 'users'));
    // }

    /**
     * Edit method
     *
     * @param string|null $id Employer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($userId = null)
    {
        $userId = $this->Auth->user('id');
        $employer = $this->Employers->find('all', [
            'contain' => ['Users', 'Vacancies'] ])
                                    ->where(['Employers.user_id' => $userId])
                                    ->firstOrFail();

        // image uploading
        $postData = $this->request->getData();
        if (isset($postData['upload']) && $postData['upload']['error'] == 0) { // no errors
            $filename = $postData['upload']['tmp_name'];
            $filename = hash_file('md5', $filename);
            $file_path =   WWW_ROOT  . 'img/'.$filename;
            move_uploaded_file($postData['upload']['tmp_name'], $file_path);
            $postData['image_path'] = $filename;
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $employer = $this->Employers->patchEntity($employer, $postData);
            if ($this->Employers->save($employer)) {
                $this->Flash->success(__('The employer has been saved.'));
            } else {
                $this->Flash->error(__('The employer could not be saved. Please, try again.'));
            }
        }
        $users = $this->Employers->Users->find('list', ['limit' => 200]);
        $this->set(compact('employer', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employer = $this->Employers->get($id);
        if ($this->Employers->delete($employer)) {
            $this->Flash->success(__('The employer has been deleted.'));
        } else {
            $this->Flash->error(__('The employer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function meta($id = null)
    {
        $userId = $this->Auth->user('id');
        $employer = $this->Employers->find('all', [
            'contain' => ['Users', 'Vacancies', 'Vacancies.Responses'] ])
                                    ->where(['Employers.user_id' => $userId])
                                    ->firstOrFail();

        $responseCount = 0;
        foreach ($employer->vacancies as $vacancy) {
            $responseCount += count(array_filter($vacancy->responses_unread));
        }

        $metaData = [
            'responseCount' => $responseCount
        ];

        $this->loadComponent('RequestHandler');
        $this->RequestHandler->renderAs($this, 'json');
        return $this->response->withType('application/json')
                       ->withStringBody(json_encode($metaData));
    }

    public function responses($id = null)
    {
        $this->request->allowMethod(['post', 'get']);
        $userId = $this->Auth->user('id');
        $employer = $this->Employers->find('all', [
            'contain' => ['Users', 'Vacancies', 'Vacancies.Responses', 'Vacancies.Responses.Employees'] ])
                                    ->where(['Employers.user_id' => $userId])
                                    ->firstOrFail();


        if ($this->request->is('post')) {
            foreach ($employer->vacancies as $vacancy) {
                foreach ($vacancy->responses as $response) {
                    $response->viewed = true;
                    $this->Employers->Vacancies->Responses->save($response);
                }
            }

            $this->loadComponent('RequestHandler');
            $this->RequestHandler->renderAs($this, 'json');
            return $this->response->withType('application/json')
                                  ->withStringBody(json_encode(['error' => 0]));

        } else if ($this->request->is('get')) {
            $this->set('employer', $employer);
        }
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
