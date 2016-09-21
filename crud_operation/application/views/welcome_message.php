<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>"/>
	<link rel="stylesheet" href="<?php echo base_url('css/dataTables.bootstrap.min.css') ?>"/>
	<style type="text/css">
		body{
			padding-top: 50px;
		}
	</style>
	<script src="<?php echo base_url('js/jquery-2.2.3.min.js') ?>"></script>
	<script src="<?php echo base_url('js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('js/jquery.dataTables.min.js') ?>"></script>
	<script src="<?php echo base_url('js/dataTables.bootstrap.min.js') ?>"></script>
</head>
<body>
	<div class="row">
		<div class="container">
			<div class="col-md-6">
				<div id="message"></div>
				<?php echo form_open('welcome', array('id'=>'college_student')); ?>
				<div class="form-group">
					<label>ID</label>
					<input type="text" name="id" class="form-control" placeholder="ID"/>
				</div>
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="name" class="form-control" placeholder="Name"/>
				</div>
				<div class="form-group">
					<label>sex</label>
					<select name="sex" class="form-control">
						<option value="M">MALE</option>
						<option value="F">FEMALE</option>
					</select>
				</div>
				<div class="form-group">
					<label>phone</label>
					<input type="text" name="phone" class="form-control" placeholder="phone"/>
				</div>
				<div class="form-group">
					<label>Address</label>
					<textarea name="address" class="form-control" cols="30" rows="3" placeholder="Address"></textarea>
				</div>
				<button type="button" class="btn btn-primary save" onclick="save_data()">save</button>
				<button type="button" class="btn btn-success update" disabled="disabled" onclick="update_data()">update</button>
				<?php echo form_close(); ?>
			</div>
		</div>
		<div class="container">
			<div class="col-md-12">
				<h3 class="page-header">Sample Data</h3>
				<table id="data_student" class="table table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Sex</th>
							<th>Phone</th>
							<th>Address</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function save_data() {
			$.ajax({
				url: "<?php echo site_url('welcome/save') ?>",
				type: 'POST',
				dataType: 'json',
				data: $('#college_student').serialize(),
				encode:true,
				success:function(data) {
					if(!data.success){
						if(data.errors){
							$('#message').html(data.errors).addClass('alert alert-danger');
						}
					}else {
						alert(data.message);
						setTimeout(function() {
							window.location.reload()
						}, 400);
					}
				}
			})
		}
		function update_data() {
			$.ajax({
				url: "<?php echo site_url('welcome/update_data') ?>",
				type: 'POST',
				dataType: 'json',
				data: $('#college_student').serialize(),
				encode:true,
				success:function (data) {
					if(!data.success){
						$('#message').html(data.errors).addClass('alert alert-danger');
					}else {
						alert(data.message);
						setTimeout(function () {
							window.location.reload();
						}, 400);
					}
				}
			})
		}
		function update(id) {
			$.ajax({
				url: "<?php echo site_url('welcome/Sample_update/') ?>",
				type: 'POST',
				dataType: 'json',
				data: 'id='+id,
				encode:true,
				success:function (data) {
					$('.save').attr('disabled', true);
					$('.update').removeAttr('disabled');
					$('input[name="id"]').val(data.id);
					$('input[name="name"]').val(data.name);
					$('select[name="sex"]').val(data.sex);
					$('input[name="phone"]').val(data.phone);
					$('textarea[name="address"]').val(data.address);
				}
			})
		}
		function delete_data(id) {
			if(confirm('Are you sure you want to delete ??')){
				$.ajax({
					url: "<?php echo site_url('welcome/delete_data/') ?>",
					type: 'POST',
					dataType: 'json',
					data: 'id='+id,
					encode:true,
					success:function(data) {
						if(!data.success){
							if(data.errors){
								$('#message').html(data.errors).addClass('alert alert-danger');
							}
						}else {
							$('#message').html(data.message).addClass('alert alert-success').removeClass('alert alert-danger');
							setTimeout(function() {
								window.location.reload();
							}, 400);
						}
					}
				});
			}
		}
		$('#data_student').DataTable({
			"ajax":{
				"url":"<?php echo site_url('welcome/sample_data') ?>",
				"type":"POST"
			}
		})
	</script>
</body>
</html>
