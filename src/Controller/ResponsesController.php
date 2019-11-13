<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Responses Controller
 *
 * @property \App\Model\Table\ResponsesTable $Responses
 *
 * @method \App\Model\Entity\Response[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ResponsesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Vacancies', 'Employees']
        ];
        $responses = $this->paginate($this->Responses);

        $this->set(compact('responses'));
    }

    /**
     * View method
     *
     * @param string|null $id Response id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $response = $this->Responses->get($id, [
            'contain' => ['Vacancies', 'Employees']
        ]);

        $this->set('response', $response);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $response = $this->Responses->newEntity();
    //     if ($this->request->is('post')) {
    //         $response = $this->Responses->patchEntity($response, $this->request->getData());
    //         if ($this->Responses->save($response)) {
    //             $this->Flash->success(__('The response has been saved.'));
    //
    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The response could not be saved. Please, try again.'));
    //     }
    //     $vacancies = $this->Responses->Vacancies->find('list', ['limit' => 200]);
    //     $employees = $this->Responses->Employees->find('list', ['limit' => 200]);
    //     $this->set(compact('response', 'vacancies', 'employees'));
    // }
    //
    // /**
    //  * Edit method
    //  *
    //  * @param string|null $id Response id.
    //  * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    // public function edit($id = null)
    // {
    //     $response = $this->Responses->get($id, [
    //         'contain' => []
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $response = $this->Responses->patchEntity($response, $this->request->getData());
    //         if ($this->Responses->save($response)) {
    //             $this->Flash->success(__('The response has been saved.'));
    //
    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The response could not be saved. Please, try again.'));
    //     }
    //     $vacancies = $this->Responses->Vacancies->find('list', ['limit' => 200]);
    //     $employees = $this->Responses->Employees->find('list', ['limit' => 200]);
    //     $this->set(compact('response', 'vacancies', 'employees'));
    // }
    //
    // /**
    //  * Delete method
    //  *
    //  * @param string|null $id Response id.
    //  * @return \Cake\Http\Response|null Redirects to index.
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $response = $this->Responses->get($id);
    //     if ($this->Responses->delete($response)) {
    //         $this->Flash->success(__('The response has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The response could not be deleted. Please, try again.'));
    //     }
    //
    //     return $this->redirect(['action' => 'index']);
    // }
    
}
