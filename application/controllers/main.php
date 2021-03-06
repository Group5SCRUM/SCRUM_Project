 <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class Main extends CI_Controller {
  
     function __construct()
     {
         parent::__construct();
  
         /* Standard Libraries of codeigniter are required */
         $this->load->database();
         $this->load->helper('url');
         /* ------------------ */ 
  
         $this->load->library('grocery_CRUD');
  
     }
  
     public function index()
     {
         echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
                 die();
     }

     function encrypt_pw($post_array) {
        if (!empty($post_array['custPassword'])) {
               $post_array['custPassword'] = SHA1($_POST['custPassword']);
           }//if
       return $post_array;
   }//function


     public function employees()
     {
         $crud = new grocery_CRUD();
         $crud->set_table('employees');
         $output = $crud->render();
  
         $this->_example_output($output);        
     }
		
     public function Visits() //PHP CODE FOR VISITS
     {
         $crud = new grocery_CRUD();
         $crud->set_table('Visits');
         $crud -> columns('visit_ID','visit_date','visit_doctor','visit_FEV');
         $crud -> display_as('visit_ID','Visit ID');
							
         $crud -> display_as('visit_date','Visit Date');
							
         $crud -> display_as('visit_doctor','Visit Doctor');
							
         $crud -> display_as('visit_FEV','FEV');//NEED TO MULTI-VALUE FEV
         $output = $crud->render();
  
         $this->_example_output($output);        
     }
     Public function patients ()
     {
	$crud = new grocery_CRUD();
        $crud -> set_table('patients'); 
        $crud -> set_subject('Patients');
	$crud -> columns(p_firstName,p_lastName,p_gender, p_birthday, p_diabetes,p_otherconds,);
	$crud -> display_as('p_firstName','Patient First Name');
        $crud -> set_rules('p_firstName','Patient First Name','htmlspecialchars|required|min_length[2]|max_length[30]');

        $crud -> display_as('p_lastName','Patient Last Name');
        $crud -> set_rules('p_lastName','Patient Last Name','htmlspecialchars|required|min_length[2]|max_length[30]');

	$crud -> display_as('p_birthday','Patient Birthday (mm/dd/yyy)');
	$crud -> set_rules('p_birthday','Patient Birthday (mm/dd/yyy)','htmlspecialchars|required|min_length[10]|max_length[10]');
	     
	$crud -> display_as('p_gender', 'Patient Gender');
	$crud->field_type('p_gender','dropdown', array('1' => 'Male', '2' => 'Female', '3' => 'Prefer not to say''));

	$crud -> display_as('p_diabetes', 'Diabetes');
	$crud->field_type('p_diabetes','dropdown', array('1' => 'No', '2' => 'Type I', '3' => 'Type II''));
	
	$crud -> display_as('p_otherconds', 'Other Conditions');

	$crud->unset_delete();
        $crud->unset_clone();

        $output = $crud->render();
        $output -> title = "Patients";
        $this->_example_output($output);
     }
     public function customers()
    {
        $crud = new grocery_CRUD();
        $crud -> set_table('customers'); 
        $crud -> set_subject('Customer');
        $crud -> columns('custName','email');
        $crud -> display_as('custName','Customer Name');
        $crud -> set_rules('custName','Customer Name','htmlspecialchars|required|min_length[2]|max_length[30]');

        $crud -> display_as('email','Customer Email');
        $crud -> set_rules('email','Customer Email','htmlspecialchars|required|valid_email|min_length[2]|max_length[30]');
        
        $crud -> display_as('custPassword','Customer Password');
        $crud -> required_fields('custName','email');
        $crud -> field_type('custPassword','password');

        $crud -> callback_before_insert(array($this, 'encrypt_pw'));
        $crud -> unset_delete();
        $crud -> unset_clone();
        $output = $crud->render();
        $output -> title = "Customers";
        $this->_example_output($output);
	  
    }
  
     function _example_output($output = null)
  
     {
         $this->load->view('our_template.php',$output);    
     }
 }
  
 /* End of file Main.php */
 /* Location: ./application/controllers/Main.php */
  
?>
