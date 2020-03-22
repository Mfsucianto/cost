</div><!-- /.content-wrapper -->

<footer class="main-footer">
    
    
</footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/slimScroll/jquery.slimScroll.min.js') ?>" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?php echo base_url('assets/AdminLTE-2.0.5/plugins/fastclick/fastclick.min.js') ?>'></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/app.min.js') ?>" type="text/javascript"></script>

<!-- DataTables -->


<script src="<?php echo base_url('assets/datatables.net/js/jquery.dataTables.min.js') ?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/dataTables.fixedColumns.min.js') ?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/js/number_format.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/autoNumeric.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/bootstrap-datepicker.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/select2.full.min.js') ?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/js/sweetalert2.min.js') ?>" type="text/javascript"></script>

<script >
	$(function () {
    	$('.select2').select2({
    		placeholder: "--select--",
    		allowClear: true
    	});


    	$('.datepicker').datepicker({
    		format: 'dd-mm-yyyy',
            autoclose : true,
            todayHighlight : true
        });

    	$('[data-toggle="tooltip"]').tooltip()
    	function stripTrailingSlash(str) {
		    if(str.substr(-1) == '/') {
		      return str.substr(0, str.length - 1);
		    }


		    return str;
		  }

		  var url = window.location;  
		  var activePage = url;

		  $('.sidebar-menu li a').each(function(){  
		    var currentPage = stripTrailingSlash($(this).attr('href')); 
		    if (activePage == currentPage) {
		      $(this).parent().addClass('active');
		     
		    }


		    /*var url = window.location;
	        // Will only work if string in href matches with location
	        $('.treeview-menu li a[href="' + url + '"]').parent().addClass('active');
	        // Will also work for relative and absolute hrefs
	        $('.treeview-menu li a').filter(function() {
	            return this.href == url;
	        }).parent().parent().parent().addClass('active');*/


		  });


	});

	

	

	function custom_alert(message1='',message2='',type='info',element='') {
		//Swal.fire(message1,message2,type)
		Swal.fire({
			title: message1,
            icon: type,
            text: message2,
            confirmButtonColor: "#009616",
            confirmButtonText: "Ok",
            onAfterClose: () => {
			    $('#'+element).focus()
			  }
		})
	}

	function stripCharacters(str) {
		str = str.replace(',','');
		str = str.replace(',','');
		str = str.replace(',','');
		str = str.replace(',','');
		str = str.replace(',','');
		str = str.replace(',','');
		return str;
	}

	function addCommas(nStr){
			nStr += '';
			x = nStr.split('.');
			x1 = x[0];
			x2 = x.length > 1 ? '.' + x[1] : '';
			var rgx = /(\d+)(\d{3})/;
			while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + ',' + '$2');
			}
			return x1 + x2;
	}

	function terbilang(bilangan){

	    var kalimat="";
	    var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
	    var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
	    var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');
	    bilangan = bilangan.toString();

	    var panjang_bilangan = bilangan.length;
	    /* pengujian panjang bilangan */
	    if(panjang_bilangan > 15){
	        kalimat = "-";
	    }else{
	        /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
	        for(i = 1; i <= panjang_bilangan; i++) {
	            angka[i] = bilangan.substr(-(i),1);
	        }
	         
	        var i = 1;
	        var j = 0;
	         
	        /* mulai proses iterasi terhadap array angka */
	        while(i <= panjang_bilangan){
	            subkalimat = "";
	            kata1 = "";
	            kata2 = "";
	            kata3 = "";
	             
	            /* untuk Ratusan */
	            if(angka[i+2] != "0"){
	                if(angka[i+2] == "1"){
	                    kata1 = "Seratus";
	                }else{
	                    kata1 = kata[angka[i+2]] + " Ratus";
	                }
	            }
	             
	            /* untuk Puluhan atau Belasan */
	            if(angka[i+1] != "0"){
	                if(angka[i+1] == "1"){
	                    if(angka[i] == "0"){
	                        kata2 = "Sepuluh";
	                    }else if(angka[i] == "1"){
	                        kata2 = "Sebelas";
	                    }else{
	                        kata2 = kata[angka[i]] + " Belas";
	                    }
	                }else{
	                    kata2 = kata[angka[i+1]] + " Puluh";
	                }
	            }
	             
	            /* untuk Satuan */
	            if (angka[i] != "0"){
	                if (angka[i+1] != "1"){
	                    kata3 = kata[angka[i]];
	                }
	            }
	             
	            /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
	            if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")){
	                subkalimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
	            }
	             
	            /* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
	            kalimat = subkalimat + kalimat;
	            i = i + 3;
	            j = j + 1;
	        }
	         
	        /* mengganti Satu Ribu jadi Seribu jika diperlukan */
	        if ((angka[5] == "0") && (angka[6] == "0")){
	            kalimat = kalimat.replace("Satu Ribu","Seribu");
	        }
	    }

	    
    	return kalimat;
	}

</script>






