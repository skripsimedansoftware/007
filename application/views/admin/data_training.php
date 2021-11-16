<section class="content container-fluid">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Data Training</h3>
		</div>
		<div class="box-body">
			<table class="datatable">
				<thead>
					<th>No</th>
					<th>Nama</th>
					<th>Deskripsi</th>
					<th>Jumlah Data - Gambar</th>
					<th>Jumlah Data - Warna</th>
					<th>Opsi</th>
				</thead>
				<tbody>
					<?php 
					if (!empty($data)) :
						foreach ($data as $no => $value) :
						$data_training_image = $this->data_training_image->read(array('data-training-name' => $value->id));

						$data_training_images = array_map(function($data) {
							return $data['id'];
						}, $data_training_image->result_array());
						$data_training_data = $this->data_training_data->read_in('data-training-image', $data_training_images);
					?>
					<tr>
						<td><?php echo $no+1 ?></td>
						<td><?php echo $value->title ?></td>
						<td><?php echo strlen($value->description) > 0 ? $value->description : '-' ?></td>
						<td><?php echo $data_training_image->num_rows() ?></td>
						<td><?php echo $data_training_data->num_rows() ?></td>
						<td>
							<button class="btn btn-data-training-option btn-xs btn-primary" data-option="add" data-id="<?php echo $value->id ?>" data-toggle="tooltip" data-placement="top" title="Tambah Sampel Data"><i class="fa fa-plus"></i></button>
							<button class="btn btn-data-training-option btn-xs btn-warning" data-option="edit" data-id="<?php echo $value->id ?>" data-toggle="tooltip" data-placement="top" title="Edit Sampel Data"><i class="fa fa-edit"></i></button>
							<button class="btn btn-data-training-option btn-xs btn-info" data-option="view" data-id="<?php echo $value->id ?>" data-toggle="tooltip" data-placement="top" title="Lihat Sampel Data"><i class="fa fa-eye"></i></button>
							<button class="btn btn-data-training-option btn-xs btn-danger" data-option="delete" data-id="<?php echo $value->id ?>" data-toggle="tooltip" data-placement="top" title="Hapus Sampel Data"><i class="fa fa-trash"></i></button>
						</td>
					</tr>
					<?php 
						endforeach;
						else:
							?>
							<tr>
								<td colspan="6"><center>Data masih kosong</center></td>
							</tr>
							<?php
					endif;
					?>

				</tbody>
			</table>
		</div>
		<div class="box-footer">
			<button class="btn btn-success" data-toggle="modal" data-target="#modal-add-sample"><i class="fa fa-plus"></i> Tambah Sampel</button>
		</div>
	</div>
</section>