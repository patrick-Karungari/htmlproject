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
        return $this->_renderPage('Plans/index', $this->data);
    }

    public function create()
    {
        if ($this->request->getPost()) {
            $model = new \App\Models\Plans();
            try {
                if ($model->save($this->request->getPost())) {
                    return redirect()->to(current_url())->with('success', "Plan saved successfully");
                } else {
                    return redirect()->to(current_url())->with('error', "An error occurred");
                }
            } catch (\ReflectionException $e) {
                return redirect()->to(current_url())->with('error', $e->getMessage());
            }
        }

        return $this->_renderPage('Plans/create', $this->data);
    }

    public function edit($id)
    {
        $model = new \App\Models\Plans();
        $plan = $model->find($id);

        if (empty($plan)) {
            return redirect()->back()->with('error', "Plan does not exist");
        }

        if ($this->request->getPost()) {
            try {
                if ($model->save($this->request->getPost())) {
                    return redirect()->to(current_url())->with('success', "Plan saved successfully");
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

    public function delete($id)
    {

    }
}
