<nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle">
                                <?php echo $_SESSION['username_admin'] ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end mt-3">
                            <a class="dropdown-item" href="./" data-bs-toggle="modal" data-bs-target="#password" ><i class="bi bi-key"></i> Password</a>
                                <a class="dropdown-item" href="proses/logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

                <!-- modal ubah password-->
<div class="modal fade" id="password" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="text-center needs-validation" novalidate action="proses/ubah-password.php" method="POST">
                  
                  <div class="row">
                  <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Rafli21" name="username"
                          value="<?php echo $_SESSION['username_admin'] ?>" disabled>
                        <label for="floatingInput">Username</label>
                        <div class="invalid-feedback text-start">
                          Masukan username anda
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword"  name="passwordlama"
                          value="" required>
                        <label for="floatingInput">Password Lama</label>
                        <div class="invalid-feedback text-start">
                          Masukan Password Lama anda
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                  <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" name="passwordbaru"
                          value="" required >
                        <label for="floatingInput">Password Baru</label>
                        <div class="invalid-feedback text-start">
                          Masukan Password Baru
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword"  name="repasswordbaru"
                          value="" required >
                        <label for="floatingInput">Ulangi Password Baru Anda</label>
                        <div class="invalid-feedback text-start">
                          Masukan lagi Password Baru anda
                        </div>
                      </div>
                    </div>                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="ubah_password_validate" value="1234">Save
                      changes</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
        <!-- end modal ubah password-->