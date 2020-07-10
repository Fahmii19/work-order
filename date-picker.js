$(function () {
    $('#datepicker1').datetimepicker({
        format: 'YYYY/MM/DD',
    });

    $('#datepicker').datetimepicker({
        format: 'MMMM',
    });

    $('#datepicker2').datetimepicker({
        format: 'YYYY',
    });

    $('#timepicker').datetimepicker({
        format: 'HH:mm'
    });
});