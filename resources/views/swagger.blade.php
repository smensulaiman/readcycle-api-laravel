<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadCycle API Documentation - Swagger UI</title>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/swagger-ui-dist@5.9.0/swagger-ui.css" />
    <style>
        html {
            box-sizing: border-box;
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }
        *, *:before, *:after {
            box-sizing: inherit;
        }
        body {
            margin:0;
            background: #fafafa;
        }
        .swagger-ui .topbar {
            background-color: #0a6d3a;
        }
        .swagger-ui .topbar .download-url-wrapper .download-url-button {
            background-color: #35875b;
        }
        .swagger-ui .btn.authorize {
            background-color: #0a6d3a;
            border-color: #0a6d3a;
        }
        .swagger-ui .btn.authorize:hover {
            background-color: #35875b;
            border-color: #35875b;
        }
        .swagger-ui .opblock.opblock-post {
            border-color: #0a6d3a;
        }
        .swagger-ui .opblock.opblock-post .opblock-summary {
            border-color: #0a6d3a;
        }
        .swagger-ui .opblock.opblock-get {
            border-color: #61affe;
        }
        .swagger-ui .opblock.opblock-put {
            border-color: #fca130;
        }
        .swagger-ui .opblock.opblock-delete {
            border-color: #f93e3e;
        }
    </style>
</head>
<body>
    <div id="swagger-ui"></div>
    <script src="https://unpkg.com/swagger-ui-dist@5.9.0/swagger-ui-bundle.js"></script>
    <script src="https://unpkg.com/swagger-ui-dist@5.9.0/swagger-ui-standalone-preset.js"></script>
    <script>
        window.onload = function() {
            const ui = SwaggerUIBundle({
                url: '/api-docs',
                dom_id: '#swagger-ui',
                deepLinking: true,
                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],
                plugins: [
                    SwaggerUIBundle.plugins.DownloadUrl
                ],
                layout: "StandaloneLayout",
                tryItOutEnabled: true,
                requestInterceptor: function(request) {
                    // Add Bearer token if available
                    const token = localStorage.getItem('api_token');
                    if (token) {
                        request.headers.Authorization = 'Bearer ' + token;
                    }
                    return request;
                },
                onComplete: function() {
                    // Add custom authentication button
                    const authButton = document.createElement('button');
                    authButton.innerHTML = '🔑 Set API Token';
                    authButton.className = 'btn authorize';
                    authButton.style.marginLeft = '10px';
                    authButton.onclick = function() {
                        const token = prompt('Enter your API token:');
                        if (token) {
                            localStorage.setItem('api_token', token);
                            alert('Token saved! Refresh the page to use it.');
                        }
                    };
                    document.querySelector('.topbar .download-url-wrapper').appendChild(authButton);
                }
            });
        };
    </script>
</body>
</html>
