<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - ColocManager</title>
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
                    <a href="dashboard.html" class="flex items-center gap-3 px-4 py-3 bg-indigo-50 text-indigo-600 rounded-lg font-medium">
                        <i class="fas fa-chart-pie w-5"></i>
                        Tableau de bord
                    </a>
                    <a href="colocation.html" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition">
                        <i class="fas fa-house-user w-5"></i>
                        Ma Colocation
                    </a>
                    @can('add-expense')
                    <a href="{{routr('expense.index')}}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition">
                        <i class="fas fa-receipt w-5"></i>
                        Dépenses
                    </a>
                    @endcan
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
                    <h1 class="text-2xl font-bold text-gray-800">Tableau de bord</h1>
                    <p class="text-gray-500 mt-1">Bienvenue dans votre espace de gestion</p>
                </div>
                <div class="flex items-center gap-4">
                    <button class="p-2 text-gray-400 hover:text-gray-600 transition">
                        <i class="fas fa-bell text-xl"></i>
                    </button>
                    <button onclick="openCreateModal()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        Nouvelle colocation
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl p-6 shadow-sm card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Ma colocation</p>
                            <h3 class="text-lg font-bold text-gray-800">Appartement Paris</h3>
                        </div>
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-home text-indigo-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-500 flex items-center gap-1">
                            <i class="fas fa-check-circle"></i>
                            Active
                        </span>
                        <span class="text-gray-400 mx-2">•</span>
                        <span class="text-gray-500">3 membres</span>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Mes dépenses ce mois</p>
                            <h3 class="text-2xl font-bold text-gray-800">€245.00</h3>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-euro-sign text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-gray-500">12 transactions</span>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Mon solde</p>
                            <h3 class="text-2xl font-bold text-green-600">+€45.50</h3>
                        </div>
                        <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-wallet text-emerald-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-500 flex items-center gap-1">
                            <i class="fas fa-arrow-up"></i>
                            On vous doit de l'argent
                        </span>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Ma réputation</p>
                            <h3 class="text-2xl font-bold text-gray-800">+12</h3>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-star text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-500 flex items-center gap-1">
                            <i class="fas fa-thumbs-up"></i>
                            Excellente
                        </span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-bold text-gray-800">Dernières dépenses</h2>
                        <a href="expenses.html" class="text-indigo-600 text-sm font-medium hover:underline">Voir tout</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">Description</th>
                                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">Catégorie</th>
                                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">Payeur</th>
                                    <th class="text-right py-3 px-4 text-sm font-medium text-gray-500">Montant</th>
                                </tr>
                            </thead>
                            <tbody id="recentExpenses">
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-shopping-cart text-blue-600 text-sm"></i>
                                            </div>
                                            <span class="font-medium text-gray-800">Courses hebdomadaires</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">Alimentation</span>
                                    </td>
                                    <td class="py-3 px-4 text-gray-600">Marie L.</td>
                                    <td class="py-3 px-4 text-right font-medium text-gray-800">€87.50</td>
                                </tr>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-bolt text-purple-600 text-sm"></i>
                                            </div>
                                            <span class="font-medium text-gray-800">Facture électricité</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-medium">Charges</span>
                                    </td>
                                    <td class="py-3 px-4 text-gray-600">Vous</td>
                                    <td class="py-3 px-4 text-right font-medium text-gray-800">€124.00</td>
                                </tr>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-utensils text-orange-600 text-sm"></i>
                                            </div>
                                            <span class="font-medium text-gray-800">Dîner entre colocs</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-medium">Loisirs</span>
                                    </td>
                                    <td class="py-3 px-4 text-gray-600">Pierre D.</td>
                                    <td class="py-3 px-4 text-right font-medium text-gray-800">€45.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-6">Actions rapides</h2>
                    <div class="space-y-3">
                        <button onclick="openExpenseModal()" class="w-full flex items-center gap-4 p-4 rounded-lg border border-gray-200 hover:border-indigo-500 hover:bg-indigo-50 transition group">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center group-hover:bg-indigo-200 transition">
                                <i class="fas fa-plus text-indigo-600"></i>
                            </div>
                            <div class="text-left">
                                <p class="font-medium text-gray-800">Ajouter une dépense</p>
                                <p class="text-sm text-gray-500">Enregistrer une nouvelle dépense</p>
                            </div>
                        </button>

                        <button onclick="openInviteModal()" class="w-full flex items-center gap-4 p-4 rounded-lg border border-gray-200 hover:border-green-500 hover:bg-green-50 transition group">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition">
                                <i class="fas fa-user-plus text-green-600"></i>
                            </div>
                            <div class="text-left">
                                <p class="font-medium text-gray-800">Inviter un membre</p>
                                <p class="text-sm text-gray-500">Envoyer une invitation par email</p>
                            </div>
                        </button>

                        <a href="balances.html" class="w-full flex items-center gap-4 p-4 rounded-lg border border-gray-200 hover:border-emerald-500 hover:bg-emerald-50 transition group">
                            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-200 transition">
                                <i class="fas fa-hand-holding-dollar text-emerald-600"></i>
                            </div>
                            <div class="text-left">
                                <p class="font-medium text-gray-800">Régler mes dettes</p>
                                <p class="text-sm text-gray-500">Voir qui vous doit de l'argent</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Members Preview -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-gray-800">Membres de la colocation</h2>
                    <a href="members.html" class="text-indigo-600 text-sm font-medium hover:underline">Gérer les membres</a>
                </div>
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-medium">JD</div>
                        <div>
                            <p class="font-medium text-gray-800">Jean Dupont</p>
                            <span class="text-xs px-2 py-0.5 bg-indigo-100 text-indigo-700 rounded-full">Propriétaire</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center text-white font-medium">ML</div>
                        <div>
                            <p class="font-medium text-gray-800">Marie Lefebvre</p>
                            <span class="text-xs px-2 py-0.5 bg-gray-200 text-gray-700 rounded-full">Membre</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-medium">PD</div>
                        <div>
                            <p class="font-medium text-gray-800">Pierre Durand</p>
                            <span class="text-xs px-2 py-0.5 bg-gray-200 text-gray-700 rounded-full">Membre</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Create Colocation Modal -->
    <div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Nouvelle colocation</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form method='POST' action="{{route('colocation.store')}}" id="createColocForm" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom de la colocation</label>
                    <input name="name" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Ex: Appartement Paris" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Adresse (optionnel)</label>
                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Ex: 12 rue de la Paix, Paris">
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeCreateModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Annuler</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Créer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Expense Modal -->
    <div id="expenseModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Nouvelle dépense</h3>
                <button onclick="closeExpenseModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="addExpenseForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Ex: Courses hebdomadaires" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Montant (€)</label>
                        <input type="number" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="0.00" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                        <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>
                        <option value="">Sélectionner une catégorie</option>
                        <option value="alimentation">Alimentation</option>
                        <option value="charges">Charges</option>
                        <option value="loisirs">Loisirs</option>
                        <option value="transport">Transport</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeExpenseModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Annuler</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Invite Member Modal -->
    <div id="inviteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Inviter un membre</h3>
                <button onclick="closeInviteModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="inviteForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email du membre</label>
                    <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="email@exemple.com" required>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg">
                    <p class="text-sm text-blue-700">
                        <i class="fas fa-info-circle mr-2"></i>
                        Une invitation sera envoyée par email. Le membre devra accepter pour rejoindre la colocation.
                    </p>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeInviteModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Annuler</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Envoyer l'invitation</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal functions
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
            document.getElementById('createModal').classList.add('flex');
        }
        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
            document.getElementById('createModal').classList.remove('flex');
        }
        function openExpenseModal() {
            document.getElementById('expenseModal').classList.remove('hidden');
            document.getElementById('expenseModal').classList.add('flex');
        }
        function closeExpenseModal() {
            document.getElementById('expenseModal').classList.add('hidden');
            document.getElementById('expenseModal').classList.remove('flex');
        }
        function openInviteModal() {
            document.getElementById('inviteModal').classList.remove('hidden');
            document.getElementById('inviteModal').classList.add('flex');
        }
        function closeInviteModal() {
            document.getElementById('inviteModal').classList.add('hidden');
            document.getElementById('inviteModal').classList.remove('flex');
        }

        // Form submissions

        document.getElementById('addExpenseForm').addEventListener('submit', function(e) {
         
            alert('Dépense ajoutée avec succès !');
            closeExpenseModal();
        });
        document.getElementById('inviteForm').addEventListener('submit', function(e) {

            alert('Invitation envoyée avec succès !');
            closeInviteModal();
        });

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
