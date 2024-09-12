<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlipperSnare - XsanLahci</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/theme/dracula.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/xml/xml.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/css/css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/htmlmixed/htmlmixed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .CodeMirror {
            height: auto;
        }
        /* Ensure dark mode is applied correctly */
        html.dark .dark\:bg-gray-800 {
            background-color: #2d3748;
        }
        html.dark .dark\:text-gray-300 {
            color: #e2e8f0;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 p-6 transition-all duration-300">

    <!-- Toggle Dark Mode Button -->
    <div class="text-right mb-4">
        <button onclick="toggleDarkMode()" class="bg-gray-800 text-white p-2 rounded">Dark Mode</button>
    </div>

    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800 dark:text-gray-100">FlipperSnare - "Flipper Zero" & "snare"</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">

            <!-- Left side: Source code input -->
            <div class="border-r-0 md:border-r-2 pr-0 md:pr-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-700 dark:text-gray-300">Source HTML/PHP</h2>
                <textarea id="source" rows="15" class="w-full p-3 text-sm border rounded-md focus:ring-2 focus:ring-blue-500"></textarea>
                <button onclick="updatePreview()" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                    Submit
                </button>
            </div>

            <!-- Right side: Live preview with resizable options -->
            <div class="pl-0 md:pl-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-700 dark:text-gray-300">Live Preview</h2>
                <iframe id="preview" class="border border-gray-300 rounded-md shadow" style="width: 100%; height: 400px;"></iframe>

                <!-- Width and Height Sliders -->
                <div class="mt-4">
                    <label for="width-slider" class="block text-gray-700 dark:text-gray-300 font-semibold">Width: <span id="width-value">100%</span></label>
                    <input type="range" id="width-slider" min="300" max="1200" value="1000" class="w-full mb-4" oninput="adjustPreview()">

                    <label for="height-slider" class="block text-gray-700 dark:text-gray-300 font-semibold">Height: <span id="height-value">400px</span></label>
                    <input type="range" id="height-slider" min="300" max="1000" value="400" class="w-full" oninput="adjustPreview()">
                </div>
                <!-- Download button for saving the HTML content -->
        <div class="text-center mt-8">
            <button onclick="downloadCode()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded shadow">
                Download HTML
            </button>
        </div>
            </div>

        </div>

        

        <!-- Validation results -->
        <div class="mt-8 p-4 bg-red-100 dark:bg-red-800 rounded-lg text-red-700 dark:text-red-300 hidden" id="validation-result">
            <strong>Validation Error:</strong>
            <span id="validation-message"></span>
        </div>
    </div>

    <script>
        // Syntax highlighting initialization
        const editor = CodeMirror.fromTextArea(document.getElementById('source'), {
            lineNumbers: true,
            mode: "htmlmixed",
            theme: "dracula"
        });

        function updatePreview() {
            const code = editor.getValue();
            const previewFrame = document.getElementById('preview').contentWindow.document;
            previewFrame.open();
            previewFrame.write(code);
            previewFrame.close();

            // Perform validation
            validateHTML(code);
        }

        function downloadCode() {
            const code = editor.getValue();
            const blob = new Blob([code], { type: 'text/html' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'source.html';
            link.click();
        }

        function adjustPreview() {
            const width = document.getElementById('width-slider').value;
            const height = document.getElementById('height-slider').value;
            const preview = document.getElementById('preview');
            preview.style.width = width + 'px';
            preview.style.height = height + 'px';
            document.getElementById('width-value').innerText = width + 'px';
            document.getElementById('height-value').innerText = height + 'px';
        }

        // Toggle dark mode
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
        }

        // Auto-save to localStorage
        editor.on('change', () => {
            localStorage.setItem('userCode', editor.getValue());
        });

        window.addEventListener('DOMContentLoaded', () => {
            const savedCode = localStorage.getItem('userCode');
            if (savedCode) {
                editor.setValue(savedCode);
            }
        });

        // Validate HTML structure
        function validateHTML(code) {
            const parser = new DOMParser();
            const doc = parser.parseFromString(code, 'text/html');
            const errorNode = doc.querySelector('parsererror');

            const validationResult = document.getElementById('validation-result');
            const validationMessage = document.getElementById('validation-message');

            if (errorNode) {
                validationMessage.textContent = errorNode.textContent;
                validationResult.classList.remove('hidden');
            } else {
                validationResult.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
