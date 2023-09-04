<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Gambar Produk : <?= $produk->nama_produk?></h3>

                
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                if($this->session->flashdata('pesan'))
                {
                    echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>';
                    echo $this->session->flashdata('pesan');
                    echo '</h5></div>';
                }
                ?>
                 <?php 
                    // Notifikasi form kosong
                    echo validation_errors(' <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i>', '</div>');


                    // Notifikasi gagal upload gambar
                    if (isset($error_upload)) {
                        echo '  <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i>' .$error_upload. '</div>';
                    }    


                    
                 echo form_open_multipart('gambarproduk/add/' . $produk->id_produk) ?>

              <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                <label for="inputNama" class="form-label">Keterangan Gambar</label>
                <input name="keterangan" class="form-control" placeholder="Keterangan Gambar" value="<?= set_value('keterangan') ?>">
              </div>
            </div>

              
                    <div class="col-sm-4">
                    <div class="form-group">
                        <label for="inputGambar" class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control" id="preview_gambar" required>
                    </div>
                    </div>
                    <div class="col-sm-4">
                    <div class="form-group">
                      <img src="<?= base_url('assets/gambar/noimgs.jpg') ?>" id="gambar_load" width="150px">
                    </div>
                    </div>
                    </div>  
                    
                    <div class="mb-3"   >
                        <a href="<?= base_url('gambarproduk') ?>" class="btn btn-danger rounded-pill">Close</a>
                        <button type="submit" class="btn btn-primary rounded-pill">Save</button>
                    </div>

        <?php echo form_close() ?>
        
        <hr>
        <div class="row">
        <?php foreach ($gambar as $key => $value) { ?>
           <div class="col-sm-2">
           <div class="form-group">
             <img src="<?= base_url('assets/gambarproduk/'. $value->gambar) ?>" id="gambar_load" width="150px" height="150">
           </div>
           <p for=""> Keterangan : <?= $value->keterangan?></p>
           <button class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$value->id_gambar ?>" class="btn btn-danger rounded-pill"><i class="fa fa-trash"></i>Delete</button>
          </div>
      
        <?php }?>
        
        </div>  
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>


            <!--modal-delete-->
    <?php foreach ($gambar as $key => $value ){?>
      <div class="modal fade" id="delete<?=$value->id_gambar ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete <?= $value->keterangan?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            <div class="form-group text-center">
             <img src="<?= base_url('assets/gambarproduk/'. $value->gambar) ?>" id="gambar_load" width="150px" height="150"> </div>
            <h5>Apakah Anda Yakin Ingin Menghapus Gambar Ini...?</h5>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a href="<?= base_url('gambarproduk/delete/' . $value->id_gambar) ?>"class="btn btn-danger">Delete</a>
             
              
            </div>
            <?php
                echo form_close();
            ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?php }?>



    <!-- Pastikan Anda telah menyertakan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Pastikan skrip ini berada dalam dokumen siap
    $(document).ready(function() {
        // Ketika input file dengan ID "preview_gambar" berubah
        $("#preview_gambar").change(function() {
            bacaGambar(this);
        });

        // Fungsi untuk memuat gambar
        function bacaGambar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Menetapkan sumber gambar ke elemen dengan ID "gambar_load"
                    $('#gambar_load').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>