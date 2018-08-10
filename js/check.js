// JavaScript Document
$(function(){
	
	var x=101,
	 fx=000,
	 r='<img src="../images/content/loading.gif"> Processing',
	 ra='<img src="../images/content/loading.gif"> Processing',
	 c='<img src="../images/content/accept.png">',
	 cdata=new Array();

	 var response;
	
	login=function(e){
		e.preventDefault();
		var pwd=$('#pwd').val(),
		usr=$('#usr').val(),
		url=$(this).closest('form').attr('action');
		$('#feedback').html('<center>'+r+'</center>');
		$.post(url,{'usr':usr,'pwd':pwd},function(data){
			if(data==x){
				window.location='index.php?q=portalentry';
			}else{
				$('div #feedback').html(data);
				}
			});
		
		} 
	
	reg_lec=function(e){

		e.preventDefault();
		
		var fname=$('#fname').val(),
		pass=$('#pass').val(),
		email=$('#email').val(),
		sex=$('#sex').val(),
		
		url=$(this).closest('form').attr('action');
		
		$('#modal1').css({'display':'block'});
		$("modal1 p button").hide();

		$.post(url,{'fname':fname,'pass':pass,'email':email,'sex':sex,'addid':1},function(data){
			
				if(data==x){

					$('#modal1 p cc').html('<center>'+c+' Account Created');
					$("modal1 p button").show();	
					
					$('form').reset();

				}else{

					$('#modal1 p cc').html(data);
					$("modal1 p button").show();	
					
				
				}
	
			});
		}	
	
	reg_cos=function(e){

		e.preventDefault();
		
		var costitle=$('#costitle').val(),
		coscode=$('#coscode').val(),
		cosunit=$('#cosunit').val(),
			
		url=$(this).closest('form').attr('action');
		
		$('#modal1').css({'display':'block'});
		$("modal1 p button").hide();

		$.post(url,{'costitle':costitle,'cosunit':cosunit,'coscode':coscode,'addid':2},function(data){
			
				if(data==x){

					$('#modal1 p cc').html('<center>'+c+' New Course Added');
					$("modal1 p button").show();	
					
					$('form').reset();

				}else{

					$('#modal1 p cc').html(data);
					$("modal1 p button").show();	
					
				
				}
	
			});
		}

	assign_lec={

		loadcoursesintoarray:function(e){

		e.preventDefault();
		
		var url='../resource/controller/retrieve.php';
		
		if (typeof(cdata)!='undefined') {

		
				$('#modal1').css({'display':'block'});
				if ($('#modal1 button').is(':hidden')) {

					$('#modal1 button').show('fast');
				}

				$.post(url,{'retrieveid':1},function(data){
					$('#modal1 cc').html('');
					$('#modal1 form oo').html(data);
					
				});

			}else{
		
				alert('Please Select At least a Course');
		
			}
		},

		maploadedcourse:function(e){
			e.preventDefault();

			var url = $(this).closest('form').attr('action'),
			selected_lec = $("input[name='assign_lec_id']:checked").val();
			
			if(typeof(selected_lec)!='undefined'){

				$($("input[name='assign_cos_id[]']:checked")).each(function(){
					cdata.push($(this).val());
				});

				$.post(url,{'assign_cos_id':cdata,'assign_lec_id':selected_lec,'addid':3},function(data){

					if (data == x) {

						$('#modal1 form button').hide('fast');
					
						$.post('../resource/controller/retrieve.php',{'retrieveid':2},function(data){
						
							$('form#courselist ee').html(data);

							cdata=Array();

						});

						$('#modal1 cc').html('<center>'+c+' Successfully Assigned Course');

					}else{
						$('#modal1 p cc el').html(data);
					}
				});
			}else{
				alert("Please Choose A Lecturer");
			}
		},

		unassign_course:function(e){

			var url='../resource/controller/update.php',
			cos_id=$(this).data('cos_id');

			$.post(url,{ 'upid':12 , 'cos_id':cos_id },function(response){
				
				//alert(response);

				if (response == x) {

					$('#modal1 p#feedback').html('<center>'+c+' Successfully Unassigned Course');
				
				}else{

					$('#modal1 p#feedback').html(response);

				}
			});

		}

	}	

	attachimg=function(event){
		
			event.preventDefault();
			var url=$(this).closest('form').attr('action');
			$.post(url,{'addid':2},function(data){

				
					$("#imgpreview").append('<img src='+data+' width="auto" height="90px">');
					$("#feedback").html("");
			
			});

		} 	
			

	autoupdate_scoresheet={

		compute_test_vals:function(e){
			
			e.preventDefault();
			
			var url='../resource/controller/update.php',
			test_vals=$(this).val(),
			cur_row=$(this).data('row'),
			matric=$(this).data('matric'),
			cos=$(this).data('cos');
			
				$(this).next('rr').html('<img src="../images/content/loading.gif" width="10px" height="auto">');

				$.post(url,{ 'test':test_vals, 'matric':matric, 'cos':cos, 'upid':1 },function(data){

					if (data==x) {
						
						//autoupdate_scoresheet.recompute_grade({'m':matric, 'c':cos});
					}else{
						alert('Oops! Unable to Update Server');
					}

				});

				$(this).next('rr').html('');
				
		},

		compute_ca_vals:function(e){
			
			e.preventDefault();
			
			var url='../resource/controller/update.php',
			ca_vals=$(this).val(),
			cur_row=$(this).data('row'),
			matric=$(this).data('matric'),
			cos=$(this).data('cos');

			if (typeof(ca_vals) != 'undefined') {

				$(this).next('rr').html('<img src="../images/content/loading.gif" width="10px" height="auto">');

				$.post(url,{ 'ca':ca_vals, 'matric':matric, 'cos':cos, 'upid':2 },function(data){

					if (data==x) {
						//autoupdate_scoresheet.recompute_grade({'m':matric, 'c':cos});
					}else{
						alert('Oops! Unable to Update Server');
					}

				});

				$(this).next('rr').html('');

			}else{
				return null;
			}
		},

		compute_exam_vals:function(e){
			
			e.preventDefault();

			var url='../resource/controller/update.php',
			exam_vals=$(this).val(),
			cur_row=$(this).data('row'),
			matric=$(this).data('matric'),
			cos=$(this).data('cos');

			if (typeof(exam_vals) != 'undefined') {

				$(this).next('rr').html('<img src="../images/content/loading.gif" width="10px" height="auto">');

				$.post(url,{ 'exam':exam_vals, 'matric':matric, 'cos':cos, 'upid':3 },function(data){

					if (data==x) {
						//autoupdate_scoresheet.recompute_grade({matric, cos});
					}else{
						alert('Oops! Unable to Update Server');
					}

				});

				$(this).next('rr').html();

			}else{
				return null;
			}
		},

		recompute_grade:function(e){
			
			//e.preventDefault();
			var url='../resource/controller/update.php',
			row=$(this).data('row');
			matric=$(this).data('matric'),
			cos=$(this).data('cos');
			var process3;

				$(this).next('rr').html('<img src="../images/content/loading.gif" width="10px" height="auto">');
//$('*').off();
				

				/*var process3 =	$.post(url,{ 'matric':matric, 'cos':cos, 'upid':4 }, function(response){
					
					return response;				
					
					});*/		
					
				

				process3=$.ajax({
					
					type: 'POST',
					global: false,
					url:'../resource/controller/update.php',
					async : false,
					global :false,
					data : { 'matric':matric, 'cos':cos, 'upid':4 },
					
					success: function(data){
						return data;

					}

					}).responseText;
				
				
				//console.log(process3);

				if(process3==fx) {

						alert("Total score can't exceed 100");	
						$(this).next('rr').html('');

					}else{
						
						$(this).next('rr#rr').html(process3);
					
					}
		}

	}


	carry_over_autoupdate_scoresheet={

		compute_test_vals:function(e){
			
			e.preventDefault();
			
			var url='../resource/controller/update.php',
			test_vals=$(this).val(),
			cur_row=$(this).data('row'),
			matric=$(this).data('matric'),
			cos=$(this).data('cos');
			
			//alert(test_vals);
				$(this).next('rr').html('<img src="../images/content/loading.gif" width="10px" height="auto">');

				$.post(url,{ 'ctest':test_vals, 'matric':matric, 'cos':cos, 'upid':5 },function(data){

					if (data==x) {
						
						//autoupdate_scoresheet.recompute_grade({'m':matric, 'c':cos});
					}else{
						alert('Oops! Unable to Update Server');
					}

				});

				$(this).next('rr').html('');
				
		},

		compute_ca_vals:function(e){
			
			e.preventDefault();
			
			var url='../resource/controller/update.php',
			ca_vals=$(this).val(),
			cur_row=$(this).data('row'),
			matric=$(this).data('matric'),
			cos=$(this).data('cos');
//alert(ca_vals);
			if (typeof(ca_vals) != 'undefined') {

				$(this).next('rr').html('<img src="../images/content/loading.gif" width="10px" height="auto">');

				$.post(url,{ 'cca':ca_vals, 'matric':matric, 'cos':cos, 'upid':6 },function(data){

					if (data==x) {
						//autoupdate_scoresheet.recompute_grade({'m':matric, 'c':cos});
					}else{
						alert('Oops! Unable to Update Server');
					}

				});

				$(this).next('rr').html('');

			}else{
				return null;
			}
		},

		compute_exam_vals:function(e){
			
			e.preventDefault();

			var url='../resource/controller/update.php',
			exam_vals=$(this).val(),
			cur_row=$(this).data('row'),
			matric=$(this).data('matric'),
			cos=$(this).data('cos');

			if (typeof(exam_vals) != 'undefined') {

				$(this).next('rr').html('<img src="../images/content/loading.gif" width="10px" height="auto">');

				$.post(url,{ 'cexam':exam_vals, 'matric':matric, 'cos':cos, 'upid':7 },function(data){

					if (data==x) {
						//autoupdate_scoresheet.recompute_grade({matric, cos});
					}else{
						alert('Oops! Unable to Update Server');
					}

				});

				$(this).next('rr').html();

			}else{
				return null;
			}
		},

		recompute_grade:function(e){
			
			//e.preventDefault();
			var url='../resource/controller/update.php',
			row=$(this).data('row');
			matric=$(this).data('matric'),
			cos=$(this).data('cos');
			var process3;

				$(this).next('rr').html('<img src="../images/content/loading.gif" width="10px" height="auto">');
//$('*').off();
				

				/*var process3 =	$.post(url,{ 'matric':matric, 'cos':cos, 'upid':4 }, function(response){
					
					return response;				
					
					});*/		
					
				

				process3=$.ajax({
					
					type: 'POST',
					global: false,
					url:'../resource/controller/update.php',
					async : false,
					global :false,
					data : { 'matric':matric, 'cos':cos, 'upid':8 },
					
					success: function(data){
						return data;

					}

					}).responseText;
				
				
				//console.log(process3);

				if(process3==fx) {

						alert("Total score can't exceed 100");	
						$(this).next('rr').html('');

					}else{
						
						$(this).next('rr#rr').html(process3);
					
					}
		}

	}

	tableToExcel = (function() {
		var uri = 'data:application/vnd.ms-excel;base64,'
    	, template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    	, base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    	, format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  		return function(table, name) {
    	if (!table.nodeType) table = document.getElementById(table)
    	var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    	window.location.href = uri + base64(format(template, ctx))
  		}
		})()


	process_result={

		
		forward_result:function(e){

			var url='../resource/controller/update.php',
			cos_id=$(this).data('cos');

			$('#modal1').css({'display':'block'});

			$.post(url,{'cos':cos_id, 'upid':9 },function(response){

				if (response==x) {

					//window.tableToExcel('iscoresheet','Score Sheet');
					$('#modal1 p cc').html('<center>'+c+' Score sheet has being forwareded For Validation, ALSO Backup for retrieval');
					
					//var f_url='../resource/controller/retrieve.php';
					
					$('div table').html('Scoresheet Already Forwarded');

					$("modal1 p button").show();

					
				}else{
					alert(response);
				}
				
			});
		},
		
		return_result:function(e){

			var url='../resource/controller/update.php',
			cos_id=$(this).data('cos');

			$('#modal1').css({'display':'block'});

			$.post(url,{'cos':cos_id, 'upid':10 },function(response){

				if (response==x) {

					$('#modal1 p cc').html('<center>'+c+' Score sheet Has Been Returned for Processing');
					
					$('div table').eq(0).html('Scoresheet Returned');

					$("modal1 p button").show();

					
				}else{

					$('#modal1').css({'display':'none'});

					alert(response);
				}
				
			});	
		},

		validate_result:function(e){

			var url='../resource/controller/update.php';
		},

		export_to_excel:function(){

			var table_id=$(this).data('tableid');
			window.tableToExcel(table_id,'Score Sheet');
		}


	}

	course={

		delete_course:function(e){

		var cos_id=$(this).data('course');

		$.post('../resource/controller/delete.php',{'deleteid':1, 'cos_id':cos_id}, function(data){

			if (data == x) {

				$.post('../resource/controller/retrieve.php',{'retrieveid':6},function(data){

					$('oo').html(data);

				});
			}else{
				alert(data);
			}
		});

		},

		open_modal_update_course:function(e){

			var cos_id=$(this).data('course'),
			url='../resource/controller/retrieve.php';

			$('#modal1').css({'display':'block'});

			$.post(url,{ 'retrieveid':7, 'cos_id':cos_id },function(data){

				$('div#modal1 cc').html(data);
			});
		},

		update_course:function(e){

			e.preventDefault();
			var url = $(this).closest('form').attr('action'),
		
			costitle=$('#costitle').val(),
			coscode=$('#coscode').val(),
			cosunit=$('#cosunit').val(),
		
			cos_id = $(this).data('course');
			
			$('#feedback').html(ra);

			$.post(url,{'costitle':costitle,'cosunit':cosunit,'coscode':coscode, 'cos_id': cos_id, 'upid': 11},function(response){
				
				if (response == x) {
					
					$('#feedback').html('<center>'+c+' Course info. Updated');

					/*$.post('../resource/controller/retrieve.php',{'retrieveid':6},function(response){
						$('oo').html(response);
					});*/

					

				}else{
					alert(response);
				}
			});
		},

		load_course_info_into_modal:function(){

			var cos_key = $(this).data('cos_id');

			url='../resource/controller/retrieve.php';

			$('#modal1').css({'display':'block'});

			$.post(url,{ 'retrieveid':8, 'cos_id':cos_key },function(data){
				
				$('#modal1 p#feedback').html('');
				$('div#modal1 cc').html(data);

			});
		}
	}

	

	load_news_into_editor=function(event){

		    var id=$("#news").val();
		    
          	$.post('../resource/controller/retrieve.php',{'retrieveid':5,'id':id},function(data){

          		CKEDITOR.instances["context"].setData(data);

          	});

	}


	

/************************End Function*****************************************/


/* **********************|Binders|****************************************** */
	
	$('#btnlogin').bind('click',login);
	$('#reg_lec').bind('click',reg_lec);
	$('#reg_cos').bind('click',reg_cos);
	
	$('button#btn_assign_lec_f_stage').bind('click',assign_lec.loadcoursesintoarray);
	$('button#btn_assign_lec_s_stage').bind('click',assign_lec.maploadedcourse);
	$('cc').on('click','button#btn_assign_lec_se_stage',assign_lec.unassign_course);

	//$('#pfile').bind('change',pfile);
	//$('#hfile').bind('change',hfile);
	
	$('input#test').bind('keyup',autoupdate_scoresheet.compute_test_vals);
	$('input#ca').bind('keyup',autoupdate_scoresheet.compute_ca_vals);
	$('input#exam').bind('keyup',autoupdate_scoresheet.compute_exam_vals);
	$('i#get_grade').bind('click',autoupdate_scoresheet.recompute_grade);

	$('input#ctest').bind('keyup',carry_over_autoupdate_scoresheet.compute_test_vals);
	$('input#cca').bind('keyup',carry_over_autoupdate_scoresheet.compute_ca_vals);
	$('input#cexam').bind('keyup',carry_over_autoupdate_scoresheet.compute_exam_vals);
	$('i#cget_grade').bind('click',carry_over_autoupdate_scoresheet.recompute_grade);
	
	$('#btnforwardresult').bind('click',process_result.forward_result);
	$('button#btnreturnresult').bind('click',process_result.return_result);
	$('button#btnprocessresult').bind('click',process_result.validate_result);

	$('button#btnexportresult').bind('click',process_result.export_to_excel);
	
	$('a#delete_course').on('click',course.delete_course);
	$('a#update_course').on('click',course.open_modal_update_course);
	$('cc').on('click','button#btn_update_cos',course.update_course);
	$('a#cos_info').bind('click',course.load_course_info_into_modal);
	
	
	//$('#sbattachstate').bind('click',attachstate);
	//$('#sbattachlga').bind('click',attachlga);
	//$('#filteradmin').bind('keyup',filter_admin);
	//$('#filterfans').bind('keyup',filter_fans);
	//$('#filterapplicants').bind('keyup',filter_applicants);
	//$('a#extend_right').bind('click',extend_right);
	//$('a#loadcontext').bind('click',load_context_into_editor);
	//$('#sbeditcontext').bind('click',update_context);
	//$('a#loadnews').bind('click',load_news_into_editor);
	//$('#sbeditnews').bind('click',update_news);
	//$('#country').bind('click change',country_check);
	//$('#sbcreatesector').bind('click',create_download_sectors);


	
	
	
});