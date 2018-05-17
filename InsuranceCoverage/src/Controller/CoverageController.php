<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * Coverage Controller
 *
 * @property \App\Model\Table\CoverageTable $Coverage
 *
 * @method \App\Model\Entity\Coverage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoverageController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $coverage = $this->paginate($this->Coverage);

        $this->set(compact('coverage'));
    }

    /**
     * View method
     *
     * @param string|null $id Coverage id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coverage = $this->Coverage->get($id, [
            'contain' => []
        ]);

        $this->set('coverage', $coverage);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $response = $this->response;
        $coverage = $this->Coverage->newEntity();
        $this->render(false);
        if ($this->request->is('post')) {
            $coverage = $this->Coverage->patchEntity($coverage, $this->request->getData());
            if ($this->Coverage->save($coverage)) {
                $response->withType('application/json')->withStringBody(json_encode(['successMessage' =>'Coverage Created Successfully']));
                $this->sendMail('Coverage Created', 'New Coverage Created');
            }
            else{ //Server Side Validation
                $response = $response->withType('application/json')->withStringBody(json_encode(['error_message' =>'The coverage could not be saved. Please, try again.']));
                $response = $response->withStatus(400);
            }
        }
        return $response;
    }
    public function addCoverage()
    {
        
        $response = $this->response;
        $coverage = $this->Coverage->newEntity();
        $this->render(false);
        if ($this->request->is('post')) {
            $coverage = $this->Coverage->patchEntity($coverage, $this->request->getData());
            if ($this->Coverage->save($coverage)) {
                $response->withType('application/json')->withStringBody(json_encode(['successMessage' =>'Coverage Created Successfully']));
                $this->sendMail('Coverage Created', 'New Coverage Created');
            }
            else{ //Server Side Validation
                $response = $response->withType('application/json')->withStringBody(json_encode(['error_message' =>'The coverage could not be saved. Please, try again.']));
                $response = $response->withStatus(400);
            }
        }
        return $response;
    }
    /**
     * Edit method
     *
     * @param string|null $id Coverage id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //Add this to make sure no view is needed.
        $this->render(false);
        
        $response = $this->response;
        $coverage = $this->Coverage->findById($id)->first();
        $coverageName = $this->request->getData()['Coverage_Name'];
        $cost = $this->request->getData()['Cost'];
        
        //Validation on server side. 

        //Check if coverage exists by ID
        if(empty($coverage)){
            $response = $response->withType('application/json')->withStringBody(json_encode(['error_message' =>'Invalid ID']));
            $response = $response->withStatus(400);
            return $response;
        }

        //Check if coverage name is valid. Has to be one of the three values.
        if($coverageName != "Auto" && $coverageName != "Property" && $coverageName != "Legal Expense"){
            $response = $response->withType('application/json')->withStringBody(json_encode(['error_message' =>'Invalid Coverage Name']));
            $response = $response->withStatus(400);
            return $response;
        }

        //Check if coverage cost is valid. Has to be a number.
        if(!preg_match("/^\d*[1-9]\d*$/", $cost)){
            $response = $response->withType('application/json')->withStringBody(json_encode(['error_message' =>'Invalid Cost']));
            $response = $response->withStatus(400);
            return $response;           
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coverage = $this->Coverage->patchEntity($coverage, $this->request->getData());
            if ($this->Coverage->save($coverage)) {
                $response = $response->withType('application/json')->withStringBody($this->Coverage->get($id));
                $this->sendMail('Coverage Updated', 'Coverage Is Updated');
            }
        }
        return $response;
    }

    /**
     * Delete method
     *
     * @param string|null $id Coverage id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coverage = $this->Coverage->get($id);
        $response = $this->response;
        if ($this->Coverage->delete($coverage)) {
            $this->sendMail('Coverage Deleted', 'Coverage Is Deleted');
            $response = $response->withType('application/json')->withStringBody(json_encode(['successMessage' =>'Coverage Deleted']));
            return $response;
        } else {
            $response = $response->withStatus(400);
            $response = $response->withType('application/json')->withStringBody(json_encode(['errorMessage' =>'Could Not Delete Coverage.']));
            return $response;
        }
    }

    public function sendMail($subject, $message){
        $email = new Email('default');
        $email->from(['nihal@assignment.com' => 'Nihal'])->to('coverages@fredcohen.com')->subject($subject)->send($message);
    }
}
