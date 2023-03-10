<?php
		if (isset($_REQUEST['edit'])) {
			$no_agenda		= $_POST['no_agenda'];
			$no_surat		= $_POST['no_surat'];
			$jenis_surat	= $_POST['jenis_surat'];
			$tanggal_surat	= InggrisTgl($_POST['tgl_surat']);
			$asal_surat		= $_POST['asal_surat'];
			$isi_ringkas	= $_POST['perihal'];
			$file 			= $_FILES['file']['name'];
			$tmp			= $_FILES['file']['tmp_name'];
			$path			= "upload/surat_masuk/".$file;

			//proses update
			if (move_uploaded_file($tmp, $path)) {
				$query = "SELECT * FROM surat_masuk WHERE id='$_GET[id]'";
				$sql   = mysqli_query($connect, $query);
				$data  = mysqli_fetch_array($sql);
			//jika filenya ada, hapus filenya
				if (file_exists("upload/surat_masuk/".$data['file'])){
					unlink("upload/surat_masuk/".$data['file']);
				}
			//jika mengubah file		
				$query 	= "UPDATE surat_masuk SET no_agenda='$no_agenda', no_surat='$no_surat', jenis_surat='$jenis_surat', tgl_surat='$tanggal_surat', asal_surat='$asal_surat', perihal='$isi_ringkas', file='$file' WHERE id='$_GET[id]'";
				$sql   	= mysqli_query($connect, $query);
				if ($sql) {
					echo '<script language="javascript">
							  window.alert("Data berhasil di ubah")
	               	  		  window.location.href="./admin.php?page=surat_masuk";
              	  		  </script>';
				}else{
					echo '<script>
						   	  window.alert("Data gagal diubah");
			 			  </script>';
				}
			}else{
			//jika tidak mengubah file
				$query 	= "UPDATE surat_masuk SET no_agenda='$no_agenda', no_surat='$no_surat', jenis_surat='$jenis_surat', tgl_surat='$tanggal_surat', asal_surat='$asal_surat', perihal='$isi_ringkas' WHERE id='$_GET[id]'";
				$sql	= mysqli_query($connect, $query);
				if ($sql) {
					echo '<script language="javascript">
						  window.alert("Data berhasil di ubah")
               	  		  window.location.href="./admin.php?page=surat_masuk";
              	  		  </script>';
				}else{
					echo '<script>
						  window.alert("Data gagal di ubah");
			 			  </script>';
				}
			}
		}
	?>	

	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Edit Surat Masuk</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Form Edit Surat Masuk</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<!-- Form edit surat masuk -->
						<?php
							$query 	= "SELECT * FROM surat_masuk WHERE id='$_GET[id]'";
							$sql 	= mysqli_query($connect, $query);
							while ($data = mysqli_fetch_array($sql)) {
						?>	
						<form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
							<div class="item form-group">
								<label class="control-label col-md-3 col-xs-12">No Agenda<span class="required">&nbsp; :</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="no_agenda" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $data['no_agenda'] ?>" readonly>
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-xs-12">Jenis Surat<span class="required">&nbsp; :</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="jenis_surat" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $data['jenis_surat'] ?>">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-xs-12">Tanggal Surat<span class="required">&nbsp; :</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="tgl_surat" class="form-control has-feedback-left" id="tanggal" required="required" value="<?php echo IndonesiaTgl($data['tgl_surat']);?> ">
									<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
								</div>
							</div>	
							<div class="item form-group">
								<label class="control-label col-md-3 col-xs-12">No Surat<span class="required">&nbsp; :</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="no_surat" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $data['no_surat'] ?>">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-xs-12">Asal Surat<span class="required">&nbsp; :</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="asal_surat" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $data['asal_surat'] ?>">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-xs-12">Isi Ringkas<span class="required">&nbsp; :</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="perihal" class="form-control col-md-7 col-xs-12" required="required"><?php echo $data['perihal'] ?></textarea>
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-xs-12">File<span class="required">&nbsp; :</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="file" name="file" class="form-control col-md-7 col-xs-12"  value="<?php echo $data['file'] ?>">
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<button type="reset" class="btn btn-default">Reset</button>
									<input type="submit" class="btn btn-success" value="Simpan" name="edit">
								</div>
							</div>												
						</form>
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>