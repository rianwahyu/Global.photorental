<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="index" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>
                <li class="list-divider"></li> -->
                <li class="nav-small-cap"><span class="hide-menu">Data Master</span></li>

                <!-- <li class="sidebar-item"> <a class="sidebar-link" href="category" aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Kategori
                        </span></a>
                </li> -->
                <li class="sidebar-item" <?= ($item=="1") ?'':'hidden' ?>> <a class="sidebar-link" href="master_item" aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Item
                        </span></a>
                </li>
                <li class="sidebar-item" <?= ($merk=="1") ?'':'hidden' ?>> <a class="sidebar-link" href="merk" aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Merk
                        </span></a>
                </li>
                <li class="sidebar-item" <?= ($category=="1") ?'':'hidden' ?>> <a class="sidebar-link" href="category_item" aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Category
                        </span></a>
                </li>

                <li class="sidebar-item" <?= ($customer=="1") ?'':'hidden' ?>> <a class="sidebar-link" href="customer" aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Customer
                        </span></a>
                </li>

                <!-- <li class="sidebar-item"> <a class="sidebar-link" href="member" aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Member
                        </span></a>
                </li> -->

                <li class="nav-small-cap"><span class="hide-menu">Transaction</span></li>
                
                <li class="sidebar-item" <?= ($orders=="1") ?'':'hidden' ?>> <a class="sidebar-link" href="order_list"            aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span class="hide-menu">Order
                        </span></a>
                </li>
        
                <li class="nav-small-cap" <?= ($report=="1") ?'':'hidden' ?>><span class="hide-menu">Report</span></li>

                <li class="sidebar-item" <?= ($report=="1") ?'':'hidden' ?>> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span class="hide-menu">Report</span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="report_customer" class="sidebar-link"><span class="hide-menu">Rekap Customer
                                </span></a>
                        </li>
                      
                        <li class="sidebar-item"><a href="rekapan" class="sidebar-link"><span class="hide-menu">Rekap Sold Item
                                </span></a>
                        </li>

                        <li class="sidebar-item"><a href="rekapan_periode" class="sidebar-link"><span class="hide-menu">Rekap By Period
                                </span></a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>