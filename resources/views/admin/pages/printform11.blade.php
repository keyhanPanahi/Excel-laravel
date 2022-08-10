<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"  />
    <title>چاپ کاربر</title>

    <!-- Stimusloft Reports.JS -->
{{--    <script src="{{ asset('admin-assets/audio/stimulsoft/css/stimulsoft.viewer.office2013.whiteblue.css') }}"></script> <!-- Jquery Validation Plugin Css -->--}}
    <script src="{{ asset('admin-assets/audio/stimulsoft/stimulsoft.reports.js') }}"></script> <!-- Jquery Validation Plugin Css -->
{{--    <script src="{{ asset('admin-assets/audio/stimulsoft/stimulsoft.viewer.js') }}"></script> <!-- Jquery Validation Plugin Css -->--}}
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/css/rtl/rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" >
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css">
</head>

<body>
<div class="p-2 bd-highlight text-center ">

<h2 class="text-center">برای چاپ کاربر مورد نظر از دکمه زیر استفاده کنید</h2>
<br>
<a href="{{ route('admin.membership.user.index') }}" class="btn btn-lg btn-secondary text-white cen justify-content-center align-content-center" >بازگشت</a>
<button type="button" onclick="saveReportPdf()" class="btn btn-lg btn-primary" >چاپ فرم</button>
</div>


<script type="text/javascript">
    // Create a new report instance
    var report = new Stimulsoft.Report.StiReport();
    // Load report from url
    report.loadFile("{{ asset('admin-assets/audio/Report-6.mrt') }}");


    var json = {!! $print !!};
    var dataSet = new Stimulsoft.System.Data.DataSet("json");


    dataSet.readJson(json);
    report.regData("json", "json", dataSet);
    // Render report


    report.renderAsync();

    // Export report to PDF format and save to file
    function saveReportPdf() {
        // Export to PDF
        report.exportDocumentAsync(function (pdfData) {
            // Create blob data
            var blob = new Blob([new Uint8Array(pdfData)], { type: "application/pdf" });

            if (window.navigator && window.navigator.msSaveOrOpenBlob) {
                // Internet Explorer does not support the output of blob data, only save as PDF file
                var fileName = report.reportAlias;
                window.navigator.msSaveOrOpenBlob(blob, fileName + ".pdf");
            } else {
                // Show the new tab with the blob data
                var fileURL = URL.createObjectURL(blob);
                window.open(fileURL);
            };
        }, Stimulsoft.Report.StiExportFormat.Pdf);
    }
</script>

<br><br>
{{--<div id="htmlContainer"></div>--}}
</body>

</html>


