<!DOCTYPE html>
<html>

<head>
    <title>Downloadable HTML</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .download-link {
            display: block;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>Downloadable HTML</h1>
    <p>This is a downloadable HTML file.</p>

    <!-- Download link -->
    <a class="download-link" href="#" onclick="downloadHTML()">Download HTML</a>
    <a href="http://localhost/e_notebook/server/uploads/notes/647891fd769951.96130086.pdf" download="myfile.pdf">Download PDF</a>

    <script>
        function downloadHTML() {
            var htmlContent = "http://localhost/e_notebook/server/uploads/notes/647891fd769951.96130086.pdf";
            var downloadLink = document.createElement("a");
            downloadLink.href = "data:text/html;charset=utf-8," + encodeURIComponent(htmlContent);
            downloadLink.download = "downloadable.html";
            downloadLink.click();
        }
    </script>
</body>

</html>