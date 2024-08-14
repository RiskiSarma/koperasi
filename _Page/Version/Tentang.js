// Load initial content for the 'Tentang' section
$('#MenampilkanTabelTentang').html("Loading...");
$('#MenampilkanTabelTentang').load("_Page/Tentang/profil.php");

// Handle changes to the batas filter in the 'Tentang' section
$('#BatasTentang').change(function() {
    var ProsesBatasTentang = $('#ProsesBatasTentang').serialize();
    $('#MenampilkanTabelTentang').html('Loading...');
    $.ajax({
        type: 'POST',
        url: '_Page/Tentang/TabelTentang.php',
        data: ProsesBatasTentang,
        success: function(data) {
            $('#MenampilkanTabelTentang').html(data);
        }
    });
});

// Handle changes to the sorting order in the 'Tentang' section
$('#OrderBy').change(function() {
    var ProsesBatasTentang = $('#ProsesBatasTentang').serialize();
    $('#MenampilkanTabelTentang').html('Loading...');
    $.ajax({
        type: 'POST',
        url: '_Page/Tentang/TabelTentang.php',
        data: ProsesBatasTentang,
        success: function(data) {
            $('#MenampilkanTabelTentang').html(data);
        }
    });
});

// Handle changes to the shorting method in the 'Tentang' section
$('#ShortBy').change(function() {
    var ProsesBatasTentang = $('#ProsesBatasTentang').serialize();
    $('#MenampilkanTabelTentang').html('Loading...');
    $.ajax({
        type: 'POST',
        url: '_Page/Tentang/TabelTentang.php',
        data: ProsesBatasTentang,
        success: function(data) {
            $('#MenampilkanTabelTentang').html(data);
        }
    });
});

// Handle keyword search in the 'Tentang' section
$('#keyword_by').change(function() {
    var keyword_by = $('#keyword_by').val();
    $('#FormKeywordTentang').html('Loading...');
    $.ajax({
        type: 'POST',
        url: '_Page/Tentang/FormKeywordTentang.php',
        data: { keyword_by: keyword_by },
        success: function(data) {
            $('#FormKeywordTentang').html(data);
        }
    });
});

// Handle form submission for batas filter in the 'Tentang' section
$('#ProsesBatasTentang').submit(function() {
    var ProsesBatasTentang = $('#ProsesBatasTentang').serialize();
    $('#MenampilkanTabelTentang').html('Loading...');
    $.ajax({
        type: 'POST',
        url: '_Page/Tentang/TabelTentang.php',
        data: ProsesBatasTentang,
        success: function(data) {
            $('#MenampilkanTabelTentang').html(data);
        }
    });
});

// Handle changes to the time mode in the 'Tentang' section
$('#mode_waktu').change(function() {
    var mode_waktu = $('#mode_waktu').val();
    $('#form_bulan').html('Loading...');
    $.ajax({
        type: 'POST',
        url: '_Page/Tentang/FormBulan.php',
        data: { mode_waktu: mode_waktu },
        success: function(data) {
            $('#form_bulan').html(data);
        }
    });
});

// Handle form submission for recap data in the 'Tentang' section
$('#ProsesRekapTentang').submit(function() {
    var ProsesRekapTentang = $('#ProsesRekapTentang').serialize();
    $('#MenampilkanRekapTentang').html('Loading...');
    $.ajax({
        type: 'POST',
        url: '_Page/Tentang/TabelRekapTentang.php',
        data: ProsesRekapTentang,
        success: function(data) {
            $('#MenampilkanRekapTentang').html(data);
        }
    });
});

// Load initial content for the 'Tentang Email' section
$('#MenampilkanTabelTentangEmail').html("Loading...");
$('#MenampilkanTabelTentangEmail').load("_Page/Tentang/TabelTentangEmail.php");

// Handle changes to the batas filter in the 'Tentang Email' section
$('#BatasTentangEmail').change(function() {
    var BatasTentangEmail = $('#BatasTentangEmail').serialize();
    $('#MenampilkanTabelTentangEmail').html('Loading...');
    $.ajax({
        type: 'POST',
        url: '_Page/Tentang/TabelTentangEmail.php',
        data: BatasTentangEmail,
        success: function(data) {
            $('#MenampilkanTabelTentangEmail').html(data);
        }
    });
});

