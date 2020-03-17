<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jabatan extends CI_Controller {
    private $resutl;
 	function __construct() {
        parent::__construct();
       
        $this->load->library('lib_util');
        $this->load->library('lib_form');

        $this->load->library('grid');
       
    }

	public function index(){
		//$this->load->view('view_jabatan');

		$grid = new Grid;		
        $grid->setTitle('Master Instansi');
        $grid->setTable('simen.ms_instansi');		
        $grid->setUrl('jabatan');
        $grid->addList('iInstansiId','vInstansiName','tCreated','status');
        $grid->setSortBy('vInstansiName');
        $grid->setSortOrder('ASC'); //sort ordernya
		
        $grid->addFields('vInstansiName');

        $grid->setLabel('iInstansiId', 'Instansi ID'); //Ganti Label
		$grid->setWidth('iInstansiId', '80'); // width nya
        $grid->setAlign('iInstansiId', 'center'); // align nya


        $grid->setLabel('vInstansiName', 'Instansi Name'); //Ganti Label
		$grid->setWidth('vInstansiName', '250'); // width nya
        $grid->setAlign('vInstansiName', 'left'); // align nya

        $grid->setSearch('vInstansiName','iInstansiId');

        $resutl = $grid->render_grid();
        //print_r($resutl);

        $this->resutl = $resutl;
        $this->load->view('view_grid',$resutl);	

	}

    function getData(){
        
        $html = '<table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr style="white-space: nowrap;">
                <th width="10px" >No</th>
                <th >Instansi Name</th>';

        $html .='</tr>
            </thead>
            <tbody>';




        echo $html;
        return $html;

    }

    function ambil_data(){


        /*Menagkap semua data yang dikirimkan oleh client*/

        /*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
        server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
        sesuai dengan urutan yang sebenarnya */
        $draw=$_REQUEST['draw'];

        /*Jumlah baris yang akan ditampilkan pada setiap page*/
        $length=$_REQUEST['length'];

        /*Offset yang akan digunakan untuk memberitahu database
        dari baris mana data yang harus ditampilkan untuk masing masing page
        */
        $start=$_REQUEST['start'];

        /*Keyword yang diketikan oleh user pada field pencarian*/
        $search=$_REQUEST['search']["value"];


        /*Menghitung total desa didalam database*/
        $total=$this->db->count_all_results("villages");

        /*Mempersiapkan array tempat kita akan menampung semua data
        yang nantinya akan server kirimkan ke client*/
        $output=array();

        /*Token yang dikrimkan client, akan dikirim balik ke client*/
        $output['draw']=$draw;

        /*
        $output['recordsTotal'] adalah total data sebelum difilter
        $output['recordsFiltered'] adalah total data ketika difilter
        Biasanya kedua duanya bernilai sama, maka kita assignment 
        keduaduanya dengan nilai dari $total
        */
        $output['recordsTotal']=$output['recordsFiltered']=$total;

        /*disini nantinya akan memuat data yang akan kita tampilkan 
        pada table client*/
        $output['data']=array();


        /*Jika $search mengandung nilai, berarti user sedang telah 
        memasukan keyword didalam filed pencarian*/
        if($search!=""){
        $this->db->like("name",$search);
        }


        /*Lanjutkan pencarian ke database*/
        $this->db->limit($length,$start);
        /*Urutkan dari alphabet paling terkahir*/
        $this->db->order_by('name','DESC');
        $query=$this->db->get('villages');


        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
        dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
        yang mengandung keyword tertentu
        */
        if($search!=""){
        $this->db->like("name",$search);
        $jum=$this->db->get('villages');
        $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }


        $nomor_urut=$start+1;
        foreach ($query->result_array() as $desa) {
            $output['data'][]=array($nomor_urut,$desa['name']);
        $nomor_urut++;
        }

        echo json_encode($output);


    }



}
?>