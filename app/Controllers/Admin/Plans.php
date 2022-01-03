<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers\Admin;

class Plans extends \App\Controllers\AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "Investment Plans";
    }

    public function index(): string
    {
        return $this->_renderPage('Plans/index2', $this->data);
    }

    public function create()
    {
        if ($this->request->getPost()) {
            $model = new \App\Models\Plans();
            try {
                if ($model->save($this->request->getPost())) {
                    return redirect()->back()->with('success', "Plan saved successfully");
                } else {
                    return redirect()->back()->with('error', "An error occurred");
                }
            } catch (\ReflectionException $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        return redirect()->back()->with('error', "An error occurred");


    }
    public function delete($id)
    {
        $model = new \App\Models\Plans();

        if ($model->delete($id)) {
            return redirect()->back()->with('success', "Plan deleted successfully");
        }

        return redirect()->back()->with('error', "Failed to delete the Plan");

    }
    public function edit($id)
    {
        if(isset($_POST['id']) ){
            $id = $_POST['id'];
         } 

        if(!$id){
            return redirect()->to(current_url())->with('error', "An error occurred");

        }
       
        $model = new \App\Models\Plans();
        $plan = $model->find($id);
        //dd($plan);
        if (empty($plan)) {
            return redirect()->back()->with('error', "Plan does not exist");
        }
        $check_value = isset($_POST['active']) ? 1 : 0;
        $data = $this->request->getPost();

        $data['active'] = $check_value;
        if ($this->request->getPost()) {
            try {//dd($data);
                if ($model->save($data)) {
                    //dd(previous_url());
                    return redirect()->to(base_url('plans'))->with('success', "Plan edited successfully");;
                } else {
                    return redirect()->to(current_url())->with('error', "An error occurred");
                }
            } catch (\ReflectionException $e) {
                return redirect()->to(current_url())->with('error', $e->getMessage());
            }
        }

        $this->data['plan'] = $plan;

        return $this->_renderPage('Plans/edit', $this->data);
    }

    public function getPlans()
    {
        
        $plans = (new \App\Models\Plans())->findAll();
        $plan['data'] = $plans;
        echo json_encode($plan);
        //return $plan;

    }
}
