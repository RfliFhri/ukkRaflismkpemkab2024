 <!-- Content For Sidebar -->
 <div class="h-100">
                <div class="sidebar-logo">
                    <a href="./">Elray</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Kasir Elements
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link <?php echo (isset($_GET['x']) && $_GET['x']=='produk') ? "active link-light bg-secondary" : "" ; ?>" aria-current="page" href="produk">
                        <i class="bi bi-grid-fill pe-2"></i>
                            Produk
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link <?php echo (isset($_GET['x']) && $_GET['x']=='pelanggan') ? "active link-light bg-secondary" : "" ; ?>" href="pelanggan">
                        <i class="bi bi-person-circle pe-2"></i> 
                            Pelanggan
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link <?php echo (isset($_GET['x']) && $_GET['x']=='penjualan') ? "active link-light bg-secondary" : "" ; ?>" href="penjualan">
                        <i class="bi bi-cart2 pe-2"></i> 
                            Penjualan
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link <?php echo (isset($_GET['x']) && $_GET['x']=='datapjl') ? "active bg-secondary" : "" ; ?>" href="datapjl">
                        <i class="bi bi-list pe-2"></i> 
                            Data Penjualan
                        </a>
                    </li>

                </ul>
            </div>