<?php
session_start();
include "lib/config.php";

$tampil     = isset($_GET['view']) ? $_GET['view'] : NULL;
$p_bulan    = isset($_GET['bulan']) ? $_GET['bulan'] : NULL;
$p_tahun    = isset($_GET['tahun']) ? $_GET['tahun'] : NULL;
$p_ba       = isset($_GET['no_ba']) ? $_GET['no_ba'] : NULL;
$p_wo       = isset($_GET['wo_id']) ? $_GET['wo_id'] : NULL;

if ($tampil == 'project') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'tbl_project_wo.id_project',
        'tgl_project',
        'project_title',
        'customer',
        'wo_id',
        'so_id',
        'tgl',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $query = $datatable->get_custom("SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi ",$columns);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
        $ResultData[] = $no;
        $ResultData[] = $value->tgl_project;
        $ResultData[] = $value->project_title;
        $ResultData[] = $value->customer;
        $ResultData[] = $value->wo_id;
        $ResultData[] = $value->so_id;
        $ResultData[] = $value->tgl;

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
            if ($value->status === 'first') {
                $ResultData[] = '<a data-rel="tooltip" title="View Detail" class="blue" href="?id=view&mod=view&id_n='.$value->id_project.'">
                                              <span class="fa fa-list">
                                            </a>
                                            <a data-rel="tooltip" title="Add Detail" class="purple" href="?id=add-project&mod=schedule&id_n='.$value->id_project.'">
                                              <span class="fa fa-plus-square">
                                            </a>
                                            <a data-rel="tooltip" title="Add Cash Receipt" class="purple" href="?id=add-cash-receipt&mod=Tambah&wo_id='.$value->wo_id.'">
                                              <span class="fa fa-plus-square">
                                            </a>
                                            <a data-rel="tooltip" title="Add PTJB" class="purple" href="?id=add-ptjb&mod=Tambah&wo_id='.$value->wo_id.'">
                                              <span class="fa fa-plus-square">
                                            </a>
                                            <a data-rel="tooltip" title="Add Income" class="purple" href="?id=add-income&mod=Tambah&wo_id='.$value->wo_id.'">
                                              <span class="fa fa-plus-square">
                                            </a>
                                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-project&mod=edit&id_n='.$value->id_project.'">
                                              <span class="fa fa-edit">
                                            </a>
                                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=project&view=project&mod=del&id_n='.$value->kode_project.'">
                                              <span class="fa fa-trash-o">
                                            </a>';
            } else {
                $ResultData[] = '<a data-rel="tooltip" title="Add Cash Receipt" class="purple" href="?id=add-cash-receipt&mod=Tambah&wo_id='.$value->wo_id.'">
                                              <span class="fa fa-plus-square">
                                            </a>
                                            <a data-rel="tooltip" title="Add PTJB" class="purple" href="?id=add-ptjb&mod=Tambah&wo_id='.$value->wo_id.'">
                                              <span class="fa fa-plus-square">
                                            </a>
                                            <a data-rel="tooltip" title="Add Income" class="purple" href="?id=add-income&mod=Tambah&wo_id='.$value->wo_id.'">
                                              <span class="fa fa-plus-square">
                                            </a>
                                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-project&mod=edit&id_n='.$value->id_project.'">
                                              <span class="fa fa-edit">
                                            </a>
                                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=project&view=project&mod=del&id_n='.$value->kode_project.'">
                                              <span class="fa fa-trash-o">
                                            </a>';
            }
        

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'kasbon') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'tbl_project_wo.id_project',
        'tgl_project',
        'project_title',
        'customer',
        'wo_id',
        'so_id',
        'tgl',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $query = $datatable->get_custom("SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi ",$columns);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
        $ResultData[] = $no;
        $ResultData[] = $value->tgl_project;
        $ResultData[] = $value->project_title;
        $ResultData[] = $value->customer;
        $ResultData[] = $value->wo_id;
        $ResultData[] = $value->so_id;
        $ResultData[] = $value->tgl;

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a data-rel="tooltip" title="Add Cash Receipt" class="purple" href="?id=add-cash-receipt&mod=Tambah&wo_id='.$value->wo_id.'">
                                              <span class="fa fa-plus-square">
                                            </a>';
        

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'ptjb') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'tbl_project_wo.id_project',
        'tgl_project',
        'project_title',
        'customer',
        'wo_id',
        'so_id',
        'tgl',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $query = $datatable->get_custom("SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi ",$columns);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
        $ResultData[] = $no;
        $ResultData[] = $value->tgl_project;
        $ResultData[] = $value->project_title;
        $ResultData[] = $value->customer;
        $ResultData[] = $value->wo_id;
        $ResultData[] = $value->so_id;
        $ResultData[] = $value->tgl;

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a data-rel="tooltip" title="Add PTJB" class="purple" href="?id=add-ptjb&mod=Tambah&wo_id='.$value->wo_id.'">
                                              <span class="fa fa-plus-square">
                                            </a>';
        

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'income') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'tbl_project_wo.id_project',
        'tgl_project',
        'project_title',
        'customer',
        'wo_id',
        'so_id',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $array_status = array('status' => "first");
        $query = $datatable->get_custom("SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi WHERE status=?",$columns,$array_status);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
        $ResultData[] = $no;
        $ResultData[] = $value->tgl_project;
        $ResultData[] = $value->project_title;
        $ResultData[] = $value->customer;
        $ResultData[] = $value->wo_id;
        $ResultData[] = $value->so_id;

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a data-rel="tooltip" title="Add Income" class="purple" href="?id=add-income&mod=Tambah&wo_id='.$value->wo_id.'">
                                              <span class="fa fa-plus-square">
                                            </a>';
        

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'order-w-t') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'tbl_project_wo.id_project',
        'tgl_project',
        'project_title',
        'customer',
        'wo_id',
        'so_id',
        'tgl',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $query = $datatable->get_custom("SELECT * FROM tbl_project_wo JOIN tbl_schedule_wo ON tbl_project_wo.kode_jadwal = tbl_schedule_wo.kode_jadwal JOIN tbl_teknisi_wo ON tbl_project_wo.kode_teknisi = tbl_teknisi_wo.kode_teknisi WHERE tbl_schedule_wo.tgl = '' AND tbl_teknisi_wo.teknisi1 = '' AND tbl_teknisi_wo.teknisi2 = '' AND tbl_teknisi_wo.teknisi3 = '' AND tbl_teknisi_wo.teknisi4 = '' AND tbl_teknisi_wo.pkl1 = '' AND tbl_teknisi_wo.pkl2 = '' AND tbl_teknisi_wo.pkl3 = '' AND month(tbl_project_wo.tgl_project) = '$p_bulan' AND year(tbl_project_wo.tgl_project) = '$p_tahun' ",$columns);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
        $ResultData[] = $no;
        $ResultData[] = $value->tgl_project;
        $ResultData[] = $value->project_title;
        $ResultData[] = $value->customer;
        $ResultData[] = $value->wo_id;
        $ResultData[] = $value->so_id;

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a data-rel="tooltip" title="View Detail" class="blue" href="?id=view&mod=view&id_n='.$value->id_project.'">
                                <span class="fa fa-list">
                              </a>';
        

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'rm-project') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'tbl_project_wo.id_project',
        'tgl_project',
        'project_title',
        'customer',
        'wo_id',
        'so_id',
        'tgl',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $array_status = array('status' => "first");
        $query = $datatable->get_custom("SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi WHERE status=?",$columns,$array_status);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
        $ResultData[] = $no;
        $ResultData[] = $value->tgl_project;
        $ResultData[] = $value->project_title;
        $ResultData[] = $value->customer;
        $ResultData[] = $value->wo_id;
        $ResultData[] = $value->so_id;
        $ResultData[] = $value->tgl;

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a data-rel="tooltip" title="View Detail" class="blue" href="?id=view&mod=view&id_n='.$value->id_project.'">
                                <span class="fa fa-list">
                              </a>';
        

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'ptjb-list-rm') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'wo_id',
        'nama',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $query = $datatable->get_custom("SELECT * FROM tbl_ptjb join tbl_amount on tbl_amount.kode_amount_ptjb = tbl_ptjb.kode_amount_ptjb",$columns);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $rp = 'Rp. ';
        $total = $value->amount1 + $value->amount2 + $value->amount3 + $value->amount4 + $value->amount5 + $value->amount6 + $value->amount7 + $value->amount8 + $value->amount9 + $value->amount10;
        $price[]      = $total;
        $amount_total = array_sum($price);

        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
        $ResultData[] = $no;
        $ResultData[] = $value->wo_id;
        $ResultData[] = $value->nama;
        $ResultData[] = "Rp." .number_format($total, 0, ".", ".");

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-ptjb&mod=view&id_n='.$value->id_ptjb.'">
                                  <span class="fa fa-list">
                                </a>';

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'kasbon-list-all-rm') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'nama_project',
        'wo_id',
        'tbl_kasbon.nama',
        'tgl_jalan',
        'st_lunas',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $query = $datatable->get_custom("SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount join tbl_status_kasbon on tbl_status_kasbon.kode_status = tbl_kasbon.kode_status",$columns);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $status = $value->st_lunas;  
        $jmlh = $value->jmlh_amount;
        $rp = 'Rp. ';
        $total = $value->amount1 + $value->amount2 + $value->amount3 + $value->amount4 + $value->amount5 + $value->amount6 + $value->amount7 + $value->amount8 + $value->amount9 + $value->amount10;
        $price[]      = $total;
        $amount_total = array_sum($price);
        $sisa = $value->jmlh_amount - $total;

        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
            $ResultData[] = $no;
            $ResultData[] = $value->nama_project;
            $ResultData[] = $value->wo_id;
            $ResultData[] = $value->nama;
            $ResultData[] = $value->tgl_jalan;
            $ResultData[] = "Rp." .number_format($jmlh, 0, ".", ".");
            $ResultData[] = "Rp." .number_format($total, 0, ".", ".");
            $ResultData[] = "Rp." .number_format($sisa, 0, ".", ".");
            $ResultData[] = $value->st_lunas;

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-kasbon&mod=view&id_n='.$value->id_kasbon.'">
                                  <span class="fa fa-list">
                                </a>';

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'project-admin') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'tbl_project_wo.id_project',
        'tgl_project',
        'project_title',
        'customer',
        'wo_id',
        'so_id',
        'tgl',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $array_status = array('level' => "admin");
        $query = $datatable->get_custom("SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi WHERE level=?",$columns,$array_status);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
        $ResultData[] = $no;
        $ResultData[] = $value->tgl_project;
        $ResultData[] = $value->project_title;
        $ResultData[] = $value->customer;
        $ResultData[] = $value->wo_id;
        $ResultData[] = $value->so_id;
        $ResultData[] = $value->tgl;

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        if ($value->status === 'first') {
                $ResultData[] = '<a data-rel="tooltip" title="View Detail" class="blue" href="?id=view&mod=view&id_n='.$value->id_project.'">
                                              <span class="fa fa-list">
                                            </a>
                                            <a data-rel="tooltip" title="Add Detail" class="purple" href="?id=add-project&mod=schedule&id_n='.$value->id_project.'">
                                              <span class="fa fa-plus-square">
                                            </a>
                                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-project&mod=edit&id_n='.$value->id_project.'">
                                              <span class="fa fa-edit">
                                            </a>
                                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=project&mod=del&id_n='.$value->kode_project.'">
                                              <span class="fa fa-trash-o">
                                            </a>';
            } else {
                $ResultData[] = '<a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-project&mod=edit&id_n='.$value->id_project.'">
                                              <span class="fa fa-edit">
                                            </a>
                                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=project&mod=del&id_n='.$value->kode_project.'">
                                              <span class="fa fa-trash-o">
                                            </a>';
            }

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'project-teknisi') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'tbl_project_wo.id_project',
        'tgl_project',
        'project_title',
        'customer',
        'wo_id',
        'so_id',
        'tgl',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $array_status = array('level' => "teknisi");
        $query = $datatable->get_custom("SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi WHERE level=?",$columns,$array_status);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
        $ResultData[] = $no;
        $ResultData[] = $value->tgl_project;
        $ResultData[] = $value->project_title;
        $ResultData[] = $value->customer;
        $ResultData[] = $value->wo_id;
        $ResultData[] = $value->so_id;
        $ResultData[] = $value->tgl;

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        if ($value->status === 'first') {
                $ResultData[] = '<a data-rel="tooltip" title="View Detail" class="blue" href="?id=view&mod=view&id_n='.$value->id_project.'">
                                              <span class="fa fa-list">
                                            </a>
                                            <a data-rel="tooltip" title="Add Detail" class="purple" href="?id=add-project&mod=schedule&id_n='.$value->id_project.'">
                                              <span class="fa fa-plus-square">
                                            </a>
                                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-project&mod=edit&id_n='.$value->id_project.'">
                                              <span class="fa fa-edit">
                                            </a>
                                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=project&mod=del&id_n='.$value->kode_project.'">
                                              <span class="fa fa-trash-o">
                                            </a>';
            } else {
                $ResultData[] = '<a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-project&mod=edit&id_n='.$value->id_project.'">
                                              <span class="fa fa-edit">
                                            </a>
                                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=project&mod=del&id_n='.$value->kode_project.'">
                                              <span class="fa fa-trash-o">
                                            </a>';
            }

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'income-list') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'no_ba',
        'tglba',
        'deskripsi',
        'pm',
        'tbl_income_detail.notes'
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $array_status = array('ket' => "first");
        $query = $datatable->get_custom("SELECT * FROM tbl_kode_income join tbl_income on tbl_income.kd_income = tbl_kode_income.kd_income join tbl_income_detail on tbl_income_detail.kd_detail = tbl_kode_income.kd_detail WHERE ket=?",$columns,$array_status);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
        $ResultData[] = $no;
        $ResultData[] = $value->no_ba;
        $ResultData[] = $value->tglba;
        $ResultData[] = $value->deskripsi;
        $ResultData[] = $value->pm;
        $ResultData[] = $value->notes;

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-income&mod=view&id_n='.$value->id_income.'&no_ba">
                              <span class="fa fa-list">
                            </a>
                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-income&mod=edit&id_n='.$value->id_income.'">
                              <span class="fa fa-pencil">
                            </a>
                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=income&mod=del&id_n='.$value->id_income.'">
                              <span class="fa fa-trash-o">
                            </a>';

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'boq-list') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'no_boq',
        'wo_id',
        'so_id',
        'price',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $array_status = array('ket' => "first");
        $array_ba     = array('no_ba' => $p_ba );
        $query = $datatable->get_custom("SELECT * FROM tbl_income JOIN tbl_kode_income ON tbl_kode_income.kd_income = tbl_income.kd_income where no_ba=?",$columns,$array_ba);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $rp = 'Rp. ';
        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
        $ResultData[] = $value->no_boq;
        $ResultData[] = $value->wo_id;
        $ResultData[] = $value->so_id;
        $ResultData[] = "Rp." .number_format($value->price, 0, ".", ".");

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-income&mod=detail&id_n='.$value->id_income.'">
                                  <span class="fa fa-list">
                                </a>
                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-income&mod=edit&id_n='.$value->id_income.'">
                              <span class="fa fa-pencil">
                            </a>
                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=income&mod=del&id_n='.$value->id_income.'">
                              <span class="fa fa-trash-o">
                            </a>';

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'income-list') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'no_ba',
        'tglba',
        'deskripsi',
        'pm',
        'tbl_income_detail.notes'
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $array_status = array('ket' => "first");
        $query = $datatable->get_custom("SELECT * FROM tbl_kode_income join tbl_income on tbl_income.kd_income = tbl_kode_income.kd_income join tbl_income_detail on tbl_income_detail.kd_detail = tbl_kode_income.kd_detail WHERE ket=?",$columns,$array_status);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
        $ResultData[] = $no;
        $ResultData[] = $value->no_ba;
        $ResultData[] = $value->tglba;
        $ResultData[] = $value->deskripsi;
        $ResultData[] = $value->pm;
        $ResultData[] = $value->notes;

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-income&mod=view&id_n='.$value->id_income.'&no_ba">
                              <span class="fa fa-list">
                            </a>
                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-income&mod=edit&id_n='.$value->id_income.'">
                              <span class="fa fa-pencil">
                            </a>
                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=income&mod=del&id_n='.$value->id_income.'">
                              <span class="fa fa-trash-o">
                            </a>';

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'ptjb-list') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'tbl_ptjb.wo_id',
        'tbl_project_wo.so_id',
        'tbl_schedule_wo.tgl',
        'tbl_ptjb.start_date',
        'tbl_ptjb.nama',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $query = $datatable->get_custom("SELECT * FROM tbl_project_wo JOIN tbl_schedule_wo On tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal JOIN tbl_ptjb ON tbl_project_wo.wo_id = tbl_ptjb.wo_id join tbl_amount on tbl_amount.kode_amount_ptjb = tbl_ptjb.kode_amount_ptjb",$columns);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $rp = 'Rp. ';
        $total = $value->amount1 + $value->amount2 + $value->amount3 + $value->amount4 + $value->amount5 + $value->amount6 + $value->amount7 + $value->amount8 + $value->amount9 + $value->amount10;
        $price[]      = $total;
        $amount_total = array_sum($price);

        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
        $ResultData[] = $no;
        $ResultData[] = $value->wo_id;
        $ResultData[] = $value->so_id;
        $ResultData[] = $value->tgl;
        $ResultData[] = $value->start_date;
        $ResultData[] = $value->nama;
        $ResultData[] = "Rp." .number_format($total, 0, ".", ".");

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-ptjb&mod=view&id_n='.$value->id_ptjb.'">
                                  <span class="fa fa-list">
                                </a>
                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-ptjb&mod=edit&id_n='.$value->id_ptjb.'">
                              <span class="fa fa-pencil">
                            </a>
                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=ptjb&mod=del&id_n='.$value->id_ptjb.'">
                              <span class="fa fa-trash-o">
                            </a>';

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'kasbon-list-all') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'nama_project',
        'wo_id',
        'tbl_kasbon.nama',
        'tgl_jalan',
        'st_lunas',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $query = $datatable->get_custom("SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount join tbl_status_kasbon on tbl_status_kasbon.kode_status = tbl_kasbon.kode_status",$columns);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $status = $value->st_lunas;  
        $jmlh = $value->jmlh_amount;
        $rp = 'Rp. ';
        $total = $value->amount1 + $value->amount2 + $value->amount3 + $value->amount4 + $value->amount5 + $value->amount6 + $value->amount7 + $value->amount8 + $value->amount9 + $value->amount10;
        $price[]      = $total;
        $amount_total = array_sum($price);
        $sisa = $value->jmlh_amount - $total;

        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
            $ResultData[] = $no;
            $ResultData[] = $value->nama_project;
            $ResultData[] = $value->wo_id;
            $ResultData[] = $value->nama;
            $ResultData[] = $value->tgl_jalan;
            $ResultData[] = "Rp." .number_format($jmlh, 0, ".", ".");
            $ResultData[] = "Rp." .number_format($total, 0, ".", ".");
            $ResultData[] = "Rp." .number_format($sisa, 0, ".", ".");
            $ResultData[] = $value->st_lunas;

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-kasbon&mod=view&id_n='.$value->id_kasbon.'">
                                  <span class="fa fa-list">
                                </a>
                            <a data-rel="tooltip" title="Update Detail" class="purple" href="?id=add-cash-receipt&mod=update&id_n='.$value->id_kasbon.'">
                              <span class="fa fa-plus-square">
                            </a>
                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-cash-receipt&mod=edit&id_n='.$value->id_kasbon.'">
                              <span class="fa fa-pencil">
                            </a>
                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=cash-receipt&mod=del&id_n='.$value->id_kasbon.'">
                              <span class="fa fa-trash-o">
                            </a>';

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'kasbon-list-selesai') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'nama_project',
        'wo_id',
        'tbl_kasbon.nama',
        'tgl_jalan',
        'st_lunas',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $array_status = array('tbl_status_kasbon.st_lunas' => "SELESAI");
        $query = $datatable->get_custom("SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount join tbl_status_kasbon on tbl_status_kasbon.kode_status = tbl_kasbon.kode_status WHERE st_lunas=?",$columns,$array_status);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $status = $value->st_lunas;  
        $jmlh = $value->jmlh_amount;
        $rp = 'Rp. ';
        $total = $value->amount1 + $value->amount2 + $value->amount3 + $value->amount4 + $value->amount5 + $value->amount6 + $value->amount7 + $value->amount8 + $value->amount9 + $value->amount10;
        $price[]      = $total;
        $amount_total = array_sum($price);
        $sisa = $value->jmlh_amount - $total;

        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
            $ResultData[] = $no;
            $ResultData[] = $value->nama_project;
            $ResultData[] = $value->wo_id;
            $ResultData[] = $value->nama;
            $ResultData[] = $value->tgl_jalan;
            $ResultData[] = "Rp." .number_format($jmlh, 0, ".", ".");
            $ResultData[] = "Rp." .number_format($total, 0, ".", ".");
            $ResultData[] = "Rp." .number_format($sisa, 0, ".", ".");
            $ResultData[] = $value->st_lunas;

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-kasbon&mod=view&id_n='.$value->id_kasbon.'">
                                  <span class="fa fa-list">
                                </a>
                            <a data-rel="tooltip" title="Update Detail" class="purple" href="?id=add-cash-receipt&mod=update&id_n='.$value->id_kasbon.'">
                              <span class="fa fa-plus-square">
                            </a>
                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-cash-receipt&mod=edit&id_n='.$value->id_kasbon.'">
                              <span class="fa fa-pencil">
                            </a>
                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=cash-receipt&mod=del&id_n='.$value->id_kasbon.'">
                              <span class="fa fa-trash-o">
                            </a>';

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'kasbon-list-pending') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'nama_project',
        'wo_id',
        'tbl_kasbon.nama',
        'tgl_jalan',
        'st_lunas',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $array_status = array('st_lunas' => "PENDING");
        $query = $datatable->get_custom("SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount join tbl_status_kasbon on tbl_status_kasbon.kode_status = tbl_kasbon.kode_status WHERE st_lunas=?",$columns,$array_status);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $status = $value->st_lunas;  
        $jmlh = $value->jmlh_amount;
        $rp = 'Rp. ';
        $total = $value->amount1 + $value->amount2 + $value->amount3 + $value->amount4 + $value->amount5 + $value->amount6 + $value->amount7 + $value->amount8 + $value->amount9 + $value->amount10;
        $price[]      = $total;
        $amount_total = array_sum($price);
        $sisa = $value->jmlh_amount - $total;

        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
            $ResultData[] = $no;
            $ResultData[] = $value->nama_project;
            $ResultData[] = $value->wo_id;
            $ResultData[] = $value->nama;
            $ResultData[] = $value->tgl_jalan;
            $ResultData[] = "Rp." .number_format($jmlh, 0, ".", ".");
            $ResultData[] = "Rp." .number_format($total, 0, ".", ".");
            $ResultData[] = "Rp." .number_format($sisa, 0, ".", ".");
            $ResultData[] = $value->st_lunas;

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-kasbon&mod=view&id_n='.$value->id_kasbon.'">
                                  <span class="fa fa-list">
                                </a>
                            <a data-rel="tooltip" title="Update Detail" class="purple" href="?id=add-cash-receipt&mod=update&id_n='.$value->id_kasbon.'">
                              <span class="fa fa-plus-square">
                            </a>
                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-cash-receipt&mod=edit&id_n='.$value->id_kasbon.'">
                              <span class="fa fa-pencil">
                            </a>
                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=cash-receipt&mod=del&id_n='.$value->id_kasbon.'">
                              <span class="fa fa-trash-o">
                            </a>';

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'kasbon-list-belum') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'nama_project',
        'wo_id',
        'tbl_kasbon.nama',
        'tgl_jalan',
        'st_lunas',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $array_status = array('st_lunas' => "BELUM SELESAI");
        $query = $datatable->get_custom("SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount join tbl_status_kasbon on tbl_status_kasbon.kode_status = tbl_kasbon.kode_status WHERE st_lunas=?",$columns,$array_status);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $status = $value->st_lunas;  
        $jmlh = $value->jmlh_amount;
        $rp = 'Rp. ';
        $total = $value->amount1 + $value->amount2 + $value->amount3 + $value->amount4 + $value->amount5 + $value->amount6 + $value->amount7 + $value->amount8 + $value->amount9 + $value->amount10;
        $price[]      = $total;
        $amount_total = array_sum($price);
        $sisa = $value->jmlh_amount - $total;

        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
            $ResultData[] = $no;
            $ResultData[] = $value->nama_project;
            $ResultData[] = $value->wo_id;
            $ResultData[] = $value->nama;
            $ResultData[] = $value->tgl_jalan;
            $ResultData[] = "Rp." .number_format($jmlh, 0, ".", ".");
            $ResultData[] = "Rp." .number_format($total, 0, ".", ".");
            $ResultData[] = "Rp." .number_format($sisa, 0, ".", ".");
            $ResultData[] = $value->st_lunas;

        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-kasbon&mod=view&id_n='.$value->id_kasbon.'">
                                  <span class="fa fa-list">
                                </a>
                            <a data-rel="tooltip" title="Update Detail" class="purple" href="?id=add-cash-receipt&mod=update&id_n='.$value->id_kasbon.'">
                              <span class="fa fa-plus-square">
                            </a>
                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-cash-receipt&mod=edit&id_n='.$value->id_kasbon.'">
                              <span class="fa fa-pencil">
                            </a>
                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=cash-receipt&mod=del&id_n='.$value->id_kasbon.'">
                              <span class="fa fa-trash-o">
                            </a>';

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'kategori-kasbon') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'kategori',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $query = $datatable->get_custom("SELECT * FROM project_kasbon",$columns);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
            $ResultData[] = $no;
            $ResultData[] = $value->kategori;
        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll, 
        $ResultData[] = '<a href="#&id_n='.$value->id.'" class="view_data3 green" data-toggle="modal" id="'.$value->id.'" data-target="#myModal2">
                                  <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
                                </a>
                                <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=kategori&mod=del&id_n='.$value->id.'">
                                  <span class="fa fa-trash-o">
                                </a>';

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'technician') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'tbl_pegawai.nik',
        'nama',
        'tbl_data_jabatan.nama_jabatan',
        'tbl_data_email_pegawai.email_pegawai',
        'tbl_data_email_pegawai.domain',
        'tbl_no_telp.hp',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $array_ket = array('tbl_pegawai.ket' => "Aktif");
        $query = $datatable->get_custom("SELECT * FROM tbl_pegawai JOIN tbl_jabatan ON tbl_pegawai.id_jabatan = tbl_jabatan.id_jabatan JOIN tbl_data_jabatan ON tbl_jabatan.jabatan = tbl_data_jabatan.kode_jabatan JOIN tbl_data_email_pegawai ON tbl_pegawai.nik = tbl_data_email_pegawai.nip_pegawai JOIN tbl_no_telp ON tbl_pegawai.id_telp = tbl_no_telp.id_telp WHERE tbl_pegawai.ket=?",$columns,$array_ket);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
            $ResultData[] = $value->nik;
            $ResultData[] = $value->nama;
            $ResultData[] = $value->nama_jabatan;
            $ResultData[] = $value->email_pegawai. $value->domain;
            $ResultData[] = $value->hp;
        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll,

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

} else if ($tampil == 'technician-pkl') {
    //kolom apa saja yang akan ditampilkan
    $columns = array(
        'tbl_pegawai.nik',
        'nama',
        'tbl_data_jabatan.nama_jabatan',
        'tbl_no_telp.hp',
        );


    //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
        //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
    //prepared statement untuk keamanan data
    /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
        $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
    from provinsi inner join kabupaten 
    on provinsi.id_prov=kabupaten.id_prov
    inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

    //untuk mencobanya uncomment query diatas dan comment query dibawah

    //lakukan query data dari 3 table dengan inner join
        $array_ket = array('tbl_pegawai.ket' => "Aktif",'tbl_status.status_peg' => "STP0003");
        $array_status = array('tbl_status.status_peg' => "STP0003");
        $query = $datatable->get_custom("SELECT * FROM tbl_pegawai JOIN tbl_jabatan ON tbl_pegawai.id_jabatan = tbl_jabatan.id_jabatan JOIN tbl_data_jabatan ON tbl_jabatan.jabatan = tbl_data_jabatan.kode_jabatan JOIN tbl_status ON tbl_pegawai.id_status = tbl_status.id_status JOIN tbl_data_status_pegawai ON tbl_status.status_peg = tbl_data_status_pegawai.kode_status JOIN tbl_no_telp ON tbl_pegawai.id_telp = tbl_no_telp.id_telp WHERE tbl_pegawai.ket=? AND tbl_status.status_peg=?",$columns,$array_ket);


        //buat inisialisasi array data
        $data = array();

        $no = 1;
        foreach ($query as $value) {

        //array sementara data
        $ResultData = array();
        
        //masukan data ke array sesuai kolom table
            $ResultData[] = $value->nik;
            $ResultData[] = $value->nama;
            $ResultData[] = $value->nama_jabatan;
            $ResultData[] = $value->hp;
        //bisa juga pake logic misal jika value tertentu maka outputnya

        //kita bisa buat tombol untuk keperluan edit, delete, dll,

        //memasukan array ke variable $data

        $data[] = $ResultData;
        $no++;
        }

    //set data
    $datatable->set_data($data);
    //create our json
    $datatable->create_data();

}
//  else if ($tampil == 'income-wo') {
//     //kolom apa saja yang akan ditampilkan
//     $columns = array(
//         'tbl_project_wo.wo_id',
//         'tbl_project_wo.so_id',
//         'tbl_income.no_ba',
//         'tbl_income.tglba',
//         'tbl_income.boq',
//         'tbl_income.price',
//         );


