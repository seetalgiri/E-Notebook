<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            position: relative;
        }

        #pdfModal {
            height: 100vh;
            width: 100%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            inset: 0;
        }

        .modal-header {
            width: 100%;
            background-color: red;
        }



        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            margin: 10% auto;
            max-width: 800px;
            background-color: #fff;
            position: relative;
            overflow: hidden;
        }

        iframe {
            width: 100%;
            height: 600px;
            border: none;
        }

        .modal-content {
            min-height: 500px;
            overflow: auto;
            scroll-behavior: smooth;
            position: relative;
            min-width: 500px;
            max-height: 600px;
        }

        .modal-header {
            height: 500px;
        }


        .modal-body {
            height: 100%;
            background-color: lightgreen;
        }

        .modal-content::-webkit-scrollbar {
            width: 6px;
            /* Set the width of the scrollbar */
        }

        .modal-content::-webkit-scrollbar-track {
            background-color: transparent;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background-color: #888;
            /* Set the color of the scrollbar thumb */
            border-radius: 3px;
            /* Add rounded corners to the scrollbar thumb */
        }

        .modal-content::-webkit-scrollbar-thumb:hover {
            background-color: #555;
            /* Set the color of the scrollbar thumb on hover */
        }

        #toolbar {
            display: none !important;
        }

        #pdfModalContent {
            display: none;
        }

        .close {
            position: absolute;
            top: -10px;
            right: -20px;
            font-size: 28px;
            font-weight: bold;
            color: #000;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <button id="openModalBtn">Open PDF</button>
    <div id="pdfModalContent">
        <div id="pdfModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modal-header">
                    <h2>PDF Viewer</h2>
                    <p>Some additional information or description can be placed here.</p>
                </div>
                <div class="modal-body">
                    <iframe id="pdfViewer" src="" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>


    <script>
        var openModalBtn = document.getElementById('openModalBtn');
        var pdfModal = document.getElementById('pdfModalContent');
        var pdfViewer = document.getElementById('pdfViewer');
        var closeBtn = document.getElementsByClassName('close')[0];

        openModalBtn.addEventListener('click', function() {
            var pdfUrl = 'http://localhost/e_notebook/server/uploads/notes/64785ba5294c77.15711811.pdf';
            pdfViewer.src = pdfUrl;
            pdfModal.style.display = 'block';
        });

        closeBtn.addEventListener('click', function() {
            pdfModal.style.display = 'none';
            // window.location.reload();
        });

        var modalContent = document.querySelector('.modal-content');

        modalContent.addEventListener('scroll', function() {
            var scrollY = modalContent.scrollTop;
            const scrollContent = Math.ceil(scrollY)
            console.log(scrollContent);
            const modaHeader = document.querySelector('.modal-header');
            if (scrollContent > 250) {
                modaHeader.style.display = 'none';
                modalContent.style.overflow = 'hidden';
            }
        });
    </script>

</body>

</html>