// Handle form submission for batas filter in the 'Tentang Email' section
$('#ProsesBatasTentangEmail').submit(function() {
    var ProsesBatasTentangEmail = $('#ProsesBatasTentangEmail').serialize();
    $('#MenampilkanTabelTentangEmail').html('Loading...');
    $.ajax({
        type: 'POST',
        url: '_Page/Tentang/TabelTentangEmail.php',
        data: ProsesBatasTentangEmail,
        success: function(data) {
            $('#MenampilkanTabelTentangEmail').html(data);
        }
    });
});

// Handle modal filter submission for 'Tentang Email' section
$('#ModalFilterTentangEmail').submit(function() {
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelTentangEmail').html('Loading...');
    $.ajax({
        type: 'POST',
        url: '_Page/Tentang/TabelTentangEmail.php',
        data: { BatasTentangEmail: batas, OrderBy: OrderBy, ShortBy: ShortBy, keyword_by: KeywordBy, FilterKeyword: FilterKeyword },
        success: function(data) {
            $('#MenampilkanTabelTentangEmail').html(data);
            $('#ModalFilterTentangEmail').modal('hide');
        }
    });
});

// Load initial content for the 'Tentang APIs' section
$('#MenampilkanTabelTentangApis').html("Loading...");
$('#MenampilkanTabelTentangApis').load("_Page/Tentang/TabelTentangApis.php");

// Handle changes to the batas filter in the 'Tentang APIs' section
$('#BatasTentangApis').change(function() {
    var BatasTentangApis = $('#BatasTentangApis').serialize();
    $('#MenampilkanTabelTentangApis').html('Loading...');
    $.ajax({
        type: 'POST',
        url: '_Page/Tentang/TabelTentangApis.php',
        data: BatasTentangApis,
        success: function(data) {
            $('#MenampilkanTabelTentangApis').html(data);
        }
    });
});

// Handle form submission for batas filter in the 'Tentang APIs' section
$('#ProsesBatasTentangApis').submit(function() {
    var ProsesBatasTentangApis = $('#ProsesBatasTentangApis').serialize();
    $('#MenampilkanTabelTentangApis').html('Loading...');
    $.ajax({
        type: 'POST',
        url: '_Page/Tentang/TabelTentangApis.php',
        data: ProsesBatasTentangApis,
        success: function(data) {
            $('#MenampilkanTabelTentangApis').html(data);
        }
    });
});

// Handle form submission for filter in the 'Tentang APIs' section
$('#ProsesFilterTentangApis').submit(function() {
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelTentangApis').html('Loading...');
    $.ajax({
        type: 'POST',
        url: '_Page/Tentang/TabelTentangApis.php',
        data: { BatasTentangApis: batas, OrderBy: OrderBy, ShortBy: ShortBy, keyword_by: KeywordBy, FilterKeyword: FilterKeyword },
        success: function(data) {
            $('#MenampilkanTabelTentangApis').html(data);
            $('#ModalFilterTentangApis').modal('hide');
        }
    });
});

// Handle changes to the dataset dropdown in the 'Tentang' section
$('#DataSet').change(function() {
    var DataSet = $('#DataSet').val();
    $('#DataValue').html('<option>Loading...</option>');
    $.ajax({
        type: 'POST',
        url: '_Page/Tentang/DataValue.php',
        data: { DataSet: DataSet },
        success: function(data) {
            $('#DataValue').html(data);
        }
    });
});

// Render chart for the 'Tentang' section
var ProsesTampilkanGrafikTentang = $('#ProsesTampilkanGrafikTentang').serialize();
var NamaData2 = "Log Tentang";
$.ajax({
    type: 'POST',
    url: '_Page/Tentang/ProsesTampilkanGrafikTentang.php',
    data: ProsesTampilkanGrafikTentang,
    enctype: 'multipart/form-data',
    success: function(data) {
        var options = {
            chart: {
                height: 400,
                type: 'bar',
            },
            dataLabels: {
                enabled: false
            },
            series: [],
            noData: {
                text: 'No Data...'
            }
        }
        
        var chart = new ApexCharts(
            document.querySelector("#MenampilkanGrafikTentang"),
            options
        );
        var UrlData = '_Page/Tentang/GrafikTentang.json';
        
        $.getJSON(UrlData, function(response) {
            chart.updateSeries([{
                name: NamaData2,
                data: response
            }])
        });
        chart.render();
    }
});
