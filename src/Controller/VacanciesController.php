<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Vacancy;
/**
 * Vacancies Controller
 *
 * @property \App\Model\Table\VacanciesTable $Vacancies
 *
 * @method \App\Model\Entity\Vacancy[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VacanciesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     
     */
    public function index()
    {
        $queryString = $this->request->getQuery('query');
        $this->paginate = [
            'contain' => ['Employers']
        ];

        if ($queryString === null) {
            $vacancies = $this->paginate($this->Vacancies);

        } else {
            $tags = explode(',', $queryString);
            $tags = array_unique(array_filter(array_map('trim', $tags)));

            $vacancies = $this->Vacancies->find('tagged', [
                'tags' => $tags
            ]);

            $vacancies = $this->paginate($vacancies);
        }
        $this->set([
            'user' => $this->Auth->user(),
            'vacancies' => $vacancies
        ]);
    }

    public function initialize()
    {
      parent::initialize();
      $this->Auth->allow(['view']);
    }

    /**
     * View method
     *
     * @param string|null $id Vacancy id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if ($id === null) {
            $this->redirect(['action' => 'index']);
            return;
        }

        $vacancy = $this->Vacancies->get($id, [
            'contain' => ['Employers', 'Tags']
        ]);
        $this->set([
            'user' => $this->Auth->user(),
            'vacancy' => $vacancy
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vacancy = $this->Vacancies->newEntity();
        if ($this->request->is('post')) {
            $employer = $this->Vacancies->Employers
              ->getEmployerByUserId($this->Auth->user('id'));

            $vacancy = $this->Vacancies->patchEntity($vacancy, $this->request->getData());

            $vacancy->employer_id = $employer['id'];

            if ($this->Vacancies->save($vacancy)) {
                $this->Flash->success(__('The vacancy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vacancy could not be saved. Please, try again.'));
        }
        $employers = $this->Vacancies->Employers->find('list', ['limit' => 200]);
        $this->set(compact('vacancy', 'employers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vacancy id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vacancy = $this->Vacancies->get($id, [
            'contain' => ['Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vacancy = $this->Vacancies->patchEntity($vacancy, $this->request->getData());
            if ($this->Vacancies->save($vacancy)) {
                $this->Flash->success(__('The vacancy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vacancy could not be saved. Please, try again.'));
        }
        $employers = $this->Vacancies->Employers->find('list', ['limit' => 200]);
        $this->set(compact('vacancy', 'employers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vacancy id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vacancy = $this->Vacancies->get($id);
        if ($this->Vacancies->delete($vacancy)) {
            $this->Flash->success(__('The vacancy has been deleted.'));
        } else {
            $this->Flash->error(__('The vacancy could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function respond($id = null)
    {
        $vacancy = $this->Vacancies->get($id, [
            'contain' => ['Responses']
        ]);
        $employee = $this->Vacancies->Responses->Employees->getEmployeeByUserId($this->Auth->user('id'));

        if ($this->request->is('get')) {
            $response = $this->Vacancies->Responses->find('all')
                                                   ->where([
                                                       'Responses.vacancy_id' => $vacancy['id'],
                                                       'Responses.employee_id' => $employee['id']])
                                                   ->first();

            if ($response === null) {
                $response = $this->Vacancies->Responses->newEntity();
                $response = $this->Vacancies->Responses->patchEntity($response, [
                    'vacancy_id' => $vacancy['id'],
                    'employee_id' => $employee['id']
                ]);
            }

            if ($this->Vacancies->Responses->save($response)) {
                $responses = [$response];
                foreach ($vacancy->responses as $resp) {
                    $responses[] = $resp;
                }
                $vacancy->responses = $responses;
                if ($this->Vacancies->save($vacancy)) {
                    $this->Flash->success(__('Response left.'));
                }
            } else {
                $this->Flash->error(__('Unable to respond on this vacancy.'));
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        if (in_array($action, ['view'])) {
            return true;
        }

        if ($action == 'add' && $user['role'] == 'employer') {
            return true;
        }

        if (in_array($action, ['edit', 'delete']) && $user['role'] == 'employer') {
            $vacancyId = (int)$this->request->getParam('pass.0');
            $employer = $this->Vacancies->Employers
                      ->getEmployerByUserId($this->Auth->user('id'));

            return $this->Vacancies->isOwnedBy($vacancyId, $employer['id']);
        }

        if (in_array($action, ['respond']) && $user['role'] == 'employee') {
            return true;
        }
    }
}
