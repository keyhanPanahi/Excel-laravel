<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Print report</title>

    <!-- Stimusloft Reports.JS -->
    <script src="{{ asset('admin-assets/audio/stimulsoft/css/stimulsoft.viewer.office2013.whiteblue.css') }}"></script> <!-- Jquery Validation Plugin Css -->
    <script src="{{ asset('admin-assets/audio/stimulsoft/stimulsoft.reports.js') }}"></script> <!-- Jquery Validation Plugin Css -->
    <script src="{{ asset('admin-assets/audio/stimulsoft/stimulsoft.viewer.js') }}"></script> <!-- Jquery Validation Plugin Css -->

</head>

<body>
Load 'SimpleList' report template, render and export it.
<br><br>

<script type="text/javascript">
    // Create a new report instance
    var report = new Stimulsoft.Report.StiReport();
    // Load report from url
    report.loadFile("{{ asset('admin-assets/audio/Report-5.mrt') }}");


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

<a href="#" onclick="saveReportPdf()">Show the PDF report (or save it, if blob is not supported)</a><br>
<br><br>
<div id="htmlContainer"></div>
</body>

</html>










