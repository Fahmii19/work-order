$(document).ready(function(){
        $('#nama').autocomplete({
          minLength: 2, //minimal huruf saat autocomplete di proses
          source: '../search.php', //file untuk mencari data mahasiswa
          select:function(event, ui){
            $('#nama').val(ui.item.nama);
            $('#nis').val(ui.item.nis);
            $('#alamat').val(ui.item.alamat);
            $('#telp').html(ui.item.telp);
          }
        })
      });