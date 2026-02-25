<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejoindre une colocation - ColocManager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8">
        <!-- Back Button -->
        <a href="dashboard.html" class="inline-flex items-center text-gray-500 hover:text-gray-700 transition mb-6">
            <i class="fas fa-arrow-left mr-2"></i>
            Retour
        </a>

        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-indigo-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-envelope-open-text text-indigo-600 text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Rejoindre une colocation</h1>
            <p class="text-gray-500 mt-2">Entrez le code d'invitation que vous avez reçu par email</p>
        </div>

        <!-- Token Input Form -->
        <form method="POST" id="tokenForm" class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Code d'invitation</label>
                <div class="relative">
                    <i class="fas fa-key absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input 
                        type="text" 
                        id="invitationToken" 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition uppercase tracking-wider text-center text-lg font-mono" 
                        placeholder="XXXX-XXXX-XXXX" 
                        maxlength="14"
                        required
                    >
                </div>
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    Le code se trouve dans l'email d'invitation
                </p>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition duration-200 flex items-center justify-center gap-2">
                <span>Vérifier l'invitation</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <!-- Divider -->
        <div class="flex items-center my-6">
            <div class="flex-1 border-t border-gray-200"></div>
            <span class="px-4 text-sm text-gray-400">ou</span>
            <div class="flex-1 border-t border-gray-200"></div>
        </div>

        <!-- QR Code Option -->
        <button onclick="scanQRCode()" class="w-full border border-gray-300 text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-50 transition duration-200 flex items-center justify-center gap-2">
            <i class="fas fa-qrcode"></i>
            <span>Scanner un QR code</span>
        </button>

        <!-- Help -->
        <div class="mt-6 text-center">
            <p class="text-gray-500 text-sm">
                Vous n'avez pas de code ? 
                <a href="#" onclick="showHelp()" class="text-indigo-600 font-medium hover:text-indigo-700">Demander une invitation</a>
            </p>
        </div>
    </div>

    <!-- Invitation Details Modal (Hidden by default) -->
    <div id="invitationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
            <!-- Header with gradient -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6 text-center">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-home text-white text-2xl"></i>
                </div>
                <h2 class="text-xl font-bold text-white" id="colocName">Appartement Paris</h2>
                <p class="text-indigo-100 text-sm" id="colocAddress">12 rue de la Paix, 75002 Paris</p>
            </div>

            <!-- Invitation Details -->
            <div class="p-6">
                <div class="bg-gray-50 rounded-xl p-4 mb-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-indigo-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Invité par</p>
                            <p class="font-medium text-gray-800" id="inviterName">Jean Dupont</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-500">Membres actuels</span>
                            <span class="font-medium text-gray-800" id="memberCount">3 personnes</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Date de l'invitation</span>
                            <span class="font-medium text-gray-800" id="inviteDate">20 février 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Warning if user has active colocation -->
                <div id="activeColocWarning" class="hidden bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5"></i>
                        <div>
                            <p class="font-medium text-yellow-800">Vous avez déjà une colocation active</p>
                            <p class="text-sm text-yellow-700 mt-1">
                                Vous devez quitter votre colocation actuelle avant d'en rejoindre une nouvelle.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Email Verification -->
                <div class="bg-blue-50 rounded-lg p-4 mb-6">
                    <p class="text-sm text-blue-700">
                        <i class="fas fa-shield-alt mr-2"></i>
                        Cette invitation est destinée à : <strong id="targetEmail">marie@email.com</strong>
                    </p>
                </div>

                <!-- Actions -->
                <div class="flex gap-3">
                    <button onclick="closeInvitationModal()" class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                        Refuser
                    </button>
                    <button onclick="acceptInvitation()" class="flex-1 px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                        <i class="fas fa-check mr-2"></i>
                        Rejoindre
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-8 text-center">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check-circle text-green-600 text-4xl"></i>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">Bienvenue !</h2>
            <p class="text-gray-500 mb-6">
                Vous avez rejoint <strong id="successColocName">Appartement Paris</strong> avec succès.
            </p>
            <a href="dashboard.html" class="block w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition">
                Aller au tableau de bord
            </a>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-8 text-center">
            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-times-circle text-red-600 text-4xl"></i>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">Invitation invalide</h2>
            <p class="text-gray-500 mb-6" id="errorMessage">
                Ce code d'invitation n'est pas valide ou a expiré.
            </p>
            <button onclick="closeErrorModal()" class="w-full bg-gray-600 text-white py-3 rounded-lg font-medium hover:bg-gray-700 transition">
                Réessayer
            </button>
        </div>
    </div>

    <!-- Help Modal -->
    <div id="helpModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Demander une invitation</h3>
                <button onclick="closeHelpModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <p class="text-gray-500 mb-4">
                Pour rejoindre une colocation, vous devez recevoir une invitation du propriétaire. 
                Voici comment procéder :
            </p>
            <ol class="space-y-3 text-gray-600 mb-6">
                <li class="flex items-start gap-3">
                    <span class="w-6 h-6 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-sm font-medium flex-shrink-0">1</span>
                    <span>Contactez le propriétaire de la colocation</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-6 h-6 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-sm font-medium flex-shrink-0">2</span>
                    <span>Demandez-lui de vous envoyer une invitation à votre adresse email</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-6 h-6 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-sm font-medium flex-shrink-0">3</span>
                    <span>Cliquez sur le lien dans l'email ou entrez le code ici</span>
                </li>
            </ol>
            <button onclick="closeHelpModal()" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition">
                J'ai compris
            </button>
        </div>
    </div>

    <script>
        // Format token input with dashes
        document.getElementById('invitationToken').addEventListener('input', function(e) {
            let value = e.target.value.replace(/-/g, '').toUpperCase();
            let formatted = '';
            for (let i = 0; i < value.length && i < 12; i++) {
                if (i > 0 && i % 4 === 0) formatted += '-';
                formatted += value[i];
            }
            e.target.value = formatted;
        });

        // Token form submission
        document.getElementById('tokenForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const token = document.getElementById('invitationToken').value.replace(/-/g, '');
            
            // Simulate API call to verify token
            console.log('Vérification du token:', token);
            
            // For demo: show invitation modal (in real app, this would be after API validation)
            if (token.length >= 8) {
                showInvitationModal();
            } else {
                showErrorModal('Le code d\'invitation est trop court.');
            }
        });

        function showInvitationModal() {
            document.getElementById('invitationModal').classList.remove('hidden');
            document.getElementById('invitationModal').classList.add('flex');
        }

        function closeInvitationModal() {
            document.getElementById('invitationModal').classList.add('hidden');
            document.getElementById('invitationModal').classList.remove('flex');
        }

        function acceptInvitation() {
            // Simulate API call to accept invitation
            console.log('Acceptation de l\'invitation');
            
            closeInvitationModal();
            
            // Show success modal
            document.getElementById('successModal').classList.remove('hidden');
            document.getElementById('successModal').classList.add('flex');
        }

        function showSuccessModal() {
            document.getElementById('successModal').classList.remove('hidden');
            document.getElementById('successModal').classList.add('flex');
        }

        function showErrorModal(message) {
            if (message) {
                document.getElementById('errorMessage').textContent = message;
            }
            document.getElementById('errorModal').classList.remove('hidden');
            document.getElementById('errorModal').classList.add('flex');
        }

        function closeErrorModal() {
            document.getElementById('errorModal').classList.add('hidden');
            document.getElementById('errorModal').classList.remove('flex');
        }

        function showHelp() {
            document.getElementById('helpModal').classList.remove('hidden');
            document.getElementById('helpModal').classList.add('flex');
        }

        function closeHelpModal() {
            document.getElementById('helpModal').classList.add('hidden');
            document.getElementById('helpModal').classList.remove('flex');
        }

        function scanQRCode() {
            alert('Fonctionnalité de scan QR - À implémenter avec la caméra');
        }

        // Close modals on outside click
        window.onclick = function(event) {
            if (event.target.classList.contains('fixed')) {
                event.target.classList.add('hidden');
                event.target.classList.remove('flex');
            }
        }
    </script>
</body>
</html>
