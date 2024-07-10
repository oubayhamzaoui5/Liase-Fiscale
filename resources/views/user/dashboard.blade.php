<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/user-dashboard.css') }}">
    <title>Depot Document</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}"/>
</head>
<body>
    <div class="overlay" id="overlay">
        <div class="loader" id="loader"></div>
    </div>
    <div class="container">
        <div class="header">
            <div class="logo-title">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" />
                </div>
                <div class="title">Depot Document</div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">déconnexion</button>
            </form>
        </div>

        @if (session('success'))
        <div class="alert alert-success" id="alertMessage">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" id="alertMessage">
            {{ session('error') }}
        </div>
    @endif

        <div class="user-info">
            <h2>Contribuable</h2>
            <br />
            <p><span>Matricule fiscale:</span> {{ Auth::user()->matricule_fiscale }}</p>
            <p><span>Raison sociale:</span> {{ Auth::user()->raison_sociale }}</p>
            <p><span>Adresse:</span> {{ Auth::user()->adresse }}</p>
        </div>
        <br />

        <div class="nav">
            <a href="{{ route('user.depot') }}" class="nav-link cur">Dépot</a>
            <a href="{{ route('user.suivi') }}" class="nav-link">Suivi des dépôt</a>
        </div>

        <div class="content" id="content">
            <!-- Content will be loaded here -->
        </div>
    </div>

    <!-- Modal for custom popup -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>

    <script>

document.addEventListener('DOMContentLoaded', function() {
        var alertMessage = document.getElementById('alertMessage');
        if (alertMessage) {
            alertMessage.style.display = 'block';
            setTimeout(function() {
                alertMessage.style.display = 'none';
            }, 5000);
        }
    });

        const overlay = document.getElementById("overlay");
        const loader = document.getElementById("loader");
        const modal = document.getElementById("myModal");
        const closeModal = document.querySelector(".close");
        const modalMessage = document.getElementById("modalMessage");
        let isNavigating = false; // Flag to manage navigation state

        function showModal(message) {
            modalMessage.textContent = message;
            modal.style.display = "block";
        }

        closeModal.onclick = function () {
            modal.style.display = "none";
        };

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };

        function showLoader() {
            overlay.style.display = "block";
            loader.style.display = "block";
        }

        function hideLoader() {
            setTimeout(() => {
                overlay.style.display = "none";
                loader.style.display = "none";
            }, 1000); // Delay of 1 second
        }

        document.querySelectorAll(".nav-link").forEach((link) => {
            link.addEventListener("click", function (event) {
                event.preventDefault();
                if (!isNavigating) {
                    const url = this.href;

                    // Remove "cur" class from all links
                    document
                        .querySelectorAll(".nav-link")
                        .forEach((link) => link.classList.remove("cur"));

                    // Add "cur" class to the clicked link
                    this.classList.add("cur");

                    loadPage(url);
                }
            });
        });

        function loadPage(url) {
            if (!isNavigating) {
                isNavigating = true; // Set navigation state
                fetch(url)
                    .then((response) => response.text())
                    .then((content) => {
                        document.getElementById("content").innerHTML = content;
                        attachFileUploadEvent(); // Reattach event listener to new content
                    })
                    .catch((error) => {
                        console.error("Error loading page:", error);
                    })
                    .finally(() => {
                        if (url.includes('suivi')) {
                            butns();
                        }
                        isNavigating = false; // Reset navigation state
                    });
            }
        }

        function attachFileUploadEvent() {
            document.querySelectorAll(".xml-upload").forEach((input) => {
                input.addEventListener("change", validate);
            });
        }

        function parseXML(xmlString) {
    const parser = new DOMParser();
    const xmlDoc = parser.parseFromString(xmlString, "application/xml");

    const isValid = xmlDoc.getElementsByTagName("parsererror").length === 0;
    return {
        isValid: isValid,
        xmlDoc: isValid ? xmlDoc : null,
        error: isValid ? null : xmlDoc.getElementsByTagName("parsererror")[0].textContent
    };
}

        async function validate(event) {
            const file = event.target.files[0];
            const row = event.target.closest("tr");
            const validityCell = row.querySelector(".validity");

            if (!file) {
                console.log("No file selected.");
                return;
            }

            const xmlString = await file.text();
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(xmlString, "application/xml");
            const result = parseXML(xmlString);

            // Perform basic validation (for demonstration purposes)

            // Check validation result
            if (result.isValid) {
                validityCell.textContent = "✔";
                validityCell.classList.remove("invalid");
                validityCell.classList.add("valid");
            } else {
                validityCell.textContent = "✘";
                validityCell.classList.remove("valid");
                validityCell.classList.add("invalid");
                showModal("Fichier non valide.");
            }
        }

        function checkAllDocumentsValid() {
            const validities = document.querySelectorAll(".validity");
            for (let validity of validities) {
                if (validity.textContent === "✘") {
                    showModal("Fichiers non valides.");
                    return false;
                }
            }
            return true;
        }

        // Attach the function to the window object
        window.validate = validate;

        showLoader();
        hideLoader();
        // Load default page
        loadPage("{{ route('user.depot') }}");

        function butns() {
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(2)');
                const button = row.querySelector('.pdf-button');
                console.log(statusCell.textContent.trim());
                if (statusCell && (statusCell.textContent.trim() === 'Refusée' || statusCell.textContent.trim() === 'En cours')) {
                    button.disabled = true;
                    button.style.cursor = 'not-allowed';
                }
            });
        }
    </script>
</body>
</html>
