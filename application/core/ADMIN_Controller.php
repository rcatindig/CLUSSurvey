<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ADMIN_Controller extends CI_Controller {

	/**
	 * '*' all user
	 * '@' logged in user
	 * 'Admin' for admin
	 * 'Editor' for editor group
	 * 'Author' for author group
	 * @var string
	 */
	protected $access = "*";

	public function __construct()
	{
		parent::__construct();


		$this->login_check();

	}

	public function login_check()
	{

		if ($this->access != "*") 
		{


			// here we check the role of the user
			// if (! $this->permission_check()) {
				//die("<h4>Access denied</h4>");
			// } 

			// if user try to access logged in page
			// check does he/she has logged in
			// if not, redirect to login page
			// if (! $this->session->userdata("logged_in")) {
				// redirect( base_url(). "admin/auth");
			// }
		}
	}

	public function permission_check()
	{
		if ($this->access == "@") {
			return true;
		}
		else
		{
			$access = is_array($this->access) ? 
				$this->access :
				explode(",", $this->access);
			if (in_array($this->session->userdata("role"), array_map("trim", $access)) ) {
				return true;
			}

			return false;
		}
	}

	protected function file_upload($id, $folder)
	{
	    $album = strtolower($folder) . '/' . $id;

	    $upload_config = array('upload_path' => './uploads/' . $album, 'allowed_types' =>
	        'jpg|jpeg|gif|png', 'max_size' => '2000', 'max_width' => '680', 'max_height' =>
	        '435', );

	    $this->load->library('upload', $upload_config);

	    // create an album if not already exist in uploads dir
	    // wouldn't make more sence if this part is done if there are no errors and right before the upload ??
	    if (!is_dir('uploads'))
	    {
	        mkdir('./uploads', 0777, true);
	    }
	    $dir_exist = true; // flag for checking the directory exist or not
	    if (!is_dir('uploads/' . $album))
	    {
	        mkdir('./uploads/' . $album, 0777, true);
	        $dir_exist = false; // dir not exist
	    }
	    else{

	    }

	    if (!$this->upload->do_upload('imgfile'))
	    {
	        // upload failed
	        //delete dir if not exist before upload
	        if(!$dir_exist)
	          rmdir('./uploads/' . $album);	      	

	        return array('error' => $this->upload->display_errors('<span>', '</span>'));
	    } else
	    {
	        // upload success
	        $upload_data = $this->upload->data();
	        return true;
	    }
	}

	//file upload function
    protected function upload_file($file, $allowed_types, $path, $file_name = NULL)
    {
        //set preferences

    	if (!is_dir($path)) {
    		$old_umask = umask(0);;
		    mkdir("./".$path, 0777, true);
		    umask($old_umask);
		    
		}



        $config['upload_path'] = $path;
        $config['allowed_types'] = $allowed_types;
        //$config['max_size']    = '100';

        
       
       	if (!EMPTY($file_name))
       	{
       		$config['file_name'] = $file_name;
       	}
		

        //load upload class library
        //$this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload($file))
        {
            // case - failure
            $upload_error = array('error' => $this->upload->display_errors());
            throw new Exception("Error in Uploading");
            
            //$this->load->view('upload_file_view', $upload_error);
            var_export($upload_error);
        }
        else
        {
            // case - success
            $upload_data = $this->upload->data();

            return $upload_data["file_name"];
            // $data['success_msg'] = '<div class="alert alert-success text-center">Your file <strong>' . $upload_data['file_name'] . '</strong> was successfully uploaded!</div>';
            /// $this->load->view('upload_file_view', $data);
        }


    }
}