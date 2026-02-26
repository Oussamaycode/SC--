<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Colocation - ColocManager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar { transition: all 0.3s; }
        .card-hover { transition: all 0.3s; }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="sidebar w-64 bg-white shadow-lg fixed h-full z-10">
            <div class="p-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-home text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-800">ColocManager</span>
                </div>
            </div>

            <nav class="px-4 pb-4">
                <div class="space-y-1">
                    <a href="dashboard.html" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition">
                        <i class="fas fa-chart-pie w-5"></i>
                        Tableau de bord
                    </a>
                    <a href="colocation.html" class="flex items-center gap-3 px-4 py-3 bg-indigo-50 text-indigo-600 rounded-lg font-medium">
                        <i class="fas fa-house-user w-5"></i>
                        Ma Colocation
                    </a>
                    <a href="expenses.html" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition">
                        <i class="fas fa-receipt w-5"></i>
                        Dépenses
                    </a>
                    <a href="balances.html" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition">
                        <i class="fas fa-scale-balanced w-5"></i>
                        Soldes
                    </a>
                    <a href="members.html" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition">
                        <i class="fas fa-users w-5"></i>
                        Membres
                    </a>
                                        <a href="join-colocation.html" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition">
                        <i class="fas fa-sign-in-alt w-5"></i>
                        Rejoindre
                    </a>
                </div>

                @can('show-administration')
                <div class="mt-8 pt-4 border-t border-gray-200">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Administration</p>
                    <a href="admin.html" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition">
                        <i class="fas fa-shield-alt w-5"></i>
                        Panel Admin
                    </a>
                </div>
                @endcan
            </nav>

            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200">
                <div class="flex items-center gap-3 px-4 py-2">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-gray-600"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">Jean Dupont</p>
                        <p class="text-xs text-gray-500 truncate">jean@email.com</p>
                    </div>
                    <a href="login.html" class="text-gray-400 hover:text-red-500 transition">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8 overflow-auto">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Appartement Paris</h1>
                    <p class="text-gray-500 mt-1">12 rue de la Paix, 75002 Paris</p>
                </div>
                @can('cancel-colocation')
                <div class="flex items-center gap-3">
                    <button onclick="openCancelModal()" class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                        <i class="fas fa-times-circle mr-2"></i>Annuler la colocation
                    </button>
                </div>
                @endcan
            </div>

            <!-- Status Banner -->
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-8 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-green-800">Colocation active</p>
                        <p class="text-sm text-green-600">Créée le 15 janvier 2024</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-green-200 text-green-800 rounded-full text-sm font-medium">3 membres actifs</span>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl p-6 shadow-sm card-hover">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-receipt text-indigo-600 text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total dépenses</p>
                            <p class="text-2xl font-bold text-gray-800">€1,247.50</p>
                            <p class="text-xs text-gray-400">Ce mois</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm card-hover">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-wallet text-emerald-600 text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Budget moyen/membre</p>
                            <p class="text-2xl font-bold text-gray-800">€415.83</p>
                            <p class="text-xs text-gray-400">Ce mois</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm card-hover">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-chart-line text-purple-600 text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Dépenses ce mois</p>
                            <p class="text-2xl font-bold text-gray-800">24</p>
                            <p class="text-xs text-gray-400">Transactions</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <h2 class="text-lg font-bold text-gray-800 mb-6">Dépenses par catégorie</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="p-4 bg-blue-50 rounded-xl text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                        </div>
                        <p class="font-medium text-gray-800">Alimentation</p>
                        <p class="text-lg font-bold text-blue-600">€456.00</p>
                        <p class="text-xs text-gray-500">36.5%</p>
                    </div>
                    <div class="p-4 bg-purple-50 rounded-xl text-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-bolt text-purple-600 text-xl"></i>
                        </div>
                        <p class="font-medium text-gray-800">Charges</p>
                        <p class="text-lg font-bold text-purple-600">€324.50</p>
                        <p class="text-xs text-gray-500">26.0%</p>
                    </div>
                    <div class="p-4 bg-orange-50 rounded-xl text-center">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-utensils text-orange-600 text-xl"></i>
                        </div>
                        <p class="font-medium text-gray-800">Loisirs</p>
                        <p class="text-lg font-bold text-orange-600">€287.00</p>
                        <p class="text-xs text-gray-500">23.0%</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl text-center">
                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-ellipsis-h text-gray-600 text-xl"></i>
                        </div>
                        <p class="font-medium text-gray-800">Autres</p>
                        <p class="text-lg font-bold text-gray-600">€180.00</p>
                        <p class="text-xs text-gray-500">14.5%</p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-gray-800">Activité récente</h2>
                    <a href="expenses.html" class="text-indigo-600 text-sm font-medium hover:underline">Voir tout l'historique</a>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-blue-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">Courses hebdomadaires</p>
                            <p class="text-sm text-gray-500">Marie Lefebvre • Aujourd'hui</p>
                        </div>
                        <span class="font-medium text-gray-800">€87.50</span>
                    </div>
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bolt text-purple-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">Facture électricité - Février</p>
                            <p class="text-sm text-gray-500">Vous • Hier</p>
                        </div>
                        <span class="font-medium text-gray-800">€124.00</span>
                    </div>
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-hand-holding-dollar text-green-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">Remboursement - Pierre D.</p>
                            <p class="text-sm text-gray-500">Pierre Durand • Il y a 2 jours</p>
                        </div>
                        <span class="font-medium text-green-600">+€45.00</span>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Edit Colocation Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Modifier la colocation</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editColocForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                    <input type="text" value="Appartement Paris" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
                    <input type="text" value="12 rue de la Paix, 75002 Paris" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeEditModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Annuler</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cancel Colocation Modal -->
    <div id="cancelModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Annuler la colocation ?</h3>
                <p class="text-gray-500 mt-2">Cette action est irréversible. Toutes les données seront conservées mais la colocation sera marquée comme annulée.</p>
            </div>
            <div class="bg-yellow-50 p-4 rounded-lg mb-6">
                <p class="text-sm text-yellow-700">
                    <i class="fas fa-info-circle mr-2"></i>
                    Les soldes en cours devront être réglés avant l'annulation.
                </p>
            </div>
            <div class="flex gap-3">
                <button onclick="closeCancelModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Non, garder</button>
                <button onclick="confirmCancel()" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Oui, annuler</button>
            </div>
        </div>
    </div>

    <script>
        function openEditModal() {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        }
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
        }
        function openCancelModal() {
            document.getElementById('cancelModal').classList.remove('hidden');
            document.getElementById('cancelModal').classList.add('flex');
        }
        function closeCancelModal() {
            document.getElementById('cancelModal').classList.add('hidden');
            document.getElementById('cancelModal').classList.remove('flex');
        }
        function confirmCancel() {
            alert('Colocation annulée avec succès');
            closeCancelModal();
        }

        document.getElementById('editColocForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Modifications enregistrées !');
            closeEditModal();
        });

        window.onclick = function(event) {
            if (event.target.classList.contains('fixed')) {
                event.target.classList.add('hidden');
                event.target.classList.remove('flex');
            }
        }
    </script>
</body>
</html>
