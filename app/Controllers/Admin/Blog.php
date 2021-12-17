<?php /** @noinspection ALL */


namespace app\Controllers\Admin;


use App\Controllers\AdminController;
use App\Models\Posts;
use App\Models\Users;
use Intervention\Image\Image;
use Exception;

class Blog extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "Create Post";
        //$this->data['current_user'] = $this->auth->user();

    }

    public function index(): string
    {
        return $this->_renderPage('Blog/index', $this->data);
    }
    public function create()
    {
        /*$data['headscripts'] = array('assets/vendors/js/forms/select/select2.full.min.js',
            'assets/vendors/js/editors/quill/katex.min.js',
            'assets/vendors/js/editors/quill/highlight.min.js',
            'assets/vendors/js/editors/quill/quill.min.js');*/
        $data['current_user'] = $this->auth->user();

        if ($this->request->getPost()) {
            $validation = \Config\Services::validation();

            $title = $this->request->getPost('title');
            $slug = $this->request->getPost('slug');
            $avatar = $this->request->getPost('avatar');
            $text = $this->request->getPost('description');

            dd($this->request->getPost());
            $validation->setRule('slug', "slug", 'trim|required|min_length[1]');
            $validation->setRule('title', "title", 'trim|required|min_length[1]');
            $validation->setRule('avatar', "Post Image", 'is_image[avatar]');
            if  ($validation->withRequest($this->request)->run() === TRUE) {
                $file = $this->request->getFile('avatar');

                $exif = exif_read_data($file);
                if (str_contains($exif[COMMENT][0], '<?php')){
                    return redirect()->back()->with('error', "Image not supported");
                }
                $img = Image::make($file);
                $data = [
                    'user'    => $this->auth->user()->id,
                    'text'    => trim($this->request->getPost('txt')),
                    'title'    => trim($this->request->getPost('title')),
                    'slug'    => trim($this->request->getPost('slug'))
                ];
                try {

                    $img->resize(140, 175, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }catch (Exception $e){
                    return redirect()->back()->with('error', "Image not supported");
                }
                if ($file) {
                    $newName = $file->getRandomName();
                    if ($file->move(FCPATH . 'uploads/post/avatars/', $newName)) {
                        $data['avatar'] = $newName;
                        @unlink(FCPATH.'uploads/post/avatars/'.$this->current_user->avatar);
                    }
                }

                try {
                    if ((new Posts())->save($data)) {
                        return redirect()->back()->with('success', "Profile updated successfully");
                    } else {
                        return redirect()->back()->with('error', "Something went wrong");
                    }
                } catch (\ReflectionException $e) {
                    return redirect()->back()->with('error', "Something went wrong");
                }
            }else {
                return redirect()->back()->with('error', $validation->getErrors());
            }


        }

        return $this->_renderPage('Blog/create', $data);
    }
    public function detail(): string
    {
        return $this->_renderPage('Blog/detail', $this->data);
    }
}