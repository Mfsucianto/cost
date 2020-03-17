<?php


$this->load->view('template/head');
//$this->load->view('template/topbar');
//$this->load->view('template/sidebar');

//$this->load->library('lib_util');


$colNames = buildColName($theList);
$colModel = buildColModel($theList);

$set_columns = array();
foreach($theList as $tl) {
    $ttype = isset($tl['type']) ? $tl['type'] : '';
   
    $set_columns[$tl['field']] = array(
                        'label' => $tl['label'],
                        'name' => $tl['field'],
                        'width' => $tl['width'],
                        'align' => $tl['align'], 
                        'search' =>$tl['search'],
                        'title' =>$tl['title'],
                        'sortable' =>$tl['sortable'],
                        'type' => $ttype,
                        'frozen'=>0,
                    );
};



    //print_r($theList);

    $x = $this->lib_util->getSysparam('anto');

    $this->lib_form->load_form_search($title,$theList,$url);
    $this->lib_form->load_form_list($title,$theList,$url);

function buildColName($theList){
    $ColName = array();
    foreach ($theList as $key => $value) {
      foreach ($value as $k => $v) {
         
          if ($k=='label'){
            if ($v !=''){
                $ColName[] = $v;
            }else{
                $ColName[] = $k;
            }
          }
      }
   }

  
   return json_encode($ColName);
}


function buildColModel($columns){
    
}

?>


<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script src="<?php echo base_url('assets/js/simpleupload.js') ?>" type="text/javascript"></script>
<?php
$this->load->view('template/foot');
?>

<script type="text/javascript">
    
     $(document).ready(function() {
         refreshData();
    });


    function refreshData(){
        var url = "<?php echo site_url() ?>";
        var data = loadData();
        $('#isi_table').html(data);
        //$('#example1').DataTable();

       
        $("#example").DataTable({
            ordering: false,
            processing: true,
            serverSide: true,
            ajax: {
              url: url+'/<?php echo $url; ?>/ambil_data',
              type:'POST',
            }
        });
    }

    function loadData(){
        var url = "<?php echo site_url() ?>";
        return $.ajax({
            type: 'POST', 
            url: url+'/<?php echo $url; ?>/getData',
            async:false
        }).responseText
    }
</script>