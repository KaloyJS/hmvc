<?php
class Backend_model extends MY_Model {

        public $title;
        public $content;
        public $date;

        public function get_last_ten_entries()
        {
           $query = $this->db->get('PRODUCTIVITY_PRODUCTION_REPORT', 10);
                
			return $query->result_array();
         
        }

        // public function insert_entry()
        // {
                // $this->title    = $_POST['title']; // please read the below note
                // $this->content  = $_POST['content'];
                // $this->date     = time();
// user , id , pass
// $data['user'] = 'sfsf';
// $data['id'] = 'sfsf';
// $data['pass'] = 'sfsf';

                // $this->db->insert('entries', $data);
                // $this->db->query('');
        // }

        // public function update_entry()
        // {
                // $this->title    = $_POST['title'];
                // $this->content  = $_POST['content'];
                // $this->date     = time();

                // $this->db->update('entries', $this, array('id' => $_POST['id']));
        // }

}
?>