//     //jika ingin langsung menambahkan kondisi where dengan parameter terentu query seperti ini 
//         //misal kita akan langsung menambahkan kondisi langsung hanya menampilkan provinsi jawabarat saja, 
//     //prepared statement untuk keamanan data
//     /*$array_id_provinsi = array('provinsi.id_prov' => 32); //32 adalah id untuk jawabarat
//         $query = $datatable->get_custom("select provinsi.nama_prov,kabupaten.nama_kab, kecamatan.nama_kec,id_kec
//     from provinsi inner join kabupaten 
//     on provinsi.id_prov=kabupaten.id_prov
//     inner join kecamatan on kabupaten.id_kab=kecamatan.id_kab where provinsi.id_prov=?",$columns,$array_id_provinsi);*/

//     //untuk mencobanya uncomment query diatas dan comment query dibawah

//     //lakukan query data dari 3 table dengan inner join
//         $array_ket = array('tbl_pegawai.ket' => "Aktif",'tbl_status.status_peg' => "STP0003");
//         $array_status = array('tbl_project_wo.wo_id' => $p_wo);
//         $query = $datatable->get_custom("SELECT * FROM tbl_kode_income join tbl_income on tbl_income.kd_income = tbl_kode_income.kd_income join tbl_income_detail on tbl_income_detail.kd_detail = tbl_kode_income.kd_detail JOIN tbl_project_wo ON tbl_income.wo_id = tbl_project_wo.wo_id WHERE tbl_project_wo.wo_id like '%".$array_status."%'",$columns);


//         //buat inisialisasi array data
//         $data = array();

//         $no = 1;
//         foreach ($query as $value) {

//         //array sementara data
//         $ResultData = array();
        
//         //masukan data ke array sesuai kolom table
//             $ResultData[] = $no;
//             $ResultData[] = $value->wo_id;
//             $ResultData[] = $value->so_id;
//             $ResultData[] = $value->no_ba;
//             $ResultData[] = $value->tglba;
//             $ResultData[] = $value->boq;
//             $ResultData[] = $value->price;

//         //bisa juga pake logic misal jika value tertentu maka outputnya

//         //kita bisa buat tombol untuk keperluan edit, delete, dll,

//         //memasukan array ke variable $data

//         $data[] = $ResultData;
//         $no++;
//         }

//     //set data
//     $datatable->set_data($data);
//     //create our json
//     $datatable->create_data();

// }