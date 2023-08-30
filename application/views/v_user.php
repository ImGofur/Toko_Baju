<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">DataTable with minimal features & hover style</h3> -->
              </div>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <?php
                if ($this->session->flashdata('pesan'));
                {
                 echo ' <div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i></h5>'; 
                 echo $this->session->flashdata('pesan');
                 echo ' </div>';
                }

                 ?>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                       <th>Nama</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Level</th>
                      <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    foreach ($user as $key => $value) {?>
                  <tr>
                  <td><?= $value->nama ?></td>
                  <td><?= $value->username ?></td>
                  <td><?= $value->password ?></td>
                  <td><?php
                  if ($value->level==1) {
                    echo' <span class="right badge badge-primary">Admin</span>';
                  } else{
                    echo'<span class="right badge badge-success">User</span>';
                  }
                  
                  ?></td>
                  <td>  
                  <button style="background-color: yellow; color:black;" type="button" class="btn btn-default" data-toggle="modal" data-target="#edit<?=$value->id_user?>">
                  <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-danger btn-sm"data-toggle="modal" data-target="#delete<?= $value->id_user?>"><i class="fas fa-trash"></i></button>
                <button style="background-color: blue; color:white;" data-toggle="modal" data-target="#add" type="button" class="btn btn-tool" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>
                  Add</button>
                  </td>
                  </tr>
                  
                  <?php }?>
                  </tbody>
                 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



<!-- UNTUK MODAL TAMBAH -->
<div class="modal fade" id="add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             
          <?php 
            echo form_open('user/add');
          ?>

                 <div class="card-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                  </div>
                 
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                  </div>
                 
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                  </div>
                 
                  <div class="form-group">
                    <label>Level</label>
                    <select  name="level" class="form-control">
                        <option value="1" selected>Admin</option>
                        <option value="2">User</option>
                    </select>
                  </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
              <?php 
               echo form_close();
               ?>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal  -->
  </div>


  <!-- UNTUK MUDAL EDIT -->
  
  <?php foreach ($user as $key => $value) { ?>  
      <div class="modal fade" id="edit<?= $value->id_user?>">       
       <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <?php 
            echo form_open('user/edit/'.$value->id_user);
          ?>

                 <div class="card-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" value="<?= $value->id_user?>" class="form-control" placeholder="Nama" required>
                  </div>
                 
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="<?= $value->username?>" class="form-control" placeholder="Username" required>
                  </div>
                 
                  <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" value="<?= $value->password?>" class="form-control" placeholder="Password" required>
                  </div>
                 
                  <div class="form-group">
                    <label>Level</label>
                    <select  name="level" class="form-control">
                        <option value="1"<?php if ($value->level==1) {echo'selected';}?> selected>Admin</option>
                        <option value="2"<?php if ($value->level==2) {echo'selected';}?>>User</option>
                    </select>
                  </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
              <?php 
               echo form_close();
               ?>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      </div>
    <?php }?>



  

    <?php foreach ($user as $key => $value) { ?>  
      <div class="modal fade" id="delete<?= $value->id_user ?>">       
       <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete <?= $value->nama?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
           
                 <h5>Apakah Anda Ingin Menghapus Data Ini ?</h5>
                 
                 </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a href="<?= base_url('user/delete/' .$value->id_user) ?>" class="btn btn-primary">Delete</a>
             
            </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    <?php } ?>



  

